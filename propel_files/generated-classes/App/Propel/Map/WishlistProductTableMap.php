<?php

namespace App\Propel\Map;

use App\Propel\WishlistProduct;
use App\Propel\WishlistProductQuery;
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
 * This class defines the structure of the 'wishlist_product' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WishlistProductTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'App.Propel.Map.WishlistProductTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'slowshop';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'wishlist_product';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Propel\\WishlistProduct';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'App.Propel.WishlistProduct';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the wishlist_product_id field
     */
    const COL_WISHLIST_PRODUCT_ID = 'wishlist_product.wishlist_product_id';

    /**
     * the column name for the wishlist_id field
     */
    const COL_WISHLIST_ID = 'wishlist_product.wishlist_id';

    /**
     * the column name for the product_id field
     */
    const COL_PRODUCT_ID = 'wishlist_product.product_id';

    /**
     * the column name for the wishlist_product_comment field
     */
    const COL_WISHLIST_PRODUCT_COMMENT = 'wishlist_product.wishlist_product_comment';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'wishlist_product.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'wishlist_product.updated_at';

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
        self::TYPE_PHPNAME       => array('WishlistProductId', 'WishlistId', 'ProductId', 'WishlistProductComment', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('wishlistProductId', 'wishlistId', 'productId', 'wishlistProductComment', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(WishlistProductTableMap::COL_WISHLIST_PRODUCT_ID, WishlistProductTableMap::COL_WISHLIST_ID, WishlistProductTableMap::COL_PRODUCT_ID, WishlistProductTableMap::COL_WISHLIST_PRODUCT_COMMENT, WishlistProductTableMap::COL_CREATED_AT, WishlistProductTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('wishlist_product_id', 'wishlist_id', 'product_id', 'wishlist_product_comment', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('WishlistProductId' => 0, 'WishlistId' => 1, 'ProductId' => 2, 'WishlistProductComment' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
        self::TYPE_CAMELNAME     => array('wishlistProductId' => 0, 'wishlistId' => 1, 'productId' => 2, 'wishlistProductComment' => 3, 'createdAt' => 4, 'updatedAt' => 5, ),
        self::TYPE_COLNAME       => array(WishlistProductTableMap::COL_WISHLIST_PRODUCT_ID => 0, WishlistProductTableMap::COL_WISHLIST_ID => 1, WishlistProductTableMap::COL_PRODUCT_ID => 2, WishlistProductTableMap::COL_WISHLIST_PRODUCT_COMMENT => 3, WishlistProductTableMap::COL_CREATED_AT => 4, WishlistProductTableMap::COL_UPDATED_AT => 5, ),
        self::TYPE_FIELDNAME     => array('wishlist_product_id' => 0, 'wishlist_id' => 1, 'product_id' => 2, 'wishlist_product_comment' => 3, 'created_at' => 4, 'updated_at' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('wishlist_product');
        $this->setPhpName('WishlistProduct');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Propel\\WishlistProduct');
        $this->setPackage('App.Propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('wishlist_product_id', 'WishlistProductId', 'INTEGER', true, 10, null);
        $this->addForeignKey('wishlist_id', 'WishlistId', 'INTEGER', 'wishlist', 'wishlist_id', true, 10, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'product', 'product_id', true, 10, null);
        $this->addColumn('wishlist_product_comment', 'WishlistProductComment', 'VARCHAR', false, 250, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Wishlist', '\\App\\Propel\\Wishlist', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':wishlist_id',
    1 => ':wishlist_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Product', '\\App\\Propel\\Product', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':product_id',
  ),
), null, 'CASCADE', null, false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WishlistProductId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WishlistProductId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WishlistProductId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WishlistProductId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WishlistProductId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WishlistProductId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('WishlistProductId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WishlistProductTableMap::CLASS_DEFAULT : WishlistProductTableMap::OM_CLASS;
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
     * @return array           (WishlistProduct object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WishlistProductTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WishlistProductTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WishlistProductTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WishlistProductTableMap::OM_CLASS;
            /** @var WishlistProduct $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WishlistProductTableMap::addInstanceToPool($obj, $key);
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
            $key = WishlistProductTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WishlistProductTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WishlistProduct $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WishlistProductTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WishlistProductTableMap::COL_WISHLIST_PRODUCT_ID);
            $criteria->addSelectColumn(WishlistProductTableMap::COL_WISHLIST_ID);
            $criteria->addSelectColumn(WishlistProductTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(WishlistProductTableMap::COL_WISHLIST_PRODUCT_COMMENT);
            $criteria->addSelectColumn(WishlistProductTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(WishlistProductTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.wishlist_product_id');
            $criteria->addSelectColumn($alias . '.wishlist_id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.wishlist_product_comment');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(WishlistProductTableMap::DATABASE_NAME)->getTable(WishlistProductTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WishlistProductTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WishlistProductTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WishlistProductTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a WishlistProduct or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or WishlistProduct object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WishlistProductTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Propel\WishlistProduct) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WishlistProductTableMap::DATABASE_NAME);
            $criteria->add(WishlistProductTableMap::COL_WISHLIST_PRODUCT_ID, (array) $values, Criteria::IN);
        }

        $query = WishlistProductQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WishlistProductTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WishlistProductTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wishlist_product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WishlistProductQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WishlistProduct or Criteria object.
     *
     * @param mixed               $criteria Criteria or WishlistProduct object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WishlistProductTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WishlistProduct object
        }

        if ($criteria->containsKey(WishlistProductTableMap::COL_WISHLIST_PRODUCT_ID) && $criteria->keyContainsValue(WishlistProductTableMap::COL_WISHLIST_PRODUCT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WishlistProductTableMap::COL_WISHLIST_PRODUCT_ID.')');
        }


        // Set the correct dbName
        $query = WishlistProductQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WishlistProductTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WishlistProductTableMap::buildTableMap();
