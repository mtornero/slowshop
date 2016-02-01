<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\PeriodicType as ChildPeriodicType;
use App\Propel\PeriodicTypeI18nQuery as ChildPeriodicTypeI18nQuery;
use App\Propel\PeriodicTypeQuery as ChildPeriodicTypeQuery;
use App\Propel\Map\PeriodicTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'periodic_type' table.
 *
 *
 *
 * @method     ChildPeriodicTypeQuery orderByPeriodicTypeId($order = Criteria::ASC) Order by the periodic_type_id column
 * @method     ChildPeriodicTypeQuery orderByPeriodicTypeCode($order = Criteria::ASC) Order by the periodic_type_code column
 * @method     ChildPeriodicTypeQuery orderByPeriodicTypeIsActive($order = Criteria::ASC) Order by the periodic_type_is_active column
 *
 * @method     ChildPeriodicTypeQuery groupByPeriodicTypeId() Group by the periodic_type_id column
 * @method     ChildPeriodicTypeQuery groupByPeriodicTypeCode() Group by the periodic_type_code column
 * @method     ChildPeriodicTypeQuery groupByPeriodicTypeIsActive() Group by the periodic_type_is_active column
 *
 * @method     ChildPeriodicTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPeriodicTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPeriodicTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPeriodicTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPeriodicTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPeriodicTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPeriodicTypeQuery leftJoinPeriodicPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the PeriodicPlan relation
 * @method     ChildPeriodicTypeQuery rightJoinPeriodicPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PeriodicPlan relation
 * @method     ChildPeriodicTypeQuery innerJoinPeriodicPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the PeriodicPlan relation
 *
 * @method     ChildPeriodicTypeQuery joinWithPeriodicPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PeriodicPlan relation
 *
 * @method     ChildPeriodicTypeQuery leftJoinWithPeriodicPlan() Adds a LEFT JOIN clause and with to the query using the PeriodicPlan relation
 * @method     ChildPeriodicTypeQuery rightJoinWithPeriodicPlan() Adds a RIGHT JOIN clause and with to the query using the PeriodicPlan relation
 * @method     ChildPeriodicTypeQuery innerJoinWithPeriodicPlan() Adds a INNER JOIN clause and with to the query using the PeriodicPlan relation
 *
 * @method     ChildPeriodicTypeQuery leftJoinPeriodicTypeI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the PeriodicTypeI18n relation
 * @method     ChildPeriodicTypeQuery rightJoinPeriodicTypeI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PeriodicTypeI18n relation
 * @method     ChildPeriodicTypeQuery innerJoinPeriodicTypeI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the PeriodicTypeI18n relation
 *
 * @method     ChildPeriodicTypeQuery joinWithPeriodicTypeI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PeriodicTypeI18n relation
 *
 * @method     ChildPeriodicTypeQuery leftJoinWithPeriodicTypeI18n() Adds a LEFT JOIN clause and with to the query using the PeriodicTypeI18n relation
 * @method     ChildPeriodicTypeQuery rightJoinWithPeriodicTypeI18n() Adds a RIGHT JOIN clause and with to the query using the PeriodicTypeI18n relation
 * @method     ChildPeriodicTypeQuery innerJoinWithPeriodicTypeI18n() Adds a INNER JOIN clause and with to the query using the PeriodicTypeI18n relation
 *
 * @method     \App\Propel\PeriodicPlanQuery|\App\Propel\PeriodicTypeI18nQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPeriodicType findOne(ConnectionInterface $con = null) Return the first ChildPeriodicType matching the query
 * @method     ChildPeriodicType findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPeriodicType matching the query, or a new ChildPeriodicType object populated from the query conditions when no match is found
 *
 * @method     ChildPeriodicType findOneByPeriodicTypeId(int $periodic_type_id) Return the first ChildPeriodicType filtered by the periodic_type_id column
 * @method     ChildPeriodicType findOneByPeriodicTypeCode(string $periodic_type_code) Return the first ChildPeriodicType filtered by the periodic_type_code column
 * @method     ChildPeriodicType findOneByPeriodicTypeIsActive(boolean $periodic_type_is_active) Return the first ChildPeriodicType filtered by the periodic_type_is_active column *

 * @method     ChildPeriodicType requirePk($key, ConnectionInterface $con = null) Return the ChildPeriodicType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicType requireOne(ConnectionInterface $con = null) Return the first ChildPeriodicType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPeriodicType requireOneByPeriodicTypeId(int $periodic_type_id) Return the first ChildPeriodicType filtered by the periodic_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicType requireOneByPeriodicTypeCode(string $periodic_type_code) Return the first ChildPeriodicType filtered by the periodic_type_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicType requireOneByPeriodicTypeIsActive(boolean $periodic_type_is_active) Return the first ChildPeriodicType filtered by the periodic_type_is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPeriodicType[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPeriodicType objects based on current ModelCriteria
 * @method     ChildPeriodicType[]|ObjectCollection findByPeriodicTypeId(int $periodic_type_id) Return ChildPeriodicType objects filtered by the periodic_type_id column
 * @method     ChildPeriodicType[]|ObjectCollection findByPeriodicTypeCode(string $periodic_type_code) Return ChildPeriodicType objects filtered by the periodic_type_code column
 * @method     ChildPeriodicType[]|ObjectCollection findByPeriodicTypeIsActive(boolean $periodic_type_is_active) Return ChildPeriodicType objects filtered by the periodic_type_is_active column
 * @method     ChildPeriodicType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PeriodicTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\PeriodicTypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\PeriodicType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPeriodicTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPeriodicTypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPeriodicTypeQuery) {
            return $criteria;
        }
        $query = new ChildPeriodicTypeQuery();
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
     * @return ChildPeriodicType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PeriodicTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PeriodicTypeTableMap::DATABASE_NAME);
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
     * @return ChildPeriodicType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT periodic_type_id, periodic_type_code, periodic_type_is_active FROM periodic_type WHERE periodic_type_id = :p0';
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
            /** @var ChildPeriodicType $obj */
            $obj = new ChildPeriodicType();
            $obj->hydrate($row);
            PeriodicTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPeriodicType|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the periodic_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodicTypeId(1234); // WHERE periodic_type_id = 1234
     * $query->filterByPeriodicTypeId(array(12, 34)); // WHERE periodic_type_id IN (12, 34)
     * $query->filterByPeriodicTypeId(array('min' => 12)); // WHERE periodic_type_id > 12
     * </code>
     *
     * @param     mixed $periodicTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function filterByPeriodicTypeId($periodicTypeId = null, $comparison = null)
    {
        if (is_array($periodicTypeId)) {
            $useMinMax = false;
            if (isset($periodicTypeId['min'])) {
                $this->addUsingAlias(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID, $periodicTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($periodicTypeId['max'])) {
                $this->addUsingAlias(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID, $periodicTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID, $periodicTypeId, $comparison);
    }

    /**
     * Filter the query on the periodic_type_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodicTypeCode('fooValue');   // WHERE periodic_type_code = 'fooValue'
     * $query->filterByPeriodicTypeCode('%fooValue%'); // WHERE periodic_type_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $periodicTypeCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function filterByPeriodicTypeCode($periodicTypeCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($periodicTypeCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $periodicTypeCode)) {
                $periodicTypeCode = str_replace('*', '%', $periodicTypeCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PeriodicTypeTableMap::COL_PERIODIC_TYPE_CODE, $periodicTypeCode, $comparison);
    }

    /**
     * Filter the query on the periodic_type_is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodicTypeIsActive(true); // WHERE periodic_type_is_active = true
     * $query->filterByPeriodicTypeIsActive('yes'); // WHERE periodic_type_is_active = true
     * </code>
     *
     * @param     boolean|string $periodicTypeIsActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function filterByPeriodicTypeIsActive($periodicTypeIsActive = null, $comparison = null)
    {
        if (is_string($periodicTypeIsActive)) {
            $periodicTypeIsActive = in_array(strtolower($periodicTypeIsActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PeriodicTypeTableMap::COL_PERIODIC_TYPE_IS_ACTIVE, $periodicTypeIsActive, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\PeriodicPlan object
     *
     * @param \App\Propel\PeriodicPlan|ObjectCollection $periodicPlan the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlan($periodicPlan, $comparison = null)
    {
        if ($periodicPlan instanceof \App\Propel\PeriodicPlan) {
            return $this
                ->addUsingAlias(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID, $periodicPlan->getPeriodicTypeId(), $comparison);
        } elseif ($periodicPlan instanceof ObjectCollection) {
            return $this
                ->usePeriodicPlanQuery()
                ->filterByPrimaryKeys($periodicPlan->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPeriodicPlan() only accepts arguments of type \App\Propel\PeriodicPlan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PeriodicPlan relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function joinPeriodicPlan($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PeriodicPlan');

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
            $this->addJoinObject($join, 'PeriodicPlan');
        }

        return $this;
    }

    /**
     * Use the PeriodicPlan relation PeriodicPlan object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\PeriodicPlanQuery A secondary query class using the current class as primary query
     */
    public function usePeriodicPlanQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPeriodicPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PeriodicPlan', '\App\Propel\PeriodicPlanQuery');
    }

    /**
     * Filter the query by a related \App\Propel\PeriodicTypeI18n object
     *
     * @param \App\Propel\PeriodicTypeI18n|ObjectCollection $periodicTypeI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function filterByPeriodicTypeI18n($periodicTypeI18n, $comparison = null)
    {
        if ($periodicTypeI18n instanceof \App\Propel\PeriodicTypeI18n) {
            return $this
                ->addUsingAlias(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID, $periodicTypeI18n->getPeriodicTypeId(), $comparison);
        } elseif ($periodicTypeI18n instanceof ObjectCollection) {
            return $this
                ->usePeriodicTypeI18nQuery()
                ->filterByPrimaryKeys($periodicTypeI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPeriodicTypeI18n() only accepts arguments of type \App\Propel\PeriodicTypeI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PeriodicTypeI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function joinPeriodicTypeI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PeriodicTypeI18n');

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
            $this->addJoinObject($join, 'PeriodicTypeI18n');
        }

        return $this;
    }

    /**
     * Use the PeriodicTypeI18n relation PeriodicTypeI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\PeriodicTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function usePeriodicTypeI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPeriodicTypeI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PeriodicTypeI18n', '\App\Propel\PeriodicTypeI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPeriodicType $periodicType Object to remove from the list of results
     *
     * @return $this|ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function prune($periodicType = null)
    {
        if ($periodicType) {
            $this->addUsingAlias(PeriodicTypeTableMap::COL_PERIODIC_TYPE_ID, $periodicType->getPeriodicTypeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the periodic_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PeriodicTypeTableMap::clearInstancePool();
            PeriodicTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PeriodicTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PeriodicTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PeriodicTypeTableMap::clearRelatedInstancePool();

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
     * @return    ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'PeriodicTypeI18n';

        return $this
            ->joinPeriodicTypeI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildPeriodicTypeQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('PeriodicTypeI18n');
        $this->with['PeriodicTypeI18n']->setIsWithOneToMany(false);

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
     * @return    ChildPeriodicTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PeriodicTypeI18n', '\App\Propel\PeriodicTypeI18nQuery');
    }

} // PeriodicTypeQuery
