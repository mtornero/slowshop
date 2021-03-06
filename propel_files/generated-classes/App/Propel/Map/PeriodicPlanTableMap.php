<?php

namespace App\Propel\Map;

use App\Propel\PeriodicPlan;
use App\Propel\PeriodicPlanQuery;
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
 * This class defines the structure of the 'periodic_plan' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PeriodicPlanTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'App.Propel.Map.PeriodicPlanTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'slowshop';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'periodic_plan';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Propel\\PeriodicPlan';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'App.Propel.PeriodicPlan';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the periodic_plan_id field
     */
    const COL_PERIODIC_PLAN_ID = 'periodic_plan.periodic_plan_id';

    /**
     * the column name for the resource_id field
     */
    const COL_RESOURCE_ID = 'periodic_plan.resource_id';

    /**
     * the column name for the periodic_plan_name field
     */
    const COL_PERIODIC_PLAN_NAME = 'periodic_plan.periodic_plan_name';

    /**
     * the column name for the periodic_plan_point field
     */
    const COL_PERIODIC_PLAN_POINT = 'periodic_plan.periodic_plan_point';

    /**
     * the column name for the periodic_type_id field
     */
    const COL_PERIODIC_TYPE_ID = 'periodic_plan.periodic_type_id';

    /**
     * the column name for the delievery_periodic_weekday field
     */
    const COL_DELIEVERY_PERIODIC_WEEKDAY = 'periodic_plan.delievery_periodic_weekday';

    /**
     * the column name for the periodic_plan_pic field
     */
    const COL_PERIODIC_PLAN_PIC = 'periodic_plan.periodic_plan_pic';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'periodic_plan.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'periodic_plan.updated_at';

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
        self::TYPE_PHPNAME       => array('PeriodicPlanId', 'ResourceId', 'PeriodicPlanName', 'PeriodicPlanPoint', 'PeriodicTypeId', 'DelieveryPeriodicWeekday', 'PeriodicPlanPic', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('periodicPlanId', 'resourceId', 'periodicPlanName', 'periodicPlanPoint', 'periodicTypeId', 'delieveryPeriodicWeekday', 'periodicPlanPic', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, PeriodicPlanTableMap::COL_RESOURCE_ID, PeriodicPlanTableMap::COL_PERIODIC_PLAN_NAME, PeriodicPlanTableMap::COL_PERIODIC_PLAN_POINT, PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID, PeriodicPlanTableMap::COL_DELIEVERY_PERIODIC_WEEKDAY, PeriodicPlanTableMap::COL_PERIODIC_PLAN_PIC, PeriodicPlanTableMap::COL_CREATED_AT, PeriodicPlanTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('periodic_plan_id', 'resource_id', 'periodic_plan_name', 'periodic_plan_point', 'periodic_type_id', 'delievery_periodic_weekday', 'periodic_plan_pic', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('PeriodicPlanId' => 0, 'ResourceId' => 1, 'PeriodicPlanName' => 2, 'PeriodicPlanPoint' => 3, 'PeriodicTypeId' => 4, 'DelieveryPeriodicWeekday' => 5, 'PeriodicPlanPic' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
        self::TYPE_CAMELNAME     => array('periodicPlanId' => 0, 'resourceId' => 1, 'periodicPlanName' => 2, 'periodicPlanPoint' => 3, 'periodicTypeId' => 4, 'delieveryPeriodicWeekday' => 5, 'periodicPlanPic' => 6, 'createdAt' => 7, 'updatedAt' => 8, ),
        self::TYPE_COLNAME       => array(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID => 0, PeriodicPlanTableMap::COL_RESOURCE_ID => 1, PeriodicPlanTableMap::COL_PERIODIC_PLAN_NAME => 2, PeriodicPlanTableMap::COL_PERIODIC_PLAN_POINT => 3, PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID => 4, PeriodicPlanTableMap::COL_DELIEVERY_PERIODIC_WEEKDAY => 5, PeriodicPlanTableMap::COL_PERIODIC_PLAN_PIC => 6, PeriodicPlanTableMap::COL_CREATED_AT => 7, PeriodicPlanTableMap::COL_UPDATED_AT => 8, ),
        self::TYPE_FIELDNAME     => array('periodic_plan_id' => 0, 'resource_id' => 1, 'periodic_plan_name' => 2, 'periodic_plan_point' => 3, 'periodic_type_id' => 4, 'delievery_periodic_weekday' => 5, 'periodic_plan_pic' => 6, 'created_at' => 7, 'updated_at' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('periodic_plan');
        $this->setPhpName('PeriodicPlan');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Propel\\PeriodicPlan');
        $this->setPackage('App.Propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('periodic_plan_id', 'PeriodicPlanId', 'INTEGER', true, 10, null);
        $this->addForeignKey('resource_id', 'ResourceId', 'INTEGER', 'resource', 'resource_id', true, 10, null);
        $this->addColumn('periodic_plan_name', 'PeriodicPlanName', 'VARCHAR', true, 60, null);
        $this->addColumn('periodic_plan_point', 'PeriodicPlanPoint', 'VARCHAR', false, 250, null);
        $this->addForeignKey('periodic_type_id', 'PeriodicTypeId', 'TINYINT', 'periodic_type', 'periodic_type_id', true, 3, null);
        $this->addColumn('delievery_periodic_weekday', 'DelieveryPeriodicWeekday', 'TINYINT', true, null, null);
        $this->addForeignKey('periodic_plan_pic', 'PeriodicPlanPic', 'INTEGER', 'file', 'file_id', false, 10, null);
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
        $this->addRelation('PeriodicType', '\\App\\Propel\\PeriodicType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':periodic_type_id',
    1 => ':periodic_type_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('File', '\\App\\Propel\\File', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':periodic_plan_pic',
    1 => ':file_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('DeliveryPeriodic', '\\App\\Propel\\DeliveryPeriodic', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':delivery_periodic_plan_id',
    1 => ':periodic_plan_id',
  ),
), null, 'CASCADE', 'DeliveryPeriodics', false);
        $this->addRelation('PeriodicPlanException', '\\App\\Propel\\PeriodicPlanException', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':periodic_plan_id',
    1 => ':periodic_plan_id',
  ),
), null, 'CASCADE', 'PeriodicPlanExceptions', false);
        $this->addRelation('UserPeriodicPlan', '\\App\\Propel\\UserPeriodicPlan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':periodic_plan_id',
    1 => ':periodic_plan_id',
  ),
), null, 'CASCADE', 'UserPeriodicPlans', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PeriodicPlanId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PeriodicPlanId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PeriodicPlanId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PeriodicPlanId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PeriodicPlanId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PeriodicPlanId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PeriodicPlanId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PeriodicPlanTableMap::CLASS_DEFAULT : PeriodicPlanTableMap::OM_CLASS;
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
     * @return array           (PeriodicPlan object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PeriodicPlanTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PeriodicPlanTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PeriodicPlanTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PeriodicPlanTableMap::OM_CLASS;
            /** @var PeriodicPlan $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PeriodicPlanTableMap::addInstanceToPool($obj, $key);
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
            $key = PeriodicPlanTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PeriodicPlanTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PeriodicPlan $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PeriodicPlanTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID);
            $criteria->addSelectColumn(PeriodicPlanTableMap::COL_RESOURCE_ID);
            $criteria->addSelectColumn(PeriodicPlanTableMap::COL_PERIODIC_PLAN_NAME);
            $criteria->addSelectColumn(PeriodicPlanTableMap::COL_PERIODIC_PLAN_POINT);
            $criteria->addSelectColumn(PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID);
            $criteria->addSelectColumn(PeriodicPlanTableMap::COL_DELIEVERY_PERIODIC_WEEKDAY);
            $criteria->addSelectColumn(PeriodicPlanTableMap::COL_PERIODIC_PLAN_PIC);
            $criteria->addSelectColumn(PeriodicPlanTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PeriodicPlanTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.periodic_plan_id');
            $criteria->addSelectColumn($alias . '.resource_id');
            $criteria->addSelectColumn($alias . '.periodic_plan_name');
            $criteria->addSelectColumn($alias . '.periodic_plan_point');
            $criteria->addSelectColumn($alias . '.periodic_type_id');
            $criteria->addSelectColumn($alias . '.delievery_periodic_weekday');
            $criteria->addSelectColumn($alias . '.periodic_plan_pic');
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
        return Propel::getServiceContainer()->getDatabaseMap(PeriodicPlanTableMap::DATABASE_NAME)->getTable(PeriodicPlanTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PeriodicPlanTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PeriodicPlanTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PeriodicPlanTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a PeriodicPlan or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PeriodicPlan object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicPlanTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Propel\PeriodicPlan) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PeriodicPlanTableMap::DATABASE_NAME);
            $criteria->add(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, (array) $values, Criteria::IN);
        }

        $query = PeriodicPlanQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PeriodicPlanTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PeriodicPlanTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the periodic_plan table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PeriodicPlanQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PeriodicPlan or Criteria object.
     *
     * @param mixed               $criteria Criteria or PeriodicPlan object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicPlanTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PeriodicPlan object
        }

        if ($criteria->containsKey(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID) && $criteria->keyContainsValue(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID.')');
        }


        // Set the correct dbName
        $query = PeriodicPlanQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PeriodicPlanTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PeriodicPlanTableMap::buildTableMap();
