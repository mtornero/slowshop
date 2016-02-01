<?php

namespace App\Propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Propel\DeliveryPeriodic as ChildDeliveryPeriodic;
use App\Propel\DeliveryPeriodicQuery as ChildDeliveryPeriodicQuery;
use App\Propel\PeriodicPlan as ChildPeriodicPlan;
use App\Propel\PeriodicPlanException as ChildPeriodicPlanException;
use App\Propel\PeriodicPlanExceptionQuery as ChildPeriodicPlanExceptionQuery;
use App\Propel\PeriodicPlanQuery as ChildPeriodicPlanQuery;
use App\Propel\PeriodicType as ChildPeriodicType;
use App\Propel\PeriodicTypeQuery as ChildPeriodicTypeQuery;
use App\Propel\UserPeriodicPlan as ChildUserPeriodicPlan;
use App\Propel\UserPeriodicPlanQuery as ChildUserPeriodicPlanQuery;
use App\Propel\Map\DeliveryPeriodicTableMap;
use App\Propel\Map\PeriodicPlanExceptionTableMap;
use App\Propel\Map\PeriodicPlanTableMap;
use App\Propel\Map\UserPeriodicPlanTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'periodic_plan' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class PeriodicPlan implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\PeriodicPlanTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the periodic_plan_id field.
     *
     * @var        int
     */
    protected $periodic_plan_id;

    /**
     * The value for the periodic_plan_name field.
     *
     * @var        string
     */
    protected $periodic_plan_name;

    /**
     * The value for the periodic_plan_point field.
     *
     * @var        string
     */
    protected $periodic_plan_point;

    /**
     * The value for the periodic_type_id field.
     *
     * @var        int
     */
    protected $periodic_type_id;

    /**
     * The value for the delievery_periodic_weekday field.
     *
     * @var        int
     */
    protected $delievery_periodic_weekday;

    /**
     * The value for the created_at field.
     *
     * @var        \DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        \DateTime
     */
    protected $updated_at;

    /**
     * @var        ChildPeriodicType
     */
    protected $aPeriodicType;

    /**
     * @var        ObjectCollection|ChildDeliveryPeriodic[] Collection to store aggregation of ChildDeliveryPeriodic objects.
     */
    protected $collDeliveryPeriodics;
    protected $collDeliveryPeriodicsPartial;

    /**
     * @var        ObjectCollection|ChildPeriodicPlanException[] Collection to store aggregation of ChildPeriodicPlanException objects.
     */
    protected $collPeriodicPlanExceptions;
    protected $collPeriodicPlanExceptionsPartial;

    /**
     * @var        ObjectCollection|ChildUserPeriodicPlan[] Collection to store aggregation of ChildUserPeriodicPlan objects.
     */
    protected $collUserPeriodicPlans;
    protected $collUserPeriodicPlansPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDeliveryPeriodic[]
     */
    protected $deliveryPeriodicsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPeriodicPlanException[]
     */
    protected $periodicPlanExceptionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserPeriodicPlan[]
     */
    protected $userPeriodicPlansScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Propel\Base\PeriodicPlan object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>PeriodicPlan</code> instance.  If
     * <code>obj</code> is an instance of <code>PeriodicPlan</code>, delegates to
     * <code>equals(PeriodicPlan)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|PeriodicPlan The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [periodic_plan_id] column value.
     *
     * @return int
     */
    public function getPeriodicPlanId()
    {
        return $this->periodic_plan_id;
    }

    /**
     * Get the [periodic_plan_name] column value.
     *
     * @return string
     */
    public function getPeriodicPlanName()
    {
        return $this->periodic_plan_name;
    }

    /**
     * Get the [periodic_plan_point] column value.
     *
     * @return string
     */
    public function getPeriodicPlanPoint()
    {
        return $this->periodic_plan_point;
    }

    /**
     * Get the [periodic_type_id] column value.
     *
     * @return int
     */
    public function getPeriodicTypeId()
    {
        return $this->periodic_type_id;
    }

    /**
     * Get the [delievery_periodic_weekday] column value.
     *
     * @return int
     */
    public function getDelieveryPeriodicWeekday()
    {
        return $this->delievery_periodic_weekday;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [periodic_plan_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     */
    public function setPeriodicPlanId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->periodic_plan_id !== $v) {
            $this->periodic_plan_id = $v;
            $this->modifiedColumns[PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID] = true;
        }

        return $this;
    } // setPeriodicPlanId()

    /**
     * Set the value of [periodic_plan_name] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     */
    public function setPeriodicPlanName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->periodic_plan_name !== $v) {
            $this->periodic_plan_name = $v;
            $this->modifiedColumns[PeriodicPlanTableMap::COL_PERIODIC_PLAN_NAME] = true;
        }

        return $this;
    } // setPeriodicPlanName()

    /**
     * Set the value of [periodic_plan_point] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     */
    public function setPeriodicPlanPoint($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->periodic_plan_point !== $v) {
            $this->periodic_plan_point = $v;
            $this->modifiedColumns[PeriodicPlanTableMap::COL_PERIODIC_PLAN_POINT] = true;
        }

        return $this;
    } // setPeriodicPlanPoint()

    /**
     * Set the value of [periodic_type_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     */
    public function setPeriodicTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->periodic_type_id !== $v) {
            $this->periodic_type_id = $v;
            $this->modifiedColumns[PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID] = true;
        }

        if ($this->aPeriodicType !== null && $this->aPeriodicType->getPeriodicTypeId() !== $v) {
            $this->aPeriodicType = null;
        }

        return $this;
    } // setPeriodicTypeId()

    /**
     * Set the value of [delievery_periodic_weekday] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     */
    public function setDelieveryPeriodicWeekday($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->delievery_periodic_weekday !== $v) {
            $this->delievery_periodic_weekday = $v;
            $this->modifiedColumns[PeriodicPlanTableMap::COL_DELIEVERY_PERIODIC_WEEKDAY] = true;
        }

        return $this;
    } // setDelieveryPeriodicWeekday()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PeriodicPlanTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PeriodicPlanTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PeriodicPlanTableMap::translateFieldName('PeriodicPlanId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->periodic_plan_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PeriodicPlanTableMap::translateFieldName('PeriodicPlanName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->periodic_plan_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PeriodicPlanTableMap::translateFieldName('PeriodicPlanPoint', TableMap::TYPE_PHPNAME, $indexType)];
            $this->periodic_plan_point = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PeriodicPlanTableMap::translateFieldName('PeriodicTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->periodic_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PeriodicPlanTableMap::translateFieldName('DelieveryPeriodicWeekday', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delievery_periodic_weekday = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PeriodicPlanTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PeriodicPlanTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = PeriodicPlanTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\PeriodicPlan'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aPeriodicType !== null && $this->periodic_type_id !== $this->aPeriodicType->getPeriodicTypeId()) {
            $this->aPeriodicType = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PeriodicPlanTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPeriodicPlanQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPeriodicType = null;
            $this->collDeliveryPeriodics = null;

            $this->collPeriodicPlanExceptions = null;

            $this->collUserPeriodicPlans = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see PeriodicPlan::setDeleted()
     * @see PeriodicPlan::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicPlanTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPeriodicPlanQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicPlanTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(PeriodicPlanTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(PeriodicPlanTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PeriodicPlanTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PeriodicPlanTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aPeriodicType !== null) {
                if ($this->aPeriodicType->isModified() || $this->aPeriodicType->isNew()) {
                    $affectedRows += $this->aPeriodicType->save($con);
                }
                $this->setPeriodicType($this->aPeriodicType);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->deliveryPeriodicsScheduledForDeletion !== null) {
                if (!$this->deliveryPeriodicsScheduledForDeletion->isEmpty()) {
                    \App\Propel\DeliveryPeriodicQuery::create()
                        ->filterByPrimaryKeys($this->deliveryPeriodicsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->deliveryPeriodicsScheduledForDeletion = null;
                }
            }

            if ($this->collDeliveryPeriodics !== null) {
                foreach ($this->collDeliveryPeriodics as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->periodicPlanExceptionsScheduledForDeletion !== null) {
                if (!$this->periodicPlanExceptionsScheduledForDeletion->isEmpty()) {
                    \App\Propel\PeriodicPlanExceptionQuery::create()
                        ->filterByPrimaryKeys($this->periodicPlanExceptionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->periodicPlanExceptionsScheduledForDeletion = null;
                }
            }

            if ($this->collPeriodicPlanExceptions !== null) {
                foreach ($this->collPeriodicPlanExceptions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userPeriodicPlansScheduledForDeletion !== null) {
                if (!$this->userPeriodicPlansScheduledForDeletion->isEmpty()) {
                    \App\Propel\UserPeriodicPlanQuery::create()
                        ->filterByPrimaryKeys($this->userPeriodicPlansScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userPeriodicPlansScheduledForDeletion = null;
                }
            }

            if ($this->collUserPeriodicPlans !== null) {
                foreach ($this->collUserPeriodicPlans as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID] = true;
        if (null !== $this->periodic_plan_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'periodic_plan_id';
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_PERIODIC_PLAN_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'periodic_plan_name';
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_PERIODIC_PLAN_POINT)) {
            $modifiedColumns[':p' . $index++]  = 'periodic_plan_point';
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'periodic_type_id';
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_DELIEVERY_PERIODIC_WEEKDAY)) {
            $modifiedColumns[':p' . $index++]  = 'delievery_periodic_weekday';
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO periodic_plan (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'periodic_plan_id':
                        $stmt->bindValue($identifier, $this->periodic_plan_id, PDO::PARAM_INT);
                        break;
                    case 'periodic_plan_name':
                        $stmt->bindValue($identifier, $this->periodic_plan_name, PDO::PARAM_STR);
                        break;
                    case 'periodic_plan_point':
                        $stmt->bindValue($identifier, $this->periodic_plan_point, PDO::PARAM_STR);
                        break;
                    case 'periodic_type_id':
                        $stmt->bindValue($identifier, $this->periodic_type_id, PDO::PARAM_INT);
                        break;
                    case 'delievery_periodic_weekday':
                        $stmt->bindValue($identifier, $this->delievery_periodic_weekday, PDO::PARAM_INT);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setPeriodicPlanId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PeriodicPlanTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getPeriodicPlanId();
                break;
            case 1:
                return $this->getPeriodicPlanName();
                break;
            case 2:
                return $this->getPeriodicPlanPoint();
                break;
            case 3:
                return $this->getPeriodicTypeId();
                break;
            case 4:
                return $this->getDelieveryPeriodicWeekday();
                break;
            case 5:
                return $this->getCreatedAt();
                break;
            case 6:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['PeriodicPlan'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PeriodicPlan'][$this->hashCode()] = true;
        $keys = PeriodicPlanTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPeriodicPlanId(),
            $keys[1] => $this->getPeriodicPlanName(),
            $keys[2] => $this->getPeriodicPlanPoint(),
            $keys[3] => $this->getPeriodicTypeId(),
            $keys[4] => $this->getDelieveryPeriodicWeekday(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getUpdatedAt(),
        );
        if ($result[$keys[5]] instanceof \DateTime) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        if ($result[$keys[6]] instanceof \DateTime) {
            $result[$keys[6]] = $result[$keys[6]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aPeriodicType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'periodicType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'periodic_type';
                        break;
                    default:
                        $key = 'PeriodicType';
                }

                $result[$key] = $this->aPeriodicType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collDeliveryPeriodics) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'deliveryPeriodics';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'delivery_periodics';
                        break;
                    default:
                        $key = 'DeliveryPeriodics';
                }

                $result[$key] = $this->collDeliveryPeriodics->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPeriodicPlanExceptions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'periodicPlanExceptions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'periodic_plan_exceptions';
                        break;
                    default:
                        $key = 'PeriodicPlanExceptions';
                }

                $result[$key] = $this->collPeriodicPlanExceptions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserPeriodicPlans) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userPeriodicPlans';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_periodic_plans';
                        break;
                    default:
                        $key = 'UserPeriodicPlans';
                }

                $result[$key] = $this->collUserPeriodicPlans->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\App\Propel\PeriodicPlan
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PeriodicPlanTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\PeriodicPlan
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPeriodicPlanId($value);
                break;
            case 1:
                $this->setPeriodicPlanName($value);
                break;
            case 2:
                $this->setPeriodicPlanPoint($value);
                break;
            case 3:
                $this->setPeriodicTypeId($value);
                break;
            case 4:
                $this->setDelieveryPeriodicWeekday($value);
                break;
            case 5:
                $this->setCreatedAt($value);
                break;
            case 6:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PeriodicPlanTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPeriodicPlanId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPeriodicPlanName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPeriodicPlanPoint($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPeriodicTypeId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDelieveryPeriodicWeekday($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCreatedAt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUpdatedAt($arr[$keys[6]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\App\Propel\PeriodicPlan The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PeriodicPlanTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID)) {
            $criteria->add(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $this->periodic_plan_id);
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_PERIODIC_PLAN_NAME)) {
            $criteria->add(PeriodicPlanTableMap::COL_PERIODIC_PLAN_NAME, $this->periodic_plan_name);
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_PERIODIC_PLAN_POINT)) {
            $criteria->add(PeriodicPlanTableMap::COL_PERIODIC_PLAN_POINT, $this->periodic_plan_point);
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID)) {
            $criteria->add(PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID, $this->periodic_type_id);
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_DELIEVERY_PERIODIC_WEEKDAY)) {
            $criteria->add(PeriodicPlanTableMap::COL_DELIEVERY_PERIODIC_WEEKDAY, $this->delievery_periodic_weekday);
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_CREATED_AT)) {
            $criteria->add(PeriodicPlanTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(PeriodicPlanTableMap::COL_UPDATED_AT)) {
            $criteria->add(PeriodicPlanTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPeriodicPlanQuery::create();
        $criteria->add(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $this->periodic_plan_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getPeriodicPlanId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getPeriodicPlanId();
    }

    /**
     * Generic method to set the primary key (periodic_plan_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPeriodicPlanId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getPeriodicPlanId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\PeriodicPlan (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPeriodicPlanName($this->getPeriodicPlanName());
        $copyObj->setPeriodicPlanPoint($this->getPeriodicPlanPoint());
        $copyObj->setPeriodicTypeId($this->getPeriodicTypeId());
        $copyObj->setDelieveryPeriodicWeekday($this->getDelieveryPeriodicWeekday());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDeliveryPeriodics() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDeliveryPeriodic($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPeriodicPlanExceptions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPeriodicPlanException($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserPeriodicPlans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserPeriodicPlan($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPeriodicPlanId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \App\Propel\PeriodicPlan Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildPeriodicType object.
     *
     * @param  ChildPeriodicType $v
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPeriodicType(ChildPeriodicType $v = null)
    {
        if ($v === null) {
            $this->setPeriodicTypeId(NULL);
        } else {
            $this->setPeriodicTypeId($v->getPeriodicTypeId());
        }

        $this->aPeriodicType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPeriodicType object, it will not be re-added.
        if ($v !== null) {
            $v->addPeriodicPlan($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPeriodicType object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPeriodicType The associated ChildPeriodicType object.
     * @throws PropelException
     */
    public function getPeriodicType(ConnectionInterface $con = null)
    {
        if ($this->aPeriodicType === null && ($this->periodic_type_id !== null)) {
            $this->aPeriodicType = ChildPeriodicTypeQuery::create()->findPk($this->periodic_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPeriodicType->addPeriodicPlans($this);
             */
        }

        return $this->aPeriodicType;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('DeliveryPeriodic' == $relationName) {
            return $this->initDeliveryPeriodics();
        }
        if ('PeriodicPlanException' == $relationName) {
            return $this->initPeriodicPlanExceptions();
        }
        if ('UserPeriodicPlan' == $relationName) {
            return $this->initUserPeriodicPlans();
        }
    }

    /**
     * Clears out the collDeliveryPeriodics collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDeliveryPeriodics()
     */
    public function clearDeliveryPeriodics()
    {
        $this->collDeliveryPeriodics = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDeliveryPeriodics collection loaded partially.
     */
    public function resetPartialDeliveryPeriodics($v = true)
    {
        $this->collDeliveryPeriodicsPartial = $v;
    }

    /**
     * Initializes the collDeliveryPeriodics collection.
     *
     * By default this just sets the collDeliveryPeriodics collection to an empty array (like clearcollDeliveryPeriodics());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDeliveryPeriodics($overrideExisting = true)
    {
        if (null !== $this->collDeliveryPeriodics && !$overrideExisting) {
            return;
        }

        $collectionClassName = DeliveryPeriodicTableMap::getTableMap()->getCollectionClassName();

        $this->collDeliveryPeriodics = new $collectionClassName;
        $this->collDeliveryPeriodics->setModel('\App\Propel\DeliveryPeriodic');
    }

    /**
     * Gets an array of ChildDeliveryPeriodic objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPeriodicPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDeliveryPeriodic[] List of ChildDeliveryPeriodic objects
     * @throws PropelException
     */
    public function getDeliveryPeriodics(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDeliveryPeriodicsPartial && !$this->isNew();
        if (null === $this->collDeliveryPeriodics || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDeliveryPeriodics) {
                // return empty collection
                $this->initDeliveryPeriodics();
            } else {
                $collDeliveryPeriodics = ChildDeliveryPeriodicQuery::create(null, $criteria)
                    ->filterByPeriodicPlan($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDeliveryPeriodicsPartial && count($collDeliveryPeriodics)) {
                        $this->initDeliveryPeriodics(false);

                        foreach ($collDeliveryPeriodics as $obj) {
                            if (false == $this->collDeliveryPeriodics->contains($obj)) {
                                $this->collDeliveryPeriodics->append($obj);
                            }
                        }

                        $this->collDeliveryPeriodicsPartial = true;
                    }

                    return $collDeliveryPeriodics;
                }

                if ($partial && $this->collDeliveryPeriodics) {
                    foreach ($this->collDeliveryPeriodics as $obj) {
                        if ($obj->isNew()) {
                            $collDeliveryPeriodics[] = $obj;
                        }
                    }
                }

                $this->collDeliveryPeriodics = $collDeliveryPeriodics;
                $this->collDeliveryPeriodicsPartial = false;
            }
        }

        return $this->collDeliveryPeriodics;
    }

    /**
     * Sets a collection of ChildDeliveryPeriodic objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $deliveryPeriodics A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPeriodicPlan The current object (for fluent API support)
     */
    public function setDeliveryPeriodics(Collection $deliveryPeriodics, ConnectionInterface $con = null)
    {
        /** @var ChildDeliveryPeriodic[] $deliveryPeriodicsToDelete */
        $deliveryPeriodicsToDelete = $this->getDeliveryPeriodics(new Criteria(), $con)->diff($deliveryPeriodics);


        $this->deliveryPeriodicsScheduledForDeletion = $deliveryPeriodicsToDelete;

        foreach ($deliveryPeriodicsToDelete as $deliveryPeriodicRemoved) {
            $deliveryPeriodicRemoved->setPeriodicPlan(null);
        }

        $this->collDeliveryPeriodics = null;
        foreach ($deliveryPeriodics as $deliveryPeriodic) {
            $this->addDeliveryPeriodic($deliveryPeriodic);
        }

        $this->collDeliveryPeriodics = $deliveryPeriodics;
        $this->collDeliveryPeriodicsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DeliveryPeriodic objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related DeliveryPeriodic objects.
     * @throws PropelException
     */
    public function countDeliveryPeriodics(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDeliveryPeriodicsPartial && !$this->isNew();
        if (null === $this->collDeliveryPeriodics || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDeliveryPeriodics) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDeliveryPeriodics());
            }

            $query = ChildDeliveryPeriodicQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPeriodicPlan($this)
                ->count($con);
        }

        return count($this->collDeliveryPeriodics);
    }

    /**
     * Method called to associate a ChildDeliveryPeriodic object to this object
     * through the ChildDeliveryPeriodic foreign key attribute.
     *
     * @param  ChildDeliveryPeriodic $l ChildDeliveryPeriodic
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     */
    public function addDeliveryPeriodic(ChildDeliveryPeriodic $l)
    {
        if ($this->collDeliveryPeriodics === null) {
            $this->initDeliveryPeriodics();
            $this->collDeliveryPeriodicsPartial = true;
        }

        if (!$this->collDeliveryPeriodics->contains($l)) {
            $this->doAddDeliveryPeriodic($l);

            if ($this->deliveryPeriodicsScheduledForDeletion and $this->deliveryPeriodicsScheduledForDeletion->contains($l)) {
                $this->deliveryPeriodicsScheduledForDeletion->remove($this->deliveryPeriodicsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDeliveryPeriodic $deliveryPeriodic The ChildDeliveryPeriodic object to add.
     */
    protected function doAddDeliveryPeriodic(ChildDeliveryPeriodic $deliveryPeriodic)
    {
        $this->collDeliveryPeriodics[]= $deliveryPeriodic;
        $deliveryPeriodic->setPeriodicPlan($this);
    }

    /**
     * @param  ChildDeliveryPeriodic $deliveryPeriodic The ChildDeliveryPeriodic object to remove.
     * @return $this|ChildPeriodicPlan The current object (for fluent API support)
     */
    public function removeDeliveryPeriodic(ChildDeliveryPeriodic $deliveryPeriodic)
    {
        if ($this->getDeliveryPeriodics()->contains($deliveryPeriodic)) {
            $pos = $this->collDeliveryPeriodics->search($deliveryPeriodic);
            $this->collDeliveryPeriodics->remove($pos);
            if (null === $this->deliveryPeriodicsScheduledForDeletion) {
                $this->deliveryPeriodicsScheduledForDeletion = clone $this->collDeliveryPeriodics;
                $this->deliveryPeriodicsScheduledForDeletion->clear();
            }
            $this->deliveryPeriodicsScheduledForDeletion[]= clone $deliveryPeriodic;
            $deliveryPeriodic->setPeriodicPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this PeriodicPlan is new, it will return
     * an empty collection; or if this PeriodicPlan has previously
     * been saved, it will retrieve related DeliveryPeriodics from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in PeriodicPlan.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDeliveryPeriodic[] List of ChildDeliveryPeriodic objects
     */
    public function getDeliveryPeriodicsJoinDelivery(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDeliveryPeriodicQuery::create(null, $criteria);
        $query->joinWith('Delivery', $joinBehavior);

        return $this->getDeliveryPeriodics($query, $con);
    }

    /**
     * Clears out the collPeriodicPlanExceptions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPeriodicPlanExceptions()
     */
    public function clearPeriodicPlanExceptions()
    {
        $this->collPeriodicPlanExceptions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPeriodicPlanExceptions collection loaded partially.
     */
    public function resetPartialPeriodicPlanExceptions($v = true)
    {
        $this->collPeriodicPlanExceptionsPartial = $v;
    }

    /**
     * Initializes the collPeriodicPlanExceptions collection.
     *
     * By default this just sets the collPeriodicPlanExceptions collection to an empty array (like clearcollPeriodicPlanExceptions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPeriodicPlanExceptions($overrideExisting = true)
    {
        if (null !== $this->collPeriodicPlanExceptions && !$overrideExisting) {
            return;
        }

        $collectionClassName = PeriodicPlanExceptionTableMap::getTableMap()->getCollectionClassName();

        $this->collPeriodicPlanExceptions = new $collectionClassName;
        $this->collPeriodicPlanExceptions->setModel('\App\Propel\PeriodicPlanException');
    }

    /**
     * Gets an array of ChildPeriodicPlanException objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPeriodicPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPeriodicPlanException[] List of ChildPeriodicPlanException objects
     * @throws PropelException
     */
    public function getPeriodicPlanExceptions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPeriodicPlanExceptionsPartial && !$this->isNew();
        if (null === $this->collPeriodicPlanExceptions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPeriodicPlanExceptions) {
                // return empty collection
                $this->initPeriodicPlanExceptions();
            } else {
                $collPeriodicPlanExceptions = ChildPeriodicPlanExceptionQuery::create(null, $criteria)
                    ->filterByPeriodicPlan($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPeriodicPlanExceptionsPartial && count($collPeriodicPlanExceptions)) {
                        $this->initPeriodicPlanExceptions(false);

                        foreach ($collPeriodicPlanExceptions as $obj) {
                            if (false == $this->collPeriodicPlanExceptions->contains($obj)) {
                                $this->collPeriodicPlanExceptions->append($obj);
                            }
                        }

                        $this->collPeriodicPlanExceptionsPartial = true;
                    }

                    return $collPeriodicPlanExceptions;
                }

                if ($partial && $this->collPeriodicPlanExceptions) {
                    foreach ($this->collPeriodicPlanExceptions as $obj) {
                        if ($obj->isNew()) {
                            $collPeriodicPlanExceptions[] = $obj;
                        }
                    }
                }

                $this->collPeriodicPlanExceptions = $collPeriodicPlanExceptions;
                $this->collPeriodicPlanExceptionsPartial = false;
            }
        }

        return $this->collPeriodicPlanExceptions;
    }

    /**
     * Sets a collection of ChildPeriodicPlanException objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $periodicPlanExceptions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPeriodicPlan The current object (for fluent API support)
     */
    public function setPeriodicPlanExceptions(Collection $periodicPlanExceptions, ConnectionInterface $con = null)
    {
        /** @var ChildPeriodicPlanException[] $periodicPlanExceptionsToDelete */
        $periodicPlanExceptionsToDelete = $this->getPeriodicPlanExceptions(new Criteria(), $con)->diff($periodicPlanExceptions);


        $this->periodicPlanExceptionsScheduledForDeletion = $periodicPlanExceptionsToDelete;

        foreach ($periodicPlanExceptionsToDelete as $periodicPlanExceptionRemoved) {
            $periodicPlanExceptionRemoved->setPeriodicPlan(null);
        }

        $this->collPeriodicPlanExceptions = null;
        foreach ($periodicPlanExceptions as $periodicPlanException) {
            $this->addPeriodicPlanException($periodicPlanException);
        }

        $this->collPeriodicPlanExceptions = $periodicPlanExceptions;
        $this->collPeriodicPlanExceptionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PeriodicPlanException objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PeriodicPlanException objects.
     * @throws PropelException
     */
    public function countPeriodicPlanExceptions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPeriodicPlanExceptionsPartial && !$this->isNew();
        if (null === $this->collPeriodicPlanExceptions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPeriodicPlanExceptions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPeriodicPlanExceptions());
            }

            $query = ChildPeriodicPlanExceptionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPeriodicPlan($this)
                ->count($con);
        }

        return count($this->collPeriodicPlanExceptions);
    }

    /**
     * Method called to associate a ChildPeriodicPlanException object to this object
     * through the ChildPeriodicPlanException foreign key attribute.
     *
     * @param  ChildPeriodicPlanException $l ChildPeriodicPlanException
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     */
    public function addPeriodicPlanException(ChildPeriodicPlanException $l)
    {
        if ($this->collPeriodicPlanExceptions === null) {
            $this->initPeriodicPlanExceptions();
            $this->collPeriodicPlanExceptionsPartial = true;
        }

        if (!$this->collPeriodicPlanExceptions->contains($l)) {
            $this->doAddPeriodicPlanException($l);

            if ($this->periodicPlanExceptionsScheduledForDeletion and $this->periodicPlanExceptionsScheduledForDeletion->contains($l)) {
                $this->periodicPlanExceptionsScheduledForDeletion->remove($this->periodicPlanExceptionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPeriodicPlanException $periodicPlanException The ChildPeriodicPlanException object to add.
     */
    protected function doAddPeriodicPlanException(ChildPeriodicPlanException $periodicPlanException)
    {
        $this->collPeriodicPlanExceptions[]= $periodicPlanException;
        $periodicPlanException->setPeriodicPlan($this);
    }

    /**
     * @param  ChildPeriodicPlanException $periodicPlanException The ChildPeriodicPlanException object to remove.
     * @return $this|ChildPeriodicPlan The current object (for fluent API support)
     */
    public function removePeriodicPlanException(ChildPeriodicPlanException $periodicPlanException)
    {
        if ($this->getPeriodicPlanExceptions()->contains($periodicPlanException)) {
            $pos = $this->collPeriodicPlanExceptions->search($periodicPlanException);
            $this->collPeriodicPlanExceptions->remove($pos);
            if (null === $this->periodicPlanExceptionsScheduledForDeletion) {
                $this->periodicPlanExceptionsScheduledForDeletion = clone $this->collPeriodicPlanExceptions;
                $this->periodicPlanExceptionsScheduledForDeletion->clear();
            }
            $this->periodicPlanExceptionsScheduledForDeletion[]= clone $periodicPlanException;
            $periodicPlanException->setPeriodicPlan(null);
        }

        return $this;
    }

    /**
     * Clears out the collUserPeriodicPlans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserPeriodicPlans()
     */
    public function clearUserPeriodicPlans()
    {
        $this->collUserPeriodicPlans = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserPeriodicPlans collection loaded partially.
     */
    public function resetPartialUserPeriodicPlans($v = true)
    {
        $this->collUserPeriodicPlansPartial = $v;
    }

    /**
     * Initializes the collUserPeriodicPlans collection.
     *
     * By default this just sets the collUserPeriodicPlans collection to an empty array (like clearcollUserPeriodicPlans());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserPeriodicPlans($overrideExisting = true)
    {
        if (null !== $this->collUserPeriodicPlans && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserPeriodicPlanTableMap::getTableMap()->getCollectionClassName();

        $this->collUserPeriodicPlans = new $collectionClassName;
        $this->collUserPeriodicPlans->setModel('\App\Propel\UserPeriodicPlan');
    }

    /**
     * Gets an array of ChildUserPeriodicPlan objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPeriodicPlan is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserPeriodicPlan[] List of ChildUserPeriodicPlan objects
     * @throws PropelException
     */
    public function getUserPeriodicPlans(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserPeriodicPlansPartial && !$this->isNew();
        if (null === $this->collUserPeriodicPlans || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserPeriodicPlans) {
                // return empty collection
                $this->initUserPeriodicPlans();
            } else {
                $collUserPeriodicPlans = ChildUserPeriodicPlanQuery::create(null, $criteria)
                    ->filterByPeriodicPlan($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserPeriodicPlansPartial && count($collUserPeriodicPlans)) {
                        $this->initUserPeriodicPlans(false);

                        foreach ($collUserPeriodicPlans as $obj) {
                            if (false == $this->collUserPeriodicPlans->contains($obj)) {
                                $this->collUserPeriodicPlans->append($obj);
                            }
                        }

                        $this->collUserPeriodicPlansPartial = true;
                    }

                    return $collUserPeriodicPlans;
                }

                if ($partial && $this->collUserPeriodicPlans) {
                    foreach ($this->collUserPeriodicPlans as $obj) {
                        if ($obj->isNew()) {
                            $collUserPeriodicPlans[] = $obj;
                        }
                    }
                }

                $this->collUserPeriodicPlans = $collUserPeriodicPlans;
                $this->collUserPeriodicPlansPartial = false;
            }
        }

        return $this->collUserPeriodicPlans;
    }

    /**
     * Sets a collection of ChildUserPeriodicPlan objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userPeriodicPlans A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPeriodicPlan The current object (for fluent API support)
     */
    public function setUserPeriodicPlans(Collection $userPeriodicPlans, ConnectionInterface $con = null)
    {
        /** @var ChildUserPeriodicPlan[] $userPeriodicPlansToDelete */
        $userPeriodicPlansToDelete = $this->getUserPeriodicPlans(new Criteria(), $con)->diff($userPeriodicPlans);


        $this->userPeriodicPlansScheduledForDeletion = $userPeriodicPlansToDelete;

        foreach ($userPeriodicPlansToDelete as $userPeriodicPlanRemoved) {
            $userPeriodicPlanRemoved->setPeriodicPlan(null);
        }

        $this->collUserPeriodicPlans = null;
        foreach ($userPeriodicPlans as $userPeriodicPlan) {
            $this->addUserPeriodicPlan($userPeriodicPlan);
        }

        $this->collUserPeriodicPlans = $userPeriodicPlans;
        $this->collUserPeriodicPlansPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserPeriodicPlan objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserPeriodicPlan objects.
     * @throws PropelException
     */
    public function countUserPeriodicPlans(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserPeriodicPlansPartial && !$this->isNew();
        if (null === $this->collUserPeriodicPlans || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserPeriodicPlans) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserPeriodicPlans());
            }

            $query = ChildUserPeriodicPlanQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPeriodicPlan($this)
                ->count($con);
        }

        return count($this->collUserPeriodicPlans);
    }

    /**
     * Method called to associate a ChildUserPeriodicPlan object to this object
     * through the ChildUserPeriodicPlan foreign key attribute.
     *
     * @param  ChildUserPeriodicPlan $l ChildUserPeriodicPlan
     * @return $this|\App\Propel\PeriodicPlan The current object (for fluent API support)
     */
    public function addUserPeriodicPlan(ChildUserPeriodicPlan $l)
    {
        if ($this->collUserPeriodicPlans === null) {
            $this->initUserPeriodicPlans();
            $this->collUserPeriodicPlansPartial = true;
        }

        if (!$this->collUserPeriodicPlans->contains($l)) {
            $this->doAddUserPeriodicPlan($l);

            if ($this->userPeriodicPlansScheduledForDeletion and $this->userPeriodicPlansScheduledForDeletion->contains($l)) {
                $this->userPeriodicPlansScheduledForDeletion->remove($this->userPeriodicPlansScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUserPeriodicPlan $userPeriodicPlan The ChildUserPeriodicPlan object to add.
     */
    protected function doAddUserPeriodicPlan(ChildUserPeriodicPlan $userPeriodicPlan)
    {
        $this->collUserPeriodicPlans[]= $userPeriodicPlan;
        $userPeriodicPlan->setPeriodicPlan($this);
    }

    /**
     * @param  ChildUserPeriodicPlan $userPeriodicPlan The ChildUserPeriodicPlan object to remove.
     * @return $this|ChildPeriodicPlan The current object (for fluent API support)
     */
    public function removeUserPeriodicPlan(ChildUserPeriodicPlan $userPeriodicPlan)
    {
        if ($this->getUserPeriodicPlans()->contains($userPeriodicPlan)) {
            $pos = $this->collUserPeriodicPlans->search($userPeriodicPlan);
            $this->collUserPeriodicPlans->remove($pos);
            if (null === $this->userPeriodicPlansScheduledForDeletion) {
                $this->userPeriodicPlansScheduledForDeletion = clone $this->collUserPeriodicPlans;
                $this->userPeriodicPlansScheduledForDeletion->clear();
            }
            $this->userPeriodicPlansScheduledForDeletion[]= clone $userPeriodicPlan;
            $userPeriodicPlan->setPeriodicPlan(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this PeriodicPlan is new, it will return
     * an empty collection; or if this PeriodicPlan has previously
     * been saved, it will retrieve related UserPeriodicPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in PeriodicPlan.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserPeriodicPlan[] List of ChildUserPeriodicPlan objects
     */
    public function getUserPeriodicPlansJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserPeriodicPlanQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getUserPeriodicPlans($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aPeriodicType) {
            $this->aPeriodicType->removePeriodicPlan($this);
        }
        $this->periodic_plan_id = null;
        $this->periodic_plan_name = null;
        $this->periodic_plan_point = null;
        $this->periodic_type_id = null;
        $this->delievery_periodic_weekday = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collDeliveryPeriodics) {
                foreach ($this->collDeliveryPeriodics as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPeriodicPlanExceptions) {
                foreach ($this->collPeriodicPlanExceptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserPeriodicPlans) {
                foreach ($this->collUserPeriodicPlans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDeliveryPeriodics = null;
        $this->collPeriodicPlanExceptions = null;
        $this->collUserPeriodicPlans = null;
        $this->aPeriodicType = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PeriodicPlanTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildPeriodicPlan The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[PeriodicPlanTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
