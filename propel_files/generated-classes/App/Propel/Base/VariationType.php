<?php

namespace App\Propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Propel\ProductVariationType as ChildProductVariationType;
use App\Propel\ProductVariationTypeQuery as ChildProductVariationTypeQuery;
use App\Propel\Variation as ChildVariation;
use App\Propel\VariationQuery as ChildVariationQuery;
use App\Propel\VariationType as ChildVariationType;
use App\Propel\VariationTypeI18n as ChildVariationTypeI18n;
use App\Propel\VariationTypeI18nQuery as ChildVariationTypeI18nQuery;
use App\Propel\VariationTypeQuery as ChildVariationTypeQuery;
use App\Propel\Map\ProductVariationTypeTableMap;
use App\Propel\Map\VariationTableMap;
use App\Propel\Map\VariationTypeI18nTableMap;
use App\Propel\Map\VariationTypeTableMap;
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
 * Base class that represents a row from the 'variation_type' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class VariationType implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\VariationTypeTableMap';


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
     * The value for the variation_type_id field.
     *
     * @var        int
     */
    protected $variation_type_id;

    /**
     * The value for the variation_type_is_general field.
     *
     * @var        boolean
     */
    protected $variation_type_is_general;

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
     * @var        ObjectCollection|ChildProductVariationType[] Collection to store aggregation of ChildProductVariationType objects.
     */
    protected $collProductVariationTypes;
    protected $collProductVariationTypesPartial;

    /**
     * @var        ObjectCollection|ChildVariation[] Collection to store aggregation of ChildVariation objects.
     */
    protected $collVariations;
    protected $collVariationsPartial;

    /**
     * @var        ObjectCollection|ChildVariationTypeI18n[] Collection to store aggregation of ChildVariationTypeI18n objects.
     */
    protected $collVariationTypeI18ns;
    protected $collVariationTypeI18nsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'en_US';

    /**
     * Current translation objects
     * @var        array[ChildVariationTypeI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductVariationType[]
     */
    protected $productVariationTypesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVariation[]
     */
    protected $variationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVariationTypeI18n[]
     */
    protected $variationTypeI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Propel\Base\VariationType object.
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
     * Compares this with another <code>VariationType</code> instance.  If
     * <code>obj</code> is an instance of <code>VariationType</code>, delegates to
     * <code>equals(VariationType)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|VariationType The current object, for fluid interface
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
     * Get the [variation_type_id] column value.
     *
     * @return int
     */
    public function getVariationTypeId()
    {
        return $this->variation_type_id;
    }

    /**
     * Get the [variation_type_is_general] column value.
     *
     * @return boolean
     */
    public function getVariationTypeIsGeneral()
    {
        return $this->variation_type_is_general;
    }

    /**
     * Get the [variation_type_is_general] column value.
     *
     * @return boolean
     */
    public function isVariationTypeIsGeneral()
    {
        return $this->getVariationTypeIsGeneral();
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
     * Set the value of [variation_type_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\VariationType The current object (for fluent API support)
     */
    public function setVariationTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->variation_type_id !== $v) {
            $this->variation_type_id = $v;
            $this->modifiedColumns[VariationTypeTableMap::COL_VARIATION_TYPE_ID] = true;
        }

        return $this;
    } // setVariationTypeId()

    /**
     * Sets the value of the [variation_type_is_general] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\App\Propel\VariationType The current object (for fluent API support)
     */
    public function setVariationTypeIsGeneral($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->variation_type_is_general !== $v) {
            $this->variation_type_is_general = $v;
            $this->modifiedColumns[VariationTypeTableMap::COL_VARIATION_TYPE_IS_GENERAL] = true;
        }

        return $this;
    } // setVariationTypeIsGeneral()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\VariationType The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VariationTypeTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\VariationType The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VariationTypeTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VariationTypeTableMap::translateFieldName('VariationTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->variation_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VariationTypeTableMap::translateFieldName('VariationTypeIsGeneral', TableMap::TYPE_PHPNAME, $indexType)];
            $this->variation_type_is_general = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : VariationTypeTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : VariationTypeTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = VariationTypeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\VariationType'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(VariationTypeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVariationTypeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collProductVariationTypes = null;

            $this->collVariations = null;

            $this->collVariationTypeI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see VariationType::setDeleted()
     * @see VariationType::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VariationTypeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVariationTypeQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(VariationTypeTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(VariationTypeTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(VariationTypeTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(VariationTypeTableMap::COL_UPDATED_AT)) {
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
                VariationTypeTableMap::addInstanceToPool($this);
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

            if ($this->productVariationTypesScheduledForDeletion !== null) {
                if (!$this->productVariationTypesScheduledForDeletion->isEmpty()) {
                    \App\Propel\ProductVariationTypeQuery::create()
                        ->filterByPrimaryKeys($this->productVariationTypesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productVariationTypesScheduledForDeletion = null;
                }
            }

            if ($this->collProductVariationTypes !== null) {
                foreach ($this->collProductVariationTypes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->variationsScheduledForDeletion !== null) {
                if (!$this->variationsScheduledForDeletion->isEmpty()) {
                    \App\Propel\VariationQuery::create()
                        ->filterByPrimaryKeys($this->variationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->variationsScheduledForDeletion = null;
                }
            }

            if ($this->collVariations !== null) {
                foreach ($this->collVariations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->variationTypeI18nsScheduledForDeletion !== null) {
                if (!$this->variationTypeI18nsScheduledForDeletion->isEmpty()) {
                    \App\Propel\VariationTypeI18nQuery::create()
                        ->filterByPrimaryKeys($this->variationTypeI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->variationTypeI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collVariationTypeI18ns !== null) {
                foreach ($this->collVariationTypeI18ns as $referrerFK) {
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

        $this->modifiedColumns[VariationTypeTableMap::COL_VARIATION_TYPE_ID] = true;
        if (null !== $this->variation_type_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . VariationTypeTableMap::COL_VARIATION_TYPE_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VariationTypeTableMap::COL_VARIATION_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'variation_type_id';
        }
        if ($this->isColumnModified(VariationTypeTableMap::COL_VARIATION_TYPE_IS_GENERAL)) {
            $modifiedColumns[':p' . $index++]  = 'variation_type_is_general';
        }
        if ($this->isColumnModified(VariationTypeTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(VariationTypeTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO variation_type (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'variation_type_id':
                        $stmt->bindValue($identifier, $this->variation_type_id, PDO::PARAM_INT);
                        break;
                    case 'variation_type_is_general':
                        $stmt->bindValue($identifier, (int) $this->variation_type_is_general, PDO::PARAM_INT);
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
        $this->setVariationTypeId($pk);

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
        $pos = VariationTypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getVariationTypeId();
                break;
            case 1:
                return $this->getVariationTypeIsGeneral();
                break;
            case 2:
                return $this->getCreatedAt();
                break;
            case 3:
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

        if (isset($alreadyDumpedObjects['VariationType'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['VariationType'][$this->hashCode()] = true;
        $keys = VariationTypeTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getVariationTypeId(),
            $keys[1] => $this->getVariationTypeIsGeneral(),
            $keys[2] => $this->getCreatedAt(),
            $keys[3] => $this->getUpdatedAt(),
        );
        if ($result[$keys[2]] instanceof \DateTime) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        if ($result[$keys[3]] instanceof \DateTime) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collProductVariationTypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productVariationTypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_variation_types';
                        break;
                    default:
                        $key = 'ProductVariationTypes';
                }

                $result[$key] = $this->collProductVariationTypes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVariations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'variations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'variations';
                        break;
                    default:
                        $key = 'Variations';
                }

                $result[$key] = $this->collVariations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVariationTypeI18ns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'variationTypeI18ns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'variation_type_i18ns';
                        break;
                    default:
                        $key = 'VariationTypeI18ns';
                }

                $result[$key] = $this->collVariationTypeI18ns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Propel\VariationType
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VariationTypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\VariationType
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setVariationTypeId($value);
                break;
            case 1:
                $this->setVariationTypeIsGeneral($value);
                break;
            case 2:
                $this->setCreatedAt($value);
                break;
            case 3:
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
        $keys = VariationTypeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setVariationTypeId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setVariationTypeIsGeneral($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCreatedAt($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUpdatedAt($arr[$keys[3]]);
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
     * @return $this|\App\Propel\VariationType The current object, for fluid interface
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
        $criteria = new Criteria(VariationTypeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VariationTypeTableMap::COL_VARIATION_TYPE_ID)) {
            $criteria->add(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $this->variation_type_id);
        }
        if ($this->isColumnModified(VariationTypeTableMap::COL_VARIATION_TYPE_IS_GENERAL)) {
            $criteria->add(VariationTypeTableMap::COL_VARIATION_TYPE_IS_GENERAL, $this->variation_type_is_general);
        }
        if ($this->isColumnModified(VariationTypeTableMap::COL_CREATED_AT)) {
            $criteria->add(VariationTypeTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(VariationTypeTableMap::COL_UPDATED_AT)) {
            $criteria->add(VariationTypeTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildVariationTypeQuery::create();
        $criteria->add(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $this->variation_type_id);

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
        $validPk = null !== $this->getVariationTypeId();

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
        return $this->getVariationTypeId();
    }

    /**
     * Generic method to set the primary key (variation_type_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setVariationTypeId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getVariationTypeId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\VariationType (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setVariationTypeIsGeneral($this->getVariationTypeIsGeneral());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProductVariationTypes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductVariationType($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVariations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVariation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVariationTypeI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVariationTypeI18n($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setVariationTypeId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\VariationType Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ProductVariationType' == $relationName) {
            return $this->initProductVariationTypes();
        }
        if ('Variation' == $relationName) {
            return $this->initVariations();
        }
        if ('VariationTypeI18n' == $relationName) {
            return $this->initVariationTypeI18ns();
        }
    }

    /**
     * Clears out the collProductVariationTypes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductVariationTypes()
     */
    public function clearProductVariationTypes()
    {
        $this->collProductVariationTypes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductVariationTypes collection loaded partially.
     */
    public function resetPartialProductVariationTypes($v = true)
    {
        $this->collProductVariationTypesPartial = $v;
    }

    /**
     * Initializes the collProductVariationTypes collection.
     *
     * By default this just sets the collProductVariationTypes collection to an empty array (like clearcollProductVariationTypes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductVariationTypes($overrideExisting = true)
    {
        if (null !== $this->collProductVariationTypes && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductVariationTypeTableMap::getTableMap()->getCollectionClassName();

        $this->collProductVariationTypes = new $collectionClassName;
        $this->collProductVariationTypes->setModel('\App\Propel\ProductVariationType');
    }

    /**
     * Gets an array of ChildProductVariationType objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVariationType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductVariationType[] List of ChildProductVariationType objects
     * @throws PropelException
     */
    public function getProductVariationTypes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductVariationTypesPartial && !$this->isNew();
        if (null === $this->collProductVariationTypes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductVariationTypes) {
                // return empty collection
                $this->initProductVariationTypes();
            } else {
                $collProductVariationTypes = ChildProductVariationTypeQuery::create(null, $criteria)
                    ->filterByVariationType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductVariationTypesPartial && count($collProductVariationTypes)) {
                        $this->initProductVariationTypes(false);

                        foreach ($collProductVariationTypes as $obj) {
                            if (false == $this->collProductVariationTypes->contains($obj)) {
                                $this->collProductVariationTypes->append($obj);
                            }
                        }

                        $this->collProductVariationTypesPartial = true;
                    }

                    return $collProductVariationTypes;
                }

                if ($partial && $this->collProductVariationTypes) {
                    foreach ($this->collProductVariationTypes as $obj) {
                        if ($obj->isNew()) {
                            $collProductVariationTypes[] = $obj;
                        }
                    }
                }

                $this->collProductVariationTypes = $collProductVariationTypes;
                $this->collProductVariationTypesPartial = false;
            }
        }

        return $this->collProductVariationTypes;
    }

    /**
     * Sets a collection of ChildProductVariationType objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productVariationTypes A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildVariationType The current object (for fluent API support)
     */
    public function setProductVariationTypes(Collection $productVariationTypes, ConnectionInterface $con = null)
    {
        /** @var ChildProductVariationType[] $productVariationTypesToDelete */
        $productVariationTypesToDelete = $this->getProductVariationTypes(new Criteria(), $con)->diff($productVariationTypes);


        $this->productVariationTypesScheduledForDeletion = $productVariationTypesToDelete;

        foreach ($productVariationTypesToDelete as $productVariationTypeRemoved) {
            $productVariationTypeRemoved->setVariationType(null);
        }

        $this->collProductVariationTypes = null;
        foreach ($productVariationTypes as $productVariationType) {
            $this->addProductVariationType($productVariationType);
        }

        $this->collProductVariationTypes = $productVariationTypes;
        $this->collProductVariationTypesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductVariationType objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductVariationType objects.
     * @throws PropelException
     */
    public function countProductVariationTypes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductVariationTypesPartial && !$this->isNew();
        if (null === $this->collProductVariationTypes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductVariationTypes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductVariationTypes());
            }

            $query = ChildProductVariationTypeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVariationType($this)
                ->count($con);
        }

        return count($this->collProductVariationTypes);
    }

    /**
     * Method called to associate a ChildProductVariationType object to this object
     * through the ChildProductVariationType foreign key attribute.
     *
     * @param  ChildProductVariationType $l ChildProductVariationType
     * @return $this|\App\Propel\VariationType The current object (for fluent API support)
     */
    public function addProductVariationType(ChildProductVariationType $l)
    {
        if ($this->collProductVariationTypes === null) {
            $this->initProductVariationTypes();
            $this->collProductVariationTypesPartial = true;
        }

        if (!$this->collProductVariationTypes->contains($l)) {
            $this->doAddProductVariationType($l);

            if ($this->productVariationTypesScheduledForDeletion and $this->productVariationTypesScheduledForDeletion->contains($l)) {
                $this->productVariationTypesScheduledForDeletion->remove($this->productVariationTypesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductVariationType $productVariationType The ChildProductVariationType object to add.
     */
    protected function doAddProductVariationType(ChildProductVariationType $productVariationType)
    {
        $this->collProductVariationTypes[]= $productVariationType;
        $productVariationType->setVariationType($this);
    }

    /**
     * @param  ChildProductVariationType $productVariationType The ChildProductVariationType object to remove.
     * @return $this|ChildVariationType The current object (for fluent API support)
     */
    public function removeProductVariationType(ChildProductVariationType $productVariationType)
    {
        if ($this->getProductVariationTypes()->contains($productVariationType)) {
            $pos = $this->collProductVariationTypes->search($productVariationType);
            $this->collProductVariationTypes->remove($pos);
            if (null === $this->productVariationTypesScheduledForDeletion) {
                $this->productVariationTypesScheduledForDeletion = clone $this->collProductVariationTypes;
                $this->productVariationTypesScheduledForDeletion->clear();
            }
            $this->productVariationTypesScheduledForDeletion[]= clone $productVariationType;
            $productVariationType->setVariationType(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this VariationType is new, it will return
     * an empty collection; or if this VariationType has previously
     * been saved, it will retrieve related ProductVariationTypes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in VariationType.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductVariationType[] List of ChildProductVariationType objects
     */
    public function getProductVariationTypesJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductVariationTypeQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getProductVariationTypes($query, $con);
    }

    /**
     * Clears out the collVariations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVariations()
     */
    public function clearVariations()
    {
        $this->collVariations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVariations collection loaded partially.
     */
    public function resetPartialVariations($v = true)
    {
        $this->collVariationsPartial = $v;
    }

    /**
     * Initializes the collVariations collection.
     *
     * By default this just sets the collVariations collection to an empty array (like clearcollVariations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVariations($overrideExisting = true)
    {
        if (null !== $this->collVariations && !$overrideExisting) {
            return;
        }

        $collectionClassName = VariationTableMap::getTableMap()->getCollectionClassName();

        $this->collVariations = new $collectionClassName;
        $this->collVariations->setModel('\App\Propel\Variation');
    }

    /**
     * Gets an array of ChildVariation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVariationType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVariation[] List of ChildVariation objects
     * @throws PropelException
     */
    public function getVariations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVariationsPartial && !$this->isNew();
        if (null === $this->collVariations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVariations) {
                // return empty collection
                $this->initVariations();
            } else {
                $collVariations = ChildVariationQuery::create(null, $criteria)
                    ->filterByVariationType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVariationsPartial && count($collVariations)) {
                        $this->initVariations(false);

                        foreach ($collVariations as $obj) {
                            if (false == $this->collVariations->contains($obj)) {
                                $this->collVariations->append($obj);
                            }
                        }

                        $this->collVariationsPartial = true;
                    }

                    return $collVariations;
                }

                if ($partial && $this->collVariations) {
                    foreach ($this->collVariations as $obj) {
                        if ($obj->isNew()) {
                            $collVariations[] = $obj;
                        }
                    }
                }

                $this->collVariations = $collVariations;
                $this->collVariationsPartial = false;
            }
        }

        return $this->collVariations;
    }

    /**
     * Sets a collection of ChildVariation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $variations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildVariationType The current object (for fluent API support)
     */
    public function setVariations(Collection $variations, ConnectionInterface $con = null)
    {
        /** @var ChildVariation[] $variationsToDelete */
        $variationsToDelete = $this->getVariations(new Criteria(), $con)->diff($variations);


        $this->variationsScheduledForDeletion = $variationsToDelete;

        foreach ($variationsToDelete as $variationRemoved) {
            $variationRemoved->setVariationType(null);
        }

        $this->collVariations = null;
        foreach ($variations as $variation) {
            $this->addVariation($variation);
        }

        $this->collVariations = $variations;
        $this->collVariationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Variation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Variation objects.
     * @throws PropelException
     */
    public function countVariations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVariationsPartial && !$this->isNew();
        if (null === $this->collVariations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVariations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVariations());
            }

            $query = ChildVariationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVariationType($this)
                ->count($con);
        }

        return count($this->collVariations);
    }

    /**
     * Method called to associate a ChildVariation object to this object
     * through the ChildVariation foreign key attribute.
     *
     * @param  ChildVariation $l ChildVariation
     * @return $this|\App\Propel\VariationType The current object (for fluent API support)
     */
    public function addVariation(ChildVariation $l)
    {
        if ($this->collVariations === null) {
            $this->initVariations();
            $this->collVariationsPartial = true;
        }

        if (!$this->collVariations->contains($l)) {
            $this->doAddVariation($l);

            if ($this->variationsScheduledForDeletion and $this->variationsScheduledForDeletion->contains($l)) {
                $this->variationsScheduledForDeletion->remove($this->variationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVariation $variation The ChildVariation object to add.
     */
    protected function doAddVariation(ChildVariation $variation)
    {
        $this->collVariations[]= $variation;
        $variation->setVariationType($this);
    }

    /**
     * @param  ChildVariation $variation The ChildVariation object to remove.
     * @return $this|ChildVariationType The current object (for fluent API support)
     */
    public function removeVariation(ChildVariation $variation)
    {
        if ($this->getVariations()->contains($variation)) {
            $pos = $this->collVariations->search($variation);
            $this->collVariations->remove($pos);
            if (null === $this->variationsScheduledForDeletion) {
                $this->variationsScheduledForDeletion = clone $this->collVariations;
                $this->variationsScheduledForDeletion->clear();
            }
            $this->variationsScheduledForDeletion[]= clone $variation;
            $variation->setVariationType(null);
        }

        return $this;
    }

    /**
     * Clears out the collVariationTypeI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVariationTypeI18ns()
     */
    public function clearVariationTypeI18ns()
    {
        $this->collVariationTypeI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVariationTypeI18ns collection loaded partially.
     */
    public function resetPartialVariationTypeI18ns($v = true)
    {
        $this->collVariationTypeI18nsPartial = $v;
    }

    /**
     * Initializes the collVariationTypeI18ns collection.
     *
     * By default this just sets the collVariationTypeI18ns collection to an empty array (like clearcollVariationTypeI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVariationTypeI18ns($overrideExisting = true)
    {
        if (null !== $this->collVariationTypeI18ns && !$overrideExisting) {
            return;
        }

        $collectionClassName = VariationTypeI18nTableMap::getTableMap()->getCollectionClassName();

        $this->collVariationTypeI18ns = new $collectionClassName;
        $this->collVariationTypeI18ns->setModel('\App\Propel\VariationTypeI18n');
    }

    /**
     * Gets an array of ChildVariationTypeI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVariationType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVariationTypeI18n[] List of ChildVariationTypeI18n objects
     * @throws PropelException
     */
    public function getVariationTypeI18ns(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVariationTypeI18nsPartial && !$this->isNew();
        if (null === $this->collVariationTypeI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVariationTypeI18ns) {
                // return empty collection
                $this->initVariationTypeI18ns();
            } else {
                $collVariationTypeI18ns = ChildVariationTypeI18nQuery::create(null, $criteria)
                    ->filterByVariationType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVariationTypeI18nsPartial && count($collVariationTypeI18ns)) {
                        $this->initVariationTypeI18ns(false);

                        foreach ($collVariationTypeI18ns as $obj) {
                            if (false == $this->collVariationTypeI18ns->contains($obj)) {
                                $this->collVariationTypeI18ns->append($obj);
                            }
                        }

                        $this->collVariationTypeI18nsPartial = true;
                    }

                    return $collVariationTypeI18ns;
                }

                if ($partial && $this->collVariationTypeI18ns) {
                    foreach ($this->collVariationTypeI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collVariationTypeI18ns[] = $obj;
                        }
                    }
                }

                $this->collVariationTypeI18ns = $collVariationTypeI18ns;
                $this->collVariationTypeI18nsPartial = false;
            }
        }

        return $this->collVariationTypeI18ns;
    }

    /**
     * Sets a collection of ChildVariationTypeI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $variationTypeI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildVariationType The current object (for fluent API support)
     */
    public function setVariationTypeI18ns(Collection $variationTypeI18ns, ConnectionInterface $con = null)
    {
        /** @var ChildVariationTypeI18n[] $variationTypeI18nsToDelete */
        $variationTypeI18nsToDelete = $this->getVariationTypeI18ns(new Criteria(), $con)->diff($variationTypeI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->variationTypeI18nsScheduledForDeletion = clone $variationTypeI18nsToDelete;

        foreach ($variationTypeI18nsToDelete as $variationTypeI18nRemoved) {
            $variationTypeI18nRemoved->setVariationType(null);
        }

        $this->collVariationTypeI18ns = null;
        foreach ($variationTypeI18ns as $variationTypeI18n) {
            $this->addVariationTypeI18n($variationTypeI18n);
        }

        $this->collVariationTypeI18ns = $variationTypeI18ns;
        $this->collVariationTypeI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related VariationTypeI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related VariationTypeI18n objects.
     * @throws PropelException
     */
    public function countVariationTypeI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVariationTypeI18nsPartial && !$this->isNew();
        if (null === $this->collVariationTypeI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVariationTypeI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVariationTypeI18ns());
            }

            $query = ChildVariationTypeI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVariationType($this)
                ->count($con);
        }

        return count($this->collVariationTypeI18ns);
    }

    /**
     * Method called to associate a ChildVariationTypeI18n object to this object
     * through the ChildVariationTypeI18n foreign key attribute.
     *
     * @param  ChildVariationTypeI18n $l ChildVariationTypeI18n
     * @return $this|\App\Propel\VariationType The current object (for fluent API support)
     */
    public function addVariationTypeI18n(ChildVariationTypeI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collVariationTypeI18ns === null) {
            $this->initVariationTypeI18ns();
            $this->collVariationTypeI18nsPartial = true;
        }

        if (!$this->collVariationTypeI18ns->contains($l)) {
            $this->doAddVariationTypeI18n($l);

            if ($this->variationTypeI18nsScheduledForDeletion and $this->variationTypeI18nsScheduledForDeletion->contains($l)) {
                $this->variationTypeI18nsScheduledForDeletion->remove($this->variationTypeI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVariationTypeI18n $variationTypeI18n The ChildVariationTypeI18n object to add.
     */
    protected function doAddVariationTypeI18n(ChildVariationTypeI18n $variationTypeI18n)
    {
        $this->collVariationTypeI18ns[]= $variationTypeI18n;
        $variationTypeI18n->setVariationType($this);
    }

    /**
     * @param  ChildVariationTypeI18n $variationTypeI18n The ChildVariationTypeI18n object to remove.
     * @return $this|ChildVariationType The current object (for fluent API support)
     */
    public function removeVariationTypeI18n(ChildVariationTypeI18n $variationTypeI18n)
    {
        if ($this->getVariationTypeI18ns()->contains($variationTypeI18n)) {
            $pos = $this->collVariationTypeI18ns->search($variationTypeI18n);
            $this->collVariationTypeI18ns->remove($pos);
            if (null === $this->variationTypeI18nsScheduledForDeletion) {
                $this->variationTypeI18nsScheduledForDeletion = clone $this->collVariationTypeI18ns;
                $this->variationTypeI18nsScheduledForDeletion->clear();
            }
            $this->variationTypeI18nsScheduledForDeletion[]= clone $variationTypeI18n;
            $variationTypeI18n->setVariationType(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->variation_type_id = null;
        $this->variation_type_is_general = null;
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
            if ($this->collProductVariationTypes) {
                foreach ($this->collProductVariationTypes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVariations) {
                foreach ($this->collVariations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVariationTypeI18ns) {
                foreach ($this->collVariationTypeI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collProductVariationTypes = null;
        $this->collVariations = null;
        $this->collVariationTypeI18ns = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VariationTypeTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    $this|ChildVariationType The current object (for fluent API support)
     */
    public function setLocale($locale = 'en_US')
    {
        $this->currentLocale = $locale;

        return $this;
    }

    /**
     * Gets the locale for translations
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getLocale()
    {
        return $this->currentLocale;
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildVariationTypeI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collVariationTypeI18ns) {
                foreach ($this->collVariationTypeI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildVariationTypeI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildVariationTypeI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addVariationTypeI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    $this|ChildVariationType The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildVariationTypeI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collVariationTypeI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collVariationTypeI18ns[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Returns the current translation
     *
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ChildVariationTypeI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [variation_type_name] column value.
         *
         * @return string
         */
        public function getVariationTypeName()
        {
        return $this->getCurrentTranslation()->getVariationTypeName();
    }


        /**
         * Set the value of [variation_type_name] column.
         *
         * @param string $v new value
         * @return $this|\App\Propel\VariationTypeI18n The current object (for fluent API support)
         */
        public function setVariationTypeName($v)
        {    $this->getCurrentTranslation()->setVariationTypeName($v);

        return $this;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildVariationType The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[VariationTypeTableMap::COL_UPDATED_AT] = true;

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
