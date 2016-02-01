<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\PeriodicPlan as ChildPeriodicPlan;
use App\Propel\PeriodicPlanQuery as ChildPeriodicPlanQuery;
use App\Propel\Map\PeriodicPlanTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'periodic_plan' table.
 *
 *
 *
 * @method     ChildPeriodicPlanQuery orderByPeriodicPlanId($order = Criteria::ASC) Order by the periodic_plan_id column
 * @method     ChildPeriodicPlanQuery orderByPeriodicPlanName($order = Criteria::ASC) Order by the periodic_plan_name column
 * @method     ChildPeriodicPlanQuery orderByPeriodicPlanPoint($order = Criteria::ASC) Order by the periodic_plan_point column
 * @method     ChildPeriodicPlanQuery orderByPeriodicTypeId($order = Criteria::ASC) Order by the periodic_type_id column
 * @method     ChildPeriodicPlanQuery orderByDelieveryPeriodicWeekday($order = Criteria::ASC) Order by the delievery_periodic_weekday column
 * @method     ChildPeriodicPlanQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPeriodicPlanQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPeriodicPlanQuery groupByPeriodicPlanId() Group by the periodic_plan_id column
 * @method     ChildPeriodicPlanQuery groupByPeriodicPlanName() Group by the periodic_plan_name column
 * @method     ChildPeriodicPlanQuery groupByPeriodicPlanPoint() Group by the periodic_plan_point column
 * @method     ChildPeriodicPlanQuery groupByPeriodicTypeId() Group by the periodic_type_id column
 * @method     ChildPeriodicPlanQuery groupByDelieveryPeriodicWeekday() Group by the delievery_periodic_weekday column
 * @method     ChildPeriodicPlanQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPeriodicPlanQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPeriodicPlanQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPeriodicPlanQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPeriodicPlanQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPeriodicPlanQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPeriodicPlanQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPeriodicPlanQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPeriodicPlanQuery leftJoinPeriodicType($relationAlias = null) Adds a LEFT JOIN clause to the query using the PeriodicType relation
 * @method     ChildPeriodicPlanQuery rightJoinPeriodicType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PeriodicType relation
 * @method     ChildPeriodicPlanQuery innerJoinPeriodicType($relationAlias = null) Adds a INNER JOIN clause to the query using the PeriodicType relation
 *
 * @method     ChildPeriodicPlanQuery joinWithPeriodicType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PeriodicType relation
 *
 * @method     ChildPeriodicPlanQuery leftJoinWithPeriodicType() Adds a LEFT JOIN clause and with to the query using the PeriodicType relation
 * @method     ChildPeriodicPlanQuery rightJoinWithPeriodicType() Adds a RIGHT JOIN clause and with to the query using the PeriodicType relation
 * @method     ChildPeriodicPlanQuery innerJoinWithPeriodicType() Adds a INNER JOIN clause and with to the query using the PeriodicType relation
 *
 * @method     ChildPeriodicPlanQuery leftJoinDeliveryPeriodic($relationAlias = null) Adds a LEFT JOIN clause to the query using the DeliveryPeriodic relation
 * @method     ChildPeriodicPlanQuery rightJoinDeliveryPeriodic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DeliveryPeriodic relation
 * @method     ChildPeriodicPlanQuery innerJoinDeliveryPeriodic($relationAlias = null) Adds a INNER JOIN clause to the query using the DeliveryPeriodic relation
 *
 * @method     ChildPeriodicPlanQuery joinWithDeliveryPeriodic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DeliveryPeriodic relation
 *
 * @method     ChildPeriodicPlanQuery leftJoinWithDeliveryPeriodic() Adds a LEFT JOIN clause and with to the query using the DeliveryPeriodic relation
 * @method     ChildPeriodicPlanQuery rightJoinWithDeliveryPeriodic() Adds a RIGHT JOIN clause and with to the query using the DeliveryPeriodic relation
 * @method     ChildPeriodicPlanQuery innerJoinWithDeliveryPeriodic() Adds a INNER JOIN clause and with to the query using the DeliveryPeriodic relation
 *
 * @method     ChildPeriodicPlanQuery leftJoinPeriodicPlanException($relationAlias = null) Adds a LEFT JOIN clause to the query using the PeriodicPlanException relation
 * @method     ChildPeriodicPlanQuery rightJoinPeriodicPlanException($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PeriodicPlanException relation
 * @method     ChildPeriodicPlanQuery innerJoinPeriodicPlanException($relationAlias = null) Adds a INNER JOIN clause to the query using the PeriodicPlanException relation
 *
 * @method     ChildPeriodicPlanQuery joinWithPeriodicPlanException($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PeriodicPlanException relation
 *
 * @method     ChildPeriodicPlanQuery leftJoinWithPeriodicPlanException() Adds a LEFT JOIN clause and with to the query using the PeriodicPlanException relation
 * @method     ChildPeriodicPlanQuery rightJoinWithPeriodicPlanException() Adds a RIGHT JOIN clause and with to the query using the PeriodicPlanException relation
 * @method     ChildPeriodicPlanQuery innerJoinWithPeriodicPlanException() Adds a INNER JOIN clause and with to the query using the PeriodicPlanException relation
 *
 * @method     ChildPeriodicPlanQuery leftJoinUserPeriodicPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserPeriodicPlan relation
 * @method     ChildPeriodicPlanQuery rightJoinUserPeriodicPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserPeriodicPlan relation
 * @method     ChildPeriodicPlanQuery innerJoinUserPeriodicPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the UserPeriodicPlan relation
 *
 * @method     ChildPeriodicPlanQuery joinWithUserPeriodicPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserPeriodicPlan relation
 *
 * @method     ChildPeriodicPlanQuery leftJoinWithUserPeriodicPlan() Adds a LEFT JOIN clause and with to the query using the UserPeriodicPlan relation
 * @method     ChildPeriodicPlanQuery rightJoinWithUserPeriodicPlan() Adds a RIGHT JOIN clause and with to the query using the UserPeriodicPlan relation
 * @method     ChildPeriodicPlanQuery innerJoinWithUserPeriodicPlan() Adds a INNER JOIN clause and with to the query using the UserPeriodicPlan relation
 *
 * @method     \App\Propel\PeriodicTypeQuery|\App\Propel\DeliveryPeriodicQuery|\App\Propel\PeriodicPlanExceptionQuery|\App\Propel\UserPeriodicPlanQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPeriodicPlan findOne(ConnectionInterface $con = null) Return the first ChildPeriodicPlan matching the query
 * @method     ChildPeriodicPlan findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPeriodicPlan matching the query, or a new ChildPeriodicPlan object populated from the query conditions when no match is found
 *
 * @method     ChildPeriodicPlan findOneByPeriodicPlanId(int $periodic_plan_id) Return the first ChildPeriodicPlan filtered by the periodic_plan_id column
 * @method     ChildPeriodicPlan findOneByPeriodicPlanName(string $periodic_plan_name) Return the first ChildPeriodicPlan filtered by the periodic_plan_name column
 * @method     ChildPeriodicPlan findOneByPeriodicPlanPoint(string $periodic_plan_point) Return the first ChildPeriodicPlan filtered by the periodic_plan_point column
 * @method     ChildPeriodicPlan findOneByPeriodicTypeId(int $periodic_type_id) Return the first ChildPeriodicPlan filtered by the periodic_type_id column
 * @method     ChildPeriodicPlan findOneByDelieveryPeriodicWeekday(int $delievery_periodic_weekday) Return the first ChildPeriodicPlan filtered by the delievery_periodic_weekday column
 * @method     ChildPeriodicPlan findOneByCreatedAt(string $created_at) Return the first ChildPeriodicPlan filtered by the created_at column
 * @method     ChildPeriodicPlan findOneByUpdatedAt(string $updated_at) Return the first ChildPeriodicPlan filtered by the updated_at column *

 * @method     ChildPeriodicPlan requirePk($key, ConnectionInterface $con = null) Return the ChildPeriodicPlan by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlan requireOne(ConnectionInterface $con = null) Return the first ChildPeriodicPlan matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPeriodicPlan requireOneByPeriodicPlanId(int $periodic_plan_id) Return the first ChildPeriodicPlan filtered by the periodic_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlan requireOneByPeriodicPlanName(string $periodic_plan_name) Return the first ChildPeriodicPlan filtered by the periodic_plan_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlan requireOneByPeriodicPlanPoint(string $periodic_plan_point) Return the first ChildPeriodicPlan filtered by the periodic_plan_point column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlan requireOneByPeriodicTypeId(int $periodic_type_id) Return the first ChildPeriodicPlan filtered by the periodic_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlan requireOneByDelieveryPeriodicWeekday(int $delievery_periodic_weekday) Return the first ChildPeriodicPlan filtered by the delievery_periodic_weekday column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlan requireOneByCreatedAt(string $created_at) Return the first ChildPeriodicPlan filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlan requireOneByUpdatedAt(string $updated_at) Return the first ChildPeriodicPlan filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPeriodicPlan[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPeriodicPlan objects based on current ModelCriteria
 * @method     ChildPeriodicPlan[]|ObjectCollection findByPeriodicPlanId(int $periodic_plan_id) Return ChildPeriodicPlan objects filtered by the periodic_plan_id column
 * @method     ChildPeriodicPlan[]|ObjectCollection findByPeriodicPlanName(string $periodic_plan_name) Return ChildPeriodicPlan objects filtered by the periodic_plan_name column
 * @method     ChildPeriodicPlan[]|ObjectCollection findByPeriodicPlanPoint(string $periodic_plan_point) Return ChildPeriodicPlan objects filtered by the periodic_plan_point column
 * @method     ChildPeriodicPlan[]|ObjectCollection findByPeriodicTypeId(int $periodic_type_id) Return ChildPeriodicPlan objects filtered by the periodic_type_id column
 * @method     ChildPeriodicPlan[]|ObjectCollection findByDelieveryPeriodicWeekday(int $delievery_periodic_weekday) Return ChildPeriodicPlan objects filtered by the delievery_periodic_weekday column
 * @method     ChildPeriodicPlan[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPeriodicPlan objects filtered by the created_at column
 * @method     ChildPeriodicPlan[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPeriodicPlan objects filtered by the updated_at column
 * @method     ChildPeriodicPlan[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PeriodicPlanQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\PeriodicPlanQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\PeriodicPlan', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPeriodicPlanQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPeriodicPlanQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPeriodicPlanQuery) {
            return $criteria;
        }
        $query = new ChildPeriodicPlanQuery();
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
     * @return ChildPeriodicPlan|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PeriodicPlanTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PeriodicPlanTableMap::DATABASE_NAME);
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
     * @return ChildPeriodicPlan A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT periodic_plan_id, periodic_plan_name, periodic_plan_point, periodic_type_id, delievery_periodic_weekday, created_at, updated_at FROM periodic_plan WHERE periodic_plan_id = :p0';
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
            /** @var ChildPeriodicPlan $obj */
            $obj = new ChildPeriodicPlan();
            $obj->hydrate($row);
            PeriodicPlanTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPeriodicPlan|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the periodic_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodicPlanId(1234); // WHERE periodic_plan_id = 1234
     * $query->filterByPeriodicPlanId(array(12, 34)); // WHERE periodic_plan_id IN (12, 34)
     * $query->filterByPeriodicPlanId(array('min' => 12)); // WHERE periodic_plan_id > 12
     * </code>
     *
     * @param     mixed $periodicPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlanId($periodicPlanId = null, $comparison = null)
    {
        if (is_array($periodicPlanId)) {
            $useMinMax = false;
            if (isset($periodicPlanId['min'])) {
                $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $periodicPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($periodicPlanId['max'])) {
                $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $periodicPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $periodicPlanId, $comparison);
    }

    /**
     * Filter the query on the periodic_plan_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodicPlanName('fooValue');   // WHERE periodic_plan_name = 'fooValue'
     * $query->filterByPeriodicPlanName('%fooValue%'); // WHERE periodic_plan_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $periodicPlanName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlanName($periodicPlanName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($periodicPlanName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $periodicPlanName)) {
                $periodicPlanName = str_replace('*', '%', $periodicPlanName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_NAME, $periodicPlanName, $comparison);
    }

    /**
     * Filter the query on the periodic_plan_point column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodicPlanPoint('fooValue');   // WHERE periodic_plan_point = 'fooValue'
     * $query->filterByPeriodicPlanPoint('%fooValue%'); // WHERE periodic_plan_point LIKE '%fooValue%'
     * </code>
     *
     * @param     string $periodicPlanPoint The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlanPoint($periodicPlanPoint = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($periodicPlanPoint)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $periodicPlanPoint)) {
                $periodicPlanPoint = str_replace('*', '%', $periodicPlanPoint);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_POINT, $periodicPlanPoint, $comparison);
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
     * @see       filterByPeriodicType()
     *
     * @param     mixed $periodicTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPeriodicTypeId($periodicTypeId = null, $comparison = null)
    {
        if (is_array($periodicTypeId)) {
            $useMinMax = false;
            if (isset($periodicTypeId['min'])) {
                $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID, $periodicTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($periodicTypeId['max'])) {
                $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID, $periodicTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID, $periodicTypeId, $comparison);
    }

    /**
     * Filter the query on the delievery_periodic_weekday column
     *
     * Example usage:
     * <code>
     * $query->filterByDelieveryPeriodicWeekday(1234); // WHERE delievery_periodic_weekday = 1234
     * $query->filterByDelieveryPeriodicWeekday(array(12, 34)); // WHERE delievery_periodic_weekday IN (12, 34)
     * $query->filterByDelieveryPeriodicWeekday(array('min' => 12)); // WHERE delievery_periodic_weekday > 12
     * </code>
     *
     * @param     mixed $delieveryPeriodicWeekday The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByDelieveryPeriodicWeekday($delieveryPeriodicWeekday = null, $comparison = null)
    {
        if (is_array($delieveryPeriodicWeekday)) {
            $useMinMax = false;
            if (isset($delieveryPeriodicWeekday['min'])) {
                $this->addUsingAlias(PeriodicPlanTableMap::COL_DELIEVERY_PERIODIC_WEEKDAY, $delieveryPeriodicWeekday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($delieveryPeriodicWeekday['max'])) {
                $this->addUsingAlias(PeriodicPlanTableMap::COL_DELIEVERY_PERIODIC_WEEKDAY, $delieveryPeriodicWeekday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicPlanTableMap::COL_DELIEVERY_PERIODIC_WEEKDAY, $delieveryPeriodicWeekday, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PeriodicPlanTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PeriodicPlanTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicPlanTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PeriodicPlanTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PeriodicPlanTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicPlanTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\PeriodicType object
     *
     * @param \App\Propel\PeriodicType|ObjectCollection $periodicType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPeriodicType($periodicType, $comparison = null)
    {
        if ($periodicType instanceof \App\Propel\PeriodicType) {
            return $this
                ->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID, $periodicType->getPeriodicTypeId(), $comparison);
        } elseif ($periodicType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_TYPE_ID, $periodicType->toKeyValue('PrimaryKey', 'PeriodicTypeId'), $comparison);
        } else {
            throw new PropelException('filterByPeriodicType() only accepts arguments of type \App\Propel\PeriodicType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PeriodicType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function joinPeriodicType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PeriodicType');

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
            $this->addJoinObject($join, 'PeriodicType');
        }

        return $this;
    }

    /**
     * Use the PeriodicType relation PeriodicType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\PeriodicTypeQuery A secondary query class using the current class as primary query
     */
    public function usePeriodicTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPeriodicType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PeriodicType', '\App\Propel\PeriodicTypeQuery');
    }

    /**
     * Filter the query by a related \App\Propel\DeliveryPeriodic object
     *
     * @param \App\Propel\DeliveryPeriodic|ObjectCollection $deliveryPeriodic the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByDeliveryPeriodic($deliveryPeriodic, $comparison = null)
    {
        if ($deliveryPeriodic instanceof \App\Propel\DeliveryPeriodic) {
            return $this
                ->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $deliveryPeriodic->getDeliveryPeriodicPlanId(), $comparison);
        } elseif ($deliveryPeriodic instanceof ObjectCollection) {
            return $this
                ->useDeliveryPeriodicQuery()
                ->filterByPrimaryKeys($deliveryPeriodic->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDeliveryPeriodic() only accepts arguments of type \App\Propel\DeliveryPeriodic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DeliveryPeriodic relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function joinDeliveryPeriodic($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DeliveryPeriodic');

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
            $this->addJoinObject($join, 'DeliveryPeriodic');
        }

        return $this;
    }

    /**
     * Use the DeliveryPeriodic relation DeliveryPeriodic object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\DeliveryPeriodicQuery A secondary query class using the current class as primary query
     */
    public function useDeliveryPeriodicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDeliveryPeriodic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DeliveryPeriodic', '\App\Propel\DeliveryPeriodicQuery');
    }

    /**
     * Filter the query by a related \App\Propel\PeriodicPlanException object
     *
     * @param \App\Propel\PeriodicPlanException|ObjectCollection $periodicPlanException the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlanException($periodicPlanException, $comparison = null)
    {
        if ($periodicPlanException instanceof \App\Propel\PeriodicPlanException) {
            return $this
                ->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $periodicPlanException->getPeriodicPlanId(), $comparison);
        } elseif ($periodicPlanException instanceof ObjectCollection) {
            return $this
                ->usePeriodicPlanExceptionQuery()
                ->filterByPrimaryKeys($periodicPlanException->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPeriodicPlanException() only accepts arguments of type \App\Propel\PeriodicPlanException or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PeriodicPlanException relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function joinPeriodicPlanException($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PeriodicPlanException');

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
            $this->addJoinObject($join, 'PeriodicPlanException');
        }

        return $this;
    }

    /**
     * Use the PeriodicPlanException relation PeriodicPlanException object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\PeriodicPlanExceptionQuery A secondary query class using the current class as primary query
     */
    public function usePeriodicPlanExceptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPeriodicPlanException($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PeriodicPlanException', '\App\Propel\PeriodicPlanExceptionQuery');
    }

    /**
     * Filter the query by a related \App\Propel\UserPeriodicPlan object
     *
     * @param \App\Propel\UserPeriodicPlan|ObjectCollection $userPeriodicPlan the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByUserPeriodicPlan($userPeriodicPlan, $comparison = null)
    {
        if ($userPeriodicPlan instanceof \App\Propel\UserPeriodicPlan) {
            return $this
                ->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $userPeriodicPlan->getPeriodicPlanId(), $comparison);
        } elseif ($userPeriodicPlan instanceof ObjectCollection) {
            return $this
                ->useUserPeriodicPlanQuery()
                ->filterByPrimaryKeys($userPeriodicPlan->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserPeriodicPlan() only accepts arguments of type \App\Propel\UserPeriodicPlan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserPeriodicPlan relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function joinUserPeriodicPlan($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserPeriodicPlan');

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
            $this->addJoinObject($join, 'UserPeriodicPlan');
        }

        return $this;
    }

    /**
     * Use the UserPeriodicPlan relation UserPeriodicPlan object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\UserPeriodicPlanQuery A secondary query class using the current class as primary query
     */
    public function useUserPeriodicPlanQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserPeriodicPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserPeriodicPlan', '\App\Propel\UserPeriodicPlanQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPeriodicPlan $periodicPlan Object to remove from the list of results
     *
     * @return $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function prune($periodicPlan = null)
    {
        if ($periodicPlan) {
            $this->addUsingAlias(PeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $periodicPlan->getPeriodicPlanId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the periodic_plan table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicPlanTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PeriodicPlanTableMap::clearInstancePool();
            PeriodicPlanTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicPlanTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PeriodicPlanTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PeriodicPlanTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PeriodicPlanTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PeriodicPlanTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PeriodicPlanTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PeriodicPlanTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PeriodicPlanTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PeriodicPlanTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildPeriodicPlanQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PeriodicPlanTableMap::COL_CREATED_AT);
    }

} // PeriodicPlanQuery
