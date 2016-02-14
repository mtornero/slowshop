<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Config as ChildConfig;
use App\Propel\ConfigCategory as ChildConfigCategory;
use App\Propel\ConfigCategoryI18n as ChildConfigCategoryI18n;
use App\Propel\ConfigCategoryI18nQuery as ChildConfigCategoryI18nQuery;
use App\Propel\ConfigCategoryQuery as ChildConfigCategoryQuery;
use App\Propel\ConfigQuery as ChildConfigQuery;
use App\Propel\Map\ConfigCategoryI18nTableMap;
use App\Propel\Map\ConfigCategoryTableMap;
use App\Propel\Map\ConfigTableMap;
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
 * Base class that represents a row from the 'config_category' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class ConfigCategory implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\ConfigCategoryTableMap';


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
     * The value for the config_category_id field.
     *
     * @var        int
     */
    protected $config_category_id;

    /**
     * The value for the config_category_is_visible field.
     *
     * @var        boolean
     */
    protected $config_category_is_visible;

    /**
     * @var        ObjectCollection|ChildConfig[] Collection to store aggregation of ChildConfig objects.
     */
    protected $collConfigs;
    protected $collConfigsPartial;

    /**
     * @var        ObjectCollection|ChildConfigCategoryI18n[] Collection to store aggregation of ChildConfigCategoryI18n objects.
     */
    protected $collConfigCategoryI18ns;
    protected $collConfigCategoryI18nsPartial;

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
     * @var        array[ChildConfigCategoryI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildConfig[]
     */
    protected $configsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildConfigCategoryI18n[]
     */
    protected $configCategoryI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Propel\Base\ConfigCategory object.
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
     * Compares this with another <code>ConfigCategory</code> instance.  If
     * <code>obj</code> is an instance of <code>ConfigCategory</code>, delegates to
     * <code>equals(ConfigCategory)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|ConfigCategory The current object, for fluid interface
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
     * Get the [config_category_id] column value.
     *
     * @return int
     */
    public function getConfigCategoryId()
    {
        return $this->config_category_id;
    }

    /**
     * Get the [config_category_is_visible] column value.
     *
     * @return boolean
     */
    public function getConfigCategoryIsVisible()
    {
        return $this->config_category_is_visible;
    }

    /**
     * Get the [config_category_is_visible] column value.
     *
     * @return boolean
     */
    public function isConfigCategoryIsVisible()
    {
        return $this->getConfigCategoryIsVisible();
    }

    /**
     * Set the value of [config_category_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\ConfigCategory The current object (for fluent API support)
     */
    public function setConfigCategoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->config_category_id !== $v) {
            $this->config_category_id = $v;
            $this->modifiedColumns[ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID] = true;
        }

        return $this;
    } // setConfigCategoryId()

    /**
     * Sets the value of the [config_category_is_visible] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\App\Propel\ConfigCategory The current object (for fluent API support)
     */
    public function setConfigCategoryIsVisible($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->config_category_is_visible !== $v) {
            $this->config_category_is_visible = $v;
            $this->modifiedColumns[ConfigCategoryTableMap::COL_CONFIG_CATEGORY_IS_VISIBLE] = true;
        }

        return $this;
    } // setConfigCategoryIsVisible()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ConfigCategoryTableMap::translateFieldName('ConfigCategoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_category_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ConfigCategoryTableMap::translateFieldName('ConfigCategoryIsVisible', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_category_is_visible = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = ConfigCategoryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\ConfigCategory'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(ConfigCategoryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildConfigCategoryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collConfigs = null;

            $this->collConfigCategoryI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see ConfigCategory::setDeleted()
     * @see ConfigCategory::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigCategoryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildConfigCategoryQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigCategoryTableMap::DATABASE_NAME);
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
                ConfigCategoryTableMap::addInstanceToPool($this);
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

            if ($this->configsScheduledForDeletion !== null) {
                if (!$this->configsScheduledForDeletion->isEmpty()) {
                    \App\Propel\ConfigQuery::create()
                        ->filterByPrimaryKeys($this->configsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->configsScheduledForDeletion = null;
                }
            }

            if ($this->collConfigs !== null) {
                foreach ($this->collConfigs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->configCategoryI18nsScheduledForDeletion !== null) {
                if (!$this->configCategoryI18nsScheduledForDeletion->isEmpty()) {
                    \App\Propel\ConfigCategoryI18nQuery::create()
                        ->filterByPrimaryKeys($this->configCategoryI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->configCategoryI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collConfigCategoryI18ns !== null) {
                foreach ($this->collConfigCategoryI18ns as $referrerFK) {
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

        $this->modifiedColumns[ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID] = true;
        if (null !== $this->config_category_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'config_category_id';
        }
        if ($this->isColumnModified(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_IS_VISIBLE)) {
            $modifiedColumns[':p' . $index++]  = 'config_category_is_visible';
        }

        $sql = sprintf(
            'INSERT INTO config_category (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'config_category_id':
                        $stmt->bindValue($identifier, $this->config_category_id, PDO::PARAM_INT);
                        break;
                    case 'config_category_is_visible':
                        $stmt->bindValue($identifier, (int) $this->config_category_is_visible, PDO::PARAM_INT);
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
        $this->setConfigCategoryId($pk);

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
        $pos = ConfigCategoryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getConfigCategoryId();
                break;
            case 1:
                return $this->getConfigCategoryIsVisible();
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

        if (isset($alreadyDumpedObjects['ConfigCategory'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ConfigCategory'][$this->hashCode()] = true;
        $keys = ConfigCategoryTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getConfigCategoryId(),
            $keys[1] => $this->getConfigCategoryIsVisible(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collConfigs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'configs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'configs';
                        break;
                    default:
                        $key = 'Configs';
                }

                $result[$key] = $this->collConfigs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collConfigCategoryI18ns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'configCategoryI18ns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'config_category_i18ns';
                        break;
                    default:
                        $key = 'ConfigCategoryI18ns';
                }

                $result[$key] = $this->collConfigCategoryI18ns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Propel\ConfigCategory
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ConfigCategoryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\ConfigCategory
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setConfigCategoryId($value);
                break;
            case 1:
                $this->setConfigCategoryIsVisible($value);
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
        $keys = ConfigCategoryTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setConfigCategoryId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setConfigCategoryIsVisible($arr[$keys[1]]);
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
     * @return $this|\App\Propel\ConfigCategory The current object, for fluid interface
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
        $criteria = new Criteria(ConfigCategoryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID)) {
            $criteria->add(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID, $this->config_category_id);
        }
        if ($this->isColumnModified(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_IS_VISIBLE)) {
            $criteria->add(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_IS_VISIBLE, $this->config_category_is_visible);
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
        $criteria = ChildConfigCategoryQuery::create();
        $criteria->add(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID, $this->config_category_id);

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
        $validPk = null !== $this->getConfigCategoryId();

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
        return $this->getConfigCategoryId();
    }

    /**
     * Generic method to set the primary key (config_category_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setConfigCategoryId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getConfigCategoryId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\ConfigCategory (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setConfigCategoryIsVisible($this->getConfigCategoryIsVisible());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getConfigs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addConfig($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getConfigCategoryI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addConfigCategoryI18n($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setConfigCategoryId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\ConfigCategory Clone of current object.
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
        if ('Config' == $relationName) {
            return $this->initConfigs();
        }
        if ('ConfigCategoryI18n' == $relationName) {
            return $this->initConfigCategoryI18ns();
        }
    }

    /**
     * Clears out the collConfigs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addConfigs()
     */
    public function clearConfigs()
    {
        $this->collConfigs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collConfigs collection loaded partially.
     */
    public function resetPartialConfigs($v = true)
    {
        $this->collConfigsPartial = $v;
    }

    /**
     * Initializes the collConfigs collection.
     *
     * By default this just sets the collConfigs collection to an empty array (like clearcollConfigs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initConfigs($overrideExisting = true)
    {
        if (null !== $this->collConfigs && !$overrideExisting) {
            return;
        }

        $collectionClassName = ConfigTableMap::getTableMap()->getCollectionClassName();

        $this->collConfigs = new $collectionClassName;
        $this->collConfigs->setModel('\App\Propel\Config');
    }

    /**
     * Gets an array of ChildConfig objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildConfigCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildConfig[] List of ChildConfig objects
     * @throws PropelException
     */
    public function getConfigs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collConfigsPartial && !$this->isNew();
        if (null === $this->collConfigs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collConfigs) {
                // return empty collection
                $this->initConfigs();
            } else {
                $collConfigs = ChildConfigQuery::create(null, $criteria)
                    ->filterByConfigCategory($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collConfigsPartial && count($collConfigs)) {
                        $this->initConfigs(false);

                        foreach ($collConfigs as $obj) {
                            if (false == $this->collConfigs->contains($obj)) {
                                $this->collConfigs->append($obj);
                            }
                        }

                        $this->collConfigsPartial = true;
                    }

                    return $collConfigs;
                }

                if ($partial && $this->collConfigs) {
                    foreach ($this->collConfigs as $obj) {
                        if ($obj->isNew()) {
                            $collConfigs[] = $obj;
                        }
                    }
                }

                $this->collConfigs = $collConfigs;
                $this->collConfigsPartial = false;
            }
        }

        return $this->collConfigs;
    }

    /**
     * Sets a collection of ChildConfig objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $configs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildConfigCategory The current object (for fluent API support)
     */
    public function setConfigs(Collection $configs, ConnectionInterface $con = null)
    {
        /** @var ChildConfig[] $configsToDelete */
        $configsToDelete = $this->getConfigs(new Criteria(), $con)->diff($configs);


        $this->configsScheduledForDeletion = $configsToDelete;

        foreach ($configsToDelete as $configRemoved) {
            $configRemoved->setConfigCategory(null);
        }

        $this->collConfigs = null;
        foreach ($configs as $config) {
            $this->addConfig($config);
        }

        $this->collConfigs = $configs;
        $this->collConfigsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Config objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Config objects.
     * @throws PropelException
     */
    public function countConfigs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collConfigsPartial && !$this->isNew();
        if (null === $this->collConfigs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collConfigs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getConfigs());
            }

            $query = ChildConfigQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByConfigCategory($this)
                ->count($con);
        }

        return count($this->collConfigs);
    }

    /**
     * Method called to associate a ChildConfig object to this object
     * through the ChildConfig foreign key attribute.
     *
     * @param  ChildConfig $l ChildConfig
     * @return $this|\App\Propel\ConfigCategory The current object (for fluent API support)
     */
    public function addConfig(ChildConfig $l)
    {
        if ($this->collConfigs === null) {
            $this->initConfigs();
            $this->collConfigsPartial = true;
        }

        if (!$this->collConfigs->contains($l)) {
            $this->doAddConfig($l);

            if ($this->configsScheduledForDeletion and $this->configsScheduledForDeletion->contains($l)) {
                $this->configsScheduledForDeletion->remove($this->configsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildConfig $config The ChildConfig object to add.
     */
    protected function doAddConfig(ChildConfig $config)
    {
        $this->collConfigs[]= $config;
        $config->setConfigCategory($this);
    }

    /**
     * @param  ChildConfig $config The ChildConfig object to remove.
     * @return $this|ChildConfigCategory The current object (for fluent API support)
     */
    public function removeConfig(ChildConfig $config)
    {
        if ($this->getConfigs()->contains($config)) {
            $pos = $this->collConfigs->search($config);
            $this->collConfigs->remove($pos);
            if (null === $this->configsScheduledForDeletion) {
                $this->configsScheduledForDeletion = clone $this->collConfigs;
                $this->configsScheduledForDeletion->clear();
            }
            $this->configsScheduledForDeletion[]= clone $config;
            $config->setConfigCategory(null);
        }

        return $this;
    }

    /**
     * Clears out the collConfigCategoryI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addConfigCategoryI18ns()
     */
    public function clearConfigCategoryI18ns()
    {
        $this->collConfigCategoryI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collConfigCategoryI18ns collection loaded partially.
     */
    public function resetPartialConfigCategoryI18ns($v = true)
    {
        $this->collConfigCategoryI18nsPartial = $v;
    }

    /**
     * Initializes the collConfigCategoryI18ns collection.
     *
     * By default this just sets the collConfigCategoryI18ns collection to an empty array (like clearcollConfigCategoryI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initConfigCategoryI18ns($overrideExisting = true)
    {
        if (null !== $this->collConfigCategoryI18ns && !$overrideExisting) {
            return;
        }

        $collectionClassName = ConfigCategoryI18nTableMap::getTableMap()->getCollectionClassName();

        $this->collConfigCategoryI18ns = new $collectionClassName;
        $this->collConfigCategoryI18ns->setModel('\App\Propel\ConfigCategoryI18n');
    }

    /**
     * Gets an array of ChildConfigCategoryI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildConfigCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildConfigCategoryI18n[] List of ChildConfigCategoryI18n objects
     * @throws PropelException
     */
    public function getConfigCategoryI18ns(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collConfigCategoryI18nsPartial && !$this->isNew();
        if (null === $this->collConfigCategoryI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collConfigCategoryI18ns) {
                // return empty collection
                $this->initConfigCategoryI18ns();
            } else {
                $collConfigCategoryI18ns = ChildConfigCategoryI18nQuery::create(null, $criteria)
                    ->filterByConfigCategory($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collConfigCategoryI18nsPartial && count($collConfigCategoryI18ns)) {
                        $this->initConfigCategoryI18ns(false);

                        foreach ($collConfigCategoryI18ns as $obj) {
                            if (false == $this->collConfigCategoryI18ns->contains($obj)) {
                                $this->collConfigCategoryI18ns->append($obj);
                            }
                        }

                        $this->collConfigCategoryI18nsPartial = true;
                    }

                    return $collConfigCategoryI18ns;
                }

                if ($partial && $this->collConfigCategoryI18ns) {
                    foreach ($this->collConfigCategoryI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collConfigCategoryI18ns[] = $obj;
                        }
                    }
                }

                $this->collConfigCategoryI18ns = $collConfigCategoryI18ns;
                $this->collConfigCategoryI18nsPartial = false;
            }
        }

        return $this->collConfigCategoryI18ns;
    }

    /**
     * Sets a collection of ChildConfigCategoryI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $configCategoryI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildConfigCategory The current object (for fluent API support)
     */
    public function setConfigCategoryI18ns(Collection $configCategoryI18ns, ConnectionInterface $con = null)
    {
        /** @var ChildConfigCategoryI18n[] $configCategoryI18nsToDelete */
        $configCategoryI18nsToDelete = $this->getConfigCategoryI18ns(new Criteria(), $con)->diff($configCategoryI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->configCategoryI18nsScheduledForDeletion = clone $configCategoryI18nsToDelete;

        foreach ($configCategoryI18nsToDelete as $configCategoryI18nRemoved) {
            $configCategoryI18nRemoved->setConfigCategory(null);
        }

        $this->collConfigCategoryI18ns = null;
        foreach ($configCategoryI18ns as $configCategoryI18n) {
            $this->addConfigCategoryI18n($configCategoryI18n);
        }

        $this->collConfigCategoryI18ns = $configCategoryI18ns;
        $this->collConfigCategoryI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ConfigCategoryI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ConfigCategoryI18n objects.
     * @throws PropelException
     */
    public function countConfigCategoryI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collConfigCategoryI18nsPartial && !$this->isNew();
        if (null === $this->collConfigCategoryI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collConfigCategoryI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getConfigCategoryI18ns());
            }

            $query = ChildConfigCategoryI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByConfigCategory($this)
                ->count($con);
        }

        return count($this->collConfigCategoryI18ns);
    }

    /**
     * Method called to associate a ChildConfigCategoryI18n object to this object
     * through the ChildConfigCategoryI18n foreign key attribute.
     *
     * @param  ChildConfigCategoryI18n $l ChildConfigCategoryI18n
     * @return $this|\App\Propel\ConfigCategory The current object (for fluent API support)
     */
    public function addConfigCategoryI18n(ChildConfigCategoryI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collConfigCategoryI18ns === null) {
            $this->initConfigCategoryI18ns();
            $this->collConfigCategoryI18nsPartial = true;
        }

        if (!$this->collConfigCategoryI18ns->contains($l)) {
            $this->doAddConfigCategoryI18n($l);

            if ($this->configCategoryI18nsScheduledForDeletion and $this->configCategoryI18nsScheduledForDeletion->contains($l)) {
                $this->configCategoryI18nsScheduledForDeletion->remove($this->configCategoryI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildConfigCategoryI18n $configCategoryI18n The ChildConfigCategoryI18n object to add.
     */
    protected function doAddConfigCategoryI18n(ChildConfigCategoryI18n $configCategoryI18n)
    {
        $this->collConfigCategoryI18ns[]= $configCategoryI18n;
        $configCategoryI18n->setConfigCategory($this);
    }

    /**
     * @param  ChildConfigCategoryI18n $configCategoryI18n The ChildConfigCategoryI18n object to remove.
     * @return $this|ChildConfigCategory The current object (for fluent API support)
     */
    public function removeConfigCategoryI18n(ChildConfigCategoryI18n $configCategoryI18n)
    {
        if ($this->getConfigCategoryI18ns()->contains($configCategoryI18n)) {
            $pos = $this->collConfigCategoryI18ns->search($configCategoryI18n);
            $this->collConfigCategoryI18ns->remove($pos);
            if (null === $this->configCategoryI18nsScheduledForDeletion) {
                $this->configCategoryI18nsScheduledForDeletion = clone $this->collConfigCategoryI18ns;
                $this->configCategoryI18nsScheduledForDeletion->clear();
            }
            $this->configCategoryI18nsScheduledForDeletion[]= clone $configCategoryI18n;
            $configCategoryI18n->setConfigCategory(null);
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
        $this->config_category_id = null;
        $this->config_category_is_visible = null;
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
            if ($this->collConfigs) {
                foreach ($this->collConfigs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collConfigCategoryI18ns) {
                foreach ($this->collConfigCategoryI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collConfigs = null;
        $this->collConfigCategoryI18ns = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ConfigCategoryTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    $this|ChildConfigCategory The current object (for fluent API support)
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
     * @return ChildConfigCategoryI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collConfigCategoryI18ns) {
                foreach ($this->collConfigCategoryI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildConfigCategoryI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildConfigCategoryI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addConfigCategoryI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    $this|ChildConfigCategory The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildConfigCategoryI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collConfigCategoryI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collConfigCategoryI18ns[$key]);
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
     * @return ChildConfigCategoryI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [config_category_name] column value.
         *
         * @return string
         */
        public function getConfigCategoryName()
        {
        return $this->getCurrentTranslation()->getConfigCategoryName();
    }


        /**
         * Set the value of [config_category_name] column.
         *
         * @param string $v new value
         * @return $this|\App\Propel\ConfigCategoryI18n The current object (for fluent API support)
         */
        public function setConfigCategoryName($v)
        {    $this->getCurrentTranslation()->setConfigCategoryName($v);

        return $this;
    }


        /**
         * Get the [config_category_description] column value.
         *
         * @return string
         */
        public function getConfigCategoryDescription()
        {
        return $this->getCurrentTranslation()->getConfigCategoryDescription();
    }


        /**
         * Set the value of [config_category_description] column.
         *
         * @param string $v new value
         * @return $this|\App\Propel\ConfigCategoryI18n The current object (for fluent API support)
         */
        public function setConfigCategoryDescription($v)
        {    $this->getCurrentTranslation()->setConfigCategoryDescription($v);

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
