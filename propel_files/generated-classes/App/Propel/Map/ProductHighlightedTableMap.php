<?php

namespace App\Propel\Map;

use App\Propel\ProductHighlighted;
use App\Propel\ProductHighlightedQuery;
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
 * This class defines the structure of the 'product_highlighted' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProductHighlightedTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'App.Propel.Map.ProductHighlightedTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'slowshop';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'product_highlighted';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Propel\\ProductHighlighted';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'App.Propel.ProductHighlighted';

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
     * the column name for the product_highlighted_id field
     */
    const COL_PRODUCT_HIGHLIGHTED_ID = 'product_highlighted.product_highlighted_id';

    /**
     * the column name for the product_id field
     */
    const COL_PRODUCT_ID = 'product_highlighted.product_id';

    /**
     * the column name for the product_highlighted_for field
     */
    const COL_PRODUCT_HIGHLIGHTED_FOR = 'product_highlighted.product_highlighted_for';

    /**
     * the column name for the product_highlighted_from field
     */
    const COL_PRODUCT_HIGHLIGHTED_FROM = 'product_highlighted.product_highlighted_from';

    /**
     * the column name for the product_highlighted_to field
     */
    const COL_PRODUCT_HIGHLIGHTED_TO = 'product_highlighted.product_highlighted_to';

    /**
     * the column name for the product_highlighted_weight field
     */
    const COL_PRODUCT_HIGHLIGHTED_WEIGHT = 'product_highlighted.product_highlighted_weight';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'product_highlighted.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'product_highlighted.updated_at';

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
        self::TYPE_PHPNAME       => array('ProductHighlightedId', 'ProductId', 'ProductHighlightedFor', 'ProductHighlightedFrom', 'ProductHighlightedTo', 'ProductHighlightedWeight', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('productHighlightedId', 'productId', 'productHighlightedFor', 'productHighlightedFrom', 'productHighlightedTo', 'productHighlightedWeight', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID, ProductHighlightedTableMap::COL_PRODUCT_ID, ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FOR, ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FROM, ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_TO, ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_WEIGHT, ProductHighlightedTableMap::COL_CREATED_AT, ProductHighlightedTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('product_highlighted_id', 'product_id', 'product_highlighted_for', 'product_highlighted_from', 'product_highlighted_to', 'product_highlighted_weight', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ProductHighlightedId' => 0, 'ProductId' => 1, 'ProductHighlightedFor' => 2, 'ProductHighlightedFrom' => 3, 'ProductHighlightedTo' => 4, 'ProductHighlightedWeight' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
        self::TYPE_CAMELNAME     => array('productHighlightedId' => 0, 'productId' => 1, 'productHighlightedFor' => 2, 'productHighlightedFrom' => 3, 'productHighlightedTo' => 4, 'productHighlightedWeight' => 5, 'createdAt' => 6, 'updatedAt' => 7, ),
        self::TYPE_COLNAME       => array(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID => 0, ProductHighlightedTableMap::COL_PRODUCT_ID => 1, ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FOR => 2, ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FROM => 3, ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_TO => 4, ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_WEIGHT => 5, ProductHighlightedTableMap::COL_CREATED_AT => 6, ProductHighlightedTableMap::COL_UPDATED_AT => 7, ),
        self::TYPE_FIELDNAME     => array('product_highlighted_id' => 0, 'product_id' => 1, 'product_highlighted_for' => 2, 'product_highlighted_from' => 3, 'product_highlighted_to' => 4, 'product_highlighted_weight' => 5, 'created_at' => 6, 'updated_at' => 7, ),
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
        $this->setName('product_highlighted');
        $this->setPhpName('ProductHighlighted');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Propel\\ProductHighlighted');
        $this->setPackage('App.Propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('product_highlighted_id', 'ProductHighlightedId', 'INTEGER', true, 10, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'product', 'product_id', true, 10, null);
        $this->addForeignKey('product_highlighted_for', 'ProductHighlightedFor', 'INTEGER', 'resource', 'resource_id', false, 10, null);
        $this->addColumn('product_highlighted_from', 'ProductHighlightedFrom', 'DATE', false, null, null);
        $this->addColumn('product_highlighted_to', 'ProductHighlightedTo', 'DATE', false, null, null);
        $this->addColumn('product_highlighted_weight', 'ProductHighlightedWeight', 'TINYINT', true, 3, 5);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Product', '\\App\\Propel\\Product', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':product_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Resource', '\\App\\Propel\\Resource', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_highlighted_for',
    1 => ':resource_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductHighlightedId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductHighlightedId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductHighlightedId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductHighlightedId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductHighlightedId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductHighlightedId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ProductHighlightedId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ProductHighlightedTableMap::CLASS_DEFAULT : ProductHighlightedTableMap::OM_CLASS;
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
     * @return array           (ProductHighlighted object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProductHighlightedTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductHighlightedTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductHighlightedTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductHighlightedTableMap::OM_CLASS;
            /** @var ProductHighlighted $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductHighlightedTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductHighlightedTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductHighlightedTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ProductHighlighted $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductHighlightedTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID);
            $criteria->addSelectColumn(ProductHighlightedTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FOR);
            $criteria->addSelectColumn(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FROM);
            $criteria->addSelectColumn(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_TO);
            $criteria->addSelectColumn(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_WEIGHT);
            $criteria->addSelectColumn(ProductHighlightedTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ProductHighlightedTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.product_highlighted_id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.product_highlighted_for');
            $criteria->addSelectColumn($alias . '.product_highlighted_from');
            $criteria->addSelectColumn($alias . '.product_highlighted_to');
            $criteria->addSelectColumn($alias . '.product_highlighted_weight');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductHighlightedTableMap::DATABASE_NAME)->getTable(ProductHighlightedTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProductHighlightedTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProductHighlightedTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProductHighlightedTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ProductHighlighted or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ProductHighlighted object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductHighlightedTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Propel\ProductHighlighted) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductHighlightedTableMap::DATABASE_NAME);
            $criteria->add(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID, (array) $values, Criteria::IN);
        }

        $query = ProductHighlightedQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductHighlightedTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductHighlightedTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the product_highlighted table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProductHighlightedQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ProductHighlighted or Criteria object.
     *
     * @param mixed               $criteria Criteria or ProductHighlighted object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductHighlightedTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ProductHighlighted object
        }

        if ($criteria->containsKey(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID) && $criteria->keyContainsValue(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID.')');
        }


        // Set the correct dbName
        $query = ProductHighlightedQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProductHighlightedTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProductHighlightedTableMap::buildTableMap();
