<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Delivery as ChildDelivery;
use App\Propel\DeliveryQuery as ChildDeliveryQuery;
use App\Propel\Map\DeliveryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'delivery' table.
 *
 *
 *
 * @method     ChildDeliveryQuery orderByDeliveryId($order = Criteria::ASC) Order by the delivery_id column
 * @method     ChildDeliveryQuery orderByDeliveryTypeId($order = Criteria::ASC) Order by the delivery_type_id column
 * @method     ChildDeliveryQuery orderByDeliveryDate($order = Criteria::ASC) Order by the delivery_date column
 * @method     ChildDeliveryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDeliveryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildDeliveryQuery groupByDeliveryId() Group by the delivery_id column
 * @method     ChildDeliveryQuery groupByDeliveryTypeId() Group by the delivery_type_id column
 * @method     ChildDeliveryQuery groupByDeliveryDate() Group by the delivery_date column
 * @method     ChildDeliveryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDeliveryQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildDeliveryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDeliveryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDeliveryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDeliveryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDeliveryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDeliveryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDeliveryQuery leftJoinDeliveryType($relationAlias = null) Adds a LEFT JOIN clause to the query using the DeliveryType relation
 * @method     ChildDeliveryQuery rightJoinDeliveryType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DeliveryType relation
 * @method     ChildDeliveryQuery innerJoinDeliveryType($relationAlias = null) Adds a INNER JOIN clause to the query using the DeliveryType relation
 *
 * @method     ChildDeliveryQuery joinWithDeliveryType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DeliveryType relation
 *
 * @method     ChildDeliveryQuery leftJoinWithDeliveryType() Adds a LEFT JOIN clause and with to the query using the DeliveryType relation
 * @method     ChildDeliveryQuery rightJoinWithDeliveryType() Adds a RIGHT JOIN clause and with to the query using the DeliveryType relation
 * @method     ChildDeliveryQuery innerJoinWithDeliveryType() Adds a INNER JOIN clause and with to the query using the DeliveryType relation
 *
 * @method     ChildDeliveryQuery leftJoinDeliveryPeriodic($relationAlias = null) Adds a LEFT JOIN clause to the query using the DeliveryPeriodic relation
 * @method     ChildDeliveryQuery rightJoinDeliveryPeriodic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DeliveryPeriodic relation
 * @method     ChildDeliveryQuery innerJoinDeliveryPeriodic($relationAlias = null) Adds a INNER JOIN clause to the query using the DeliveryPeriodic relation
 *
 * @method     ChildDeliveryQuery joinWithDeliveryPeriodic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DeliveryPeriodic relation
 *
 * @method     ChildDeliveryQuery leftJoinWithDeliveryPeriodic() Adds a LEFT JOIN clause and with to the query using the DeliveryPeriodic relation
 * @method     ChildDeliveryQuery rightJoinWithDeliveryPeriodic() Adds a RIGHT JOIN clause and with to the query using the DeliveryPeriodic relation
 * @method     ChildDeliveryQuery innerJoinWithDeliveryPeriodic() Adds a INNER JOIN clause and with to the query using the DeliveryPeriodic relation
 *
 * @method     ChildDeliveryQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     ChildDeliveryQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     ChildDeliveryQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     ChildDeliveryQuery joinWithOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Order relation
 *
 * @method     ChildDeliveryQuery leftJoinWithOrder() Adds a LEFT JOIN clause and with to the query using the Order relation
 * @method     ChildDeliveryQuery rightJoinWithOrder() Adds a RIGHT JOIN clause and with to the query using the Order relation
 * @method     ChildDeliveryQuery innerJoinWithOrder() Adds a INNER JOIN clause and with to the query using the Order relation
 *
 * @method     \App\Propel\DeliveryTypeQuery|\App\Propel\DeliveryPeriodicQuery|\App\Propel\OrderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDelivery findOne(ConnectionInterface $con = null) Return the first ChildDelivery matching the query
 * @method     ChildDelivery findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDelivery matching the query, or a new ChildDelivery object populated from the query conditions when no match is found
 *
 * @method     ChildDelivery findOneByDeliveryId(int $delivery_id) Return the first ChildDelivery filtered by the delivery_id column
 * @method     ChildDelivery findOneByDeliveryTypeId(int $delivery_type_id) Return the first ChildDelivery filtered by the delivery_type_id column
 * @method     ChildDelivery findOneByDeliveryDate(string $delivery_date) Return the first ChildDelivery filtered by the delivery_date column
 * @method     ChildDelivery findOneByCreatedAt(string $created_at) Return the first ChildDelivery filtered by the created_at column
 * @method     ChildDelivery findOneByUpdatedAt(string $updated_at) Return the first ChildDelivery filtered by the updated_at column *

 * @method     ChildDelivery requirePk($key, ConnectionInterface $con = null) Return the ChildDelivery by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDelivery requireOne(ConnectionInterface $con = null) Return the first ChildDelivery matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDelivery requireOneByDeliveryId(int $delivery_id) Return the first ChildDelivery filtered by the delivery_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDelivery requireOneByDeliveryTypeId(int $delivery_type_id) Return the first ChildDelivery filtered by the delivery_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDelivery requireOneByDeliveryDate(string $delivery_date) Return the first ChildDelivery filtered by the delivery_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDelivery requireOneByCreatedAt(string $created_at) Return the first ChildDelivery filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDelivery requireOneByUpdatedAt(string $updated_at) Return the first ChildDelivery filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDelivery[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDelivery objects based on current ModelCriteria
 * @method     ChildDelivery[]|ObjectCollection findByDeliveryId(int $delivery_id) Return ChildDelivery objects filtered by the delivery_id column
 * @method     ChildDelivery[]|ObjectCollection findByDeliveryTypeId(int $delivery_type_id) Return ChildDelivery objects filtered by the delivery_type_id column
 * @method     ChildDelivery[]|ObjectCollection findByDeliveryDate(string $delivery_date) Return ChildDelivery objects filtered by the delivery_date column
 * @method     ChildDelivery[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildDelivery objects filtered by the created_at column
 * @method     ChildDelivery[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildDelivery objects filtered by the updated_at column
 * @method     ChildDelivery[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DeliveryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\DeliveryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\Delivery', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDeliveryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDeliveryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDeliveryQuery) {
            return $criteria;
        }
        $query = new ChildDeliveryQuery();
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
     * @return ChildDelivery|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DeliveryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DeliveryTableMap::DATABASE_NAME);
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
     * @return ChildDelivery A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT delivery_id, delivery_type_id, delivery_date, created_at, updated_at FROM delivery WHERE delivery_id = :p0';
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
            /** @var ChildDelivery $obj */
            $obj = new ChildDelivery();
            $obj->hydrate($row);
            DeliveryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDelivery|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_ID, $keys, Criteria::IN);
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
     * @param     mixed $deliveryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function filterByDeliveryId($deliveryId = null, $comparison = null)
    {
        if (is_array($deliveryId)) {
            $useMinMax = false;
            if (isset($deliveryId['min'])) {
                $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_ID, $deliveryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryId['max'])) {
                $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_ID, $deliveryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_ID, $deliveryId, $comparison);
    }

    /**
     * Filter the query on the delivery_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryTypeId(1234); // WHERE delivery_type_id = 1234
     * $query->filterByDeliveryTypeId(array(12, 34)); // WHERE delivery_type_id IN (12, 34)
     * $query->filterByDeliveryTypeId(array('min' => 12)); // WHERE delivery_type_id > 12
     * </code>
     *
     * @see       filterByDeliveryType()
     *
     * @param     mixed $deliveryTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function filterByDeliveryTypeId($deliveryTypeId = null, $comparison = null)
    {
        if (is_array($deliveryTypeId)) {
            $useMinMax = false;
            if (isset($deliveryTypeId['min'])) {
                $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_TYPE_ID, $deliveryTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryTypeId['max'])) {
                $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_TYPE_ID, $deliveryTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_TYPE_ID, $deliveryTypeId, $comparison);
    }

    /**
     * Filter the query on the delivery_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryDate('2011-03-14'); // WHERE delivery_date = '2011-03-14'
     * $query->filterByDeliveryDate('now'); // WHERE delivery_date = '2011-03-14'
     * $query->filterByDeliveryDate(array('max' => 'yesterday')); // WHERE delivery_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $deliveryDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function filterByDeliveryDate($deliveryDate = null, $comparison = null)
    {
        if (is_array($deliveryDate)) {
            $useMinMax = false;
            if (isset($deliveryDate['min'])) {
                $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_DATE, $deliveryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryDate['max'])) {
                $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_DATE, $deliveryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_DATE, $deliveryDate, $comparison);
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
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DeliveryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DeliveryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DeliveryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DeliveryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\DeliveryType object
     *
     * @param \App\Propel\DeliveryType|ObjectCollection $deliveryType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDeliveryQuery The current query, for fluid interface
     */
    public function filterByDeliveryType($deliveryType, $comparison = null)
    {
        if ($deliveryType instanceof \App\Propel\DeliveryType) {
            return $this
                ->addUsingAlias(DeliveryTableMap::COL_DELIVERY_TYPE_ID, $deliveryType->getDeliveryTypeId(), $comparison);
        } elseif ($deliveryType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DeliveryTableMap::COL_DELIVERY_TYPE_ID, $deliveryType->toKeyValue('PrimaryKey', 'DeliveryTypeId'), $comparison);
        } else {
            throw new PropelException('filterByDeliveryType() only accepts arguments of type \App\Propel\DeliveryType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DeliveryType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function joinDeliveryType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DeliveryType');

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
            $this->addJoinObject($join, 'DeliveryType');
        }

        return $this;
    }

    /**
     * Use the DeliveryType relation DeliveryType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\DeliveryTypeQuery A secondary query class using the current class as primary query
     */
    public function useDeliveryTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDeliveryType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DeliveryType', '\App\Propel\DeliveryTypeQuery');
    }

    /**
     * Filter the query by a related \App\Propel\DeliveryPeriodic object
     *
     * @param \App\Propel\DeliveryPeriodic|ObjectCollection $deliveryPeriodic the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDeliveryQuery The current query, for fluid interface
     */
    public function filterByDeliveryPeriodic($deliveryPeriodic, $comparison = null)
    {
        if ($deliveryPeriodic instanceof \App\Propel\DeliveryPeriodic) {
            return $this
                ->addUsingAlias(DeliveryTableMap::COL_DELIVERY_ID, $deliveryPeriodic->getDeliveryId(), $comparison);
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
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\Order object
     *
     * @param \App\Propel\Order|ObjectCollection $order the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDeliveryQuery The current query, for fluid interface
     */
    public function filterByOrder($order, $comparison = null)
    {
        if ($order instanceof \App\Propel\Order) {
            return $this
                ->addUsingAlias(DeliveryTableMap::COL_DELIVERY_ID, $order->getDeliveryId(), $comparison);
        } elseif ($order instanceof ObjectCollection) {
            return $this
                ->useOrderQuery()
                ->filterByPrimaryKeys($order->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrder() only accepts arguments of type \App\Propel\Order or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Order relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function joinOrder($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Order');

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
            $this->addJoinObject($join, 'Order');
        }

        return $this;
    }

    /**
     * Use the Order relation Order object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\OrderQuery A secondary query class using the current class as primary query
     */
    public function useOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Order', '\App\Propel\OrderQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDelivery $delivery Object to remove from the list of results
     *
     * @return $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function prune($delivery = null)
    {
        if ($delivery) {
            $this->addUsingAlias(DeliveryTableMap::COL_DELIVERY_ID, $delivery->getDeliveryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the delivery table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DeliveryTableMap::clearInstancePool();
            DeliveryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DeliveryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DeliveryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DeliveryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(DeliveryTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(DeliveryTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(DeliveryTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(DeliveryTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(DeliveryTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildDeliveryQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(DeliveryTableMap::COL_CREATED_AT);
    }

} // DeliveryQuery
