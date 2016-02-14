<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Config as ChildConfig;
use App\Propel\ConfigQuery as ChildConfigQuery;
use App\Propel\ConfigVersionQuery as ChildConfigVersionQuery;
use App\Propel\Map\ConfigVersionTableMap;
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

/**
 * Base class that represents a row from the 'config_version' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class ConfigVersion implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\ConfigVersionTableMap';


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
     * @var        ChildConfig
     */
    protected $aConfig;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

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
     * Initializes internal state of App\Propel\Base\ConfigVersion object.
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
     * Compares this with another <code>ConfigVersion</code> instance.  If
     * <code>obj</code> is an instance of <code>ConfigVersion</code>, delegates to
     * <code>equals(ConfigVersion)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|ConfigVersion The current object, for fluid interface
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
     * @return $this|\App\Propel\ConfigVersion The current object (for fluent API support)
     */
    public function setConfigId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->config_id !== $v) {
            $this->config_id = $v;
            $this->modifiedColumns[ConfigVersionTableMap::COL_CONFIG_ID] = true;
        }

        if ($this->aConfig !== null && $this->aConfig->getConfigId() !== $v) {
            $this->aConfig = null;
        }

        return $this;
    } // setConfigId()

    /**
     * Set the value of [config_category_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\ConfigVersion The current object (for fluent API support)
     */
    public function setConfigCategoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->config_category_id !== $v) {
            $this->config_category_id = $v;
            $this->modifiedColumns[ConfigVersionTableMap::COL_CONFIG_CATEGORY_ID] = true;
        }

        return $this;
    } // setConfigCategoryId()

    /**
     * Set the value of [config_key] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\ConfigVersion The current object (for fluent API support)
     */
    public function setConfigKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->config_key !== $v) {
            $this->config_key = $v;
            $this->modifiedColumns[ConfigVersionTableMap::COL_CONFIG_KEY] = true;
        }

        return $this;
    } // setConfigKey()

    /**
     * Set the value of [config_value] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\ConfigVersion The current object (for fluent API support)
     */
    public function setConfigValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->config_value !== $v) {
            $this->config_value = $v;
            $this->modifiedColumns[ConfigVersionTableMap::COL_CONFIG_VALUE] = true;
        }

        return $this;
    } // setConfigValue()

    /**
     * Set the value of [config_format] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\ConfigVersion The current object (for fluent API support)
     */
    public function setConfigFormat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->config_format !== $v) {
            $this->config_format = $v;
            $this->modifiedColumns[ConfigVersionTableMap::COL_CONFIG_FORMAT] = true;
        }

        return $this;
    } // setConfigFormat()

    /**
     * Set the value of [version] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\ConfigVersion The current object (for fluent API support)
     */
    public function setVersion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->version !== $v) {
            $this->version = $v;
            $this->modifiedColumns[ConfigVersionTableMap::COL_VERSION] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ConfigVersionTableMap::translateFieldName('ConfigId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ConfigVersionTableMap::translateFieldName('ConfigCategoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_category_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ConfigVersionTableMap::translateFieldName('ConfigKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ConfigVersionTableMap::translateFieldName('ConfigValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ConfigVersionTableMap::translateFieldName('ConfigFormat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->config_format = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ConfigVersionTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = ConfigVersionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\ConfigVersion'), 0, $e);
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
        if ($this->aConfig !== null && $this->config_id !== $this->aConfig->getConfigId()) {
            $this->aConfig = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ConfigVersionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildConfigVersionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aConfig = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see ConfigVersion::setDeleted()
     * @see ConfigVersion::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigVersionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildConfigVersionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigVersionTableMap::DATABASE_NAME);
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
                ConfigVersionTableMap::addInstanceToPool($this);
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

            if ($this->aConfig !== null) {
                if ($this->aConfig->isModified() || $this->aConfig->isNew()) {
                    $affectedRows += $this->aConfig->save($con);
                }
                $this->setConfig($this->aConfig);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ConfigVersionTableMap::COL_CONFIG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'config_id';
        }
        if ($this->isColumnModified(ConfigVersionTableMap::COL_CONFIG_CATEGORY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'config_category_id';
        }
        if ($this->isColumnModified(ConfigVersionTableMap::COL_CONFIG_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'config_key';
        }
        if ($this->isColumnModified(ConfigVersionTableMap::COL_CONFIG_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'config_value';
        }
        if ($this->isColumnModified(ConfigVersionTableMap::COL_CONFIG_FORMAT)) {
            $modifiedColumns[':p' . $index++]  = 'config_format';
        }
        if ($this->isColumnModified(ConfigVersionTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = 'version';
        }

        $sql = sprintf(
            'INSERT INTO config_version (%s) VALUES (%s)',
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
        $pos = ConfigVersionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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

        if (isset($alreadyDumpedObjects['ConfigVersion'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ConfigVersion'][$this->hashCode()] = true;
        $keys = ConfigVersionTableMap::getFieldNames($keyType);
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
            if (null !== $this->aConfig) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'config';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'config';
                        break;
                    default:
                        $key = 'Config';
                }

                $result[$key] = $this->aConfig->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\App\Propel\ConfigVersion
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ConfigVersionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\ConfigVersion
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
        $keys = ConfigVersionTableMap::getFieldNames($keyType);

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
     * @return $this|\App\Propel\ConfigVersion The current object, for fluid interface
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
        $criteria = new Criteria(ConfigVersionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ConfigVersionTableMap::COL_CONFIG_ID)) {
            $criteria->add(ConfigVersionTableMap::COL_CONFIG_ID, $this->config_id);
        }
        if ($this->isColumnModified(ConfigVersionTableMap::COL_CONFIG_CATEGORY_ID)) {
            $criteria->add(ConfigVersionTableMap::COL_CONFIG_CATEGORY_ID, $this->config_category_id);
        }
        if ($this->isColumnModified(ConfigVersionTableMap::COL_CONFIG_KEY)) {
            $criteria->add(ConfigVersionTableMap::COL_CONFIG_KEY, $this->config_key);
        }
        if ($this->isColumnModified(ConfigVersionTableMap::COL_CONFIG_VALUE)) {
            $criteria->add(ConfigVersionTableMap::COL_CONFIG_VALUE, $this->config_value);
        }
        if ($this->isColumnModified(ConfigVersionTableMap::COL_CONFIG_FORMAT)) {
            $criteria->add(ConfigVersionTableMap::COL_CONFIG_FORMAT, $this->config_format);
        }
        if ($this->isColumnModified(ConfigVersionTableMap::COL_VERSION)) {
            $criteria->add(ConfigVersionTableMap::COL_VERSION, $this->version);
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
        $criteria = ChildConfigVersionQuery::create();
        $criteria->add(ConfigVersionTableMap::COL_CONFIG_ID, $this->config_id);
        $criteria->add(ConfigVersionTableMap::COL_VERSION, $this->version);

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
        $validPk = null !== $this->getConfigId() &&
            null !== $this->getVersion();

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation config_version_fk_cc79ea to table config
        if ($this->aConfig && $hash = spl_object_hash($this->aConfig)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getConfigId();
        $pks[1] = $this->getVersion();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setConfigId($keys[0]);
        $this->setVersion($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getConfigId()) && (null === $this->getVersion());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\ConfigVersion (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setConfigId($this->getConfigId());
        $copyObj->setConfigCategoryId($this->getConfigCategoryId());
        $copyObj->setConfigKey($this->getConfigKey());
        $copyObj->setConfigValue($this->getConfigValue());
        $copyObj->setConfigFormat($this->getConfigFormat());
        $copyObj->setVersion($this->getVersion());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \App\Propel\ConfigVersion Clone of current object.
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
     * Declares an association between this object and a ChildConfig object.
     *
     * @param  ChildConfig $v
     * @return $this|\App\Propel\ConfigVersion The current object (for fluent API support)
     * @throws PropelException
     */
    public function setConfig(ChildConfig $v = null)
    {
        if ($v === null) {
            $this->setConfigId(NULL);
        } else {
            $this->setConfigId($v->getConfigId());
        }

        $this->aConfig = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildConfig object, it will not be re-added.
        if ($v !== null) {
            $v->addConfigVersion($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildConfig object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildConfig The associated ChildConfig object.
     * @throws PropelException
     */
    public function getConfig(ConnectionInterface $con = null)
    {
        if ($this->aConfig === null && ($this->config_id !== null)) {
            $this->aConfig = ChildConfigQuery::create()->findPk($this->config_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aConfig->addConfigVersions($this);
             */
        }

        return $this->aConfig;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aConfig) {
            $this->aConfig->removeConfigVersion($this);
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
        } // if ($deep)

        $this->aConfig = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ConfigVersionTableMap::DEFAULT_STRING_FORMAT);
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
