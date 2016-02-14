<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Resource as ChildResource;
use App\Propel\ResourceQuery as ChildResourceQuery;
use App\Propel\Map\ResourceTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'resource' table.
 *
 *
 *
 * @method     ChildResourceQuery orderByResourceId($order = Criteria::ASC) Order by the resource_id column
 * @method     ChildResourceQuery orderByResourceType($order = Criteria::ASC) Order by the resource_type column
 * @method     ChildResourceQuery orderBySocialViews($order = Criteria::ASC) Order by the social_views column
 * @method     ChildResourceQuery orderBySocialLikes($order = Criteria::ASC) Order by the social_likes column
 * @method     ChildResourceQuery orderBySocialDislikes($order = Criteria::ASC) Order by the social_dislikes column
 * @method     ChildResourceQuery orderBySocialComments($order = Criteria::ASC) Order by the social_comments column
 * @method     ChildResourceQuery orderBySocialFavourites($order = Criteria::ASC) Order by the social_favourites column
 * @method     ChildResourceQuery orderBySocialRecommendations($order = Criteria::ASC) Order by the social_recommendations column
 *
 * @method     ChildResourceQuery groupByResourceId() Group by the resource_id column
 * @method     ChildResourceQuery groupByResourceType() Group by the resource_type column
 * @method     ChildResourceQuery groupBySocialViews() Group by the social_views column
 * @method     ChildResourceQuery groupBySocialLikes() Group by the social_likes column
 * @method     ChildResourceQuery groupBySocialDislikes() Group by the social_dislikes column
 * @method     ChildResourceQuery groupBySocialComments() Group by the social_comments column
 * @method     ChildResourceQuery groupBySocialFavourites() Group by the social_favourites column
 * @method     ChildResourceQuery groupBySocialRecommendations() Group by the social_recommendations column
 *
 * @method     ChildResourceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildResourceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildResourceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildResourceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildResourceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildResourceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildResourceQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildResourceQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildResourceQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildResourceQuery joinWithCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Category relation
 *
 * @method     ChildResourceQuery leftJoinWithCategory() Adds a LEFT JOIN clause and with to the query using the Category relation
 * @method     ChildResourceQuery rightJoinWithCategory() Adds a RIGHT JOIN clause and with to the query using the Category relation
 * @method     ChildResourceQuery innerJoinWithCategory() Adds a INNER JOIN clause and with to the query using the Category relation
 *
 * @method     ChildResourceQuery leftJoinNewsRelatedByResourceId($relationAlias = null) Adds a LEFT JOIN clause to the query using the NewsRelatedByResourceId relation
 * @method     ChildResourceQuery rightJoinNewsRelatedByResourceId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NewsRelatedByResourceId relation
 * @method     ChildResourceQuery innerJoinNewsRelatedByResourceId($relationAlias = null) Adds a INNER JOIN clause to the query using the NewsRelatedByResourceId relation
 *
 * @method     ChildResourceQuery joinWithNewsRelatedByResourceId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the NewsRelatedByResourceId relation
 *
 * @method     ChildResourceQuery leftJoinWithNewsRelatedByResourceId() Adds a LEFT JOIN clause and with to the query using the NewsRelatedByResourceId relation
 * @method     ChildResourceQuery rightJoinWithNewsRelatedByResourceId() Adds a RIGHT JOIN clause and with to the query using the NewsRelatedByResourceId relation
 * @method     ChildResourceQuery innerJoinWithNewsRelatedByResourceId() Adds a INNER JOIN clause and with to the query using the NewsRelatedByResourceId relation
 *
 * @method     ChildResourceQuery leftJoinNewsRelatedByNewsFor($relationAlias = null) Adds a LEFT JOIN clause to the query using the NewsRelatedByNewsFor relation
 * @method     ChildResourceQuery rightJoinNewsRelatedByNewsFor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NewsRelatedByNewsFor relation
 * @method     ChildResourceQuery innerJoinNewsRelatedByNewsFor($relationAlias = null) Adds a INNER JOIN clause to the query using the NewsRelatedByNewsFor relation
 *
 * @method     ChildResourceQuery joinWithNewsRelatedByNewsFor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the NewsRelatedByNewsFor relation
 *
 * @method     ChildResourceQuery leftJoinWithNewsRelatedByNewsFor() Adds a LEFT JOIN clause and with to the query using the NewsRelatedByNewsFor relation
 * @method     ChildResourceQuery rightJoinWithNewsRelatedByNewsFor() Adds a RIGHT JOIN clause and with to the query using the NewsRelatedByNewsFor relation
 * @method     ChildResourceQuery innerJoinWithNewsRelatedByNewsFor() Adds a INNER JOIN clause and with to the query using the NewsRelatedByNewsFor relation
 *
 * @method     ChildResourceQuery leftJoinPeriodicPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the PeriodicPlan relation
 * @method     ChildResourceQuery rightJoinPeriodicPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PeriodicPlan relation
 * @method     ChildResourceQuery innerJoinPeriodicPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the PeriodicPlan relation
 *
 * @method     ChildResourceQuery joinWithPeriodicPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PeriodicPlan relation
 *
 * @method     ChildResourceQuery leftJoinWithPeriodicPlan() Adds a LEFT JOIN clause and with to the query using the PeriodicPlan relation
 * @method     ChildResourceQuery rightJoinWithPeriodicPlan() Adds a RIGHT JOIN clause and with to the query using the PeriodicPlan relation
 * @method     ChildResourceQuery innerJoinWithPeriodicPlan() Adds a INNER JOIN clause and with to the query using the PeriodicPlan relation
 *
 * @method     ChildResourceQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildResourceQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildResourceQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildResourceQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildResourceQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildResourceQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildResourceQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildResourceQuery leftJoinProductHighlighted($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductHighlighted relation
 * @method     ChildResourceQuery rightJoinProductHighlighted($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductHighlighted relation
 * @method     ChildResourceQuery innerJoinProductHighlighted($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductHighlighted relation
 *
 * @method     ChildResourceQuery joinWithProductHighlighted($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductHighlighted relation
 *
 * @method     ChildResourceQuery leftJoinWithProductHighlighted() Adds a LEFT JOIN clause and with to the query using the ProductHighlighted relation
 * @method     ChildResourceQuery rightJoinWithProductHighlighted() Adds a RIGHT JOIN clause and with to the query using the ProductHighlighted relation
 * @method     ChildResourceQuery innerJoinWithProductHighlighted() Adds a INNER JOIN clause and with to the query using the ProductHighlighted relation
 *
 * @method     ChildResourceQuery leftJoinPromotion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Promotion relation
 * @method     ChildResourceQuery rightJoinPromotion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Promotion relation
 * @method     ChildResourceQuery innerJoinPromotion($relationAlias = null) Adds a INNER JOIN clause to the query using the Promotion relation
 *
 * @method     ChildResourceQuery joinWithPromotion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Promotion relation
 *
 * @method     ChildResourceQuery leftJoinWithPromotion() Adds a LEFT JOIN clause and with to the query using the Promotion relation
 * @method     ChildResourceQuery rightJoinWithPromotion() Adds a RIGHT JOIN clause and with to the query using the Promotion relation
 * @method     ChildResourceQuery innerJoinWithPromotion() Adds a INNER JOIN clause and with to the query using the Promotion relation
 *
 * @method     ChildResourceQuery leftJoinProvider($relationAlias = null) Adds a LEFT JOIN clause to the query using the Provider relation
 * @method     ChildResourceQuery rightJoinProvider($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Provider relation
 * @method     ChildResourceQuery innerJoinProvider($relationAlias = null) Adds a INNER JOIN clause to the query using the Provider relation
 *
 * @method     ChildResourceQuery joinWithProvider($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Provider relation
 *
 * @method     ChildResourceQuery leftJoinWithProvider() Adds a LEFT JOIN clause and with to the query using the Provider relation
 * @method     ChildResourceQuery rightJoinWithProvider() Adds a RIGHT JOIN clause and with to the query using the Provider relation
 * @method     ChildResourceQuery innerJoinWithProvider() Adds a INNER JOIN clause and with to the query using the Provider relation
 *
 * @method     ChildResourceQuery leftJoinResourceFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the ResourceFile relation
 * @method     ChildResourceQuery rightJoinResourceFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ResourceFile relation
 * @method     ChildResourceQuery innerJoinResourceFile($relationAlias = null) Adds a INNER JOIN clause to the query using the ResourceFile relation
 *
 * @method     ChildResourceQuery joinWithResourceFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ResourceFile relation
 *
 * @method     ChildResourceQuery leftJoinWithResourceFile() Adds a LEFT JOIN clause and with to the query using the ResourceFile relation
 * @method     ChildResourceQuery rightJoinWithResourceFile() Adds a RIGHT JOIN clause and with to the query using the ResourceFile relation
 * @method     ChildResourceQuery innerJoinWithResourceFile() Adds a INNER JOIN clause and with to the query using the ResourceFile relation
 *
 * @method     ChildResourceQuery leftJoinSocialView($relationAlias = null) Adds a LEFT JOIN clause to the query using the SocialView relation
 * @method     ChildResourceQuery rightJoinSocialView($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SocialView relation
 * @method     ChildResourceQuery innerJoinSocialView($relationAlias = null) Adds a INNER JOIN clause to the query using the SocialView relation
 *
 * @method     ChildResourceQuery joinWithSocialView($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SocialView relation
 *
 * @method     ChildResourceQuery leftJoinWithSocialView() Adds a LEFT JOIN clause and with to the query using the SocialView relation
 * @method     ChildResourceQuery rightJoinWithSocialView() Adds a RIGHT JOIN clause and with to the query using the SocialView relation
 * @method     ChildResourceQuery innerJoinWithSocialView() Adds a INNER JOIN clause and with to the query using the SocialView relation
 *
 * @method     ChildResourceQuery leftJoinSocialLike($relationAlias = null) Adds a LEFT JOIN clause to the query using the SocialLike relation
 * @method     ChildResourceQuery rightJoinSocialLike($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SocialLike relation
 * @method     ChildResourceQuery innerJoinSocialLike($relationAlias = null) Adds a INNER JOIN clause to the query using the SocialLike relation
 *
 * @method     ChildResourceQuery joinWithSocialLike($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SocialLike relation
 *
 * @method     ChildResourceQuery leftJoinWithSocialLike() Adds a LEFT JOIN clause and with to the query using the SocialLike relation
 * @method     ChildResourceQuery rightJoinWithSocialLike() Adds a RIGHT JOIN clause and with to the query using the SocialLike relation
 * @method     ChildResourceQuery innerJoinWithSocialLike() Adds a INNER JOIN clause and with to the query using the SocialLike relation
 *
 * @method     ChildResourceQuery leftJoinSocialComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the SocialComment relation
 * @method     ChildResourceQuery rightJoinSocialComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SocialComment relation
 * @method     ChildResourceQuery innerJoinSocialComment($relationAlias = null) Adds a INNER JOIN clause to the query using the SocialComment relation
 *
 * @method     ChildResourceQuery joinWithSocialComment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SocialComment relation
 *
 * @method     ChildResourceQuery leftJoinWithSocialComment() Adds a LEFT JOIN clause and with to the query using the SocialComment relation
 * @method     ChildResourceQuery rightJoinWithSocialComment() Adds a RIGHT JOIN clause and with to the query using the SocialComment relation
 * @method     ChildResourceQuery innerJoinWithSocialComment() Adds a INNER JOIN clause and with to the query using the SocialComment relation
 *
 * @method     ChildResourceQuery leftJoinSocialRecommendation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SocialRecommendation relation
 * @method     ChildResourceQuery rightJoinSocialRecommendation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SocialRecommendation relation
 * @method     ChildResourceQuery innerJoinSocialRecommendation($relationAlias = null) Adds a INNER JOIN clause to the query using the SocialRecommendation relation
 *
 * @method     ChildResourceQuery joinWithSocialRecommendation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SocialRecommendation relation
 *
 * @method     ChildResourceQuery leftJoinWithSocialRecommendation() Adds a LEFT JOIN clause and with to the query using the SocialRecommendation relation
 * @method     ChildResourceQuery rightJoinWithSocialRecommendation() Adds a RIGHT JOIN clause and with to the query using the SocialRecommendation relation
 * @method     ChildResourceQuery innerJoinWithSocialRecommendation() Adds a INNER JOIN clause and with to the query using the SocialRecommendation relation
 *
 * @method     ChildResourceQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildResourceQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildResourceQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildResourceQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildResourceQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildResourceQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildResourceQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \App\Propel\CategoryQuery|\App\Propel\NewsQuery|\App\Propel\PeriodicPlanQuery|\App\Propel\ProductQuery|\App\Propel\ProductHighlightedQuery|\App\Propel\PromotionQuery|\App\Propel\ProviderQuery|\App\Propel\ResourceFileQuery|\App\Propel\SocialViewQuery|\App\Propel\SocialLikeQuery|\App\Propel\SocialCommentQuery|\App\Propel\SocialRecommendationQuery|\App\Propel\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildResource findOne(ConnectionInterface $con = null) Return the first ChildResource matching the query
 * @method     ChildResource findOneOrCreate(ConnectionInterface $con = null) Return the first ChildResource matching the query, or a new ChildResource object populated from the query conditions when no match is found
 *
 * @method     ChildResource findOneByResourceId(int $resource_id) Return the first ChildResource filtered by the resource_id column
 * @method     ChildResource findOneByResourceType(string $resource_type) Return the first ChildResource filtered by the resource_type column
 * @method     ChildResource findOneBySocialViews(int $social_views) Return the first ChildResource filtered by the social_views column
 * @method     ChildResource findOneBySocialLikes(int $social_likes) Return the first ChildResource filtered by the social_likes column
 * @method     ChildResource findOneBySocialDislikes(int $social_dislikes) Return the first ChildResource filtered by the social_dislikes column
 * @method     ChildResource findOneBySocialComments(int $social_comments) Return the first ChildResource filtered by the social_comments column
 * @method     ChildResource findOneBySocialFavourites(int $social_favourites) Return the first ChildResource filtered by the social_favourites column
 * @method     ChildResource findOneBySocialRecommendations(int $social_recommendations) Return the first ChildResource filtered by the social_recommendations column *

 * @method     ChildResource requirePk($key, ConnectionInterface $con = null) Return the ChildResource by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResource requireOne(ConnectionInterface $con = null) Return the first ChildResource matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildResource requireOneByResourceId(int $resource_id) Return the first ChildResource filtered by the resource_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResource requireOneByResourceType(string $resource_type) Return the first ChildResource filtered by the resource_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResource requireOneBySocialViews(int $social_views) Return the first ChildResource filtered by the social_views column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResource requireOneBySocialLikes(int $social_likes) Return the first ChildResource filtered by the social_likes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResource requireOneBySocialDislikes(int $social_dislikes) Return the first ChildResource filtered by the social_dislikes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResource requireOneBySocialComments(int $social_comments) Return the first ChildResource filtered by the social_comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResource requireOneBySocialFavourites(int $social_favourites) Return the first ChildResource filtered by the social_favourites column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResource requireOneBySocialRecommendations(int $social_recommendations) Return the first ChildResource filtered by the social_recommendations column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildResource[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildResource objects based on current ModelCriteria
 * @method     ChildResource[]|ObjectCollection findByResourceId(int $resource_id) Return ChildResource objects filtered by the resource_id column
 * @method     ChildResource[]|ObjectCollection findByResourceType(string $resource_type) Return ChildResource objects filtered by the resource_type column
 * @method     ChildResource[]|ObjectCollection findBySocialViews(int $social_views) Return ChildResource objects filtered by the social_views column
 * @method     ChildResource[]|ObjectCollection findBySocialLikes(int $social_likes) Return ChildResource objects filtered by the social_likes column
 * @method     ChildResource[]|ObjectCollection findBySocialDislikes(int $social_dislikes) Return ChildResource objects filtered by the social_dislikes column
 * @method     ChildResource[]|ObjectCollection findBySocialComments(int $social_comments) Return ChildResource objects filtered by the social_comments column
 * @method     ChildResource[]|ObjectCollection findBySocialFavourites(int $social_favourites) Return ChildResource objects filtered by the social_favourites column
 * @method     ChildResource[]|ObjectCollection findBySocialRecommendations(int $social_recommendations) Return ChildResource objects filtered by the social_recommendations column
 * @method     ChildResource[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ResourceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ResourceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\Resource', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildResourceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildResourceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildResourceQuery) {
            return $criteria;
        }
        $query = new ChildResourceQuery();
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
     * @return ChildResource|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ResourceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ResourceTableMap::DATABASE_NAME);
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
     * @return ChildResource A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT resource_id, resource_type, social_views, social_likes, social_dislikes, social_comments, social_favourites, social_recommendations FROM resource WHERE resource_id = :p0';
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
            $cls = ResourceTableMap::getOMClass($row, 0, false);
            /** @var ChildResource $obj */
            $obj = new $cls();
            $obj->hydrate($row);
            ResourceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildResource|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $keys, Criteria::IN);
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
     * @param     mixed $resourceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterByResourceId($resourceId = null, $comparison = null)
    {
        if (is_array($resourceId)) {
            $useMinMax = false;
            if (isset($resourceId['min'])) {
                $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $resourceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resourceId['max'])) {
                $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $resourceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $resourceId, $comparison);
    }

    /**
     * Filter the query on the resource_type column
     *
     * Example usage:
     * <code>
     * $query->filterByResourceType('fooValue');   // WHERE resource_type = 'fooValue'
     * $query->filterByResourceType('%fooValue%'); // WHERE resource_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $resourceType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterByResourceType($resourceType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resourceType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $resourceType)) {
                $resourceType = str_replace('*', '%', $resourceType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_TYPE, $resourceType, $comparison);
    }

    /**
     * Filter the query on the social_views column
     *
     * Example usage:
     * <code>
     * $query->filterBySocialViews(1234); // WHERE social_views = 1234
     * $query->filterBySocialViews(array(12, 34)); // WHERE social_views IN (12, 34)
     * $query->filterBySocialViews(array('min' => 12)); // WHERE social_views > 12
     * </code>
     *
     * @param     mixed $socialViews The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterBySocialViews($socialViews = null, $comparison = null)
    {
        if (is_array($socialViews)) {
            $useMinMax = false;
            if (isset($socialViews['min'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_VIEWS, $socialViews['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($socialViews['max'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_VIEWS, $socialViews['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_VIEWS, $socialViews, $comparison);
    }

    /**
     * Filter the query on the social_likes column
     *
     * Example usage:
     * <code>
     * $query->filterBySocialLikes(1234); // WHERE social_likes = 1234
     * $query->filterBySocialLikes(array(12, 34)); // WHERE social_likes IN (12, 34)
     * $query->filterBySocialLikes(array('min' => 12)); // WHERE social_likes > 12
     * </code>
     *
     * @param     mixed $socialLikes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterBySocialLikes($socialLikes = null, $comparison = null)
    {
        if (is_array($socialLikes)) {
            $useMinMax = false;
            if (isset($socialLikes['min'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_LIKES, $socialLikes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($socialLikes['max'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_LIKES, $socialLikes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_LIKES, $socialLikes, $comparison);
    }

    /**
     * Filter the query on the social_dislikes column
     *
     * Example usage:
     * <code>
     * $query->filterBySocialDislikes(1234); // WHERE social_dislikes = 1234
     * $query->filterBySocialDislikes(array(12, 34)); // WHERE social_dislikes IN (12, 34)
     * $query->filterBySocialDislikes(array('min' => 12)); // WHERE social_dislikes > 12
     * </code>
     *
     * @param     mixed $socialDislikes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterBySocialDislikes($socialDislikes = null, $comparison = null)
    {
        if (is_array($socialDislikes)) {
            $useMinMax = false;
            if (isset($socialDislikes['min'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_DISLIKES, $socialDislikes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($socialDislikes['max'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_DISLIKES, $socialDislikes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_DISLIKES, $socialDislikes, $comparison);
    }

    /**
     * Filter the query on the social_comments column
     *
     * Example usage:
     * <code>
     * $query->filterBySocialComments(1234); // WHERE social_comments = 1234
     * $query->filterBySocialComments(array(12, 34)); // WHERE social_comments IN (12, 34)
     * $query->filterBySocialComments(array('min' => 12)); // WHERE social_comments > 12
     * </code>
     *
     * @param     mixed $socialComments The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterBySocialComments($socialComments = null, $comparison = null)
    {
        if (is_array($socialComments)) {
            $useMinMax = false;
            if (isset($socialComments['min'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_COMMENTS, $socialComments['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($socialComments['max'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_COMMENTS, $socialComments['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_COMMENTS, $socialComments, $comparison);
    }

    /**
     * Filter the query on the social_favourites column
     *
     * Example usage:
     * <code>
     * $query->filterBySocialFavourites(1234); // WHERE social_favourites = 1234
     * $query->filterBySocialFavourites(array(12, 34)); // WHERE social_favourites IN (12, 34)
     * $query->filterBySocialFavourites(array('min' => 12)); // WHERE social_favourites > 12
     * </code>
     *
     * @param     mixed $socialFavourites The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterBySocialFavourites($socialFavourites = null, $comparison = null)
    {
        if (is_array($socialFavourites)) {
            $useMinMax = false;
            if (isset($socialFavourites['min'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_FAVOURITES, $socialFavourites['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($socialFavourites['max'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_FAVOURITES, $socialFavourites['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_FAVOURITES, $socialFavourites, $comparison);
    }

    /**
     * Filter the query on the social_recommendations column
     *
     * Example usage:
     * <code>
     * $query->filterBySocialRecommendations(1234); // WHERE social_recommendations = 1234
     * $query->filterBySocialRecommendations(array(12, 34)); // WHERE social_recommendations IN (12, 34)
     * $query->filterBySocialRecommendations(array('min' => 12)); // WHERE social_recommendations > 12
     * </code>
     *
     * @param     mixed $socialRecommendations The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterBySocialRecommendations($socialRecommendations = null, $comparison = null)
    {
        if (is_array($socialRecommendations)) {
            $useMinMax = false;
            if (isset($socialRecommendations['min'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_RECOMMENDATIONS, $socialRecommendations['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($socialRecommendations['max'])) {
                $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_RECOMMENDATIONS, $socialRecommendations['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceTableMap::COL_SOCIAL_RECOMMENDATIONS, $socialRecommendations, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Category object
     *
     * @param \App\Propel\Category|ObjectCollection $category the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof \App\Propel\Category) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $category->getResourceId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            return $this
                ->useCategoryQuery()
                ->filterByPrimaryKeys($category->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type \App\Propel\Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

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
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\App\Propel\CategoryQuery');
    }

    /**
     * Filter the query by a related \App\Propel\News object
     *
     * @param \App\Propel\News|ObjectCollection $news the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByNewsRelatedByResourceId($news, $comparison = null)
    {
        if ($news instanceof \App\Propel\News) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $news->getResourceId(), $comparison);
        } elseif ($news instanceof ObjectCollection) {
            return $this
                ->useNewsRelatedByResourceIdQuery()
                ->filterByPrimaryKeys($news->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNewsRelatedByResourceId() only accepts arguments of type \App\Propel\News or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NewsRelatedByResourceId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinNewsRelatedByResourceId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NewsRelatedByResourceId');

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
            $this->addJoinObject($join, 'NewsRelatedByResourceId');
        }

        return $this;
    }

    /**
     * Use the NewsRelatedByResourceId relation News object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\NewsQuery A secondary query class using the current class as primary query
     */
    public function useNewsRelatedByResourceIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNewsRelatedByResourceId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NewsRelatedByResourceId', '\App\Propel\NewsQuery');
    }

    /**
     * Filter the query by a related \App\Propel\News object
     *
     * @param \App\Propel\News|ObjectCollection $news the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByNewsRelatedByNewsFor($news, $comparison = null)
    {
        if ($news instanceof \App\Propel\News) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $news->getNewsFor(), $comparison);
        } elseif ($news instanceof ObjectCollection) {
            return $this
                ->useNewsRelatedByNewsForQuery()
                ->filterByPrimaryKeys($news->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNewsRelatedByNewsFor() only accepts arguments of type \App\Propel\News or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NewsRelatedByNewsFor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinNewsRelatedByNewsFor($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NewsRelatedByNewsFor');

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
            $this->addJoinObject($join, 'NewsRelatedByNewsFor');
        }

        return $this;
    }

    /**
     * Use the NewsRelatedByNewsFor relation News object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\NewsQuery A secondary query class using the current class as primary query
     */
    public function useNewsRelatedByNewsForQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNewsRelatedByNewsFor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NewsRelatedByNewsFor', '\App\Propel\NewsQuery');
    }

    /**
     * Filter the query by a related \App\Propel\PeriodicPlan object
     *
     * @param \App\Propel\PeriodicPlan|ObjectCollection $periodicPlan the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByPeriodicPlan($periodicPlan, $comparison = null)
    {
        if ($periodicPlan instanceof \App\Propel\PeriodicPlan) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $periodicPlan->getResourceId(), $comparison);
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
     * @return $this|ChildResourceQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\Product object
     *
     * @param \App\Propel\Product|ObjectCollection $product the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \App\Propel\Product) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $product->getResourceId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            return $this
                ->useProductQuery()
                ->filterByPrimaryKeys($product->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProduct() only accepts arguments of type \App\Propel\Product or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Product relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Product');

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
            $this->addJoinObject($join, 'Product');
        }

        return $this;
    }

    /**
     * Use the Product relation Product object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ProductQuery A secondary query class using the current class as primary query
     */
    public function useProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\App\Propel\ProductQuery');
    }

    /**
     * Filter the query by a related \App\Propel\ProductHighlighted object
     *
     * @param \App\Propel\ProductHighlighted|ObjectCollection $productHighlighted the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByProductHighlighted($productHighlighted, $comparison = null)
    {
        if ($productHighlighted instanceof \App\Propel\ProductHighlighted) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $productHighlighted->getProductHighlightedFor(), $comparison);
        } elseif ($productHighlighted instanceof ObjectCollection) {
            return $this
                ->useProductHighlightedQuery()
                ->filterByPrimaryKeys($productHighlighted->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductHighlighted() only accepts arguments of type \App\Propel\ProductHighlighted or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductHighlighted relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinProductHighlighted($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductHighlighted');

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
            $this->addJoinObject($join, 'ProductHighlighted');
        }

        return $this;
    }

    /**
     * Use the ProductHighlighted relation ProductHighlighted object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ProductHighlightedQuery A secondary query class using the current class as primary query
     */
    public function useProductHighlightedQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProductHighlighted($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductHighlighted', '\App\Propel\ProductHighlightedQuery');
    }

    /**
     * Filter the query by a related \App\Propel\Promotion object
     *
     * @param \App\Propel\Promotion|ObjectCollection $promotion the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByPromotion($promotion, $comparison = null)
    {
        if ($promotion instanceof \App\Propel\Promotion) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $promotion->getResourceId(), $comparison);
        } elseif ($promotion instanceof ObjectCollection) {
            return $this
                ->usePromotionQuery()
                ->filterByPrimaryKeys($promotion->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPromotion() only accepts arguments of type \App\Propel\Promotion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Promotion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinPromotion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Promotion');

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
            $this->addJoinObject($join, 'Promotion');
        }

        return $this;
    }

    /**
     * Use the Promotion relation Promotion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\PromotionQuery A secondary query class using the current class as primary query
     */
    public function usePromotionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPromotion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Promotion', '\App\Propel\PromotionQuery');
    }

    /**
     * Filter the query by a related \App\Propel\Provider object
     *
     * @param \App\Propel\Provider|ObjectCollection $provider the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByProvider($provider, $comparison = null)
    {
        if ($provider instanceof \App\Propel\Provider) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $provider->getResourceId(), $comparison);
        } elseif ($provider instanceof ObjectCollection) {
            return $this
                ->useProviderQuery()
                ->filterByPrimaryKeys($provider->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProvider() only accepts arguments of type \App\Propel\Provider or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Provider relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinProvider($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Provider');

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
            $this->addJoinObject($join, 'Provider');
        }

        return $this;
    }

    /**
     * Use the Provider relation Provider object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ProviderQuery A secondary query class using the current class as primary query
     */
    public function useProviderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProvider($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Provider', '\App\Propel\ProviderQuery');
    }

    /**
     * Filter the query by a related \App\Propel\ResourceFile object
     *
     * @param \App\Propel\ResourceFile|ObjectCollection $resourceFile the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByResourceFile($resourceFile, $comparison = null)
    {
        if ($resourceFile instanceof \App\Propel\ResourceFile) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $resourceFile->getResourceId(), $comparison);
        } elseif ($resourceFile instanceof ObjectCollection) {
            return $this
                ->useResourceFileQuery()
                ->filterByPrimaryKeys($resourceFile->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByResourceFile() only accepts arguments of type \App\Propel\ResourceFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ResourceFile relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinResourceFile($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ResourceFile');

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
            $this->addJoinObject($join, 'ResourceFile');
        }

        return $this;
    }

    /**
     * Use the ResourceFile relation ResourceFile object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ResourceFileQuery A secondary query class using the current class as primary query
     */
    public function useResourceFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinResourceFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ResourceFile', '\App\Propel\ResourceFileQuery');
    }

    /**
     * Filter the query by a related \App\Propel\SocialView object
     *
     * @param \App\Propel\SocialView|ObjectCollection $socialView the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterBySocialView($socialView, $comparison = null)
    {
        if ($socialView instanceof \App\Propel\SocialView) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $socialView->getSocialViewFor(), $comparison);
        } elseif ($socialView instanceof ObjectCollection) {
            return $this
                ->useSocialViewQuery()
                ->filterByPrimaryKeys($socialView->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySocialView() only accepts arguments of type \App\Propel\SocialView or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SocialView relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinSocialView($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SocialView');

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
            $this->addJoinObject($join, 'SocialView');
        }

        return $this;
    }

    /**
     * Use the SocialView relation SocialView object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\SocialViewQuery A secondary query class using the current class as primary query
     */
    public function useSocialViewQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSocialView($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SocialView', '\App\Propel\SocialViewQuery');
    }

    /**
     * Filter the query by a related \App\Propel\SocialLike object
     *
     * @param \App\Propel\SocialLike|ObjectCollection $socialLike the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterBySocialLike($socialLike, $comparison = null)
    {
        if ($socialLike instanceof \App\Propel\SocialLike) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $socialLike->getSocialLikeFor(), $comparison);
        } elseif ($socialLike instanceof ObjectCollection) {
            return $this
                ->useSocialLikeQuery()
                ->filterByPrimaryKeys($socialLike->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySocialLike() only accepts arguments of type \App\Propel\SocialLike or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SocialLike relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinSocialLike($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SocialLike');

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
            $this->addJoinObject($join, 'SocialLike');
        }

        return $this;
    }

    /**
     * Use the SocialLike relation SocialLike object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\SocialLikeQuery A secondary query class using the current class as primary query
     */
    public function useSocialLikeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSocialLike($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SocialLike', '\App\Propel\SocialLikeQuery');
    }

    /**
     * Filter the query by a related \App\Propel\SocialComment object
     *
     * @param \App\Propel\SocialComment|ObjectCollection $socialComment the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterBySocialComment($socialComment, $comparison = null)
    {
        if ($socialComment instanceof \App\Propel\SocialComment) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $socialComment->getSocialCommentFor(), $comparison);
        } elseif ($socialComment instanceof ObjectCollection) {
            return $this
                ->useSocialCommentQuery()
                ->filterByPrimaryKeys($socialComment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySocialComment() only accepts arguments of type \App\Propel\SocialComment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SocialComment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinSocialComment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SocialComment');

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
            $this->addJoinObject($join, 'SocialComment');
        }

        return $this;
    }

    /**
     * Use the SocialComment relation SocialComment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\SocialCommentQuery A secondary query class using the current class as primary query
     */
    public function useSocialCommentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSocialComment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SocialComment', '\App\Propel\SocialCommentQuery');
    }

    /**
     * Filter the query by a related \App\Propel\SocialRecommendation object
     *
     * @param \App\Propel\SocialRecommendation|ObjectCollection $socialRecommendation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterBySocialRecommendation($socialRecommendation, $comparison = null)
    {
        if ($socialRecommendation instanceof \App\Propel\SocialRecommendation) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $socialRecommendation->getSocialRecommendationFor(), $comparison);
        } elseif ($socialRecommendation instanceof ObjectCollection) {
            return $this
                ->useSocialRecommendationQuery()
                ->filterByPrimaryKeys($socialRecommendation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySocialRecommendation() only accepts arguments of type \App\Propel\SocialRecommendation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SocialRecommendation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinSocialRecommendation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SocialRecommendation');

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
            $this->addJoinObject($join, 'SocialRecommendation');
        }

        return $this;
    }

    /**
     * Use the SocialRecommendation relation SocialRecommendation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\SocialRecommendationQuery A secondary query class using the current class as primary query
     */
    public function useSocialRecommendationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSocialRecommendation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SocialRecommendation', '\App\Propel\SocialRecommendationQuery');
    }

    /**
     * Filter the query by a related \App\Propel\User object
     *
     * @param \App\Propel\User|ObjectCollection $user the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \App\Propel\User) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $user->getResourceId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            return $this
                ->useUserQuery()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildResourceQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildResource $resource Object to remove from the list of results
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function prune($resource = null)
    {
        if ($resource) {
            $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_ID, $resource->getResourceId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the resource table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ResourceTableMap::clearInstancePool();
            ResourceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ResourceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ResourceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ResourceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ResourceQuery
