<?php

namespace App\Propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Propel\Delivery as ChildDelivery;
use App\Propel\DeliveryPeriodic as ChildDeliveryPeriodic;
use App\Propel\DeliveryPeriodicQuery as ChildDeliveryPeriodicQuery;
use App\Propel\DeliveryQuery as ChildDeliveryQuery;
use App\Propel\PeriodicPlan as ChildPeriodicPlan;
use App\Propel\PeriodicPlanQuery as ChildPeriodicPlanQuery;
use App\Propel\Map\DeliveryPeriodicTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'delivery_periodic' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class DeliveryPeriodic implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\DeliveryPeriodicTableMap';


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
     * The value for the delivery_periodic_id field.
     *
     * @var        int
     */
    protected $delivery_periodic_id;

    /**
     * The value for the delivery_id field.
     *
     * @var        int
     */
    protected $delivery_id;

    /**
     * The value for the delivery_periodic_plan_id field.
     *
     * @var        int
     */
    protected $delivery_periodic_plan_id;

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
     * The value for the sortable_rank field.
     *
     * @var        int
     */
    protected $sortable_rank;

    /**
     * @var        ChildDelivery
     */
    protected $aDelivery;

    /**
     * @var        ChildPeriodicPlan
     */
    protected $aPeriodicPlan;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // sortable behavior

    /**
     * Queries to be executed in the save transaction
     * @var        array
     */
    protected $sortableQueries = array();

    /**
     * The old scope value.
     * @var        int
     */
    protected $oldScope;

    /**
     * Initializes internal state of App\Propel\Base\DeliveryPeriodic object.
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
     * Compares this with another <code>DeliveryPeriodic</code> instance.  If
     * <code>obj</code> is an instance of <code>DeliveryPeriodic</code>, delegates to
     * <code>equals(DeliveryPeriodic)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|DeliveryPeriodic The current object, for fluid interface
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
     * Get the [delivery_periodic_id] column value.
     *
     * @return int
     */
    public function getDeliveryPeriodicId()
    {
        return $this->delivery_periodic_id;
    }

    /**
     * Get the [delivery_id] column value.
     *
     * @return int
     */
    public function getDeliveryId()
    {
        return $this->delivery_id;
    }

    /**
     * Get the [delivery_periodic_plan_id] column value.
     *
     * @return int
     */
    public function getDeliveryPeriodicPlanId()
    {
        return $this->delivery_periodic_plan_id;
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
     * Get the [sortable_rank] column value.
     *
     * @return int
     */
    public function getSortableRank()
    {
        return $this->sortable_rank;
    }

    /**
     * Set the value of [delivery_periodic_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\DeliveryPeriodic The current object (for fluent API support)
     */
    public function setDeliveryPeriodicId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->delivery_periodic_id !== $v) {
            $this->delivery_periodic_id = $v;
            $this->modifiedColumns[DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID] = true;
        }

        return $this;
    } // setDeliveryPeriodicId()

    /**
     * Set the value of [delivery_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\DeliveryPeriodic The current object (for fluent API support)
     */
    public function setDeliveryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->delivery_id !== $v) {
            $this->delivery_id = $v;
            $this->modifiedColumns[DeliveryPeriodicTableMap::COL_DELIVERY_ID] = true;
        }

        if ($this->aDelivery !== null && $this->aDelivery->getDeliveryId() !== $v) {
            $this->aDelivery = null;
        }

        return $this;
    } // setDeliveryId()

    /**
     * Set the value of [delivery_periodic_plan_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\DeliveryPeriodic The current object (for fluent API support)
     */
    public function setDeliveryPeriodicPlanId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->delivery_periodic_plan_id !== $v) {
            // sortable behavior
            $this->oldScope = $this->delivery_periodic_plan_id;

            $this->delivery_periodic_plan_id = $v;
            $this->modifiedColumns[DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID] = true;
        }

        if ($this->aPeriodicPlan !== null && $this->aPeriodicPlan->getPeriodicPlanId() !== $v) {
            $this->aPeriodicPlan = null;
        }

        return $this;
    } // setDeliveryPeriodicPlanId()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\DeliveryPeriodic The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeliveryPeriodicTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\DeliveryPeriodic The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeliveryPeriodicTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Set the value of [sortable_rank] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\DeliveryPeriodic The current object (for fluent API support)
     */
    public function setSortableRank($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sortable_rank !== $v) {
            $this->sortable_rank = $v;
            $this->modifiedColumns[DeliveryPeriodicTableMap::COL_SORTABLE_RANK] = true;
        }

        return $this;
    } // setSortableRank()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DeliveryPeriodicTableMap::translateFieldName('DeliveryPeriodicId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_periodic_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DeliveryPeriodicTableMap::translateFieldName('DeliveryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DeliveryPeriodicTableMap::translateFieldName('DeliveryPeriodicPlanId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_periodic_plan_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DeliveryPeriodicTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DeliveryPeriodicTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DeliveryPeriodicTableMap::translateFieldName('SortableRank', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sortable_rank = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = DeliveryPeriodicTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\DeliveryPeriodic'), 0, $e);
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
        if ($this->aDelivery !== null && $this->delivery_id !== $this->aDelivery->getDeliveryId()) {
            $this->aDelivery = null;
        }
        if ($this->aPeriodicPlan !== null && $this->delivery_periodic_plan_id !== $this->aPeriodicPlan->getPeriodicPlanId()) {
            $this->aPeriodicPlan = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDeliveryPeriodicQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aDelivery = null;
            $this->aPeriodicPlan = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see DeliveryPeriodic::setDeleted()
     * @see DeliveryPeriodic::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDeliveryPeriodicQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            // sortable behavior

            ChildDeliveryPeriodicQuery::sortableShiftRank(-1, $this->getSortableRank() + 1, null, $this->getScopeValue(), $con);
            DeliveryPeriodicTableMap::clearInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            // sortable behavior
            $this->processSortableQueries($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(DeliveryPeriodicTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(DeliveryPeriodicTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
                // sortable behavior
                if (!$this->isColumnModified(DeliveryPeriodicTableMap::RANK_COL)) {
                    $this->setSortableRank(ChildDeliveryPeriodicQuery::create()->getMaxRankArray($this->getScopeValue(), $con) + 1);
                }

            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(DeliveryPeriodicTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
                // sortable behavior
                // if scope has changed and rank was not modified (if yes, assuming superior action)
                // insert object to the end of new scope and cleanup old one
                if (($this->isColumnModified(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID)) && !$this->isColumnModified(DeliveryPeriodicTableMap::RANK_COL)) { ChildDeliveryPeriodicQuery::sortableShiftRank(-1, $this->getSortableRank() + 1, null, $this->oldScope, $con);
                    $this->insertAtBottom($con);
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
                DeliveryPeriodicTableMap::addInstanceToPool($this);
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

            if ($this->aDelivery !== null) {
                if ($this->aDelivery->isModified() || $this->aDelivery->isNew()) {
                    $affectedRows += $this->aDelivery->save($con);
                }
                $this->setDelivery($this->aDelivery);
            }

            if ($this->aPeriodicPlan !== null) {
                if ($this->aPeriodicPlan->isModified() || $this->aPeriodicPlan->isNew()) {
                    $affectedRows += $this->aPeriodicPlan->save($con);
                }
                $this->setPeriodicPlan($this->aPeriodicPlan);
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

        $this->modifiedColumns[DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID] = true;
        if (null !== $this->delivery_periodic_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_periodic_id';
        }
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_DELIVERY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_id';
        }
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_periodic_plan_id';
        }
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_SORTABLE_RANK)) {
            $modifiedColumns[':p' . $index++]  = 'sortable_rank';
        }

        $sql = sprintf(
            'INSERT INTO delivery_periodic (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'delivery_periodic_id':
                        $stmt->bindValue($identifier, $this->delivery_periodic_id, PDO::PARAM_INT);
                        break;
                    case 'delivery_id':
                        $stmt->bindValue($identifier, $this->delivery_id, PDO::PARAM_INT);
                        break;
                    case 'delivery_periodic_plan_id':
                        $stmt->bindValue($identifier, $this->delivery_periodic_plan_id, PDO::PARAM_INT);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'sortable_rank':
                        $stmt->bindValue($identifier, $this->sortable_rank, PDO::PARAM_INT);
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
        $this->setDeliveryPeriodicId($pk);

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
        $pos = DeliveryPeriodicTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDeliveryPeriodicId();
                break;
            case 1:
                return $this->getDeliveryId();
                break;
            case 2:
                return $this->getDeliveryPeriodicPlanId();
                break;
            case 3:
                return $this->getCreatedAt();
                break;
            case 4:
                return $this->getUpdatedAt();
                break;
            case 5:
                return $this->getSortableRank();
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

        if (isset($alreadyDumpedObjects['DeliveryPeriodic'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['DeliveryPeriodic'][$this->hashCode()] = true;
        $keys = DeliveryPeriodicTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getDeliveryPeriodicId(),
            $keys[1] => $this->getDeliveryId(),
            $keys[2] => $this->getDeliveryPeriodicPlanId(),
            $keys[3] => $this->getCreatedAt(),
            $keys[4] => $this->getUpdatedAt(),
            $keys[5] => $this->getSortableRank(),
        );
        if ($result[$keys[3]] instanceof \DateTime) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        if ($result[$keys[4]] instanceof \DateTime) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aDelivery) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'delivery';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'delivery';
                        break;
                    default:
                        $key = 'Delivery';
                }

                $result[$key] = $this->aDelivery->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPeriodicPlan) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'periodicPlan';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'periodic_plan';
                        break;
                    default:
                        $key = 'PeriodicPlan';
                }

                $result[$key] = $this->aPeriodicPlan->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\App\Propel\DeliveryPeriodic
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DeliveryPeriodicTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\DeliveryPeriodic
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setDeliveryPeriodicId($value);
                break;
            case 1:
                $this->setDeliveryId($value);
                break;
            case 2:
                $this->setDeliveryPeriodicPlanId($value);
                break;
            case 3:
                $this->setCreatedAt($value);
                break;
            case 4:
                $this->setUpdatedAt($value);
                break;
            case 5:
                $this->setSortableRank($value);
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
        $keys = DeliveryPeriodicTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setDeliveryPeriodicId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDeliveryId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDeliveryPeriodicPlanId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCreatedAt($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUpdatedAt($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSortableRank($arr[$keys[5]]);
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
     * @return $this|\App\Propel\DeliveryPeriodic The current object, for fluid interface
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
        $criteria = new Criteria(DeliveryPeriodicTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID)) {
            $criteria->add(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID, $this->delivery_periodic_id);
        }
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_DELIVERY_ID)) {
            $criteria->add(DeliveryPeriodicTableMap::COL_DELIVERY_ID, $this->delivery_id);
        }
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID)) {
            $criteria->add(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID, $this->delivery_periodic_plan_id);
        }
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_CREATED_AT)) {
            $criteria->add(DeliveryPeriodicTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_UPDATED_AT)) {
            $criteria->add(DeliveryPeriodicTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(DeliveryPeriodicTableMap::COL_SORTABLE_RANK)) {
            $criteria->add(DeliveryPeriodicTableMap::COL_SORTABLE_RANK, $this->sortable_rank);
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
        $criteria = ChildDeliveryPeriodicQuery::create();
        $criteria->add(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID, $this->delivery_periodic_id);

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
        $validPk = null !== $this->getDeliveryPeriodicId();

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
        return $this->getDeliveryPeriodicId();
    }

    /**
     * Generic method to set the primary key (delivery_periodic_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setDeliveryPeriodicId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getDeliveryPeriodicId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\DeliveryPeriodic (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDeliveryId($this->getDeliveryId());
        $copyObj->setDeliveryPeriodicPlanId($this->getDeliveryPeriodicPlanId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setSortableRank($this->getSortableRank());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setDeliveryPeriodicId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\DeliveryPeriodic Clone of current object.
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
     * Declares an association between this object and a ChildDelivery object.
     *
     * @param  ChildDelivery $v
     * @return $this|\App\Propel\DeliveryPeriodic The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDelivery(ChildDelivery $v = null)
    {
        if ($v === null) {
            $this->setDeliveryId(NULL);
        } else {
            $this->setDeliveryId($v->getDeliveryId());
        }

        $this->aDelivery = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDelivery object, it will not be re-added.
        if ($v !== null) {
            $v->addDeliveryPeriodic($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDelivery object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildDelivery The associated ChildDelivery object.
     * @throws PropelException
     */
    public function getDelivery(ConnectionInterface $con = null)
    {
        if ($this->aDelivery === null && ($this->delivery_id !== null)) {
            $this->aDelivery = ChildDeliveryQuery::create()->findPk($this->delivery_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDelivery->addDeliveryPeriodics($this);
             */
        }

        return $this->aDelivery;
    }

    /**
     * Declares an association between this object and a ChildPeriodicPlan object.
     *
     * @param  ChildPeriodicPlan $v
     * @return $this|\App\Propel\DeliveryPeriodic The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPeriodicPlan(ChildPeriodicPlan $v = null)
    {
        if ($v === null) {
            $this->setDeliveryPeriodicPlanId(NULL);
        } else {
            $this->setDeliveryPeriodicPlanId($v->getPeriodicPlanId());
        }

        $this->aPeriodicPlan = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPeriodicPlan object, it will not be re-added.
        if ($v !== null) {
            $v->addDeliveryPeriodic($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPeriodicPlan object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPeriodicPlan The associated ChildPeriodicPlan object.
     * @throws PropelException
     */
    public function getPeriodicPlan(ConnectionInterface $con = null)
    {
        if ($this->aPeriodicPlan === null && ($this->delivery_periodic_plan_id !== null)) {
            $this->aPeriodicPlan = ChildPeriodicPlanQuery::create()->findPk($this->delivery_periodic_plan_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPeriodicPlan->addDeliveryPeriodics($this);
             */
        }

        return $this->aPeriodicPlan;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aDelivery) {
            $this->aDelivery->removeDeliveryPeriodic($this);
        }
        if (null !== $this->aPeriodicPlan) {
            $this->aPeriodicPlan->removeDeliveryPeriodic($this);
        }
        $this->delivery_periodic_id = null;
        $this->delivery_id = null;
        $this->delivery_periodic_plan_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->sortable_rank = null;
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
        } // if ($deep)

        $this->aDelivery = null;
        $this->aPeriodicPlan = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DeliveryPeriodicTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildDeliveryPeriodic The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[DeliveryPeriodicTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // sortable behavior

    /**
     * Wrap the getter for rank value
     *
     * @return    int
     */
    public function getRank()
    {
        return $this->sortable_rank;
    }

    /**
     * Wrap the setter for rank value
     *
     * @param     int
     * @return    $this|ChildDeliveryPeriodic
     */
    public function setRank($v)
    {
        return $this->setSortableRank($v);
    }

    /**
     * Wrap the getter for scope value
     *
     * @param boolean $returnNulls If true and all scope values are null, this will return null instead of a array full with nulls
     *
     * @return    mixed A array or a native type
     */
    public function getScopeValue($returnNulls = true)
    {


        return $this->getDeliveryPeriodicPlanId();

    }

    /**
     * Wrap the setter for scope value
     *
     * @param     mixed A array or a native type
     * @return    $this|ChildDeliveryPeriodic
     */
    public function setScopeValue($v)
    {


        return $this->setDeliveryPeriodicPlanId($v);

    }

    /**
     * Check if the object is first in the list, i.e. if it has 1 for rank
     *
     * @return    boolean
     */
    public function isFirst()
    {
        return $this->getSortableRank() == 1;
    }

    /**
     * Check if the object is last in the list, i.e. if its rank is the highest rank
     *
     * @param     ConnectionInterface  $con      optional connection
     *
     * @return    boolean
     */
    public function isLast(ConnectionInterface $con = null)
    {
        return $this->getSortableRank() == ChildDeliveryPeriodicQuery::create()->getMaxRankArray($this->getScopeValue(), $con);
    }

    /**
     * Get the next item in the list, i.e. the one for which rank is immediately higher
     *
     * @param     ConnectionInterface  $con      optional connection
     *
     * @return    ChildDeliveryPeriodic
     */
    public function getNext(ConnectionInterface $con = null)
    {

        $query = ChildDeliveryPeriodicQuery::create();

        $scope = $this->getScopeValue();

        $query->filterByRank($this->getSortableRank() + 1, $scope);


        return $query->findOne($con);
    }

    /**
     * Get the previous item in the list, i.e. the one for which rank is immediately lower
     *
     * @param     ConnectionInterface  $con      optional connection
     *
     * @return    ChildDeliveryPeriodic
     */
    public function getPrevious(ConnectionInterface $con = null)
    {

        $query = ChildDeliveryPeriodicQuery::create();

        $scope = $this->getScopeValue();

        $query->filterByRank($this->getSortableRank() - 1, $scope);


        return $query->findOne($con);
    }

    /**
     * Insert at specified rank
     * The modifications are not persisted until the object is saved.
     *
     * @param     integer    $rank rank value
     * @param     ConnectionInterface  $con      optional connection
     *
     * @return    $this|ChildDeliveryPeriodic the current object
     *
     * @throws    PropelException
     */
    public function insertAtRank($rank, ConnectionInterface $con = null)
    {
        $maxRank = ChildDeliveryPeriodicQuery::create()->getMaxRankArray($this->getScopeValue(), $con);
        if ($rank < 1 || $rank > $maxRank + 1) {
            throw new PropelException('Invalid rank ' . $rank);
        }
        // move the object in the list, at the given rank
        $this->setSortableRank($rank);
        if ($rank != $maxRank + 1) {
            // Keep the list modification query for the save() transaction
            $this->sortableQueries []= array(
                'callable'  => array('\App\Propel\DeliveryPeriodicQuery', 'sortableShiftRank'),
                'arguments' => array(1, $rank, null, $this->getScopeValue())
            );
        }

        return $this;
    }

    /**
     * Insert in the last rank
     * The modifications are not persisted until the object is saved.
     *
     * @param ConnectionInterface $con optional connection
     *
     * @return    $this|ChildDeliveryPeriodic the current object
     *
     * @throws    PropelException
     */
    public function insertAtBottom(ConnectionInterface $con = null)
    {
        $this->setSortableRank(ChildDeliveryPeriodicQuery::create()->getMaxRankArray($this->getScopeValue(), $con) + 1);

        return $this;
    }

    /**
     * Insert in the first rank
     * The modifications are not persisted until the object is saved.
     *
     * @return    $this|ChildDeliveryPeriodic the current object
     */
    public function insertAtTop()
    {
        return $this->insertAtRank(1);
    }

    /**
     * Move the object to a new rank, and shifts the rank
     * Of the objects inbetween the old and new rank accordingly
     *
     * @param     integer   $newRank rank value
     * @param     ConnectionInterface $con optional connection
     *
     * @return    $this|ChildDeliveryPeriodic the current object
     *
     * @throws    PropelException
     */
    public function moveToRank($newRank, ConnectionInterface $con = null)
    {
        if ($this->isNew()) {
            throw new PropelException('New objects cannot be moved. Please use insertAtRank() instead');
        }
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }
        if ($newRank < 1 || $newRank > ChildDeliveryPeriodicQuery::create()->getMaxRankArray($this->getScopeValue(), $con)) {
            throw new PropelException('Invalid rank ' . $newRank);
        }

        $oldRank = $this->getSortableRank();
        if ($oldRank == $newRank) {
            return $this;
        }

        $con->transaction(function () use ($con, $oldRank, $newRank) {
            // shift the objects between the old and the new rank
            $delta = ($oldRank < $newRank) ? -1 : 1;
            ChildDeliveryPeriodicQuery::sortableShiftRank($delta, min($oldRank, $newRank), max($oldRank, $newRank), $this->getScopeValue(), $con);

            // move the object to its new rank
            $this->setSortableRank($newRank);
            $this->save($con);
        });

        return $this;
    }

    /**
     * Exchange the rank of the object with the one passed as argument, and saves both objects
     *
     * @param     ChildDeliveryPeriodic $object
     * @param     ConnectionInterface $con optional connection
     *
     * @return    $this|ChildDeliveryPeriodic the current object
     *
     * @throws Exception if the database cannot execute the two updates
     */
    public function swapWith($object, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }
        $con->transaction(function () use ($con, $object) {
            $oldScope = $this->getScopeValue();
            $newScope = $object->getScopeValue();
            if ($oldScope != $newScope) {
                $this->setScopeValue($newScope);
                $object->setScopeValue($oldScope);
            }
            $oldRank = $this->getSortableRank();
            $newRank = $object->getSortableRank();

            $this->setSortableRank($newRank);
            $object->setSortableRank($oldRank);

            $this->save($con);
            $object->save($con);
        });

        return $this;
    }

    /**
     * Move the object higher in the list, i.e. exchanges its rank with the one of the previous object
     *
     * @param     ConnectionInterface $con optional connection
     *
     * @return    $this|ChildDeliveryPeriodic the current object
     */
    public function moveUp(ConnectionInterface $con = null)
    {
        if ($this->isFirst()) {
            return $this;
        }
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }
        $con->transaction(function () use ($con) {
            $prev = $this->getPrevious($con);
            $this->swapWith($prev, $con);
        });

        return $this;
    }

    /**
     * Move the object higher in the list, i.e. exchanges its rank with the one of the next object
     *
     * @param     ConnectionInterface $con optional connection
     *
     * @return    $this|ChildDeliveryPeriodic the current object
     */
    public function moveDown(ConnectionInterface $con = null)
    {
        if ($this->isLast($con)) {
            return $this;
        }
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }
        $con->transaction(function () use ($con) {
            $next = $this->getNext($con);
            $this->swapWith($next, $con);
        });

        return $this;
    }

    /**
     * Move the object to the top of the list
     *
     * @param     ConnectionInterface $con optional connection
     *
     * @return    $this|ChildDeliveryPeriodic the current object
     */
    public function moveToTop(ConnectionInterface $con = null)
    {
        if ($this->isFirst()) {
            return $this;
        }

        return $this->moveToRank(1, $con);
    }

    /**
     * Move the object to the bottom of the list
     *
     * @param     ConnectionInterface $con optional connection
     *
     * @return integer the old object's rank
     */
    public function moveToBottom(ConnectionInterface $con = null)
    {
        if ($this->isLast($con)) {
            return false;
        }
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $bottom = ChildDeliveryPeriodicQuery::create()->getMaxRankArray($this->getScopeValue(), $con);

            return $this->moveToRank($bottom, $con);
        });
    }

    /**
     * Removes the current object from the list (moves it to the null scope).
     * The modifications are not persisted until the object is saved.
     *
     * @return    $this|ChildDeliveryPeriodic the current object
     */
    public function removeFromList()
    {
        // check if object is already removed
        if ($this->getScopeValue() === null) {
            throw new PropelException('Object is already removed (has null scope)');
        }

        // move the object to the end of null scope
        $this->setScopeValue(null);

        return $this;
    }

    /**
     * Execute queries that were saved to be run inside the save transaction
     */
    protected function processSortableQueries($con)
    {
        foreach ($this->sortableQueries as $query) {
            $query['arguments'][]= $con;
            call_user_func_array($query['callable'], $query['arguments']);
        }
        $this->sortableQueries = array();
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
