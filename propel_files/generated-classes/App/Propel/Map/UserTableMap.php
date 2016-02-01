<?php

namespace App\Propel\Map;

use App\Propel\User;
use App\Propel\UserQuery;
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
 * This class defines the structure of the 'user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'App.Propel.Map.UserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'slowshop';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'user';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Propel\\User';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'App.Propel.User';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'user.user_id';

    /**
     * the column name for the resource_id field
     */
    const COL_RESOURCE_ID = 'user.resource_id';

    /**
     * the column name for the use_name field
     */
    const COL_USE_NAME = 'user.use_name';

    /**
     * the column name for the user_surname field
     */
    const COL_USER_SURNAME = 'user.user_surname';

    /**
     * the column name for the user_login field
     */
    const COL_USER_LOGIN = 'user.user_login';

    /**
     * the column name for the user_pass field
     */
    const COL_USER_PASS = 'user.user_pass';

    /**
     * the column name for the user_pass_is_temp field
     */
    const COL_USER_PASS_IS_TEMP = 'user.user_pass_is_temp';

    /**
     * the column name for the user_email field
     */
    const COL_USER_EMAIL = 'user.user_email';

    /**
     * the column name for the user_phone field
     */
    const COL_USER_PHONE = 'user.user_phone';

    /**
     * the column name for the user_address field
     */
    const COL_USER_ADDRESS = 'user.user_address';

    /**
     * the column name for the role_id field
     */
    const COL_ROLE_ID = 'user.role_id';

    /**
     * the column name for the user_is_active field
     */
    const COL_USER_IS_ACTIVE = 'user.user_is_active';

    /**
     * the column name for the user_pic field
     */
    const COL_USER_PIC = 'user.user_pic';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'user.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'user.updated_at';

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
        self::TYPE_PHPNAME       => array('UserId', 'ResourceId', 'UseName', 'UserSurname', 'UserLogin', 'UserPass', 'UserPassIsTemp', 'UserEmail', 'UserPhone', 'UserAddress', 'RoleId', 'UserIsActive', 'UserPic', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('userId', 'resourceId', 'useName', 'userSurname', 'userLogin', 'userPass', 'userPassIsTemp', 'userEmail', 'userPhone', 'userAddress', 'roleId', 'userIsActive', 'userPic', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USER_ID, UserTableMap::COL_RESOURCE_ID, UserTableMap::COL_USE_NAME, UserTableMap::COL_USER_SURNAME, UserTableMap::COL_USER_LOGIN, UserTableMap::COL_USER_PASS, UserTableMap::COL_USER_PASS_IS_TEMP, UserTableMap::COL_USER_EMAIL, UserTableMap::COL_USER_PHONE, UserTableMap::COL_USER_ADDRESS, UserTableMap::COL_ROLE_ID, UserTableMap::COL_USER_IS_ACTIVE, UserTableMap::COL_USER_PIC, UserTableMap::COL_CREATED_AT, UserTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('user_id', 'resource_id', 'use_name', 'user_surname', 'user_login', 'user_pass', 'user_pass_is_temp', 'user_email', 'user_phone', 'user_address', 'role_id', 'user_is_active', 'user_pic', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('UserId' => 0, 'ResourceId' => 1, 'UseName' => 2, 'UserSurname' => 3, 'UserLogin' => 4, 'UserPass' => 5, 'UserPassIsTemp' => 6, 'UserEmail' => 7, 'UserPhone' => 8, 'UserAddress' => 9, 'RoleId' => 10, 'UserIsActive' => 11, 'UserPic' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, ),
        self::TYPE_CAMELNAME     => array('userId' => 0, 'resourceId' => 1, 'useName' => 2, 'userSurname' => 3, 'userLogin' => 4, 'userPass' => 5, 'userPassIsTemp' => 6, 'userEmail' => 7, 'userPhone' => 8, 'userAddress' => 9, 'roleId' => 10, 'userIsActive' => 11, 'userPic' => 12, 'createdAt' => 13, 'updatedAt' => 14, ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USER_ID => 0, UserTableMap::COL_RESOURCE_ID => 1, UserTableMap::COL_USE_NAME => 2, UserTableMap::COL_USER_SURNAME => 3, UserTableMap::COL_USER_LOGIN => 4, UserTableMap::COL_USER_PASS => 5, UserTableMap::COL_USER_PASS_IS_TEMP => 6, UserTableMap::COL_USER_EMAIL => 7, UserTableMap::COL_USER_PHONE => 8, UserTableMap::COL_USER_ADDRESS => 9, UserTableMap::COL_ROLE_ID => 10, UserTableMap::COL_USER_IS_ACTIVE => 11, UserTableMap::COL_USER_PIC => 12, UserTableMap::COL_CREATED_AT => 13, UserTableMap::COL_UPDATED_AT => 14, ),
        self::TYPE_FIELDNAME     => array('user_id' => 0, 'resource_id' => 1, 'use_name' => 2, 'user_surname' => 3, 'user_login' => 4, 'user_pass' => 5, 'user_pass_is_temp' => 6, 'user_email' => 7, 'user_phone' => 8, 'user_address' => 9, 'role_id' => 10, 'user_is_active' => 11, 'user_pic' => 12, 'created_at' => 13, 'updated_at' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
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
        $this->setName('user');
        $this->setPhpName('User');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Propel\\User');
        $this->setPackage('App.Propel');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('user_id', 'UserId', 'INTEGER', true, 10, null);
        $this->addForeignKey('resource_id', 'ResourceId', 'INTEGER', 'resource', 'resource_id', true, 10, null);
        $this->addColumn('use_name', 'UseName', 'VARCHAR', true, 60, null);
        $this->addColumn('user_surname', 'UserSurname', 'VARCHAR', false, 60, null);
        $this->addColumn('user_login', 'UserLogin', 'VARCHAR', true, 60, null);
        $this->addColumn('user_pass', 'UserPass', 'VARCHAR', true, 60, null);
        $this->addColumn('user_pass_is_temp', 'UserPassIsTemp', 'VARCHAR', true, 45, null);
        $this->addColumn('user_email', 'UserEmail', 'VARCHAR', false, 100, null);
        $this->addColumn('user_phone', 'UserPhone', 'VARCHAR', false, 45, null);
        $this->addColumn('user_address', 'UserAddress', 'VARCHAR', false, 250, null);
        $this->addForeignKey('role_id', 'RoleId', 'TINYINT', 'role', 'role_id', true, 3, null);
        $this->addColumn('user_is_active', 'UserIsActive', 'BOOLEAN', true, 1, null);
        $this->addForeignKey('user_pic', 'UserPic', 'INTEGER', 'file', 'file_id', false, 10, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('File', '\\App\\Propel\\File', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_pic',
    1 => ':file_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Role', '\\App\\Propel\\Role', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':role_id',
    1 => ':role_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Resource', '\\App\\Propel\\Resource', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':resource_id',
    1 => ':resource_id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Order', '\\App\\Propel\\Order', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
  ),
), null, 'CASCADE', 'Orders', false);
        $this->addRelation('UserPeriodicPlan', '\\App\\Propel\\UserPeriodicPlan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UserTableMap::CLASS_DEFAULT : UserTableMap::OM_CLASS;
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
     * @return array           (User object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserTableMap::OM_CLASS;
            /** @var User $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserTableMap::addInstanceToPool($obj, $key);
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
            $key = UserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var User $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UserTableMap::COL_USER_ID);
            $criteria->addSelectColumn(UserTableMap::COL_RESOURCE_ID);
            $criteria->addSelectColumn(UserTableMap::COL_USE_NAME);
            $criteria->addSelectColumn(UserTableMap::COL_USER_SURNAME);
            $criteria->addSelectColumn(UserTableMap::COL_USER_LOGIN);
            $criteria->addSelectColumn(UserTableMap::COL_USER_PASS);
            $criteria->addSelectColumn(UserTableMap::COL_USER_PASS_IS_TEMP);
            $criteria->addSelectColumn(UserTableMap::COL_USER_EMAIL);
            $criteria->addSelectColumn(UserTableMap::COL_USER_PHONE);
            $criteria->addSelectColumn(UserTableMap::COL_USER_ADDRESS);
            $criteria->addSelectColumn(UserTableMap::COL_ROLE_ID);
            $criteria->addSelectColumn(UserTableMap::COL_USER_IS_ACTIVE);
            $criteria->addSelectColumn(UserTableMap::COL_USER_PIC);
            $criteria->addSelectColumn(UserTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(UserTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.resource_id');
            $criteria->addSelectColumn($alias . '.use_name');
            $criteria->addSelectColumn($alias . '.user_surname');
            $criteria->addSelectColumn($alias . '.user_login');
            $criteria->addSelectColumn($alias . '.user_pass');
            $criteria->addSelectColumn($alias . '.user_pass_is_temp');
            $criteria->addSelectColumn($alias . '.user_email');
            $criteria->addSelectColumn($alias . '.user_phone');
            $criteria->addSelectColumn($alias . '.user_address');
            $criteria->addSelectColumn($alias . '.role_id');
            $criteria->addSelectColumn($alias . '.user_is_active');
            $criteria->addSelectColumn($alias . '.user_pic');
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
        return Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME)->getTable(UserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a User or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or User object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Propel\User) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserTableMap::DATABASE_NAME);
            $criteria->add(UserTableMap::COL_USER_ID, (array) $values, Criteria::IN);
        }

        $query = UserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a User or Criteria object.
     *
     * @param mixed               $criteria Criteria or User object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from User object
        }

        if ($criteria->containsKey(UserTableMap::COL_USER_ID) && $criteria->keyContainsValue(UserTableMap::COL_USER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserTableMap::COL_USER_ID.')');
        }


        // Set the correct dbName
        $query = UserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UserTableMap::buildTableMap();
