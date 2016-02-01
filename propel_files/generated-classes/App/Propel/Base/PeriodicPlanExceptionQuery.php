<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\PeriodicPlanException as ChildPeriodicPlanException;
use App\Propel\PeriodicPlanExceptionQuery as ChildPeriodicPlanExceptionQuery;
use App\Propel\Map\PeriodicPlanExceptionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'periodic_plan_exception' table.
 *
 *
 *
 * @method     ChildPeriodicPlanExceptionQuery orderByPeriodicPlanExceptionId($order = Criteria::ASC) Order by the periodic_plan_exception_id column
 * @method     ChildPeriodicPlanExceptionQuery orderByPeriodicPlanId($order = Criteria::ASC) Order by the periodic_plan_id column
 * @method     ChildPeriodicPlanExceptionQuery orderByPeriodicPlanExceptionType($order = Criteria::ASC) Order by the periodic_plan_exception_type column
 * @method     ChildPeriodicPlanExceptionQuery orderByPeriodicPlanExceptionDate($order = Criteria::ASC) Order by the periodic_plan_exception_date column
 * @method     ChildPeriodicPlanExceptionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPeriodicPlanExceptionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPeriodicPlanExceptionQuery groupByPeriodicPlanExceptionId() Group by the periodic_plan_exception_id column
 * @method     ChildPeriodicPlanExceptionQuery groupByPeriodicPlanId() Group by the periodic_plan_id column
 * @method     ChildPeriodicPlanExceptionQuery groupByPeriodicPlanExceptionType() Group by the periodic_plan_exception_type column
 * @method     ChildPeriodicPlanExceptionQuery groupByPeriodicPlanExceptionDate() Group by the periodic_plan_exception_date column
 * @method     ChildPeriodicPlanExceptionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPeriodicPlanExceptionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPeriodicPlanExceptionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPeriodicPlanExceptionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPeriodicPlanExceptionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPeriodicPlanExceptionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPeriodicPlanExceptionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPeriodicPlanExceptionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPeriodicPlanExceptionQuery leftJoinPeriodicPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the PeriodicPlan relation
 * @method     ChildPeriodicPlanExceptionQuery rightJoinPeriodicPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PeriodicPlan relation
 * @method     ChildPeriodicPlanExceptionQuery innerJoinPeriodicPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the PeriodicPlan relation
 *
 * @method     ChildPeriodicPlanExceptionQuery joinWithPeriodicPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PeriodicPlan relation
 *
 * @method     ChildPeriodicPlanExceptionQuery leftJoinWithPeriodicPlan() Adds a LEFT JOIN clause and with to the query using the PeriodicPlan relation
 * @method     ChildPeriodicPlanExceptionQuery rightJoinWithPeriodicPlan() Adds a RIGHT JOIN clause and with to the query using the PeriodicPlan relation
 * @method     ChildPeriodicPlanExceptionQuery innerJoinWithPeriodicPlan() Adds a INNER JOIN clause and with to the query using the PeriodicPlan relation
 *
 * @method     \App\Propel\PeriodicPlanQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPeriodicPlanException findOne(ConnectionInterface $con = null) Return the first ChildPeriodicPlanException matching the query
 * @method     ChildPeriodicPlanException findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPeriodicPlanException matching the query, or a new ChildPeriodicPlanException object populated from the query conditions when no match is found
 *
 * @method     ChildPeriodicPlanException findOneByPeriodicPlanExceptionId(int $periodic_plan_exception_id) Return the first ChildPeriodicPlanException filtered by the periodic_plan_exception_id column
 * @method     ChildPeriodicPlanException findOneByPeriodicPlanId(int $periodic_plan_id) Return the first ChildPeriodicPlanException filtered by the periodic_plan_id column
 * @method     ChildPeriodicPlanException findOneByPeriodicPlanExceptionType(boolean $periodic_plan_exception_type) Return the first ChildPeriodicPlanException filtered by the periodic_plan_exception_type column
 * @method     ChildPeriodicPlanException findOneByPeriodicPlanExceptionDate(string $periodic_plan_exception_date) Return the first ChildPeriodicPlanException filtered by the periodic_plan_exception_date column
 * @method     ChildPeriodicPlanException findOneByCreatedAt(string $created_at) Return the first ChildPeriodicPlanException filtered by the created_at column
 * @method     ChildPeriodicPlanException findOneByUpdatedAt(string $updated_at) Return the first ChildPeriodicPlanException filtered by the updated_at column *

 * @method     ChildPeriodicPlanException requirePk($key, ConnectionInterface $con = null) Return the ChildPeriodicPlanException by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlanException requireOne(ConnectionInterface $con = null) Return the first ChildPeriodicPlanException matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPeriodicPlanException requireOneByPeriodicPlanExceptionId(int $periodic_plan_exception_id) Return the first ChildPeriodicPlanException filtered by the periodic_plan_exception_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlanException requireOneByPeriodicPlanId(int $periodic_plan_id) Return the first ChildPeriodicPlanException filtered by the periodic_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlanException requireOneByPeriodicPlanExceptionType(boolean $periodic_plan_exception_type) Return the first ChildPeriodicPlanException filtered by the periodic_plan_exception_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlanException requireOneByPeriodicPlanExceptionDate(string $periodic_plan_exception_date) Return the first ChildPeriodicPlanException filtered by the periodic_plan_exception_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlanException requireOneByCreatedAt(string $created_at) Return the first ChildPeriodicPlanException filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPeriodicPlanException requireOneByUpdatedAt(string $updated_at) Return the first ChildPeriodicPlanException filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPeriodicPlanException[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPeriodicPlanException objects based on current ModelCriteria
 * @method     ChildPeriodicPlanException[]|ObjectCollection findByPeriodicPlanExceptionId(int $periodic_plan_exception_id) Return ChildPeriodicPlanException objects filtered by the periodic_plan_exception_id column
 * @method     ChildPeriodicPlanException[]|ObjectCollection findByPeriodicPlanId(int $periodic_plan_id) Return ChildPeriodicPlanException objects filtered by the periodic_plan_id column
 * @method     ChildPeriodicPlanException[]|ObjectCollection findByPeriodicPlanExceptionType(boolean $periodic_plan_exception_type) Return ChildPeriodicPlanException objects filtered by the periodic_plan_exception_type column
 * @method     ChildPeriodicPlanException[]|ObjectCollection findByPeriodicPlanExceptionDate(string $periodic_plan_exception_date) Return ChildPeriodicPlanException objects filtered by the periodic_plan_exception_date column
 * @method     ChildPeriodicPlanException[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPeriodicPlanException objects filtered by the created_at column
 * @method     ChildPeriodicPlanException[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPeriodicPlanException objects filtered by the updated_at column
 * @method     ChildPeriodicPlanException[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PeriodicPlanExceptionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\PeriodicPlanExceptionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\PeriodicPlanException', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPeriodicPlanExceptionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPeriodicPlanExceptionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPeriodicPlanExceptionQuery) {
            return $criteria;
        }
        $query = new ChildPeriodicPlanExceptionQuery();
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
     * @return ChildPeriodicPlanException|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PeriodicPlanExceptionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PeriodicPlanExceptionTableMap::DATABASE_NAME);
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
     * @return ChildPeriodicPlanException A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT periodic_plan_exception_id, periodic_plan_id, periodic_plan_exception_type, periodic_plan_exception_date, created_at, updated_at FROM periodic_plan_exception WHERE periodic_plan_exception_id = :p0';
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
            /** @var ChildPeriodicPlanException $obj */
            $obj = new ChildPeriodicPlanException();
            $obj->hydrate($row);
            PeriodicPlanExceptionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPeriodicPlanException|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_EXCEPTION_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_EXCEPTION_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the periodic_plan_exception_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodicPlanExceptionId(1234); // WHERE periodic_plan_exception_id = 1234
     * $query->filterByPeriodicPlanExceptionId(array(12, 34)); // WHERE periodic_plan_exception_id IN (12, 34)
     * $query->filterByPeriodicPlanExceptionId(array('min' => 12)); // WHERE periodic_plan_exception_id > 12
     * </code>
     *
     * @param     mixed $periodicPlanExceptionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlanExceptionId($periodicPlanExceptionId = null, $comparison = null)
    {
        if (is_array($periodicPlanExceptionId)) {
            $useMinMax = false;
            if (isset($periodicPlanExceptionId['min'])) {
                $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_EXCEPTION_ID, $periodicPlanExceptionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($periodicPlanExceptionId['max'])) {
                $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_EXCEPTION_ID, $periodicPlanExceptionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_EXCEPTION_ID, $periodicPlanExceptionId, $comparison);
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
     * @see       filterByPeriodicPlan()
     *
     * @param     mixed $periodicPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlanId($periodicPlanId = null, $comparison = null)
    {
        if (is_array($periodicPlanId)) {
            $useMinMax = false;
            if (isset($periodicPlanId['min'])) {
                $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_ID, $periodicPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($periodicPlanId['max'])) {
                $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_ID, $periodicPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_ID, $periodicPlanId, $comparison);
    }

    /**
     * Filter the query on the periodic_plan_exception_type column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodicPlanExceptionType(true); // WHERE periodic_plan_exception_type = true
     * $query->filterByPeriodicPlanExceptionType('yes'); // WHERE periodic_plan_exception_type = true
     * </code>
     *
     * @param     boolean|string $periodicPlanExceptionType The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlanExceptionType($periodicPlanExceptionType = null, $comparison = null)
    {
        if (is_string($periodicPlanExceptionType)) {
            $periodicPlanExceptionType = in_array(strtolower($periodicPlanExceptionType), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_EXCEPTION_TYPE, $periodicPlanExceptionType, $comparison);
    }

    /**
     * Filter the query on the periodic_plan_exception_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodicPlanExceptionDate('2011-03-14'); // WHERE periodic_plan_exception_date = '2011-03-14'
     * $query->filterByPeriodicPlanExceptionDate('now'); // WHERE periodic_plan_exception_date = '2011-03-14'
     * $query->filterByPeriodicPlanExceptionDate(array('max' => 'yesterday')); // WHERE periodic_plan_exception_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $periodicPlanExceptionDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlanExceptionDate($periodicPlanExceptionDate = null, $comparison = null)
    {
        if (is_array($periodicPlanExceptionDate)) {
            $useMinMax = false;
            if (isset($periodicPlanExceptionDate['min'])) {
                $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_EXCEPTION_DATE, $periodicPlanExceptionDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($periodicPlanExceptionDate['max'])) {
                $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_EXCEPTION_DATE, $periodicPlanExceptionDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_EXCEPTION_DATE, $periodicPlanExceptionDate, $comparison);
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
     * @return $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\PeriodicPlan object
     *
     * @param \App\Propel\PeriodicPlan|ObjectCollection $periodicPlan The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlan($periodicPlan, $comparison = null)
    {
        if ($periodicPlan instanceof \App\Propel\PeriodicPlan) {
            return $this
                ->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_ID, $periodicPlan->getPeriodicPlanId(), $comparison);
        } elseif ($periodicPlan instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_ID, $periodicPlan->toKeyValue('PrimaryKey', 'PeriodicPlanId'), $comparison);
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
     * @return $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildPeriodicPlanException $periodicPlanException Object to remove from the list of results
     *
     * @return $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function prune($periodicPlanException = null)
    {
        if ($periodicPlanException) {
            $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_PERIODIC_PLAN_EXCEPTION_ID, $periodicPlanException->getPeriodicPlanExceptionId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the periodic_plan_exception table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicPlanExceptionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PeriodicPlanExceptionTableMap::clearInstancePool();
            PeriodicPlanExceptionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PeriodicPlanExceptionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PeriodicPlanExceptionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PeriodicPlanExceptionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PeriodicPlanExceptionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PeriodicPlanExceptionTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PeriodicPlanExceptionTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PeriodicPlanExceptionTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PeriodicPlanExceptionTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildPeriodicPlanExceptionQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PeriodicPlanExceptionTableMap::COL_CREATED_AT);
    }

} // PeriodicPlanExceptionQuery
