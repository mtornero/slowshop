<?php

namespace App\Propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Propel\Promotion as ChildPromotion;
use App\Propel\PromotionQuery as ChildPromotionQuery;
use App\Propel\PromotionType as ChildPromotionType;
use App\Propel\PromotionTypeQuery as ChildPromotionTypeQuery;
use App\Propel\Resource as ChildResource;
use App\Propel\ResourceQuery as ChildResourceQuery;
use App\Propel\Map\PromotionTableMap;
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
 * Base class that represents a row from the 'promotion' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class Promotion implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\PromotionTableMap';


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
     * The value for the promotion_id field.
     *
     * @var        int
     */
    protected $promotion_id;

    /**
     * The value for the resource_id field.
     *
     * @var        int
     */
    protected $resource_id;

    /**
     * The value for the promotion_type_id field.
     *
     * @var        int
     */
    protected $promotion_type_id;

    /**
     * The value for the promotion_value field.
     *
     * @var        string
     */
    protected $promotion_value;

    /**
     * The value for the promotion_gift field.
     *
     * @var        int
     */
    protected $promotion_gift;

    /**
     * The value for the promotion_description field.
     *
     * @var        string
     */
    protected $promotion_description;

    /**
     * The value for the promotion_starting_point field.
     *
     * @var        int
     */
    protected $promotion_starting_point;

    /**
     * The value for the promotion_starting_date field.
     *
     * @var        \DateTime
     */
    protected $promotion_starting_date;

    /**
     * The value for the promotion_ending_date field.
     *
     * @var        \DateTime
     */
    protected $promotion_ending_date;

    /**
     * The value for the promotion_is_active field.
     *
     * @var        boolean
     */
    protected $promotion_is_active;

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
    protected $aResource;

    /**
     * @var        ChildPromotionType
     */
    protected $aPromotionType;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of App\Propel\Base\Promotion object.
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
     * Compares this with another <code>Promotion</code> instance.  If
     * <code>obj</code> is an instance of <code>Promotion</code>, delegates to
     * <code>equals(Promotion)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Promotion The current object, for fluid interface
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
     * Get the [promotion_id] column value.
     *
     * @return int
     */
    public function getPromotionId()
    {
        return $this->promotion_id;
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
     * Get the [promotion_type_id] column value.
     *
     * @return int
     */
    public function getPromotionTypeId()
    {
        return $this->promotion_type_id;
    }

    /**
     * Get the [promotion_value] column value.
     *
     * @return string
     */
    public function getPromotionValue()
    {
        return $this->promotion_value;
    }

    /**
     * Get the [promotion_gift] column value.
     *
     * @return int
     */
    public function getPromotionGift()
    {
        return $this->promotion_gift;
    }

    /**
     * Get the [promotion_description] column value.
     *
     * @return string
     */
    public function getPromotionDescription()
    {
        return $this->promotion_description;
    }

    /**
     * Get the [promotion_starting_point] column value.
     *
     * @return int
     */
    public function getPromotionStartingPoint()
    {
        return $this->promotion_starting_point;
    }

    /**
     * Get the [optionally formatted] temporal [promotion_starting_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPromotionStartingDate($format = NULL)
    {
        if ($format === null) {
            return $this->promotion_starting_date;
        } else {
            return $this->promotion_starting_date instanceof \DateTime ? $this->promotion_starting_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [promotion_ending_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPromotionEndingDate($format = NULL)
    {
        if ($format === null) {
            return $this->promotion_ending_date;
        } else {
            return $this->promotion_ending_date instanceof \DateTime ? $this->promotion_ending_date->format($format) : null;
        }
    }

    /**
     * Get the [promotion_is_active] column value.
     *
     * @return boolean
     */
    public function getPromotionIsActive()
    {
        return $this->promotion_is_active;
    }

    /**
     * Get the [promotion_is_active] column value.
     *
     * @return boolean
     */
    public function isPromotionIsActive()
    {
        return $this->getPromotionIsActive();
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
     * Set the value of [promotion_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setPromotionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->promotion_id !== $v) {
            $this->promotion_id = $v;
            $this->modifiedColumns[PromotionTableMap::COL_PROMOTION_ID] = true;
        }

        return $this;
    } // setPromotionId()

    /**
     * Set the value of [resource_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setResourceId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->resource_id !== $v) {
            $this->resource_id = $v;
            $this->modifiedColumns[PromotionTableMap::COL_RESOURCE_ID] = true;
        }

        if ($this->aResource !== null && $this->aResource->getResourceId() !== $v) {
            $this->aResource = null;
        }

        return $this;
    } // setResourceId()

    /**
     * Set the value of [promotion_type_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setPromotionTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->promotion_type_id !== $v) {
            $this->promotion_type_id = $v;
            $this->modifiedColumns[PromotionTableMap::COL_PROMOTION_TYPE_ID] = true;
        }

        if ($this->aPromotionType !== null && $this->aPromotionType->getPromotionTypeId() !== $v) {
            $this->aPromotionType = null;
        }

        return $this;
    } // setPromotionTypeId()

    /**
     * Set the value of [promotion_value] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setPromotionValue($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->promotion_value !== $v) {
            $this->promotion_value = $v;
            $this->modifiedColumns[PromotionTableMap::COL_PROMOTION_VALUE] = true;
        }

        return $this;
    } // setPromotionValue()

    /**
     * Set the value of [promotion_gift] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setPromotionGift($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->promotion_gift !== $v) {
            $this->promotion_gift = $v;
            $this->modifiedColumns[PromotionTableMap::COL_PROMOTION_GIFT] = true;
        }

        return $this;
    } // setPromotionGift()

    /**
     * Set the value of [promotion_description] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setPromotionDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->promotion_description !== $v) {
            $this->promotion_description = $v;
            $this->modifiedColumns[PromotionTableMap::COL_PROMOTION_DESCRIPTION] = true;
        }

        return $this;
    } // setPromotionDescription()

    /**
     * Set the value of [promotion_starting_point] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setPromotionStartingPoint($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->promotion_starting_point !== $v) {
            $this->promotion_starting_point = $v;
            $this->modifiedColumns[PromotionTableMap::COL_PROMOTION_STARTING_POINT] = true;
        }

        return $this;
    } // setPromotionStartingPoint()

    /**
     * Sets the value of [promotion_starting_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setPromotionStartingDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->promotion_starting_date !== null || $dt !== null) {
            if ($this->promotion_starting_date === null || $dt === null || $dt->format("Y-m-d") !== $this->promotion_starting_date->format("Y-m-d")) {
                $this->promotion_starting_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PromotionTableMap::COL_PROMOTION_STARTING_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setPromotionStartingDate()

    /**
     * Sets the value of [promotion_ending_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setPromotionEndingDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->promotion_ending_date !== null || $dt !== null) {
            if ($this->promotion_ending_date === null || $dt === null || $dt->format("Y-m-d") !== $this->promotion_ending_date->format("Y-m-d")) {
                $this->promotion_ending_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PromotionTableMap::COL_PROMOTION_ENDING_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setPromotionEndingDate()

    /**
     * Sets the value of the [promotion_is_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setPromotionIsActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->promotion_is_active !== $v) {
            $this->promotion_is_active = $v;
            $this->modifiedColumns[PromotionTableMap::COL_PROMOTION_IS_ACTIVE] = true;
        }

        return $this;
    } // setPromotionIsActive()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PromotionTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PromotionTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PromotionTableMap::translateFieldName('PromotionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->promotion_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PromotionTableMap::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resource_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PromotionTableMap::translateFieldName('PromotionTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->promotion_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PromotionTableMap::translateFieldName('PromotionValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->promotion_value = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PromotionTableMap::translateFieldName('PromotionGift', TableMap::TYPE_PHPNAME, $indexType)];
            $this->promotion_gift = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PromotionTableMap::translateFieldName('PromotionDescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->promotion_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PromotionTableMap::translateFieldName('PromotionStartingPoint', TableMap::TYPE_PHPNAME, $indexType)];
            $this->promotion_starting_point = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PromotionTableMap::translateFieldName('PromotionStartingDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->promotion_starting_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PromotionTableMap::translateFieldName('PromotionEndingDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->promotion_ending_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PromotionTableMap::translateFieldName('PromotionIsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->promotion_is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PromotionTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PromotionTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = PromotionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\Promotion'), 0, $e);
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
        if ($this->aResource !== null && $this->resource_id !== $this->aResource->getResourceId()) {
            $this->aResource = null;
        }
        if ($this->aPromotionType !== null && $this->promotion_type_id !== $this->aPromotionType->getPromotionTypeId()) {
            $this->aPromotionType = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PromotionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPromotionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aResource = null;
            $this->aPromotionType = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Promotion::setDeleted()
     * @see Promotion::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PromotionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPromotionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PromotionTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(PromotionTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(PromotionTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PromotionTableMap::COL_UPDATED_AT)) {
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
                PromotionTableMap::addInstanceToPool($this);
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

            if ($this->aResource !== null) {
                if ($this->aResource->isModified() || $this->aResource->isNew()) {
                    $affectedRows += $this->aResource->save($con);
                }
                $this->setResource($this->aResource);
            }

            if ($this->aPromotionType !== null) {
                if ($this->aPromotionType->isModified() || $this->aPromotionType->isNew()) {
                    $affectedRows += $this->aPromotionType->save($con);
                }
                $this->setPromotionType($this->aPromotionType);
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

        $this->modifiedColumns[PromotionTableMap::COL_PROMOTION_ID] = true;
        if (null !== $this->promotion_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PromotionTableMap::COL_PROMOTION_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'promotion_id';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_RESOURCE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'resource_id';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'promotion_type_id';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'promotion_value';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_GIFT)) {
            $modifiedColumns[':p' . $index++]  = 'promotion_gift';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'promotion_description';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_STARTING_POINT)) {
            $modifiedColumns[':p' . $index++]  = 'promotion_starting_point';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_STARTING_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'promotion_starting_date';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_ENDING_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'promotion_ending_date';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'promotion_is_active';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(PromotionTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO promotion (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'promotion_id':
                        $stmt->bindValue($identifier, $this->promotion_id, PDO::PARAM_INT);
                        break;
                    case 'resource_id':
                        $stmt->bindValue($identifier, $this->resource_id, PDO::PARAM_INT);
                        break;
                    case 'promotion_type_id':
                        $stmt->bindValue($identifier, $this->promotion_type_id, PDO::PARAM_INT);
                        break;
                    case 'promotion_value':
                        $stmt->bindValue($identifier, $this->promotion_value, PDO::PARAM_STR);
                        break;
                    case 'promotion_gift':
                        $stmt->bindValue($identifier, $this->promotion_gift, PDO::PARAM_INT);
                        break;
                    case 'promotion_description':
                        $stmt->bindValue($identifier, $this->promotion_description, PDO::PARAM_STR);
                        break;
                    case 'promotion_starting_point':
                        $stmt->bindValue($identifier, $this->promotion_starting_point, PDO::PARAM_INT);
                        break;
                    case 'promotion_starting_date':
                        $stmt->bindValue($identifier, $this->promotion_starting_date ? $this->promotion_starting_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'promotion_ending_date':
                        $stmt->bindValue($identifier, $this->promotion_ending_date ? $this->promotion_ending_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'promotion_is_active':
                        $stmt->bindValue($identifier, (int) $this->promotion_is_active, PDO::PARAM_INT);
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
        $this->setPromotionId($pk);

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
        $pos = PromotionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPromotionId();
                break;
            case 1:
                return $this->getResourceId();
                break;
            case 2:
                return $this->getPromotionTypeId();
                break;
            case 3:
                return $this->getPromotionValue();
                break;
            case 4:
                return $this->getPromotionGift();
                break;
            case 5:
                return $this->getPromotionDescription();
                break;
            case 6:
                return $this->getPromotionStartingPoint();
                break;
            case 7:
                return $this->getPromotionStartingDate();
                break;
            case 8:
                return $this->getPromotionEndingDate();
                break;
            case 9:
                return $this->getPromotionIsActive();
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

        if (isset($alreadyDumpedObjects['Promotion'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Promotion'][$this->hashCode()] = true;
        $keys = PromotionTableMap::getFieldNames($keyType);
        $keys_resource = \App\Propel\Map\ResourceTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPromotionId(),
            $keys[1] => $this->getResourceId(),
            $keys[2] => $this->getPromotionTypeId(),
            $keys[3] => $this->getPromotionValue(),
            $keys[4] => $this->getPromotionGift(),
            $keys[5] => $this->getPromotionDescription(),
            $keys[6] => $this->getPromotionStartingPoint(),
            $keys[7] => $this->getPromotionStartingDate(),
            $keys[8] => $this->getPromotionEndingDate(),
            $keys[9] => $this->getPromotionIsActive(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
            $keys_resource[1] => $this->getResourceType(),
            $keys_resource[2] => $this->getSocialViews(),
            $keys_resource[3] => $this->getSocialLikes(),
            $keys_resource[4] => $this->getSocialDislikes(),
            $keys_resource[5] => $this->getSocialComments(),
            $keys_resource[6] => $this->getSocialFavourites(),
            $keys_resource[7] => $this->getSocialRecommendations(),

        );
        if ($result[$keys[7]] instanceof \DateTime) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTime) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
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
            if (null !== $this->aResource) {

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

                $result[$key] = $this->aResource->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPromotionType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'promotionType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'promotion_type';
                        break;
                    default:
                        $key = 'PromotionType';
                }

                $result[$key] = $this->aPromotionType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\App\Propel\Promotion
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PromotionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\Promotion
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPromotionId($value);
                break;
            case 1:
                $this->setResourceId($value);
                break;
            case 2:
                $this->setPromotionTypeId($value);
                break;
            case 3:
                $this->setPromotionValue($value);
                break;
            case 4:
                $this->setPromotionGift($value);
                break;
            case 5:
                $this->setPromotionDescription($value);
                break;
            case 6:
                $this->setPromotionStartingPoint($value);
                break;
            case 7:
                $this->setPromotionStartingDate($value);
                break;
            case 8:
                $this->setPromotionEndingDate($value);
                break;
            case 9:
                $this->setPromotionIsActive($value);
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
        $keys = PromotionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPromotionId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setResourceId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPromotionTypeId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPromotionValue($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPromotionGift($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPromotionDescription($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPromotionStartingPoint($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPromotionStartingDate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPromotionEndingDate($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPromotionIsActive($arr[$keys[9]]);
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
     * @return $this|\App\Propel\Promotion The current object, for fluid interface
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
        $criteria = new Criteria(PromotionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_ID)) {
            $criteria->add(PromotionTableMap::COL_PROMOTION_ID, $this->promotion_id);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_RESOURCE_ID)) {
            $criteria->add(PromotionTableMap::COL_RESOURCE_ID, $this->resource_id);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_TYPE_ID)) {
            $criteria->add(PromotionTableMap::COL_PROMOTION_TYPE_ID, $this->promotion_type_id);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_VALUE)) {
            $criteria->add(PromotionTableMap::COL_PROMOTION_VALUE, $this->promotion_value);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_GIFT)) {
            $criteria->add(PromotionTableMap::COL_PROMOTION_GIFT, $this->promotion_gift);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_DESCRIPTION)) {
            $criteria->add(PromotionTableMap::COL_PROMOTION_DESCRIPTION, $this->promotion_description);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_STARTING_POINT)) {
            $criteria->add(PromotionTableMap::COL_PROMOTION_STARTING_POINT, $this->promotion_starting_point);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_STARTING_DATE)) {
            $criteria->add(PromotionTableMap::COL_PROMOTION_STARTING_DATE, $this->promotion_starting_date);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_ENDING_DATE)) {
            $criteria->add(PromotionTableMap::COL_PROMOTION_ENDING_DATE, $this->promotion_ending_date);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_PROMOTION_IS_ACTIVE)) {
            $criteria->add(PromotionTableMap::COL_PROMOTION_IS_ACTIVE, $this->promotion_is_active);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_CREATED_AT)) {
            $criteria->add(PromotionTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(PromotionTableMap::COL_UPDATED_AT)) {
            $criteria->add(PromotionTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildPromotionQuery::create();
        $criteria->add(PromotionTableMap::COL_PROMOTION_ID, $this->promotion_id);

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
        $validPk = null !== $this->getPromotionId();

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
        return $this->getPromotionId();
    }

    /**
     * Generic method to set the primary key (promotion_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPromotionId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getPromotionId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\Promotion (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setResourceId($this->getResourceId());
        $copyObj->setPromotionTypeId($this->getPromotionTypeId());
        $copyObj->setPromotionValue($this->getPromotionValue());
        $copyObj->setPromotionGift($this->getPromotionGift());
        $copyObj->setPromotionDescription($this->getPromotionDescription());
        $copyObj->setPromotionStartingPoint($this->getPromotionStartingPoint());
        $copyObj->setPromotionStartingDate($this->getPromotionStartingDate());
        $copyObj->setPromotionEndingDate($this->getPromotionEndingDate());
        $copyObj->setPromotionIsActive($this->getPromotionIsActive());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPromotionId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\Promotion Clone of current object.
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
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     * @throws PropelException
     */
    public function setResource(ChildResource $v = null)
    {
        if ($v === null) {
            $this->setResourceId(NULL);
        } else {
            $this->setResourceId($v->getResourceId());
        }

        $this->aResource = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildResource object, it will not be re-added.
        if ($v !== null) {
            $v->addPromotion($this);
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
    public function getResource(ConnectionInterface $con = null)
    {
        if ($this->aResource === null && ($this->resource_id !== null)) {
            $this->aResource = ChildResourceQuery::create()->findPk($this->resource_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aResource->addPromotions($this);
             */
        }

        return $this->aResource;
    }

    /**
     * Declares an association between this object and a ChildPromotionType object.
     *
     * @param  ChildPromotionType $v
     * @return $this|\App\Propel\Promotion The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPromotionType(ChildPromotionType $v = null)
    {
        if ($v === null) {
            $this->setPromotionTypeId(NULL);
        } else {
            $this->setPromotionTypeId($v->getPromotionTypeId());
        }

        $this->aPromotionType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPromotionType object, it will not be re-added.
        if ($v !== null) {
            $v->addPromotion($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPromotionType object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPromotionType The associated ChildPromotionType object.
     * @throws PropelException
     */
    public function getPromotionType(ConnectionInterface $con = null)
    {
        if ($this->aPromotionType === null && ($this->promotion_type_id !== null)) {
            $this->aPromotionType = ChildPromotionTypeQuery::create()->findPk($this->promotion_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPromotionType->addPromotions($this);
             */
        }

        return $this->aPromotionType;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aResource) {
            $this->aResource->removePromotion($this);
        }
        if (null !== $this->aPromotionType) {
            $this->aPromotionType->removePromotion($this);
        }
        $this->promotion_id = null;
        $this->resource_id = null;
        $this->promotion_type_id = null;
        $this->promotion_value = null;
        $this->promotion_gift = null;
        $this->promotion_description = null;
        $this->promotion_starting_point = null;
        $this->promotion_starting_date = null;
        $this->promotion_ending_date = null;
        $this->promotion_is_active = null;
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
        } // if ($deep)

        $this->aResource = null;
        $this->aPromotionType = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PromotionTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildPromotion The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[PromotionTableMap::COL_UPDATED_AT] = true;

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
     * Catches calls to undefined methods.
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

    // delegate behavior

    if (is_callable(array('\App\Propel\Resource', $name))) {
        $delegate = $this->getResource();
        if (!$delegate) {
            $delegate = new ChildResource();
            $this->setResource($delegate);
        }

        return call_user_func_array(array($delegate, $name), $params);
    }
        return $this->__parentCall($name, $params);
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
    public function __parentCall($name, $params)
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
