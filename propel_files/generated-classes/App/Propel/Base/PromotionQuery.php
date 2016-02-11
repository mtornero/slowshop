<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Promotion as ChildPromotion;
use App\Propel\PromotionQuery as ChildPromotionQuery;
use App\Propel\Map\PromotionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'promotion' table.
 *
 *
 *
 * @method     ChildPromotionQuery orderByPromotionId($order = Criteria::ASC) Order by the promotion_id column
 * @method     ChildPromotionQuery orderByResourceId($order = Criteria::ASC) Order by the resource_id column
 * @method     ChildPromotionQuery orderByPromotionTypeId($order = Criteria::ASC) Order by the promotion_type_id column
 * @method     ChildPromotionQuery orderByPromotionValue($order = Criteria::ASC) Order by the promotion_value column
 * @method     ChildPromotionQuery orderByPromotionGift($order = Criteria::ASC) Order by the promotion_gift column
 * @method     ChildPromotionQuery orderByPromotionDescription($order = Criteria::ASC) Order by the promotion_description column
 * @method     ChildPromotionQuery orderByPromotionStartingPoint($order = Criteria::ASC) Order by the promotion_starting_point column
 * @method     ChildPromotionQuery orderByPromotionStartingDate($order = Criteria::ASC) Order by the promotion_starting_date column
 * @method     ChildPromotionQuery orderByPromotionEndingDate($order = Criteria::ASC) Order by the promotion_ending_date column
 * @method     ChildPromotionQuery orderByPromotionIsActive($order = Criteria::ASC) Order by the promotion_is_active column
 * @method     ChildPromotionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPromotionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPromotionQuery groupByPromotionId() Group by the promotion_id column
 * @method     ChildPromotionQuery groupByResourceId() Group by the resource_id column
 * @method     ChildPromotionQuery groupByPromotionTypeId() Group by the promotion_type_id column
 * @method     ChildPromotionQuery groupByPromotionValue() Group by the promotion_value column
 * @method     ChildPromotionQuery groupByPromotionGift() Group by the promotion_gift column
 * @method     ChildPromotionQuery groupByPromotionDescription() Group by the promotion_description column
 * @method     ChildPromotionQuery groupByPromotionStartingPoint() Group by the promotion_starting_point column
 * @method     ChildPromotionQuery groupByPromotionStartingDate() Group by the promotion_starting_date column
 * @method     ChildPromotionQuery groupByPromotionEndingDate() Group by the promotion_ending_date column
 * @method     ChildPromotionQuery groupByPromotionIsActive() Group by the promotion_is_active column
 * @method     ChildPromotionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPromotionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPromotionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPromotionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPromotionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPromotionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPromotionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPromotionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPromotionQuery leftJoinResource($relationAlias = null) Adds a LEFT JOIN clause to the query using the Resource relation
 * @method     ChildPromotionQuery rightJoinResource($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Resource relation
 * @method     ChildPromotionQuery innerJoinResource($relationAlias = null) Adds a INNER JOIN clause to the query using the Resource relation
 *
 * @method     ChildPromotionQuery joinWithResource($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Resource relation
 *
 * @method     ChildPromotionQuery leftJoinWithResource() Adds a LEFT JOIN clause and with to the query using the Resource relation
 * @method     ChildPromotionQuery rightJoinWithResource() Adds a RIGHT JOIN clause and with to the query using the Resource relation
 * @method     ChildPromotionQuery innerJoinWithResource() Adds a INNER JOIN clause and with to the query using the Resource relation
 *
 * @method     ChildPromotionQuery leftJoinPromotionType($relationAlias = null) Adds a LEFT JOIN clause to the query using the PromotionType relation
 * @method     ChildPromotionQuery rightJoinPromotionType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PromotionType relation
 * @method     ChildPromotionQuery innerJoinPromotionType($relationAlias = null) Adds a INNER JOIN clause to the query using the PromotionType relation
 *
 * @method     ChildPromotionQuery joinWithPromotionType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PromotionType relation
 *
 * @method     ChildPromotionQuery leftJoinWithPromotionType() Adds a LEFT JOIN clause and with to the query using the PromotionType relation
 * @method     ChildPromotionQuery rightJoinWithPromotionType() Adds a RIGHT JOIN clause and with to the query using the PromotionType relation
 * @method     ChildPromotionQuery innerJoinWithPromotionType() Adds a INNER JOIN clause and with to the query using the PromotionType relation
 *
 * @method     \App\Propel\ResourceQuery|\App\Propel\PromotionTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPromotion findOne(ConnectionInterface $con = null) Return the first ChildPromotion matching the query
 * @method     ChildPromotion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPromotion matching the query, or a new ChildPromotion object populated from the query conditions when no match is found
 *
 * @method     ChildPromotion findOneByPromotionId(int $promotion_id) Return the first ChildPromotion filtered by the promotion_id column
 * @method     ChildPromotion findOneByResourceId(int $resource_id) Return the first ChildPromotion filtered by the resource_id column
 * @method     ChildPromotion findOneByPromotionTypeId(int $promotion_type_id) Return the first ChildPromotion filtered by the promotion_type_id column
 * @method     ChildPromotion findOneByPromotionValue(string $promotion_value) Return the first ChildPromotion filtered by the promotion_value column
 * @method     ChildPromotion findOneByPromotionGift(int $promotion_gift) Return the first ChildPromotion filtered by the promotion_gift column
 * @method     ChildPromotion findOneByPromotionDescription(string $promotion_description) Return the first ChildPromotion filtered by the promotion_description column
 * @method     ChildPromotion findOneByPromotionStartingPoint(int $promotion_starting_point) Return the first ChildPromotion filtered by the promotion_starting_point column
 * @method     ChildPromotion findOneByPromotionStartingDate(string $promotion_starting_date) Return the first ChildPromotion filtered by the promotion_starting_date column
 * @method     ChildPromotion findOneByPromotionEndingDate(string $promotion_ending_date) Return the first ChildPromotion filtered by the promotion_ending_date column
 * @method     ChildPromotion findOneByPromotionIsActive(boolean $promotion_is_active) Return the first ChildPromotion filtered by the promotion_is_active column
 * @method     ChildPromotion findOneByCreatedAt(string $created_at) Return the first ChildPromotion filtered by the created_at column
 * @method     ChildPromotion findOneByUpdatedAt(string $updated_at) Return the first ChildPromotion filtered by the updated_at column *

 * @method     ChildPromotion requirePk($key, ConnectionInterface $con = null) Return the ChildPromotion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOne(ConnectionInterface $con = null) Return the first ChildPromotion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPromotion requireOneByPromotionId(int $promotion_id) Return the first ChildPromotion filtered by the promotion_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByResourceId(int $resource_id) Return the first ChildPromotion filtered by the resource_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByPromotionTypeId(int $promotion_type_id) Return the first ChildPromotion filtered by the promotion_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByPromotionValue(string $promotion_value) Return the first ChildPromotion filtered by the promotion_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByPromotionGift(int $promotion_gift) Return the first ChildPromotion filtered by the promotion_gift column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByPromotionDescription(string $promotion_description) Return the first ChildPromotion filtered by the promotion_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByPromotionStartingPoint(int $promotion_starting_point) Return the first ChildPromotion filtered by the promotion_starting_point column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByPromotionStartingDate(string $promotion_starting_date) Return the first ChildPromotion filtered by the promotion_starting_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByPromotionEndingDate(string $promotion_ending_date) Return the first ChildPromotion filtered by the promotion_ending_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByPromotionIsActive(boolean $promotion_is_active) Return the first ChildPromotion filtered by the promotion_is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByCreatedAt(string $created_at) Return the first ChildPromotion filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotion requireOneByUpdatedAt(string $updated_at) Return the first ChildPromotion filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPromotion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPromotion objects based on current ModelCriteria
 * @method     ChildPromotion[]|ObjectCollection findByPromotionId(int $promotion_id) Return ChildPromotion objects filtered by the promotion_id column
 * @method     ChildPromotion[]|ObjectCollection findByResourceId(int $resource_id) Return ChildPromotion objects filtered by the resource_id column
 * @method     ChildPromotion[]|ObjectCollection findByPromotionTypeId(int $promotion_type_id) Return ChildPromotion objects filtered by the promotion_type_id column
 * @method     ChildPromotion[]|ObjectCollection findByPromotionValue(string $promotion_value) Return ChildPromotion objects filtered by the promotion_value column
 * @method     ChildPromotion[]|ObjectCollection findByPromotionGift(int $promotion_gift) Return ChildPromotion objects filtered by the promotion_gift column
 * @method     ChildPromotion[]|ObjectCollection findByPromotionDescription(string $promotion_description) Return ChildPromotion objects filtered by the promotion_description column
 * @method     ChildPromotion[]|ObjectCollection findByPromotionStartingPoint(int $promotion_starting_point) Return ChildPromotion objects filtered by the promotion_starting_point column
 * @method     ChildPromotion[]|ObjectCollection findByPromotionStartingDate(string $promotion_starting_date) Return ChildPromotion objects filtered by the promotion_starting_date column
 * @method     ChildPromotion[]|ObjectCollection findByPromotionEndingDate(string $promotion_ending_date) Return ChildPromotion objects filtered by the promotion_ending_date column
 * @method     ChildPromotion[]|ObjectCollection findByPromotionIsActive(boolean $promotion_is_active) Return ChildPromotion objects filtered by the promotion_is_active column
 * @method     ChildPromotion[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPromotion objects filtered by the created_at column
 * @method     ChildPromotion[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPromotion objects filtered by the updated_at column
 * @method     ChildPromotion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PromotionQuery extends ModelCriteria
{

    // delegate behavior

    protected $delegatedFields = [
        'ResourceTypeId' => 'Resource',
        'SocialViews' => 'Resource',
        'SocialLikes' => 'Resource',
        'SocialDislikes' => 'Resource',
        'SocialComments' => 'Resource',
        'SocialFavourites' => 'Resource',
        'SocialRecommendations' => 'Resource',
    ];

protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\PromotionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\Promotion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPromotionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPromotionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPromotionQuery) {
            return $criteria;
        }
        $query = new ChildPromotionQuery();
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
     * @return ChildPromotion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PromotionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PromotionTableMap::DATABASE_NAME);
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
     * @return ChildPromotion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT promotion_id, resource_id, promotion_type_id, promotion_value, promotion_gift, promotion_description, promotion_starting_point, promotion_starting_date, promotion_ending_date, promotion_is_active, created_at, updated_at FROM promotion WHERE promotion_id = :p0';
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
            /** @var ChildPromotion $obj */
            $obj = new ChildPromotion();
            $obj->hydrate($row);
            PromotionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPromotion|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the promotion_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionId(1234); // WHERE promotion_id = 1234
     * $query->filterByPromotionId(array(12, 34)); // WHERE promotion_id IN (12, 34)
     * $query->filterByPromotionId(array('min' => 12)); // WHERE promotion_id > 12
     * </code>
     *
     * @param     mixed $promotionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPromotionId($promotionId = null, $comparison = null)
    {
        if (is_array($promotionId)) {
            $useMinMax = false;
            if (isset($promotionId['min'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_ID, $promotionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promotionId['max'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_ID, $promotionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_ID, $promotionId, $comparison);
    }

    /**
     * Filter the query on the resource_id column
     *
     * Example usage:
     * <code>
     * $query->filterByResourceId(1234); // WHERE resource_id = 1234
     * $query->filterByResourceId(array(12, 34)); // WHERE resource_id IN (12, 34)
     * $query->filterByResourceId(array('min' => 12)); // WHERE resource_id > 12
     * </code>
     *
     * @see       filterByResource()
     *
     * @param     mixed $resourceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByResourceId($resourceId = null, $comparison = null)
    {
        if (is_array($resourceId)) {
            $useMinMax = false;
            if (isset($resourceId['min'])) {
                $this->addUsingAlias(PromotionTableMap::COL_RESOURCE_ID, $resourceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resourceId['max'])) {
                $this->addUsingAlias(PromotionTableMap::COL_RESOURCE_ID, $resourceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_RESOURCE_ID, $resourceId, $comparison);
    }

    /**
     * Filter the query on the promotion_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionTypeId(1234); // WHERE promotion_type_id = 1234
     * $query->filterByPromotionTypeId(array(12, 34)); // WHERE promotion_type_id IN (12, 34)
     * $query->filterByPromotionTypeId(array('min' => 12)); // WHERE promotion_type_id > 12
     * </code>
     *
     * @see       filterByPromotionType()
     *
     * @param     mixed $promotionTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPromotionTypeId($promotionTypeId = null, $comparison = null)
    {
        if (is_array($promotionTypeId)) {
            $useMinMax = false;
            if (isset($promotionTypeId['min'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_TYPE_ID, $promotionTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promotionTypeId['max'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_TYPE_ID, $promotionTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_TYPE_ID, $promotionTypeId, $comparison);
    }

    /**
     * Filter the query on the promotion_value column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionValue(1234); // WHERE promotion_value = 1234
     * $query->filterByPromotionValue(array(12, 34)); // WHERE promotion_value IN (12, 34)
     * $query->filterByPromotionValue(array('min' => 12)); // WHERE promotion_value > 12
     * </code>
     *
     * @param     mixed $promotionValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPromotionValue($promotionValue = null, $comparison = null)
    {
        if (is_array($promotionValue)) {
            $useMinMax = false;
            if (isset($promotionValue['min'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_VALUE, $promotionValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promotionValue['max'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_VALUE, $promotionValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_VALUE, $promotionValue, $comparison);
    }

    /**
     * Filter the query on the promotion_gift column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionGift(1234); // WHERE promotion_gift = 1234
     * $query->filterByPromotionGift(array(12, 34)); // WHERE promotion_gift IN (12, 34)
     * $query->filterByPromotionGift(array('min' => 12)); // WHERE promotion_gift > 12
     * </code>
     *
     * @param     mixed $promotionGift The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPromotionGift($promotionGift = null, $comparison = null)
    {
        if (is_array($promotionGift)) {
            $useMinMax = false;
            if (isset($promotionGift['min'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_GIFT, $promotionGift['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promotionGift['max'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_GIFT, $promotionGift['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_GIFT, $promotionGift, $comparison);
    }

    /**
     * Filter the query on the promotion_description column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionDescription('fooValue');   // WHERE promotion_description = 'fooValue'
     * $query->filterByPromotionDescription('%fooValue%'); // WHERE promotion_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $promotionDescription The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPromotionDescription($promotionDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($promotionDescription)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $promotionDescription)) {
                $promotionDescription = str_replace('*', '%', $promotionDescription);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_DESCRIPTION, $promotionDescription, $comparison);
    }

    /**
     * Filter the query on the promotion_starting_point column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionStartingPoint(1234); // WHERE promotion_starting_point = 1234
     * $query->filterByPromotionStartingPoint(array(12, 34)); // WHERE promotion_starting_point IN (12, 34)
     * $query->filterByPromotionStartingPoint(array('min' => 12)); // WHERE promotion_starting_point > 12
     * </code>
     *
     * @param     mixed $promotionStartingPoint The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPromotionStartingPoint($promotionStartingPoint = null, $comparison = null)
    {
        if (is_array($promotionStartingPoint)) {
            $useMinMax = false;
            if (isset($promotionStartingPoint['min'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_STARTING_POINT, $promotionStartingPoint['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promotionStartingPoint['max'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_STARTING_POINT, $promotionStartingPoint['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_STARTING_POINT, $promotionStartingPoint, $comparison);
    }

    /**
     * Filter the query on the promotion_starting_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionStartingDate('2011-03-14'); // WHERE promotion_starting_date = '2011-03-14'
     * $query->filterByPromotionStartingDate('now'); // WHERE promotion_starting_date = '2011-03-14'
     * $query->filterByPromotionStartingDate(array('max' => 'yesterday')); // WHERE promotion_starting_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $promotionStartingDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPromotionStartingDate($promotionStartingDate = null, $comparison = null)
    {
        if (is_array($promotionStartingDate)) {
            $useMinMax = false;
            if (isset($promotionStartingDate['min'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_STARTING_DATE, $promotionStartingDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promotionStartingDate['max'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_STARTING_DATE, $promotionStartingDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_STARTING_DATE, $promotionStartingDate, $comparison);
    }

    /**
     * Filter the query on the promotion_ending_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionEndingDate('2011-03-14'); // WHERE promotion_ending_date = '2011-03-14'
     * $query->filterByPromotionEndingDate('now'); // WHERE promotion_ending_date = '2011-03-14'
     * $query->filterByPromotionEndingDate(array('max' => 'yesterday')); // WHERE promotion_ending_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $promotionEndingDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPromotionEndingDate($promotionEndingDate = null, $comparison = null)
    {
        if (is_array($promotionEndingDate)) {
            $useMinMax = false;
            if (isset($promotionEndingDate['min'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_ENDING_DATE, $promotionEndingDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promotionEndingDate['max'])) {
                $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_ENDING_DATE, $promotionEndingDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_ENDING_DATE, $promotionEndingDate, $comparison);
    }

    /**
     * Filter the query on the promotion_is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionIsActive(true); // WHERE promotion_is_active = true
     * $query->filterByPromotionIsActive('yes'); // WHERE promotion_is_active = true
     * </code>
     *
     * @param     boolean|string $promotionIsActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPromotionIsActive($promotionIsActive = null, $comparison = null)
    {
        if (is_string($promotionIsActive)) {
            $promotionIsActive = in_array(strtolower($promotionIsActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_IS_ACTIVE, $promotionIsActive, $comparison);
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
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PromotionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PromotionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PromotionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PromotionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Resource object
     *
     * @param \App\Propel\Resource|ObjectCollection $resource The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByResource($resource, $comparison = null)
    {
        if ($resource instanceof \App\Propel\Resource) {
            return $this
                ->addUsingAlias(PromotionTableMap::COL_RESOURCE_ID, $resource->getResourceId(), $comparison);
        } elseif ($resource instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PromotionTableMap::COL_RESOURCE_ID, $resource->toKeyValue('PrimaryKey', 'ResourceId'), $comparison);
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
     * @return $this|ChildPromotionQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\PromotionType object
     *
     * @param \App\Propel\PromotionType|ObjectCollection $promotionType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPromotionQuery The current query, for fluid interface
     */
    public function filterByPromotionType($promotionType, $comparison = null)
    {
        if ($promotionType instanceof \App\Propel\PromotionType) {
            return $this
                ->addUsingAlias(PromotionTableMap::COL_PROMOTION_TYPE_ID, $promotionType->getPromotionTypeId(), $comparison);
        } elseif ($promotionType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PromotionTableMap::COL_PROMOTION_TYPE_ID, $promotionType->toKeyValue('PrimaryKey', 'PromotionTypeId'), $comparison);
        } else {
            throw new PropelException('filterByPromotionType() only accepts arguments of type \App\Propel\PromotionType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PromotionType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function joinPromotionType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PromotionType');

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
            $this->addJoinObject($join, 'PromotionType');
        }

        return $this;
    }

    /**
     * Use the PromotionType relation PromotionType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\PromotionTypeQuery A secondary query class using the current class as primary query
     */
    public function usePromotionTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPromotionType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PromotionType', '\App\Propel\PromotionTypeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPromotion $promotion Object to remove from the list of results
     *
     * @return $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function prune($promotion = null)
    {
        if ($promotion) {
            $this->addUsingAlias(PromotionTableMap::COL_PROMOTION_ID, $promotion->getPromotionId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the promotion table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PromotionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PromotionTableMap::clearInstancePool();
            PromotionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PromotionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PromotionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PromotionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PromotionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // delegate behavior
    /**
    * Filter the query by resource_type_id column
    *
    * Example usage:
    * <code>
        * $query->filterByResourceTypeId(1234); // WHERE resource_type_id = 1234
        * $query->filterByResourceTypeId(array(12, 34)); // WHERE resource_type_id IN (12, 34)
        * $query->filterByResourceTypeId(array('min' => 12)); // WHERE resource_type_id > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildPromotionQuery The current query, for fluid interface
    */
    public function filterByResourceTypeId($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterByResourceTypeId($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderByResourceTypeId($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderByResourceTypeId($order)->endUse();
    }
    /**
    * Filter the query by social_views column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialViews(1234); // WHERE social_views = 1234
        * $query->filterBySocialViews(array(12, 34)); // WHERE social_views IN (12, 34)
        * $query->filterBySocialViews(array('min' => 12)); // WHERE social_views > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildPromotionQuery The current query, for fluid interface
    */
    public function filterBySocialViews($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialViews($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialViews($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialViews($order)->endUse();
    }
    /**
    * Filter the query by social_likes column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialLikes(1234); // WHERE social_likes = 1234
        * $query->filterBySocialLikes(array(12, 34)); // WHERE social_likes IN (12, 34)
        * $query->filterBySocialLikes(array('min' => 12)); // WHERE social_likes > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildPromotionQuery The current query, for fluid interface
    */
    public function filterBySocialLikes($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialLikes($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialLikes($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialLikes($order)->endUse();
    }
    /**
    * Filter the query by social_dislikes column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialDislikes(1234); // WHERE social_dislikes = 1234
        * $query->filterBySocialDislikes(array(12, 34)); // WHERE social_dislikes IN (12, 34)
        * $query->filterBySocialDislikes(array('min' => 12)); // WHERE social_dislikes > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildPromotionQuery The current query, for fluid interface
    */
    public function filterBySocialDislikes($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialDislikes($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialDislikes($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialDislikes($order)->endUse();
    }
    /**
    * Filter the query by social_comments column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialComments(1234); // WHERE social_comments = 1234
        * $query->filterBySocialComments(array(12, 34)); // WHERE social_comments IN (12, 34)
        * $query->filterBySocialComments(array('min' => 12)); // WHERE social_comments > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildPromotionQuery The current query, for fluid interface
    */
    public function filterBySocialComments($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialComments($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialComments($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialComments($order)->endUse();
    }
    /**
    * Filter the query by social_favourites column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialFavourites(1234); // WHERE social_favourites = 1234
        * $query->filterBySocialFavourites(array(12, 34)); // WHERE social_favourites IN (12, 34)
        * $query->filterBySocialFavourites(array('min' => 12)); // WHERE social_favourites > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildPromotionQuery The current query, for fluid interface
    */
    public function filterBySocialFavourites($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialFavourites($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialFavourites($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialFavourites($order)->endUse();
    }
    /**
    * Filter the query by social_recommendations column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialRecommendations(1234); // WHERE social_recommendations = 1234
        * $query->filterBySocialRecommendations(array(12, 34)); // WHERE social_recommendations IN (12, 34)
        * $query->filterBySocialRecommendations(array('min' => 12)); // WHERE social_recommendations > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildPromotionQuery The current query, for fluid interface
    */
    public function filterBySocialRecommendations($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialRecommendations($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialRecommendations($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialRecommendations($order)->endUse();
    }

    /**
     * Adds a condition on a column based on a column phpName and a value
     * Uses introspection to translate the column phpName into a fully qualified name
     * Warning: recognizes only the phpNames of the main Model (not joined tables)
     * <code>
     * $c->filterBy('Title', 'foo');
     * </code>
     *
     * @see Criteria::add()
     *
     * @param string $column     A string representing thecolumn phpName, e.g. 'AuthorId'
     * @param mixed  $value      A value for the condition
     * @param string $comparison What to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ModelCriteria The current object, for fluid interface
     */
    public function filterBy($column, $value, $comparison = Criteria::EQUAL)
    {
        if (isset($this->delegatedFields[$column])) {
            $methodUse = "use{$this->delegatedFields[$column]}Query";

            return $this->{$methodUse}()->filterBy($column, $value, $comparison)->endUse();
        } else {
            return $this->add($this->getRealColumnName($column), $value, $comparison);
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PromotionTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PromotionTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PromotionTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PromotionTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PromotionTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildPromotionQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PromotionTableMap::COL_CREATED_AT);
    }

} // PromotionQuery
