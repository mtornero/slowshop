<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\UserPeriodicPlan as ChildUserPeriodicPlan;
use App\Propel\UserPeriodicPlanQuery as ChildUserPeriodicPlanQuery;
use App\Propel\Map\UserPeriodicPlanTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_periodic_plan' table.
 *
 *
 *
 * @method     ChildUserPeriodicPlanQuery orderByUserPeriodicPlanId($order = Criteria::ASC) Order by the user_periodic_plan_id column
 * @method     ChildUserPeriodicPlanQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserPeriodicPlanQuery orderByPeriodicPlanId($order = Criteria::ASC) Order by the periodic_plan_id column
 * @method     ChildUserPeriodicPlanQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUserPeriodicPlanQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUserPeriodicPlanQuery groupByUserPeriodicPlanId() Group by the user_periodic_plan_id column
 * @method     ChildUserPeriodicPlanQuery groupByUserId() Group by the user_id column
 * @method     ChildUserPeriodicPlanQuery groupByPeriodicPlanId() Group by the periodic_plan_id column
 * @method     ChildUserPeriodicPlanQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUserPeriodicPlanQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUserPeriodicPlanQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserPeriodicPlanQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserPeriodicPlanQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserPeriodicPlanQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserPeriodicPlanQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserPeriodicPlanQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserPeriodicPlanQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserPeriodicPlanQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserPeriodicPlanQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUserPeriodicPlanQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildUserPeriodicPlanQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildUserPeriodicPlanQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildUserPeriodicPlanQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildUserPeriodicPlanQuery leftJoinPeriodicPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the PeriodicPlan relation
 * @method     ChildUserPeriodicPlanQuery rightJoinPeriodicPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PeriodicPlan relation
 * @method     ChildUserPeriodicPlanQuery innerJoinPeriodicPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the PeriodicPlan relation
 *
 * @method     ChildUserPeriodicPlanQuery joinWithPeriodicPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PeriodicPlan relation
 *
 * @method     ChildUserPeriodicPlanQuery leftJoinWithPeriodicPlan() Adds a LEFT JOIN clause and with to the query using the PeriodicPlan relation
 * @method     ChildUserPeriodicPlanQuery rightJoinWithPeriodicPlan() Adds a RIGHT JOIN clause and with to the query using the PeriodicPlan relation
 * @method     ChildUserPeriodicPlanQuery innerJoinWithPeriodicPlan() Adds a INNER JOIN clause and with to the query using the PeriodicPlan relation
 *
 * @method     \App\Propel\UserQuery|\App\Propel\PeriodicPlanQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserPeriodicPlan findOne(ConnectionInterface $con = null) Return the first ChildUserPeriodicPlan matching the query
 * @method     ChildUserPeriodicPlan findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserPeriodicPlan matching the query, or a new ChildUserPeriodicPlan object populated from the query conditions when no match is found
 *
 * @method     ChildUserPeriodicPlan findOneByUserPeriodicPlanId(int $user_periodic_plan_id) Return the first ChildUserPeriodicPlan filtered by the user_periodic_plan_id column
 * @method     ChildUserPeriodicPlan findOneByUserId(int $user_id) Return the first ChildUserPeriodicPlan filtered by the user_id column
 * @method     ChildUserPeriodicPlan findOneByPeriodicPlanId(int $periodic_plan_id) Return the first ChildUserPeriodicPlan filtered by the periodic_plan_id column
 * @method     ChildUserPeriodicPlan findOneByCreatedAt(string $created_at) Return the first ChildUserPeriodicPlan filtered by the created_at column
 * @method     ChildUserPeriodicPlan findOneByUpdatedAt(string $updated_at) Return the first ChildUserPeriodicPlan filtered by the updated_at column *

 * @method     ChildUserPeriodicPlan requirePk($key, ConnectionInterface $con = null) Return the ChildUserPeriodicPlan by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPeriodicPlan requireOne(ConnectionInterface $con = null) Return the first ChildUserPeriodicPlan matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserPeriodicPlan requireOneByUserPeriodicPlanId(int $user_periodic_plan_id) Return the first ChildUserPeriodicPlan filtered by the user_periodic_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPeriodicPlan requireOneByUserId(int $user_id) Return the first ChildUserPeriodicPlan filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPeriodicPlan requireOneByPeriodicPlanId(int $periodic_plan_id) Return the first ChildUserPeriodicPlan filtered by the periodic_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPeriodicPlan requireOneByCreatedAt(string $created_at) Return the first ChildUserPeriodicPlan filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPeriodicPlan requireOneByUpdatedAt(string $updated_at) Return the first ChildUserPeriodicPlan filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserPeriodicPlan[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserPeriodicPlan objects based on current ModelCriteria
 * @method     ChildUserPeriodicPlan[]|ObjectCollection findByUserPeriodicPlanId(int $user_periodic_plan_id) Return ChildUserPeriodicPlan objects filtered by the user_periodic_plan_id column
 * @method     ChildUserPeriodicPlan[]|ObjectCollection findByUserId(int $user_id) Return ChildUserPeriodicPlan objects filtered by the user_id column
 * @method     ChildUserPeriodicPlan[]|ObjectCollection findByPeriodicPlanId(int $periodic_plan_id) Return ChildUserPeriodicPlan objects filtered by the periodic_plan_id column
 * @method     ChildUserPeriodicPlan[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUserPeriodicPlan objects filtered by the created_at column
 * @method     ChildUserPeriodicPlan[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUserPeriodicPlan objects filtered by the updated_at column
 * @method     ChildUserPeriodicPlan[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserPeriodicPlanQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\UserPeriodicPlanQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\UserPeriodicPlan', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserPeriodicPlanQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserPeriodicPlanQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserPeriodicPlanQuery) {
            return $criteria;
        }
        $query = new ChildUserPeriodicPlanQuery();
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
     * @return ChildUserPeriodicPlan|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserPeriodicPlanTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserPeriodicPlanTableMap::DATABASE_NAME);
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
     * @return ChildUserPeriodicPlan A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT user_periodic_plan_id, user_id, periodic_plan_id, created_at, updated_at FROM user_periodic_plan WHERE user_periodic_plan_id = :p0';
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
            /** @var ChildUserPeriodicPlan $obj */
            $obj = new ChildUserPeriodicPlan();
            $obj->hydrate($row);
            UserPeriodicPlanTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUserPeriodicPlan|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_PERIODIC_PLAN_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_PERIODIC_PLAN_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the user_periodic_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserPeriodicPlanId(1234); // WHERE user_periodic_plan_id = 1234
     * $query->filterByUserPeriodicPlanId(array(12, 34)); // WHERE user_periodic_plan_id IN (12, 34)
     * $query->filterByUserPeriodicPlanId(array('min' => 12)); // WHERE user_periodic_plan_id > 12
     * </code>
     *
     * @param     mixed $userPeriodicPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByUserPeriodicPlanId($userPeriodicPlanId = null, $comparison = null)
    {
        if (is_array($userPeriodicPlanId)) {
            $useMinMax = false;
            if (isset($userPeriodicPlanId['min'])) {
                $this->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_PERIODIC_PLAN_ID, $userPeriodicPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userPeriodicPlanId['max'])) {
                $this->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_PERIODIC_PLAN_ID, $userPeriodicPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_PERIODIC_PLAN_ID, $userPeriodicPlanId, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_ID, $userId, $comparison);
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
     * @return $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlanId($periodicPlanId = null, $comparison = null)
    {
        if (is_array($periodicPlanId)) {
            $useMinMax = false;
            if (isset($periodicPlanId['min'])) {
                $this->addUsingAlias(UserPeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $periodicPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($periodicPlanId['max'])) {
                $this->addUsingAlias(UserPeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $periodicPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $periodicPlanId, $comparison);
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
     * @return $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UserPeriodicPlanTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UserPeriodicPlanTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeriodicPlanTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UserPeriodicPlanTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UserPeriodicPlanTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeriodicPlanTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\User object
     *
     * @param \App\Propel\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \App\Propel\User) {
            return $this
                ->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_ID, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \App\Propel\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\App\Propel\UserQuery');
    }

    /**
     * Filter the query by a related \App\Propel\PeriodicPlan object
     *
     * @param \App\Propel\PeriodicPlan|ObjectCollection $periodicPlan The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlan($periodicPlan, $comparison = null)
    {
        if ($periodicPlan instanceof \App\Propel\PeriodicPlan) {
            return $this
                ->addUsingAlias(UserPeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $periodicPlan->getPeriodicPlanId(), $comparison);
        } elseif ($periodicPlan instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserPeriodicPlanTableMap::COL_PERIODIC_PLAN_ID, $periodicPlan->toKeyValue('PrimaryKey', 'PeriodicPlanId'), $comparison);
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
     * @return $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
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
     * @param   ChildUserPeriodicPlan $userPeriodicPlan Object to remove from the list of results
     *
     * @return $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function prune($userPeriodicPlan = null)
    {
        if ($userPeriodicPlan) {
            $this->addUsingAlias(UserPeriodicPlanTableMap::COL_USER_PERIODIC_PLAN_ID, $userPeriodicPlan->getUserPeriodicPlanId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_periodic_plan table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserPeriodicPlanTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserPeriodicPlanTableMap::clearInstancePool();
            UserPeriodicPlanTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserPeriodicPlanTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserPeriodicPlanTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserPeriodicPlanTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserPeriodicPlanTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UserPeriodicPlanTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserPeriodicPlanTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserPeriodicPlanTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserPeriodicPlanTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UserPeriodicPlanTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildUserPeriodicPlanQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserPeriodicPlanTableMap::COL_CREATED_AT);
    }

} // UserPeriodicPlanQuery
