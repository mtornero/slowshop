<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\DeliveryPeriodic as ChildDeliveryPeriodic;
use App\Propel\DeliveryPeriodicQuery as ChildDeliveryPeriodicQuery;
use App\Propel\Map\DeliveryPeriodicTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'delivery_periodic' table.
 *
 *
 *
 * @method     ChildDeliveryPeriodicQuery orderByDeliveryPeriodicId($order = Criteria::ASC) Order by the delivery_periodic_id column
 * @method     ChildDeliveryPeriodicQuery orderByDeliveryId($order = Criteria::ASC) Order by the delivery_id column
 * @method     ChildDeliveryPeriodicQuery orderByDeliveryPeriodicPlanId($order = Criteria::ASC) Order by the delivery_periodic_plan_id column
 * @method     ChildDeliveryPeriodicQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDeliveryPeriodicQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildDeliveryPeriodicQuery orderBySortableRank($order = Criteria::ASC) Order by the sortable_rank column
 *
 * @method     ChildDeliveryPeriodicQuery groupByDeliveryPeriodicId() Group by the delivery_periodic_id column
 * @method     ChildDeliveryPeriodicQuery groupByDeliveryId() Group by the delivery_id column
 * @method     ChildDeliveryPeriodicQuery groupByDeliveryPeriodicPlanId() Group by the delivery_periodic_plan_id column
 * @method     ChildDeliveryPeriodicQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDeliveryPeriodicQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildDeliveryPeriodicQuery groupBySortableRank() Group by the sortable_rank column
 *
 * @method     ChildDeliveryPeriodicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDeliveryPeriodicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDeliveryPeriodicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDeliveryPeriodicQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDeliveryPeriodicQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDeliveryPeriodicQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDeliveryPeriodicQuery leftJoinDelivery($relationAlias = null) Adds a LEFT JOIN clause to the query using the Delivery relation
 * @method     ChildDeliveryPeriodicQuery rightJoinDelivery($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Delivery relation
 * @method     ChildDeliveryPeriodicQuery innerJoinDelivery($relationAlias = null) Adds a INNER JOIN clause to the query using the Delivery relation
 *
 * @method     ChildDeliveryPeriodicQuery joinWithDelivery($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Delivery relation
 *
 * @method     ChildDeliveryPeriodicQuery leftJoinWithDelivery() Adds a LEFT JOIN clause and with to the query using the Delivery relation
 * @method     ChildDeliveryPeriodicQuery rightJoinWithDelivery() Adds a RIGHT JOIN clause and with to the query using the Delivery relation
 * @method     ChildDeliveryPeriodicQuery innerJoinWithDelivery() Adds a INNER JOIN clause and with to the query using the Delivery relation
 *
 * @method     ChildDeliveryPeriodicQuery leftJoinPeriodicPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the PeriodicPlan relation
 * @method     ChildDeliveryPeriodicQuery rightJoinPeriodicPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PeriodicPlan relation
 * @method     ChildDeliveryPeriodicQuery innerJoinPeriodicPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the PeriodicPlan relation
 *
 * @method     ChildDeliveryPeriodicQuery joinWithPeriodicPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PeriodicPlan relation
 *
 * @method     ChildDeliveryPeriodicQuery leftJoinWithPeriodicPlan() Adds a LEFT JOIN clause and with to the query using the PeriodicPlan relation
 * @method     ChildDeliveryPeriodicQuery rightJoinWithPeriodicPlan() Adds a RIGHT JOIN clause and with to the query using the PeriodicPlan relation
 * @method     ChildDeliveryPeriodicQuery innerJoinWithPeriodicPlan() Adds a INNER JOIN clause and with to the query using the PeriodicPlan relation
 *
 * @method     \App\Propel\DeliveryQuery|\App\Propel\PeriodicPlanQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDeliveryPeriodic findOne(ConnectionInterface $con = null) Return the first ChildDeliveryPeriodic matching the query
 * @method     ChildDeliveryPeriodic findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDeliveryPeriodic matching the query, or a new ChildDeliveryPeriodic object populated from the query conditions when no match is found
 *
 * @method     ChildDeliveryPeriodic findOneByDeliveryPeriodicId(int $delivery_periodic_id) Return the first ChildDeliveryPeriodic filtered by the delivery_periodic_id column
 * @method     ChildDeliveryPeriodic findOneByDeliveryId(int $delivery_id) Return the first ChildDeliveryPeriodic filtered by the delivery_id column
 * @method     ChildDeliveryPeriodic findOneByDeliveryPeriodicPlanId(int $delivery_periodic_plan_id) Return the first ChildDeliveryPeriodic filtered by the delivery_periodic_plan_id column
 * @method     ChildDeliveryPeriodic findOneByCreatedAt(string $created_at) Return the first ChildDeliveryPeriodic filtered by the created_at column
 * @method     ChildDeliveryPeriodic findOneByUpdatedAt(string $updated_at) Return the first ChildDeliveryPeriodic filtered by the updated_at column
 * @method     ChildDeliveryPeriodic findOneBySortableRank(int $sortable_rank) Return the first ChildDeliveryPeriodic filtered by the sortable_rank column *

 * @method     ChildDeliveryPeriodic requirePk($key, ConnectionInterface $con = null) Return the ChildDeliveryPeriodic by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryPeriodic requireOne(ConnectionInterface $con = null) Return the first ChildDeliveryPeriodic matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeliveryPeriodic requireOneByDeliveryPeriodicId(int $delivery_periodic_id) Return the first ChildDeliveryPeriodic filtered by the delivery_periodic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryPeriodic requireOneByDeliveryId(int $delivery_id) Return the first ChildDeliveryPeriodic filtered by the delivery_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryPeriodic requireOneByDeliveryPeriodicPlanId(int $delivery_periodic_plan_id) Return the first ChildDeliveryPeriodic filtered by the delivery_periodic_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryPeriodic requireOneByCreatedAt(string $created_at) Return the first ChildDeliveryPeriodic filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryPeriodic requireOneByUpdatedAt(string $updated_at) Return the first ChildDeliveryPeriodic filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryPeriodic requireOneBySortableRank(int $sortable_rank) Return the first ChildDeliveryPeriodic filtered by the sortable_rank column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeliveryPeriodic[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDeliveryPeriodic objects based on current ModelCriteria
 * @method     ChildDeliveryPeriodic[]|ObjectCollection findByDeliveryPeriodicId(int $delivery_periodic_id) Return ChildDeliveryPeriodic objects filtered by the delivery_periodic_id column
 * @method     ChildDeliveryPeriodic[]|ObjectCollection findByDeliveryId(int $delivery_id) Return ChildDeliveryPeriodic objects filtered by the delivery_id column
 * @method     ChildDeliveryPeriodic[]|ObjectCollection findByDeliveryPeriodicPlanId(int $delivery_periodic_plan_id) Return ChildDeliveryPeriodic objects filtered by the delivery_periodic_plan_id column
 * @method     ChildDeliveryPeriodic[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildDeliveryPeriodic objects filtered by the created_at column
 * @method     ChildDeliveryPeriodic[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildDeliveryPeriodic objects filtered by the updated_at column
 * @method     ChildDeliveryPeriodic[]|ObjectCollection findBySortableRank(int $sortable_rank) Return ChildDeliveryPeriodic objects filtered by the sortable_rank column
 * @method     ChildDeliveryPeriodic[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DeliveryPeriodicQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\DeliveryPeriodicQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\DeliveryPeriodic', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDeliveryPeriodicQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDeliveryPeriodicQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDeliveryPeriodicQuery) {
            return $criteria;
        }
        $query = new ChildDeliveryPeriodicQuery();
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
     * @return ChildDeliveryPeriodic|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DeliveryPeriodicTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
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
     * @return ChildDeliveryPeriodic A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT delivery_periodic_id, delivery_id, delivery_periodic_plan_id, created_at, updated_at, sortable_rank FROM delivery_periodic WHERE delivery_periodic_id = :p0';
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
            /** @var ChildDeliveryPeriodic $obj */
            $obj = new ChildDeliveryPeriodic();
            $obj->hydrate($row);
            DeliveryPeriodicTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDeliveryPeriodic|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the delivery_periodic_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryPeriodicId(1234); // WHERE delivery_periodic_id = 1234
     * $query->filterByDeliveryPeriodicId(array(12, 34)); // WHERE delivery_periodic_id IN (12, 34)
     * $query->filterByDeliveryPeriodicId(array('min' => 12)); // WHERE delivery_periodic_id > 12
     * </code>
     *
     * @param     mixed $deliveryPeriodicId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterByDeliveryPeriodicId($deliveryPeriodicId = null, $comparison = null)
    {
        if (is_array($deliveryPeriodicId)) {
            $useMinMax = false;
            if (isset($deliveryPeriodicId['min'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID, $deliveryPeriodicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryPeriodicId['max'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID, $deliveryPeriodicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID, $deliveryPeriodicId, $comparison);
    }

    /**
     * Filter the query on the delivery_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryId(1234); // WHERE delivery_id = 1234
     * $query->filterByDeliveryId(array(12, 34)); // WHERE delivery_id IN (12, 34)
     * $query->filterByDeliveryId(array('min' => 12)); // WHERE delivery_id > 12
     * </code>
     *
     * @see       filterByDelivery()
     *
     * @param     mixed $deliveryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterByDeliveryId($deliveryId = null, $comparison = null)
    {
        if (is_array($deliveryId)) {
            $useMinMax = false;
            if (isset($deliveryId['min'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_ID, $deliveryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryId['max'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_ID, $deliveryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_ID, $deliveryId, $comparison);
    }

    /**
     * Filter the query on the delivery_periodic_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryPeriodicPlanId(1234); // WHERE delivery_periodic_plan_id = 1234
     * $query->filterByDeliveryPeriodicPlanId(array(12, 34)); // WHERE delivery_periodic_plan_id IN (12, 34)
     * $query->filterByDeliveryPeriodicPlanId(array('min' => 12)); // WHERE delivery_periodic_plan_id > 12
     * </code>
     *
     * @see       filterByPeriodicPlan()
     *
     * @param     mixed $deliveryPeriodicPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterByDeliveryPeriodicPlanId($deliveryPeriodicPlanId = null, $comparison = null)
    {
        if (is_array($deliveryPeriodicPlanId)) {
            $useMinMax = false;
            if (isset($deliveryPeriodicPlanId['min'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID, $deliveryPeriodicPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryPeriodicPlanId['max'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID, $deliveryPeriodicPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID, $deliveryPeriodicPlanId, $comparison);
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
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryPeriodicTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryPeriodicTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the sortable_rank column
     *
     * Example usage:
     * <code>
     * $query->filterBySortableRank(1234); // WHERE sortable_rank = 1234
     * $query->filterBySortableRank(array(12, 34)); // WHERE sortable_rank IN (12, 34)
     * $query->filterBySortableRank(array('min' => 12)); // WHERE sortable_rank > 12
     * </code>
     *
     * @param     mixed $sortableRank The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterBySortableRank($sortableRank = null, $comparison = null)
    {
        if (is_array($sortableRank)) {
            $useMinMax = false;
            if (isset($sortableRank['min'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_SORTABLE_RANK, $sortableRank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortableRank['max'])) {
                $this->addUsingAlias(DeliveryPeriodicTableMap::COL_SORTABLE_RANK, $sortableRank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryPeriodicTableMap::COL_SORTABLE_RANK, $sortableRank, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Delivery object
     *
     * @param \App\Propel\Delivery|ObjectCollection $delivery The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterByDelivery($delivery, $comparison = null)
    {
        if ($delivery instanceof \App\Propel\Delivery) {
            return $this
                ->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_ID, $delivery->getDeliveryId(), $comparison);
        } elseif ($delivery instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_ID, $delivery->toKeyValue('PrimaryKey', 'DeliveryId'), $comparison);
        } else {
            throw new PropelException('filterByDelivery() only accepts arguments of type \App\Propel\Delivery or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Delivery relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function joinDelivery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Delivery');

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
            $this->addJoinObject($join, 'Delivery');
        }

        return $this;
    }

    /**
     * Use the Delivery relation Delivery object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\DeliveryQuery A secondary query class using the current class as primary query
     */
    public function useDeliveryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDelivery($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Delivery', '\App\Propel\DeliveryQuery');
    }

    /**
     * Filter the query by a related \App\Propel\PeriodicPlan object
     *
     * @param \App\Propel\PeriodicPlan|ObjectCollection $periodicPlan The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlan($periodicPlan, $comparison = null)
    {
        if ($periodicPlan instanceof \App\Propel\PeriodicPlan) {
            return $this
                ->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID, $periodicPlan->getPeriodicPlanId(), $comparison);
        } elseif ($periodicPlan instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID, $periodicPlan->toKeyValue('PrimaryKey', 'PeriodicPlanId'), $comparison);
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
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
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
     * @param   ChildDeliveryPeriodic $deliveryPeriodic Object to remove from the list of results
     *
     * @return $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function prune($deliveryPeriodic = null)
    {
        if ($deliveryPeriodic) {
            $this->addUsingAlias(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_ID, $deliveryPeriodic->getDeliveryPeriodicId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the delivery_periodic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DeliveryPeriodicTableMap::clearInstancePool();
            DeliveryPeriodicTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DeliveryPeriodicTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DeliveryPeriodicTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DeliveryPeriodicTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(DeliveryPeriodicTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(DeliveryPeriodicTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(DeliveryPeriodicTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(DeliveryPeriodicTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(DeliveryPeriodicTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(DeliveryPeriodicTableMap::COL_CREATED_AT);
    }

    // sortable behavior

    /**
     * Returns the objects in a certain list, from the list scope
     *
     * @param int $scope Scope to determine which objects node to return
     *
     * @return    $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function inList($scope)
    {

        static::sortableApplyScopeCriteria($this, $scope, 'addUsingAlias');

        return $this;
    }

    /**
     * Filter the query based on a rank in the list
     *
     * @param     integer   $rank rank
     * @param int $scope Scope to determine which objects node to return

     *
     * @return    ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function filterByRank($rank, $scope)
    {

        return $this
            ->inList($scope)
            ->addUsingAlias(DeliveryPeriodicTableMap::RANK_COL, $rank, Criteria::EQUAL);
    }

    /**
     * Order the query based on the rank in the list.
     * Using the default $order, returns the item with the lowest rank first
     *
     * @param     string $order either Criteria::ASC (default) or Criteria::DESC
     *
     * @return    $this|ChildDeliveryPeriodicQuery The current query, for fluid interface
     */
    public function orderByRank($order = Criteria::ASC)
    {
        $order = strtoupper($order);
        switch ($order) {
            case Criteria::ASC:
                return $this->addAscendingOrderByColumn($this->getAliasedColName(DeliveryPeriodicTableMap::RANK_COL));
                break;
            case Criteria::DESC:
                return $this->addDescendingOrderByColumn($this->getAliasedColName(DeliveryPeriodicTableMap::RANK_COL));
                break;
            default:
                throw new \Propel\Runtime\Exception\PropelException('ChildDeliveryPeriodicQuery::orderBy() only accepts "asc" or "desc" as argument');
        }
    }

    /**
     * Get an item from the list based on its rank
     *
     * @param     integer   $rank rank
     * @param int $scope Scope to determine which objects node to return
     * @param     ConnectionInterface $con optional connection
     *
     * @return    ChildDeliveryPeriodic
     */
    public function findOneByRank($rank, $scope, ConnectionInterface $con = null)
    {

        return $this
            ->filterByRank($rank, $scope)
            ->findOne($con);
    }

    /**
     * Returns a list of objects
     *
     * @param int $scope Scope to determine which objects node to return

     * @param      ConnectionInterface $con    Connection to use.
     *
     * @return     mixed the list of results, formatted by the current formatter
     */
    public function findList($scope, $con = null)
    {

        return $this
            ->inList($scope)
            ->orderByRank()
            ->find($con);
    }

    /**
     * Get the highest rank
     *
     * @param int $scope Scope to determine which objects node to return
     * @param     ConnectionInterface optional connection
     *
     * @return    integer highest position
     */
    public function getMaxRank($scope, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }
        // shift the objects with a position lower than the one of object
        $this->addSelectColumn('MAX(' . DeliveryPeriodicTableMap::RANK_COL . ')');

                static::sortableApplyScopeCriteria($this, $scope);
        $stmt = $this->doSelect($con);

        return $stmt->fetchColumn();
    }

    /**
     * Get the highest rank by a scope with a array format.
     *
     * @param     mixed $scope      The scope value as scalar type or array($value1, ...).

     * @param     ConnectionInterface optional connection
     *
     * @return    integer highest position
     */
    public function getMaxRankArray($scope, ConnectionInterface $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }
        // shift the objects with a position lower than the one of object
        $this->addSelectColumn('MAX(' . DeliveryPeriodicTableMap::RANK_COL . ')');
        static::sortableApplyScopeCriteria($this, $scope);
        $stmt = $this->doSelect($con);

        return $stmt->fetchColumn();
    }

    /**
     * Get an item from the list based on its rank
     *
     * @param     integer   $rank rank
     * @param      int $scope        Scope to determine which suite to consider
     * @param     ConnectionInterface $con optional connection
     *
     * @return ChildDeliveryPeriodic
     */
    static public function retrieveByRank($rank, $scope = null, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        $c = new Criteria;
        $c->add(DeliveryPeriodicTableMap::RANK_COL, $rank);
                static::sortableApplyScopeCriteria($c, $scope);

        return static::create(null, $c)->findOne($con);
    }

    /**
     * Reorder a set of sortable objects based on a list of id/position
     * Beware that there is no check made on the positions passed
     * So incoherent positions will result in an incoherent list
     *
     * @param     mixed               $order id => rank pairs
     * @param     ConnectionInterface $con   optional connection
     *
     * @return    boolean true if the reordering took place, false if a database problem prevented it
     */
    public function reorder($order, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con, $order) {
            $ids = array_keys($order);
            $objects = $this->findPks($ids, $con);
            foreach ($objects as $object) {
                $pk = $object->getPrimaryKey();
                if ($object->getSortableRank() != $order[$pk]) {
                    $object->setSortableRank($order[$pk]);
                    $object->save($con);
                }
            }
        });

        return true;
    }

    /**
     * Return an array of sortable objects ordered by position
     *
     * @param     Criteria  $criteria  optional criteria object
     * @param     string    $order     sorting order, to be chosen between Criteria::ASC (default) and Criteria::DESC
     * @param     ConnectionInterface $con       optional connection
     *
     * @return    array list of sortable objects
     */
    static public function doSelectOrderByRank(Criteria $criteria = null, $order = Criteria::ASC, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        if (null === $criteria) {
            $criteria = new Criteria();
        } elseif ($criteria instanceof Criteria) {
            $criteria = clone $criteria;
        }

        $criteria->clearOrderByColumns();

        if (Criteria::ASC == $order) {
            $criteria->addAscendingOrderByColumn(DeliveryPeriodicTableMap::RANK_COL);
        } else {
            $criteria->addDescendingOrderByColumn(DeliveryPeriodicTableMap::RANK_COL);
        }

        return ChildDeliveryPeriodicQuery::create(null, $criteria)->find($con);
    }

    /**
     * Return an array of sortable objects in the given scope ordered by position
     *
     * @param     int       $scope  the scope of the list
     * @param     string    $order  sorting order, to be chosen between Criteria::ASC (default) and Criteria::DESC
     * @param     ConnectionInterface $con    optional connection
     *
     * @return    array list of sortable objects
     */
    static public function retrieveList($scope, $order = Criteria::ASC, ConnectionInterface $con = null)
    {
        $c = new Criteria();
        static::sortableApplyScopeCriteria($c, $scope);

        return ChildDeliveryPeriodicQuery::doSelectOrderByRank($c, $order, $con);
    }

    /**
     * Return the number of sortable objects in the given scope
     *
     * @param     int       $scope  the scope of the list
     * @param     ConnectionInterface $con    optional connection
     *
     * @return    array list of sortable objects
     */
    static public function countList($scope, ConnectionInterface $con = null)
    {
        $c = new Criteria();
        $c->add(DeliveryPeriodicTableMap::SCOPE_COL, $scope);

        return ChildDeliveryPeriodicQuery::create(null, $c)->count($con);
    }

    /**
     * Deletes the sortable objects in the given scope
     *
     * @param     int       $scope  the scope of the list
     * @param     ConnectionInterface $con    optional connection
     *
     * @return    int number of deleted objects
     */
    static public function deleteList($scope, ConnectionInterface $con = null)
    {
        $c = new Criteria();
        static::sortableApplyScopeCriteria($c, $scope);

        return DeliveryPeriodicTableMap::doDelete($c, $con);
    }

    /**
     * Applies all scope fields to the given criteria.
     *
     * @param  Criteria $criteria Applies the values directly to this criteria.
     * @param  mixed    $scope    The scope value as scalar type or array($value1, ...).
     * @param  string   $method   The method we use to apply the values.
     *
     */
    static public function sortableApplyScopeCriteria(Criteria $criteria, $scope, $method = 'add')
    {

        $criteria->$method(DeliveryPeriodicTableMap::COL_DELIVERY_PERIODIC_PLAN_ID, $scope, Criteria::EQUAL);

    }

    /**
     * Adds $delta to all Rank values that are >= $first and <= $last.
     * '$delta' can also be negative.
     *
     * @param      int $delta Value to be shifted by, can be negative
     * @param      int $first First node to be shifted
     * @param      int $last  Last node to be shifted
     * @param      int $scope Scope to use for the shift
     * @param      ConnectionInterface $con Connection to use.
     */
    static public function sortableShiftRank($delta, $first, $last = null, $scope = null, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryPeriodicTableMap::DATABASE_NAME);
        }

        $whereCriteria = new Criteria(DeliveryPeriodicTableMap::DATABASE_NAME);
        $criterion = $whereCriteria->getNewCriterion(DeliveryPeriodicTableMap::RANK_COL, $first, Criteria::GREATER_EQUAL);
        if (null !== $last) {
            $criterion->addAnd($whereCriteria->getNewCriterion(DeliveryPeriodicTableMap::RANK_COL, $last, Criteria::LESS_EQUAL));
        }
        $whereCriteria->add($criterion);
                static::sortableApplyScopeCriteria($whereCriteria, $scope);

        $valuesCriteria = new Criteria(DeliveryPeriodicTableMap::DATABASE_NAME);
        $valuesCriteria->add(DeliveryPeriodicTableMap::RANK_COL, array('raw' => DeliveryPeriodicTableMap::RANK_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);

        $whereCriteria->doUpdate($valuesCriteria, $con);
        DeliveryPeriodicTableMap::clearInstancePool();
    }

} // DeliveryPeriodicQuery
