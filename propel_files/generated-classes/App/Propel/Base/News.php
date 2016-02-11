<?php

namespace App\Propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Propel\File as ChildFile;
use App\Propel\FileQuery as ChildFileQuery;
use App\Propel\News as ChildNews;
use App\Propel\NewsQuery as ChildNewsQuery;
use App\Propel\Resource as ChildResource;
use App\Propel\ResourceQuery as ChildResourceQuery;
use App\Propel\Map\NewsTableMap;
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
 * Base class that represents a row from the 'news' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class News implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\NewsTableMap';


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
     * The value for the news_id field.
     *
     * @var        int
     */
    protected $news_id;

    /**
     * The value for the resource_id field.
     *
     * @var        int
     */
    protected $resource_id;

    /**
     * The value for the news_headline field.
     *
     * @var        string
     */
    protected $news_headline;

    /**
     * The value for the news_opening field.
     *
     * @var        string
     */
    protected $news_opening;

    /**
     * The value for the news_body field.
     *
     * @var        string
     */
    protected $news_body;

    /**
     * The value for the news_pic field.
     *
     * @var        int
     */
    protected $news_pic;

    /**
     * The value for the news_from field.
     *
     * @var        \DateTime
     */
    protected $news_from;

    /**
     * The value for the news_to field.
     *
     * @var        \DateTime
     */
    protected $news_to;

    /**
     * The value for the news_for field.
     *
     * @var        int
     */
    protected $news_for;

    /**
     * The value for the news_weight field.
     *
     * Note: this column has a database default value of: 5
     * @var        int
     */
    protected $news_weight;

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
     * @var        ChildResource
     */
    protected $aResourceRelatedByResourceId;

    /**
     * @var        ChildFile
     */
    protected $aFile;

    /**
     * @var        ChildResource
     */
    protected $aResourceRelatedByNewsFor;

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
        $this->news_weight = 5;
    }

    /**
     * Initializes internal state of App\Propel\Base\News object.
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
     * Compares this with another <code>News</code> instance.  If
     * <code>obj</code> is an instance of <code>News</code>, delegates to
     * <code>equals(News)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|News The current object, for fluid interface
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
     * Get the [news_id] column value.
     *
     * @return int
     */
    public function getNewsId()
    {
        return $this->news_id;
    }

    /**
     * Get the [resource_id] column value.
     *
     * @return int
     */
    public function getResourceId()
    {
        return $this->resource_id;
    }

    /**
     * Get the [news_headline] column value.
     *
     * @return string
     */
    public function getNewsHeadline()
    {
        return $this->news_headline;
    }

    /**
     * Get the [news_opening] column value.
     *
     * @return string
     */
    public function getNewsOpening()
    {
        return $this->news_opening;
    }

    /**
     * Get the [news_body] column value.
     *
     * @return string
     */
    public function getNewsBody()
    {
        return $this->news_body;
    }

    /**
     * Get the [news_pic] column value.
     *
     * @return int
     */
    public function getNewsPic()
    {
        return $this->news_pic;
    }

    /**
     * Get the [optionally formatted] temporal [news_from] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getNewsFrom($format = NULL)
    {
        if ($format === null) {
            return $this->news_from;
        } else {
            return $this->news_from instanceof \DateTime ? $this->news_from->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [news_to] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getNewsTo($format = NULL)
    {
        if ($format === null) {
            return $this->news_to;
        } else {
            return $this->news_to instanceof \DateTime ? $this->news_to->format($format) : null;
        }
    }

    /**
     * Get the [news_for] column value.
     *
     * @return int
     */
    public function getNewsFor()
    {
        return $this->news_for;
    }

    /**
     * Get the [news_weight] column value.
     *
     * @return int
     */
    public function getNewsWeight()
    {
        return $this->news_weight;
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
     * Set the value of [news_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setNewsId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->news_id !== $v) {
            $this->news_id = $v;
            $this->modifiedColumns[NewsTableMap::COL_NEWS_ID] = true;
        }

        return $this;
    } // setNewsId()

    /**
     * Set the value of [resource_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setResourceId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->resource_id !== $v) {
            $this->resource_id = $v;
            $this->modifiedColumns[NewsTableMap::COL_RESOURCE_ID] = true;
        }

        if ($this->aResourceRelatedByResourceId !== null && $this->aResourceRelatedByResourceId->getResourceId() !== $v) {
            $this->aResourceRelatedByResourceId = null;
        }

        return $this;
    } // setResourceId()

    /**
     * Set the value of [news_headline] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setNewsHeadline($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->news_headline !== $v) {
            $this->news_headline = $v;
            $this->modifiedColumns[NewsTableMap::COL_NEWS_HEADLINE] = true;
        }

        return $this;
    } // setNewsHeadline()

    /**
     * Set the value of [news_opening] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setNewsOpening($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->news_opening !== $v) {
            $this->news_opening = $v;
            $this->modifiedColumns[NewsTableMap::COL_NEWS_OPENING] = true;
        }

        return $this;
    } // setNewsOpening()

    /**
     * Set the value of [news_body] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setNewsBody($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->news_body !== $v) {
            $this->news_body = $v;
            $this->modifiedColumns[NewsTableMap::COL_NEWS_BODY] = true;
        }

        return $this;
    } // setNewsBody()

    /**
     * Set the value of [news_pic] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setNewsPic($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->news_pic !== $v) {
            $this->news_pic = $v;
            $this->modifiedColumns[NewsTableMap::COL_NEWS_PIC] = true;
        }

        if ($this->aFile !== null && $this->aFile->getFileId() !== $v) {
            $this->aFile = null;
        }

        return $this;
    } // setNewsPic()

    /**
     * Sets the value of [news_from] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setNewsFrom($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->news_from !== null || $dt !== null) {
            if ($this->news_from === null || $dt === null || $dt->format("Y-m-d") !== $this->news_from->format("Y-m-d")) {
                $this->news_from = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NewsTableMap::COL_NEWS_FROM] = true;
            }
        } // if either are not null

        return $this;
    } // setNewsFrom()

    /**
     * Sets the value of [news_to] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setNewsTo($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->news_to !== null || $dt !== null) {
            if ($this->news_to === null || $dt === null || $dt->format("Y-m-d") !== $this->news_to->format("Y-m-d")) {
                $this->news_to = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NewsTableMap::COL_NEWS_TO] = true;
            }
        } // if either are not null

        return $this;
    } // setNewsTo()

    /**
     * Set the value of [news_for] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setNewsFor($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->news_for !== $v) {
            $this->news_for = $v;
            $this->modifiedColumns[NewsTableMap::COL_NEWS_FOR] = true;
        }

        if ($this->aResourceRelatedByNewsFor !== null && $this->aResourceRelatedByNewsFor->getResourceId() !== $v) {
            $this->aResourceRelatedByNewsFor = null;
        }

        return $this;
    } // setNewsFor()

    /**
     * Set the value of [news_weight] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setNewsWeight($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->news_weight !== $v) {
            $this->news_weight = $v;
            $this->modifiedColumns[NewsTableMap::COL_NEWS_WEIGHT] = true;
        }

        return $this;
    } // setNewsWeight()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NewsTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\News The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NewsTableMap::COL_UPDATED_AT] = true;
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
            if ($this->news_weight !== 5) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : NewsTableMap::translateFieldName('NewsId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->news_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : NewsTableMap::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resource_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : NewsTableMap::translateFieldName('NewsHeadline', TableMap::TYPE_PHPNAME, $indexType)];
            $this->news_headline = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : NewsTableMap::translateFieldName('NewsOpening', TableMap::TYPE_PHPNAME, $indexType)];
            $this->news_opening = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : NewsTableMap::translateFieldName('NewsBody', TableMap::TYPE_PHPNAME, $indexType)];
            $this->news_body = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : NewsTableMap::translateFieldName('NewsPic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->news_pic = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : NewsTableMap::translateFieldName('NewsFrom', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->news_from = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : NewsTableMap::translateFieldName('NewsTo', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->news_to = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : NewsTableMap::translateFieldName('NewsFor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->news_for = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : NewsTableMap::translateFieldName('NewsWeight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->news_weight = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : NewsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : NewsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = NewsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\News'), 0, $e);
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
        if ($this->aResourceRelatedByResourceId !== null && $this->resource_id !== $this->aResourceRelatedByResourceId->getResourceId()) {
            $this->aResourceRelatedByResourceId = null;
        }
        if ($this->aFile !== null && $this->news_pic !== $this->aFile->getFileId()) {
            $this->aFile = null;
        }
        if ($this->aResourceRelatedByNewsFor !== null && $this->news_for !== $this->aResourceRelatedByNewsFor->getResourceId()) {
            $this->aResourceRelatedByNewsFor = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(NewsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildNewsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aResourceRelatedByResourceId = null;
            $this->aFile = null;
            $this->aResourceRelatedByNewsFor = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see News::setDeleted()
     * @see News::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(NewsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildNewsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(NewsTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(NewsTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(NewsTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(NewsTableMap::COL_UPDATED_AT)) {
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
                NewsTableMap::addInstanceToPool($this);
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

            if ($this->aResourceRelatedByResourceId !== null) {
                if ($this->aResourceRelatedByResourceId->isModified() || $this->aResourceRelatedByResourceId->isNew()) {
                    $affectedRows += $this->aResourceRelatedByResourceId->save($con);
                }
                $this->setResourceRelatedByResourceId($this->aResourceRelatedByResourceId);
            }

            if ($this->aFile !== null) {
                if ($this->aFile->isModified() || $this->aFile->isNew()) {
                    $affectedRows += $this->aFile->save($con);
                }
                $this->setFile($this->aFile);
            }

            if ($this->aResourceRelatedByNewsFor !== null) {
                if ($this->aResourceRelatedByNewsFor->isModified() || $this->aResourceRelatedByNewsFor->isNew()) {
                    $affectedRows += $this->aResourceRelatedByNewsFor->save($con);
                }
                $this->setResourceRelatedByNewsFor($this->aResourceRelatedByNewsFor);
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

        $this->modifiedColumns[NewsTableMap::COL_NEWS_ID] = true;
        if (null !== $this->news_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NewsTableMap::COL_NEWS_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'news_id';
        }
        if ($this->isColumnModified(NewsTableMap::COL_RESOURCE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'resource_id';
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_HEADLINE)) {
            $modifiedColumns[':p' . $index++]  = 'news_headline';
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_OPENING)) {
            $modifiedColumns[':p' . $index++]  = 'news_opening';
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_BODY)) {
            $modifiedColumns[':p' . $index++]  = 'news_body';
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_PIC)) {
            $modifiedColumns[':p' . $index++]  = 'news_pic';
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'news_from';
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_TO)) {
            $modifiedColumns[':p' . $index++]  = 'news_to';
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_FOR)) {
            $modifiedColumns[':p' . $index++]  = 'news_for';
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_WEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'news_weight';
        }
        if ($this->isColumnModified(NewsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(NewsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO news (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'news_id':
                        $stmt->bindValue($identifier, $this->news_id, PDO::PARAM_INT);
                        break;
                    case 'resource_id':
                        $stmt->bindValue($identifier, $this->resource_id, PDO::PARAM_INT);
                        break;
                    case 'news_headline':
                        $stmt->bindValue($identifier, $this->news_headline, PDO::PARAM_STR);
                        break;
                    case 'news_opening':
                        $stmt->bindValue($identifier, $this->news_opening, PDO::PARAM_STR);
                        break;
                    case 'news_body':
                        $stmt->bindValue($identifier, $this->news_body, PDO::PARAM_STR);
                        break;
                    case 'news_pic':
                        $stmt->bindValue($identifier, $this->news_pic, PDO::PARAM_INT);
                        break;
                    case 'news_from':
                        $stmt->bindValue($identifier, $this->news_from ? $this->news_from->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'news_to':
                        $stmt->bindValue($identifier, $this->news_to ? $this->news_to->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'news_for':
                        $stmt->bindValue($identifier, $this->news_for, PDO::PARAM_INT);
                        break;
                    case 'news_weight':
                        $stmt->bindValue($identifier, $this->news_weight, PDO::PARAM_INT);
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
        $this->setNewsId($pk);

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
        $pos = NewsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getNewsId();
                break;
            case 1:
                return $this->getResourceId();
                break;
            case 2:
                return $this->getNewsHeadline();
                break;
            case 3:
                return $this->getNewsOpening();
                break;
            case 4:
                return $this->getNewsBody();
                break;
            case 5:
                return $this->getNewsPic();
                break;
            case 6:
                return $this->getNewsFrom();
                break;
            case 7:
                return $this->getNewsTo();
                break;
            case 8:
                return $this->getNewsFor();
                break;
            case 9:
                return $this->getNewsWeight();
                break;
            case 10:
                return $this->getCreatedAt();
                break;
            case 11:
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

        if (isset($alreadyDumpedObjects['News'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['News'][$this->hashCode()] = true;
        $keys = NewsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getNewsId(),
            $keys[1] => $this->getResourceId(),
            $keys[2] => $this->getNewsHeadline(),
            $keys[3] => $this->getNewsOpening(),
            $keys[4] => $this->getNewsBody(),
            $keys[5] => $this->getNewsPic(),
            $keys[6] => $this->getNewsFrom(),
            $keys[7] => $this->getNewsTo(),
            $keys[8] => $this->getNewsFor(),
            $keys[9] => $this->getNewsWeight(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
        );
        if ($result[$keys[6]] instanceof \DateTime) {
            $result[$keys[6]] = $result[$keys[6]]->format('c');
        }

        if ($result[$keys[7]] instanceof \DateTime) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[10]] instanceof \DateTime) {
            $result[$keys[10]] = $result[$keys[10]]->format('c');
        }

        if ($result[$keys[11]] instanceof \DateTime) {
            $result[$keys[11]] = $result[$keys[11]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aResourceRelatedByResourceId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'resource';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'resource';
                        break;
                    default:
                        $key = 'Resource';
                }

                $result[$key] = $this->aResourceRelatedByResourceId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aFile) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'file';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'file';
                        break;
                    default:
                        $key = 'File';
                }

                $result[$key] = $this->aFile->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aResourceRelatedByNewsFor) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'resource';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'resource';
                        break;
                    default:
                        $key = 'Resource';
                }

                $result[$key] = $this->aResourceRelatedByNewsFor->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\App\Propel\News
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = NewsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\News
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setNewsId($value);
                break;
            case 1:
                $this->setResourceId($value);
                break;
            case 2:
                $this->setNewsHeadline($value);
                break;
            case 3:
                $this->setNewsOpening($value);
                break;
            case 4:
                $this->setNewsBody($value);
                break;
            case 5:
                $this->setNewsPic($value);
                break;
            case 6:
                $this->setNewsFrom($value);
                break;
            case 7:
                $this->setNewsTo($value);
                break;
            case 8:
                $this->setNewsFor($value);
                break;
            case 9:
                $this->setNewsWeight($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
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
        $keys = NewsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setNewsId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setResourceId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNewsHeadline($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setNewsOpening($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNewsBody($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNewsPic($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setNewsFrom($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setNewsTo($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setNewsFor($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setNewsWeight($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUpdatedAt($arr[$keys[11]]);
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
     * @return $this|\App\Propel\News The current object, for fluid interface
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
        $criteria = new Criteria(NewsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(NewsTableMap::COL_NEWS_ID)) {
            $criteria->add(NewsTableMap::COL_NEWS_ID, $this->news_id);
        }
        if ($this->isColumnModified(NewsTableMap::COL_RESOURCE_ID)) {
            $criteria->add(NewsTableMap::COL_RESOURCE_ID, $this->resource_id);
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_HEADLINE)) {
            $criteria->add(NewsTableMap::COL_NEWS_HEADLINE, $this->news_headline);
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_OPENING)) {
            $criteria->add(NewsTableMap::COL_NEWS_OPENING, $this->news_opening);
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_BODY)) {
            $criteria->add(NewsTableMap::COL_NEWS_BODY, $this->news_body);
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_PIC)) {
            $criteria->add(NewsTableMap::COL_NEWS_PIC, $this->news_pic);
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_FROM)) {
            $criteria->add(NewsTableMap::COL_NEWS_FROM, $this->news_from);
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_TO)) {
            $criteria->add(NewsTableMap::COL_NEWS_TO, $this->news_to);
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_FOR)) {
            $criteria->add(NewsTableMap::COL_NEWS_FOR, $this->news_for);
        }
        if ($this->isColumnModified(NewsTableMap::COL_NEWS_WEIGHT)) {
            $criteria->add(NewsTableMap::COL_NEWS_WEIGHT, $this->news_weight);
        }
        if ($this->isColumnModified(NewsTableMap::COL_CREATED_AT)) {
            $criteria->add(NewsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(NewsTableMap::COL_UPDATED_AT)) {
            $criteria->add(NewsTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildNewsQuery::create();
        $criteria->add(NewsTableMap::COL_NEWS_ID, $this->news_id);

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
        $validPk = null !== $this->getNewsId();

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
        return $this->getNewsId();
    }

    /**
     * Generic method to set the primary key (news_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setNewsId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getNewsId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\News (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setResourceId($this->getResourceId());
        $copyObj->setNewsHeadline($this->getNewsHeadline());
        $copyObj->setNewsOpening($this->getNewsOpening());
        $copyObj->setNewsBody($this->getNewsBody());
        $copyObj->setNewsPic($this->getNewsPic());
        $copyObj->setNewsFrom($this->getNewsFrom());
        $copyObj->setNewsTo($this->getNewsTo());
        $copyObj->setNewsFor($this->getNewsFor());
        $copyObj->setNewsWeight($this->getNewsWeight());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setNewsId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\News Clone of current object.
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
     * Declares an association between this object and a ChildResource object.
     *
     * @param  ChildResource $v
     * @return $this|\App\Propel\News The current object (for fluent API support)
     * @throws PropelException
     */
    public function setResourceRelatedByResourceId(ChildResource $v = null)
    {
        if ($v === null) {
            $this->setResourceId(NULL);
        } else {
            $this->setResourceId($v->getResourceId());
        }

        $this->aResourceRelatedByResourceId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildResource object, it will not be re-added.
        if ($v !== null) {
            $v->addNewsRelatedByResourceId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildResource object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildResource The associated ChildResource object.
     * @throws PropelException
     */
    public function getResourceRelatedByResourceId(ConnectionInterface $con = null)
    {
        if ($this->aResourceRelatedByResourceId === null && ($this->resource_id !== null)) {
            $this->aResourceRelatedByResourceId = ChildResourceQuery::create()->findPk($this->resource_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aResourceRelatedByResourceId->addNewsRelatedByResourceId($this);
             */
        }

        return $this->aResourceRelatedByResourceId;
    }

    /**
     * Declares an association between this object and a ChildFile object.
     *
     * @param  ChildFile $v
     * @return $this|\App\Propel\News The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFile(ChildFile $v = null)
    {
        if ($v === null) {
            $this->setNewsPic(NULL);
        } else {
            $this->setNewsPic($v->getFileId());
        }

        $this->aFile = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFile object, it will not be re-added.
        if ($v !== null) {
            $v->addNews($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFile object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildFile The associated ChildFile object.
     * @throws PropelException
     */
    public function getFile(ConnectionInterface $con = null)
    {
        if ($this->aFile === null && ($this->news_pic !== null)) {
            $this->aFile = ChildFileQuery::create()->findPk($this->news_pic, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFile->addNews($this);
             */
        }

        return $this->aFile;
    }

    /**
     * Declares an association between this object and a ChildResource object.
     *
     * @param  ChildResource $v
     * @return $this|\App\Propel\News The current object (for fluent API support)
     * @throws PropelException
     */
    public function setResourceRelatedByNewsFor(ChildResource $v = null)
    {
        if ($v === null) {
            $this->setNewsFor(NULL);
        } else {
            $this->setNewsFor($v->getResourceId());
        }

        $this->aResourceRelatedByNewsFor = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildResource object, it will not be re-added.
        if ($v !== null) {
            $v->addNewsRelatedByNewsFor($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildResource object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildResource The associated ChildResource object.
     * @throws PropelException
     */
    public function getResourceRelatedByNewsFor(ConnectionInterface $con = null)
    {
        if ($this->aResourceRelatedByNewsFor === null && ($this->news_for !== null)) {
            $this->aResourceRelatedByNewsFor = ChildResourceQuery::create()->findPk($this->news_for, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aResourceRelatedByNewsFor->addNewsRelatedByNewsFor($this);
             */
        }

        return $this->aResourceRelatedByNewsFor;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aResourceRelatedByResourceId) {
            $this->aResourceRelatedByResourceId->removeNewsRelatedByResourceId($this);
        }
        if (null !== $this->aFile) {
            $this->aFile->removeNews($this);
        }
        if (null !== $this->aResourceRelatedByNewsFor) {
            $this->aResourceRelatedByNewsFor->removeNewsRelatedByNewsFor($this);
        }
        $this->news_id = null;
        $this->resource_id = null;
        $this->news_headline = null;
        $this->news_opening = null;
        $this->news_body = null;
        $this->news_pic = null;
        $this->news_from = null;
        $this->news_to = null;
        $this->news_for = null;
        $this->news_weight = null;
        $this->created_at = null;
        $this->updated_at = null;
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

        $this->aResourceRelatedByResourceId = null;
        $this->aFile = null;
        $this->aResourceRelatedByNewsFor = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NewsTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildNews The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[NewsTableMap::COL_UPDATED_AT] = true;

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
