<?php

namespace App\Propel\Base;

use \DateTime;
use \Exception;
use \PDO;
use App\Propel\File as ChildFile;
use App\Propel\FileQuery as ChildFileQuery;
use App\Propel\Order as ChildOrder;
use App\Propel\OrderQuery as ChildOrderQuery;
use App\Propel\Resource as ChildResource;
use App\Propel\ResourceQuery as ChildResourceQuery;
use App\Propel\Role as ChildRole;
use App\Propel\RoleQuery as ChildRoleQuery;
use App\Propel\User as ChildUser;
use App\Propel\UserPeriodicPlan as ChildUserPeriodicPlan;
use App\Propel\UserPeriodicPlanQuery as ChildUserPeriodicPlanQuery;
use App\Propel\UserQuery as ChildUserQuery;
use App\Propel\Map\OrderTableMap;
use App\Propel\Map\UserPeriodicPlanTableMap;
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
 * Base class that represents a row from the 'user' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class User implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\UserTableMap';


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
     * The value for the user_id field.
     *
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the resource_id field.
     *
     * @var        int
     */
    protected $resource_id;

    /**
     * The value for the use_name field.
     *
     * @var        string
     */
    protected $use_name;

    /**
     * The value for the user_surname field.
     *
     * @var        string
     */
    protected $user_surname;

    /**
     * The value for the user_login field.
     *
     * @var        string
     */
    protected $user_login;

    /**
     * The value for the user_pass field.
     *
     * @var        string
     */
    protected $user_pass;

    /**
     * The value for the user_pass_is_temp field.
     *
     * @var        string
     */
    protected $user_pass_is_temp;

    /**
     * The value for the user_email field.
     *
     * @var        string
     */
    protected $user_email;

    /**
     * The value for the user_phone field.
     *
     * @var        string
     */
    protected $user_phone;

    /**
     * The value for the user_address field.
     *
     * @var        string
     */
    protected $user_address;

    /**
     * The value for the role_id field.
     *
     * @var        int
     */
    protected $role_id;

    /**
     * The value for the user_is_active field.
     *
     * @var        boolean
     */
    protected $user_is_active;

    /**
     * The value for the user_pic field.
     *
     * @var        int
     */
    protected $user_pic;

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
     * @var        ChildFile
     */
    protected $aFile;

    /**
     * @var        ChildRole
     */
    protected $aRole;

    /**
     * @var        ChildResource
     */
    protected $aResource;

    /**
     * @var        ObjectCollection|ChildOrder[] Collection to store aggregation of ChildOrder objects.
     */
    protected $collOrders;
    protected $collOrdersPartial;

    /**
     * @var        ObjectCollection|ChildUserPeriodicPlan[] Collection to store aggregation of ChildUserPeriodicPlan objects.
     */
    protected $collUserPeriodicPlans;
    protected $collUserPeriodicPlansPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrder[]
     */
    protected $ordersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserPeriodicPlan[]
     */
    protected $userPeriodicPlansScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Propel\Base\User object.
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
     * Compares this with another <code>User</code> instance.  If
     * <code>obj</code> is an instance of <code>User</code>, delegates to
     * <code>equals(User)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|User The current object, for fluid interface
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
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
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
     * Get the [use_name] column value.
     *
     * @return string
     */
    public function getUseName()
    {
        return $this->use_name;
    }

    /**
     * Get the [user_surname] column value.
     *
     * @return string
     */
    public function getUserSurname()
    {
        return $this->user_surname;
    }

    /**
     * Get the [user_login] column value.
     *
     * @return string
     */
    public function getUserLogin()
    {
        return $this->user_login;
    }

    /**
     * Get the [user_pass] column value.
     *
     * @return string
     */
    public function getUserPass()
    {
        return $this->user_pass;
    }

    /**
     * Get the [user_pass_is_temp] column value.
     *
     * @return string
     */
    public function getUserPassIsTemp()
    {
        return $this->user_pass_is_temp;
    }

    /**
     * Get the [user_email] column value.
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * Get the [user_phone] column value.
     *
     * @return string
     */
    public function getUserPhone()
    {
        return $this->user_phone;
    }

    /**
     * Get the [user_address] column value.
     *
     * @return string
     */
    public function getUserAddress()
    {
        return $this->user_address;
    }

    /**
     * Get the [role_id] column value.
     *
     * @return int
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Get the [user_is_active] column value.
     *
     * @return boolean
     */
    public function getUserIsActive()
    {
        return $this->user_is_active;
    }

    /**
     * Get the [user_is_active] column value.
     *
     * @return boolean
     */
    public function isUserIsActive()
    {
        return $this->getUserIsActive();
    }

    /**
     * Get the [user_pic] column value.
     *
     * @return int
     */
    public function getUserPic()
    {
        return $this->user_pic;
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
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_ID] = true;
        }

        return $this;
    } // setUserId()

    /**
     * Set the value of [resource_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setResourceId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->resource_id !== $v) {
            $this->resource_id = $v;
            $this->modifiedColumns[UserTableMap::COL_RESOURCE_ID] = true;
        }

        if ($this->aResource !== null && $this->aResource->getResourceId() !== $v) {
            $this->aResource = null;
        }

        return $this;
    } // setResourceId()

    /**
     * Set the value of [use_name] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUseName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->use_name !== $v) {
            $this->use_name = $v;
            $this->modifiedColumns[UserTableMap::COL_USE_NAME] = true;
        }

        return $this;
    } // setUseName()

    /**
     * Set the value of [user_surname] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUserSurname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_surname !== $v) {
            $this->user_surname = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_SURNAME] = true;
        }

        return $this;
    } // setUserSurname()

    /**
     * Set the value of [user_login] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUserLogin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_login !== $v) {
            $this->user_login = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_LOGIN] = true;
        }

        return $this;
    } // setUserLogin()

    /**
     * Set the value of [user_pass] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUserPass($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_pass !== $v) {
            $this->user_pass = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_PASS] = true;
        }

        return $this;
    } // setUserPass()

    /**
     * Set the value of [user_pass_is_temp] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUserPassIsTemp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_pass_is_temp !== $v) {
            $this->user_pass_is_temp = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_PASS_IS_TEMP] = true;
        }

        return $this;
    } // setUserPassIsTemp()

    /**
     * Set the value of [user_email] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUserEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_email !== $v) {
            $this->user_email = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_EMAIL] = true;
        }

        return $this;
    } // setUserEmail()

    /**
     * Set the value of [user_phone] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUserPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_phone !== $v) {
            $this->user_phone = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_PHONE] = true;
        }

        return $this;
    } // setUserPhone()

    /**
     * Set the value of [user_address] column.
     *
     * @param string $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUserAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_address !== $v) {
            $this->user_address = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_ADDRESS] = true;
        }

        return $this;
    } // setUserAddress()

    /**
     * Set the value of [role_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setRoleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->role_id !== $v) {
            $this->role_id = $v;
            $this->modifiedColumns[UserTableMap::COL_ROLE_ID] = true;
        }

        if ($this->aRole !== null && $this->aRole->getRoleId() !== $v) {
            $this->aRole = null;
        }

        return $this;
    } // setRoleId()

    /**
     * Sets the value of the [user_is_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUserIsActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->user_is_active !== $v) {
            $this->user_is_active = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_IS_ACTIVE] = true;
        }

        return $this;
    } // setUserIsActive()

    /**
     * Set the value of [user_pic] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUserPic($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_pic !== $v) {
            $this->user_pic = $v;
            $this->modifiedColumns[UserTableMap::COL_USER_PIC] = true;
        }

        if ($this->aFile !== null && $this->aFile->getFileId() !== $v) {
            $this->aFile = null;
        }

        return $this;
    } // setUserPic()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserTableMap::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resource_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserTableMap::translateFieldName('UseName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->use_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserTableMap::translateFieldName('UserSurname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_surname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserTableMap::translateFieldName('UserLogin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_login = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserTableMap::translateFieldName('UserPass', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_pass = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserTableMap::translateFieldName('UserPassIsTemp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_pass_is_temp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UserTableMap::translateFieldName('UserEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UserTableMap::translateFieldName('UserPhone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UserTableMap::translateFieldName('UserAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UserTableMap::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->role_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UserTableMap::translateFieldName('UserIsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_is_active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UserTableMap::translateFieldName('UserPic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_pic = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UserTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UserTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = UserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\User'), 0, $e);
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
        if ($this->aRole !== null && $this->role_id !== $this->aRole->getRoleId()) {
            $this->aRole = null;
        }
        if ($this->aFile !== null && $this->user_pic !== $this->aFile->getFileId()) {
            $this->aFile = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFile = null;
            $this->aRole = null;
            $this->aResource = null;
            $this->collOrders = null;

            $this->collUserPeriodicPlans = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see User::setDeleted()
     * @see User::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(UserTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
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
                UserTableMap::addInstanceToPool($this);
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

            if ($this->aFile !== null) {
                if ($this->aFile->isModified() || $this->aFile->isNew()) {
                    $affectedRows += $this->aFile->save($con);
                }
                $this->setFile($this->aFile);
            }

            if ($this->aRole !== null) {
                if ($this->aRole->isModified() || $this->aRole->isNew()) {
                    $affectedRows += $this->aRole->save($con);
                }
                $this->setRole($this->aRole);
            }

            if ($this->aResource !== null) {
                if ($this->aResource->isModified() || $this->aResource->isNew()) {
                    $affectedRows += $this->aResource->save($con);
                }
                $this->setResource($this->aResource);
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

            if ($this->ordersScheduledForDeletion !== null) {
                if (!$this->ordersScheduledForDeletion->isEmpty()) {
                    \App\Propel\OrderQuery::create()
                        ->filterByPrimaryKeys($this->ordersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ordersScheduledForDeletion = null;
                }
            }

            if ($this->collOrders !== null) {
                foreach ($this->collOrders as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userPeriodicPlansScheduledForDeletion !== null) {
                if (!$this->userPeriodicPlansScheduledForDeletion->isEmpty()) {
                    \App\Propel\UserPeriodicPlanQuery::create()
                        ->filterByPrimaryKeys($this->userPeriodicPlansScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userPeriodicPlansScheduledForDeletion = null;
                }
            }

            if ($this->collUserPeriodicPlans !== null) {
                foreach ($this->collUserPeriodicPlans as $referrerFK) {
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

        $this->modifiedColumns[UserTableMap::COL_USER_ID] = true;
        if (null !== $this->user_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserTableMap::COL_USER_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'user_id';
        }
        if ($this->isColumnModified(UserTableMap::COL_RESOURCE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'resource_id';
        }
        if ($this->isColumnModified(UserTableMap::COL_USE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'use_name';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_SURNAME)) {
            $modifiedColumns[':p' . $index++]  = 'user_surname';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = 'user_login';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_PASS)) {
            $modifiedColumns[':p' . $index++]  = 'user_pass';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_PASS_IS_TEMP)) {
            $modifiedColumns[':p' . $index++]  = 'user_pass_is_temp';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'user_email';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'user_phone';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'user_address';
        }
        if ($this->isColumnModified(UserTableMap::COL_ROLE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'role_id';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'user_is_active';
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_PIC)) {
            $modifiedColumns[':p' . $index++]  = 'user_pic';
        }
        if ($this->isColumnModified(UserTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO user (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'user_id':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case 'resource_id':
                        $stmt->bindValue($identifier, $this->resource_id, PDO::PARAM_INT);
                        break;
                    case 'use_name':
                        $stmt->bindValue($identifier, $this->use_name, PDO::PARAM_STR);
                        break;
                    case 'user_surname':
                        $stmt->bindValue($identifier, $this->user_surname, PDO::PARAM_STR);
                        break;
                    case 'user_login':
                        $stmt->bindValue($identifier, $this->user_login, PDO::PARAM_STR);
                        break;
                    case 'user_pass':
                        $stmt->bindValue($identifier, $this->user_pass, PDO::PARAM_STR);
                        break;
                    case 'user_pass_is_temp':
                        $stmt->bindValue($identifier, $this->user_pass_is_temp, PDO::PARAM_STR);
                        break;
                    case 'user_email':
                        $stmt->bindValue($identifier, $this->user_email, PDO::PARAM_STR);
                        break;
                    case 'user_phone':
                        $stmt->bindValue($identifier, $this->user_phone, PDO::PARAM_STR);
                        break;
                    case 'user_address':
                        $stmt->bindValue($identifier, $this->user_address, PDO::PARAM_STR);
                        break;
                    case 'role_id':
                        $stmt->bindValue($identifier, $this->role_id, PDO::PARAM_INT);
                        break;
                    case 'user_is_active':
                        $stmt->bindValue($identifier, (int) $this->user_is_active, PDO::PARAM_INT);
                        break;
                    case 'user_pic':
                        $stmt->bindValue($identifier, $this->user_pic, PDO::PARAM_INT);
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
        $this->setUserId($pk);

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
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUserId();
                break;
            case 1:
                return $this->getResourceId();
                break;
            case 2:
                return $this->getUseName();
                break;
            case 3:
                return $this->getUserSurname();
                break;
            case 4:
                return $this->getUserLogin();
                break;
            case 5:
                return $this->getUserPass();
                break;
            case 6:
                return $this->getUserPassIsTemp();
                break;
            case 7:
                return $this->getUserEmail();
                break;
            case 8:
                return $this->getUserPhone();
                break;
            case 9:
                return $this->getUserAddress();
                break;
            case 10:
                return $this->getRoleId();
                break;
            case 11:
                return $this->getUserIsActive();
                break;
            case 12:
                return $this->getUserPic();
                break;
            case 13:
                return $this->getCreatedAt();
                break;
            case 14:
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

        if (isset($alreadyDumpedObjects['User'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->hashCode()] = true;
        $keys = UserTableMap::getFieldNames($keyType);
        $keys_resource = \App\Propel\Map\ResourceTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getUserId(),
            $keys[1] => $this->getResourceId(),
            $keys[2] => $this->getUseName(),
            $keys[3] => $this->getUserSurname(),
            $keys[4] => $this->getUserLogin(),
            $keys[5] => $this->getUserPass(),
            $keys[6] => $this->getUserPassIsTemp(),
            $keys[7] => $this->getUserEmail(),
            $keys[8] => $this->getUserPhone(),
            $keys[9] => $this->getUserAddress(),
            $keys[10] => $this->getRoleId(),
            $keys[11] => $this->getUserIsActive(),
            $keys[12] => $this->getUserPic(),
            $keys[13] => $this->getCreatedAt(),
            $keys[14] => $this->getUpdatedAt(),
            $keys_resource[1] => $this->getResourceTypeId(),

        );
        if ($result[$keys[13]] instanceof \DateTime) {
            $result[$keys[13]] = $result[$keys[13]]->format('c');
        }

        if ($result[$keys[14]] instanceof \DateTime) {
            $result[$keys[14]] = $result[$keys[14]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->aRole) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'role';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'role';
                        break;
                    default:
                        $key = 'Role';
                }

                $result[$key] = $this->aRole->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
            if (null !== $this->collOrders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orders';
                        break;
                    default:
                        $key = 'Orders';
                }

                $result[$key] = $this->collOrders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserPeriodicPlans) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userPeriodicPlans';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_periodic_plans';
                        break;
                    default:
                        $key = 'UserPeriodicPlans';
                }

                $result[$key] = $this->collUserPeriodicPlans->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Propel\User
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\User
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setUserId($value);
                break;
            case 1:
                $this->setResourceId($value);
                break;
            case 2:
                $this->setUseName($value);
                break;
            case 3:
                $this->setUserSurname($value);
                break;
            case 4:
                $this->setUserLogin($value);
                break;
            case 5:
                $this->setUserPass($value);
                break;
            case 6:
                $this->setUserPassIsTemp($value);
                break;
            case 7:
                $this->setUserEmail($value);
                break;
            case 8:
                $this->setUserPhone($value);
                break;
            case 9:
                $this->setUserAddress($value);
                break;
            case 10:
                $this->setRoleId($value);
                break;
            case 11:
                $this->setUserIsActive($value);
                break;
            case 12:
                $this->setUserPic($value);
                break;
            case 13:
                $this->setCreatedAt($value);
                break;
            case 14:
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
        $keys = UserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setUserId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setResourceId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUseName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUserSurname($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUserLogin($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setUserPass($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUserPassIsTemp($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUserEmail($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUserPhone($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUserAddress($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRoleId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUserIsActive($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setUserPic($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCreatedAt($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setUpdatedAt($arr[$keys[14]]);
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
     * @return $this|\App\Propel\User The current object, for fluid interface
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
        $criteria = new Criteria(UserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserTableMap::COL_USER_ID)) {
            $criteria->add(UserTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(UserTableMap::COL_RESOURCE_ID)) {
            $criteria->add(UserTableMap::COL_RESOURCE_ID, $this->resource_id);
        }
        if ($this->isColumnModified(UserTableMap::COL_USE_NAME)) {
            $criteria->add(UserTableMap::COL_USE_NAME, $this->use_name);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_SURNAME)) {
            $criteria->add(UserTableMap::COL_USER_SURNAME, $this->user_surname);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_LOGIN)) {
            $criteria->add(UserTableMap::COL_USER_LOGIN, $this->user_login);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_PASS)) {
            $criteria->add(UserTableMap::COL_USER_PASS, $this->user_pass);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_PASS_IS_TEMP)) {
            $criteria->add(UserTableMap::COL_USER_PASS_IS_TEMP, $this->user_pass_is_temp);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_EMAIL)) {
            $criteria->add(UserTableMap::COL_USER_EMAIL, $this->user_email);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_PHONE)) {
            $criteria->add(UserTableMap::COL_USER_PHONE, $this->user_phone);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_ADDRESS)) {
            $criteria->add(UserTableMap::COL_USER_ADDRESS, $this->user_address);
        }
        if ($this->isColumnModified(UserTableMap::COL_ROLE_ID)) {
            $criteria->add(UserTableMap::COL_ROLE_ID, $this->role_id);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_IS_ACTIVE)) {
            $criteria->add(UserTableMap::COL_USER_IS_ACTIVE, $this->user_is_active);
        }
        if ($this->isColumnModified(UserTableMap::COL_USER_PIC)) {
            $criteria->add(UserTableMap::COL_USER_PIC, $this->user_pic);
        }
        if ($this->isColumnModified(UserTableMap::COL_CREATED_AT)) {
            $criteria->add(UserTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
            $criteria->add(UserTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildUserQuery::create();
        $criteria->add(UserTableMap::COL_USER_ID, $this->user_id);

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
        $validPk = null !== $this->getUserId();

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
        return $this->getUserId();
    }

    /**
     * Generic method to set the primary key (user_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setUserId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getUserId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\User (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setResourceId($this->getResourceId());
        $copyObj->setUseName($this->getUseName());
        $copyObj->setUserSurname($this->getUserSurname());
        $copyObj->setUserLogin($this->getUserLogin());
        $copyObj->setUserPass($this->getUserPass());
        $copyObj->setUserPassIsTemp($this->getUserPassIsTemp());
        $copyObj->setUserEmail($this->getUserEmail());
        $copyObj->setUserPhone($this->getUserPhone());
        $copyObj->setUserAddress($this->getUserAddress());
        $copyObj->setRoleId($this->getRoleId());
        $copyObj->setUserIsActive($this->getUserIsActive());
        $copyObj->setUserPic($this->getUserPic());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOrders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrder($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserPeriodicPlans() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserPeriodicPlan($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setUserId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\User Clone of current object.
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
     * Declares an association between this object and a ChildFile object.
     *
     * @param  ChildFile $v
     * @return $this|\App\Propel\User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFile(ChildFile $v = null)
    {
        if ($v === null) {
            $this->setUserPic(NULL);
        } else {
            $this->setUserPic($v->getFileId());
        }

        $this->aFile = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFile object, it will not be re-added.
        if ($v !== null) {
            $v->addUser($this);
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
        if ($this->aFile === null && ($this->user_pic !== null)) {
            $this->aFile = ChildFileQuery::create()->findPk($this->user_pic, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFile->addUsers($this);
             */
        }

        return $this->aFile;
    }

    /**
     * Declares an association between this object and a ChildRole object.
     *
     * @param  ChildRole $v
     * @return $this|\App\Propel\User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRole(ChildRole $v = null)
    {
        if ($v === null) {
            $this->setRoleId(NULL);
        } else {
            $this->setRoleId($v->getRoleId());
        }

        $this->aRole = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildRole object, it will not be re-added.
        if ($v !== null) {
            $v->addUser($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildRole object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildRole The associated ChildRole object.
     * @throws PropelException
     */
    public function getRole(ConnectionInterface $con = null)
    {
        if ($this->aRole === null && ($this->role_id !== null)) {
            $this->aRole = ChildRoleQuery::create()->findPk($this->role_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRole->addUsers($this);
             */
        }

        return $this->aRole;
    }

    /**
     * Declares an association between this object and a ChildResource object.
     *
     * @param  ChildResource $v
     * @return $this|\App\Propel\User The current object (for fluent API support)
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
            $v->addUser($this);
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
                $this->aResource->addUsers($this);
             */
        }

        return $this->aResource;
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
        if ('Order' == $relationName) {
            return $this->initOrders();
        }
        if ('UserPeriodicPlan' == $relationName) {
            return $this->initUserPeriodicPlans();
        }
    }

    /**
     * Clears out the collOrders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrders()
     */
    public function clearOrders()
    {
        $this->collOrders = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrders collection loaded partially.
     */
    public function resetPartialOrders($v = true)
    {
        $this->collOrdersPartial = $v;
    }

    /**
     * Initializes the collOrders collection.
     *
     * By default this just sets the collOrders collection to an empty array (like clearcollOrders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrders($overrideExisting = true)
    {
        if (null !== $this->collOrders && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderTableMap::getTableMap()->getCollectionClassName();

        $this->collOrders = new $collectionClassName;
        $this->collOrders->setModel('\App\Propel\Order');
    }

    /**
     * Gets an array of ChildOrder objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrder[] List of ChildOrder objects
     * @throws PropelException
     */
    public function getOrders(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrdersPartial && !$this->isNew();
        if (null === $this->collOrders || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collOrders) {
                // return empty collection
                $this->initOrders();
            } else {
                $collOrders = ChildOrderQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrdersPartial && count($collOrders)) {
                        $this->initOrders(false);

                        foreach ($collOrders as $obj) {
                            if (false == $this->collOrders->contains($obj)) {
                                $this->collOrders->append($obj);
                            }
                        }

                        $this->collOrdersPartial = true;
                    }

                    return $collOrders;
                }

                if ($partial && $this->collOrders) {
                    foreach ($this->collOrders as $obj) {
                        if ($obj->isNew()) {
                            $collOrders[] = $obj;
                        }
                    }
                }

                $this->collOrders = $collOrders;
                $this->collOrdersPartial = false;
            }
        }

        return $this->collOrders;
    }

    /**
     * Sets a collection of ChildOrder objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orders A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setOrders(Collection $orders, ConnectionInterface $con = null)
    {
        /** @var ChildOrder[] $ordersToDelete */
        $ordersToDelete = $this->getOrders(new Criteria(), $con)->diff($orders);


        $this->ordersScheduledForDeletion = $ordersToDelete;

        foreach ($ordersToDelete as $orderRemoved) {
            $orderRemoved->setUser(null);
        }

        $this->collOrders = null;
        foreach ($orders as $order) {
            $this->addOrder($order);
        }

        $this->collOrders = $orders;
        $this->collOrdersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Order objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Order objects.
     * @throws PropelException
     */
    public function countOrders(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrdersPartial && !$this->isNew();
        if (null === $this->collOrders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrders());
            }

            $query = ChildOrderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collOrders);
    }

    /**
     * Method called to associate a ChildOrder object to this object
     * through the ChildOrder foreign key attribute.
     *
     * @param  ChildOrder $l ChildOrder
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function addOrder(ChildOrder $l)
    {
        if ($this->collOrders === null) {
            $this->initOrders();
            $this->collOrdersPartial = true;
        }

        if (!$this->collOrders->contains($l)) {
            $this->doAddOrder($l);

            if ($this->ordersScheduledForDeletion and $this->ordersScheduledForDeletion->contains($l)) {
                $this->ordersScheduledForDeletion->remove($this->ordersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrder $order The ChildOrder object to add.
     */
    protected function doAddOrder(ChildOrder $order)
    {
        $this->collOrders[]= $order;
        $order->setUser($this);
    }

    /**
     * @param  ChildOrder $order The ChildOrder object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeOrder(ChildOrder $order)
    {
        if ($this->getOrders()->contains($order)) {
            $pos = $this->collOrders->search($order);
            $this->collOrders->remove($pos);
            if (null === $this->ordersScheduledForDeletion) {
                $this->ordersScheduledForDeletion = clone $this->collOrders;
                $this->ordersScheduledForDeletion->clear();
            }
            $this->ordersScheduledForDeletion[]= clone $order;
            $order->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Orders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrder[] List of ChildOrder objects
     */
    public function getOrdersJoinDelivery(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderQuery::create(null, $criteria);
        $query->joinWith('Delivery', $joinBehavior);

        return $this->getOrders($query, $con);
    }

    /**
     * Clears out the collUserPeriodicPlans collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserPeriodicPlans()
     */
    public function clearUserPeriodicPlans()
    {
        $this->collUserPeriodicPlans = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserPeriodicPlans collection loaded partially.
     */
    public function resetPartialUserPeriodicPlans($v = true)
    {
        $this->collUserPeriodicPlansPartial = $v;
    }

    /**
     * Initializes the collUserPeriodicPlans collection.
     *
     * By default this just sets the collUserPeriodicPlans collection to an empty array (like clearcollUserPeriodicPlans());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserPeriodicPlans($overrideExisting = true)
    {
        if (null !== $this->collUserPeriodicPlans && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserPeriodicPlanTableMap::getTableMap()->getCollectionClassName();

        $this->collUserPeriodicPlans = new $collectionClassName;
        $this->collUserPeriodicPlans->setModel('\App\Propel\UserPeriodicPlan');
    }

    /**
     * Gets an array of ChildUserPeriodicPlan objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserPeriodicPlan[] List of ChildUserPeriodicPlan objects
     * @throws PropelException
     */
    public function getUserPeriodicPlans(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserPeriodicPlansPartial && !$this->isNew();
        if (null === $this->collUserPeriodicPlans || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserPeriodicPlans) {
                // return empty collection
                $this->initUserPeriodicPlans();
            } else {
                $collUserPeriodicPlans = ChildUserPeriodicPlanQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserPeriodicPlansPartial && count($collUserPeriodicPlans)) {
                        $this->initUserPeriodicPlans(false);

                        foreach ($collUserPeriodicPlans as $obj) {
                            if (false == $this->collUserPeriodicPlans->contains($obj)) {
                                $this->collUserPeriodicPlans->append($obj);
                            }
                        }

                        $this->collUserPeriodicPlansPartial = true;
                    }

                    return $collUserPeriodicPlans;
                }

                if ($partial && $this->collUserPeriodicPlans) {
                    foreach ($this->collUserPeriodicPlans as $obj) {
                        if ($obj->isNew()) {
                            $collUserPeriodicPlans[] = $obj;
                        }
                    }
                }

                $this->collUserPeriodicPlans = $collUserPeriodicPlans;
                $this->collUserPeriodicPlansPartial = false;
            }
        }

        return $this->collUserPeriodicPlans;
    }

    /**
     * Sets a collection of ChildUserPeriodicPlan objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userPeriodicPlans A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setUserPeriodicPlans(Collection $userPeriodicPlans, ConnectionInterface $con = null)
    {
        /** @var ChildUserPeriodicPlan[] $userPeriodicPlansToDelete */
        $userPeriodicPlansToDelete = $this->getUserPeriodicPlans(new Criteria(), $con)->diff($userPeriodicPlans);


        $this->userPeriodicPlansScheduledForDeletion = $userPeriodicPlansToDelete;

        foreach ($userPeriodicPlansToDelete as $userPeriodicPlanRemoved) {
            $userPeriodicPlanRemoved->setUser(null);
        }

        $this->collUserPeriodicPlans = null;
        foreach ($userPeriodicPlans as $userPeriodicPlan) {
            $this->addUserPeriodicPlan($userPeriodicPlan);
        }

        $this->collUserPeriodicPlans = $userPeriodicPlans;
        $this->collUserPeriodicPlansPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserPeriodicPlan objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserPeriodicPlan objects.
     * @throws PropelException
     */
    public function countUserPeriodicPlans(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserPeriodicPlansPartial && !$this->isNew();
        if (null === $this->collUserPeriodicPlans || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserPeriodicPlans) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserPeriodicPlans());
            }

            $query = ChildUserPeriodicPlanQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collUserPeriodicPlans);
    }

    /**
     * Method called to associate a ChildUserPeriodicPlan object to this object
     * through the ChildUserPeriodicPlan foreign key attribute.
     *
     * @param  ChildUserPeriodicPlan $l ChildUserPeriodicPlan
     * @return $this|\App\Propel\User The current object (for fluent API support)
     */
    public function addUserPeriodicPlan(ChildUserPeriodicPlan $l)
    {
        if ($this->collUserPeriodicPlans === null) {
            $this->initUserPeriodicPlans();
            $this->collUserPeriodicPlansPartial = true;
        }

        if (!$this->collUserPeriodicPlans->contains($l)) {
            $this->doAddUserPeriodicPlan($l);

            if ($this->userPeriodicPlansScheduledForDeletion and $this->userPeriodicPlansScheduledForDeletion->contains($l)) {
                $this->userPeriodicPlansScheduledForDeletion->remove($this->userPeriodicPlansScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUserPeriodicPlan $userPeriodicPlan The ChildUserPeriodicPlan object to add.
     */
    protected function doAddUserPeriodicPlan(ChildUserPeriodicPlan $userPeriodicPlan)
    {
        $this->collUserPeriodicPlans[]= $userPeriodicPlan;
        $userPeriodicPlan->setUser($this);
    }

    /**
     * @param  ChildUserPeriodicPlan $userPeriodicPlan The ChildUserPeriodicPlan object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeUserPeriodicPlan(ChildUserPeriodicPlan $userPeriodicPlan)
    {
        if ($this->getUserPeriodicPlans()->contains($userPeriodicPlan)) {
            $pos = $this->collUserPeriodicPlans->search($userPeriodicPlan);
            $this->collUserPeriodicPlans->remove($pos);
            if (null === $this->userPeriodicPlansScheduledForDeletion) {
                $this->userPeriodicPlansScheduledForDeletion = clone $this->collUserPeriodicPlans;
                $this->userPeriodicPlansScheduledForDeletion->clear();
            }
            $this->userPeriodicPlansScheduledForDeletion[]= clone $userPeriodicPlan;
            $userPeriodicPlan->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserPeriodicPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserPeriodicPlan[] List of ChildUserPeriodicPlan objects
     */
    public function getUserPeriodicPlansJoinPeriodicPlan(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserPeriodicPlanQuery::create(null, $criteria);
        $query->joinWith('PeriodicPlan', $joinBehavior);

        return $this->getUserPeriodicPlans($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aFile) {
            $this->aFile->removeUser($this);
        }
        if (null !== $this->aRole) {
            $this->aRole->removeUser($this);
        }
        if (null !== $this->aResource) {
            $this->aResource->removeUser($this);
        }
        $this->user_id = null;
        $this->resource_id = null;
        $this->use_name = null;
        $this->user_surname = null;
        $this->user_login = null;
        $this->user_pass = null;
        $this->user_pass_is_temp = null;
        $this->user_email = null;
        $this->user_phone = null;
        $this->user_address = null;
        $this->role_id = null;
        $this->user_is_active = null;
        $this->user_pic = null;
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
            if ($this->collOrders) {
                foreach ($this->collOrders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserPeriodicPlans) {
                foreach ($this->collUserPeriodicPlans as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOrders = null;
        $this->collUserPeriodicPlans = null;
        $this->aFile = null;
        $this->aRole = null;
        $this->aResource = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildUser The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[UserTableMap::COL_UPDATED_AT] = true;

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
