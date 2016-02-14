<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\ConfigI18n as ChildConfigI18n;
use App\Propel\ConfigI18nQuery as ChildConfigI18nQuery;
use App\Propel\Map\ConfigI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'config_i18n' table.
 *
 *
 *
 * @method     ChildConfigI18nQuery orderByConfigId($order = Criteria::ASC) Order by the config_id column
 * @method     ChildConfigI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildConfigI18nQuery orderByConfigName($order = Criteria::ASC) Order by the config_name column
 * @method     ChildConfigI18nQuery orderByConfigDescription($order = Criteria::ASC) Order by the config_description column
 *
 * @method     ChildConfigI18nQuery groupByConfigId() Group by the config_id column
 * @method     ChildConfigI18nQuery groupByLocale() Group by the locale column
 * @method     ChildConfigI18nQuery groupByConfigName() Group by the config_name column
 * @method     ChildConfigI18nQuery groupByConfigDescription() Group by the config_description column
 *
 * @method     ChildConfigI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildConfigI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildConfigI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildConfigI18nQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildConfigI18nQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildConfigI18nQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildConfigI18nQuery leftJoinConfig($relationAlias = null) Adds a LEFT JOIN clause to the query using the Config relation
 * @method     ChildConfigI18nQuery rightJoinConfig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Config relation
 * @method     ChildConfigI18nQuery innerJoinConfig($relationAlias = null) Adds a INNER JOIN clause to the query using the Config relation
 *
 * @method     ChildConfigI18nQuery joinWithConfig($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Config relation
 *
 * @method     ChildConfigI18nQuery leftJoinWithConfig() Adds a LEFT JOIN clause and with to the query using the Config relation
 * @method     ChildConfigI18nQuery rightJoinWithConfig() Adds a RIGHT JOIN clause and with to the query using the Config relation
 * @method     ChildConfigI18nQuery innerJoinWithConfig() Adds a INNER JOIN clause and with to the query using the Config relation
 *
 * @method     \App\Propel\ConfigQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildConfigI18n findOne(ConnectionInterface $con = null) Return the first ChildConfigI18n matching the query
 * @method     ChildConfigI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildConfigI18n matching the query, or a new ChildConfigI18n object populated from the query conditions when no match is found
 *
 * @method     ChildConfigI18n findOneByConfigId(int $config_id) Return the first ChildConfigI18n filtered by the config_id column
 * @method     ChildConfigI18n findOneByLocale(string $locale) Return the first ChildConfigI18n filtered by the locale column
 * @method     ChildConfigI18n findOneByConfigName(string $config_name) Return the first ChildConfigI18n filtered by the config_name column
 * @method     ChildConfigI18n findOneByConfigDescription(string $config_description) Return the first ChildConfigI18n filtered by the config_description column *

 * @method     ChildConfigI18n requirePk($key, ConnectionInterface $con = null) Return the ChildConfigI18n by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigI18n requireOne(ConnectionInterface $con = null) Return the first ChildConfigI18n matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfigI18n requireOneByConfigId(int $config_id) Return the first ChildConfigI18n filtered by the config_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigI18n requireOneByLocale(string $locale) Return the first ChildConfigI18n filtered by the locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigI18n requireOneByConfigName(string $config_name) Return the first ChildConfigI18n filtered by the config_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigI18n requireOneByConfigDescription(string $config_description) Return the first ChildConfigI18n filtered by the config_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfigI18n[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildConfigI18n objects based on current ModelCriteria
 * @method     ChildConfigI18n[]|ObjectCollection findByConfigId(int $config_id) Return ChildConfigI18n objects filtered by the config_id column
 * @method     ChildConfigI18n[]|ObjectCollection findByLocale(string $locale) Return ChildConfigI18n objects filtered by the locale column
 * @method     ChildConfigI18n[]|ObjectCollection findByConfigName(string $config_name) Return ChildConfigI18n objects filtered by the config_name column
 * @method     ChildConfigI18n[]|ObjectCollection findByConfigDescription(string $config_description) Return ChildConfigI18n objects filtered by the config_description column
 * @method     ChildConfigI18n[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ConfigI18nQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ConfigI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\ConfigI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildConfigI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildConfigI18nQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildConfigI18nQuery) {
            return $criteria;
        }
        $query = new ChildConfigI18nQuery();
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
     * @param array[$config_id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildConfigI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ConfigI18nTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ConfigI18nTableMap::DATABASE_NAME);
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
     * @return ChildConfigI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT config_id, locale, config_name, config_description FROM config_i18n WHERE config_id = :p0 AND locale = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildConfigI18n $obj */
            $obj = new ChildConfigI18n();
            $obj->hydrate($row);
            ConfigI18nTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildConfigI18n|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildConfigI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ConfigI18nTableMap::COL_CONFIG_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ConfigI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildConfigI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ConfigI18nTableMap::COL_CONFIG_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ConfigI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildConfigI18nQuery The current query, for fluid interface
     */
    public function filterByConfigId($configId = null, $comparison = null)
    {
        if (is_array($configId)) {
            $useMinMax = false;
            if (isset($configId['min'])) {
                $this->addUsingAlias(ConfigI18nTableMap::COL_CONFIG_ID, $configId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($configId['max'])) {
                $this->addUsingAlias(ConfigI18nTableMap::COL_CONFIG_ID, $configId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConfigI18nTableMap::COL_CONFIG_ID, $configId, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigI18nTableMap::COL_LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the config_name column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigName('fooValue');   // WHERE config_name = 'fooValue'
     * $query->filterByConfigName('%fooValue%'); // WHERE config_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigI18nQuery The current query, for fluid interface
     */
    public function filterByConfigName($configName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configName)) {
                $configName = str_replace('*', '%', $configName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigI18nTableMap::COL_CONFIG_NAME, $configName, $comparison);
    }

    /**
     * Filter the query on the config_description column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigDescription('fooValue');   // WHERE config_description = 'fooValue'
     * $query->filterByConfigDescription('%fooValue%'); // WHERE config_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configDescription The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigI18nQuery The current query, for fluid interface
     */
    public function filterByConfigDescription($configDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configDescription)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configDescription)) {
                $configDescription = str_replace('*', '%', $configDescription);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigI18nTableMap::COL_CONFIG_DESCRIPTION, $configDescription, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Config object
     *
     * @param \App\Propel\Config|ObjectCollection $config The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildConfigI18nQuery The current query, for fluid interface
     */
    public function filterByConfig($config, $comparison = null)
    {
        if ($config instanceof \App\Propel\Config) {
            return $this
                ->addUsingAlias(ConfigI18nTableMap::COL_CONFIG_ID, $config->getConfigId(), $comparison);
        } elseif ($config instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ConfigI18nTableMap::COL_CONFIG_ID, $config->toKeyValue('PrimaryKey', 'ConfigId'), $comparison);
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
     * @return $this|ChildConfigI18nQuery The current query, for fluid interface
     */
    public function joinConfig($relationAlias = null, $joinType = 'LEFT JOIN')
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
    public function useConfigQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinConfig($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Config', '\App\Propel\ConfigQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildConfigI18n $configI18n Object to remove from the list of results
     *
     * @return $this|ChildConfigI18nQuery The current query, for fluid interface
     */
    public function prune($configI18n = null)
    {
        if ($configI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ConfigI18nTableMap::COL_CONFIG_ID), $configI18n->getConfigId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ConfigI18nTableMap::COL_LOCALE), $configI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the config_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigI18nTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ConfigI18nTableMap::clearInstancePool();
            ConfigI18nTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ConfigI18nTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ConfigI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ConfigI18nTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ConfigI18nQuery
