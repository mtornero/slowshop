<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Resource as ChildResource;
use App\Propel\ResourceQuery as ChildResourceQuery;
use App\Propel\ResourceType as ChildResourceType;
use App\Propel\ResourceTypeI18n as ChildResourceTypeI18n;
use App\Propel\ResourceTypeI18nQuery as ChildResourceTypeI18nQuery;
use App\Propel\ResourceTypeQuery as ChildResourceTypeQuery;
use App\Propel\Map\ResourceTableMap;
use App\Propel\Map\ResourceTypeI18nTableMap;
use App\Propel\Map\ResourceTypeTableMap;
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
 * Base class that represents a row from the 'resource_type' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class ResourceType implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\ResourceTypeTableMap';


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
     * The value for the resource_type_id field.
     *
     * @var        int
     */
    protected $resource_type_id;

    /**
     * The value for the resource_type_code field.
     *
     * @var        string
     */
    protected $resource_type_code;

    /**
     * @var        ObjectCollection|ChildResource[] Collection to store aggregation of ChildResource objects.
     */
    protected $collResources;
    protected $collResourcesPartial;

    /**
     * @var        ObjectCollection|ChildResourceTypeI18n[] Collection to store aggregation of ChildResourceTypeI18n objects.
     */
    protected $collResourceTypeI18ns;
    protected $collResourceTypeI18nsPartial;

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
     * @var        array[ChildResourceTypeI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildResource[]
     */
    protected $resourcesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildResourceTypeI18n[]
     */
    protected $resourceTypeI18nsScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Propel\Base\ResourceType object.
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
     * Compares this with another <code>ResourceType</code> instance.  If
     * <code>obj</code> is an instance of <code>ResourceType</code>, delegates to
     * <code>equals(ResourceType)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|ResourceType The current object, for fluid interface
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
     * Get the [resource_type_id] column value.
     *
     * @return int
     */
    public function getResourceTypeId()
    {
        return $this->resource_type_id;
    }

    /**
     * Get the [resource_type_code] column value.
     *
     * @return string
     */
    public function getResourceTypeCode()
    {
        return $this->resource_type_code;
    }

    /**
     * Set the value of [resource_type_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\ResourceType The current object (for fluent API support)
     */
    public function setResourceTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->resource_type_id !== $v) {
            $this->resource_type_id = $v;
            $this->modifiedColumns[ResourceTypeTableMap::COL_RESOURCE_TYPE_ID] = true;
        }

        return $this;
    } // setResourceTypeId()

    /**
     * Set the value of [resource_type_code] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\ResourceType The current object (for fluent API support)
     */
    public function setResourceTypeCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->resource_type_code !== $v) {
            $this->resource_type_code = $v;
            $this->modifiedColumns[ResourceTypeTableMap::COL_RESOURCE_TYPE_CODE] = true;
        }

        return $this;
    } // setResourceTypeCode()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ResourceTypeTableMap::translateFieldName('ResourceTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resource_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ResourceTypeTableMap::translateFieldName('ResourceTypeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resource_type_code = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = ResourceTypeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\ResourceType'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(ResourceTypeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildResourceTypeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collResources = null;

            $this->collResourceTypeI18ns = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see ResourceType::setDeleted()
     * @see ResourceType::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceTypeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildResourceTypeQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceTypeTableMap::DATABASE_NAME);
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
                ResourceTypeTableMap::addInstanceToPool($this);
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

            if ($this->resourcesScheduledForDeletion !== null) {
                if (!$this->resourcesScheduledForDeletion->isEmpty()) {
                    \App\Propel\ResourceQuery::create()
                        ->filterByPrimaryKeys($this->resourcesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->resourcesScheduledForDeletion = null;
                }
            }

            if ($this->collResources !== null) {
                foreach ($this->collResources as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->resourceTypeI18nsScheduledForDeletion !== null) {
                if (!$this->resourceTypeI18nsScheduledForDeletion->isEmpty()) {
                    \App\Propel\ResourceTypeI18nQuery::create()
                        ->filterByPrimaryKeys($this->resourceTypeI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->resourceTypeI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collResourceTypeI18ns !== null) {
                foreach ($this->collResourceTypeI18ns as $referrerFK) {
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

        $this->modifiedColumns[ResourceTypeTableMap::COL_RESOURCE_TYPE_ID] = true;
        if (null !== $this->resource_type_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ResourceTypeTableMap::COL_RESOURCE_TYPE_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'resource_type_id';
        }
        if ($this->isColumnModified(ResourceTypeTableMap::COL_RESOURCE_TYPE_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'resource_type_code';
        }

        $sql = sprintf(
            'INSERT INTO resource_type (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'resource_type_id':
                        $stmt->bindValue($identifier, $this->resource_type_id, PDO::PARAM_INT);
                        break;
                    case 'resource_type_code':
                        $stmt->bindValue($identifier, $this->resource_type_code, PDO::PARAM_STR);
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
        $this->setResourceTypeId($pk);

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
        $pos = ResourceTypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getResourceTypeId();
                break;
            case 1:
                return $this->getResourceTypeCode();
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

        if (isset($alreadyDumpedObjects['ResourceType'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ResourceType'][$this->hashCode()] = true;
        $keys = ResourceTypeTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getResourceTypeId(),
            $keys[1] => $this->getResourceTypeCode(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collResources) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'resources';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'resources';
                        break;
                    default:
                        $key = 'Resources';
                }

                $result[$key] = $this->collResources->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collResourceTypeI18ns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'resourceTypeI18ns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'resource_type_i18ns';
                        break;
                    default:
                        $key = 'ResourceTypeI18ns';
                }

                $result[$key] = $this->collResourceTypeI18ns->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Propel\ResourceType
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ResourceTypeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\ResourceType
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setResourceTypeId($value);
                break;
            case 1:
                $this->setResourceTypeCode($value);
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
        $keys = ResourceTypeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setResourceTypeId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setResourceTypeCode($arr[$keys[1]]);
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
     * @return $this|\App\Propel\ResourceType The current object, for fluid interface
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
        $criteria = new Criteria(ResourceTypeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID)) {
            $criteria->add(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID, $this->resource_type_id);
        }
        if ($this->isColumnModified(ResourceTypeTableMap::COL_RESOURCE_TYPE_CODE)) {
            $criteria->add(ResourceTypeTableMap::COL_RESOURCE_TYPE_CODE, $this->resource_type_code);
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
        $criteria = ChildResourceTypeQuery::create();
        $criteria->add(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID, $this->resource_type_id);

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
        $validPk = null !== $this->getResourceTypeId();

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
        return $this->getResourceTypeId();
    }

    /**
     * Generic method to set the primary key (resource_type_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setResourceTypeId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getResourceTypeId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\ResourceType (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setResourceTypeCode($this->getResourceTypeCode());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getResources() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addResource($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getResourceTypeI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addResourceTypeI18n($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setResourceTypeId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\ResourceType Clone of current object.
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
        if ('Resource' == $relationName) {
            return $this->initResources();
        }
        if ('ResourceTypeI18n' == $relationName) {
            return $this->initResourceTypeI18ns();
        }
    }

    /**
     * Clears out the collResources collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addResources()
     */
    public function clearResources()
    {
        $this->collResources = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collResources collection loaded partially.
     */
    public function resetPartialResources($v = true)
    {
        $this->collResourcesPartial = $v;
    }

    /**
     * Initializes the collResources collection.
     *
     * By default this just sets the collResources collection to an empty array (like clearcollResources());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initResources($overrideExisting = true)
    {
        if (null !== $this->collResources && !$overrideExisting) {
            return;
        }

        $collectionClassName = ResourceTableMap::getTableMap()->getCollectionClassName();

        $this->collResources = new $collectionClassName;
        $this->collResources->setModel('\App\Propel\Resource');
    }

    /**
     * Gets an array of ChildResource objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildResourceType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildResource[] List of ChildResource objects
     * @throws PropelException
     */
    public function getResources(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collResourcesPartial && !$this->isNew();
        if (null === $this->collResources || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collResources) {
                // return empty collection
                $this->initResources();
            } else {
                $collResources = ChildResourceQuery::create(null, $criteria)
                    ->filterByResourceType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collResourcesPartial && count($collResources)) {
                        $this->initResources(false);

                        foreach ($collResources as $obj) {
                            if (false == $this->collResources->contains($obj)) {
                                $this->collResources->append($obj);
                            }
                        }

                        $this->collResourcesPartial = true;
                    }

                    return $collResources;
                }

                if ($partial && $this->collResources) {
                    foreach ($this->collResources as $obj) {
                        if ($obj->isNew()) {
                            $collResources[] = $obj;
                        }
                    }
                }

                $this->collResources = $collResources;
                $this->collResourcesPartial = false;
            }
        }

        return $this->collResources;
    }

    /**
     * Sets a collection of ChildResource objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $resources A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildResourceType The current object (for fluent API support)
     */
    public function setResources(Collection $resources, ConnectionInterface $con = null)
    {
        /** @var ChildResource[] $resourcesToDelete */
        $resourcesToDelete = $this->getResources(new Criteria(), $con)->diff($resources);


        $this->resourcesScheduledForDeletion = $resourcesToDelete;

        foreach ($resourcesToDelete as $resourceRemoved) {
            $resourceRemoved->setResourceType(null);
        }

        $this->collResources = null;
        foreach ($resources as $resource) {
            $this->addResource($resource);
        }

        $this->collResources = $resources;
        $this->collResourcesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Resource objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Resource objects.
     * @throws PropelException
     */
    public function countResources(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collResourcesPartial && !$this->isNew();
        if (null === $this->collResources || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collResources) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getResources());
            }

            $query = ChildResourceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResourceType($this)
                ->count($con);
        }

        return count($this->collResources);
    }

    /**
     * Method called to associate a ChildResource object to this object
     * through the ChildResource foreign key attribute.
     *
     * @param  ChildResource $l ChildResource
     * @return $this|\App\Propel\ResourceType The current object (for fluent API support)
     */
    public function addResource(ChildResource $l)
    {
        if ($this->collResources === null) {
            $this->initResources();
            $this->collResourcesPartial = true;
        }

        if (!$this->collResources->contains($l)) {
            $this->doAddResource($l);

            if ($this->resourcesScheduledForDeletion and $this->resourcesScheduledForDeletion->contains($l)) {
                $this->resourcesScheduledForDeletion->remove($this->resourcesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildResource $resource The ChildResource object to add.
     */
    protected function doAddResource(ChildResource $resource)
    {
        $this->collResources[]= $resource;
        $resource->setResourceType($this);
    }

    /**
     * @param  ChildResource $resource The ChildResource object to remove.
     * @return $this|ChildResourceType The current object (for fluent API support)
     */
    public function removeResource(ChildResource $resource)
    {
        if ($this->getResources()->contains($resource)) {
            $pos = $this->collResources->search($resource);
            $this->collResources->remove($pos);
            if (null === $this->resourcesScheduledForDeletion) {
                $this->resourcesScheduledForDeletion = clone $this->collResources;
                $this->resourcesScheduledForDeletion->clear();
            }
            $this->resourcesScheduledForDeletion[]= clone $resource;
            $resource->setResourceType(null);
        }

        return $this;
    }

    /**
     * Clears out the collResourceTypeI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addResourceTypeI18ns()
     */
    public function clearResourceTypeI18ns()
    {
        $this->collResourceTypeI18ns = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collResourceTypeI18ns collection loaded partially.
     */
    public function resetPartialResourceTypeI18ns($v = true)
    {
        $this->collResourceTypeI18nsPartial = $v;
    }

    /**
     * Initializes the collResourceTypeI18ns collection.
     *
     * By default this just sets the collResourceTypeI18ns collection to an empty array (like clearcollResourceTypeI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initResourceTypeI18ns($overrideExisting = true)
    {
        if (null !== $this->collResourceTypeI18ns && !$overrideExisting) {
            return;
        }

        $collectionClassName = ResourceTypeI18nTableMap::getTableMap()->getCollectionClassName();

        $this->collResourceTypeI18ns = new $collectionClassName;
        $this->collResourceTypeI18ns->setModel('\App\Propel\ResourceTypeI18n');
    }

    /**
     * Gets an array of ChildResourceTypeI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildResourceType is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildResourceTypeI18n[] List of ChildResourceTypeI18n objects
     * @throws PropelException
     */
    public function getResourceTypeI18ns(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collResourceTypeI18nsPartial && !$this->isNew();
        if (null === $this->collResourceTypeI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collResourceTypeI18ns) {
                // return empty collection
                $this->initResourceTypeI18ns();
            } else {
                $collResourceTypeI18ns = ChildResourceTypeI18nQuery::create(null, $criteria)
                    ->filterByResourceType($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collResourceTypeI18nsPartial && count($collResourceTypeI18ns)) {
                        $this->initResourceTypeI18ns(false);

                        foreach ($collResourceTypeI18ns as $obj) {
                            if (false == $this->collResourceTypeI18ns->contains($obj)) {
                                $this->collResourceTypeI18ns->append($obj);
                            }
                        }

                        $this->collResourceTypeI18nsPartial = true;
                    }

                    return $collResourceTypeI18ns;
                }

                if ($partial && $this->collResourceTypeI18ns) {
                    foreach ($this->collResourceTypeI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collResourceTypeI18ns[] = $obj;
                        }
                    }
                }

                $this->collResourceTypeI18ns = $collResourceTypeI18ns;
                $this->collResourceTypeI18nsPartial = false;
            }
        }

        return $this->collResourceTypeI18ns;
    }

    /**
     * Sets a collection of ChildResourceTypeI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $resourceTypeI18ns A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildResourceType The current object (for fluent API support)
     */
    public function setResourceTypeI18ns(Collection $resourceTypeI18ns, ConnectionInterface $con = null)
    {
        /** @var ChildResourceTypeI18n[] $resourceTypeI18nsToDelete */
        $resourceTypeI18nsToDelete = $this->getResourceTypeI18ns(new Criteria(), $con)->diff($resourceTypeI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->resourceTypeI18nsScheduledForDeletion = clone $resourceTypeI18nsToDelete;

        foreach ($resourceTypeI18nsToDelete as $resourceTypeI18nRemoved) {
            $resourceTypeI18nRemoved->setResourceType(null);
        }

        $this->collResourceTypeI18ns = null;
        foreach ($resourceTypeI18ns as $resourceTypeI18n) {
            $this->addResourceTypeI18n($resourceTypeI18n);
        }

        $this->collResourceTypeI18ns = $resourceTypeI18ns;
        $this->collResourceTypeI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ResourceTypeI18n objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ResourceTypeI18n objects.
     * @throws PropelException
     */
    public function countResourceTypeI18ns(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collResourceTypeI18nsPartial && !$this->isNew();
        if (null === $this->collResourceTypeI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collResourceTypeI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getResourceTypeI18ns());
            }

            $query = ChildResourceTypeI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResourceType($this)
                ->count($con);
        }

        return count($this->collResourceTypeI18ns);
    }

    /**
     * Method called to associate a ChildResourceTypeI18n object to this object
     * through the ChildResourceTypeI18n foreign key attribute.
     *
     * @param  ChildResourceTypeI18n $l ChildResourceTypeI18n
     * @return $this|\App\Propel\ResourceType The current object (for fluent API support)
     */
    public function addResourceTypeI18n(ChildResourceTypeI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collResourceTypeI18ns === null) {
            $this->initResourceTypeI18ns();
            $this->collResourceTypeI18nsPartial = true;
        }

        if (!$this->collResourceTypeI18ns->contains($l)) {
            $this->doAddResourceTypeI18n($l);

            if ($this->resourceTypeI18nsScheduledForDeletion and $this->resourceTypeI18nsScheduledForDeletion->contains($l)) {
                $this->resourceTypeI18nsScheduledForDeletion->remove($this->resourceTypeI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildResourceTypeI18n $resourceTypeI18n The ChildResourceTypeI18n object to add.
     */
    protected function doAddResourceTypeI18n(ChildResourceTypeI18n $resourceTypeI18n)
    {
        $this->collResourceTypeI18ns[]= $resourceTypeI18n;
        $resourceTypeI18n->setResourceType($this);
    }

    /**
     * @param  ChildResourceTypeI18n $resourceTypeI18n The ChildResourceTypeI18n object to remove.
     * @return $this|ChildResourceType The current object (for fluent API support)
     */
    public function removeResourceTypeI18n(ChildResourceTypeI18n $resourceTypeI18n)
    {
        if ($this->getResourceTypeI18ns()->contains($resourceTypeI18n)) {
            $pos = $this->collResourceTypeI18ns->search($resourceTypeI18n);
            $this->collResourceTypeI18ns->remove($pos);
            if (null === $this->resourceTypeI18nsScheduledForDeletion) {
                $this->resourceTypeI18nsScheduledForDeletion = clone $this->collResourceTypeI18ns;
                $this->resourceTypeI18nsScheduledForDeletion->clear();
            }
            $this->resourceTypeI18nsScheduledForDeletion[]= clone $resourceTypeI18n;
            $resourceTypeI18n->setResourceType(null);
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
        $this->resource_type_id = null;
        $this->resource_type_code = null;
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
            if ($this->collResources) {
                foreach ($this->collResources as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collResourceTypeI18ns) {
                foreach ($this->collResourceTypeI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        $this->collResources = null;
        $this->collResourceTypeI18ns = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ResourceTypeTableMap::DEFAULT_STRING_FORMAT);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    $this|ChildResourceType The current object (for fluent API support)
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
     * @return ChildResourceTypeI18n */
    public function getTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collResourceTypeI18ns) {
                foreach ($this->collResourceTypeI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ChildResourceTypeI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ChildResourceTypeI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addResourceTypeI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    $this|ChildResourceType The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', ConnectionInterface $con = null)
    {
        if (!$this->isNew()) {
            ChildResourceTypeI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collResourceTypeI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collResourceTypeI18ns[$key]);
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
     * @return ChildResourceTypeI18n */
    public function getCurrentTranslation(ConnectionInterface $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [resource_type_name] column value.
         *
         * @return string
         */
        public function getResourceTypeName()
        {
        return $this->getCurrentTranslation()->getResourceTypeName();
    }


        /**
         * Set the value of [resource_type_name] column.
         *
         * @param string $v new value
         * @return $this|\App\Propel\ResourceTypeI18n The current object (for fluent API support)
         */
        public function setResourceTypeName($v)
        {    $this->getCurrentTranslation()->setResourceTypeName($v);

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