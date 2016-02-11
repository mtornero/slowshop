<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Category as ChildCategory;
use App\Propel\CategoryQuery as ChildCategoryQuery;
use App\Propel\News as ChildNews;
use App\Propel\NewsQuery as ChildNewsQuery;
use App\Propel\PeriodicPlan as ChildPeriodicPlan;
use App\Propel\PeriodicPlanQuery as ChildPeriodicPlanQuery;
use App\Propel\Product as ChildProduct;
use App\Propel\ProductHighlighted as ChildProductHighlighted;
use App\Propel\ProductHighlightedQuery as ChildProductHighlightedQuery;
use App\Propel\ProductQuery as ChildProductQuery;
use App\Propel\Promotion as ChildPromotion;
use App\Propel\PromotionQuery as ChildPromotionQuery;
use App\Propel\Provider as ChildProvider;
use App\Propel\ProviderQuery as ChildProviderQuery;
use App\Propel\Resource as ChildResource;
use App\Propel\ResourceFile as ChildResourceFile;
use App\Propel\ResourceFileQuery as ChildResourceFileQuery;
use App\Propel\ResourceQuery as ChildResourceQuery;
use App\Propel\ResourceType as ChildResourceType;
use App\Propel\ResourceTypeQuery as ChildResourceTypeQuery;
use App\Propel\SocialComment as ChildSocialComment;
use App\Propel\SocialCommentQuery as ChildSocialCommentQuery;
use App\Propel\SocialLike as ChildSocialLike;
use App\Propel\SocialLikeQuery as ChildSocialLikeQuery;
use App\Propel\SocialRecommendation as ChildSocialRecommendation;
use App\Propel\SocialRecommendationQuery as ChildSocialRecommendationQuery;
use App\Propel\SocialView as ChildSocialView;
use App\Propel\SocialViewQuery as ChildSocialViewQuery;
use App\Propel\User as ChildUser;
use App\Propel\UserQuery as ChildUserQuery;
use App\Propel\Map\CategoryTableMap;
use App\Propel\Map\NewsTableMap;
use App\Propel\Map\PeriodicPlanTableMap;
use App\Propel\Map\ProductHighlightedTableMap;
use App\Propel\Map\ProductTableMap;
use App\Propel\Map\PromotionTableMap;
use App\Propel\Map\ProviderTableMap;
use App\Propel\Map\ResourceFileTableMap;
use App\Propel\Map\ResourceTableMap;
use App\Propel\Map\SocialCommentTableMap;
use App\Propel\Map\SocialLikeTableMap;
use App\Propel\Map\SocialRecommendationTableMap;
use App\Propel\Map\SocialViewTableMap;
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

