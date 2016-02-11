<?php

namespace App\Propel\Map;

use App\Propel\Provider;
use App\Propel\ProviderQuery;
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
 * This class defines the structure of the 'provider' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProviderTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'App.Propel.Map.ProviderTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'slowshop';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'provider';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Propel\\Provider';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'App.Propel.Provider';

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
     * the column name for the provider_id field
     */
    const COL_PROVIDER_ID = 'provider.provider_id';

    /**
     * the column name for the resource_id field
     */
    const COL_RESOURCE_ID = 'provider.resource_id';

    /**
     * the column name for the provider_name field
     */
    const COL_PROVIDER_NAME = 'provider.provider_name';

    /**
     * the column name for the provider_description field
     */
    const COL_PROVIDER_DESCRIPTION = 'provider.provider_description';

    /**
     * the column name for the provider_is_own field
     */
    const COL_PROVIDER_IS_OWN = 'provider.provider_is_own';

    /**
     * the column name for the provider_is_active field
     */
    const COL_PROVIDER_IS_ACTIVE = 'provider.provider_is_active';

    /**
     * the column name for the provider_pic field
     */
    const COL_PROVIDER_PIC = 'provider.provider_pic';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'provider.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'provider.updated_at';

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
        self::TYPE_PHPNAME       => array('ProviderId', 'ResourceId', 'ProviderName', 'ProviderDescription', 'ProviderIsOwn', 'ProviderIsActive', 'ProviderPic', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('providerId', 'resourceId', 'providerName', 'providerDescription', 'providerIsOwn', 'providerIsActive', 'providerPic', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ProviderTableMap::COL_PROVIDER_ID, ProviderTableMap::COL_RESOURCE_ID, ProviderTableMap::COL_PROVIDER_NAME, ProviderTableMap::COL_PROVIDER_DESCRIPTION, ProviderTableMap::COL_PROVIDER_IS_OWN, ProviderTableMap::COL_PROVIDER_IS_ACTIVE, ProviderTableMap::COL_PROVIDER_PIC, ProviderTableMap::COL_CREATED_AT, ProviderTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('provider_id', 'resource_id', 'provider_name', 'provider_description', 'provider_is_own', 'provider_is_active', 'provider_pic', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ProviderId' => 0, 'ResourceId' => 1, 'ProviderName' => 2, 'ProviderDescription' => 3, 'ProviderIsOwn' => 4, 'ProviderIsActive' => 5, 'ProviderPic' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
        self::TYPE_CAMELNAME     => array('providerId' => 0, 'resourceId' => 1, 'providerName' => 2, 'providerDescription' => 3, 'providerIsOwn' => 4, 'providerIsActive' => 5, 'providerPic' => 6, 'createdAt' => 7, 'updatedAt' => 8, ),
        self::TYPE_COLNAME       => array(ProviderTableMap::COL_PROVIDER_ID => 0, ProviderTableMap::COL_RESOURCE_ID => 1, ProviderTableMap::COL_PROVIDER_NAME => 2, ProviderTableMap::COL_PROVIDER_DESCRIPTION => 3, ProviderTableMap::COL_PROVIDER_IS_OWN => 4, ProviderTableMap::COL_PROVIDER_IS_ACTIVE => 5, ProviderTableMap::COL_PROVIDER_PIC => 6, ProviderTableMap::COL_CREATED_AT => 7, ProviderTableMap::COL_UPDATED_AT => 8, ),
        self::TYPE_FIELDNAME     => array('provider_id' => 0, 'resource_id' => 1, 'provider_name' => 2, 'provider_description' => 3, 'provider_is_own' => 4, 'provider_is_active' => 5, 'provider_pic' => 6, 'created_at' => 7, 'updated_at' => 8, ),
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
        $this->setName('provider');
        $this->setPhpName('Provider');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Propel\\Provider');
        $this->setPackage('App.Propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('provider_id', 'ProviderId', 'INTEGER', true, 10, null);
        $this->addForeignKey('resource_id', 'ResourceId', 'INTEGER', 'resource', 'resource_id', true, 10, null);
        $this->addColumn('provider_name', 'ProviderName', 'VARCHAR', true, 250, null);
        $this->addColumn('provider_description', 'ProviderDescription', 'LONGVARCHAR', false, null, null);
        $this->addColumn('provider_is_own', 'ProviderIsOwn', 'BOOLEAN', false, 1, null);
        $this->addColumn('provider_is_active', 'ProviderIsActive', 'BOOLEAN', false, 1, null);
        $this->addForeignKey('provider_pic', 'ProviderPic', 'INTEGER', 'file', 'file_id', false, 10, null);
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
        $this->addRelation('File', '\\App\\Propel\\File', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':provider_pic',
    1 => ':file_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Product', '\\App\\Propel\\Product', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':provider_id',
    1 => ':provider_id',
  ),
), null, 'CASCADE', 'Products', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProviderId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProviderId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProviderId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProviderId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProviderId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProviderId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ProviderId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ProviderTableMap::CLASS_DEFAULT : ProviderTableMap::OM_CLASS;
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
     * @return array           (Provider object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProviderTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProviderTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProviderTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProviderTableMap::OM_CLASS;
            /** @var Provider $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProviderTableMap::addInstanceToPool($obj, $key);
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
            $key = ProviderTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProviderTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Provider $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProviderTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProviderTableMap::COL_PROVIDER_ID);
            $criteria->addSelectColumn(ProviderTableMap::COL_RESOURCE_ID);
            $criteria->addSelectColumn(ProviderTableMap::COL_PROVIDER_NAME);
            $criteria->addSelectColumn(ProviderTableMap::COL_PROVIDER_DESCRIPTION);
            $criteria->addSelectColumn(ProviderTableMap::COL_PROVIDER_IS_OWN);
            $criteria->addSelectColumn(ProviderTableMap::COL_PROVIDER_IS_ACTIVE);
            $criteria->addSelectColumn(ProviderTableMap::COL_PROVIDER_PIC);
            $criteria->addSelectColumn(ProviderTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ProviderTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.provider_id');
            $criteria->addSelectColumn($alias . '.resource_id');
            $criteria->addSelectColumn($alias . '.provider_name');
            $criteria->addSelectColumn($alias . '.provider_description');
            $criteria->addSelectColumn($alias . '.provider_is_own');
            $criteria->addSelectColumn($alias . '.provider_is_active');
            $criteria->addSelectColumn($alias . '.provider_pic');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProviderTableMap::DATABASE_NAME)->getTable(ProviderTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProviderTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProviderTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProviderTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Provider or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Provider object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProviderTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Propel\Provider) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProviderTableMap::DATABASE_NAME);
            $criteria->add(ProviderTableMap::COL_PROVIDER_ID, (array) $values, Criteria::IN);
        }

        $query = ProviderQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProviderTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProviderTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the provider table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProviderQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Provider or Criteria object.
     *
     * @param mixed               $criteria Criteria or Provider object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProviderTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Provider object
        }

        if ($criteria->containsKey(ProviderTableMap::COL_PROVIDER_ID) && $criteria->keyContainsValue(ProviderTableMap::COL_PROVIDER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProviderTableMap::COL_PROVIDER_ID.')');
        }


        // Set the correct dbName
        $query = ProviderQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProviderTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProviderTableMap::buildTableMap();
