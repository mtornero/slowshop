<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\ConfigCategory as ChildConfigCategory;
use App\Propel\ConfigCategoryI18nQuery as ChildConfigCategoryI18nQuery;
use App\Propel\ConfigCategoryQuery as ChildConfigCategoryQuery;
use App\Propel\Map\ConfigCategoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'config_category' table.
 *
 *
 *
 * @method     ChildConfigCategoryQuery orderByConfigCategoryId($order = Criteria::ASC) Order by the config_category_id column
 * @method     ChildConfigCategoryQuery orderByConfigCategoryIsVisible($order = Criteria::ASC) Order by the config_category_is_visible column
 *
 * @method     ChildConfigCategoryQuery groupByConfigCategoryId() Group by the config_category_id column
 * @method     ChildConfigCategoryQuery groupByConfigCategoryIsVisible() Group by the config_category_is_visible column
 *
 * @method     ChildConfigCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildConfigCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildConfigCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildConfigCategoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildConfigCategoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildConfigCategoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildConfigCategoryQuery leftJoinConfig($relationAlias = null) Adds a LEFT JOIN clause to the query using the Config relation
 * @method     ChildConfigCategoryQuery rightJoinConfig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Config relation
 * @method     ChildConfigCategoryQuery innerJoinConfig($relationAlias = null) Adds a INNER JOIN clause to the query using the Config relation
 *
 * @method     ChildConfigCategoryQuery joinWithConfig($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Config relation
 *
 * @method     ChildConfigCategoryQuery leftJoinWithConfig() Adds a LEFT JOIN clause and with to the query using the Config relation
 * @method     ChildConfigCategoryQuery rightJoinWithConfig() Adds a RIGHT JOIN clause and with to the query using the Config relation
 * @method     ChildConfigCategoryQuery innerJoinWithConfig() Adds a INNER JOIN clause and with to the query using the Config relation
 *
 * @method     ChildConfigCategoryQuery leftJoinConfigCategoryI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the ConfigCategoryI18n relation
 * @method     ChildConfigCategoryQuery rightJoinConfigCategoryI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ConfigCategoryI18n relation
 * @method     ChildConfigCategoryQuery innerJoinConfigCategoryI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the ConfigCategoryI18n relation
 *
 * @method     ChildConfigCategoryQuery joinWithConfigCategoryI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ConfigCategoryI18n relation
 *
 * @method     ChildConfigCategoryQuery leftJoinWithConfigCategoryI18n() Adds a LEFT JOIN clause and with to the query using the ConfigCategoryI18n relation
 * @method     ChildConfigCategoryQuery rightJoinWithConfigCategoryI18n() Adds a RIGHT JOIN clause and with to the query using the ConfigCategoryI18n relation
 * @method     ChildConfigCategoryQuery innerJoinWithConfigCategoryI18n() Adds a INNER JOIN clause and with to the query using the ConfigCategoryI18n relation
 *
 * @method     \App\Propel\ConfigQuery|\App\Propel\ConfigCategoryI18nQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildConfigCategory findOne(ConnectionInterface $con = null) Return the first ChildConfigCategory matching the query
 * @method     ChildConfigCategory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildConfigCategory matching the query, or a new ChildConfigCategory object populated from the query conditions when no match is found
 *
 * @method     ChildConfigCategory findOneByConfigCategoryId(int $config_category_id) Return the first ChildConfigCategory filtered by the config_category_id column
 * @method     ChildConfigCategory findOneByConfigCategoryIsVisible(boolean $config_category_is_visible) Return the first ChildConfigCategory filtered by the config_category_is_visible column *

 * @method     ChildConfigCategory requirePk($key, ConnectionInterface $con = null) Return the ChildConfigCategory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigCategory requireOne(ConnectionInterface $con = null) Return the first ChildConfigCategory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfigCategory requireOneByConfigCategoryId(int $config_category_id) Return the first ChildConfigCategory filtered by the config_category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigCategory requireOneByConfigCategoryIsVisible(boolean $config_category_is_visible) Return the first ChildConfigCategory filtered by the config_category_is_visible column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfigCategory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildConfigCategory objects based on current ModelCriteria
 * @method     ChildConfigCategory[]|ObjectCollection findByConfigCategoryId(int $config_category_id) Return ChildConfigCategory objects filtered by the config_category_id column
 * @method     ChildConfigCategory[]|ObjectCollection findByConfigCategoryIsVisible(boolean $config_category_is_visible) Return ChildConfigCategory objects filtered by the config_category_is_visible column
 * @method     ChildConfigCategory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ConfigCategoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ConfigCategoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\ConfigCategory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildConfigCategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildConfigCategoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildConfigCategoryQuery) {
            return $criteria;
        }
        $query = new ChildConfigCategoryQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildConfigCategory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ConfigCategoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ConfigCategoryTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildConfigCategory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT config_category_id, config_category_is_visible FROM config_category WHERE config_category_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildConfigCategory $obj */
            $obj = new ChildConfigCategory();
            $obj->hydrate($row);
            ConfigCategoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildConfigCategory|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the config_category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigCategoryId(1234); // WHERE config_category_id = 1234
     * $query->filterByConfigCategoryId(array(12, 34)); // WHERE config_category_id IN (12, 34)
     * $query->filterByConfigCategoryId(array('min' => 12)); // WHERE config_category_id > 12
     * </code>
     *
     * @param     mixed $configCategoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function filterByConfigCategoryId($configCategoryId = null, $comparison = null)
    {
        if (is_array($configCategoryId)) {
            $useMinMax = false;
            if (isset($configCategoryId['min'])) {
                $this->addUsingAlias(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($configCategoryId['max'])) {
                $this->addUsingAlias(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId, $comparison);
    }

    /**
     * Filter the query on the config_category_is_visible column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigCategoryIsVisible(true); // WHERE config_category_is_visible = true
     * $query->filterByConfigCategoryIsVisible('yes'); // WHERE config_category_is_visible = true
     * </code>
     *
     * @param     boolean|string $configCategoryIsVisible The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function filterByConfigCategoryIsVisible($configCategoryIsVisible = null, $comparison = null)
    {
        if (is_string($configCategoryIsVisible)) {
            $configCategoryIsVisible = in_array(strtolower($configCategoryIsVisible), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_IS_VISIBLE, $configCategoryIsVisible, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Config object
     *
     * @param \App\Propel\Config|ObjectCollection $config the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function filterByConfig($config, $comparison = null)
    {
        if ($config instanceof \App\Propel\Config) {
            return $this
                ->addUsingAlias(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID, $config->getConfigCategoryId(), $comparison);
        } elseif ($config instanceof ObjectCollection) {
            return $this
                ->useConfigQuery()
                ->filterByPrimaryKeys($config->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByConfig() only accepts arguments of type \App\Propel\Config or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Config relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function joinConfig($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Config');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Config');
        }

        return $this;
    }

    /**
     * Use the Config relation Config object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ConfigQuery A secondary query class using the current class as primary query
     */
    public function useConfigQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinConfig($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Config', '\App\Propel\ConfigQuery');
    }

    /**
     * Filter the query by a related \App\Propel\ConfigCategoryI18n object
     *
     * @param \App\Propel\ConfigCategoryI18n|ObjectCollection $configCategoryI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function filterByConfigCategoryI18n($configCategoryI18n, $comparison = null)
    {
        if ($configCategoryI18n instanceof \App\Propel\ConfigCategoryI18n) {
            return $this
                ->addUsingAlias(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryI18n->getConfigCategoryId(), $comparison);
        } elseif ($configCategoryI18n instanceof ObjectCollection) {
            return $this
                ->useConfigCategoryI18nQuery()
                ->filterByPrimaryKeys($configCategoryI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByConfigCategoryI18n() only accepts arguments of type \App\Propel\ConfigCategoryI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ConfigCategoryI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function joinConfigCategoryI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ConfigCategoryI18n');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ConfigCategoryI18n');
        }

        return $this;
    }

    /**
     * Use the ConfigCategoryI18n relation ConfigCategoryI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ConfigCategoryI18nQuery A secondary query class using the current class as primary query
     */
    public function useConfigCategoryI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinConfigCategoryI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ConfigCategoryI18n', '\App\Propel\ConfigCategoryI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildConfigCategory $configCategory Object to remove from the list of results
     *
     * @return $this|ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function prune($configCategory = null)
    {
        if ($configCategory) {
            $this->addUsingAlias(ConfigCategoryTableMap::COL_CONFIG_CATEGORY_ID, $configCategory->getConfigCategoryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the config_category table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigCategoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ConfigCategoryTableMap::clearInstancePool();
            ConfigCategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigCategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ConfigCategoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ConfigCategoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ConfigCategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'ConfigCategoryI18n';

        return $this
            ->joinConfigCategoryI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildConfigCategoryQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('ConfigCategoryI18n');
        $this->with['ConfigCategoryI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildConfigCategoryI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ConfigCategoryI18n', '\App\Propel\ConfigCategoryI18nQuery');
    }

} // ConfigCategoryQuery
