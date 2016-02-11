<?php

namespace App\Propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Propel\Category as ChildCategory;
use App\Propel\CategoryQuery as ChildCategoryQuery;
use App\Propel\File as ChildFile;
use App\Propel\FileQuery as ChildFileQuery;
use App\Propel\FileType as ChildFileType;
use App\Propel\FileTypeQuery as ChildFileTypeQuery;
use App\Propel\News as ChildNews;
use App\Propel\NewsQuery as ChildNewsQuery;
use App\Propel\PeriodicPlan as ChildPeriodicPlan;
use App\Propel\PeriodicPlanQuery as ChildPeriodicPlanQuery;
use App\Propel\Product as ChildProduct;
use App\Propel\ProductQuery as ChildProductQuery;
use App\Propel\Provider as ChildProvider;
use App\Propel\ProviderQuery as ChildProviderQuery;
use App\Propel\ResourceFile as ChildResourceFile;
use App\Propel\ResourceFileQuery as ChildResourceFileQuery;
use App\Propel\User as ChildUser;
use App\Propel\UserQuery as ChildUserQuery;
use App\Propel\Map\CategoryTableMap;
use App\Propel\Map\FileTableMap;
use App\Propel\Map\NewsTableMap;
use App\Propel\Map\PeriodicPlanTableMap;
use App\Propel\Map\ProductTableMap;
use App\Propel\Map\ProviderTableMap;
use App\Propel\Map\ResourceFileTableMap;
use App\Propel\Map\UserTableMap;
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
 * Base class that represents a row from the 'file' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class File implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\FileTableMap';


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
     * The value for the file_id field.
     *
     * @var        int
     */
    protected $file_id;

    /**
     * The value for the file_type_id field.
     *
     * @var        int
     */
    protected $file_type_id;

    /**
     * The value for the file_path field.
     *
     * @var        string
     */
    protected $file_path;

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
     * @var        ChildFileType
     */
    protected $aFileType;

    /**
     * @var        ObjectCollection|ChildCategory[] Collection to store aggregation of ChildCategory objects.
     */
    protected $collCategories;
    protected $collCategoriesPartial;

    /**
     * @var        ObjectCollection|ChildNews[] Collection to store aggregation of ChildNews objects.
     */
    protected $collNews;
    protected $collNewsPartial;

    /**
     * @var        ObjectCollection|ChildPeriodicPlan[] Collection to store aggregation of ChildPeriodicPlan objects.
     */
    protected $collPeriodicPlans;
    protected $collPeriodicPlansPartial;

    /**
     * @var        ObjectCollection|ChildProduct[] Collection to store aggregation of ChildProduct objects.
     */
    protected $collProducts;
    protected $collProductsPartial;

    /**
     * @var        ObjectCollection|ChildProvider[] Collection to store aggregation of ChildProvider objects.
     */
    protected $collProviders;
    protected $collProvidersPartial;

    /**
     * @var        ObjectCollection|ChildResourceFile[] Collection to store aggregation of ChildResourceFile objects.
     */
    protected $collResourceFiles;
    protected $collResourceFilesPartial;

    /**
     * @var        ObjectCollection|ChildUser[] Collection to store aggregation of ChildUser objects.
     */
    protected $collUsers;
    protected $collUsersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCategory[]
     */
    protected $categoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildNews[]
     */
    protected $newsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPeriodicPlan[]
     */
    protected $periodicPlansScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProduct[]
     */
    protected $productsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProvider[]
     */
    protected $providersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildResourceFile[]
     */
    protected $resourceFilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUser[]
     */
    protected $usersScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Propel\Base\File object.
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
     * Compares this with another <code>File</code> instance.  If
     * <code>obj</code> is an instance of <code>File</code>, delegates to
     * <code>equals(File)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|File The current object, for fluid interface
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
     * Get the [file_id] column value.
     *
     * @return int
     */
    public function getFileId()
    {
        return $this->file_id;
    }

    /**
     * Get the [file_type_id] column value.
     *
     * @return int
     */
    public function getFileTypeId()
    {
        return $this->file_type_id;
    }

    /**
     * Get the [file_path] column value.
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->file_path;
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
     * Set the value of [file_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function setFileId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->file_id !== $v) {
            $this->file_id = $v;
            $this->modifiedColumns[FileTableMap::COL_FILE_ID] = true;
        }

        return $this;
    } // setFileId()

    /**
     * Set the value of [file_type_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function setFileTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->file_type_id !== $v) {
            $this->file_type_id = $v;
            $this->modifiedColumns[FileTableMap::COL_FILE_TYPE_ID] = true;
        }

        if ($this->aFileType !== null && $this->aFileType->getFileTypeId() !== $v) {
            $this->aFileType = null;
        }

        return $this;
    } // setFileTypeId()

    /**
     * Set the value of [file_path] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function setFilePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file_path !== $v) {
            $this->file_path = $v;
            $this->modifiedColumns[FileTableMap::COL_FILE_PATH] = true;
        }

        return $this;
    } // setFilePath()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FileTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FileTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FileTableMap::translateFieldName('FileId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FileTableMap::translateFieldName('FileTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FileTableMap::translateFieldName('FilePath', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_path = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FileTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : FileTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = FileTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\File'), 0, $e);
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
        if ($this->aFileType !== null && $this->file_type_id !== $this->aFileType->getFileTypeId()) {
            $this->aFileType = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(FileTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFileQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFileType = null;
            $this->collCategories = null;

            $this->collNews = null;

            $this->collPeriodicPlans = null;

            $this->collProducts = null;

            $this->collProviders = null;

            $this->collResourceFiles = null;

            $this->collUsers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see File::setDeleted()
     * @see File::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FileTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFileQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(FileTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(FileTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(FileTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(FileTableMap::COL_UPDATED_AT)) {
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
                FileTableMap::addInstanceToPool($this);
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

            if ($this->aFileType !== null) {
                if ($this->aFileType->isModified() || $this->aFileType->isNew()) {
                    $affectedRows += $this->aFileType->save($con);
                }
                $this->setFileType($this->aFileType);
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

            if ($this->categoriesScheduledForDeletion !== null) {
                if (!$this->categoriesScheduledForDeletion->isEmpty()) {
                    foreach ($this->categoriesScheduledForDeletion as $category) {
                        // need to save related object because we set the relation to null
                        $category->save($con);
                    }
                    $this->categoriesScheduledForDeletion = null;
                }
            }

            if ($this->collCategories !== null) {
                foreach ($this->collCategories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->newsScheduledForDeletion !== null) {
                if (!$this->newsScheduledForDeletion->isEmpty()) {
                    foreach ($this->newsScheduledForDeletion as $news) {
                        // need to save related object because we set the relation to null
                        $news->save($con);
                    }
                    $this->newsScheduledForDeletion = null;
                }
            }

            if ($this->collNews !== null) {
                foreach ($this->collNews as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->periodicPlansScheduledForDeletion !== null) {
                if (!$this->periodicPlansScheduledForDeletion->isEmpty()) {
                    foreach ($this->periodicPlansScheduledForDeletion as $periodicPlan) {
                        // need to save related object because we set the relation to null
                        $periodicPlan->save($con);
                    }
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

            if ($this->productsScheduledForDeletion !== null) {
                if (!$this->productsScheduledForDeletion->isEmpty()) {
                    foreach ($this->productsScheduledForDeletion as $product) {
                        // need to save related object because we set the relation to null
                        $product->save($con);
                    }
                    $this->productsScheduledForDeletion = null;
                }
            }

            if ($this->collProducts !== null) {
                foreach ($this->collProducts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->providersScheduledForDeletion !== null) {
                if (!$this->providersScheduledForDeletion->isEmpty()) {
                    foreach ($this->providersScheduledForDeletion as $provider) {
                        // need to save related object because we set the relation to null
                        $provider->save($con);
                    }
                    $this->providersScheduledForDeletion = null;
                }
            }

            if ($this->collProviders !== null) {
                foreach ($this->collProviders as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->resourceFilesScheduledForDeletion !== null) {
                if (!$this->resourceFilesScheduledForDeletion->isEmpty()) {
                    \App\Propel\ResourceFileQuery::create()
                        ->filterByPrimaryKeys($this->resourceFilesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->resourceFilesScheduledForDeletion = null;
                }
            }

            if ($this->collResourceFiles !== null) {
                foreach ($this->collResourceFiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usersScheduledForDeletion !== null) {
                if (!$this->usersScheduledForDeletion->isEmpty()) {
                    foreach ($this->usersScheduledForDeletion as $user) {
                        // need to save related object because we set the relation to null
                        $user->save($con);
                    }
                    $this->usersScheduledForDeletion = null;
                }
            }

            if ($this->collUsers !== null) {
                foreach ($this->collUsers as $referrerFK) {
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

        $this->modifiedColumns[FileTableMap::COL_FILE_ID] = true;
        if (null !== $this->file_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FileTableMap::COL_FILE_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FileTableMap::COL_FILE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'file_id';
        }
        if ($this->isColumnModified(FileTableMap::COL_FILE_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'file_type_id';
        }
        if ($this->isColumnModified(FileTableMap::COL_FILE_PATH)) {
            $modifiedColumns[':p' . $index++]  = 'file_path';
        }
        if ($this->isColumnModified(FileTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(FileTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO file (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'file_id':
                        $stmt->bindValue($identifier, $this->file_id, PDO::PARAM_INT);
                        break;
                    case 'file_type_id':
                        $stmt->bindValue($identifier, $this->file_type_id, PDO::PARAM_INT);
                        break;
                    case 'file_path':
                        $stmt->bindValue($identifier, $this->file_path, PDO::PARAM_STR);
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
        $this->setFileId($pk);

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
        $pos = FileTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFileId();
                break;
            case 1:
                return $this->getFileTypeId();
                break;
            case 2:
                return $this->getFilePath();
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

        if (isset($alreadyDumpedObjects['File'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['File'][$this->hashCode()] = true;
        $keys = FileTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getFileId(),
            $keys[1] => $this->getFileTypeId(),
            $keys[2] => $this->getFilePath(),
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
            if (null !== $this->aFileType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'fileType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'file_type';
                        break;
                    default:
                        $key = 'FileType';
                }

                $result[$key] = $this->aFileType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCategories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'categories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'categories';
                        break;
                    default:
                        $key = 'Categories';
                }

                $result[$key] = $this->collCategories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNews) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'news';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'news';
                        break;
                    default:
                        $key = 'News';
                }

                $result[$key] = $this->collNews->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
            if (null !== $this->collProducts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'products';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'products';
                        break;
                    default:
                        $key = 'Products';
                }

                $result[$key] = $this->collProducts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProviders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'providers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'providers';
                        break;
                    default:
                        $key = 'Providers';
                }

                $result[$key] = $this->collProviders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collResourceFiles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'resourceFiles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'resource_files';
                        break;
                    default:
                        $key = 'ResourceFiles';
                }

                $result[$key] = $this->collResourceFiles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->collUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Propel\File
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = FileTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\File
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setFileId($value);
                break;
            case 1:
                $this->setFileTypeId($value);
                break;
            case 2:
                $this->setFilePath($value);
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
        $keys = FileTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setFileId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFileTypeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFilePath($arr[$keys[2]]);
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
     * @return $this|\App\Propel\File The current object, for fluid interface
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
        $criteria = new Criteria(FileTableMap::DATABASE_NAME);

        if ($this->isColumnModified(FileTableMap::COL_FILE_ID)) {
            $criteria->add(FileTableMap::COL_FILE_ID, $this->file_id);
        }
        if ($this->isColumnModified(FileTableMap::COL_FILE_TYPE_ID)) {
            $criteria->add(FileTableMap::COL_FILE_TYPE_ID, $this->file_type_id);
        }
        if ($this->isColumnModified(FileTableMap::COL_FILE_PATH)) {
            $criteria->add(FileTableMap::COL_FILE_PATH, $this->file_path);
        }
        if ($this->isColumnModified(FileTableMap::COL_CREATED_AT)) {
            $criteria->add(FileTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(FileTableMap::COL_UPDATED_AT)) {
            $criteria->add(FileTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildFileQuery::create();
        $criteria->add(FileTableMap::COL_FILE_ID, $this->file_id);

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
        $validPk = null !== $this->getFileId();

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
        return $this->getFileId();
    }

    /**
     * Generic method to set the primary key (file_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setFileId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getFileId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\File (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFileTypeId($this->getFileTypeId());
        $copyObj->setFilePath($this->getFilePath());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCategory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNews() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNews($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPeriodicPlans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPeriodicPlan($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProducts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProduct($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProviders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProvider($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getResourceFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addResourceFile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUser($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setFileId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\File Clone of current object.
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
     * Declares an association between this object and a ChildFileType object.
     *
     * @param  ChildFileType $v
     * @return $this|\App\Propel\File The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFileType(ChildFileType $v = null)
    {
        if ($v === null) {
            $this->setFileTypeId(NULL);
        } else {
            $this->setFileTypeId($v->getFileTypeId());
        }

        $this->aFileType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFileType object, it will not be re-added.
        if ($v !== null) {
            $v->addFile($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFileType object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildFileType The associated ChildFileType object.
     * @throws PropelException
     */
    public function getFileType(ConnectionInterface $con = null)
    {
        if ($this->aFileType === null && ($this->file_type_id !== null)) {
            $this->aFileType = ChildFileTypeQuery::create()->findPk($this->file_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFileType->addFiles($this);
             */
        }

        return $this->aFileType;
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
        if ('Category' == $relationName) {
            return $this->initCategories();
        }
        if ('News' == $relationName) {
            return $this->initNews();
        }
        if ('PeriodicPlan' == $relationName) {
            return $this->initPeriodicPlans();
        }
        if ('Product' == $relationName) {
            return $this->initProducts();
        }
        if ('Provider' == $relationName) {
            return $this->initProviders();
        }
        if ('ResourceFile' == $relationName) {
            return $this->initResourceFiles();
        }
        if ('User' == $relationName) {
            return $this->initUsers();
        }
    }

    /**
     * Clears out the collCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCategories()
     */
    public function clearCategories()
    {
        $this->collCategories = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCategories collection loaded partially.
     */
    public function resetPartialCategories($v = true)
    {
        $this->collCategoriesPartial = $v;
    }

    /**
     * Initializes the collCategories collection.
     *
     * By default this just sets the collCategories collection to an empty array (like clearcollCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCategories($overrideExisting = true)
    {
        if (null !== $this->collCategories && !$overrideExisting) {
            return;
        }

        $collectionClassName = CategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collCategories = new $collectionClassName;
        $this->collCategories->setModel('\App\Propel\Category');
    }

    /**
     * Gets an array of ChildCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCategory[] List of ChildCategory objects
     * @throws PropelException
     */
    public function getCategories(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoriesPartial && !$this->isNew();
        if (null === $this->collCategories || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCategories) {
                // return empty collection
                $this->initCategories();
            } else {
                $collCategories = ChildCategoryQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCategoriesPartial && count($collCategories)) {
                        $this->initCategories(false);

                        foreach ($collCategories as $obj) {
                            if (false == $this->collCategories->contains($obj)) {
                                $this->collCategories->append($obj);
                            }
                        }

                        $this->collCategoriesPartial = true;
                    }

                    return $collCategories;
                }

                if ($partial && $this->collCategories) {
                    foreach ($this->collCategories as $obj) {
                        if ($obj->isNew()) {
                            $collCategories[] = $obj;
                        }
                    }
                }

                $this->collCategories = $collCategories;
                $this->collCategoriesPartial = false;
            }
        }

        return $this->collCategories;
    }

    /**
     * Sets a collection of ChildCategory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $categories A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function setCategories(Collection $categories, ConnectionInterface $con = null)
    {
        /** @var ChildCategory[] $categoriesToDelete */
        $categoriesToDelete = $this->getCategories(new Criteria(), $con)->diff($categories);


        $this->categoriesScheduledForDeletion = $categoriesToDelete;

        foreach ($categoriesToDelete as $categoryRemoved) {
            $categoryRemoved->setFile(null);
        }

        $this->collCategories = null;
        foreach ($categories as $category) {
            $this->addCategory($category);
        }

        $this->collCategories = $categories;
        $this->collCategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Category objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Category objects.
     * @throws PropelException
     */
    public function countCategories(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoriesPartial && !$this->isNew();
        if (null === $this->collCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCategories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCategories());
            }

            $query = ChildCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collCategories);
    }

    /**
     * Method called to associate a ChildCategory object to this object
     * through the ChildCategory foreign key attribute.
     *
     * @param  ChildCategory $l ChildCategory
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function addCategory(ChildCategory $l)
    {
        if ($this->collCategories === null) {
            $this->initCategories();
            $this->collCategoriesPartial = true;
        }

        if (!$this->collCategories->contains($l)) {
            $this->doAddCategory($l);

            if ($this->categoriesScheduledForDeletion and $this->categoriesScheduledForDeletion->contains($l)) {
                $this->categoriesScheduledForDeletion->remove($this->categoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCategory $category The ChildCategory object to add.
     */
    protected function doAddCategory(ChildCategory $category)
    {
        $this->collCategories[]= $category;
        $category->setFile($this);
    }

    /**
     * @param  ChildCategory $category The ChildCategory object to remove.
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function removeCategory(ChildCategory $category)
    {
        if ($this->getCategories()->contains($category)) {
            $pos = $this->collCategories->search($category);
            $this->collCategories->remove($pos);
            if (null === $this->categoriesScheduledForDeletion) {
                $this->categoriesScheduledForDeletion = clone $this->collCategories;
                $this->categoriesScheduledForDeletion->clear();
            }
            $this->categoriesScheduledForDeletion[]= $category;
            $category->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related Categories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategory[] List of ChildCategory objects
     */
    public function getCategoriesJoinResource(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoryQuery::create(null, $criteria);
        $query->joinWith('Resource', $joinBehavior);

        return $this->getCategories($query, $con);
    }

    /**
     * Clears out the collNews collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addNews()
     */
    public function clearNews()
    {
        $this->collNews = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collNews collection loaded partially.
     */
    public function resetPartialNews($v = true)
    {
        $this->collNewsPartial = $v;
    }

    /**
     * Initializes the collNews collection.
     *
     * By default this just sets the collNews collection to an empty array (like clearcollNews());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNews($overrideExisting = true)
    {
        if (null !== $this->collNews && !$overrideExisting) {
            return;
        }

        $collectionClassName = NewsTableMap::getTableMap()->getCollectionClassName();

        $this->collNews = new $collectionClassName;
        $this->collNews->setModel('\App\Propel\News');
    }

    /**
     * Gets an array of ChildNews objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildNews[] List of ChildNews objects
     * @throws PropelException
     */
    public function getNews(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collNewsPartial && !$this->isNew();
        if (null === $this->collNews || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNews) {
                // return empty collection
                $this->initNews();
            } else {
                $collNews = ChildNewsQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNewsPartial && count($collNews)) {
                        $this->initNews(false);

                        foreach ($collNews as $obj) {
                            if (false == $this->collNews->contains($obj)) {
                                $this->collNews->append($obj);
                            }
                        }

                        $this->collNewsPartial = true;
                    }

                    return $collNews;
                }

                if ($partial && $this->collNews) {
                    foreach ($this->collNews as $obj) {
                        if ($obj->isNew()) {
                            $collNews[] = $obj;
                        }
                    }
                }

                $this->collNews = $collNews;
                $this->collNewsPartial = false;
            }
        }

        return $this->collNews;
    }

    /**
     * Sets a collection of ChildNews objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $news A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function setNews(Collection $news, ConnectionInterface $con = null)
    {
        /** @var ChildNews[] $newsToDelete */
        $newsToDelete = $this->getNews(new Criteria(), $con)->diff($news);


        $this->newsScheduledForDeletion = $newsToDelete;

        foreach ($newsToDelete as $newsRemoved) {
            $newsRemoved->setFile(null);
        }

        $this->collNews = null;
        foreach ($news as $news) {
            $this->addNews($news);
        }

        $this->collNews = $news;
        $this->collNewsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related News objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related News objects.
     * @throws PropelException
     */
    public function countNews(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collNewsPartial && !$this->isNew();
        if (null === $this->collNews || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNews) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNews());
            }

            $query = ChildNewsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collNews);
    }

    /**
     * Method called to associate a ChildNews object to this object
     * through the ChildNews foreign key attribute.
     *
     * @param  ChildNews $l ChildNews
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function addNews(ChildNews $l)
    {
        if ($this->collNews === null) {
            $this->initNews();
            $this->collNewsPartial = true;
        }

        if (!$this->collNews->contains($l)) {
            $this->doAddNews($l);

            if ($this->newsScheduledForDeletion and $this->newsScheduledForDeletion->contains($l)) {
                $this->newsScheduledForDeletion->remove($this->newsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildNews $news The ChildNews object to add.
     */
    protected function doAddNews(ChildNews $news)
    {
        $this->collNews[]= $news;
        $news->setFile($this);
    }

    /**
     * @param  ChildNews $news The ChildNews object to remove.
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function removeNews(ChildNews $news)
    {
        if ($this->getNews()->contains($news)) {
            $pos = $this->collNews->search($news);
            $this->collNews->remove($pos);
            if (null === $this->newsScheduledForDeletion) {
                $this->newsScheduledForDeletion = clone $this->collNews;
                $this->newsScheduledForDeletion->clear();
            }
            $this->newsScheduledForDeletion[]= $news;
            $news->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related News from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNews[] List of ChildNews objects
     */
    public function getNewsJoinResourceRelatedByResourceId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNewsQuery::create(null, $criteria);
        $query->joinWith('ResourceRelatedByResourceId', $joinBehavior);

        return $this->getNews($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related News from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNews[] List of ChildNews objects
     */
    public function getNewsJoinResourceRelatedByNewsFor(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNewsQuery::create(null, $criteria);
        $query->joinWith('ResourceRelatedByNewsFor', $joinBehavior);

        return $this->getNews($query, $con);
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
     * If this ChildFile is new, it will return
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
                    ->filterByFile($this)
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
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function setPeriodicPlans(Collection $periodicPlans, ConnectionInterface $con = null)
    {
        /** @var ChildPeriodicPlan[] $periodicPlansToDelete */
        $periodicPlansToDelete = $this->getPeriodicPlans(new Criteria(), $con)->diff($periodicPlans);


        $this->periodicPlansScheduledForDeletion = $periodicPlansToDelete;

        foreach ($periodicPlansToDelete as $periodicPlanRemoved) {
            $periodicPlanRemoved->setFile(null);
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
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collPeriodicPlans);
    }

    /**
     * Method called to associate a ChildPeriodicPlan object to this object
     * through the ChildPeriodicPlan foreign key attribute.
     *
     * @param  ChildPeriodicPlan $l ChildPeriodicPlan
     * @return $this|\App\Propel\File The current object (for fluent API support)
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
        $periodicPlan->setFile($this);
    }

    /**
     * @param  ChildPeriodicPlan $periodicPlan The ChildPeriodicPlan object to remove.
     * @return $this|ChildFile The current object (for fluent API support)
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
            $this->periodicPlansScheduledForDeletion[]= $periodicPlan;
            $periodicPlan->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related PeriodicPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPeriodicPlan[] List of ChildPeriodicPlan objects
     */
    public function getPeriodicPlansJoinResource(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPeriodicPlanQuery::create(null, $criteria);
        $query->joinWith('Resource', $joinBehavior);

        return $this->getPeriodicPlans($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related PeriodicPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPeriodicPlan[] List of ChildPeriodicPlan objects
     */
    public function getPeriodicPlansJoinPeriodicType(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPeriodicPlanQuery::create(null, $criteria);
        $query->joinWith('PeriodicType', $joinBehavior);

        return $this->getPeriodicPlans($query, $con);
    }

    /**
     * Clears out the collProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProducts()
     */
    public function clearProducts()
    {
        $this->collProducts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProducts collection loaded partially.
     */
    public function resetPartialProducts($v = true)
    {
        $this->collProductsPartial = $v;
    }

    /**
     * Initializes the collProducts collection.
     *
     * By default this just sets the collProducts collection to an empty array (like clearcollProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProducts($overrideExisting = true)
    {
        if (null !== $this->collProducts && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductTableMap::getTableMap()->getCollectionClassName();

        $this->collProducts = new $collectionClassName;
        $this->collProducts->setModel('\App\Propel\Product');
    }

    /**
     * Gets an array of ChildProduct objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProduct[] List of ChildProduct objects
     * @throws PropelException
     */
    public function getProducts(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductsPartial && !$this->isNew();
        if (null === $this->collProducts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProducts) {
                // return empty collection
                $this->initProducts();
            } else {
                $collProducts = ChildProductQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductsPartial && count($collProducts)) {
                        $this->initProducts(false);

                        foreach ($collProducts as $obj) {
                            if (false == $this->collProducts->contains($obj)) {
                                $this->collProducts->append($obj);
                            }
                        }

                        $this->collProductsPartial = true;
                    }

                    return $collProducts;
                }

                if ($partial && $this->collProducts) {
                    foreach ($this->collProducts as $obj) {
                        if ($obj->isNew()) {
                            $collProducts[] = $obj;
                        }
                    }
                }

                $this->collProducts = $collProducts;
                $this->collProductsPartial = false;
            }
        }

        return $this->collProducts;
    }

    /**
     * Sets a collection of ChildProduct objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $products A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function setProducts(Collection $products, ConnectionInterface $con = null)
    {
        /** @var ChildProduct[] $productsToDelete */
        $productsToDelete = $this->getProducts(new Criteria(), $con)->diff($products);


        $this->productsScheduledForDeletion = $productsToDelete;

        foreach ($productsToDelete as $productRemoved) {
            $productRemoved->setFile(null);
        }

        $this->collProducts = null;
        foreach ($products as $product) {
            $this->addProduct($product);
        }

        $this->collProducts = $products;
        $this->collProductsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Product objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Product objects.
     * @throws PropelException
     */
    public function countProducts(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductsPartial && !$this->isNew();
        if (null === $this->collProducts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProducts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProducts());
            }

            $query = ChildProductQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collProducts);
    }

    /**
     * Method called to associate a ChildProduct object to this object
     * through the ChildProduct foreign key attribute.
     *
     * @param  ChildProduct $l ChildProduct
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function addProduct(ChildProduct $l)
    {
        if ($this->collProducts === null) {
            $this->initProducts();
            $this->collProductsPartial = true;
        }

        if (!$this->collProducts->contains($l)) {
            $this->doAddProduct($l);

            if ($this->productsScheduledForDeletion and $this->productsScheduledForDeletion->contains($l)) {
                $this->productsScheduledForDeletion->remove($this->productsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProduct $product The ChildProduct object to add.
     */
    protected function doAddProduct(ChildProduct $product)
    {
        $this->collProducts[]= $product;
        $product->setFile($this);
    }

    /**
     * @param  ChildProduct $product The ChildProduct object to remove.
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function removeProduct(ChildProduct $product)
    {
        if ($this->getProducts()->contains($product)) {
            $pos = $this->collProducts->search($product);
            $this->collProducts->remove($pos);
            if (null === $this->productsScheduledForDeletion) {
                $this->productsScheduledForDeletion = clone $this->collProducts;
                $this->productsScheduledForDeletion->clear();
            }
            $this->productsScheduledForDeletion[]= $product;
            $product->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related Products from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProduct[] List of ChildProduct objects
     */
    public function getProductsJoinCategory(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductQuery::create(null, $criteria);
        $query->joinWith('Category', $joinBehavior);

        return $this->getProducts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related Products from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProduct[] List of ChildProduct objects
     */
    public function getProductsJoinProvider(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductQuery::create(null, $criteria);
        $query->joinWith('Provider', $joinBehavior);

        return $this->getProducts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related Products from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProduct[] List of ChildProduct objects
     */
    public function getProductsJoinUnit(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductQuery::create(null, $criteria);
        $query->joinWith('Unit', $joinBehavior);

        return $this->getProducts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related Products from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProduct[] List of ChildProduct objects
     */
    public function getProductsJoinResource(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductQuery::create(null, $criteria);
        $query->joinWith('Resource', $joinBehavior);

        return $this->getProducts($query, $con);
    }

    /**
     * Clears out the collProviders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProviders()
     */
    public function clearProviders()
    {
        $this->collProviders = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProviders collection loaded partially.
     */
    public function resetPartialProviders($v = true)
    {
        $this->collProvidersPartial = $v;
    }

    /**
     * Initializes the collProviders collection.
     *
     * By default this just sets the collProviders collection to an empty array (like clearcollProviders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProviders($overrideExisting = true)
    {
        if (null !== $this->collProviders && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProviderTableMap::getTableMap()->getCollectionClassName();

        $this->collProviders = new $collectionClassName;
        $this->collProviders->setModel('\App\Propel\Provider');
    }

    /**
     * Gets an array of ChildProvider objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProvider[] List of ChildProvider objects
     * @throws PropelException
     */
    public function getProviders(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProvidersPartial && !$this->isNew();
        if (null === $this->collProviders || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProviders) {
                // return empty collection
                $this->initProviders();
            } else {
                $collProviders = ChildProviderQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProvidersPartial && count($collProviders)) {
                        $this->initProviders(false);

                        foreach ($collProviders as $obj) {
                            if (false == $this->collProviders->contains($obj)) {
                                $this->collProviders->append($obj);
                            }
                        }

                        $this->collProvidersPartial = true;
                    }

                    return $collProviders;
                }

                if ($partial && $this->collProviders) {
                    foreach ($this->collProviders as $obj) {
                        if ($obj->isNew()) {
                            $collProviders[] = $obj;
                        }
                    }
                }

                $this->collProviders = $collProviders;
                $this->collProvidersPartial = false;
            }
        }

        return $this->collProviders;
    }

    /**
     * Sets a collection of ChildProvider objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $providers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function setProviders(Collection $providers, ConnectionInterface $con = null)
    {
        /** @var ChildProvider[] $providersToDelete */
        $providersToDelete = $this->getProviders(new Criteria(), $con)->diff($providers);


        $this->providersScheduledForDeletion = $providersToDelete;

        foreach ($providersToDelete as $providerRemoved) {
            $providerRemoved->setFile(null);
        }

        $this->collProviders = null;
        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }

        $this->collProviders = $providers;
        $this->collProvidersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Provider objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Provider objects.
     * @throws PropelException
     */
    public function countProviders(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProvidersPartial && !$this->isNew();
        if (null === $this->collProviders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProviders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProviders());
            }

            $query = ChildProviderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collProviders);
    }

    /**
     * Method called to associate a ChildProvider object to this object
     * through the ChildProvider foreign key attribute.
     *
     * @param  ChildProvider $l ChildProvider
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function addProvider(ChildProvider $l)
    {
        if ($this->collProviders === null) {
            $this->initProviders();
            $this->collProvidersPartial = true;
        }

        if (!$this->collProviders->contains($l)) {
            $this->doAddProvider($l);

            if ($this->providersScheduledForDeletion and $this->providersScheduledForDeletion->contains($l)) {
                $this->providersScheduledForDeletion->remove($this->providersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProvider $provider The ChildProvider object to add.
     */
    protected function doAddProvider(ChildProvider $provider)
    {
        $this->collProviders[]= $provider;
        $provider->setFile($this);
    }

    /**
     * @param  ChildProvider $provider The ChildProvider object to remove.
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function removeProvider(ChildProvider $provider)
    {
        if ($this->getProviders()->contains($provider)) {
            $pos = $this->collProviders->search($provider);
            $this->collProviders->remove($pos);
            if (null === $this->providersScheduledForDeletion) {
                $this->providersScheduledForDeletion = clone $this->collProviders;
                $this->providersScheduledForDeletion->clear();
            }
            $this->providersScheduledForDeletion[]= $provider;
            $provider->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related Providers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProvider[] List of ChildProvider objects
     */
    public function getProvidersJoinResource(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProviderQuery::create(null, $criteria);
        $query->joinWith('Resource', $joinBehavior);

        return $this->getProviders($query, $con);
    }

    /**
     * Clears out the collResourceFiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addResourceFiles()
     */
    public function clearResourceFiles()
    {
        $this->collResourceFiles = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collResourceFiles collection loaded partially.
     */
    public function resetPartialResourceFiles($v = true)
    {
        $this->collResourceFilesPartial = $v;
    }

    /**
     * Initializes the collResourceFiles collection.
     *
     * By default this just sets the collResourceFiles collection to an empty array (like clearcollResourceFiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initResourceFiles($overrideExisting = true)
    {
        if (null !== $this->collResourceFiles && !$overrideExisting) {
            return;
        }

        $collectionClassName = ResourceFileTableMap::getTableMap()->getCollectionClassName();

        $this->collResourceFiles = new $collectionClassName;
        $this->collResourceFiles->setModel('\App\Propel\ResourceFile');
    }

    /**
     * Gets an array of ChildResourceFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildResourceFile[] List of ChildResourceFile objects
     * @throws PropelException
     */
    public function getResourceFiles(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collResourceFilesPartial && !$this->isNew();
        if (null === $this->collResourceFiles || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collResourceFiles) {
                // return empty collection
                $this->initResourceFiles();
            } else {
                $collResourceFiles = ChildResourceFileQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collResourceFilesPartial && count($collResourceFiles)) {
                        $this->initResourceFiles(false);

                        foreach ($collResourceFiles as $obj) {
                            if (false == $this->collResourceFiles->contains($obj)) {
                                $this->collResourceFiles->append($obj);
                            }
                        }

                        $this->collResourceFilesPartial = true;
                    }

                    return $collResourceFiles;
                }

                if ($partial && $this->collResourceFiles) {
                    foreach ($this->collResourceFiles as $obj) {
                        if ($obj->isNew()) {
                            $collResourceFiles[] = $obj;
                        }
                    }
                }

                $this->collResourceFiles = $collResourceFiles;
                $this->collResourceFilesPartial = false;
            }
        }

        return $this->collResourceFiles;
    }

    /**
     * Sets a collection of ChildResourceFile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $resourceFiles A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function setResourceFiles(Collection $resourceFiles, ConnectionInterface $con = null)
    {
        /** @var ChildResourceFile[] $resourceFilesToDelete */
        $resourceFilesToDelete = $this->getResourceFiles(new Criteria(), $con)->diff($resourceFiles);


        $this->resourceFilesScheduledForDeletion = $resourceFilesToDelete;

        foreach ($resourceFilesToDelete as $resourceFileRemoved) {
            $resourceFileRemoved->setFile(null);
        }

        $this->collResourceFiles = null;
        foreach ($resourceFiles as $resourceFile) {
            $this->addResourceFile($resourceFile);
        }

        $this->collResourceFiles = $resourceFiles;
        $this->collResourceFilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ResourceFile objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ResourceFile objects.
     * @throws PropelException
     */
    public function countResourceFiles(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collResourceFilesPartial && !$this->isNew();
        if (null === $this->collResourceFiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collResourceFiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getResourceFiles());
            }

            $query = ChildResourceFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collResourceFiles);
    }

    /**
     * Method called to associate a ChildResourceFile object to this object
     * through the ChildResourceFile foreign key attribute.
     *
     * @param  ChildResourceFile $l ChildResourceFile
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function addResourceFile(ChildResourceFile $l)
    {
        if ($this->collResourceFiles === null) {
            $this->initResourceFiles();
            $this->collResourceFilesPartial = true;
        }

        if (!$this->collResourceFiles->contains($l)) {
            $this->doAddResourceFile($l);

            if ($this->resourceFilesScheduledForDeletion and $this->resourceFilesScheduledForDeletion->contains($l)) {
                $this->resourceFilesScheduledForDeletion->remove($this->resourceFilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildResourceFile $resourceFile The ChildResourceFile object to add.
     */
    protected function doAddResourceFile(ChildResourceFile $resourceFile)
    {
        $this->collResourceFiles[]= $resourceFile;
        $resourceFile->setFile($this);
    }

    /**
     * @param  ChildResourceFile $resourceFile The ChildResourceFile object to remove.
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function removeResourceFile(ChildResourceFile $resourceFile)
    {
        if ($this->getResourceFiles()->contains($resourceFile)) {
            $pos = $this->collResourceFiles->search($resourceFile);
            $this->collResourceFiles->remove($pos);
            if (null === $this->resourceFilesScheduledForDeletion) {
                $this->resourceFilesScheduledForDeletion = clone $this->collResourceFiles;
                $this->resourceFilesScheduledForDeletion->clear();
            }
            $this->resourceFilesScheduledForDeletion[]= clone $resourceFile;
            $resourceFile->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related ResourceFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildResourceFile[] List of ChildResourceFile objects
     */
    public function getResourceFilesJoinResource(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildResourceFileQuery::create(null, $criteria);
        $query->joinWith('Resource', $joinBehavior);

        return $this->getResourceFiles($query, $con);
    }

    /**
     * Clears out the collUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsers()
     */
    public function clearUsers()
    {
        $this->collUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUsers collection loaded partially.
     */
    public function resetPartialUsers($v = true)
    {
        $this->collUsersPartial = $v;
    }

    /**
     * Initializes the collUsers collection.
     *
     * By default this just sets the collUsers collection to an empty array (like clearcollUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsers($overrideExisting = true)
    {
        if (null !== $this->collUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserTableMap::getTableMap()->getCollectionClassName();

        $this->collUsers = new $collectionClassName;
        $this->collUsers->setModel('\App\Propel\User');
    }

    /**
     * Gets an array of ChildUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFile is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     * @throws PropelException
     */
    public function getUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                // return empty collection
                $this->initUsers();
            } else {
                $collUsers = ChildUserQuery::create(null, $criteria)
                    ->filterByFile($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUsersPartial && count($collUsers)) {
                        $this->initUsers(false);

                        foreach ($collUsers as $obj) {
                            if (false == $this->collUsers->contains($obj)) {
                                $this->collUsers->append($obj);
                            }
                        }

                        $this->collUsersPartial = true;
                    }

                    return $collUsers;
                }

                if ($partial && $this->collUsers) {
                    foreach ($this->collUsers as $obj) {
                        if ($obj->isNew()) {
                            $collUsers[] = $obj;
                        }
                    }
                }

                $this->collUsers = $collUsers;
                $this->collUsersPartial = false;
            }
        }

        return $this->collUsers;
    }

    /**
     * Sets a collection of ChildUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $users A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function setUsers(Collection $users, ConnectionInterface $con = null)
    {
        /** @var ChildUser[] $usersToDelete */
        $usersToDelete = $this->getUsers(new Criteria(), $con)->diff($users);


        $this->usersScheduledForDeletion = $usersToDelete;

        foreach ($usersToDelete as $userRemoved) {
            $userRemoved->setFile(null);
        }

        $this->collUsers = null;
        foreach ($users as $user) {
            $this->addUser($user);
        }

        $this->collUsers = $users;
        $this->collUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsers());
            }

            $query = ChildUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFile($this)
                ->count($con);
        }

        return count($this->collUsers);
    }

    /**
     * Method called to associate a ChildUser object to this object
     * through the ChildUser foreign key attribute.
     *
     * @param  ChildUser $l ChildUser
     * @return $this|\App\Propel\File The current object (for fluent API support)
     */
    public function addUser(ChildUser $l)
    {
        if ($this->collUsers === null) {
            $this->initUsers();
            $this->collUsersPartial = true;
        }

        if (!$this->collUsers->contains($l)) {
            $this->doAddUser($l);

            if ($this->usersScheduledForDeletion and $this->usersScheduledForDeletion->contains($l)) {
                $this->usersScheduledForDeletion->remove($this->usersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUser $user The ChildUser object to add.
     */
    protected function doAddUser(ChildUser $user)
    {
        $this->collUsers[]= $user;
        $user->setFile($this);
    }

    /**
     * @param  ChildUser $user The ChildUser object to remove.
     * @return $this|ChildFile The current object (for fluent API support)
     */
    public function removeUser(ChildUser $user)
    {
        if ($this->getUsers()->contains($user)) {
            $pos = $this->collUsers->search($user);
            $this->collUsers->remove($pos);
            if (null === $this->usersScheduledForDeletion) {
                $this->usersScheduledForDeletion = clone $this->collUsers;
                $this->usersScheduledForDeletion->clear();
            }
            $this->usersScheduledForDeletion[]= $user;
            $user->setFile(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related Users from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     */
    public function getUsersJoinRole(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserQuery::create(null, $criteria);
        $query->joinWith('Role', $joinBehavior);

        return $this->getUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this File is new, it will return
     * an empty collection; or if this File has previously
     * been saved, it will retrieve related Users from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in File.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     */
    public function getUsersJoinResource(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserQuery::create(null, $criteria);
        $query->joinWith('Resource', $joinBehavior);

        return $this->getUsers($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aFileType) {
            $this->aFileType->removeFile($this);
        }
        $this->file_id = null;
        $this->file_type_id = null;
        $this->file_path = null;
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
            if ($this->collCategories) {
                foreach ($this->collCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNews) {
                foreach ($this->collNews as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPeriodicPlans) {
                foreach ($this->collPeriodicPlans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProducts) {
                foreach ($this->collProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProviders) {
                foreach ($this->collProviders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collResourceFiles) {
                foreach ($this->collResourceFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsers) {
                foreach ($this->collUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCategories = null;
        $this->collNews = null;
        $this->collPeriodicPlans = null;
        $this->collProducts = null;
        $this->collProviders = null;
        $this->collResourceFiles = null;
        $this->collUsers = null;
        $this->aFileType = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FileTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildFile The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[FileTableMap::COL_UPDATED_AT] = true;

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
