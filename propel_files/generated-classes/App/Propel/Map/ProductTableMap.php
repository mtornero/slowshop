<?php

namespace App\Propel\Map;

use App\Propel\Product;
use App\Propel\ProductQuery;
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
 * This class defines the structure of the 'product' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProductTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'App.Propel.Map.ProductTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'slowshop';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'product';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Propel\\Product';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'App.Propel.Product';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the product_id field
     */
    const COL_PRODUCT_ID = 'product.product_id';

    /**
     * the column name for the resource_id field
     */
    const COL_RESOURCE_ID = 'product.resource_id';

    /**
     * the column name for the product_name field
     */
    const COL_PRODUCT_NAME = 'product.product_name';

    /**
     * the column name for the product_description field
     */
    const COL_PRODUCT_DESCRIPTION = 'product.product_description';

    /**
     * the column name for the category_id field
     */
    const COL_CATEGORY_ID = 'product.category_id';

    /**
     * the column name for the provider_id field
     */
    const COL_PROVIDER_ID = 'product.provider_id';

    /**
     * the column name for the unit_id field
     */
    const COL_UNIT_ID = 'product.unit_id';

    /**
     * the column name for the product_range field
     */
    const COL_PRODUCT_RANGE = 'product.product_range';

    /**
     * the column name for the product_price field
     */
    const COL_PRODUCT_PRICE = 'product.product_price';

    /**
     * the column name for the product_is_active field
     */
    const COL_PRODUCT_IS_ACTIVE = 'product.product_is_active';

    /**
     * the column name for the product_pic field
     */
    const COL_PRODUCT_PIC = 'product.product_pic';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'product.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'product.updated_at';

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
        self::TYPE_PHPNAME       => array('ProductId', 'ResourceId', 'ProductName', 'ProductDescription', 'CategoryId', 'ProviderId', 'UnitId', 'ProductRange', 'ProductPrice', 'ProductIsActive', 'ProductPic', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('productId', 'resourceId', 'productName', 'productDescription', 'categoryId', 'providerId', 'unitId', 'productRange', 'productPrice', 'productIsActive', 'productPic', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ProductTableMap::COL_PRODUCT_ID, ProductTableMap::COL_RESOURCE_ID, ProductTableMap::COL_PRODUCT_NAME, ProductTableMap::COL_PRODUCT_DESCRIPTION, ProductTableMap::COL_CATEGORY_ID, ProductTableMap::COL_PROVIDER_ID, ProductTableMap::COL_UNIT_ID, ProductTableMap::COL_PRODUCT_RANGE, ProductTableMap::COL_PRODUCT_PRICE, ProductTableMap::COL_PRODUCT_IS_ACTIVE, ProductTableMap::COL_PRODUCT_PIC, ProductTableMap::COL_CREATED_AT, ProductTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('product_id', 'resource_id', 'product_name', 'product_description', 'category_id', 'provider_id', 'unit_id', 'product_range', 'product_price', 'product_is_active', 'product_pic', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ProductId' => 0, 'ResourceId' => 1, 'ProductName' => 2, 'ProductDescription' => 3, 'CategoryId' => 4, 'ProviderId' => 5, 'UnitId' => 6, 'ProductRange' => 7, 'ProductPrice' => 8, 'ProductIsActive' => 9, 'ProductPic' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, ),
        self::TYPE_CAMELNAME     => array('productId' => 0, 'resourceId' => 1, 'productName' => 2, 'productDescription' => 3, 'categoryId' => 4, 'providerId' => 5, 'unitId' => 6, 'productRange' => 7, 'productPrice' => 8, 'productIsActive' => 9, 'productPic' => 10, 'createdAt' => 11, 'updatedAt' => 12, ),
        self::TYPE_COLNAME       => array(ProductTableMap::COL_PRODUCT_ID => 0, ProductTableMap::COL_RESOURCE_ID => 1, ProductTableMap::COL_PRODUCT_NAME => 2, ProductTableMap::COL_PRODUCT_DESCRIPTION => 3, ProductTableMap::COL_CATEGORY_ID => 4, ProductTableMap::COL_PROVIDER_ID => 5, ProductTableMap::COL_UNIT_ID => 6, ProductTableMap::COL_PRODUCT_RANGE => 7, ProductTableMap::COL_PRODUCT_PRICE => 8, ProductTableMap::COL_PRODUCT_IS_ACTIVE => 9, ProductTableMap::COL_PRODUCT_PIC => 10, ProductTableMap::COL_CREATED_AT => 11, ProductTableMap::COL_UPDATED_AT => 12, ),
        self::TYPE_FIELDNAME     => array('product_id' => 0, 'resource_id' => 1, 'product_name' => 2, 'product_description' => 3, 'category_id' => 4, 'provider_id' => 5, 'unit_id' => 6, 'product_range' => 7, 'product_price' => 8, 'product_is_active' => 9, 'product_pic' => 10, 'created_at' => 11, 'updated_at' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $this->setName('product');
        $this->setPhpName('Product');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Propel\\Product');
        $this->setPackage('App.Propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('product_id', 'ProductId', 'INTEGER', true, 10, null);
        $this->addForeignKey('resource_id', 'ResourceId', 'INTEGER', 'resource', 'resource_id', true, 10, null);
        $this->addColumn('product_name', 'ProductName', 'VARCHAR', true, 60, null);
        $this->addColumn('product_description', 'ProductDescription', 'VARCHAR', false, 250, null);
        $this->addForeignKey('category_id', 'CategoryId', 'INTEGER', 'category', 'category_id', true, 10, null);
        $this->addForeignKey('provider_id', 'ProviderId', 'INTEGER', 'provider', 'provider_id', false, 10, null);
        $this->addForeignKey('unit_id', 'UnitId', 'TINYINT', 'unit', 'unit_id', true, 3, null);
        $this->addColumn('product_range', 'ProductRange', 'VARCHAR', false, 45, null);
        $this->addColumn('product_price', 'ProductPrice', 'DECIMAL', true, 10, null);
        $this->addColumn('product_is_active', 'ProductIsActive', 'TINYINT', true, 3, null);
        $this->addForeignKey('product_pic', 'ProductPic', 'INTEGER', 'file', 'file_id', false, 10, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Category', '\\App\\Propel\\Category', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':category_id',
    1 => ':category_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Provider', '\\App\\Propel\\Provider', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':provider_id',
    1 => ':provider_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Unit', '\\App\\Propel\\Unit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':unit_id',
    1 => ':unit_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('File', '\\App\\Propel\\File', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_pic',
    1 => ':file_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Resource', '\\App\\Propel\\Resource', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('OrderProduct', '\\App\\Propel\\OrderProduct', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':product_id',
  ),
), null, 'CASCADE', 'OrderProducts', false);
        $this->addRelation('ProductHighlighted', '\\App\\Propel\\ProductHighlighted', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':product_id',
  ),
), null, 'CASCADE', 'ProductHighlighteds', false);
        $this->addRelation('ProductVariationType', '\\App\\Propel\\ProductVariationType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':product_id',
  ),
), null, 'CASCADE', 'ProductVariationTypes', false);
        $this->addRelation('WishlistProduct', '\\App\\Propel\\WishlistProduct', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':product_id',
  ),
), null, 'CASCADE', 'WishlistProducts', false);
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
            'delegate' => array('to' => 'resource', ),
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ProductTableMap::CLASS_DEFAULT : ProductTableMap::OM_CLASS;
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
     * @return array           (Product object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProductTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductTableMap::OM_CLASS;
            /** @var Product $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Product $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(ProductTableMap::COL_RESOURCE_ID);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_NAME);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_DESCRIPTION);
            $criteria->addSelectColumn(ProductTableMap::COL_CATEGORY_ID);
            $criteria->addSelectColumn(ProductTableMap::COL_PROVIDER_ID);
            $criteria->addSelectColumn(ProductTableMap::COL_UNIT_ID);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_RANGE);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_PRICE);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_IS_ACTIVE);
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCT_PIC);
            $criteria->addSelectColumn(ProductTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ProductTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.resource_id');
            $criteria->addSelectColumn($alias . '.product_name');
            $criteria->addSelectColumn($alias . '.product_description');
            $criteria->addSelectColumn($alias . '.category_id');
            $criteria->addSelectColumn($alias . '.provider_id');
            $criteria->addSelectColumn($alias . '.unit_id');
            $criteria->addSelectColumn($alias . '.product_range');
            $criteria->addSelectColumn($alias . '.product_price');
            $criteria->addSelectColumn($alias . '.product_is_active');
            $criteria->addSelectColumn($alias . '.product_pic');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductTableMap::DATABASE_NAME)->getTable(ProductTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProductTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProductTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProductTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Product or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Product object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Propel\Product) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductTableMap::DATABASE_NAME);
            $criteria->add(ProductTableMap::COL_PRODUCT_ID, (array) $values, Criteria::IN);
        }

        $query = ProductQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProductQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Product or Criteria object.
     *
     * @param mixed               $criteria Criteria or Product object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Product object
        }

        if ($criteria->containsKey(ProductTableMap::COL_PRODUCT_ID) && $criteria->keyContainsValue(ProductTableMap::COL_PRODUCT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProductTableMap::COL_PRODUCT_ID.')');
        }


        // Set the correct dbName
        $query = ProductQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProductTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProductTableMap::buildTableMap();
