<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\PeriodicPlan as ChildPeriodicPlan;
use App\Propel\PeriodicPlanQuery as ChildPeriodicPlanQuery;
use App\Propel\PeriodicType as ChildPeriodicType;
use App\Propel\PeriodicTypeI18n as ChildPeriodicTypeI18n;
use App\Propel\PeriodicTypeI18nQuery as ChildPeriodicTypeI18nQuery;
use App\Propel\PeriodicTypeQuery as ChildPeriodicTypeQuery;
use App\Propel\Map\PeriodicPlanTableMap;
use App\Propel\Map\PeriodicTypeI18nTableMap;
use App\Propel\Map\PeriodicTypeTableMap;
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

/**
 * Base class that represents a row from the 'periodic_type' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class PeriodicType implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\PeriodicTypeTableMap';


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
     * The value for the periodic_type_id field.
     *
     * @var        int
     */
    protected $periodic_type_id;

    /**
     * The value for the periodic_type_code field.
     *
     * @var        string
     */
    protected $periodic_type_code;

    /**
     * The value for the periodic_type_is_active field.
     *
     * @var        boolean
     */
    protected $periodic_type_is_active;

    /**
     * @var        ObjectCollection|ChildPeriodicPlan[] Collection to store aggregation of ChildPeriodicPlan objects.
     */
    protected $collPeriodicPlans;
    protected $collPeriodicPlansPartial;

    /**
     * @var        ObjectCollection|ChildPeriodicTypeI18n[] Collection to store aggregation of ChildPeriodicTypeI18n objects.
     */
    protected $collPeriodicTypeI18ns;
    protected $collPeriodicTypeI18nsPartial;

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
     * @var        array[ChildPeriodicTypeI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPeriodicPlan[]
     */
    protected $periodicPlansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPeriodicTypeI18n[]
     */
    protected $periodicTypeI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Propel\Base\PeriodicType object.
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
     * Compares this with another <code>PeriodicType</code> instance.  If
     * <code>obj</code> is an instance of <code>PeriodicType</code>, delegates to
     * <code>equals(PeriodicType)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|PeriodicType The current object, for fluid interface
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
     * Get the [periodic_type_id] column value.
     *
     * @return int
     */
    public function getPeriodicTypeId()
    {
        return $this->periodic_type_id;
    }

    /**
     * Get the [periodic_type_code] column value.
     *
     * @return string
     */
    public function getPeriodicTypeCode()
    {
        return $this->periodic_type_code;
    }

    /**
     * Get the [periodic_type_is_active] column value.
     *
     * @return boolean
     */
    public function getPeriodicTypeIsActive()
    {
        return $this->periodic_type_is_active;
    }

    /**
     * Get the [periodic_type_is_active] column value.
     *
     * @return boolean
     */
    public function isPeriodicTypeIsActive()
    {
        return $this->getPeriodicTypeIsActive();
    }

    /**
     * Set the value of [periodic_type_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\PeriodicType The current object (for fluent API support)
     */
    public function setPeriodicTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->periodic_type_id !== $v) {
            $this->periodic_type_id = $v;
            $this->modifiedColumns[PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID] = true;
        }

        return $this;
    } // setPeriodicTypeId()

    /**
     * Set the value of [periodic_type_code] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\PeriodicType The current object (for fluent API support)
     */
    public function setPeriodicTypeCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->periodic_type_code !== $v) {
            $this->periodic_type_code = $v;
            $this->modifiedColumns[PeriodicTypeTableMap::COL_PERIODIC_TYPE_CODE] = true;
        }

        return $this;
    } // setPeriodicTypeCode()

    /**
     * Sets the value of the [periodic_type_is_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\App\Propel\PeriodicType The current object (for fluent API support)
     */
    public function setPeriodicTypeIsActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->periodic_type_is_active !== $v) {
            $this->periodic_type_is_active = $v;
            $this->modifiedColumns[PeriodicTypeTableMap::COL_PERIODIC_TYPE_IS_ACTIVE] = true;
        }

        return $this;
    } // setPeriodicTypeIsActive()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PeriodicTypeTableMap::translateFieldName('PeriodicTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->periodic_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PeriodicTypeTableMap::translateFieldName('PeriodicTypeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->periodic_type_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PeriodicTypeTableMap::translateFieldName('PeriodicTypeIsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->periodic_type_is_active = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = PeriodicTypeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\PeriodicType'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(PeriodicTypeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPeriodicTypeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPeriodicPlans = null;

            $this->collPeriodicTypeI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see PeriodicType::setDeleted()
     * @see PeriodicType::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicTypeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPeriodicTypeQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicTypeTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PeriodicTypeTableMap::addInstanceToPool($this);
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

            if ($this->periodicPlansScheduledForDeletion !== null) {
                if (!$this->periodicPlansScheduledForDeletion->isEmpty()) {
                    \App\Propel\PeriodicPlanQuery::create()
                        ->filterByPrimaryKeys($this->periodicPlansScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->periodicPlansScheduledForDeletion = null;
                }
            }

            if ($this->collPeriodicPlans !== null) {
                foreach ($this->collPeriodicPlans as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->periodicTypeI18nsScheduledForDeletion !== null) {
                if (!$this->periodicTypeI18nsScheduledForDeletion->isEmpty()) {
                    \App\Propel\PeriodicTypeI18nQuery::create()
                        ->filterByPrimaryKeys($this->periodicTypeI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->periodicTypeI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collPeriodicTypeI18ns !== null) {
                foreach ($this->collPeriodicTypeI18ns as $referrerFK) {
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

        $this->modifiedColumns[PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID] = true;
        if (null !== $this->periodic_type_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'periodic_type_id';
        }
        if ($this->isColumnModified(PeriodicTypeTableMap::COL_PERIODIC_TYPE_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'periodic_type_code';
        }
        if ($this->isColumnModified(PeriodicTypeTableMap::COL_PERIODIC_TYPE_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'periodic_type_is_active';
        }

        $sql = sprintf(
            'INSERT INTO periodic_type (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'periodic_type_id':
                        $stmt->bindValue($identifier, $this->periodic_type_id, PDO::PARAM_INT);
                        break;
                    case 'periodic_type_code':
                        $stmt->bindValue($identifier, $this->periodic_type_code, PDO::PARAM_STR);
                        break;
                    case 'periodic_type_is_active':
                        $stmt->bindValue($identifier, (int) $this->periodic_type_is_active, PDO::PARAM_INT);
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
        $this->setPeriodicTypeId($pk);

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
        $pos = PeriodicTypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPeriodicTypeId();
                break;
            case 1:
                return $this->getPeriodicTypeCode();
                break;
            case 2:
                return $this->getPeriodicTypeIsActive();
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

        if (isset($alreadyDumpedObjects['PeriodicType'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PeriodicType'][$this->hashCode()] = true;
        $keys = PeriodicTypeTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPeriodicTypeId(),
            $keys[1] => $this->getPeriodicTypeCode(),
            $keys[2] => $this->getPeriodicTypeIsActive(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPeriodicPlans) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'periodicPlans';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'periodic_plans';
                        break;
                    default:
                        $key = 'PeriodicPlans';
                }

                $result[$key] = $this->collPeriodicPlans->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPeriodicTypeI18ns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'periodicTypeI18ns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'periodic_type_i18ns';
                        break;
                    default:
                        $key = 'PeriodicTypeI18ns';
                }

                $result[$key] = $this->collPeriodicTypeI18ns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Propel\PeriodicType
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PeriodicTypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\PeriodicType
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPeriodicTypeId($value);
                break;
            case 1:
                $this->setPeriodicTypeCode($value);
                break;
            case 2:
                $this->setPeriodicTypeIsActive($value);
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
        $keys = PeriodicTypeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPeriodicTypeId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPeriodicTypeCode($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPeriodicTypeIsActive($arr[$keys[2]]);
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
     * @return $this|\App\Propel\PeriodicType The current object, for fluid interface
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
        $criteria = new Criteria(PeriodicTypeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID)) {
            $criteria->add(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID, $this->periodic_type_id);
        }
        if ($this->isColumnModified(PeriodicTypeTableMap::COL_PERIODIC_TYPE_CODE)) {
            $criteria->add(PeriodicTypeTableMap::COL_PERIODIC_TYPE_CODE, $this->periodic_type_code);
        }
        if ($this->isColumnModified(PeriodicTypeTableMap::COL_PERIODIC_TYPE_IS_ACTIVE)) {
            $criteria->add(PeriodicTypeTableMap::COL_PERIODIC_TYPE_IS_ACTIVE, $this->periodic_type_is_active);
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
        $criteria = ChildPeriodicTypeQuery::create();
        $criteria->add(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID, $this->periodic_type_id);

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
        $validPk = null !== $this->getPeriodicTypeId();

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
        return $this->getPeriodicTypeId();
    }

    /**
     * Generic method to set the primary key (periodic_type_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPeriodicTypeId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getPeriodicTypeId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\PeriodicType (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPeriodicTypeCode($this->getPeriodicTypeCode());
        $copyObj->setPeriodicTypeIsActive($this->getPeriodicTypeIsActive());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPeriodicPlans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPeriodicPlan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPeriodicTypeI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPeriodicTypeI18n($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPeriodicTypeId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\PeriodicType Clone of current object.
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
        if ('PeriodicPlan' == $relationName) {
            return $this->initPeriodicPlans();
        }
        if ('PeriodicTypeI18n' == $relationName) {
            return $this->initPeriodicTypeI18ns();
        }
    }

    /**
     * Clears out the collPeriodicPlans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPeriodicPlans()
     */
    public function clearPeriodicPlans()
    {
        $this->collPeriodicPlans = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPeriodicPlans collection loaded partially.
     */
    public function resetPartialPeriodicPlans($v = true)
    {
        $this->collPeriodicPlansPartial = $v;
    }

    /**
     * Initializes the collPeriodicPlans collection.
     *
     * By default this just sets the collPeriodicPlans collection to an empty array (like clearcollPeriodicPlans());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPeriodicPlans($overrideExisting = true)
    {
        if (null !== $this->collPeriodicPlans && !$overrideExisting) {
            return;
        }

        $collectionClassName = PeriodicPlanTableMap::getTableMap()->getCollectionClassName();

        $this->collPeriodicPlans = new $collectionClassName;
        $this->collPeriodicPlans->setModel('\App\Propel\PeriodicPlan');
    }

    /**
     * Gets an array of ChildPeriodicPlan objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPeriodicType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPeriodicPlan[] List of ChildPeriodicPlan objects
     * @throws PropelException
     */
    public function getPeriodicPlans(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPeriodicPlansPartial && !$this->isNew();
        if (null === $this->collPeriodicPlans || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPeriodicPlans) {
                // return empty collection
                $this->initPeriodicPlans();
            } else {
                $collPeriodicPlans = ChildPeriodicPlanQuery::create(null, $criteria)
                    ->filterByPeriodicType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPeriodicPlansPartial && count($collPeriodicPlans)) {
                        $this->initPeriodicPlans(false);

                        foreach ($collPeriodicPlans as $obj) {
                            if (false == $this->collPeriodicPlans->contains($obj)) {
                                $this->collPeriodicPlans->append($obj);
                            }
                        }

                        $this->collPeriodicPlansPartial = true;
                    }

                    return $collPeriodicPlans;
                }

                if ($partial && $this->collPeriodicPlans) {
                    foreach ($this->collPeriodicPlans as $obj) {
                        if ($obj->isNew()) {
                            $collPeriodicPlans[] = $obj;
                        }
                    }
                }

                $this->collPeriodicPlans = $collPeriodicPlans;
                $this->collPeriodicPlansPartial = false;
            }
        }

        return $this->collPeriodicPlans;
    }

    /**
     * Sets a collection of ChildPeriodicPlan objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $periodicPlans A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPeriodicType The current object (for fluent API support)
     */
    public function setPeriodicPlans(Collection $periodicPlans, ConnectionInterface $con = null)
    {
        /** @var ChildPeriodicPlan[] $periodicPlansToDelete */
        $periodicPlansToDelete = $this->getPeriodicPlans(new Criteria(), $con)->diff($periodicPlans);


        $this->periodicPlansScheduledForDeletion = $periodicPlansToDelete;

        foreach ($periodicPlansToDelete as $periodicPlanRemoved) {
            $periodicPlanRemoved->setPeriodicType(null);
        }

        $this->collPeriodicPlans = null;
        foreach ($periodicPlans as $periodicPlan) {
            $this->addPeriodicPlan($periodicPlan);
        }

        $this->collPeriodicPlans = $periodicPlans;
        $this->collPeriodicPlansPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PeriodicPlan objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PeriodicPlan objects.
     * @throws PropelException
     */
    public function countPeriodicPlans(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPeriodicPlansPartial && !$this->isNew();
        if (null === $this->collPeriodicPlans || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPeriodicPlans) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPeriodicPlans());
            }

            $query = ChildPeriodicPlanQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPeriodicType($this)
                ->count($con);
        }

        return count($this->collPeriodicPlans);
    }

    /**
     * Method called to associate a ChildPeriodicPlan object to this object
     * through the ChildPeriodicPlan foreign key attribute.
     *
     * @param  ChildPeriodicPlan $l ChildPeriodicPlan
     * @return $this|\App\Propel\PeriodicType The current object (for fluent API support)
     */
    public function addPeriodicPlan(ChildPeriodicPlan $l)
    {
        if ($this->collPeriodicPlans === null) {
            $this->initPeriodicPlans();
            $this->collPeriodicPlansPartial = true;
        }

        if (!$this->collPeriodicPlans->contains($l)) {
            $this->doAddPeriodicPlan($l);

            if ($this->periodicPlansScheduledForDeletion and $this->periodicPlansScheduledForDeletion->contains($l)) {
                $this->periodicPlansScheduledForDeletion->remove($this->periodicPlansScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPeriodicPlan $periodicPlan The ChildPeriodicPlan object to add.
     */
    protected function doAddPeriodicPlan(ChildPeriodicPlan $periodicPlan)
    {
        $this->collPeriodicPlans[]= $periodicPlan;
        $periodicPlan->setPeriodicType($this);
    }

    /**
     * @param  ChildPeriodicPlan $periodicPlan The ChildPeriodicPlan object to remove.
     * @return $this|ChildPeriodicType The current object (for fluent API support)
     */
    public function removePeriodicPlan(ChildPeriodicPlan $periodicPlan)
    {
        if ($this->getPeriodicPlans()->contains($periodicPlan)) {
            $pos = $this->collPeriodicPlans->search($periodicPlan);
            $this->collPeriodicPlans->remove($pos);
            if (null === $this->periodicPlansScheduledForDeletion) {
                $this->periodicPlansScheduledForDeletion = clone $this->collPeriodicPlans;
                $this->periodicPlansScheduledForDeletion->clear();
            }
            $this->periodicPlansScheduledForDeletion[]= clone $periodicPlan;
            $periodicPlan->setPeriodicType(null);
        }

        return $this;
    }

    /**
     * Clears out the collPeriodicTypeI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPeriodicTypeI18ns()
     */
    public function clearPeriodicTypeI18ns()
    {
        $this->collPeriodicTypeI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPeriodicTypeI18ns collection loaded partially.
     */
    public function resetPartialPeriodicTypeI18ns($v = true)
    {
        $this->collPeriodicTypeI18nsPartial = $v;
    }

    /**
     * Initializes the collPeriodicTypeI18ns collection.
     *
     * By default this just sets the collPeriodicTypeI18ns collection to an empty array (like clearcollPeriodicTypeI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPeriodicTypeI18ns($overrideExisting = true)
    {
        if (null !== $this->collPeriodicTypeI18ns && !$overrideExisting) {
            return;
        }

        $collectionClassName = PeriodicTypeI18nTableMap::getTableMap()->getCollectionClassName();

        $this->collPeriodicTypeI18ns = new $collectionClassName;
        $this->collPeriodicTypeI18ns->setModel('\App\Propel\PeriodicTypeI18n');
    }

    /**
     * Gets an array of ChildPeriodicTypeI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPeriodicType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPeriodicTypeI18n[] List of ChildPeriodicTypeI18n objects
     * @throws PropelException
     */
    public function getPeriodicTypeI18ns(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPeriodicTypeI18nsPartial && !$this->isNew();
        if (null === $this->collPeriodicTypeI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPeriodicTypeI18ns) {
                // return empty collection
                $this->initPeriodicTypeI18ns();
            } else {
                $collPeriodicTypeI18ns = ChildPeriodicTypeI18nQuery::create(null, $criteria)
                    ->filterByPeriodicType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPeriodicTypeI18nsPartial && count($collPeriodicTypeI18ns)) {
                        $this->initPeriodicTypeI18ns(false);

                        foreach ($collPeriodicTypeI18ns as $obj) {
                            if (false == $this->collPeriodicTypeI18ns->contains($obj)) {
                                $this->collPeriodicTypeI18ns->append($obj);
                            }
                        }

                        $this->collPeriodicTypeI18nsPartial = true;
                    }

                    return $collPeriodicTypeI18ns;
                }

                if ($partial && $this->collPeriodicTypeI18ns) {
                    foreach ($this->collPeriodicTypeI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collPeriodicTypeI18ns[] = $obj;
                        }
                    }
                }

                $this->collPeriodicTypeI18ns = $collPeriodicTypeI18ns;
                $this->collPeriodicTypeI18nsPartial = false;
            }
        }

        return $this->collPeriodicTypeI18ns;
    }

    /**
     * Sets a collection of ChildPeriodicTypeI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $periodicTypeI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPeriodicType The current object (for fluent API support)
     */
    public function setPeriodicTypeI18ns(Collection $periodicTypeI18ns, ConnectionInterface $con = null)
    {
        /** @var ChildPeriodicTypeI18n[] $periodicTypeI18nsToDelete */
        $periodicTypeI18nsToDelete = $this->getPeriodicTypeI18ns(new Criteria(), $con)->diff($periodicTypeI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->periodicTypeI18nsScheduledForDeletion = clone $periodicTypeI18nsToDelete;

        foreach ($periodicTypeI18nsToDelete as $periodicTypeI18nRemoved) {
            $periodicTypeI18nRemoved->setPeriodicType(null);
        }

        $this->collPeriodicTypeI18ns = null;
        foreach ($periodicTypeI18ns as $periodicTypeI18n) {
            $this->addPeriodicTypeI18n($periodicTypeI18n);
        }

        $this->collPeriodicTypeI18ns = $periodicTypeI18ns;
        $this->collPeriodicTypeI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PeriodicTypeI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PeriodicTypeI18n objects.
     * @throws PropelException
     */
    public function countPeriodicTypeI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPeriodicTypeI18nsPartial && !$this->isNew();
        if (null === $this->collPeriodicTypeI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPeriodicTypeI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPeriodicTypeI18ns());
            }

            $query = ChildPeriodicTypeI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPeriodicType($this)
                ->count($con);
        }

        return count($this->collPeriodicTypeI18ns);
    }

    /**
     * Method called to associate a ChildPeriodicTypeI18n object to this object
     * through the ChildPeriodicTypeI18n foreign key attribute.
     *
     * @param  ChildPeriodicTypeI18n $l ChildPeriodicTypeI18n
     * @return $this|\App\Propel\PeriodicType The current object (for fluent API support)
     */
    public function addPeriodicTypeI18n(ChildPeriodicTypeI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collPeriodicTypeI18ns === null) {
            $this->initPeriodicTypeI18ns();
            $this->collPeriodicTypeI18nsPartial = true;
        }

        if (!$this->collPeriodicTypeI18ns->contains($l)) {
            $this->doAddPeriodicTypeI18n($l);

            if ($this->periodicTypeI18nsScheduledForDeletion and $this->periodicTypeI18nsScheduledForDeletion->contains($l)) {
                $this->periodicTypeI18nsScheduledForDeletion->remove($this->periodicTypeI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPeriodicTypeI18n $periodicTypeI18n The ChildPeriodicTypeI18n object to add.
     */
    protected function doAddPeriodicTypeI18n(ChildPeriodicTypeI18n $periodicTypeI18n)
    {
        $this->collPeriodicTypeI18ns[]= $periodicTypeI18n;
        $periodicTypeI18n->setPeriodicType($this);
    }

    /**
     * @param  ChildPeriodicTypeI18n $periodicTypeI18n The ChildPeriodicTypeI18n object to remove.
     * @return $this|ChildPeriodicType The current object (for fluent API support)
     */
    public function removePeriodicTypeI18n(ChildPeriodicTypeI18n $periodicTypeI18n)
    {
        if ($this->getPeriodicTypeI18ns()->contains($periodicTypeI18n)) {
            $pos = $this->collPeriodicTypeI18ns->search($periodicTypeI18n);
            $this->collPeriodicTypeI18ns->remove($pos);
            if (null === $this->periodicTypeI18nsScheduledForDeletion) {
                $this->periodicTypeI18nsScheduledForDeletion = clone $this->collPeriodicTypeI18ns;
                $this->periodicTypeI18nsScheduledForDeletion->clear();
            }
            $this->periodicTypeI18nsScheduledForDeletion[]= clone $periodicTypeI18n;
            $periodicTypeI18n->setPeriodicType(null);
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
        $this->periodic_type_id = null;
        $this->periodic_type_code = null;
        $this->periodic_type_is_active = null;
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
            if ($this->collPeriodicPlans) {
                foreach ($this->collPeriodicPlans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPeriodicTypeI18ns) {
                foreach ($this->collPeriodicTypeI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collPeriodicPlans = null;
        $this->collPeriodicTypeI18ns = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PeriodicTypeTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    $this|ChildPeriodicType The current object (for fluent API support)
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
     * @return ChildPeriodicTypeI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collPeriodicTypeI18ns) {
                foreach ($this->collPeriodicTypeI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildPeriodicTypeI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildPeriodicTypeI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addPeriodicTypeI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    $this|ChildPeriodicType The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildPeriodicTypeI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collPeriodicTypeI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collPeriodicTypeI18ns[$key]);
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
     * @return ChildPeriodicTypeI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [periodic_type_name] column value.
         *
         * @return string
         */
        public function getPeriodicTypeName()
        {
        return $this->getCurrentTranslation()->getPeriodicTypeName();
    }


        /**
         * Set the value of [periodic_type_name] column.
         *
         * @param string $v new value
         * @return $this|\App\Propel\PeriodicTypeI18n The current object (for fluent API support)
         */
        public function setPeriodicTypeName($v)
        {    $this->getCurrentTranslation()->setPeriodicTypeName($v);

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
