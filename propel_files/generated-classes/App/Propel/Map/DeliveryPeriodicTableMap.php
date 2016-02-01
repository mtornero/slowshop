<?php

namespace App\Propel\Map;

use App\Propel\DeliveryPeriodic;
use App\Propel\DeliveryPeriodicQuery;
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
 * This class defines the structure of the 'delivery_periodic' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DeliveryPeriodicTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'App.Propel.Map.DeliveryPeriodicTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'slowshop';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'delivery_periodic';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Propel\\DeliveryPeriodic';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'App.Propel.DeliveryPeriodic';

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
     * the column name for the delivery_periodic_id field
     */
    const COL_DELIVERY_PERIODIC_ID = 'delivery_periodic.delivery_periodic_id';

    /**
     * the column name for the delivery_id field
     */
    const COL_DELIVERY_ID = 'delivery_periodic.delivery_id';

    /**
     * the column name for the delivery_periodic_plan_id field
     */
    const COL_DELIVERY_PERIODIC_PLAN_ID = 'delivery_periodic.delivery_periodic_plan_id';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'delivery_periodic.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'delivery_periodic.updated_at';

    /**
     * the column name for the sortable_rank field
     */
    const COL_SORTABLE_RANK = 'delivery_periodic.sortable_rank';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    // sortable behavior
    /**
     * rank column
     */
    const RANK_COL = "delivery_periodic.sortable_rank";



    /**
    * Scope column for the set
    */
    const SCOPE_COL = 'delivery_periodic.delivery_periodic_plan_id';


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('DeliveryPeriodicId', 'DeliveryId', 'DeliveryPeriodicPlanId', 'CreatedAt', 'UpdatedAt', 'SortableRank', ),
        self::TYPE_CAMELNAME     => array('deliveryPeriodicId', 'deliveryId', 'deliveryPeriodicPlanId', 'createdAt', 'updatedAt', 'sortableRank', ),
        self::TYPE_COLNAME       => array(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID, DeliveryPeriodicTableMap::COL_DELIVERY_ID, DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID, DeliveryPeriodicTableMap::COL_CREATED_AT, DeliveryPeriodicTableMap::COL_UPDATED_AT, DeliveryPeriodicTableMap::COL_SORTABLE_RANK, ),
        self::TYPE_FIELDNAME     => array('delivery_periodic_id', 'delivery_id', 'delivery_periodic_plan_id', 'created_at', 'updated_at', 'sortable_rank', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('DeliveryPeriodicId' => 0, 'DeliveryId' => 1, 'DeliveryPeriodicPlanId' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'SortableRank' => 5, ),
        self::TYPE_CAMELNAME     => array('deliveryPeriodicId' => 0, 'deliveryId' => 1, 'deliveryPeriodicPlanId' => 2, 'createdAt' => 3, 'updatedAt' => 4, 'sortableRank' => 5, ),
        self::TYPE_COLNAME       => array(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID => 0, DeliveryPeriodicTableMap::COL_DELIVERY_ID => 1, DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID => 2, DeliveryPeriodicTableMap::COL_CREATED_AT => 3, DeliveryPeriodicTableMap::COL_UPDATED_AT => 4, DeliveryPeriodicTableMap::COL_SORTABLE_RANK => 5, ),
        self::TYPE_FIELDNAME     => array('delivery_periodic_id' => 0, 'delivery_id' => 1, 'delivery_periodic_plan_id' => 2, 'created_at' => 3, 'updated_at' => 4, 'sortable_rank' => 5, ),
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
        $this->setName('delivery_periodic');
        $this->setPhpName('DeliveryPeriodic');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Propel\\DeliveryPeriodic');
        $this->setPackage('App.Propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('delivery_periodic_id', 'DeliveryPeriodicId', 'INTEGER', true, 10, null);
        $this->addForeignKey('delivery_id', 'DeliveryId', 'INTEGER', 'delivery', 'delivery_id', true, 10, null);
        $this->addForeignKey('delivery_periodic_plan_id', 'DeliveryPeriodicPlanId', 'INTEGER', 'periodic_plan', 'periodic_plan_id', true, 10, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('sortable_rank', 'SortableRank', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Delivery', '\\App\\Propel\\Delivery', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':delivery_id',
    1 => ':delivery_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('PeriodicPlan', '\\App\\Propel\\PeriodicPlan', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':delivery_periodic_plan_id',
    1 => ':periodic_plan_id',
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
            'sortable' => array('rank_column' => 'sortable_rank', 'use_scope' => 'true', 'scope_column' => 'delivery_periodic_plan_id', ),
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeliveryPeriodicId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeliveryPeriodicId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeliveryPeriodicId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeliveryPeriodicId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeliveryPeriodicId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeliveryPeriodicId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('DeliveryPeriodicId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DeliveryPeriodicTableMap::CLASS_DEFAULT : DeliveryPeriodicTableMap::OM_CLASS;
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
     * @return array           (DeliveryPeriodic object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DeliveryPeriodicTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DeliveryPeriodicTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DeliveryPeriodicTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DeliveryPeriodicTableMap::OM_CLASS;
            /** @var DeliveryPeriodic $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DeliveryPeriodicTableMap::addInstanceToPool($obj, $key);
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
            $key = DeliveryPeriodicTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DeliveryPeriodicTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var DeliveryPeriodic $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DeliveryPeriodicTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID);
            $criteria->addSelectColumn(DeliveryPeriodicTableMap::COL_DELIVERY_ID);
            $criteria->addSelectColumn(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID);
            $criteria->addSelectColumn(DeliveryPeriodicTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DeliveryPeriodicTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(DeliveryPeriodicTableMap::COL_SORTABLE_RANK);
        } else {
            $criteria->addSelectColumn($alias . '.delivery_periodic_id');
            $criteria->addSelectColumn($alias . '.delivery_id');
            $criteria->addSelectColumn($alias . '.delivery_periodic_plan_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.sortable_rank');
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
        return Propel::getServiceContainer()->getDatabaseMap(DeliveryPeriodicTableMap::DATABASE_NAME)->getTable(DeliveryPeriodicTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(DeliveryPeriodicTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(DeliveryPeriodicTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new DeliveryPeriodicTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a DeliveryPeriodic or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or DeliveryPeriodic object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Propel\DeliveryPeriodic) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DeliveryPeriodicTableMap::DATABASE_NAME);
            $criteria->add(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID, (array) $values, Criteria::IN);
        }

        $query = DeliveryPeriodicQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DeliveryPeriodicTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DeliveryPeriodicTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the delivery_periodic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DeliveryPeriodicQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DeliveryPeriodic or Criteria object.
     *
     * @param mixed               $criteria Criteria or DeliveryPeriodic object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DeliveryPeriodic object
        }

        if ($criteria->containsKey(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID) && $criteria->keyContainsValue(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID.')');
        }


        // Set the correct dbName
        $query = DeliveryPeriodicQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // DeliveryPeriodicTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DeliveryPeriodicTableMap::buildTableMap();
