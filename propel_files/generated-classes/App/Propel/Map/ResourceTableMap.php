<?php

namespace App\Propel\Map;

use App\Propel\Resource;
use App\Propel\ResourceQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'resource' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ResourceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'App.Propel.Map.ResourceTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'slowshop';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'resource';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Propel\\Resource';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'App.Propel.Resource';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the resource_id field
     */
    const COL_RESOURCE_ID = 'resource.resource_id';

    /**
     * the column name for the resource_type_id field
     */
    const COL_RESOURCE_TYPE_ID = 'resource.resource_type_id';

    /**
     * the column name for the social_views field
     */
    const COL_SOCIAL_VIEWS = 'resource.social_views';

    /**
     * the column name for the social_likes field
     */
    const COL_SOCIAL_LIKES = 'resource.social_likes';

    /**
     * the column name for the social_dislikes field
     */
    const COL_SOCIAL_DISLIKES = 'resource.social_dislikes';

    /**
     * the column name for the social_comments field
     */
    const COL_SOCIAL_COMMENTS = 'resource.social_comments';

    /**
     * the column name for the social_favourites field
     */
    const COL_SOCIAL_FAVOURITES = 'resource.social_favourites';

    /**
     * the column name for the social_recommendations field
     */
    const COL_SOCIAL_RECOMMENDATIONS = 'resource.social_recommendations';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('ResourceId', 'ResourceTypeId', 'SocialViews', 'SocialLikes', 'SocialDislikes', 'SocialComments', 'SocialFavourites', 'SocialRecommendations', ),
        self::TYPE_CAMELNAME     => array('resourceId', 'resourceTypeId', 'socialViews', 'socialLikes', 'socialDislikes', 'socialComments', 'socialFavourites', 'socialRecommendations', ),
        self::TYPE_COLNAME       => array(ResourceTableMap::COL_RESOURCE_ID, ResourceTableMap::COL_RESOURCE_TYPE_ID, ResourceTableMap::COL_SOCIAL_VIEWS, ResourceTableMap::COL_SOCIAL_LIKES, ResourceTableMap::COL_SOCIAL_DISLIKES, ResourceTableMap::COL_SOCIAL_COMMENTS, ResourceTableMap::COL_SOCIAL_FAVOURITES, ResourceTableMap::COL_SOCIAL_RECOMMENDATIONS, ),
        self::TYPE_FIELDNAME     => array('resource_id', 'resource_type_id', 'social_views', 'social_likes', 'social_dislikes', 'social_comments', 'social_favourites', 'social_recommendations', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ResourceId' => 0, 'ResourceTypeId' => 1, 'SocialViews' => 2, 'SocialLikes' => 3, 'SocialDislikes' => 4, 'SocialComments' => 5, 'SocialFavourites' => 6, 'SocialRecommendations' => 7, ),
        self::TYPE_CAMELNAME     => array('resourceId' => 0, 'resourceTypeId' => 1, 'socialViews' => 2, 'socialLikes' => 3, 'socialDislikes' => 4, 'socialComments' => 5, 'socialFavourites' => 6, 'socialRecommendations' => 7, ),
        self::TYPE_COLNAME       => array(ResourceTableMap::COL_RESOURCE_ID => 0, ResourceTableMap::COL_RESOURCE_TYPE_ID => 1, ResourceTableMap::COL_SOCIAL_VIEWS => 2, ResourceTableMap::COL_SOCIAL_LIKES => 3, ResourceTableMap::COL_SOCIAL_DISLIKES => 4, ResourceTableMap::COL_SOCIAL_COMMENTS => 5, ResourceTableMap::COL_SOCIAL_FAVOURITES => 6, ResourceTableMap::COL_SOCIAL_RECOMMENDATIONS => 7, ),
        self::TYPE_FIELDNAME     => array('resource_id' => 0, 'resource_type_id' => 1, 'social_views' => 2, 'social_likes' => 3, 'social_dislikes' => 4, 'social_comments' => 5, 'social_favourites' => 6, 'social_recommendations' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('resource');
        $this->setPhpName('Resource');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Propel\\Resource');
        $this->setPackage('App.Propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('resource_id', 'ResourceId', 'INTEGER', true, 10, null);
        $this->addForeignKey('resource_type_id', 'ResourceTypeId', 'INTEGER', 'resource_type', 'resource_type_id', true, 10, null);
        $this->addColumn('social_views', 'SocialViews', 'INTEGER', true, 10, 0);
        $this->addColumn('social_likes', 'SocialLikes', 'INTEGER', true, 10, 0);
        $this->addColumn('social_dislikes', 'SocialDislikes', 'INTEGER', true, 10, 0);
        $this->addColumn('social_comments', 'SocialComments', 'INTEGER', true, 10, 0);
        $this->addColumn('social_favourites', 'SocialFavourites', 'INTEGER', true, 10, 0);
        $this->addColumn('social_recommendations', 'SocialRecommendations', 'INTEGER', true, 10, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ResourceType', '\\App\\Propel\\ResourceType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':resource_type_id',
    1 => ':resource_type_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Category', '\\App\\Propel\\Category', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'Categories', false);
        $this->addRelation('NewsRelatedByResourceId', '\\App\\Propel\\News', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'NewsRelatedByResourceId', false);
        $this->addRelation('NewsRelatedByNewsFor', '\\App\\Propel\\News', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':news_for',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'NewsRelatedByNewsFor', false);
        $this->addRelation('PeriodicPlan', '\\App\\Propel\\PeriodicPlan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'PeriodicPlans', false);
        $this->addRelation('Product', '\\App\\Propel\\Product', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'Products', false);
        $this->addRelation('ProductHighlighted', '\\App\\Propel\\ProductHighlighted', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_highlighted_for',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'ProductHighlighteds', false);
        $this->addRelation('Promotion', '\\App\\Propel\\Promotion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'Promotions', false);
        $this->addRelation('Provider', '\\App\\Propel\\Provider', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'Providers', false);
        $this->addRelation('ResourceFile', '\\App\\Propel\\ResourceFile', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'ResourceFiles', false);
        $this->addRelation('SocialView', '\\App\\Propel\\SocialView', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':social_view_for',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'SocialViews', false);
        $this->addRelation('SocialLike', '\\App\\Propel\\SocialLike', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':social_like_for',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'SocialLikes', false);
        $this->addRelation('SocialComment', '\\App\\Propel\\SocialComment', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':social_comment_for',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'SocialComments', false);
        $this->addRelation('SocialRecommendation', '\\App\\Propel\\SocialRecommendation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':social_recommendation_for',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'SocialRecommendations', false);
        $this->addRelation('User', '\\App\\Propel\\User', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', 'Users', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('ResourceId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ResourceTableMap::CLASS_DEFAULT : ResourceTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Resource object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ResourceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ResourceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ResourceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ResourceTableMap::OM_CLASS;
            /** @var Resource $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ResourceTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ResourceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ResourceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Resource $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ResourceTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ResourceTableMap::COL_RESOURCE_ID);
            $criteria->addSelectColumn(ResourceTableMap::COL_RESOURCE_TYPE_ID);
            $criteria->addSelectColumn(ResourceTableMap::COL_SOCIAL_VIEWS);
            $criteria->addSelectColumn(ResourceTableMap::COL_SOCIAL_LIKES);
            $criteria->addSelectColumn(ResourceTableMap::COL_SOCIAL_DISLIKES);
            $criteria->addSelectColumn(ResourceTableMap::COL_SOCIAL_COMMENTS);
            $criteria->addSelectColumn(ResourceTableMap::COL_SOCIAL_FAVOURITES);
            $criteria->addSelectColumn(ResourceTableMap::COL_SOCIAL_RECOMMENDATIONS);
        } else {
            $criteria->addSelectColumn($alias . '.resource_id');
            $criteria->addSelectColumn($alias . '.resource_type_id');
            $criteria->addSelectColumn($alias . '.social_views');
            $criteria->addSelectColumn($alias . '.social_likes');
            $criteria->addSelectColumn($alias . '.social_dislikes');
            $criteria->addSelectColumn($alias . '.social_comments');
            $criteria->addSelectColumn($alias . '.social_favourites');
            $criteria->addSelectColumn($alias . '.social_recommendations');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ResourceTableMap::DATABASE_NAME)->getTable(ResourceTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ResourceTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ResourceTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ResourceTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Resource or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Resource object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Propel\Resource) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ResourceTableMap::DATABASE_NAME);
            $criteria->add(ResourceTableMap::COL_RESOURCE_ID, (array) $values, Criteria::IN);
        }

        $query = ResourceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ResourceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ResourceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the resource table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ResourceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Resource or Criteria object.
     *
     * @param mixed               $criteria Criteria or Resource object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Resource object
        }

        if ($criteria->containsKey(ResourceTableMap::COL_RESOURCE_ID) && $criteria->keyContainsValue(ResourceTableMap::COL_RESOURCE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ResourceTableMap::COL_RESOURCE_ID.')');
        }


        // Set the correct dbName
        $query = ResourceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ResourceTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ResourceTableMap::buildTableMap();
