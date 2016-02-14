<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\ConfigCategoryI18n as ChildConfigCategoryI18n;
use App\Propel\ConfigCategoryI18nQuery as ChildConfigCategoryI18nQuery;
use App\Propel\Map\ConfigCategoryI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'config_category_i18n' table.
 *
 *
 *
 * @method     ChildConfigCategoryI18nQuery orderByConfigCategoryId($order = Criteria::ASC) Order by the config_category_id column
 * @method     ChildConfigCategoryI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildConfigCategoryI18nQuery orderByConfigCategoryName($order = Criteria::ASC) Order by the config_category_name column
 * @method     ChildConfigCategoryI18nQuery orderByConfigCategoryDescription($order = Criteria::ASC) Order by the config_category_description column
 *
 * @method     ChildConfigCategoryI18nQuery groupByConfigCategoryId() Group by the config_category_id column
 * @method     ChildConfigCategoryI18nQuery groupByLocale() Group by the locale column
 * @method     ChildConfigCategoryI18nQuery groupByConfigCategoryName() Group by the config_category_name column
 * @method     ChildConfigCategoryI18nQuery groupByConfigCategoryDescription() Group by the config_category_description column
 *
 * @method     ChildConfigCategoryI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildConfigCategoryI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildConfigCategoryI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildConfigCategoryI18nQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildConfigCategoryI18nQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildConfigCategoryI18nQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildConfigCategoryI18nQuery leftJoinConfigCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ConfigCategory relation
 * @method     ChildConfigCategoryI18nQuery rightJoinConfigCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ConfigCategory relation
 * @method     ChildConfigCategoryI18nQuery innerJoinConfigCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the ConfigCategory relation
 *
 * @method     ChildConfigCategoryI18nQuery joinWithConfigCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ConfigCategory relation
 *
 * @method     ChildConfigCategoryI18nQuery leftJoinWithConfigCategory() Adds a LEFT JOIN clause and with to the query using the ConfigCategory relation
 * @method     ChildConfigCategoryI18nQuery rightJoinWithConfigCategory() Adds a RIGHT JOIN clause and with to the query using the ConfigCategory relation
 * @method     ChildConfigCategoryI18nQuery innerJoinWithConfigCategory() Adds a INNER JOIN clause and with to the query using the ConfigCategory relation
 *
 * @method     \App\Propel\ConfigCategoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildConfigCategoryI18n findOne(ConnectionInterface $con = null) Return the first ChildConfigCategoryI18n matching the query
 * @method     ChildConfigCategoryI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildConfigCategoryI18n matching the query, or a new ChildConfigCategoryI18n object populated from the query conditions when no match is found
 *
 * @method     ChildConfigCategoryI18n findOneByConfigCategoryId(int $config_category_id) Return the first ChildConfigCategoryI18n filtered by the config_category_id column
 * @method     ChildConfigCategoryI18n findOneByLocale(string $locale) Return the first ChildConfigCategoryI18n filtered by the locale column
 * @method     ChildConfigCategoryI18n findOneByConfigCategoryName(string $config_category_name) Return the first ChildConfigCategoryI18n filtered by the config_category_name column
 * @method     ChildConfigCategoryI18n findOneByConfigCategoryDescription(string $config_category_description) Return the first ChildConfigCategoryI18n filtered by the config_category_description column *

 * @method     ChildConfigCategoryI18n requirePk($key, ConnectionInterface $con = null) Return the ChildConfigCategoryI18n by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigCategoryI18n requireOne(ConnectionInterface $con = null) Return the first ChildConfigCategoryI18n matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfigCategoryI18n requireOneByConfigCategoryId(int $config_category_id) Return the first ChildConfigCategoryI18n filtered by the config_category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigCategoryI18n requireOneByLocale(string $locale) Return the first ChildConfigCategoryI18n filtered by the locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigCategoryI18n requireOneByConfigCategoryName(string $config_category_name) Return the first ChildConfigCategoryI18n filtered by the config_category_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfigCategoryI18n requireOneByConfigCategoryDescription(string $config_category_description) Return the first ChildConfigCategoryI18n filtered by the config_category_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfigCategoryI18n[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildConfigCategoryI18n objects based on current ModelCriteria
 * @method     ChildConfigCategoryI18n[]|ObjectCollection findByConfigCategoryId(int $config_category_id) Return ChildConfigCategoryI18n objects filtered by the config_category_id column
 * @method     ChildConfigCategoryI18n[]|ObjectCollection findByLocale(string $locale) Return ChildConfigCategoryI18n objects filtered by the locale column
 * @method     ChildConfigCategoryI18n[]|ObjectCollection findByConfigCategoryName(string $config_category_name) Return ChildConfigCategoryI18n objects filtered by the config_category_name column
 * @method     ChildConfigCategoryI18n[]|ObjectCollection findByConfigCategoryDescription(string $config_category_description) Return ChildConfigCategoryI18n objects filtered by the config_category_description column
 * @method     ChildConfigCategoryI18n[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ConfigCategoryI18nQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ConfigCategoryI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\ConfigCategoryI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildConfigCategoryI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildConfigCategoryI18nQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildConfigCategoryI18nQuery) {
            return $criteria;
        }
        $query = new ChildConfigCategoryI18nQuery();
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
     * @param array[$config_category_id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildConfigCategoryI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ConfigCategoryI18nTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ConfigCategoryI18nTableMap::DATABASE_NAME);
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
     * @return ChildConfigCategoryI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT config_category_id, locale, config_category_name, config_category_description FROM config_category_i18n WHERE config_category_id = :p0 AND locale = :p1';
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
            /** @var ChildConfigCategoryI18n $obj */
            $obj = new ChildConfigCategoryI18n();
            $obj->hydrate($row);
            ConfigCategoryI18nTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildConfigCategoryI18n|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildConfigCategoryI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ConfigCategoryI18nTableMap::COL_CONFIG_CATEGORY_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ConfigCategoryI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildConfigCategoryI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ConfigCategoryI18nTableMap::COL_CONFIG_CATEGORY_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ConfigCategoryI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByConfigCategory()
     *
     * @param     mixed $configCategoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigCategoryI18nQuery The current query, for fluid interface
     */
    public function filterByConfigCategoryId($configCategoryId = null, $comparison = null)
    {
        if (is_array($configCategoryId)) {
            $useMinMax = false;
            if (isset($configCategoryId['min'])) {
                $this->addUsingAlias(ConfigCategoryI18nTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($configCategoryId['max'])) {
                $this->addUsingAlias(ConfigCategoryI18nTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConfigCategoryI18nTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId, $comparison);
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
     * @return $this|ChildConfigCategoryI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ConfigCategoryI18nTableMap::COL_LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the config_category_name column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigCategoryName('fooValue');   // WHERE config_category_name = 'fooValue'
     * $query->filterByConfigCategoryName('%fooValue%'); // WHERE config_category_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configCategoryName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigCategoryI18nQuery The current query, for fluid interface
     */
    public function filterByConfigCategoryName($configCategoryName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configCategoryName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configCategoryName)) {
                $configCategoryName = str_replace('*', '%', $configCategoryName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigCategoryI18nTableMap::COL_CONFIG_CATEGORY_NAME, $configCategoryName, $comparison);
    }

    /**
     * Filter the query on the config_category_description column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigCategoryDescription('fooValue');   // WHERE config_category_description = 'fooValue'
     * $query->filterByConfigCategoryDescription('%fooValue%'); // WHERE config_category_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configCategoryDescription The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigCategoryI18nQuery The current query, for fluid interface
     */
    public function filterByConfigCategoryDescription($configCategoryDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configCategoryDescription)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configCategoryDescription)) {
                $configCategoryDescription = str_replace('*', '%', $configCategoryDescription);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigCategoryI18nTableMap::COL_CONFIG_CATEGORY_DESCRIPTION, $configCategoryDescription, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\ConfigCategory object
     *
     * @param \App\Propel\ConfigCategory|ObjectCollection $configCategory The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildConfigCategoryI18nQuery The current query, for fluid interface
     */
    public function filterByConfigCategory($configCategory, $comparison = null)
    {
        if ($configCategory instanceof \App\Propel\ConfigCategory) {
            return $this
                ->addUsingAlias(ConfigCategoryI18nTableMap::COL_CONFIG_CATEGORY_ID, $configCategory->getConfigCategoryId(), $comparison);
        } elseif ($configCategory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ConfigCategoryI18nTableMap::COL_CONFIG_CATEGORY_ID, $configCategory->toKeyValue('PrimaryKey', 'ConfigCategoryId'), $comparison);
        } else {
            throw new PropelException('filterByConfigCategory() only accepts arguments of type \App\Propel\ConfigCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ConfigCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildConfigCategoryI18nQuery The current query, for fluid interface
     */
    public function joinConfigCategory($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ConfigCategory');

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
            $this->addJoinObject($join, 'ConfigCategory');
        }

        return $this;
    }

    /**
     * Use the ConfigCategory relation ConfigCategory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ConfigCategoryQuery A secondary query class using the current class as primary query
     */
    public function useConfigCategoryQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinConfigCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ConfigCategory', '\App\Propel\ConfigCategoryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildConfigCategoryI18n $configCategoryI18n Object to remove from the list of results
     *
     * @return $this|ChildConfigCategoryI18nQuery The current query, for fluid interface
     */
    public function prune($configCategoryI18n = null)
    {
        if ($configCategoryI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ConfigCategoryI18nTableMap::COL_CONFIG_CATEGORY_ID), $configCategoryI18n->getConfigCategoryId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ConfigCategoryI18nTableMap::COL_LOCALE), $configCategoryI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the config_category_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigCategoryI18nTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ConfigCategoryI18nTableMap::clearInstancePool();
            ConfigCategoryI18nTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigCategoryI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ConfigCategoryI18nTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ConfigCategoryI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ConfigCategoryI18nTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ConfigCategoryI18nQuery
