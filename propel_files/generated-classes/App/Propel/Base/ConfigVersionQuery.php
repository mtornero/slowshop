<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\ConfigVersion as ChildConfigVersion;
use App\Propel\ConfigVersionQuery as ChildConfigVersionQuery;
use App\Propel\Map\ConfigVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'config_version' table.
 *
 *
 *
 * @method     ChildConfigVersionQuery orderByConfigId($order = Criteria::ASC) Order by the config_id column
 * @method     ChildConfigVersionQuery orderByConfigCategoryId($order = Criteria::ASC) Order by the config_category_id column
 * @method     ChildConfigVersionQuery orderByConfigKey($order = Criteria::ASC) Order by the config_key column
 * @method     ChildConfigVersionQuery orderByConfigValue($order = Criteria::ASC) Order by the config_value column
 * @method     ChildConfigVersionQuery orderByConfigFormat($order = Criteria::ASC) Order by the config_format column
 * @method     ChildConfigVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 *
 * @method     ChildConfigVersionQuery groupByConfigId() Group by the config_id column
 * @method     ChildConfigVersionQuery groupByConfigCategoryId() Group by the config_category_id column
 * @method     ChildConfigVersionQuery groupByConfigKey() Group by the config_key column
 * @method     ChildConfigVersionQuery groupByConfigValue() Group by the config_value column
 * @method     ChildConfigVersionQuery groupByConfigFormat() Group by the config_format column
 * @method     ChildConfigVersionQuery groupByVersion() Group by the version column
 *
 * @method     ChildConfigVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildConfigVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildConfigVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildConfigVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildConfigVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildConfigVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildConfigVersionQuery leftJoinConfig($relationAlias = null) Adds a LEFT JOIN clause to the query using the Config relation
 * @method     ChildConfigVersionQuery rightJoinConfig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Config relation
 * @method     ChildConfigVersionQuery innerJoinConfig($relationAlias = null) Adds a INNER JOIN clause to the query using the Config relation
 *
 * @method     ChildConfigVersionQuery joinWithConfig($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Config relation
 *
 * @method     ChildConfigVersionQuery leftJoinWithConfig() Adds a LEFT JOIN clause and with to the query using the Config relation
 * @method     ChildConfigVersionQuery rightJoinWithConfig() Adds a RIGHT JOIN clause and with to the query using the Config relation
 * @method     ChildConfigVersionQuery innerJoinWithConfig() Adds a INNER JOIN clause and with to the query using the Config relation
 *
 * @method     \App\Propel\ConfigQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildConfigVersion findOne(ConnectionInterface $con = null) Return the first ChildConfigVersion matching the query
 * @method     ChildConfigVersion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildConfigVersion matching the query, or a new ChildConfigVersion object populated from the query conditions when no match is found
 *
 * @method     ChildConfigVersion findOneByConfigId(int $config_id) Return the first ChildConfigVersion filtered by the config_id column
 * @method     ChildConfigVersion findOneByConfigCategoryId(int $config_category_id) Return the first ChildConfigVersion filtered by the config_category_id column
 * @method     ChildConfigVersion findOneByConfigKey(string $config_key) Return the first ChildConfigVersion filtered by the config_key column
 * @method     ChildConfigVersion findOneByConfigValue(string $config_value) Return the first ChildConfigVersion filtered by the config_value column
 * @method     ChildConfigVersion findOneByConfigFormat(string $config_format) Return the first ChildConfigVersion filtered by the config_format column
 * @method     ChildConfigVersion findOneByVersion(int $version) Return the first ChildConfigVersion filtered by the version column *

 * @method     ChildConfigVersion requirePk($key, ConnectionInterface $con = null) Return the ChildConfigVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigVersion requireOne(ConnectionInterface $con = null) Return the first ChildConfigVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfigVersion requireOneByConfigId(int $config_id) Return the first ChildConfigVersion filtered by the config_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigVersion requireOneByConfigCategoryId(int $config_category_id) Return the first ChildConfigVersion filtered by the config_category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigVersion requireOneByConfigKey(string $config_key) Return the first ChildConfigVersion filtered by the config_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigVersion requireOneByConfigValue(string $config_value) Return the first ChildConfigVersion filtered by the config_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigVersion requireOneByConfigFormat(string $config_format) Return the first ChildConfigVersion filtered by the config_format column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigVersion requireOneByVersion(int $version) Return the first ChildConfigVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfigVersion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildConfigVersion objects based on current ModelCriteria
 * @method     ChildConfigVersion[]|ObjectCollection findByConfigId(int $config_id) Return ChildConfigVersion objects filtered by the config_id column
 * @method     ChildConfigVersion[]|ObjectCollection findByConfigCategoryId(int $config_category_id) Return ChildConfigVersion objects filtered by the config_category_id column
 * @method     ChildConfigVersion[]|ObjectCollection findByConfigKey(string $config_key) Return ChildConfigVersion objects filtered by the config_key column
 * @method     ChildConfigVersion[]|ObjectCollection findByConfigValue(string $config_value) Return ChildConfigVersion objects filtered by the config_value column
 * @method     ChildConfigVersion[]|ObjectCollection findByConfigFormat(string $config_format) Return ChildConfigVersion objects filtered by the config_format column
 * @method     ChildConfigVersion[]|ObjectCollection findByVersion(int $version) Return ChildConfigVersion objects filtered by the version column
 * @method     ChildConfigVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ConfigVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ConfigVersionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\ConfigVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildConfigVersionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildConfigVersionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildConfigVersionQuery) {
            return $criteria;
        }
        $query = new ChildConfigVersionQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$config_id, $version] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildConfigVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ConfigVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ConfigVersionTableMap::DATABASE_NAME);
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
     * @return ChildConfigVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT config_id, config_category_id, config_key, config_value, config_format, version FROM config_version WHERE config_id = :p0 AND version = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildConfigVersion $obj */
            $obj = new ChildConfigVersion();
            $obj->hydrate($row);
            ConfigVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildConfigVersion|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildConfigVersionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ConfigVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildConfigVersionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ConfigVersionTableMap::COL_CONFIG_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ConfigVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the config_id column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigId(1234); // WHERE config_id = 1234
     * $query->filterByConfigId(array(12, 34)); // WHERE config_id IN (12, 34)
     * $query->filterByConfigId(array('min' => 12)); // WHERE config_id > 12
     * </code>
     *
     * @see       filterByConfig()
     *
     * @param     mixed $configId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigVersionQuery The current query, for fluid interface
     */
    public function filterByConfigId($configId = null, $comparison = null)
    {
        if (is_array($configId)) {
            $useMinMax = false;
            if (isset($configId['min'])) {
                $this->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_ID, $configId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($configId['max'])) {
                $this->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_ID, $configId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_ID, $configId, $comparison);
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
     * @return $this|ChildConfigVersionQuery The current query, for fluid interface
     */
    public function filterByConfigCategoryId($configCategoryId = null, $comparison = null)
    {
        if (is_array($configCategoryId)) {
            $useMinMax = false;
            if (isset($configCategoryId['min'])) {
                $this->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($configCategoryId['max'])) {
                $this->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId, $comparison);
    }

    /**
     * Filter the query on the config_key column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigKey('fooValue');   // WHERE config_key = 'fooValue'
     * $query->filterByConfigKey('%fooValue%'); // WHERE config_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigVersionQuery The current query, for fluid interface
     */
    public function filterByConfigKey($configKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configKey)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configKey)) {
                $configKey = str_replace('*', '%', $configKey);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_KEY, $configKey, $comparison);
    }

    /**
     * Filter the query on the config_value column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigValue('fooValue');   // WHERE config_value = 'fooValue'
     * $query->filterByConfigValue('%fooValue%'); // WHERE config_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configValue The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigVersionQuery The current query, for fluid interface
     */
    public function filterByConfigValue($configValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configValue)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configValue)) {
                $configValue = str_replace('*', '%', $configValue);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_VALUE, $configValue, $comparison);
    }

    /**
     * Filter the query on the config_format column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigFormat('fooValue');   // WHERE config_format = 'fooValue'
     * $query->filterByConfigFormat('%fooValue%'); // WHERE config_format LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configFormat The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigVersionQuery The current query, for fluid interface
     */
    public function filterByConfigFormat($configFormat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configFormat)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configFormat)) {
                $configFormat = str_replace('*', '%', $configFormat);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_FORMAT, $configFormat, $comparison);
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion(1234); // WHERE version = 1234
     * $query->filterByVersion(array(12, 34)); // WHERE version IN (12, 34)
     * $query->filterByVersion(array('min' => 12)); // WHERE version > 12
     * </code>
     *
     * @param     mixed $version The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigVersionQuery The current query, for fluid interface
     */
    public function filterByVersion($version = null, $comparison = null)
    {
        if (is_array($version)) {
            $useMinMax = false;
            if (isset($version['min'])) {
                $this->addUsingAlias(ConfigVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ConfigVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConfigVersionTableMap::COL_VERSION, $version, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Config object
     *
     * @param \App\Propel\Config|ObjectCollection $config The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildConfigVersionQuery The current query, for fluid interface
     */
    public function filterByConfig($config, $comparison = null)
    {
        if ($config instanceof \App\Propel\Config) {
            return $this
                ->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_ID, $config->getConfigId(), $comparison);
        } elseif ($config instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ConfigVersionTableMap::COL_CONFIG_ID, $config->toKeyValue('PrimaryKey', 'ConfigId'), $comparison);
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
     * @return $this|ChildConfigVersionQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildConfigVersion $configVersion Object to remove from the list of results
     *
     * @return $this|ChildConfigVersionQuery The current query, for fluid interface
     */
    public function prune($configVersion = null)
    {
        if ($configVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ConfigVersionTableMap::COL_CONFIG_ID), $configVersion->getConfigId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ConfigVersionTableMap::COL_VERSION), $configVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the config_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ConfigVersionTableMap::clearInstancePool();
            ConfigVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ConfigVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ConfigVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ConfigVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ConfigVersionQuery
