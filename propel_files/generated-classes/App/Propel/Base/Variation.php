<?php

namespace App\Propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Propel\ProductVariation as ChildProductVariation;
use App\Propel\ProductVariationQuery as ChildProductVariationQuery;
use App\Propel\Variation as ChildVariation;
use App\Propel\VariationI18n as ChildVariationI18n;
use App\Propel\VariationI18nQuery as ChildVariationI18nQuery;
use App\Propel\VariationQuery as ChildVariationQuery;
use App\Propel\VariationType as ChildVariationType;
use App\Propel\VariationTypeQuery as ChildVariationTypeQuery;
use App\Propel\Map\ProductVariationTableMap;
use App\Propel\Map\VariationI18nTableMap;
use App\Propel\Map\VariationTableMap;
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
 * Base class that represents a row from the 'variation' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class Variation implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\VariationTableMap';


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
     * The value for the variation_id field.
     *
     * @var        int
     */
    protected $variation_id;

    /**
     * The value for the variation_type_id field.
     *
     * @var        int
     */
    protected $variation_type_id;

    /**
     * The value for the variation_is_general field.
     *
     * @var        boolean
     */
    protected $variation_is_general;

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
     * @var        ChildVariationType
     */
    protected $aVariationType;

    /**
     * @var        ObjectCollection|ChildProductVariation[] Collection to store aggregation of ChildProductVariation objects.
     */
    protected $collProductVariations;
    protected $collProductVariationsPartial;

    /**
     * @var        ObjectCollection|ChildVariationI18n[] Collection to store aggregation of ChildVariationI18n objects.
     */
    protected $collVariationI18ns;
    protected $collVariationI18nsPartial;

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
     * @var        array[ChildVariationI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductVariation[]
     */
    protected $productVariationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVariationI18n[]
     */
    protected $variationI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Propel\Base\Variation object.
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
     * Compares this with another <code>Variation</code> instance.  If
     * <code>obj</code> is an instance of <code>Variation</code>, delegates to
     * <code>equals(Variation)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Variation The current object, for fluid interface
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
     * Get the [variation_id] column value.
     *
     * @return int
     */
    public function getVariationId()
    {
        return $this->variation_id;
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
     * Get the [variation_is_general] column value.
     *
     * @return boolean
     */
    public function getVariationIsGeneral()
    {
        return $this->variation_is_general;
    }

    /**
     * Get the [variation_is_general] column value.
     *
     * @return boolean
     */
    public function isVariationIsGeneral()
    {
        return $this->getVariationIsGeneral();
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
     * Set the value of [variation_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Variation The current object (for fluent API support)
     */
    public function setVariationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->variation_id !== $v) {
            $this->variation_id = $v;
            $this->modifiedColumns[VariationTableMap::COL_VARIATION_ID] = true;
        }

        return $this;
    } // setVariationId()

    /**
     * Set the value of [variation_type_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Variation The current object (for fluent API support)
     */
    public function setVariationTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->variation_type_id !== $v) {
            $this->variation_type_id = $v;
            $this->modifiedColumns[VariationTableMap::COL_VARIATION_TYPE_ID] = true;
        }

        if ($this->aVariationType !== null && $this->aVariationType->getVariationTypeId() !== $v) {
            $this->aVariationType = null;
        }

        return $this;
    } // setVariationTypeId()

    /**
     * Sets the value of the [variation_is_general] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\App\Propel\Variation The current object (for fluent API support)
     */
    public function setVariationIsGeneral($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->variation_is_general !== $v) {
            $this->variation_is_general = $v;
            $this->modifiedColumns[VariationTableMap::COL_VARIATION_IS_GENERAL] = true;
        }

        return $this;
    } // setVariationIsGeneral()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\Variation The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VariationTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\Variation The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VariationTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VariationTableMap::translateFieldName('VariationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->variation_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VariationTableMap::translateFieldName('VariationTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->variation_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : VariationTableMap::translateFieldName('VariationIsGeneral', TableMap::TYPE_PHPNAME, $indexType)];
            $this->variation_is_general = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : VariationTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : VariationTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = VariationTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\Variation'), 0, $e);
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
        if ($this->aVariationType !== null && $this->variation_type_id !== $this->aVariationType->getVariationTypeId()) {
            $this->aVariationType = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(VariationTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVariationQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aVariationType = null;
            $this->collProductVariations = null;

            $this->collVariationI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Variation::setDeleted()
     * @see Variation::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VariationTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVariationQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(VariationTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(VariationTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(VariationTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(VariationTableMap::COL_UPDATED_AT)) {
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
                VariationTableMap::addInstanceToPool($this);
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

            if ($this->aVariationType !== null) {
                if ($this->aVariationType->isModified() || $this->aVariationType->isNew()) {
                    $affectedRows += $this->aVariationType->save($con);
                }
                $this->setVariationType($this->aVariationType);
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

            if ($this->productVariationsScheduledForDeletion !== null) {
                if (!$this->productVariationsScheduledForDeletion->isEmpty()) {
                    \App\Propel\ProductVariationQuery::create()
                        ->filterByPrimaryKeys($this->productVariationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productVariationsScheduledForDeletion = null;
                }
            }

            if ($this->collProductVariations !== null) {
                foreach ($this->collProductVariations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->variationI18nsScheduledForDeletion !== null) {
                if (!$this->variationI18nsScheduledForDeletion->isEmpty()) {
                    \App\Propel\VariationI18nQuery::create()
                        ->filterByPrimaryKeys($this->variationI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->variationI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collVariationI18ns !== null) {
                foreach ($this->collVariationI18ns as $referrerFK) {
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

        $this->modifiedColumns[VariationTableMap::COL_VARIATION_ID] = true;
        if (null !== $this->variation_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . VariationTableMap::COL_VARIATION_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VariationTableMap::COL_VARIATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'variation_id';
        }
        if ($this->isColumnModified(VariationTableMap::COL_VARIATION_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'variation_type_id';
        }
        if ($this->isColumnModified(VariationTableMap::COL_VARIATION_IS_GENERAL)) {
            $modifiedColumns[':p' . $index++]  = 'variation_is_general';
        }
        if ($this->isColumnModified(VariationTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(VariationTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO variation (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'variation_id':
                        $stmt->bindValue($identifier, $this->variation_id, PDO::PARAM_INT);
                        break;
                    case 'variation_type_id':
                        $stmt->bindValue($identifier, $this->variation_type_id, PDO::PARAM_INT);
                        break;
                    case 'variation_is_general':
                        $stmt->bindValue($identifier, (int) $this->variation_is_general, PDO::PARAM_INT);
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
        $this->setVariationId($pk);

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
        $pos = VariationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getVariationId();
                break;
            case 1:
                return $this->getVariationTypeId();
                break;
            case 2:
                return $this->getVariationIsGeneral();
                break;
            case 3:
                return $this->getCreatedAt();
                break;
            case 4:
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

        if (isset($alreadyDumpedObjects['Variation'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Variation'][$this->hashCode()] = true;
        $keys = VariationTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getVariationId(),
            $keys[1] => $this->getVariationTypeId(),
            $keys[2] => $this->getVariationIsGeneral(),
            $keys[3] => $this->getCreatedAt(),
            $keys[4] => $this->getUpdatedAt(),
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
            if (null !== $this->aVariationType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'variationType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'variation_type';
                        break;
                    default:
                        $key = 'VariationType';
                }

                $result[$key] = $this->aVariationType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProductVariations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productVariations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_variations';
                        break;
                    default:
                        $key = 'ProductVariations';
                }

                $result[$key] = $this->collProductVariations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVariationI18ns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'variationI18ns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'variation_i18ns';
                        break;
                    default:
                        $key = 'VariationI18ns';
                }

                $result[$key] = $this->collVariationI18ns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Propel\Variation
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VariationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\Variation
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setVariationId($value);
                break;
            case 1:
                $this->setVariationTypeId($value);
                break;
            case 2:
                $this->setVariationIsGeneral($value);
                break;
            case 3:
                $this->setCreatedAt($value);
                break;
            case 4:
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
        $keys = VariationTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setVariationId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setVariationTypeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setVariationIsGeneral($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCreatedAt($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUpdatedAt($arr[$keys[4]]);
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
     * @return $this|\App\Propel\Variation The current object, for fluid interface
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
        $criteria = new Criteria(VariationTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VariationTableMap::COL_VARIATION_ID)) {
            $criteria->add(VariationTableMap::COL_VARIATION_ID, $this->variation_id);
        }
        if ($this->isColumnModified(VariationTableMap::COL_VARIATION_TYPE_ID)) {
            $criteria->add(VariationTableMap::COL_VARIATION_TYPE_ID, $this->variation_type_id);
        }
        if ($this->isColumnModified(VariationTableMap::COL_VARIATION_IS_GENERAL)) {
            $criteria->add(VariationTableMap::COL_VARIATION_IS_GENERAL, $this->variation_is_general);
        }
        if ($this->isColumnModified(VariationTableMap::COL_CREATED_AT)) {
            $criteria->add(VariationTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(VariationTableMap::COL_UPDATED_AT)) {
            $criteria->add(VariationTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildVariationQuery::create();
        $criteria->add(VariationTableMap::COL_VARIATION_ID, $this->variation_id);

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
        $validPk = null !== $this->getVariationId();

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
        return $this->getVariationId();
    }

    /**
     * Generic method to set the primary key (variation_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setVariationId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getVariationId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\Variation (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setVariationTypeId($this->getVariationTypeId());
        $copyObj->setVariationIsGeneral($this->getVariationIsGeneral());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProductVariations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductVariation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVariationI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVariationI18n($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setVariationId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\Variation Clone of current object.
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
     * Declares an association between this object and a ChildVariationType object.
     *
     * @param  ChildVariationType $v
     * @return $this|\App\Propel\Variation The current object (for fluent API support)
     * @throws PropelException
     */
    public function setVariationType(ChildVariationType $v = null)
    {
        if ($v === null) {
            $this->setVariationTypeId(NULL);
        } else {
            $this->setVariationTypeId($v->getVariationTypeId());
        }

        $this->aVariationType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildVariationType object, it will not be re-added.
        if ($v !== null) {
            $v->addVariation($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildVariationType object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildVariationType The associated ChildVariationType object.
     * @throws PropelException
     */
    public function getVariationType(ConnectionInterface $con = null)
    {
        if ($this->aVariationType === null && ($this->variation_type_id !== null)) {
            $this->aVariationType = ChildVariationTypeQuery::create()->findPk($this->variation_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVariationType->addVariations($this);
             */
        }

        return $this->aVariationType;
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
        if ('ProductVariation' == $relationName) {
            return $this->initProductVariations();
        }
        if ('VariationI18n' == $relationName) {
            return $this->initVariationI18ns();
        }
    }

    /**
     * Clears out the collProductVariations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductVariations()
     */
    public function clearProductVariations()
    {
        $this->collProductVariations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductVariations collection loaded partially.
     */
    public function resetPartialProductVariations($v = true)
    {
        $this->collProductVariationsPartial = $v;
    }

    /**
     * Initializes the collProductVariations collection.
     *
     * By default this just sets the collProductVariations collection to an empty array (like clearcollProductVariations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductVariations($overrideExisting = true)
    {
        if (null !== $this->collProductVariations && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductVariationTableMap::getTableMap()->getCollectionClassName();

        $this->collProductVariations = new $collectionClassName;
        $this->collProductVariations->setModel('\App\Propel\ProductVariation');
    }

    /**
     * Gets an array of ChildProductVariation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVariation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductVariation[] List of ChildProductVariation objects
     * @throws PropelException
     */
    public function getProductVariations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductVariationsPartial && !$this->isNew();
        if (null === $this->collProductVariations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductVariations) {
                // return empty collection
                $this->initProductVariations();
            } else {
                $collProductVariations = ChildProductVariationQuery::create(null, $criteria)
                    ->filterByVariation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductVariationsPartial && count($collProductVariations)) {
                        $this->initProductVariations(false);

                        foreach ($collProductVariations as $obj) {
                            if (false == $this->collProductVariations->contains($obj)) {
                                $this->collProductVariations->append($obj);
                            }
                        }

                        $this->collProductVariationsPartial = true;
                    }

                    return $collProductVariations;
                }

                if ($partial && $this->collProductVariations) {
                    foreach ($this->collProductVariations as $obj) {
                        if ($obj->isNew()) {
                            $collProductVariations[] = $obj;
                        }
                    }
                }

                $this->collProductVariations = $collProductVariations;
                $this->collProductVariationsPartial = false;
            }
        }

        return $this->collProductVariations;
    }

    /**
     * Sets a collection of ChildProductVariation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productVariations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildVariation The current object (for fluent API support)
     */
    public function setProductVariations(Collection $productVariations, ConnectionInterface $con = null)
    {
        /** @var ChildProductVariation[] $productVariationsToDelete */
        $productVariationsToDelete = $this->getProductVariations(new Criteria(), $con)->diff($productVariations);


        $this->productVariationsScheduledForDeletion = $productVariationsToDelete;

        foreach ($productVariationsToDelete as $productVariationRemoved) {
            $productVariationRemoved->setVariation(null);
        }

        $this->collProductVariations = null;
        foreach ($productVariations as $productVariation) {
            $this->addProductVariation($productVariation);
        }

        $this->collProductVariations = $productVariations;
        $this->collProductVariationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductVariation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductVariation objects.
     * @throws PropelException
     */
    public function countProductVariations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductVariationsPartial && !$this->isNew();
        if (null === $this->collProductVariations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductVariations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductVariations());
            }

            $query = ChildProductVariationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVariation($this)
                ->count($con);
        }

        return count($this->collProductVariations);
    }

    /**
     * Method called to associate a ChildProductVariation object to this object
     * through the ChildProductVariation foreign key attribute.
     *
     * @param  ChildProductVariation $l ChildProductVariation
     * @return $this|\App\Propel\Variation The current object (for fluent API support)
     */
    public function addProductVariation(ChildProductVariation $l)
    {
        if ($this->collProductVariations === null) {
            $this->initProductVariations();
            $this->collProductVariationsPartial = true;
        }

        if (!$this->collProductVariations->contains($l)) {
            $this->doAddProductVariation($l);

            if ($this->productVariationsScheduledForDeletion and $this->productVariationsScheduledForDeletion->contains($l)) {
                $this->productVariationsScheduledForDeletion->remove($this->productVariationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductVariation $productVariation The ChildProductVariation object to add.
     */
    protected function doAddProductVariation(ChildProductVariation $productVariation)
    {
        $this->collProductVariations[]= $productVariation;
        $productVariation->setVariation($this);
    }

    /**
     * @param  ChildProductVariation $productVariation The ChildProductVariation object to remove.
     * @return $this|ChildVariation The current object (for fluent API support)
     */
    public function removeProductVariation(ChildProductVariation $productVariation)
    {
        if ($this->getProductVariations()->contains($productVariation)) {
            $pos = $this->collProductVariations->search($productVariation);
            $this->collProductVariations->remove($pos);
            if (null === $this->productVariationsScheduledForDeletion) {
                $this->productVariationsScheduledForDeletion = clone $this->collProductVariations;
                $this->productVariationsScheduledForDeletion->clear();
            }
            $this->productVariationsScheduledForDeletion[]= clone $productVariation;
            $productVariation->setVariation(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Variation is new, it will return
     * an empty collection; or if this Variation has previously
     * been saved, it will retrieve related ProductVariations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Variation.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductVariation[] List of ChildProductVariation objects
     */
    public function getProductVariationsJoinProductVariationType(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductVariationQuery::create(null, $criteria);
        $query->joinWith('ProductVariationType', $joinBehavior);

        return $this->getProductVariations($query, $con);
    }

    /**
     * Clears out the collVariationI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVariationI18ns()
     */
    public function clearVariationI18ns()
    {
        $this->collVariationI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVariationI18ns collection loaded partially.
     */
    public function resetPartialVariationI18ns($v = true)
    {
        $this->collVariationI18nsPartial = $v;
    }

    /**
     * Initializes the collVariationI18ns collection.
     *
     * By default this just sets the collVariationI18ns collection to an empty array (like clearcollVariationI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVariationI18ns($overrideExisting = true)
    {
        if (null !== $this->collVariationI18ns && !$overrideExisting) {
            return;
        }

        $collectionClassName = VariationI18nTableMap::getTableMap()->getCollectionClassName();

        $this->collVariationI18ns = new $collectionClassName;
        $this->collVariationI18ns->setModel('\App\Propel\VariationI18n');
    }

    /**
     * Gets an array of ChildVariationI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVariation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVariationI18n[] List of ChildVariationI18n objects
     * @throws PropelException
     */
    public function getVariationI18ns(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVariationI18nsPartial && !$this->isNew();
        if (null === $this->collVariationI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVariationI18ns) {
                // return empty collection
                $this->initVariationI18ns();
            } else {
                $collVariationI18ns = ChildVariationI18nQuery::create(null, $criteria)
                    ->filterByVariation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVariationI18nsPartial && count($collVariationI18ns)) {
                        $this->initVariationI18ns(false);

                        foreach ($collVariationI18ns as $obj) {
                            if (false == $this->collVariationI18ns->contains($obj)) {
                                $this->collVariationI18ns->append($obj);
                            }
                        }

                        $this->collVariationI18nsPartial = true;
                    }

                    return $collVariationI18ns;
                }

                if ($partial && $this->collVariationI18ns) {
                    foreach ($this->collVariationI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collVariationI18ns[] = $obj;
                        }
                    }
                }

                $this->collVariationI18ns = $collVariationI18ns;
                $this->collVariationI18nsPartial = false;
            }
        }

        return $this->collVariationI18ns;
    }

    /**
     * Sets a collection of ChildVariationI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $variationI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildVariation The current object (for fluent API support)
     */
    public function setVariationI18ns(Collection $variationI18ns, ConnectionInterface $con = null)
    {
        /** @var ChildVariationI18n[] $variationI18nsToDelete */
        $variationI18nsToDelete = $this->getVariationI18ns(new Criteria(), $con)->diff($variationI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->variationI18nsScheduledForDeletion = clone $variationI18nsToDelete;

        foreach ($variationI18nsToDelete as $variationI18nRemoved) {
            $variationI18nRemoved->setVariation(null);
        }

        $this->collVariationI18ns = null;
        foreach ($variationI18ns as $variationI18n) {
            $this->addVariationI18n($variationI18n);
        }

        $this->collVariationI18ns = $variationI18ns;
        $this->collVariationI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related VariationI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related VariationI18n objects.
     * @throws PropelException
     */
    public function countVariationI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVariationI18nsPartial && !$this->isNew();
        if (null === $this->collVariationI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVariationI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVariationI18ns());
            }

            $query = ChildVariationI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVariation($this)
                ->count($con);
        }

        return count($this->collVariationI18ns);
    }

    /**
     * Method called to associate a ChildVariationI18n object to this object
     * through the ChildVariationI18n foreign key attribute.
     *
     * @param  ChildVariationI18n $l ChildVariationI18n
     * @return $this|\App\Propel\Variation The current object (for fluent API support)
     */
    public function addVariationI18n(ChildVariationI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collVariationI18ns === null) {
            $this->initVariationI18ns();
            $this->collVariationI18nsPartial = true;
        }

        if (!$this->collVariationI18ns->contains($l)) {
            $this->doAddVariationI18n($l);

            if ($this->variationI18nsScheduledForDeletion and $this->variationI18nsScheduledForDeletion->contains($l)) {
                $this->variationI18nsScheduledForDeletion->remove($this->variationI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVariationI18n $variationI18n The ChildVariationI18n object to add.
     */
    protected function doAddVariationI18n(ChildVariationI18n $variationI18n)
    {
        $this->collVariationI18ns[]= $variationI18n;
        $variationI18n->setVariation($this);
    }

    /**
     * @param  ChildVariationI18n $variationI18n The ChildVariationI18n object to remove.
     * @return $this|ChildVariation The current object (for fluent API support)
     */
    public function removeVariationI18n(ChildVariationI18n $variationI18n)
    {
        if ($this->getVariationI18ns()->contains($variationI18n)) {
            $pos = $this->collVariationI18ns->search($variationI18n);
            $this->collVariationI18ns->remove($pos);
            if (null === $this->variationI18nsScheduledForDeletion) {
                $this->variationI18nsScheduledForDeletion = clone $this->collVariationI18ns;
                $this->variationI18nsScheduledForDeletion->clear();
            }
            $this->variationI18nsScheduledForDeletion[]= clone $variationI18n;
            $variationI18n->setVariation(null);
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
        if (null !== $this->aVariationType) {
            $this->aVariationType->removeVariation($this);
        }
        $this->variation_id = null;
        $this->variation_type_id = null;
        $this->variation_is_general = null;
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
            if ($this->collProductVariations) {
                foreach ($this->collProductVariations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVariationI18ns) {
                foreach ($this->collVariationI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collProductVariations = null;
        $this->collVariationI18ns = null;
        $this->aVariationType = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VariationTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    $this|ChildVariation The current object (for fluent API support)
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
     * @return ChildVariationI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collVariationI18ns) {
                foreach ($this->collVariationI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildVariationI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildVariationI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addVariationI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    $this|ChildVariation The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildVariationI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collVariationI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collVariationI18ns[$key]);
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
     * @return ChildVariationI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [variation_name] column value.
         *
         * @return string
         */
        public function getVariationName()
        {
        return $this->getCurrentTranslation()->getVariationName();
    }


        /**
         * Set the value of [variation_name] column.
         *
         * @param string $v new value
         * @return $this|\App\Propel\VariationI18n The current object (for fluent API support)
         */
        public function setVariationName($v)
        {    $this->getCurrentTranslation()->setVariationName($v);

        return $this;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildVariation The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[VariationTableMap::COL_UPDATED_AT] = true;

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
