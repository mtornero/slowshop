<?php

namespace App\Propel\Map;

use App\Propel\Promotion;
use App\Propel\PromotionQuery;
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
 * This class defines the structure of the 'promotion' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PromotionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'App.Propel.Map.PromotionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'slowshop';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'promotion';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Propel\\Promotion';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'App.Propel.Promotion';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the promotion_id field
     */
    const COL_PROMOTION_ID = 'promotion.promotion_id';

    /**
     * the column name for the resource_id field
     */
    const COL_RESOURCE_ID = 'promotion.resource_id';

    /**
     * the column name for the promotion_type_id field
     */
    const COL_PROMOTION_TYPE_ID = 'promotion.promotion_type_id';

    /**
     * the column name for the promotion_value field
     */
    const COL_PROMOTION_VALUE = 'promotion.promotion_value';

    /**
     * the column name for the promotion_gift field
     */
    const COL_PROMOTION_GIFT = 'promotion.promotion_gift';

    /**
     * the column name for the promotion_description field
     */
    const COL_PROMOTION_DESCRIPTION = 'promotion.promotion_description';

    /**
     * the column name for the promotion_starting_point field
     */
    const COL_PROMOTION_STARTING_POINT = 'promotion.promotion_starting_point';

    /**
     * the column name for the promotion_starting_date field
     */
    const COL_PROMOTION_STARTING_DATE = 'promotion.promotion_starting_date';

    /**
     * the column name for the promotion_ending_date field
     */
    const COL_PROMOTION_ENDING_DATE = 'promotion.promotion_ending_date';

    /**
     * the column name for the promotion_is_active field
     */
    const COL_PROMOTION_IS_ACTIVE = 'promotion.promotion_is_active';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'promotion.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'promotion.updated_at';

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
        self::TYPE_PHPNAME       => array('PromotionId', 'ResourceId', 'PromotionTypeId', 'PromotionValue', 'PromotionGift', 'PromotionDescription', 'PromotionStartingPoint', 'PromotionStartingDate', 'PromotionEndingDate', 'PromotionIsActive', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('promotionId', 'resourceId', 'promotionTypeId', 'promotionValue', 'promotionGift', 'promotionDescription', 'promotionStartingPoint', 'promotionStartingDate', 'promotionEndingDate', 'promotionIsActive', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(PromotionTableMap::COL_PROMOTION_ID, PromotionTableMap::COL_RESOURCE_ID, PromotionTableMap::COL_PROMOTION_TYPE_ID, PromotionTableMap::COL_PROMOTION_VALUE, PromotionTableMap::COL_PROMOTION_GIFT, PromotionTableMap::COL_PROMOTION_DESCRIPTION, PromotionTableMap::COL_PROMOTION_STARTING_POINT, PromotionTableMap::COL_PROMOTION_STARTING_DATE, PromotionTableMap::COL_PROMOTION_ENDING_DATE, PromotionTableMap::COL_PROMOTION_IS_ACTIVE, PromotionTableMap::COL_CREATED_AT, PromotionTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('promotion_id', 'resource_id', 'promotion_type_id', 'promotion_value', 'promotion_gift', 'promotion_description', 'promotion_starting_point', 'promotion_starting_date', 'promotion_ending_date', 'promotion_is_active', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('PromotionId' => 0, 'ResourceId' => 1, 'PromotionTypeId' => 2, 'PromotionValue' => 3, 'PromotionGift' => 4, 'PromotionDescription' => 5, 'PromotionStartingPoint' => 6, 'PromotionStartingDate' => 7, 'PromotionEndingDate' => 8, 'PromotionIsActive' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
        self::TYPE_CAMELNAME     => array('promotionId' => 0, 'resourceId' => 1, 'promotionTypeId' => 2, 'promotionValue' => 3, 'promotionGift' => 4, 'promotionDescription' => 5, 'promotionStartingPoint' => 6, 'promotionStartingDate' => 7, 'promotionEndingDate' => 8, 'promotionIsActive' => 9, 'createdAt' => 10, 'updatedAt' => 11, ),
        self::TYPE_COLNAME       => array(PromotionTableMap::COL_PROMOTION_ID => 0, PromotionTableMap::COL_RESOURCE_ID => 1, PromotionTableMap::COL_PROMOTION_TYPE_ID => 2, PromotionTableMap::COL_PROMOTION_VALUE => 3, PromotionTableMap::COL_PROMOTION_GIFT => 4, PromotionTableMap::COL_PROMOTION_DESCRIPTION => 5, PromotionTableMap::COL_PROMOTION_STARTING_POINT => 6, PromotionTableMap::COL_PROMOTION_STARTING_DATE => 7, PromotionTableMap::COL_PROMOTION_ENDING_DATE => 8, PromotionTableMap::COL_PROMOTION_IS_ACTIVE => 9, PromotionTableMap::COL_CREATED_AT => 10, PromotionTableMap::COL_UPDATED_AT => 11, ),
        self::TYPE_FIELDNAME     => array('promotion_id' => 0, 'resource_id' => 1, 'promotion_type_id' => 2, 'promotion_value' => 3, 'promotion_gift' => 4, 'promotion_description' => 5, 'promotion_starting_point' => 6, 'promotion_starting_date' => 7, 'promotion_ending_date' => 8, 'promotion_is_active' => 9, 'created_at' => 10, 'updated_at' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $this->setName('promotion');
        $this->setPhpName('Promotion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Propel\\Promotion');
        $this->setPackage('App.Propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('promotion_id', 'PromotionId', 'INTEGER', true, 10, null);
        $this->addForeignKey('resource_id', 'ResourceId', 'INTEGER', 'resource', 'resource_id', true, 10, null);
        $this->addForeignKey('promotion_type_id', 'PromotionTypeId', 'SMALLINT', 'promotion_type', 'promotion_type_id', true, 5, null);
        $this->addColumn('promotion_value', 'PromotionValue', 'DECIMAL', false, 10, null);
        $this->addColumn('promotion_gift', 'PromotionGift', 'INTEGER', false, 10, null);
        $this->addColumn('promotion_description', 'PromotionDescription', 'LONGVARCHAR', false, null, null);
        $this->addColumn('promotion_starting_point', 'PromotionStartingPoint', 'INTEGER', false, null, null);
        $this->addColumn('promotion_starting_date', 'PromotionStartingDate', 'DATE', false, null, null);
        $this->addColumn('promotion_ending_date', 'PromotionEndingDate', 'DATE', false, null, null);
        $this->addColumn('promotion_is_active', 'PromotionIsActive', 'BOOLEAN', false, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Resource', '\\App\\Propel\\Resource', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('PromotionType', '\\App\\Propel\\PromotionType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':promotion_type_id',
    1 => ':promotion_type_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PromotionId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PromotionId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PromotionId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PromotionId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PromotionId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PromotionId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PromotionId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PromotionTableMap::CLASS_DEFAULT : PromotionTableMap::OM_CLASS;
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
     * @return array           (Promotion object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PromotionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PromotionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PromotionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PromotionTableMap::OM_CLASS;
            /** @var Promotion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PromotionTableMap::addInstanceToPool($obj, $key);
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
            $key = PromotionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PromotionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Promotion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PromotionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PromotionTableMap::COL_PROMOTION_ID);
            $criteria->addSelectColumn(PromotionTableMap::COL_RESOURCE_ID);
            $criteria->addSelectColumn(PromotionTableMap::COL_PROMOTION_TYPE_ID);
            $criteria->addSelectColumn(PromotionTableMap::COL_PROMOTION_VALUE);
            $criteria->addSelectColumn(PromotionTableMap::COL_PROMOTION_GIFT);
            $criteria->addSelectColumn(PromotionTableMap::COL_PROMOTION_DESCRIPTION);
            $criteria->addSelectColumn(PromotionTableMap::COL_PROMOTION_STARTING_POINT);
            $criteria->addSelectColumn(PromotionTableMap::COL_PROMOTION_STARTING_DATE);
            $criteria->addSelectColumn(PromotionTableMap::COL_PROMOTION_ENDING_DATE);
            $criteria->addSelectColumn(PromotionTableMap::COL_PROMOTION_IS_ACTIVE);
            $criteria->addSelectColumn(PromotionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PromotionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.promotion_id');
            $criteria->addSelectColumn($alias . '.resource_id');
            $criteria->addSelectColumn($alias . '.promotion_type_id');
            $criteria->addSelectColumn($alias . '.promotion_value');
            $criteria->addSelectColumn($alias . '.promotion_gift');
            $criteria->addSelectColumn($alias . '.promotion_description');
            $criteria->addSelectColumn($alias . '.promotion_starting_point');
            $criteria->addSelectColumn($alias . '.promotion_starting_date');
            $criteria->addSelectColumn($alias . '.promotion_ending_date');
            $criteria->addSelectColumn($alias . '.promotion_is_active');
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
        return Propel::getServiceContainer()->getDatabaseMap(PromotionTableMap::DATABASE_NAME)->getTable(PromotionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PromotionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PromotionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PromotionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Promotion or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Promotion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PromotionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Propel\Promotion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PromotionTableMap::DATABASE_NAME);
            $criteria->add(PromotionTableMap::COL_PROMOTION_ID, (array) $values, Criteria::IN);
        }

        $query = PromotionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PromotionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PromotionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the promotion table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PromotionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Promotion or Criteria object.
     *
     * @param mixed               $criteria Criteria or Promotion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PromotionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Promotion object
        }

        if ($criteria->containsKey(PromotionTableMap::COL_PROMOTION_ID) && $criteria->keyContainsValue(PromotionTableMap::COL_PROMOTION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PromotionTableMap::COL_PROMOTION_ID.')');
        }


        // Set the correct dbName
        $query = PromotionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PromotionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PromotionTableMap::buildTableMap();
