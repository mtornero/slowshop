<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\SocialRecommendation as ChildSocialRecommendation;
use App\Propel\SocialRecommendationQuery as ChildSocialRecommendationQuery;
use App\Propel\Map\SocialRecommendationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'social_recommendation' table.
 *
 *
 *
 * @method     ChildSocialRecommendationQuery orderBySocialRecommendationId($order = Criteria::ASC) Order by the social_recommendation_id column
 * @method     ChildSocialRecommendationQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildSocialRecommendationQuery orderBySocialRecommendationFor($order = Criteria::ASC) Order by the social_recommendation_for column
 * @method     ChildSocialRecommendationQuery orderBySocialRecommendationTo($order = Criteria::ASC) Order by the social_recommendation_to column
 * @method     ChildSocialRecommendationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSocialRecommendationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSocialRecommendationQuery groupBySocialRecommendationId() Group by the social_recommendation_id column
 * @method     ChildSocialRecommendationQuery groupByUserId() Group by the user_id column
 * @method     ChildSocialRecommendationQuery groupBySocialRecommendationFor() Group by the social_recommendation_for column
 * @method     ChildSocialRecommendationQuery groupBySocialRecommendationTo() Group by the social_recommendation_to column
 * @method     ChildSocialRecommendationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSocialRecommendationQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSocialRecommendationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSocialRecommendationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSocialRecommendationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSocialRecommendationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSocialRecommendationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSocialRecommendationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSocialRecommendationQuery leftJoinUserRelatedByUserId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUserId relation
 * @method     ChildSocialRecommendationQuery rightJoinUserRelatedByUserId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUserId relation
 * @method     ChildSocialRecommendationQuery innerJoinUserRelatedByUserId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUserId relation
 *
 * @method     ChildSocialRecommendationQuery joinWithUserRelatedByUserId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRelatedByUserId relation
 *
 * @method     ChildSocialRecommendationQuery leftJoinWithUserRelatedByUserId() Adds a LEFT JOIN clause and with to the query using the UserRelatedByUserId relation
 * @method     ChildSocialRecommendationQuery rightJoinWithUserRelatedByUserId() Adds a RIGHT JOIN clause and with to the query using the UserRelatedByUserId relation
 * @method     ChildSocialRecommendationQuery innerJoinWithUserRelatedByUserId() Adds a INNER JOIN clause and with to the query using the UserRelatedByUserId relation
 *
 * @method     ChildSocialRecommendationQuery leftJoinResource($relationAlias = null) Adds a LEFT JOIN clause to the query using the Resource relation
 * @method     ChildSocialRecommendationQuery rightJoinResource($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Resource relation
 * @method     ChildSocialRecommendationQuery innerJoinResource($relationAlias = null) Adds a INNER JOIN clause to the query using the Resource relation
 *
 * @method     ChildSocialRecommendationQuery joinWithResource($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Resource relation
 *
 * @method     ChildSocialRecommendationQuery leftJoinWithResource() Adds a LEFT JOIN clause and with to the query using the Resource relation
 * @method     ChildSocialRecommendationQuery rightJoinWithResource() Adds a RIGHT JOIN clause and with to the query using the Resource relation
 * @method     ChildSocialRecommendationQuery innerJoinWithResource() Adds a INNER JOIN clause and with to the query using the Resource relation
 *
 * @method     ChildSocialRecommendationQuery leftJoinUserRelatedBySocialRecommendationTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedBySocialRecommendationTo relation
 * @method     ChildSocialRecommendationQuery rightJoinUserRelatedBySocialRecommendationTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedBySocialRecommendationTo relation
 * @method     ChildSocialRecommendationQuery innerJoinUserRelatedBySocialRecommendationTo($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedBySocialRecommendationTo relation
 *
 * @method     ChildSocialRecommendationQuery joinWithUserRelatedBySocialRecommendationTo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRelatedBySocialRecommendationTo relation
 *
 * @method     ChildSocialRecommendationQuery leftJoinWithUserRelatedBySocialRecommendationTo() Adds a LEFT JOIN clause and with to the query using the UserRelatedBySocialRecommendationTo relation
 * @method     ChildSocialRecommendationQuery rightJoinWithUserRelatedBySocialRecommendationTo() Adds a RIGHT JOIN clause and with to the query using the UserRelatedBySocialRecommendationTo relation
 * @method     ChildSocialRecommendationQuery innerJoinWithUserRelatedBySocialRecommendationTo() Adds a INNER JOIN clause and with to the query using the UserRelatedBySocialRecommendationTo relation
 *
 * @method     \App\Propel\UserQuery|\App\Propel\ResourceQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSocialRecommendation findOne(ConnectionInterface $con = null) Return the first ChildSocialRecommendation matching the query
 * @method     ChildSocialRecommendation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSocialRecommendation matching the query, or a new ChildSocialRecommendation object populated from the query conditions when no match is found
 *
 * @method     ChildSocialRecommendation findOneBySocialRecommendationId(int $social_recommendation_id) Return the first ChildSocialRecommendation filtered by the social_recommendation_id column
 * @method     ChildSocialRecommendation findOneByUserId(int $user_id) Return the first ChildSocialRecommendation filtered by the user_id column
 * @method     ChildSocialRecommendation findOneBySocialRecommendationFor(int $social_recommendation_for) Return the first ChildSocialRecommendation filtered by the social_recommendation_for column
 * @method     ChildSocialRecommendation findOneBySocialRecommendationTo(int $social_recommendation_to) Return the first ChildSocialRecommendation filtered by the social_recommendation_to column
 * @method     ChildSocialRecommendation findOneByCreatedAt(string $created_at) Return the first ChildSocialRecommendation filtered by the created_at column
 * @method     ChildSocialRecommendation findOneByUpdatedAt(string $updated_at) Return the first ChildSocialRecommendation filtered by the updated_at column *

 * @method     ChildSocialRecommendation requirePk($key, ConnectionInterface $con = null) Return the ChildSocialRecommendation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSocialRecommendation requireOne(ConnectionInterface $con = null) Return the first ChildSocialRecommendation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSocialRecommendation requireOneBySocialRecommendationId(int $social_recommendation_id) Return the first ChildSocialRecommendation filtered by the social_recommendation_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSocialRecommendation requireOneByUserId(int $user_id) Return the first ChildSocialRecommendation filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSocialRecommendation requireOneBySocialRecommendationFor(int $social_recommendation_for) Return the first ChildSocialRecommendation filtered by the social_recommendation_for column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSocialRecommendation requireOneBySocialRecommendationTo(int $social_recommendation_to) Return the first ChildSocialRecommendation filtered by the social_recommendation_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSocialRecommendation requireOneByCreatedAt(string $created_at) Return the first ChildSocialRecommendation filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSocialRecommendation requireOneByUpdatedAt(string $updated_at) Return the first ChildSocialRecommendation filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSocialRecommendation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSocialRecommendation objects based on current ModelCriteria
 * @method     ChildSocialRecommendation[]|ObjectCollection findBySocialRecommendationId(int $social_recommendation_id) Return ChildSocialRecommendation objects filtered by the social_recommendation_id column
 * @method     ChildSocialRecommendation[]|ObjectCollection findByUserId(int $user_id) Return ChildSocialRecommendation objects filtered by the user_id column
 * @method     ChildSocialRecommendation[]|ObjectCollection findBySocialRecommendationFor(int $social_recommendation_for) Return ChildSocialRecommendation objects filtered by the social_recommendation_for column
 * @method     ChildSocialRecommendation[]|ObjectCollection findBySocialRecommendationTo(int $social_recommendation_to) Return ChildSocialRecommendation objects filtered by the social_recommendation_to column
 * @method     ChildSocialRecommendation[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildSocialRecommendation objects filtered by the created_at column
 * @method     ChildSocialRecommendation[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildSocialRecommendation objects filtered by the updated_at column
 * @method     ChildSocialRecommendation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SocialRecommendationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\SocialRecommendationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\SocialRecommendation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSocialRecommendationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSocialRecommendationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSocialRecommendationQuery) {
            return $criteria;
        }
        $query = new ChildSocialRecommendationQuery();
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
     * @return ChildSocialRecommendation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SocialRecommendationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SocialRecommendationTableMap::DATABASE_NAME);
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
     * @return ChildSocialRecommendation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT social_recommendation_id, user_id, social_recommendation_for, social_recommendation_to, created_at, updated_at FROM social_recommendation WHERE social_recommendation_id = :p0';
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
            /** @var ChildSocialRecommendation $obj */
            $obj = new ChildSocialRecommendation();
            $obj->hydrate($row);
            SocialRecommendationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSocialRecommendation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the social_recommendation_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySocialRecommendationId(1234); // WHERE social_recommendation_id = 1234
     * $query->filterBySocialRecommendationId(array(12, 34)); // WHERE social_recommendation_id IN (12, 34)
     * $query->filterBySocialRecommendationId(array('min' => 12)); // WHERE social_recommendation_id > 12
     * </code>
     *
     * @param     mixed $socialRecommendationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterBySocialRecommendationId($socialRecommendationId = null, $comparison = null)
    {
        if (is_array($socialRecommendationId)) {
            $useMinMax = false;
            if (isset($socialRecommendationId['min'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_ID, $socialRecommendationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($socialRecommendationId['max'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_ID, $socialRecommendationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_ID, $socialRecommendationId, $comparison);
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
     * @see       filterByUserRelatedByUserId()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SocialRecommendationTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the social_recommendation_for column
     *
     * Example usage:
     * <code>
     * $query->filterBySocialRecommendationFor(1234); // WHERE social_recommendation_for = 1234
     * $query->filterBySocialRecommendationFor(array(12, 34)); // WHERE social_recommendation_for IN (12, 34)
     * $query->filterBySocialRecommendationFor(array('min' => 12)); // WHERE social_recommendation_for > 12
     * </code>
     *
     * @see       filterByResource()
     *
     * @param     mixed $socialRecommendationFor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterBySocialRecommendationFor($socialRecommendationFor = null, $comparison = null)
    {
        if (is_array($socialRecommendationFor)) {
            $useMinMax = false;
            if (isset($socialRecommendationFor['min'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_FOR, $socialRecommendationFor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($socialRecommendationFor['max'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_FOR, $socialRecommendationFor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_FOR, $socialRecommendationFor, $comparison);
    }

    /**
     * Filter the query on the social_recommendation_to column
     *
     * Example usage:
     * <code>
     * $query->filterBySocialRecommendationTo(1234); // WHERE social_recommendation_to = 1234
     * $query->filterBySocialRecommendationTo(array(12, 34)); // WHERE social_recommendation_to IN (12, 34)
     * $query->filterBySocialRecommendationTo(array('min' => 12)); // WHERE social_recommendation_to > 12
     * </code>
     *
     * @see       filterByUserRelatedBySocialRecommendationTo()
     *
     * @param     mixed $socialRecommendationTo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterBySocialRecommendationTo($socialRecommendationTo = null, $comparison = null)
    {
        if (is_array($socialRecommendationTo)) {
            $useMinMax = false;
            if (isset($socialRecommendationTo['min'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_TO, $socialRecommendationTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($socialRecommendationTo['max'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_TO, $socialRecommendationTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_TO, $socialRecommendationTo, $comparison);
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
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SocialRecommendationTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SocialRecommendationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SocialRecommendationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\User object
     *
     * @param \App\Propel\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByUserId($user, $comparison = null)
    {
        if ($user instanceof \App\Propel\User) {
            return $this
                ->addUsingAlias(SocialRecommendationTableMap::COL_USER_ID, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SocialRecommendationTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByUserId() only accepts arguments of type \App\Propel\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByUserId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function joinUserRelatedByUserId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByUserId');

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
            $this->addJoinObject($join, 'UserRelatedByUserId');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByUserId relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByUserIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserRelatedByUserId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByUserId', '\App\Propel\UserQuery');
    }

    /**
     * Filter the query by a related \App\Propel\Resource object
     *
     * @param \App\Propel\Resource|ObjectCollection $resource The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterByResource($resource, $comparison = null)
    {
        if ($resource instanceof \App\Propel\Resource) {
            return $this
                ->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_FOR, $resource->getResourceId(), $comparison);
        } elseif ($resource instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_FOR, $resource->toKeyValue('PrimaryKey', 'ResourceId'), $comparison);
        } else {
            throw new PropelException('filterByResource() only accepts arguments of type \App\Propel\Resource or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Resource relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function joinResource($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Resource');

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
            $this->addJoinObject($join, 'Resource');
        }

        return $this;
    }

    /**
     * Use the Resource relation Resource object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ResourceQuery A secondary query class using the current class as primary query
     */
    public function useResourceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinResource($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Resource', '\App\Propel\ResourceQuery');
    }

    /**
     * Filter the query by a related \App\Propel\User object
     *
     * @param \App\Propel\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function filterByUserRelatedBySocialRecommendationTo($user, $comparison = null)
    {
        if ($user instanceof \App\Propel\User) {
            return $this
                ->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_TO, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_TO, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedBySocialRecommendationTo() only accepts arguments of type \App\Propel\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedBySocialRecommendationTo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function joinUserRelatedBySocialRecommendationTo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedBySocialRecommendationTo');

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
            $this->addJoinObject($join, 'UserRelatedBySocialRecommendationTo');
        }

        return $this;
    }

    /**
     * Use the UserRelatedBySocialRecommendationTo relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedBySocialRecommendationToQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserRelatedBySocialRecommendationTo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedBySocialRecommendationTo', '\App\Propel\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSocialRecommendation $socialRecommendation Object to remove from the list of results
     *
     * @return $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function prune($socialRecommendation = null)
    {
        if ($socialRecommendation) {
            $this->addUsingAlias(SocialRecommendationTableMap::COL_SOCIAL_RECOMMENDATION_ID, $socialRecommendation->getSocialRecommendationId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the social_recommendation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SocialRecommendationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SocialRecommendationTableMap::clearInstancePool();
            SocialRecommendationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SocialRecommendationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SocialRecommendationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SocialRecommendationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SocialRecommendationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(SocialRecommendationTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(SocialRecommendationTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(SocialRecommendationTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(SocialRecommendationTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(SocialRecommendationTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildSocialRecommendationQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(SocialRecommendationTableMap::COL_CREATED_AT);
    }

} // SocialRecommendationQuery
