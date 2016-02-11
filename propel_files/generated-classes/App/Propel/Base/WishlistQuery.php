<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Wishlist as ChildWishlist;
use App\Propel\WishlistQuery as ChildWishlistQuery;
use App\Propel\Map\WishlistTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wishlist' table.
 *
 *
 *
 * @method     ChildWishlistQuery orderByWishlistId($order = Criteria::ASC) Order by the wishlist_id column
 * @method     ChildWishlistQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildWishlistQuery orderByWishlistName($order = Criteria::ASC) Order by the wishlist_name column
 * @method     ChildWishlistQuery orderByWishlistComment($order = Criteria::ASC) Order by the wishlist_comment column
 * @method     ChildWishlistQuery orderByWishlistIsGeneral($order = Criteria::ASC) Order by the wishlist_is_public column
 * @method     ChildWishlistQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildWishlistQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildWishlistQuery groupByWishlistId() Group by the wishlist_id column
 * @method     ChildWishlistQuery groupByUserId() Group by the user_id column
 * @method     ChildWishlistQuery groupByWishlistName() Group by the wishlist_name column
 * @method     ChildWishlistQuery groupByWishlistComment() Group by the wishlist_comment column
 * @method     ChildWishlistQuery groupByWishlistIsGeneral() Group by the wishlist_is_public column
 * @method     ChildWishlistQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildWishlistQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildWishlistQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWishlistQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWishlistQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWishlistQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWishlistQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWishlistQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWishlistQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildWishlistQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildWishlistQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildWishlistQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildWishlistQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildWishlistQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildWishlistQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildWishlistQuery leftJoinWishlistProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the WishlistProduct relation
 * @method     ChildWishlistQuery rightJoinWishlistProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WishlistProduct relation
 * @method     ChildWishlistQuery innerJoinWishlistProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the WishlistProduct relation
 *
 * @method     ChildWishlistQuery joinWithWishlistProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WishlistProduct relation
 *
 * @method     ChildWishlistQuery leftJoinWithWishlistProduct() Adds a LEFT JOIN clause and with to the query using the WishlistProduct relation
 * @method     ChildWishlistQuery rightJoinWithWishlistProduct() Adds a RIGHT JOIN clause and with to the query using the WishlistProduct relation
 * @method     ChildWishlistQuery innerJoinWithWishlistProduct() Adds a INNER JOIN clause and with to the query using the WishlistProduct relation
 *
 * @method     \App\Propel\UserQuery|\App\Propel\WishlistProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWishlist findOne(ConnectionInterface $con = null) Return the first ChildWishlist matching the query
 * @method     ChildWishlist findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWishlist matching the query, or a new ChildWishlist object populated from the query conditions when no match is found
 *
 * @method     ChildWishlist findOneByWishlistId(int $wishlist_id) Return the first ChildWishlist filtered by the wishlist_id column
 * @method     ChildWishlist findOneByUserId(int $user_id) Return the first ChildWishlist filtered by the user_id column
 * @method     ChildWishlist findOneByWishlistName(string $wishlist_name) Return the first ChildWishlist filtered by the wishlist_name column
 * @method     ChildWishlist findOneByWishlistComment(string $wishlist_comment) Return the first ChildWishlist filtered by the wishlist_comment column
 * @method     ChildWishlist findOneByWishlistIsGeneral(boolean $wishlist_is_public) Return the first ChildWishlist filtered by the wishlist_is_public column
 * @method     ChildWishlist findOneByCreatedAt(string $created_at) Return the first ChildWishlist filtered by the created_at column
 * @method     ChildWishlist findOneByUpdatedAt(string $updated_at) Return the first ChildWishlist filtered by the updated_at column *

 * @method     ChildWishlist requirePk($key, ConnectionInterface $con = null) Return the ChildWishlist by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWishlist requireOne(ConnectionInterface $con = null) Return the first ChildWishlist matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWishlist requireOneByWishlistId(int $wishlist_id) Return the first ChildWishlist filtered by the wishlist_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWishlist requireOneByUserId(int $user_id) Return the first ChildWishlist filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWishlist requireOneByWishlistName(string $wishlist_name) Return the first ChildWishlist filtered by the wishlist_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWishlist requireOneByWishlistComment(string $wishlist_comment) Return the first ChildWishlist filtered by the wishlist_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWishlist requireOneByWishlistIsGeneral(boolean $wishlist_is_public) Return the first ChildWishlist filtered by the wishlist_is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWishlist requireOneByCreatedAt(string $created_at) Return the first ChildWishlist filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWishlist requireOneByUpdatedAt(string $updated_at) Return the first ChildWishlist filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWishlist[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWishlist objects based on current ModelCriteria
 * @method     ChildWishlist[]|ObjectCollection findByWishlistId(int $wishlist_id) Return ChildWishlist objects filtered by the wishlist_id column
 * @method     ChildWishlist[]|ObjectCollection findByUserId(int $user_id) Return ChildWishlist objects filtered by the user_id column
 * @method     ChildWishlist[]|ObjectCollection findByWishlistName(string $wishlist_name) Return ChildWishlist objects filtered by the wishlist_name column
 * @method     ChildWishlist[]|ObjectCollection findByWishlistComment(string $wishlist_comment) Return ChildWishlist objects filtered by the wishlist_comment column
 * @method     ChildWishlist[]|ObjectCollection findByWishlistIsGeneral(boolean $wishlist_is_public) Return ChildWishlist objects filtered by the wishlist_is_public column
 * @method     ChildWishlist[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildWishlist objects filtered by the created_at column
 * @method     ChildWishlist[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildWishlist objects filtered by the updated_at column
 * @method     ChildWishlist[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WishlistQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\WishlistQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\Wishlist', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWishlistQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWishlistQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWishlistQuery) {
            return $criteria;
        }
        $query = new ChildWishlistQuery();
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
     * @return ChildWishlist|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WishlistTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WishlistTableMap::DATABASE_NAME);
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
     * @return ChildWishlist A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT wishlist_id, user_id, wishlist_name, wishlist_comment, wishlist_is_public, created_at, updated_at FROM wishlist WHERE wishlist_id = :p0';
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
            /** @var ChildWishlist $obj */
            $obj = new ChildWishlist();
            $obj->hydrate($row);
            WishlistTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWishlist|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WishlistTableMap::COL_WISHLIST_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WishlistTableMap::COL_WISHLIST_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the wishlist_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWishlistId(1234); // WHERE wishlist_id = 1234
     * $query->filterByWishlistId(array(12, 34)); // WHERE wishlist_id IN (12, 34)
     * $query->filterByWishlistId(array('min' => 12)); // WHERE wishlist_id > 12
     * </code>
     *
     * @param     mixed $wishlistId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByWishlistId($wishlistId = null, $comparison = null)
    {
        if (is_array($wishlistId)) {
            $useMinMax = false;
            if (isset($wishlistId['min'])) {
                $this->addUsingAlias(WishlistTableMap::COL_WISHLIST_ID, $wishlistId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wishlistId['max'])) {
                $this->addUsingAlias(WishlistTableMap::COL_WISHLIST_ID, $wishlistId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WishlistTableMap::COL_WISHLIST_ID, $wishlistId, $comparison);
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
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(WishlistTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(WishlistTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WishlistTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the wishlist_name column
     *
     * Example usage:
     * <code>
     * $query->filterByWishlistName('fooValue');   // WHERE wishlist_name = 'fooValue'
     * $query->filterByWishlistName('%fooValue%'); // WHERE wishlist_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $wishlistName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByWishlistName($wishlistName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wishlistName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $wishlistName)) {
                $wishlistName = str_replace('*', '%', $wishlistName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WishlistTableMap::COL_WISHLIST_NAME, $wishlistName, $comparison);
    }

    /**
     * Filter the query on the wishlist_comment column
     *
     * Example usage:
     * <code>
     * $query->filterByWishlistComment('fooValue');   // WHERE wishlist_comment = 'fooValue'
     * $query->filterByWishlistComment('%fooValue%'); // WHERE wishlist_comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $wishlistComment The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByWishlistComment($wishlistComment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wishlistComment)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $wishlistComment)) {
                $wishlistComment = str_replace('*', '%', $wishlistComment);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WishlistTableMap::COL_WISHLIST_COMMENT, $wishlistComment, $comparison);
    }

    /**
     * Filter the query on the wishlist_is_public column
     *
     * Example usage:
     * <code>
     * $query->filterByWishlistIsGeneral(true); // WHERE wishlist_is_public = true
     * $query->filterByWishlistIsGeneral('yes'); // WHERE wishlist_is_public = true
     * </code>
     *
     * @param     boolean|string $wishlistIsGeneral The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByWishlistIsGeneral($wishlistIsGeneral = null, $comparison = null)
    {
        if (is_string($wishlistIsGeneral)) {
            $wishlistIsGeneral = in_array(strtolower($wishlistIsGeneral), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WishlistTableMap::COL_WISHLIST_IS_PUBLIC, $wishlistIsGeneral, $comparison);
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
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(WishlistTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WishlistTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WishlistTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(WishlistTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(WishlistTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WishlistTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\User object
     *
     * @param \App\Propel\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \App\Propel\User) {
            return $this
                ->addUsingAlias(WishlistTableMap::COL_USER_ID, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WishlistTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
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
     * @return $this|ChildWishlistQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\WishlistProduct object
     *
     * @param \App\Propel\WishlistProduct|ObjectCollection $wishlistProduct the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWishlistQuery The current query, for fluid interface
     */
    public function filterByWishlistProduct($wishlistProduct, $comparison = null)
    {
        if ($wishlistProduct instanceof \App\Propel\WishlistProduct) {
            return $this
                ->addUsingAlias(WishlistTableMap::COL_WISHLIST_ID, $wishlistProduct->getWishlistId(), $comparison);
        } elseif ($wishlistProduct instanceof ObjectCollection) {
            return $this
                ->useWishlistProductQuery()
                ->filterByPrimaryKeys($wishlistProduct->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWishlistProduct() only accepts arguments of type \App\Propel\WishlistProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WishlistProduct relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function joinWishlistProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WishlistProduct');

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
            $this->addJoinObject($join, 'WishlistProduct');
        }

        return $this;
    }

    /**
     * Use the WishlistProduct relation WishlistProduct object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\WishlistProductQuery A secondary query class using the current class as primary query
     */
    public function useWishlistProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWishlistProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WishlistProduct', '\App\Propel\WishlistProductQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWishlist $wishlist Object to remove from the list of results
     *
     * @return $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function prune($wishlist = null)
    {
        if ($wishlist) {
            $this->addUsingAlias(WishlistTableMap::COL_WISHLIST_ID, $wishlist->getWishlistId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wishlist table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WishlistTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WishlistTableMap::clearInstancePool();
            WishlistTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WishlistTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WishlistTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WishlistTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WishlistTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(WishlistTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(WishlistTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(WishlistTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(WishlistTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(WishlistTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildWishlistQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(WishlistTableMap::COL_CREATED_AT);
    }

} // WishlistQuery
