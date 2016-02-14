<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Config as ChildConfig;
use App\Propel\ConfigCategory as ChildConfigCategory;
use App\Propel\ConfigCategoryQuery as ChildConfigCategoryQuery;
use App\Propel\ConfigI18n as ChildConfigI18n;
use App\Propel\ConfigI18nQuery as ChildConfigI18nQuery;
use App\Propel\ConfigQuery as ChildConfigQuery;
use App\Propel\ConfigVersion as ChildConfigVersion;
use App\Propel\ConfigVersionQuery as ChildConfigVersionQuery;
use App\Propel\Map\ConfigI18nTableMap;
use App\Propel\Map\ConfigTableMap;
use App\Propel\Map\ConfigVersionTableMap;
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
 * Base class that represents a row from the 'config' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class Config implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\ConfigTableMap';


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
     * The value for the config_id field.
     *
     * @var        int
     */
    protected $config_id;

    /**
     * The value for the config_category_id field.
     *
     * @var        int
     */
    protected $config_category_id;

    /**
     * The value for the config_key field.
     *
     * @var        string
     */
    protected $config_key;

    /**
     * The value for the config_value field.
     *
     * @var        string
     */
    protected $config_value;

    /**
     * The value for the config_format field.
     *
     * Note: this column has a database default value of: 'string'
     * @var        string
     */
    protected $config_format;

    /**
     * The value for the version field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $version;

    /**
     * @var        ChildConfigCategory
     */
    protected $aConfigCategory;

    /**
     * @var        ObjectCollection|ChildConfigI18n[] Collection to store aggregation of ChildConfigI18n objects.
     */
    protected $collConfigI18ns;
    protected $collConfigI18nsPartial;

    /**
     * @var        ObjectCollection|ChildConfigVersion[] Collection to store aggregation of ChildConfigVersion objects.
     */
    protected $collConfigVersions;
    protected $collConfigVersionsPartial;

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
     * @var        array[ChildConfigI18n]
     */
    protected $currentTranslations;

    // versionable behavior


    /**
     * @var bool
     */
    protected $enforceVersion = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildConfigI18n[]
     */
    protected $configI18nsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildConfigVersion[]
     */
    protected $configVersionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->config_format = 'string';
        $this->version = 0;
    }

    /**
     * Initializes internal state of App\Propel\Base\Config object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
     * Compares this with another <code>Config</code> instance.  If
     * <code>obj</code> is an instance of <code>Config</code>, delegates to
     * <code>equals(Config)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Config The current object, for fluid interface
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
     * Get the [config_id] column value.
     *
     * @return int
     */
    public function getConfigId()
    {
        return $this->config_id;
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
     * Get the [config_key] column value.
     *
     * @return string
     */
    public function getConfigKey()
    {
        return $this->config_key;
    }

    /**
     * Get the [config_value] column value.
     *
     * @return string
     */
    public function getConfigValue()
    {
        return $this->config_value;
    }

    /**
     * Get the [config_format] column value.
     *
     * @return string
     */
    public function getConfigFormat()
    {
        return $this->config_format;
    }

    /**
     * Get the [version] column value.
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the value of [config_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Config The current object (for fluent API support)
     */
    public function setConfigId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->config_id !== $v) {
            $this->config_id = $v;
            $this->modifiedColumns[ConfigTableMap::COL_CONFIG_ID] = true;
        }

        return $this;
    } // setConfigId()

    /**
     * Set the value of [config_category_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Config The current object (for fluent API support)
     */
    public function setConfigCategoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->config_category_id !== $v) {
            $this->config_category_id = $v;
            $this->modifiedColumns[ConfigTableMap::COL_CONFIG_CATEGORY_ID] = true;
        }

        if ($this->aConfigCategory !== null && $this->aConfigCategory->getConfigCategoryId() !== $v) {
            $this->aConfigCategory = null;
        }

        return $this;
    } // setConfigCategoryId()

    /**
     * Set the value of [config_key] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\Config The current object (for fluent API support)
     */
    public function setConfigKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->config_key !== $v) {
            $this->config_key = $v;
            $this->modifiedColumns[ConfigTableMap::COL_CONFIG_KEY] = true;
        }

        return $this;
    } // setConfigKey()

    /**
     * Set the value of [config_value] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\Config The current object (for fluent API support)
     */
    public function setConfigValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->config_value !== $v) {
            $this->config_value = $v;
            $this->modifiedColumns[ConfigTableMap::COL_CONFIG_VALUE] = true;
        }

        return $this;
    } // setConfigValue()

    /**
     * Set the value of [config_format] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\Config The current object (for fluent API support)
     */
    public function setConfigFormat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->config_format !== $v) {
            $this->config_format = $v;
            $this->modifiedColumns[ConfigTableMap::COL_CONFIG_FORMAT] = true;
        }

        return $this;
    } // setConfigFormat()

    /**
     * Set the value of [version] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Config The current object (for fluent API support)
     */
    public function setVersion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->version !== $v) {
            $this->version = $v;
            $this->modifiedColumns[ConfigTableMap::COL_VERSION] = true;
        }

        return $this;
    } // setVersion()

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
            if ($this->config_format !== 'string') {
                return false;
            }

            if ($this->version !== 0) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ConfigTableMap::translateFieldName('ConfigId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ConfigTableMap::translateFieldName('ConfigCategoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_category_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ConfigTableMap::translateFieldName('ConfigKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ConfigTableMap::translateFieldName('ConfigValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ConfigTableMap::translateFieldName('ConfigFormat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_format = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ConfigTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = ConfigTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\Config'), 0, $e);
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
        if ($this->aConfigCategory !== null && $this->config_category_id !== $this->aConfigCategory->getConfigCategoryId()) {
            $this->aConfigCategory = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ConfigTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildConfigQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aConfigCategory = null;
            $this->collConfigI18ns = null;

            $this->collConfigVersions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Config::setDeleted()
     * @see Config::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildConfigQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            // versionable behavior
            if ($this->isVersioningNecessary()) {
                $this->setVersion($this->isNew() ? 1 : $this->getLastVersionNumber($con) + 1);
                $createVersion = true; // for postSave hook
            }
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
                // versionable behavior
                if (isset($createVersion)) {
                    $this->addVersion($con);
                }
                ConfigTableMap::addInstanceToPool($this);
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

            if ($this->aConfigCategory !== null) {
                if ($this->aConfigCategory->isModified() || $this->aConfigCategory->isNew()) {
                    $affectedRows += $this->aConfigCategory->save($con);
                }
                $this->setConfigCategory($this->aConfigCategory);
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

            if ($this->configI18nsScheduledForDeletion !== null) {
                if (!$this->configI18nsScheduledForDeletion->isEmpty()) {
                    \App\Propel\ConfigI18nQuery::create()
                        ->filterByPrimaryKeys($this->configI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->configI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collConfigI18ns !== null) {
                foreach ($this->collConfigI18ns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->configVersionsScheduledForDeletion !== null) {
                if (!$this->configVersionsScheduledForDeletion->isEmpty()) {
                    \App\Propel\ConfigVersionQuery::create()
                        ->filterByPrimaryKeys($this->configVersionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->configVersionsScheduledForDeletion = null;
                }
            }

            if ($this->collConfigVersions !== null) {
                foreach ($this->collConfigVersions as $referrerFK) {
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

        $this->modifiedColumns[ConfigTableMap::COL_CONFIG_ID] = true;
        if (null !== $this->config_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ConfigTableMap::COL_CONFIG_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ConfigTableMap::COL_CONFIG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'config_id';
        }
        if ($this->isColumnModified(ConfigTableMap::COL_CONFIG_CATEGORY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'config_category_id';
        }
        if ($this->isColumnModified(ConfigTableMap::COL_CONFIG_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'config_key';
        }
        if ($this->isColumnModified(ConfigTableMap::COL_CONFIG_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'config_value';
        }
        if ($this->isColumnModified(ConfigTableMap::COL_CONFIG_FORMAT)) {
            $modifiedColumns[':p' . $index++]  = 'config_format';
        }
        if ($this->isColumnModified(ConfigTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = 'version';
        }

        $sql = sprintf(
            'INSERT INTO config (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'config_id':
                        $stmt->bindValue($identifier, $this->config_id, PDO::PARAM_INT);
                        break;
                    case 'config_category_id':
                        $stmt->bindValue($identifier, $this->config_category_id, PDO::PARAM_INT);
                        break;
                    case 'config_key':
                        $stmt->bindValue($identifier, $this->config_key, PDO::PARAM_STR);
                        break;
                    case 'config_value':
                        $stmt->bindValue($identifier, $this->config_value, PDO::PARAM_STR);
                        break;
                    case 'config_format':
                        $stmt->bindValue($identifier, $this->config_format, PDO::PARAM_STR);
                        break;
                    case 'version':
                        $stmt->bindValue($identifier, $this->version, PDO::PARAM_INT);
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
        $this->setConfigId($pk);

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
        $pos = ConfigTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getConfigId();
                break;
            case 1:
                return $this->getConfigCategoryId();
                break;
            case 2:
                return $this->getConfigKey();
                break;
            case 3:
                return $this->getConfigValue();
                break;
            case 4:
                return $this->getConfigFormat();
                break;
            case 5:
                return $this->getVersion();
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

        if (isset($alreadyDumpedObjects['Config'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Config'][$this->hashCode()] = true;
        $keys = ConfigTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getConfigId(),
            $keys[1] => $this->getConfigCategoryId(),
            $keys[2] => $this->getConfigKey(),
            $keys[3] => $this->getConfigValue(),
            $keys[4] => $this->getConfigFormat(),
            $keys[5] => $this->getVersion(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aConfigCategory) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'configCategory';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'config_category';
                        break;
                    default:
                        $key = 'ConfigCategory';
                }

                $result[$key] = $this->aConfigCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collConfigI18ns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'configI18ns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'config_i18ns';
                        break;
                    default:
                        $key = 'ConfigI18ns';
                }

                $result[$key] = $this->collConfigI18ns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collConfigVersions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'configVersions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'config_versions';
                        break;
                    default:
                        $key = 'ConfigVersions';
                }

                $result[$key] = $this->collConfigVersions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Propel\Config
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ConfigTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\Config
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setConfigId($value);
                break;
            case 1:
                $this->setConfigCategoryId($value);
                break;
            case 2:
                $this->setConfigKey($value);
                break;
            case 3:
                $this->setConfigValue($value);
                break;
            case 4:
                $this->setConfigFormat($value);
                break;
            case 5:
                $this->setVersion($value);
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
        $keys = ConfigTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setConfigId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setConfigCategoryId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setConfigKey($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setConfigValue($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setConfigFormat($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setVersion($arr[$keys[5]]);
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
     * @return $this|\App\Propel\Config The current object, for fluid interface
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
        $criteria = new Criteria(ConfigTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ConfigTableMap::COL_CONFIG_ID)) {
            $criteria->add(ConfigTableMap::COL_CONFIG_ID, $this->config_id);
        }
        if ($this->isColumnModified(ConfigTableMap::COL_CONFIG_CATEGORY_ID)) {
            $criteria->add(ConfigTableMap::COL_CONFIG_CATEGORY_ID, $this->config_category_id);
        }
        if ($this->isColumnModified(ConfigTableMap::COL_CONFIG_KEY)) {
            $criteria->add(ConfigTableMap::COL_CONFIG_KEY, $this->config_key);
        }
        if ($this->isColumnModified(ConfigTableMap::COL_CONFIG_VALUE)) {
            $criteria->add(ConfigTableMap::COL_CONFIG_VALUE, $this->config_value);
        }
        if ($this->isColumnModified(ConfigTableMap::COL_CONFIG_FORMAT)) {
            $criteria->add(ConfigTableMap::COL_CONFIG_FORMAT, $this->config_format);
        }
        if ($this->isColumnModified(ConfigTableMap::COL_VERSION)) {
            $criteria->add(ConfigTableMap::COL_VERSION, $this->version);
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
        $criteria = ChildConfigQuery::create();
        $criteria->add(ConfigTableMap::COL_CONFIG_ID, $this->config_id);

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
        $validPk = null !== $this->getConfigId();

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
        return $this->getConfigId();
    }

    /**
     * Generic method to set the primary key (config_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setConfigId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getConfigId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\Config (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setConfigCategoryId($this->getConfigCategoryId());
        $copyObj->setConfigKey($this->getConfigKey());
        $copyObj->setConfigValue($this->getConfigValue());
        $copyObj->setConfigFormat($this->getConfigFormat());
        $copyObj->setVersion($this->getVersion());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getConfigI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addConfigI18n($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getConfigVersions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addConfigVersion($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setConfigId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\Config Clone of current object.
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
     * Declares an association between this object and a ChildConfigCategory object.
     *
     * @param  ChildConfigCategory $v
     * @return $this|\App\Propel\Config The current object (for fluent API support)
     * @throws PropelException
     */
    public function setConfigCategory(ChildConfigCategory $v = null)
    {
        if ($v === null) {
            $this->setConfigCategoryId(NULL);
        } else {
            $this->setConfigCategoryId($v->getConfigCategoryId());
        }

        $this->aConfigCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildConfigCategory object, it will not be re-added.
        if ($v !== null) {
            $v->addConfig($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildConfigCategory object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildConfigCategory The associated ChildConfigCategory object.
     * @throws PropelException
     */
    public function getConfigCategory(ConnectionInterface $con = null)
    {
        if ($this->aConfigCategory === null && ($this->config_category_id !== null)) {
            $this->aConfigCategory = ChildConfigCategoryQuery::create()->findPk($this->config_category_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aConfigCategory->addConfigs($this);
             */
        }

        return $this->aConfigCategory;
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
        if ('ConfigI18n' == $relationName) {
            return $this->initConfigI18ns();
        }
        if ('ConfigVersion' == $relationName) {
            return $this->initConfigVersions();
        }
    }

    /**
     * Clears out the collConfigI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addConfigI18ns()
     */
    public function clearConfigI18ns()
    {
        $this->collConfigI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collConfigI18ns collection loaded partially.
     */
    public function resetPartialConfigI18ns($v = true)
    {
        $this->collConfigI18nsPartial = $v;
    }

    /**
     * Initializes the collConfigI18ns collection.
     *
     * By default this just sets the collConfigI18ns collection to an empty array (like clearcollConfigI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initConfigI18ns($overrideExisting = true)
    {
        if (null !== $this->collConfigI18ns && !$overrideExisting) {
            return;
        }

        $collectionClassName = ConfigI18nTableMap::getTableMap()->getCollectionClassName();

        $this->collConfigI18ns = new $collectionClassName;
        $this->collConfigI18ns->setModel('\App\Propel\ConfigI18n');
    }

    /**
     * Gets an array of ChildConfigI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildConfig is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildConfigI18n[] List of ChildConfigI18n objects
     * @throws PropelException
     */
    public function getConfigI18ns(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collConfigI18nsPartial && !$this->isNew();
        if (null === $this->collConfigI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collConfigI18ns) {
                // return empty collection
                $this->initConfigI18ns();
            } else {
                $collConfigI18ns = ChildConfigI18nQuery::create(null, $criteria)
                    ->filterByConfig($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collConfigI18nsPartial && count($collConfigI18ns)) {
                        $this->initConfigI18ns(false);

                        foreach ($collConfigI18ns as $obj) {
                            if (false == $this->collConfigI18ns->contains($obj)) {
                                $this->collConfigI18ns->append($obj);
                            }
                        }

                        $this->collConfigI18nsPartial = true;
                    }

                    return $collConfigI18ns;
                }

                if ($partial && $this->collConfigI18ns) {
                    foreach ($this->collConfigI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collConfigI18ns[] = $obj;
                        }
                    }
                }

                $this->collConfigI18ns = $collConfigI18ns;
                $this->collConfigI18nsPartial = false;
            }
        }

        return $this->collConfigI18ns;
    }

    /**
     * Sets a collection of ChildConfigI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $configI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildConfig The current object (for fluent API support)
     */
    public function setConfigI18ns(Collection $configI18ns, ConnectionInterface $con = null)
    {
        /** @var ChildConfigI18n[] $configI18nsToDelete */
        $configI18nsToDelete = $this->getConfigI18ns(new Criteria(), $con)->diff($configI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->configI18nsScheduledForDeletion = clone $configI18nsToDelete;

        foreach ($configI18nsToDelete as $configI18nRemoved) {
            $configI18nRemoved->setConfig(null);
        }

        $this->collConfigI18ns = null;
        foreach ($configI18ns as $configI18n) {
            $this->addConfigI18n($configI18n);
        }

        $this->collConfigI18ns = $configI18ns;
        $this->collConfigI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ConfigI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ConfigI18n objects.
     * @throws PropelException
     */
    public function countConfigI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collConfigI18nsPartial && !$this->isNew();
        if (null === $this->collConfigI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collConfigI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getConfigI18ns());
            }

            $query = ChildConfigI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByConfig($this)
                ->count($con);
        }

        return count($this->collConfigI18ns);
    }

    /**
     * Method called to associate a ChildConfigI18n object to this object
     * through the ChildConfigI18n foreign key attribute.
     *
     * @param  ChildConfigI18n $l ChildConfigI18n
     * @return $this|\App\Propel\Config The current object (for fluent API support)
     */
    public function addConfigI18n(ChildConfigI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collConfigI18ns === null) {
            $this->initConfigI18ns();
            $this->collConfigI18nsPartial = true;
        }

        if (!$this->collConfigI18ns->contains($l)) {
            $this->doAddConfigI18n($l);

            if ($this->configI18nsScheduledForDeletion and $this->configI18nsScheduledForDeletion->contains($l)) {
                $this->configI18nsScheduledForDeletion->remove($this->configI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildConfigI18n $configI18n The ChildConfigI18n object to add.
     */
    protected function doAddConfigI18n(ChildConfigI18n $configI18n)
    {
        $this->collConfigI18ns[]= $configI18n;
        $configI18n->setConfig($this);
    }

    /**
     * @param  ChildConfigI18n $configI18n The ChildConfigI18n object to remove.
     * @return $this|ChildConfig The current object (for fluent API support)
     */
    public function removeConfigI18n(ChildConfigI18n $configI18n)
    {
        if ($this->getConfigI18ns()->contains($configI18n)) {
            $pos = $this->collConfigI18ns->search($configI18n);
            $this->collConfigI18ns->remove($pos);
            if (null === $this->configI18nsScheduledForDeletion) {
                $this->configI18nsScheduledForDeletion = clone $this->collConfigI18ns;
                $this->configI18nsScheduledForDeletion->clear();
            }
            $this->configI18nsScheduledForDeletion[]= clone $configI18n;
            $configI18n->setConfig(null);
        }

        return $this;
    }

    /**
     * Clears out the collConfigVersions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addConfigVersions()
     */
    public function clearConfigVersions()
    {
        $this->collConfigVersions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collConfigVersions collection loaded partially.
     */
    public function resetPartialConfigVersions($v = true)
    {
        $this->collConfigVersionsPartial = $v;
    }

    /**
     * Initializes the collConfigVersions collection.
     *
     * By default this just sets the collConfigVersions collection to an empty array (like clearcollConfigVersions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initConfigVersions($overrideExisting = true)
    {
        if (null !== $this->collConfigVersions && !$overrideExisting) {
            return;
        }

        $collectionClassName = ConfigVersionTableMap::getTableMap()->getCollectionClassName();

        $this->collConfigVersions = new $collectionClassName;
        $this->collConfigVersions->setModel('\App\Propel\ConfigVersion');
    }

    /**
     * Gets an array of ChildConfigVersion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildConfig is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildConfigVersion[] List of ChildConfigVersion objects
     * @throws PropelException
     */
    public function getConfigVersions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collConfigVersionsPartial && !$this->isNew();
        if (null === $this->collConfigVersions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collConfigVersions) {
                // return empty collection
                $this->initConfigVersions();
            } else {
                $collConfigVersions = ChildConfigVersionQuery::create(null, $criteria)
                    ->filterByConfig($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collConfigVersionsPartial && count($collConfigVersions)) {
                        $this->initConfigVersions(false);

                        foreach ($collConfigVersions as $obj) {
                            if (false == $this->collConfigVersions->contains($obj)) {
                                $this->collConfigVersions->append($obj);
                            }
                        }

                        $this->collConfigVersionsPartial = true;
                    }

                    return $collConfigVersions;
                }

                if ($partial && $this->collConfigVersions) {
                    foreach ($this->collConfigVersions as $obj) {
                        if ($obj->isNew()) {
                            $collConfigVersions[] = $obj;
                        }
                    }
                }

                $this->collConfigVersions = $collConfigVersions;
                $this->collConfigVersionsPartial = false;
            }
        }

        return $this->collConfigVersions;
    }

    /**
     * Sets a collection of ChildConfigVersion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $configVersions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildConfig The current object (for fluent API support)
     */
    public function setConfigVersions(Collection $configVersions, ConnectionInterface $con = null)
    {
        /** @var ChildConfigVersion[] $configVersionsToDelete */
        $configVersionsToDelete = $this->getConfigVersions(new Criteria(), $con)->diff($configVersions);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->configVersionsScheduledForDeletion = clone $configVersionsToDelete;

        foreach ($configVersionsToDelete as $configVersionRemoved) {
            $configVersionRemoved->setConfig(null);
        }

        $this->collConfigVersions = null;
        foreach ($configVersions as $configVersion) {
            $this->addConfigVersion($configVersion);
        }

        $this->collConfigVersions = $configVersions;
        $this->collConfigVersionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ConfigVersion objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ConfigVersion objects.
     * @throws PropelException
     */
    public function countConfigVersions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collConfigVersionsPartial && !$this->isNew();
        if (null === $this->collConfigVersions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collConfigVersions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getConfigVersions());
            }

            $query = ChildConfigVersionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByConfig($this)
                ->count($con);
        }

        return count($this->collConfigVersions);
    }

    /**
     * Method called to associate a ChildConfigVersion object to this object
     * through the ChildConfigVersion foreign key attribute.
     *
     * @param  ChildConfigVersion $l ChildConfigVersion
     * @return $this|\App\Propel\Config The current object (for fluent API support)
     */
    public function addConfigVersion(ChildConfigVersion $l)
    {
        if ($this->collConfigVersions === null) {
            $this->initConfigVersions();
            $this->collConfigVersionsPartial = true;
        }

        if (!$this->collConfigVersions->contains($l)) {
            $this->doAddConfigVersion($l);

            if ($this->configVersionsScheduledForDeletion and $this->configVersionsScheduledForDeletion->contains($l)) {
                $this->configVersionsScheduledForDeletion->remove($this->configVersionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildConfigVersion $configVersion The ChildConfigVersion object to add.
     */
    protected function doAddConfigVersion(ChildConfigVersion $configVersion)
    {
        $this->collConfigVersions[]= $configVersion;
        $configVersion->setConfig($this);
    }

    /**
     * @param  ChildConfigVersion $configVersion The ChildConfigVersion object to remove.
     * @return $this|ChildConfig The current object (for fluent API support)
     */
    public function removeConfigVersion(ChildConfigVersion $configVersion)
    {
        if ($this->getConfigVersions()->contains($configVersion)) {
            $pos = $this->collConfigVersions->search($configVersion);
            $this->collConfigVersions->remove($pos);
            if (null === $this->configVersionsScheduledForDeletion) {
                $this->configVersionsScheduledForDeletion = clone $this->collConfigVersions;
                $this->configVersionsScheduledForDeletion->clear();
            }
            $this->configVersionsScheduledForDeletion[]= clone $configVersion;
            $configVersion->setConfig(null);
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
        if (null !== $this->aConfigCategory) {
            $this->aConfigCategory->removeConfig($this);
        }
        $this->config_id = null;
        $this->config_category_id = null;
        $this->config_key = null;
        $this->config_value = null;
        $this->config_format = null;
        $this->version = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->collConfigI18ns) {
                foreach ($this->collConfigI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collConfigVersions) {
                foreach ($this->collConfigVersions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collConfigI18ns = null;
        $this->collConfigVersions = null;
        $this->aConfigCategory = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ConfigTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    $this|ChildConfig The current object (for fluent API support)
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
     * @return ChildConfigI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collConfigI18ns) {
                foreach ($this->collConfigI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildConfigI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildConfigI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addConfigI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    $this|ChildConfig The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildConfigI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collConfigI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collConfigI18ns[$key]);
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
     * @return ChildConfigI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [config_name] column value.
         *
         * @return string
         */
        public function getConfigName()
        {
        return $this->getCurrentTranslation()->getConfigName();
    }


        /**
         * Set the value of [config_name] column.
         *
         * @param string $v new value
         * @return $this|\App\Propel\ConfigI18n The current object (for fluent API support)
         */
        public function setConfigName($v)
        {    $this->getCurrentTranslation()->setConfigName($v);

        return $this;
    }


        /**
         * Get the [config_description] column value.
         *
         * @return string
         */
        public function getConfigDescription()
        {
        return $this->getCurrentTranslation()->getConfigDescription();
    }


        /**
         * Set the value of [config_description] column.
         *
         * @param string $v new value
         * @return $this|\App\Propel\ConfigI18n The current object (for fluent API support)
         */
        public function setConfigDescription($v)
        {    $this->getCurrentTranslation()->setConfigDescription($v);

        return $this;
    }

    // versionable behavior

    /**
     * Enforce a new Version of this object upon next save.
     *
     * @return $this|\App\Propel\Config
     */
    public function enforceVersioning()
    {
        $this->enforceVersion = true;

        return $this;
    }

    /**
     * Checks whether the current state must be recorded as a version
     *
     * @return  boolean
     */
    public function isVersioningNecessary($con = null)
    {
        if ($this->alreadyInSave) {
            return false;
        }

        if ($this->enforceVersion) {
            return true;
        }

        if (ChildConfigQuery::isVersioningEnabled() && ($this->isNew() || $this->isModified()) || $this->isDeleted()) {
            return true;
        }

        return false;
    }

    /**
     * Creates a version of the current object and saves it.
     *
     * @param   ConnectionInterface $con the connection to use
     *
     * @return  ChildConfigVersion A version object
     */
    public function addVersion($con = null)
    {
        $this->enforceVersion = false;

        $version = new ChildConfigVersion();
        $version->setConfigId($this->getConfigId());
        $version->setConfigCategoryId($this->getConfigCategoryId());
        $version->setConfigKey($this->getConfigKey());
        $version->setConfigValue($this->getConfigValue());
        $version->setConfigFormat($this->getConfigFormat());
        $version->setVersion($this->getVersion());
        $version->setConfig($this);
        $version->save($con);

        return $version;
    }

    /**
     * Sets the properties of the current object to the value they had at a specific version
     *
     * @param   integer $versionNumber The version number to read
     * @param   ConnectionInterface $con The connection to use
     *
     * @return  $this|ChildConfig The current object (for fluent API support)
     */
    public function toVersion($versionNumber, $con = null)
    {
        $version = $this->getOneVersion($versionNumber, $con);
        if (!$version) {
            throw new PropelException(sprintf('No ChildConfig object found with version %d', $version));
        }
        $this->populateFromVersion($version, $con);

        return $this;
    }

    /**
     * Sets the properties of the current object to the value they had at a specific version
     *
     * @param ChildConfigVersion $version The version object to use
     * @param ConnectionInterface   $con the connection to use
     * @param array                 $loadedObjects objects that been loaded in a chain of populateFromVersion calls on referrer or fk objects.
     *
     * @return $this|ChildConfig The current object (for fluent API support)
     */
    public function populateFromVersion($version, $con = null, &$loadedObjects = array())
    {
        $loadedObjects['ChildConfig'][$version->getConfigId()][$version->getVersion()] = $this;
        $this->setConfigId($version->getConfigId());
        $this->setConfigCategoryId($version->getConfigCategoryId());
        $this->setConfigKey($version->getConfigKey());
        $this->setConfigValue($version->getConfigValue());
        $this->setConfigFormat($version->getConfigFormat());
        $this->setVersion($version->getVersion());

        return $this;
    }

    /**
     * Gets the latest persisted version number for the current object
     *
     * @param   ConnectionInterface $con the connection to use
     *
     * @return  integer
     */
    public function getLastVersionNumber($con = null)
    {
        $v = ChildConfigVersionQuery::create()
            ->filterByConfig($this)
            ->orderByVersion('desc')
            ->findOne($con);
        if (!$v) {
            return 0;
        }

        return $v->getVersion();
    }

    /**
     * Checks whether the current object is the latest one
     *
     * @param   ConnectionInterface $con the connection to use
     *
     * @return  Boolean
     */
    public function isLastVersion($con = null)
    {
        return $this->getLastVersionNumber($con) == $this->getVersion();
    }

    /**
     * Retrieves a version object for this entity and a version number
     *
     * @param   integer $versionNumber The version number to read
     * @param   ConnectionInterface $con the connection to use
     *
     * @return  ChildConfigVersion A version object
     */
    public function getOneVersion($versionNumber, $con = null)
    {
        return ChildConfigVersionQuery::create()
            ->filterByConfig($this)
            ->filterByVersion($versionNumber)
            ->findOne($con);
    }

    /**
     * Gets all the versions of this object, in incremental order
     *
     * @param   ConnectionInterface $con the connection to use
     *
     * @return  ObjectCollection|ChildConfigVersion[] A list of ChildConfigVersion objects
     */
    public function getAllVersions($con = null)
    {
        $criteria = new Criteria();
        $criteria->addAscendingOrderByColumn(ConfigVersionTableMap::COL_VERSION);

        return $this->getConfigVersions($criteria, $con);
    }

    /**
     * Compares the current object with another of its version.
     * <code>
     * print_r($book->compareVersion(1));
     * => array(
     *   '1' => array('Title' => 'Book title at version 1'),
     *   '2' => array('Title' => 'Book title at version 2')
     * );
     * </code>
     *
     * @param   integer             $versionNumber
     * @param   string              $keys Main key used for the result diff (versions|columns)
     * @param   ConnectionInterface $con the connection to use
     * @param   array               $ignoredColumns  The columns to exclude from the diff.
     *
     * @return  array A list of differences
     */
    public function compareVersion($versionNumber, $keys = 'columns', $con = null, $ignoredColumns = array())
    {
        $fromVersion = $this->toArray();
        $toVersion = $this->getOneVersion($versionNumber, $con)->toArray();

        return $this->computeDiff($fromVersion, $toVersion, $keys, $ignoredColumns);
    }

    /**
     * Compares two versions of the current object.
     * <code>
     * print_r($book->compareVersions(1, 2));
     * => array(
     *   '1' => array('Title' => 'Book title at version 1'),
     *   '2' => array('Title' => 'Book title at version 2')
     * );
     * </code>
     *
     * @param   integer             $fromVersionNumber
     * @param   integer             $toVersionNumber
     * @param   string              $keys Main key used for the result diff (versions|columns)
     * @param   ConnectionInterface $con the connection to use
     * @param   array               $ignoredColumns  The columns to exclude from the diff.
     *
     * @return  array A list of differences
     */
    public function compareVersions($fromVersionNumber, $toVersionNumber, $keys = 'columns', $con = null, $ignoredColumns = array())
    {
        $fromVersion = $this->getOneVersion($fromVersionNumber, $con)->toArray();
        $toVersion = $this->getOneVersion($toVersionNumber, $con)->toArray();

        return $this->computeDiff($fromVersion, $toVersion, $keys, $ignoredColumns);
    }

    /**
     * Computes the diff between two versions.
     * <code>
     * print_r($book->computeDiff(1, 2));
     * => array(
     *   '1' => array('Title' => 'Book title at version 1'),
     *   '2' => array('Title' => 'Book title at version 2')
     * );
     * </code>
     *
     * @param   array     $fromVersion     An array representing the original version.
     * @param   array     $toVersion       An array representing the destination version.
     * @param   string    $keys            Main key used for the result diff (versions|columns).
     * @param   array     $ignoredColumns  The columns to exclude from the diff.
     *
     * @return  array A list of differences
     */
    protected function computeDiff($fromVersion, $toVersion, $keys = 'columns', $ignoredColumns = array())
    {
        $fromVersionNumber = $fromVersion['Version'];
        $toVersionNumber = $toVersion['Version'];
        $ignoredColumns = array_merge(array(
            'Version',
        ), $ignoredColumns);
        $diff = array();
        foreach ($fromVersion as $key => $value) {
            if (in_array($key, $ignoredColumns)) {
                continue;
            }
            if ($toVersion[$key] != $value) {
                switch ($keys) {
                    case 'versions':
                        $diff[$fromVersionNumber][$key] = $value;
                        $diff[$toVersionNumber][$key] = $toVersion[$key];
                        break;
                    default:
                        $diff[$key] = array(
                            $fromVersionNumber => $value,
                            $toVersionNumber => $toVersion[$key],
                        );
                        break;
                }
            }
        }

        return $diff;
    }
    /**
     * retrieve the last $number versions.
     *
     * @param Integer $number the number of record to return.
     * @return PropelCollection|\App\Propel\ConfigVersion[] List of \App\Propel\ConfigVersion objects
     */
    public function getLastVersions($number = 10, $criteria = null, $con = null)
    {
        $criteria = ChildConfigVersionQuery::create(null, $criteria);
        $criteria->addDescendingOrderByColumn(ConfigVersionTableMap::COL_VERSION);
        $criteria->limit($number);

        return $this->getConfigVersions($criteria, $con);
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