/**
 * Base class that represents a row from the 'resource' table.
 *
 *
 *
* @package    propel.generator.App.Propel.Base
*/
abstract class Resource implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Propel\\Map\\ResourceTableMap';


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
     * The value for the resource_id field.
     *
     * @var        int
     */
    protected $resource_id;

    /**
     * The value for the resource_type_id field.
     *
     * @var        int
     */
    protected $resource_type_id;

    /**
     * The value for the social_views field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $social_views;

    /**
     * The value for the social_likes field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $social_likes;

    /**
     * The value for the social_dislikes field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $social_dislikes;

    /**
     * The value for the social_comments field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $social_comments;

    /**
     * The value for the social_favourites field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $social_favourites;

    /**
     * The value for the social_recommendations field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $social_recommendations;

    /**
     * @var        ChildResourceType
     */
    protected $aResourceType;

    /**
     * @var        ObjectCollection|ChildCategory[] Collection to store aggregation of ChildCategory objects.
     */
    protected $collCategories;
    protected $collCategoriesPartial;

    /**
     * @var        ObjectCollection|ChildNews[] Collection to store aggregation of ChildNews objects.
     */
    protected $collNewsRelatedByResourceId;
    protected $collNewsRelatedByResourceIdPartial;

    /**
     * @var        ObjectCollection|ChildNews[] Collection to store aggregation of ChildNews objects.
     */
    protected $collNewsRelatedByNewsFor;
    protected $collNewsRelatedByNewsForPartial;

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
     * @var        ObjectCollection|ChildProductHighlighted[] Collection to store aggregation of ChildProductHighlighted objects.
     */
    protected $collProductHighlighteds;
    protected $collProductHighlightedsPartial;

    /**
     * @var        ObjectCollection|ChildPromotion[] Collection to store aggregation of ChildPromotion objects.
     */
    protected $collPromotions;
    protected $collPromotionsPartial;

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
     * @var        ObjectCollection|ChildSocialView[] Collection to store aggregation of ChildSocialView objects.
     */
    protected $collSocialViews;
    protected $collSocialViewsPartial;

    /**
     * @var        ObjectCollection|ChildSocialLike[] Collection to store aggregation of ChildSocialLike objects.
     */
    protected $collSocialLikes;
    protected $collSocialLikesPartial;

    /**
     * @var        ObjectCollection|ChildSocialComment[] Collection to store aggregation of ChildSocialComment objects.
     */
    protected $collSocialComments;
    protected $collSocialCommentsPartial;

    /**
     * @var        ObjectCollection|ChildSocialRecommendation[] Collection to store aggregation of ChildSocialRecommendation objects.
     */
    protected $collSocialRecommendations;
    protected $collSocialRecommendationsPartial;

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
    protected $newsRelatedByResourceIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildNews[]
     */
    protected $newsRelatedByNewsForScheduledForDeletion = null;

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
     * @var ObjectCollection|ChildProductHighlighted[]
     */
    protected $productHighlightedsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPromotion[]
     */
    protected $promotionsScheduledForDeletion = null;

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
     * @var ObjectCollection|ChildSocialView[]
     */
    protected $socialViewsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSocialLike[]
     */
    protected $socialLikesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSocialComment[]
     */
    protected $socialCommentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSocialRecommendation[]
     */
    protected $socialRecommendationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUser[]
     */
    protected $usersScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->social_views = 0;
        $this->social_likes = 0;
        $this->social_dislikes = 0;
        $this->social_comments = 0;
        $this->social_favourites = 0;
        $this->social_recommendations = 0;
    }

    /**
     * Initializes internal state of App\Propel\Base\Resource object.
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
     * Compares this with another <code>Resource</code> instance.  If
     * <code>obj</code> is an instance of <code>Resource</code>, delegates to
     * <code>equals(Resource)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Resource The current object, for fluid interface
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
     * Get the [resource_id] column value.
     *
     * @return int
     */
    public function getResourceId()
    {
        return $this->resource_id;
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
     * Get the [social_views] column value.
     *
     * @return int
     */
    public function getSocialViews()
    {
        return $this->social_views;
    }

    /**
     * Get the [social_likes] column value.
     *
     * @return int
     */
    public function getSocialLikes()
    {
        return $this->social_likes;
    }

    /**
     * Get the [social_dislikes] column value.
     *
     * @return int
     */
    public function getSocialDislikes()
    {
        return $this->social_dislikes;
    }

    /**
     * Get the [social_comments] column value.
     *
     * @return int
     */
    public function getSocialComments()
    {
        return $this->social_comments;
    }

    /**
     * Get the [social_favourites] column value.
     *
     * @return int
     */
    public function getSocialFavourites()
    {
        return $this->social_favourites;
    }

    /**
     * Get the [social_recommendations] column value.
     *
     * @return int
     */
    public function getSocialRecommendations()
    {
        return $this->social_recommendations;
    }

    /**
     * Set the value of [resource_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function setResourceId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->resource_id !== $v) {
            $this->resource_id = $v;
            $this->modifiedColumns[ResourceTableMap::COL_RESOURCE_ID] = true;
        }

        return $this;
    } // setResourceId()

    /**
     * Set the value of [resource_type_id] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function setResourceTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->resource_type_id !== $v) {
            $this->resource_type_id = $v;
            $this->modifiedColumns[ResourceTableMap::COL_RESOURCE_TYPE_ID] = true;
        }

        if ($this->aResourceType !== null && $this->aResourceType->getResourceTypeId() !== $v) {
            $this->aResourceType = null;
        }

        return $this;
    } // setResourceTypeId()

    /**
     * Set the value of [social_views] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function setSocialViews($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->social_views !== $v) {
            $this->social_views = $v;
            $this->modifiedColumns[ResourceTableMap::COL_SOCIAL_VIEWS] = true;
        }

        return $this;
    } // setSocialViews()

    /**
     * Set the value of [social_likes] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function setSocialLikes($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->social_likes !== $v) {
            $this->social_likes = $v;
            $this->modifiedColumns[ResourceTableMap::COL_SOCIAL_LIKES] = true;
        }

        return $this;
    } // setSocialLikes()

    /**
     * Set the value of [social_dislikes] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function setSocialDislikes($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->social_dislikes !== $v) {
            $this->social_dislikes = $v;
            $this->modifiedColumns[ResourceTableMap::COL_SOCIAL_DISLIKES] = true;
        }

        return $this;
    } // setSocialDislikes()

    /**
     * Set the value of [social_comments] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function setSocialComments($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->social_comments !== $v) {
            $this->social_comments = $v;
            $this->modifiedColumns[ResourceTableMap::COL_SOCIAL_COMMENTS] = true;
        }

        return $this;
    } // setSocialComments()

    /**
     * Set the value of [social_favourites] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function setSocialFavourites($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->social_favourites !== $v) {
            $this->social_favourites = $v;
            $this->modifiedColumns[ResourceTableMap::COL_SOCIAL_FAVOURITES] = true;
        }

        return $this;
    } // setSocialFavourites()

    /**
     * Set the value of [social_recommendations] column.
     *
     * @param int $v new value
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function setSocialRecommendations($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->social_recommendations !== $v) {
            $this->social_recommendations = $v;
            $this->modifiedColumns[ResourceTableMap::COL_SOCIAL_RECOMMENDATIONS] = true;
        }

        return $this;
    } // setSocialRecommendations()

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
            if ($this->social_views !== 0) {
                return false;
            }

            if ($this->social_likes !== 0) {
                return false;
            }

            if ($this->social_dislikes !== 0) {
                return false;
            }

            if ($this->social_comments !== 0) {
                return false;
            }

            if ($this->social_favourites !== 0) {
                return false;
            }

            if ($this->social_recommendations !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ResourceTableMap::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resource_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ResourceTableMap::translateFieldName('ResourceTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resource_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ResourceTableMap::translateFieldName('SocialViews', TableMap::TYPE_PHPNAME, $indexType)];
            $this->social_views = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ResourceTableMap::translateFieldName('SocialLikes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->social_likes = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ResourceTableMap::translateFieldName('SocialDislikes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->social_dislikes = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ResourceTableMap::translateFieldName('SocialComments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->social_comments = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ResourceTableMap::translateFieldName('SocialFavourites', TableMap::TYPE_PHPNAME, $indexType)];
            $this->social_favourites = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ResourceTableMap::translateFieldName('SocialRecommendations', TableMap::TYPE_PHPNAME, $indexType)];
            $this->social_recommendations = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = ResourceTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Propel\\Resource'), 0, $e);
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
        if ($this->aResourceType !== null && $this->resource_type_id !== $this->aResourceType->getResourceTypeId()) {
            $this->aResourceType = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ResourceTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildResourceQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aResourceType = null;
            $this->collCategories = null;

            $this->collNewsRelatedByResourceId = null;

            $this->collNewsRelatedByNewsFor = null;

            $this->collPeriodicPlans = null;

            $this->collProducts = null;

            $this->collProductHighlighteds = null;

            $this->collPromotions = null;

            $this->collProviders = null;

            $this->collResourceFiles = null;

            $this->collSocialViews = null;

            $this->collSocialLikes = null;

            $this->collSocialComments = null;

            $this->collSocialRecommendations = null;

            $this->collUsers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Resource::setDeleted()
     * @see Resource::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildResourceQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceTableMap::DATABASE_NAME);
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
                ResourceTableMap::addInstanceToPool($this);
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

            if ($this->aResourceType !== null) {
                if ($this->aResourceType->isModified() || $this->aResourceType->isNew()) {
                    $affectedRows += $this->aResourceType->save($con);
                }
                $this->setResourceType($this->aResourceType);
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
                    \App\Propel\CategoryQuery::create()
                        ->filterByPrimaryKeys($this->categoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->newsRelatedByResourceIdScheduledForDeletion !== null) {
                if (!$this->newsRelatedByResourceIdScheduledForDeletion->isEmpty()) {
                    \App\Propel\NewsQuery::create()
                        ->filterByPrimaryKeys($this->newsRelatedByResourceIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->newsRelatedByResourceIdScheduledForDeletion = null;
                }
            }

            if ($this->collNewsRelatedByResourceId !== null) {
                foreach ($this->collNewsRelatedByResourceId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->newsRelatedByNewsForScheduledForDeletion !== null) {
                if (!$this->newsRelatedByNewsForScheduledForDeletion->isEmpty()) {
                    foreach ($this->newsRelatedByNewsForScheduledForDeletion as $newsRelatedByNewsFor) {
                        // need to save related object because we set the relation to null
                        $newsRelatedByNewsFor->save($con);
                    }
                    $this->newsRelatedByNewsForScheduledForDeletion = null;
                }
            }

            if ($this->collNewsRelatedByNewsFor !== null) {
                foreach ($this->collNewsRelatedByNewsFor as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->productsScheduledForDeletion !== null) {
                if (!$this->productsScheduledForDeletion->isEmpty()) {
                    \App\Propel\ProductQuery::create()
                        ->filterByPrimaryKeys($this->productsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->productHighlightedsScheduledForDeletion !== null) {
                if (!$this->productHighlightedsScheduledForDeletion->isEmpty()) {
                    foreach ($this->productHighlightedsScheduledForDeletion as $productHighlighted) {
                        // need to save related object because we set the relation to null
                        $productHighlighted->save($con);
                    }
                    $this->productHighlightedsScheduledForDeletion = null;
                }
            }

            if ($this->collProductHighlighteds !== null) {
                foreach ($this->collProductHighlighteds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->promotionsScheduledForDeletion !== null) {
                if (!$this->promotionsScheduledForDeletion->isEmpty()) {
                    \App\Propel\PromotionQuery::create()
                        ->filterByPrimaryKeys($this->promotionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->promotionsScheduledForDeletion = null;
                }
            }

            if ($this->collPromotions !== null) {
                foreach ($this->collPromotions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->providersScheduledForDeletion !== null) {
                if (!$this->providersScheduledForDeletion->isEmpty()) {
                    \App\Propel\ProviderQuery::create()
                        ->filterByPrimaryKeys($this->providersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->socialViewsScheduledForDeletion !== null) {
                if (!$this->socialViewsScheduledForDeletion->isEmpty()) {
                    \App\Propel\SocialViewQuery::create()
                        ->filterByPrimaryKeys($this->socialViewsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->socialViewsScheduledForDeletion = null;
                }
            }

            if ($this->collSocialViews !== null) {
                foreach ($this->collSocialViews as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->socialLikesScheduledForDeletion !== null) {
                if (!$this->socialLikesScheduledForDeletion->isEmpty()) {
                    \App\Propel\SocialLikeQuery::create()
                        ->filterByPrimaryKeys($this->socialLikesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->socialLikesScheduledForDeletion = null;
                }
            }

            if ($this->collSocialLikes !== null) {
                foreach ($this->collSocialLikes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->socialCommentsScheduledForDeletion !== null) {
                if (!$this->socialCommentsScheduledForDeletion->isEmpty()) {
                    \App\Propel\SocialCommentQuery::create()
                        ->filterByPrimaryKeys($this->socialCommentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->socialCommentsScheduledForDeletion = null;
                }
            }

            if ($this->collSocialComments !== null) {
                foreach ($this->collSocialComments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->socialRecommendationsScheduledForDeletion !== null) {
                if (!$this->socialRecommendationsScheduledForDeletion->isEmpty()) {
                    \App\Propel\SocialRecommendationQuery::create()
                        ->filterByPrimaryKeys($this->socialRecommendationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->socialRecommendationsScheduledForDeletion = null;
                }
            }

            if ($this->collSocialRecommendations !== null) {
                foreach ($this->collSocialRecommendations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usersScheduledForDeletion !== null) {
                if (!$this->usersScheduledForDeletion->isEmpty()) {
                    \App\Propel\UserQuery::create()
                        ->filterByPrimaryKeys($this->usersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

        $this->modifiedColumns[ResourceTableMap::COL_RESOURCE_ID] = true;
        if (null !== $this->resource_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ResourceTableMap::COL_RESOURCE_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ResourceTableMap::COL_RESOURCE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'resource_id';
        }
        if ($this->isColumnModified(ResourceTableMap::COL_RESOURCE_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'resource_type_id';
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_VIEWS)) {
            $modifiedColumns[':p' . $index++]  = 'social_views';
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_LIKES)) {
            $modifiedColumns[':p' . $index++]  = 'social_likes';
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_DISLIKES)) {
            $modifiedColumns[':p' . $index++]  = 'social_dislikes';
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_COMMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'social_comments';
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_FAVOURITES)) {
            $modifiedColumns[':p' . $index++]  = 'social_favourites';
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_RECOMMENDATIONS)) {
            $modifiedColumns[':p' . $index++]  = 'social_recommendations';
        }

        $sql = sprintf(
            'INSERT INTO resource (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'resource_id':
                        $stmt->bindValue($identifier, $this->resource_id, PDO::PARAM_INT);
                        break;
                    case 'resource_type_id':
                        $stmt->bindValue($identifier, $this->resource_type_id, PDO::PARAM_INT);
                        break;
                    case 'social_views':
                        $stmt->bindValue($identifier, $this->social_views, PDO::PARAM_INT);
                        break;
                    case 'social_likes':
                        $stmt->bindValue($identifier, $this->social_likes, PDO::PARAM_INT);
                        break;
                    case 'social_dislikes':
                        $stmt->bindValue($identifier, $this->social_dislikes, PDO::PARAM_INT);
                        break;
                    case 'social_comments':
                        $stmt->bindValue($identifier, $this->social_comments, PDO::PARAM_INT);
                        break;
                    case 'social_favourites':
                        $stmt->bindValue($identifier, $this->social_favourites, PDO::PARAM_INT);
                        break;
                    case 'social_recommendations':
                        $stmt->bindValue($identifier, $this->social_recommendations, PDO::PARAM_INT);
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
        $this->setResourceId($pk);

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
        $pos = ResourceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getResourceId();
                break;
            case 1:
                return $this->getResourceTypeId();
                break;
            case 2:
                return $this->getSocialViews();
                break;
            case 3:
                return $this->getSocialLikes();
                break;
            case 4:
                return $this->getSocialDislikes();
                break;
            case 5:
                return $this->getSocialComments();
                break;
            case 6:
                return $this->getSocialFavourites();
                break;
            case 7:
                return $this->getSocialRecommendations();
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

        if (isset($alreadyDumpedObjects['Resource'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Resource'][$this->hashCode()] = true;
        $keys = ResourceTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getResourceId(),
            $keys[1] => $this->getResourceTypeId(),
            $keys[2] => $this->getSocialViews(),
            $keys[3] => $this->getSocialLikes(),
            $keys[4] => $this->getSocialDislikes(),
            $keys[5] => $this->getSocialComments(),
            $keys[6] => $this->getSocialFavourites(),
            $keys[7] => $this->getSocialRecommendations(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aResourceType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'resourceType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'resource_type';
                        break;
                    default:
                        $key = 'ResourceType';
                }

                $result[$key] = $this->aResourceType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collNewsRelatedByResourceId) {

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

                $result[$key] = $this->collNewsRelatedByResourceId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNewsRelatedByNewsFor) {

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

                $result[$key] = $this->collNewsRelatedByNewsFor->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collProductHighlighteds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productHighlighteds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_highlighteds';
                        break;
                    default:
                        $key = 'ProductHighlighteds';
                }

                $result[$key] = $this->collProductHighlighteds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPromotions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'promotions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'promotions';
                        break;
                    default:
                        $key = 'Promotions';
                }

                $result[$key] = $this->collPromotions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collSocialViews) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'socialViews';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'social_views';
                        break;
                    default:
                        $key = 'SocialViews';
                }

                $result[$key] = $this->collSocialViews->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSocialLikes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'socialLikes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'social_likes';
                        break;
                    default:
                        $key = 'SocialLikes';
                }

                $result[$key] = $this->collSocialLikes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSocialComments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'socialComments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'social_comments';
                        break;
                    default:
                        $key = 'SocialComments';
                }

                $result[$key] = $this->collSocialComments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSocialRecommendations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'socialRecommendations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'social_recommendations';
                        break;
                    default:
                        $key = 'SocialRecommendations';
                }

                $result[$key] = $this->collSocialRecommendations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Propel\Resource
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ResourceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Propel\Resource
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setResourceId($value);
                break;
            case 1:
                $this->setResourceTypeId($value);
                break;
            case 2:
                $this->setSocialViews($value);
                break;
            case 3:
                $this->setSocialLikes($value);
                break;
            case 4:
                $this->setSocialDislikes($value);
                break;
            case 5:
                $this->setSocialComments($value);
                break;
            case 6:
                $this->setSocialFavourites($value);
                break;
            case 7:
                $this->setSocialRecommendations($value);
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
        $keys = ResourceTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setResourceId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setResourceTypeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSocialViews($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSocialLikes($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSocialDislikes($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSocialComments($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSocialFavourites($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSocialRecommendations($arr[$keys[7]]);
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
     * @return $this|\App\Propel\Resource The current object, for fluid interface
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
        $criteria = new Criteria(ResourceTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ResourceTableMap::COL_RESOURCE_ID)) {
            $criteria->add(ResourceTableMap::COL_RESOURCE_ID, $this->resource_id);
        }
        if ($this->isColumnModified(ResourceTableMap::COL_RESOURCE_TYPE_ID)) {
            $criteria->add(ResourceTableMap::COL_RESOURCE_TYPE_ID, $this->resource_type_id);
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_VIEWS)) {
            $criteria->add(ResourceTableMap::COL_SOCIAL_VIEWS, $this->social_views);
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_LIKES)) {
            $criteria->add(ResourceTableMap::COL_SOCIAL_LIKES, $this->social_likes);
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_DISLIKES)) {
            $criteria->add(ResourceTableMap::COL_SOCIAL_DISLIKES, $this->social_dislikes);
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_COMMENTS)) {
            $criteria->add(ResourceTableMap::COL_SOCIAL_COMMENTS, $this->social_comments);
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_FAVOURITES)) {
            $criteria->add(ResourceTableMap::COL_SOCIAL_FAVOURITES, $this->social_favourites);
        }
        if ($this->isColumnModified(ResourceTableMap::COL_SOCIAL_RECOMMENDATIONS)) {
            $criteria->add(ResourceTableMap::COL_SOCIAL_RECOMMENDATIONS, $this->social_recommendations);
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
        $criteria = ChildResourceQuery::create();
        $criteria->add(ResourceTableMap::COL_RESOURCE_ID, $this->resource_id);

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
        $validPk = null !== $this->getResourceId();

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
        return $this->getResourceId();
    }

    /**
     * Generic method to set the primary key (resource_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setResourceId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getResourceId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Propel\Resource (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setResourceTypeId($this->getResourceTypeId());
        $copyObj->setSocialViews($this->getSocialViews());
        $copyObj->setSocialLikes($this->getSocialLikes());
        $copyObj->setSocialDislikes($this->getSocialDislikes());
        $copyObj->setSocialComments($this->getSocialComments());
        $copyObj->setSocialFavourites($this->getSocialFavourites());
        $copyObj->setSocialRecommendations($this->getSocialRecommendations());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCategory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNewsRelatedByResourceId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNewsRelatedByResourceId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNewsRelatedByNewsFor() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNewsRelatedByNewsFor($relObj->copy($deepCopy));
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

            foreach ($this->getProductHighlighteds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductHighlighted($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPromotions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPromotion($relObj->copy($deepCopy));
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

            foreach ($this->getSocialViews() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSocialView($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSocialLikes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSocialLike($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSocialComments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSocialComment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSocialRecommendations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSocialRecommendation($relObj->copy($deepCopy));
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
            $copyObj->setResourceId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Propel\Resource Clone of current object.
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
     * Declares an association between this object and a ChildResourceType object.
     *
     * @param  ChildResourceType $v
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     * @throws PropelException
     */
    public function setResourceType(ChildResourceType $v = null)
    {
        if ($v === null) {
            $this->setResourceTypeId(NULL);
        } else {
            $this->setResourceTypeId($v->getResourceTypeId());
        }

        $this->aResourceType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildResourceType object, it will not be re-added.
        if ($v !== null) {
            $v->addResource($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildResourceType object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildResourceType The associated ChildResourceType object.
     * @throws PropelException
     */
    public function getResourceType(ConnectionInterface $con = null)
    {
        if ($this->aResourceType === null && ($this->resource_type_id !== null)) {
            $this->aResourceType = ChildResourceTypeQuery::create()->findPk($this->resource_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aResourceType->addResources($this);
             */
        }

        return $this->aResourceType;
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
        if ('NewsRelatedByResourceId' == $relationName) {
            return $this->initNewsRelatedByResourceId();
        }
        if ('NewsRelatedByNewsFor' == $relationName) {
            return $this->initNewsRelatedByNewsFor();
        }
        if ('PeriodicPlan' == $relationName) {
            return $this->initPeriodicPlans();
        }
        if ('Product' == $relationName) {
            return $this->initProducts();
        }
        if ('ProductHighlighted' == $relationName) {
            return $this->initProductHighlighteds();
        }
        if ('Promotion' == $relationName) {
            return $this->initPromotions();
        }
        if ('Provider' == $relationName) {
            return $this->initProviders();
        }
        if ('ResourceFile' == $relationName) {
            return $this->initResourceFiles();
        }
        if ('SocialView' == $relationName) {
            return $this->initSocialViews();
        }
        if ('SocialLike' == $relationName) {
            return $this->initSocialLikes();
        }
        if ('SocialComment' == $relationName) {
            return $this->initSocialComments();
        }
        if ('SocialRecommendation' == $relationName) {
            return $this->initSocialRecommendations();
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
     * If this ChildResource is new, it will return
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
                    ->filterByResource($this)
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
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setCategories(Collection $categories, ConnectionInterface $con = null)
    {
        /** @var ChildCategory[] $categoriesToDelete */
        $categoriesToDelete = $this->getCategories(new Criteria(), $con)->diff($categories);


        $this->categoriesScheduledForDeletion = $categoriesToDelete;

        foreach ($categoriesToDelete as $categoryRemoved) {
            $categoryRemoved->setResource(null);
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
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collCategories);
    }

    /**
     * Method called to associate a ChildCategory object to this object
     * through the ChildCategory foreign key attribute.
     *
     * @param  ChildCategory $l ChildCategory
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
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
        $category->setResource($this);
    }

    /**
     * @param  ChildCategory $category The ChildCategory object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
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
            $this->categoriesScheduledForDeletion[]= clone $category;
            $category->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related Categories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategory[] List of ChildCategory objects
     */
    public function getCategoriesJoinFile(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoryQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getCategories($query, $con);
    }

    /**
     * Clears out the collNewsRelatedByResourceId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addNewsRelatedByResourceId()
     */
    public function clearNewsRelatedByResourceId()
    {
        $this->collNewsRelatedByResourceId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collNewsRelatedByResourceId collection loaded partially.
     */
    public function resetPartialNewsRelatedByResourceId($v = true)
    {
        $this->collNewsRelatedByResourceIdPartial = $v;
    }

    /**
     * Initializes the collNewsRelatedByResourceId collection.
     *
     * By default this just sets the collNewsRelatedByResourceId collection to an empty array (like clearcollNewsRelatedByResourceId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNewsRelatedByResourceId($overrideExisting = true)
    {
        if (null !== $this->collNewsRelatedByResourceId && !$overrideExisting) {
            return;
        }

        $collectionClassName = NewsTableMap::getTableMap()->getCollectionClassName();

        $this->collNewsRelatedByResourceId = new $collectionClassName;
        $this->collNewsRelatedByResourceId->setModel('\App\Propel\News');
    }

    /**
     * Gets an array of ChildNews objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildResource is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildNews[] List of ChildNews objects
     * @throws PropelException
     */
    public function getNewsRelatedByResourceId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collNewsRelatedByResourceIdPartial && !$this->isNew();
        if (null === $this->collNewsRelatedByResourceId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNewsRelatedByResourceId) {
                // return empty collection
                $this->initNewsRelatedByResourceId();
            } else {
                $collNewsRelatedByResourceId = ChildNewsQuery::create(null, $criteria)
                    ->filterByResourceRelatedByResourceId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNewsRelatedByResourceIdPartial && count($collNewsRelatedByResourceId)) {
                        $this->initNewsRelatedByResourceId(false);

                        foreach ($collNewsRelatedByResourceId as $obj) {
                            if (false == $this->collNewsRelatedByResourceId->contains($obj)) {
                                $this->collNewsRelatedByResourceId->append($obj);
                            }
                        }

                        $this->collNewsRelatedByResourceIdPartial = true;
                    }

                    return $collNewsRelatedByResourceId;
                }

                if ($partial && $this->collNewsRelatedByResourceId) {
                    foreach ($this->collNewsRelatedByResourceId as $obj) {
                        if ($obj->isNew()) {
                            $collNewsRelatedByResourceId[] = $obj;
                        }
                    }
                }

                $this->collNewsRelatedByResourceId = $collNewsRelatedByResourceId;
                $this->collNewsRelatedByResourceIdPartial = false;
            }
        }

        return $this->collNewsRelatedByResourceId;
    }

    /**
     * Sets a collection of ChildNews objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $newsRelatedByResourceId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setNewsRelatedByResourceId(Collection $newsRelatedByResourceId, ConnectionInterface $con = null)
    {
        /** @var ChildNews[] $newsRelatedByResourceIdToDelete */
        $newsRelatedByResourceIdToDelete = $this->getNewsRelatedByResourceId(new Criteria(), $con)->diff($newsRelatedByResourceId);


        $this->newsRelatedByResourceIdScheduledForDeletion = $newsRelatedByResourceIdToDelete;

        foreach ($newsRelatedByResourceIdToDelete as $newsRelatedByResourceIdRemoved) {
            $newsRelatedByResourceIdRemoved->setResourceRelatedByResourceId(null);
        }

        $this->collNewsRelatedByResourceId = null;
        foreach ($newsRelatedByResourceId as $newsRelatedByResourceId) {
            $this->addNewsRelatedByResourceId($newsRelatedByResourceId);
        }

        $this->collNewsRelatedByResourceId = $newsRelatedByResourceId;
        $this->collNewsRelatedByResourceIdPartial = false;

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
    public function countNewsRelatedByResourceId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collNewsRelatedByResourceIdPartial && !$this->isNew();
        if (null === $this->collNewsRelatedByResourceId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNewsRelatedByResourceId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNewsRelatedByResourceId());
            }

            $query = ChildNewsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResourceRelatedByResourceId($this)
                ->count($con);
        }

        return count($this->collNewsRelatedByResourceId);
    }

    /**
     * Method called to associate a ChildNews object to this object
     * through the ChildNews foreign key attribute.
     *
     * @param  ChildNews $l ChildNews
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function addNewsRelatedByResourceId(ChildNews $l)
    {
        if ($this->collNewsRelatedByResourceId === null) {
            $this->initNewsRelatedByResourceId();
            $this->collNewsRelatedByResourceIdPartial = true;
        }

        if (!$this->collNewsRelatedByResourceId->contains($l)) {
            $this->doAddNewsRelatedByResourceId($l);

            if ($this->newsRelatedByResourceIdScheduledForDeletion and $this->newsRelatedByResourceIdScheduledForDeletion->contains($l)) {
                $this->newsRelatedByResourceIdScheduledForDeletion->remove($this->newsRelatedByResourceIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildNews $newsRelatedByResourceId The ChildNews object to add.
     */
    protected function doAddNewsRelatedByResourceId(ChildNews $newsRelatedByResourceId)
    {
        $this->collNewsRelatedByResourceId[]= $newsRelatedByResourceId;
        $newsRelatedByResourceId->setResourceRelatedByResourceId($this);
    }

    /**
     * @param  ChildNews $newsRelatedByResourceId The ChildNews object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function removeNewsRelatedByResourceId(ChildNews $newsRelatedByResourceId)
    {
        if ($this->getNewsRelatedByResourceId()->contains($newsRelatedByResourceId)) {
            $pos = $this->collNewsRelatedByResourceId->search($newsRelatedByResourceId);
            $this->collNewsRelatedByResourceId->remove($pos);
            if (null === $this->newsRelatedByResourceIdScheduledForDeletion) {
                $this->newsRelatedByResourceIdScheduledForDeletion = clone $this->collNewsRelatedByResourceId;
                $this->newsRelatedByResourceIdScheduledForDeletion->clear();
            }
            $this->newsRelatedByResourceIdScheduledForDeletion[]= clone $newsRelatedByResourceId;
            $newsRelatedByResourceId->setResourceRelatedByResourceId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related NewsRelatedByResourceId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNews[] List of ChildNews objects
     */
    public function getNewsRelatedByResourceIdJoinFile(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNewsQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getNewsRelatedByResourceId($query, $con);
    }

    /**
     * Clears out the collNewsRelatedByNewsFor collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addNewsRelatedByNewsFor()
     */
    public function clearNewsRelatedByNewsFor()
    {
        $this->collNewsRelatedByNewsFor = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collNewsRelatedByNewsFor collection loaded partially.
     */
    public function resetPartialNewsRelatedByNewsFor($v = true)
    {
        $this->collNewsRelatedByNewsForPartial = $v;
    }

    /**
     * Initializes the collNewsRelatedByNewsFor collection.
     *
     * By default this just sets the collNewsRelatedByNewsFor collection to an empty array (like clearcollNewsRelatedByNewsFor());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNewsRelatedByNewsFor($overrideExisting = true)
    {
        if (null !== $this->collNewsRelatedByNewsFor && !$overrideExisting) {
            return;
        }

        $collectionClassName = NewsTableMap::getTableMap()->getCollectionClassName();

        $this->collNewsRelatedByNewsFor = new $collectionClassName;
        $this->collNewsRelatedByNewsFor->setModel('\App\Propel\News');
    }

    /**
     * Gets an array of ChildNews objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildResource is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildNews[] List of ChildNews objects
     * @throws PropelException
     */
    public function getNewsRelatedByNewsFor(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collNewsRelatedByNewsForPartial && !$this->isNew();
        if (null === $this->collNewsRelatedByNewsFor || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNewsRelatedByNewsFor) {
                // return empty collection
                $this->initNewsRelatedByNewsFor();
            } else {
                $collNewsRelatedByNewsFor = ChildNewsQuery::create(null, $criteria)
                    ->filterByResourceRelatedByNewsFor($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNewsRelatedByNewsForPartial && count($collNewsRelatedByNewsFor)) {
                        $this->initNewsRelatedByNewsFor(false);

                        foreach ($collNewsRelatedByNewsFor as $obj) {
                            if (false == $this->collNewsRelatedByNewsFor->contains($obj)) {
                                $this->collNewsRelatedByNewsFor->append($obj);
                            }
                        }

                        $this->collNewsRelatedByNewsForPartial = true;
                    }

                    return $collNewsRelatedByNewsFor;
                }

                if ($partial && $this->collNewsRelatedByNewsFor) {
                    foreach ($this->collNewsRelatedByNewsFor as $obj) {
                        if ($obj->isNew()) {
                            $collNewsRelatedByNewsFor[] = $obj;
                        }
                    }
                }

                $this->collNewsRelatedByNewsFor = $collNewsRelatedByNewsFor;
                $this->collNewsRelatedByNewsForPartial = false;
            }
        }

        return $this->collNewsRelatedByNewsFor;
    }

    /**
     * Sets a collection of ChildNews objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $newsRelatedByNewsFor A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setNewsRelatedByNewsFor(Collection $newsRelatedByNewsFor, ConnectionInterface $con = null)
    {
        /** @var ChildNews[] $newsRelatedByNewsForToDelete */
        $newsRelatedByNewsForToDelete = $this->getNewsRelatedByNewsFor(new Criteria(), $con)->diff($newsRelatedByNewsFor);


        $this->newsRelatedByNewsForScheduledForDeletion = $newsRelatedByNewsForToDelete;

        foreach ($newsRelatedByNewsForToDelete as $newsRelatedByNewsForRemoved) {
            $newsRelatedByNewsForRemoved->setResourceRelatedByNewsFor(null);
        }

        $this->collNewsRelatedByNewsFor = null;
        foreach ($newsRelatedByNewsFor as $newsRelatedByNewsFor) {
            $this->addNewsRelatedByNewsFor($newsRelatedByNewsFor);
        }

        $this->collNewsRelatedByNewsFor = $newsRelatedByNewsFor;
        $this->collNewsRelatedByNewsForPartial = false;

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
    public function countNewsRelatedByNewsFor(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collNewsRelatedByNewsForPartial && !$this->isNew();
        if (null === $this->collNewsRelatedByNewsFor || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNewsRelatedByNewsFor) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNewsRelatedByNewsFor());
            }

            $query = ChildNewsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResourceRelatedByNewsFor($this)
                ->count($con);
        }

        return count($this->collNewsRelatedByNewsFor);
    }

    /**
     * Method called to associate a ChildNews object to this object
     * through the ChildNews foreign key attribute.
     *
     * @param  ChildNews $l ChildNews
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function addNewsRelatedByNewsFor(ChildNews $l)
    {
        if ($this->collNewsRelatedByNewsFor === null) {
            $this->initNewsRelatedByNewsFor();
            $this->collNewsRelatedByNewsForPartial = true;
        }

        if (!$this->collNewsRelatedByNewsFor->contains($l)) {
            $this->doAddNewsRelatedByNewsFor($l);

            if ($this->newsRelatedByNewsForScheduledForDeletion and $this->newsRelatedByNewsForScheduledForDeletion->contains($l)) {
                $this->newsRelatedByNewsForScheduledForDeletion->remove($this->newsRelatedByNewsForScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildNews $newsRelatedByNewsFor The ChildNews object to add.
     */
    protected function doAddNewsRelatedByNewsFor(ChildNews $newsRelatedByNewsFor)
    {
        $this->collNewsRelatedByNewsFor[]= $newsRelatedByNewsFor;
        $newsRelatedByNewsFor->setResourceRelatedByNewsFor($this);
    }

    /**
     * @param  ChildNews $newsRelatedByNewsFor The ChildNews object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function removeNewsRelatedByNewsFor(ChildNews $newsRelatedByNewsFor)
    {
        if ($this->getNewsRelatedByNewsFor()->contains($newsRelatedByNewsFor)) {
            $pos = $this->collNewsRelatedByNewsFor->search($newsRelatedByNewsFor);
            $this->collNewsRelatedByNewsFor->remove($pos);
            if (null === $this->newsRelatedByNewsForScheduledForDeletion) {
                $this->newsRelatedByNewsForScheduledForDeletion = clone $this->collNewsRelatedByNewsFor;
                $this->newsRelatedByNewsForScheduledForDeletion->clear();
            }
            $this->newsRelatedByNewsForScheduledForDeletion[]= $newsRelatedByNewsFor;
            $newsRelatedByNewsFor->setResourceRelatedByNewsFor(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related NewsRelatedByNewsFor from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildNews[] List of ChildNews objects
     */
    public function getNewsRelatedByNewsForJoinFile(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildNewsQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getNewsRelatedByNewsFor($query, $con);
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
     * If this ChildResource is new, it will return
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
                    ->filterByResource($this)
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
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setPeriodicPlans(Collection $periodicPlans, ConnectionInterface $con = null)
    {
        /** @var ChildPeriodicPlan[] $periodicPlansToDelete */
        $periodicPlansToDelete = $this->getPeriodicPlans(new Criteria(), $con)->diff($periodicPlans);


        $this->periodicPlansScheduledForDeletion = $periodicPlansToDelete;

        foreach ($periodicPlansToDelete as $periodicPlanRemoved) {
            $periodicPlanRemoved->setResource(null);
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
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collPeriodicPlans);
    }

    /**
     * Method called to associate a ChildPeriodicPlan object to this object
     * through the ChildPeriodicPlan foreign key attribute.
     *
     * @param  ChildPeriodicPlan $l ChildPeriodicPlan
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
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
        $periodicPlan->setResource($this);
    }

    /**
     * @param  ChildPeriodicPlan $periodicPlan The ChildPeriodicPlan object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
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
            $periodicPlan->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related PeriodicPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related PeriodicPlans from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPeriodicPlan[] List of ChildPeriodicPlan objects
     */
    public function getPeriodicPlansJoinFile(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPeriodicPlanQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

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
     * If this ChildResource is new, it will return
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
                    ->filterByResource($this)
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
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setProducts(Collection $products, ConnectionInterface $con = null)
    {
        /** @var ChildProduct[] $productsToDelete */
        $productsToDelete = $this->getProducts(new Criteria(), $con)->diff($products);


        $this->productsScheduledForDeletion = $productsToDelete;

        foreach ($productsToDelete as $productRemoved) {
            $productRemoved->setResource(null);
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
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collProducts);
    }

    /**
     * Method called to associate a ChildProduct object to this object
     * through the ChildProduct foreign key attribute.
     *
     * @param  ChildProduct $l ChildProduct
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
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
        $product->setResource($this);
    }

    /**
     * @param  ChildProduct $product The ChildProduct object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
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
            $this->productsScheduledForDeletion[]= clone $product;
            $product->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related Products from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
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
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related Products from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
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
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related Products from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
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
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related Products from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProduct[] List of ChildProduct objects
     */
    public function getProductsJoinFile(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getProducts($query, $con);
    }

    /**
     * Clears out the collProductHighlighteds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductHighlighteds()
     */
    public function clearProductHighlighteds()
    {
        $this->collProductHighlighteds = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductHighlighteds collection loaded partially.
     */
    public function resetPartialProductHighlighteds($v = true)
    {
        $this->collProductHighlightedsPartial = $v;
    }

    /**
     * Initializes the collProductHighlighteds collection.
     *
     * By default this just sets the collProductHighlighteds collection to an empty array (like clearcollProductHighlighteds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductHighlighteds($overrideExisting = true)
    {
        if (null !== $this->collProductHighlighteds && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductHighlightedTableMap::getTableMap()->getCollectionClassName();

        $this->collProductHighlighteds = new $collectionClassName;
        $this->collProductHighlighteds->setModel('\App\Propel\ProductHighlighted');
    }

    /**
     * Gets an array of ChildProductHighlighted objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildResource is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductHighlighted[] List of ChildProductHighlighted objects
     * @throws PropelException
     */
    public function getProductHighlighteds(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductHighlightedsPartial && !$this->isNew();
        if (null === $this->collProductHighlighteds || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductHighlighteds) {
                // return empty collection
                $this->initProductHighlighteds();
            } else {
                $collProductHighlighteds = ChildProductHighlightedQuery::create(null, $criteria)
                    ->filterByResource($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductHighlightedsPartial && count($collProductHighlighteds)) {
                        $this->initProductHighlighteds(false);

                        foreach ($collProductHighlighteds as $obj) {
                            if (false == $this->collProductHighlighteds->contains($obj)) {
                                $this->collProductHighlighteds->append($obj);
                            }
                        }

                        $this->collProductHighlightedsPartial = true;
                    }

                    return $collProductHighlighteds;
                }

                if ($partial && $this->collProductHighlighteds) {
                    foreach ($this->collProductHighlighteds as $obj) {
                        if ($obj->isNew()) {
                            $collProductHighlighteds[] = $obj;
                        }
                    }
                }

                $this->collProductHighlighteds = $collProductHighlighteds;
                $this->collProductHighlightedsPartial = false;
            }
        }

        return $this->collProductHighlighteds;
    }

    /**
     * Sets a collection of ChildProductHighlighted objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productHighlighteds A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setProductHighlighteds(Collection $productHighlighteds, ConnectionInterface $con = null)
    {
        /** @var ChildProductHighlighted[] $productHighlightedsToDelete */
        $productHighlightedsToDelete = $this->getProductHighlighteds(new Criteria(), $con)->diff($productHighlighteds);


        $this->productHighlightedsScheduledForDeletion = $productHighlightedsToDelete;

        foreach ($productHighlightedsToDelete as $productHighlightedRemoved) {
            $productHighlightedRemoved->setResource(null);
        }

        $this->collProductHighlighteds = null;
        foreach ($productHighlighteds as $productHighlighted) {
            $this->addProductHighlighted($productHighlighted);
        }

        $this->collProductHighlighteds = $productHighlighteds;
        $this->collProductHighlightedsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductHighlighted objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductHighlighted objects.
     * @throws PropelException
     */
    public function countProductHighlighteds(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductHighlightedsPartial && !$this->isNew();
        if (null === $this->collProductHighlighteds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductHighlighteds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductHighlighteds());
            }

            $query = ChildProductHighlightedQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collProductHighlighteds);
    }

    /**
     * Method called to associate a ChildProductHighlighted object to this object
     * through the ChildProductHighlighted foreign key attribute.
     *
     * @param  ChildProductHighlighted $l ChildProductHighlighted
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function addProductHighlighted(ChildProductHighlighted $l)
    {
        if ($this->collProductHighlighteds === null) {
            $this->initProductHighlighteds();
            $this->collProductHighlightedsPartial = true;
        }

        if (!$this->collProductHighlighteds->contains($l)) {
            $this->doAddProductHighlighted($l);

            if ($this->productHighlightedsScheduledForDeletion and $this->productHighlightedsScheduledForDeletion->contains($l)) {
                $this->productHighlightedsScheduledForDeletion->remove($this->productHighlightedsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductHighlighted $productHighlighted The ChildProductHighlighted object to add.
     */
    protected function doAddProductHighlighted(ChildProductHighlighted $productHighlighted)
    {
        $this->collProductHighlighteds[]= $productHighlighted;
        $productHighlighted->setResource($this);
    }

    /**
     * @param  ChildProductHighlighted $productHighlighted The ChildProductHighlighted object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function removeProductHighlighted(ChildProductHighlighted $productHighlighted)
    {
        if ($this->getProductHighlighteds()->contains($productHighlighted)) {
            $pos = $this->collProductHighlighteds->search($productHighlighted);
            $this->collProductHighlighteds->remove($pos);
            if (null === $this->productHighlightedsScheduledForDeletion) {
                $this->productHighlightedsScheduledForDeletion = clone $this->collProductHighlighteds;
                $this->productHighlightedsScheduledForDeletion->clear();
            }
            $this->productHighlightedsScheduledForDeletion[]= $productHighlighted;
            $productHighlighted->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related ProductHighlighteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductHighlighted[] List of ChildProductHighlighted objects
     */
    public function getProductHighlightedsJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductHighlightedQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getProductHighlighteds($query, $con);
    }

    /**
     * Clears out the collPromotions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPromotions()
     */
    public function clearPromotions()
    {
        $this->collPromotions = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPromotions collection loaded partially.
     */
    public function resetPartialPromotions($v = true)
    {
        $this->collPromotionsPartial = $v;
    }

    /**
     * Initializes the collPromotions collection.
     *
     * By default this just sets the collPromotions collection to an empty array (like clearcollPromotions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPromotions($overrideExisting = true)
    {
        if (null !== $this->collPromotions && !$overrideExisting) {
            return;
        }

        $collectionClassName = PromotionTableMap::getTableMap()->getCollectionClassName();

        $this->collPromotions = new $collectionClassName;
        $this->collPromotions->setModel('\App\Propel\Promotion');
    }

    /**
     * Gets an array of ChildPromotion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildResource is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPromotion[] List of ChildPromotion objects
     * @throws PropelException
     */
    public function getPromotions(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPromotionsPartial && !$this->isNew();
        if (null === $this->collPromotions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPromotions) {
                // return empty collection
                $this->initPromotions();
            } else {
                $collPromotions = ChildPromotionQuery::create(null, $criteria)
                    ->filterByResource($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPromotionsPartial && count($collPromotions)) {
                        $this->initPromotions(false);

                        foreach ($collPromotions as $obj) {
                            if (false == $this->collPromotions->contains($obj)) {
                                $this->collPromotions->append($obj);
                            }
                        }

                        $this->collPromotionsPartial = true;
                    }

                    return $collPromotions;
                }

                if ($partial && $this->collPromotions) {
                    foreach ($this->collPromotions as $obj) {
                        if ($obj->isNew()) {
                            $collPromotions[] = $obj;
                        }
                    }
                }

                $this->collPromotions = $collPromotions;
                $this->collPromotionsPartial = false;
            }
        }

        return $this->collPromotions;
    }

    /**
     * Sets a collection of ChildPromotion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $promotions A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setPromotions(Collection $promotions, ConnectionInterface $con = null)
    {
        /** @var ChildPromotion[] $promotionsToDelete */
        $promotionsToDelete = $this->getPromotions(new Criteria(), $con)->diff($promotions);


        $this->promotionsScheduledForDeletion = $promotionsToDelete;

        foreach ($promotionsToDelete as $promotionRemoved) {
            $promotionRemoved->setResource(null);
        }

        $this->collPromotions = null;
        foreach ($promotions as $promotion) {
            $this->addPromotion($promotion);
        }

        $this->collPromotions = $promotions;
        $this->collPromotionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Promotion objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Promotion objects.
     * @throws PropelException
     */
    public function countPromotions(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPromotionsPartial && !$this->isNew();
        if (null === $this->collPromotions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPromotions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPromotions());
            }

            $query = ChildPromotionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collPromotions);
    }

    /**
     * Method called to associate a ChildPromotion object to this object
     * through the ChildPromotion foreign key attribute.
     *
     * @param  ChildPromotion $l ChildPromotion
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function addPromotion(ChildPromotion $l)
    {
        if ($this->collPromotions === null) {
            $this->initPromotions();
            $this->collPromotionsPartial = true;
        }

        if (!$this->collPromotions->contains($l)) {
            $this->doAddPromotion($l);

            if ($this->promotionsScheduledForDeletion and $this->promotionsScheduledForDeletion->contains($l)) {
                $this->promotionsScheduledForDeletion->remove($this->promotionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPromotion $promotion The ChildPromotion object to add.
     */
    protected function doAddPromotion(ChildPromotion $promotion)
    {
        $this->collPromotions[]= $promotion;
        $promotion->setResource($this);
    }

    /**
     * @param  ChildPromotion $promotion The ChildPromotion object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function removePromotion(ChildPromotion $promotion)
    {
        if ($this->getPromotions()->contains($promotion)) {
            $pos = $this->collPromotions->search($promotion);
            $this->collPromotions->remove($pos);
            if (null === $this->promotionsScheduledForDeletion) {
                $this->promotionsScheduledForDeletion = clone $this->collPromotions;
                $this->promotionsScheduledForDeletion->clear();
            }
            $this->promotionsScheduledForDeletion[]= clone $promotion;
            $promotion->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related Promotions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPromotion[] List of ChildPromotion objects
     */
    public function getPromotionsJoinPromotionType(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPromotionQuery::create(null, $criteria);
        $query->joinWith('PromotionType', $joinBehavior);

        return $this->getPromotions($query, $con);
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
     * If this ChildResource is new, it will return
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
                    ->filterByResource($this)
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
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setProviders(Collection $providers, ConnectionInterface $con = null)
    {
        /** @var ChildProvider[] $providersToDelete */
        $providersToDelete = $this->getProviders(new Criteria(), $con)->diff($providers);


        $this->providersScheduledForDeletion = $providersToDelete;

        foreach ($providersToDelete as $providerRemoved) {
            $providerRemoved->setResource(null);
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
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collProviders);
    }

    /**
     * Method called to associate a ChildProvider object to this object
     * through the ChildProvider foreign key attribute.
     *
     * @param  ChildProvider $l ChildProvider
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
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
        $provider->setResource($this);
    }

    /**
     * @param  ChildProvider $provider The ChildProvider object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
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
            $this->providersScheduledForDeletion[]= clone $provider;
            $provider->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related Providers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProvider[] List of ChildProvider objects
     */
    public function getProvidersJoinFile(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProviderQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

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
     * If this ChildResource is new, it will return
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
                    ->filterByResource($this)
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
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setResourceFiles(Collection $resourceFiles, ConnectionInterface $con = null)
    {
        /** @var ChildResourceFile[] $resourceFilesToDelete */
        $resourceFilesToDelete = $this->getResourceFiles(new Criteria(), $con)->diff($resourceFiles);


        $this->resourceFilesScheduledForDeletion = $resourceFilesToDelete;

        foreach ($resourceFilesToDelete as $resourceFileRemoved) {
            $resourceFileRemoved->setResource(null);
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
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collResourceFiles);
    }

    /**
     * Method called to associate a ChildResourceFile object to this object
     * through the ChildResourceFile foreign key attribute.
     *
     * @param  ChildResourceFile $l ChildResourceFile
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
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
        $resourceFile->setResource($this);
    }

    /**
     * @param  ChildResourceFile $resourceFile The ChildResourceFile object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
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
            $resourceFile->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related ResourceFiles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildResourceFile[] List of ChildResourceFile objects
     */
    public function getResourceFilesJoinFile(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildResourceFileQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getResourceFiles($query, $con);
    }

    /**
     * Clears out the collSocialViews collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSocialViews()
     */
    public function clearSocialViews()
    {
        $this->collSocialViews = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSocialViews collection loaded partially.
     */
    public function resetPartialSocialViews($v = true)
    {
        $this->collSocialViewsPartial = $v;
    }

    /**
     * Initializes the collSocialViews collection.
     *
     * By default this just sets the collSocialViews collection to an empty array (like clearcollSocialViews());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSocialViews($overrideExisting = true)
    {
        if (null !== $this->collSocialViews && !$overrideExisting) {
            return;
        }

        $collectionClassName = SocialViewTableMap::getTableMap()->getCollectionClassName();

        $this->collSocialViews = new $collectionClassName;
        $this->collSocialViews->setModel('\App\Propel\SocialView');
    }

    /**
     * Gets an array of ChildSocialView objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildResource is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSocialView[] List of ChildSocialView objects
     * @throws PropelException
     */
    public function getSocialViews(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSocialViewsPartial && !$this->isNew();
        if (null === $this->collSocialViews || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSocialViews) {
                // return empty collection
                $this->initSocialViews();
            } else {
                $collSocialViews = ChildSocialViewQuery::create(null, $criteria)
                    ->filterByResource($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSocialViewsPartial && count($collSocialViews)) {
                        $this->initSocialViews(false);

                        foreach ($collSocialViews as $obj) {
                            if (false == $this->collSocialViews->contains($obj)) {
                                $this->collSocialViews->append($obj);
                            }
                        }

                        $this->collSocialViewsPartial = true;
                    }

                    return $collSocialViews;
                }

                if ($partial && $this->collSocialViews) {
                    foreach ($this->collSocialViews as $obj) {
                        if ($obj->isNew()) {
                            $collSocialViews[] = $obj;
                        }
                    }
                }

                $this->collSocialViews = $collSocialViews;
                $this->collSocialViewsPartial = false;
            }
        }

        return $this->collSocialViews;
    }

    /**
     * Sets a collection of ChildSocialView objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $socialViews A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setSocialViews(Collection $socialViews, ConnectionInterface $con = null)
    {
        /** @var ChildSocialView[] $socialViewsToDelete */
        $socialViewsToDelete = $this->getSocialViews(new Criteria(), $con)->diff($socialViews);


        $this->socialViewsScheduledForDeletion = $socialViewsToDelete;

        foreach ($socialViewsToDelete as $socialViewRemoved) {
            $socialViewRemoved->setResource(null);
        }

        $this->collSocialViews = null;
        foreach ($socialViews as $socialView) {
            $this->addSocialView($socialView);
        }

        $this->collSocialViews = $socialViews;
        $this->collSocialViewsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SocialView objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SocialView objects.
     * @throws PropelException
     */
    public function countSocialViews(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSocialViewsPartial && !$this->isNew();
        if (null === $this->collSocialViews || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSocialViews) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSocialViews());
            }

            $query = ChildSocialViewQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collSocialViews);
    }

    /**
     * Method called to associate a ChildSocialView object to this object
     * through the ChildSocialView foreign key attribute.
     *
     * @param  ChildSocialView $l ChildSocialView
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function addSocialView(ChildSocialView $l)
    {
        if ($this->collSocialViews === null) {
            $this->initSocialViews();
            $this->collSocialViewsPartial = true;
        }

        if (!$this->collSocialViews->contains($l)) {
            $this->doAddSocialView($l);

            if ($this->socialViewsScheduledForDeletion and $this->socialViewsScheduledForDeletion->contains($l)) {
                $this->socialViewsScheduledForDeletion->remove($this->socialViewsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSocialView $socialView The ChildSocialView object to add.
     */
    protected function doAddSocialView(ChildSocialView $socialView)
    {
        $this->collSocialViews[]= $socialView;
        $socialView->setResource($this);
    }

    /**
     * @param  ChildSocialView $socialView The ChildSocialView object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function removeSocialView(ChildSocialView $socialView)
    {
        if ($this->getSocialViews()->contains($socialView)) {
            $pos = $this->collSocialViews->search($socialView);
            $this->collSocialViews->remove($pos);
            if (null === $this->socialViewsScheduledForDeletion) {
                $this->socialViewsScheduledForDeletion = clone $this->collSocialViews;
                $this->socialViewsScheduledForDeletion->clear();
            }
            $this->socialViewsScheduledForDeletion[]= clone $socialView;
            $socialView->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related SocialViews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSocialView[] List of ChildSocialView objects
     */
    public function getSocialViewsJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSocialViewQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getSocialViews($query, $con);
    }

    /**
     * Clears out the collSocialLikes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSocialLikes()
     */
    public function clearSocialLikes()
    {
        $this->collSocialLikes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSocialLikes collection loaded partially.
     */
    public function resetPartialSocialLikes($v = true)
    {
        $this->collSocialLikesPartial = $v;
    }

    /**
     * Initializes the collSocialLikes collection.
     *
     * By default this just sets the collSocialLikes collection to an empty array (like clearcollSocialLikes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSocialLikes($overrideExisting = true)
    {
        if (null !== $this->collSocialLikes && !$overrideExisting) {
            return;
        }

        $collectionClassName = SocialLikeTableMap::getTableMap()->getCollectionClassName();

        $this->collSocialLikes = new $collectionClassName;
        $this->collSocialLikes->setModel('\App\Propel\SocialLike');
    }

    /**
     * Gets an array of ChildSocialLike objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildResource is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSocialLike[] List of ChildSocialLike objects
     * @throws PropelException
     */
    public function getSocialLikes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSocialLikesPartial && !$this->isNew();
        if (null === $this->collSocialLikes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSocialLikes) {
                // return empty collection
                $this->initSocialLikes();
            } else {
                $collSocialLikes = ChildSocialLikeQuery::create(null, $criteria)
                    ->filterByResource($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSocialLikesPartial && count($collSocialLikes)) {
                        $this->initSocialLikes(false);

                        foreach ($collSocialLikes as $obj) {
                            if (false == $this->collSocialLikes->contains($obj)) {
                                $this->collSocialLikes->append($obj);
                            }
                        }

                        $this->collSocialLikesPartial = true;
                    }

                    return $collSocialLikes;
                }

                if ($partial && $this->collSocialLikes) {
                    foreach ($this->collSocialLikes as $obj) {
                        if ($obj->isNew()) {
                            $collSocialLikes[] = $obj;
                        }
                    }
                }

                $this->collSocialLikes = $collSocialLikes;
                $this->collSocialLikesPartial = false;
            }
        }

        return $this->collSocialLikes;
    }

    /**
     * Sets a collection of ChildSocialLike objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $socialLikes A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setSocialLikes(Collection $socialLikes, ConnectionInterface $con = null)
    {
        /** @var ChildSocialLike[] $socialLikesToDelete */
        $socialLikesToDelete = $this->getSocialLikes(new Criteria(), $con)->diff($socialLikes);


        $this->socialLikesScheduledForDeletion = $socialLikesToDelete;

        foreach ($socialLikesToDelete as $socialLikeRemoved) {
            $socialLikeRemoved->setResource(null);
        }

        $this->collSocialLikes = null;
        foreach ($socialLikes as $socialLike) {
            $this->addSocialLike($socialLike);
        }

        $this->collSocialLikes = $socialLikes;
        $this->collSocialLikesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SocialLike objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SocialLike objects.
     * @throws PropelException
     */
    public function countSocialLikes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSocialLikesPartial && !$this->isNew();
        if (null === $this->collSocialLikes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSocialLikes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSocialLikes());
            }

            $query = ChildSocialLikeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collSocialLikes);
    }

    /**
     * Method called to associate a ChildSocialLike object to this object
     * through the ChildSocialLike foreign key attribute.
     *
     * @param  ChildSocialLike $l ChildSocialLike
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function addSocialLike(ChildSocialLike $l)
    {
        if ($this->collSocialLikes === null) {
            $this->initSocialLikes();
            $this->collSocialLikesPartial = true;
        }

        if (!$this->collSocialLikes->contains($l)) {
            $this->doAddSocialLike($l);

            if ($this->socialLikesScheduledForDeletion and $this->socialLikesScheduledForDeletion->contains($l)) {
                $this->socialLikesScheduledForDeletion->remove($this->socialLikesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSocialLike $socialLike The ChildSocialLike object to add.
     */
    protected function doAddSocialLike(ChildSocialLike $socialLike)
    {
        $this->collSocialLikes[]= $socialLike;
        $socialLike->setResource($this);
    }

    /**
     * @param  ChildSocialLike $socialLike The ChildSocialLike object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function removeSocialLike(ChildSocialLike $socialLike)
    {
        if ($this->getSocialLikes()->contains($socialLike)) {
            $pos = $this->collSocialLikes->search($socialLike);
            $this->collSocialLikes->remove($pos);
            if (null === $this->socialLikesScheduledForDeletion) {
                $this->socialLikesScheduledForDeletion = clone $this->collSocialLikes;
                $this->socialLikesScheduledForDeletion->clear();
            }
            $this->socialLikesScheduledForDeletion[]= clone $socialLike;
            $socialLike->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related SocialLikes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSocialLike[] List of ChildSocialLike objects
     */
    public function getSocialLikesJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSocialLikeQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getSocialLikes($query, $con);
    }

    /**
     * Clears out the collSocialComments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSocialComments()
     */
    public function clearSocialComments()
    {
        $this->collSocialComments = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSocialComments collection loaded partially.
     */
    public function resetPartialSocialComments($v = true)
    {
        $this->collSocialCommentsPartial = $v;
    }

    /**
     * Initializes the collSocialComments collection.
     *
     * By default this just sets the collSocialComments collection to an empty array (like clearcollSocialComments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSocialComments($overrideExisting = true)
    {
        if (null !== $this->collSocialComments && !$overrideExisting) {
            return;
        }

        $collectionClassName = SocialCommentTableMap::getTableMap()->getCollectionClassName();

        $this->collSocialComments = new $collectionClassName;
        $this->collSocialComments->setModel('\App\Propel\SocialComment');
    }

    /**
     * Gets an array of ChildSocialComment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildResource is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSocialComment[] List of ChildSocialComment objects
     * @throws PropelException
     */
    public function getSocialComments(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSocialCommentsPartial && !$this->isNew();
        if (null === $this->collSocialComments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSocialComments) {
                // return empty collection
                $this->initSocialComments();
            } else {
                $collSocialComments = ChildSocialCommentQuery::create(null, $criteria)
                    ->filterByResource($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSocialCommentsPartial && count($collSocialComments)) {
                        $this->initSocialComments(false);

                        foreach ($collSocialComments as $obj) {
                            if (false == $this->collSocialComments->contains($obj)) {
                                $this->collSocialComments->append($obj);
                            }
                        }

                        $this->collSocialCommentsPartial = true;
                    }

                    return $collSocialComments;
                }

                if ($partial && $this->collSocialComments) {
                    foreach ($this->collSocialComments as $obj) {
                        if ($obj->isNew()) {
                            $collSocialComments[] = $obj;
                        }
                    }
                }

                $this->collSocialComments = $collSocialComments;
                $this->collSocialCommentsPartial = false;
            }
        }

        return $this->collSocialComments;
    }

    /**
     * Sets a collection of ChildSocialComment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $socialComments A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setSocialComments(Collection $socialComments, ConnectionInterface $con = null)
    {
        /** @var ChildSocialComment[] $socialCommentsToDelete */
        $socialCommentsToDelete = $this->getSocialComments(new Criteria(), $con)->diff($socialComments);


        $this->socialCommentsScheduledForDeletion = $socialCommentsToDelete;

        foreach ($socialCommentsToDelete as $socialCommentRemoved) {
            $socialCommentRemoved->setResource(null);
        }

        $this->collSocialComments = null;
        foreach ($socialComments as $socialComment) {
            $this->addSocialComment($socialComment);
        }

        $this->collSocialComments = $socialComments;
        $this->collSocialCommentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SocialComment objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SocialComment objects.
     * @throws PropelException
     */
    public function countSocialComments(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSocialCommentsPartial && !$this->isNew();
        if (null === $this->collSocialComments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSocialComments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSocialComments());
            }

            $query = ChildSocialCommentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collSocialComments);
    }

    /**
     * Method called to associate a ChildSocialComment object to this object
     * through the ChildSocialComment foreign key attribute.
     *
     * @param  ChildSocialComment $l ChildSocialComment
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function addSocialComment(ChildSocialComment $l)
    {
        if ($this->collSocialComments === null) {
            $this->initSocialComments();
            $this->collSocialCommentsPartial = true;
        }

        if (!$this->collSocialComments->contains($l)) {
            $this->doAddSocialComment($l);

            if ($this->socialCommentsScheduledForDeletion and $this->socialCommentsScheduledForDeletion->contains($l)) {
                $this->socialCommentsScheduledForDeletion->remove($this->socialCommentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSocialComment $socialComment The ChildSocialComment object to add.
     */
    protected function doAddSocialComment(ChildSocialComment $socialComment)
    {
        $this->collSocialComments[]= $socialComment;
        $socialComment->setResource($this);
    }

    /**
     * @param  ChildSocialComment $socialComment The ChildSocialComment object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function removeSocialComment(ChildSocialComment $socialComment)
    {
        if ($this->getSocialComments()->contains($socialComment)) {
            $pos = $this->collSocialComments->search($socialComment);
            $this->collSocialComments->remove($pos);
            if (null === $this->socialCommentsScheduledForDeletion) {
                $this->socialCommentsScheduledForDeletion = clone $this->collSocialComments;
                $this->socialCommentsScheduledForDeletion->clear();
            }
            $this->socialCommentsScheduledForDeletion[]= clone $socialComment;
            $socialComment->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related SocialComments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSocialComment[] List of ChildSocialComment objects
     */
    public function getSocialCommentsJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSocialCommentQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getSocialComments($query, $con);
    }

    /**
     * Clears out the collSocialRecommendations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSocialRecommendations()
     */
    public function clearSocialRecommendations()
    {
        $this->collSocialRecommendations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSocialRecommendations collection loaded partially.
     */
    public function resetPartialSocialRecommendations($v = true)
    {
        $this->collSocialRecommendationsPartial = $v;
    }

    /**
     * Initializes the collSocialRecommendations collection.
     *
     * By default this just sets the collSocialRecommendations collection to an empty array (like clearcollSocialRecommendations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSocialRecommendations($overrideExisting = true)
    {
        if (null !== $this->collSocialRecommendations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SocialRecommendationTableMap::getTableMap()->getCollectionClassName();

        $this->collSocialRecommendations = new $collectionClassName;
        $this->collSocialRecommendations->setModel('\App\Propel\SocialRecommendation');
    }

    /**
     * Gets an array of ChildSocialRecommendation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildResource is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSocialRecommendation[] List of ChildSocialRecommendation objects
     * @throws PropelException
     */
    public function getSocialRecommendations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSocialRecommendationsPartial && !$this->isNew();
        if (null === $this->collSocialRecommendations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSocialRecommendations) {
                // return empty collection
                $this->initSocialRecommendations();
            } else {
                $collSocialRecommendations = ChildSocialRecommendationQuery::create(null, $criteria)
                    ->filterByResource($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSocialRecommendationsPartial && count($collSocialRecommendations)) {
                        $this->initSocialRecommendations(false);

                        foreach ($collSocialRecommendations as $obj) {
                            if (false == $this->collSocialRecommendations->contains($obj)) {
                                $this->collSocialRecommendations->append($obj);
                            }
                        }

                        $this->collSocialRecommendationsPartial = true;
                    }

                    return $collSocialRecommendations;
                }

                if ($partial && $this->collSocialRecommendations) {
                    foreach ($this->collSocialRecommendations as $obj) {
                        if ($obj->isNew()) {
                            $collSocialRecommendations[] = $obj;
                        }
                    }
                }

                $this->collSocialRecommendations = $collSocialRecommendations;
                $this->collSocialRecommendationsPartial = false;
            }
        }

        return $this->collSocialRecommendations;
    }

    /**
     * Sets a collection of ChildSocialRecommendation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $socialRecommendations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setSocialRecommendations(Collection $socialRecommendations, ConnectionInterface $con = null)
    {
        /** @var ChildSocialRecommendation[] $socialRecommendationsToDelete */
        $socialRecommendationsToDelete = $this->getSocialRecommendations(new Criteria(), $con)->diff($socialRecommendations);


        $this->socialRecommendationsScheduledForDeletion = $socialRecommendationsToDelete;

        foreach ($socialRecommendationsToDelete as $socialRecommendationRemoved) {
            $socialRecommendationRemoved->setResource(null);
        }

        $this->collSocialRecommendations = null;
        foreach ($socialRecommendations as $socialRecommendation) {
            $this->addSocialRecommendation($socialRecommendation);
        }

        $this->collSocialRecommendations = $socialRecommendations;
        $this->collSocialRecommendationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SocialRecommendation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SocialRecommendation objects.
     * @throws PropelException
     */
    public function countSocialRecommendations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSocialRecommendationsPartial && !$this->isNew();
        if (null === $this->collSocialRecommendations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSocialRecommendations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSocialRecommendations());
            }

            $query = ChildSocialRecommendationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collSocialRecommendations);
    }

    /**
     * Method called to associate a ChildSocialRecommendation object to this object
     * through the ChildSocialRecommendation foreign key attribute.
     *
     * @param  ChildSocialRecommendation $l ChildSocialRecommendation
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
     */
    public function addSocialRecommendation(ChildSocialRecommendation $l)
    {
        if ($this->collSocialRecommendations === null) {
            $this->initSocialRecommendations();
            $this->collSocialRecommendationsPartial = true;
        }

        if (!$this->collSocialRecommendations->contains($l)) {
            $this->doAddSocialRecommendation($l);

            if ($this->socialRecommendationsScheduledForDeletion and $this->socialRecommendationsScheduledForDeletion->contains($l)) {
                $this->socialRecommendationsScheduledForDeletion->remove($this->socialRecommendationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSocialRecommendation $socialRecommendation The ChildSocialRecommendation object to add.
     */
    protected function doAddSocialRecommendation(ChildSocialRecommendation $socialRecommendation)
    {
        $this->collSocialRecommendations[]= $socialRecommendation;
        $socialRecommendation->setResource($this);
    }

    /**
     * @param  ChildSocialRecommendation $socialRecommendation The ChildSocialRecommendation object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function removeSocialRecommendation(ChildSocialRecommendation $socialRecommendation)
    {
        if ($this->getSocialRecommendations()->contains($socialRecommendation)) {
            $pos = $this->collSocialRecommendations->search($socialRecommendation);
            $this->collSocialRecommendations->remove($pos);
            if (null === $this->socialRecommendationsScheduledForDeletion) {
                $this->socialRecommendationsScheduledForDeletion = clone $this->collSocialRecommendations;
                $this->socialRecommendationsScheduledForDeletion->clear();
            }
            $this->socialRecommendationsScheduledForDeletion[]= clone $socialRecommendation;
            $socialRecommendation->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related SocialRecommendations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSocialRecommendation[] List of ChildSocialRecommendation objects
     */
    public function getSocialRecommendationsJoinUserRelatedByUserId(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSocialRecommendationQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByUserId', $joinBehavior);

        return $this->getSocialRecommendations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related SocialRecommendations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSocialRecommendation[] List of ChildSocialRecommendation objects
     */
    public function getSocialRecommendationsJoinUserRelatedBySocialRecommendationTo(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSocialRecommendationQuery::create(null, $criteria);
        $query->joinWith('UserRelatedBySocialRecommendationTo', $joinBehavior);

        return $this->getSocialRecommendations($query, $con);
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
     * If this ChildResource is new, it will return
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
                    ->filterByResource($this)
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
     * @return $this|ChildResource The current object (for fluent API support)
     */
    public function setUsers(Collection $users, ConnectionInterface $con = null)
    {
        /** @var ChildUser[] $usersToDelete */
        $usersToDelete = $this->getUsers(new Criteria(), $con)->diff($users);


        $this->usersScheduledForDeletion = $usersToDelete;

        foreach ($usersToDelete as $userRemoved) {
            $userRemoved->setResource(null);
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
                ->filterByResource($this)
                ->count($con);
        }

        return count($this->collUsers);
    }

    /**
     * Method called to associate a ChildUser object to this object
     * through the ChildUser foreign key attribute.
     *
     * @param  ChildUser $l ChildUser
     * @return $this|\App\Propel\Resource The current object (for fluent API support)
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
        $user->setResource($this);
    }

    /**
     * @param  ChildUser $user The ChildUser object to remove.
     * @return $this|ChildResource The current object (for fluent API support)
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
            $this->usersScheduledForDeletion[]= clone $user;
            $user->setResource(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related Users from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     */
    public function getUsersJoinFile(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserQuery::create(null, $criteria);
        $query->joinWith('File', $joinBehavior);

        return $this->getUsers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resource is new, it will return
     * an empty collection; or if this Resource has previously
     * been saved, it will retrieve related Users from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resource.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aResourceType) {
            $this->aResourceType->removeResource($this);
        }
        $this->resource_id = null;
        $this->resource_type_id = null;
        $this->social_views = null;
        $this->social_likes = null;
        $this->social_dislikes = null;
        $this->social_comments = null;
        $this->social_favourites = null;
        $this->social_recommendations = null;
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
            if ($this->collCategories) {
                foreach ($this->collCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNewsRelatedByResourceId) {
                foreach ($this->collNewsRelatedByResourceId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNewsRelatedByNewsFor) {
                foreach ($this->collNewsRelatedByNewsFor as $o) {
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
            if ($this->collProductHighlighteds) {
                foreach ($this->collProductHighlighteds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPromotions) {
                foreach ($this->collPromotions as $o) {
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
            if ($this->collSocialViews) {
                foreach ($this->collSocialViews as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSocialLikes) {
                foreach ($this->collSocialLikes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSocialComments) {
                foreach ($this->collSocialComments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSocialRecommendations) {
                foreach ($this->collSocialRecommendations as $o) {
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
        $this->collNewsRelatedByResourceId = null;
        $this->collNewsRelatedByNewsFor = null;
        $this->collPeriodicPlans = null;
        $this->collProducts = null;
        $this->collProductHighlighteds = null;
        $this->collPromotions = null;
        $this->collProviders = null;
        $this->collResourceFiles = null;
        $this->collSocialViews = null;
        $this->collSocialLikes = null;
        $this->collSocialComments = null;
        $this->collSocialRecommendations = null;
        $this->collUsers = null;
        $this->aResourceType = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ResourceTableMap::DEFAULT_STRING_FORMAT);
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
