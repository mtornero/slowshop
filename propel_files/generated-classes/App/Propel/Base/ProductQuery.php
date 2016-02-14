<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Product as ChildProduct;
use App\Propel\ProductQuery as ChildProductQuery;
use App\Propel\Map\ProductTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product' table.
 *
 *
 *
 * @method     ChildProductQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildProductQuery orderByResourceId($order = Criteria::ASC) Order by the resource_id column
 * @method     ChildProductQuery orderByProductName($order = Criteria::ASC) Order by the product_name column
 * @method     ChildProductQuery orderByProductDescription($order = Criteria::ASC) Order by the product_description column
 * @method     ChildProductQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 * @method     ChildProductQuery orderByProviderId($order = Criteria::ASC) Order by the provider_id column
 * @method     ChildProductQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildProductQuery orderByProductRange($order = Criteria::ASC) Order by the product_range column
 * @method     ChildProductQuery orderByProductPrice($order = Criteria::ASC) Order by the product_price column
 * @method     ChildProductQuery orderByProductIsActive($order = Criteria::ASC) Order by the product_is_active column
 * @method     ChildProductQuery orderByProductPic($order = Criteria::ASC) Order by the product_pic column
 * @method     ChildProductQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProductQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProductQuery groupByProductId() Group by the product_id column
 * @method     ChildProductQuery groupByResourceId() Group by the resource_id column
 * @method     ChildProductQuery groupByProductName() Group by the product_name column
 * @method     ChildProductQuery groupByProductDescription() Group by the product_description column
 * @method     ChildProductQuery groupByCategoryId() Group by the category_id column
 * @method     ChildProductQuery groupByProviderId() Group by the provider_id column
 * @method     ChildProductQuery groupByUnitId() Group by the unit_id column
 * @method     ChildProductQuery groupByProductRange() Group by the product_range column
 * @method     ChildProductQuery groupByProductPrice() Group by the product_price column
 * @method     ChildProductQuery groupByProductIsActive() Group by the product_is_active column
 * @method     ChildProductQuery groupByProductPic() Group by the product_pic column
 * @method     ChildProductQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProductQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildProductQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildProductQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildProductQuery joinWithCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Category relation
 *
 * @method     ChildProductQuery leftJoinWithCategory() Adds a LEFT JOIN clause and with to the query using the Category relation
 * @method     ChildProductQuery rightJoinWithCategory() Adds a RIGHT JOIN clause and with to the query using the Category relation
 * @method     ChildProductQuery innerJoinWithCategory() Adds a INNER JOIN clause and with to the query using the Category relation
 *
 * @method     ChildProductQuery leftJoinProvider($relationAlias = null) Adds a LEFT JOIN clause to the query using the Provider relation
 * @method     ChildProductQuery rightJoinProvider($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Provider relation
 * @method     ChildProductQuery innerJoinProvider($relationAlias = null) Adds a INNER JOIN clause to the query using the Provider relation
 *
 * @method     ChildProductQuery joinWithProvider($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Provider relation
 *
 * @method     ChildProductQuery leftJoinWithProvider() Adds a LEFT JOIN clause and with to the query using the Provider relation
 * @method     ChildProductQuery rightJoinWithProvider() Adds a RIGHT JOIN clause and with to the query using the Provider relation
 * @method     ChildProductQuery innerJoinWithProvider() Adds a INNER JOIN clause and with to the query using the Provider relation
 *
 * @method     ChildProductQuery leftJoinUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Unit relation
 * @method     ChildProductQuery rightJoinUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Unit relation
 * @method     ChildProductQuery innerJoinUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the Unit relation
 *
 * @method     ChildProductQuery joinWithUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Unit relation
 *
 * @method     ChildProductQuery leftJoinWithUnit() Adds a LEFT JOIN clause and with to the query using the Unit relation
 * @method     ChildProductQuery rightJoinWithUnit() Adds a RIGHT JOIN clause and with to the query using the Unit relation
 * @method     ChildProductQuery innerJoinWithUnit() Adds a INNER JOIN clause and with to the query using the Unit relation
 *
 * @method     ChildProductQuery leftJoinFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the File relation
 * @method     ChildProductQuery rightJoinFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the File relation
 * @method     ChildProductQuery innerJoinFile($relationAlias = null) Adds a INNER JOIN clause to the query using the File relation
 *
 * @method     ChildProductQuery joinWithFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the File relation
 *
 * @method     ChildProductQuery leftJoinWithFile() Adds a LEFT JOIN clause and with to the query using the File relation
 * @method     ChildProductQuery rightJoinWithFile() Adds a RIGHT JOIN clause and with to the query using the File relation
 * @method     ChildProductQuery innerJoinWithFile() Adds a INNER JOIN clause and with to the query using the File relation
 *
 * @method     ChildProductQuery leftJoinResource($relationAlias = null) Adds a LEFT JOIN clause to the query using the Resource relation
 * @method     ChildProductQuery rightJoinResource($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Resource relation
 * @method     ChildProductQuery innerJoinResource($relationAlias = null) Adds a INNER JOIN clause to the query using the Resource relation
 *
 * @method     ChildProductQuery joinWithResource($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Resource relation
 *
 * @method     ChildProductQuery leftJoinWithResource() Adds a LEFT JOIN clause and with to the query using the Resource relation
 * @method     ChildProductQuery rightJoinWithResource() Adds a RIGHT JOIN clause and with to the query using the Resource relation
 * @method     ChildProductQuery innerJoinWithResource() Adds a INNER JOIN clause and with to the query using the Resource relation
 *
 * @method     ChildProductQuery leftJoinOrderProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderProduct relation
 * @method     ChildProductQuery rightJoinOrderProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderProduct relation
 * @method     ChildProductQuery innerJoinOrderProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderProduct relation
 *
 * @method     ChildProductQuery joinWithOrderProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderProduct relation
 *
 * @method     ChildProductQuery leftJoinWithOrderProduct() Adds a LEFT JOIN clause and with to the query using the OrderProduct relation
 * @method     ChildProductQuery rightJoinWithOrderProduct() Adds a RIGHT JOIN clause and with to the query using the OrderProduct relation
 * @method     ChildProductQuery innerJoinWithOrderProduct() Adds a INNER JOIN clause and with to the query using the OrderProduct relation
 *
 * @method     ChildProductQuery leftJoinProductHighlighted($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductHighlighted relation
 * @method     ChildProductQuery rightJoinProductHighlighted($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductHighlighted relation
 * @method     ChildProductQuery innerJoinProductHighlighted($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductHighlighted relation
 *
 * @method     ChildProductQuery joinWithProductHighlighted($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductHighlighted relation
 *
 * @method     ChildProductQuery leftJoinWithProductHighlighted() Adds a LEFT JOIN clause and with to the query using the ProductHighlighted relation
 * @method     ChildProductQuery rightJoinWithProductHighlighted() Adds a RIGHT JOIN clause and with to the query using the ProductHighlighted relation
 * @method     ChildProductQuery innerJoinWithProductHighlighted() Adds a INNER JOIN clause and with to the query using the ProductHighlighted relation
 *
 * @method     ChildProductQuery leftJoinProductVariationType($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductVariationType relation
 * @method     ChildProductQuery rightJoinProductVariationType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductVariationType relation
 * @method     ChildProductQuery innerJoinProductVariationType($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductVariationType relation
 *
 * @method     ChildProductQuery joinWithProductVariationType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductVariationType relation
 *
 * @method     ChildProductQuery leftJoinWithProductVariationType() Adds a LEFT JOIN clause and with to the query using the ProductVariationType relation
 * @method     ChildProductQuery rightJoinWithProductVariationType() Adds a RIGHT JOIN clause and with to the query using the ProductVariationType relation
 * @method     ChildProductQuery innerJoinWithProductVariationType() Adds a INNER JOIN clause and with to the query using the ProductVariationType relation
 *
 * @method     ChildProductQuery leftJoinWishlistProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the WishlistProduct relation
 * @method     ChildProductQuery rightJoinWishlistProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WishlistProduct relation
 * @method     ChildProductQuery innerJoinWishlistProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the WishlistProduct relation
 *
 * @method     ChildProductQuery joinWithWishlistProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WishlistProduct relation
 *
 * @method     ChildProductQuery leftJoinWithWishlistProduct() Adds a LEFT JOIN clause and with to the query using the WishlistProduct relation
 * @method     ChildProductQuery rightJoinWithWishlistProduct() Adds a RIGHT JOIN clause and with to the query using the WishlistProduct relation
 * @method     ChildProductQuery innerJoinWithWishlistProduct() Adds a INNER JOIN clause and with to the query using the WishlistProduct relation
 *
 * @method     \App\Propel\CategoryQuery|\App\Propel\ProviderQuery|\App\Propel\UnitQuery|\App\Propel\FileQuery|\App\Propel\ResourceQuery|\App\Propel\OrderProductQuery|\App\Propel\ProductHighlightedQuery|\App\Propel\ProductVariationTypeQuery|\App\Propel\WishlistProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduct findOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query
 * @method     ChildProduct findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProduct matching the query, or a new ChildProduct object populated from the query conditions when no match is found
 *
 * @method     ChildProduct findOneByProductId(int $product_id) Return the first ChildProduct filtered by the product_id column
 * @method     ChildProduct findOneByResourceId(int $resource_id) Return the first ChildProduct filtered by the resource_id column
 * @method     ChildProduct findOneByProductName(string $product_name) Return the first ChildProduct filtered by the product_name column
 * @method     ChildProduct findOneByProductDescription(string $product_description) Return the first ChildProduct filtered by the product_description column
 * @method     ChildProduct findOneByCategoryId(int $category_id) Return the first ChildProduct filtered by the category_id column
 * @method     ChildProduct findOneByProviderId(int $provider_id) Return the first ChildProduct filtered by the provider_id column
 * @method     ChildProduct findOneByUnitId(int $unit_id) Return the first ChildProduct filtered by the unit_id column
 * @method     ChildProduct findOneByProductRange(string $product_range) Return the first ChildProduct filtered by the product_range column
 * @method     ChildProduct findOneByProductPrice(string $product_price) Return the first ChildProduct filtered by the product_price column
 * @method     ChildProduct findOneByProductIsActive(int $product_is_active) Return the first ChildProduct filtered by the product_is_active column
 * @method     ChildProduct findOneByProductPic(int $product_pic) Return the first ChildProduct filtered by the product_pic column
 * @method     ChildProduct findOneByCreatedAt(string $created_at) Return the first ChildProduct filtered by the created_at column
 * @method     ChildProduct findOneByUpdatedAt(string $updated_at) Return the first ChildProduct filtered by the updated_at column *

 * @method     ChildProduct requirePk($key, ConnectionInterface $con = null) Return the ChildProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct requireOneByProductId(int $product_id) Return the first ChildProduct filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByResourceId(int $resource_id) Return the first ChildProduct filtered by the resource_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByProductName(string $product_name) Return the first ChildProduct filtered by the product_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByProductDescription(string $product_description) Return the first ChildProduct filtered by the product_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCategoryId(int $category_id) Return the first ChildProduct filtered by the category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByProviderId(int $provider_id) Return the first ChildProduct filtered by the provider_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByUnitId(int $unit_id) Return the first ChildProduct filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByProductRange(string $product_range) Return the first ChildProduct filtered by the product_range column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByProductPrice(string $product_price) Return the first ChildProduct filtered by the product_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByProductIsActive(int $product_is_active) Return the first ChildProduct filtered by the product_is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByProductPic(int $product_pic) Return the first ChildProduct filtered by the product_pic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCreatedAt(string $created_at) Return the first ChildProduct filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByUpdatedAt(string $updated_at) Return the first ChildProduct filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProduct objects based on current ModelCriteria
 * @method     ChildProduct[]|ObjectCollection findByProductId(int $product_id) Return ChildProduct objects filtered by the product_id column
 * @method     ChildProduct[]|ObjectCollection findByResourceId(int $resource_id) Return ChildProduct objects filtered by the resource_id column
 * @method     ChildProduct[]|ObjectCollection findByProductName(string $product_name) Return ChildProduct objects filtered by the product_name column
 * @method     ChildProduct[]|ObjectCollection findByProductDescription(string $product_description) Return ChildProduct objects filtered by the product_description column
 * @method     ChildProduct[]|ObjectCollection findByCategoryId(int $category_id) Return ChildProduct objects filtered by the category_id column
 * @method     ChildProduct[]|ObjectCollection findByProviderId(int $provider_id) Return ChildProduct objects filtered by the provider_id column
 * @method     ChildProduct[]|ObjectCollection findByUnitId(int $unit_id) Return ChildProduct objects filtered by the unit_id column
 * @method     ChildProduct[]|ObjectCollection findByProductRange(string $product_range) Return ChildProduct objects filtered by the product_range column
 * @method     ChildProduct[]|ObjectCollection findByProductPrice(string $product_price) Return ChildProduct objects filtered by the product_price column
 * @method     ChildProduct[]|ObjectCollection findByProductIsActive(int $product_is_active) Return ChildProduct objects filtered by the product_is_active column
 * @method     ChildProduct[]|ObjectCollection findByProductPic(int $product_pic) Return ChildProduct objects filtered by the product_pic column
 * @method     ChildProduct[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProduct objects filtered by the created_at column
 * @method     ChildProduct[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProduct objects filtered by the updated_at column
 * @method     ChildProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductQuery extends ModelCriteria
{

    // delegate behavior

    protected $delegatedFields = [
        'ResourceType' => 'Resource',
        'SocialViews' => 'Resource',
        'SocialLikes' => 'Resource',
        'SocialDislikes' => 'Resource',
        'SocialComments' => 'Resource',
        'SocialFavourites' => 'Resource',
        'SocialRecommendations' => 'Resource',
    ];

protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ProductQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\Product', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductQuery) {
            return $criteria;
        }
        $query = new ChildProductQuery();
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProductTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
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
     * @return ChildProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT product_id, resource_id, product_name, product_description, category_id, provider_id, unit_id, product_range, product_price, product_is_active, product_pic, created_at, updated_at FROM product WHERE product_id = :p0';
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
            /** @var ChildProduct $obj */
            $obj = new ChildProduct();
            $obj->hydrate($row);
            ProductTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id > 12
     * </code>
     *
     * @param     mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $productId, $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByResourceId($resourceId = null, $comparison = null)
    {
        if (is_array($resourceId)) {
            $useMinMax = false;
            if (isset($resourceId['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_RESOURCE_ID, $resourceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resourceId['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_RESOURCE_ID, $resourceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_RESOURCE_ID, $resourceId, $comparison);
    }

    /**
     * Filter the query on the product_name column
     *
     * Example usage:
     * <code>
     * $query->filterByProductName('fooValue');   // WHERE product_name = 'fooValue'
     * $query->filterByProductName('%fooValue%'); // WHERE product_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductName($productName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $productName)) {
                $productName = str_replace('*', '%', $productName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_NAME, $productName, $comparison);
    }

    /**
     * Filter the query on the product_description column
     *
     * Example usage:
     * <code>
     * $query->filterByProductDescription('fooValue');   // WHERE product_description = 'fooValue'
     * $query->filterByProductDescription('%fooValue%'); // WHERE product_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productDescription The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductDescription($productDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productDescription)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $productDescription)) {
                $productDescription = str_replace('*', '%', $productDescription);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_DESCRIPTION, $productDescription, $comparison);
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId(1234); // WHERE category_id = 1234
     * $query->filterByCategoryId(array(12, 34)); // WHERE category_id IN (12, 34)
     * $query->filterByCategoryId(array('min' => 12)); // WHERE category_id > 12
     * </code>
     *
     * @see       filterByCategory()
     *
     * @param     mixed $categoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, $comparison = null)
    {
        if (is_array($categoryId)) {
            $useMinMax = false;
            if (isset($categoryId['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_CATEGORY_ID, $categoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryId['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_CATEGORY_ID, $categoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_CATEGORY_ID, $categoryId, $comparison);
    }

    /**
     * Filter the query on the provider_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProviderId(1234); // WHERE provider_id = 1234
     * $query->filterByProviderId(array(12, 34)); // WHERE provider_id IN (12, 34)
     * $query->filterByProviderId(array('min' => 12)); // WHERE provider_id > 12
     * </code>
     *
     * @see       filterByProvider()
     *
     * @param     mixed $providerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProviderId($providerId = null, $comparison = null)
    {
        if (is_array($providerId)) {
            $useMinMax = false;
            if (isset($providerId['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PROVIDER_ID, $providerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($providerId['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PROVIDER_ID, $providerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PROVIDER_ID, $providerId, $comparison);
    }

    /**
     * Filter the query on the unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitId(1234); // WHERE unit_id = 1234
     * $query->filterByUnitId(array(12, 34)); // WHERE unit_id IN (12, 34)
     * $query->filterByUnitId(array('min' => 12)); // WHERE unit_id > 12
     * </code>
     *
     * @see       filterByUnit()
     *
     * @param     mixed $unitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_UNIT_ID, $unitId, $comparison);
    }

    /**
     * Filter the query on the product_range column
     *
     * Example usage:
     * <code>
     * $query->filterByProductRange('fooValue');   // WHERE product_range = 'fooValue'
     * $query->filterByProductRange('%fooValue%'); // WHERE product_range LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productRange The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductRange($productRange = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productRange)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $productRange)) {
                $productRange = str_replace('*', '%', $productRange);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_RANGE, $productRange, $comparison);
    }

    /**
     * Filter the query on the product_price column
     *
     * Example usage:
     * <code>
     * $query->filterByProductPrice(1234); // WHERE product_price = 1234
     * $query->filterByProductPrice(array(12, 34)); // WHERE product_price IN (12, 34)
     * $query->filterByProductPrice(array('min' => 12)); // WHERE product_price > 12
     * </code>
     *
     * @param     mixed $productPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductPrice($productPrice = null, $comparison = null)
    {
        if (is_array($productPrice)) {
            $useMinMax = false;
            if (isset($productPrice['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PRICE, $productPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productPrice['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PRICE, $productPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PRICE, $productPrice, $comparison);
    }

    /**
     * Filter the query on the product_is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByProductIsActive(1234); // WHERE product_is_active = 1234
     * $query->filterByProductIsActive(array(12, 34)); // WHERE product_is_active IN (12, 34)
     * $query->filterByProductIsActive(array('min' => 12)); // WHERE product_is_active > 12
     * </code>
     *
     * @param     mixed $productIsActive The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductIsActive($productIsActive = null, $comparison = null)
    {
        if (is_array($productIsActive)) {
            $useMinMax = false;
            if (isset($productIsActive['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_IS_ACTIVE, $productIsActive['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productIsActive['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_IS_ACTIVE, $productIsActive['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_IS_ACTIVE, $productIsActive, $comparison);
    }

    /**
     * Filter the query on the product_pic column
     *
     * Example usage:
     * <code>
     * $query->filterByProductPic(1234); // WHERE product_pic = 1234
     * $query->filterByProductPic(array(12, 34)); // WHERE product_pic IN (12, 34)
     * $query->filterByProductPic(array('min' => 12)); // WHERE product_pic > 12
     * </code>
     *
     * @see       filterByFile()
     *
     * @param     mixed $productPic The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductPic($productPic = null, $comparison = null)
    {
        if (is_array($productPic)) {
            $useMinMax = false;
            if (isset($productPic['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PIC, $productPic['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productPic['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PIC, $productPic['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PIC, $productPic, $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Category object
     *
     * @param \App\Propel\Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof \App\Propel\Category) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_CATEGORY_ID, $category->getCategoryId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'CategoryId'), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\Provider object
     *
     * @param \App\Propel\Provider|ObjectCollection $provider The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProvider($provider, $comparison = null)
    {
        if ($provider instanceof \App\Propel\Provider) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PROVIDER_ID, $provider->getProviderId(), $comparison);
        } elseif ($provider instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_PROVIDER_ID, $provider->toKeyValue('PrimaryKey', 'ProviderId'), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProvider($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useProviderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProvider($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Provider', '\App\Propel\ProviderQuery');
    }

    /**
     * Filter the query by a related \App\Propel\Unit object
     *
     * @param \App\Propel\Unit|ObjectCollection $unit The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByUnit($unit, $comparison = null)
    {
        if ($unit instanceof \App\Propel\Unit) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_UNIT_ID, $unit->getUnitId(), $comparison);
        } elseif ($unit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_UNIT_ID, $unit->toKeyValue('PrimaryKey', 'UnitId'), $comparison);
        } else {
            throw new PropelException('filterByUnit() only accepts arguments of type \App\Propel\Unit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Unit relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinUnit($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Unit');

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
            $this->addJoinObject($join, 'Unit');
        }

        return $this;
    }

    /**
     * Use the Unit relation Unit object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\UnitQuery A secondary query class using the current class as primary query
     */
    public function useUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Unit', '\App\Propel\UnitQuery');
    }

    /**
     * Filter the query by a related \App\Propel\File object
     *
     * @param \App\Propel\File|ObjectCollection $file The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByFile($file, $comparison = null)
    {
        if ($file instanceof \App\Propel\File) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_PIC, $file->getFileId(), $comparison);
        } elseif ($file instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_PIC, $file->toKeyValue('PrimaryKey', 'FileId'), $comparison);
        } else {
            throw new PropelException('filterByFile() only accepts arguments of type \App\Propel\File or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the File relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinFile($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('File');

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
            $this->addJoinObject($join, 'File');
        }

        return $this;
    }

    /**
     * Use the File relation File object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\FileQuery A secondary query class using the current class as primary query
     */
    public function useFileQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'File', '\App\Propel\FileQuery');
    }

    /**
     * Filter the query by a related \App\Propel\Resource object
     *
     * @param \App\Propel\Resource|ObjectCollection $resource The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByResource($resource, $comparison = null)
    {
        if ($resource instanceof \App\Propel\Resource) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_RESOURCE_ID, $resource->getResourceId(), $comparison);
        } elseif ($resource instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_RESOURCE_ID, $resource->toKeyValue('PrimaryKey', 'ResourceId'), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\OrderProduct object
     *
     * @param \App\Propel\OrderProduct|ObjectCollection $orderProduct the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByOrderProduct($orderProduct, $comparison = null)
    {
        if ($orderProduct instanceof \App\Propel\OrderProduct) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $orderProduct->getProductId(), $comparison);
        } elseif ($orderProduct instanceof ObjectCollection) {
            return $this
                ->useOrderProductQuery()
                ->filterByPrimaryKeys($orderProduct->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrderProduct() only accepts arguments of type \App\Propel\OrderProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderProduct relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinOrderProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderProduct');

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
            $this->addJoinObject($join, 'OrderProduct');
        }

        return $this;
    }

    /**
     * Use the OrderProduct relation OrderProduct object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\OrderProductQuery A secondary query class using the current class as primary query
     */
    public function useOrderProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderProduct', '\App\Propel\OrderProductQuery');
    }

    /**
     * Filter the query by a related \App\Propel\ProductHighlighted object
     *
     * @param \App\Propel\ProductHighlighted|ObjectCollection $productHighlighted the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductHighlighted($productHighlighted, $comparison = null)
    {
        if ($productHighlighted instanceof \App\Propel\ProductHighlighted) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $productHighlighted->getProductId(), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductHighlighted($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useProductHighlightedQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductHighlighted($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductHighlighted', '\App\Propel\ProductHighlightedQuery');
    }

    /**
     * Filter the query by a related \App\Propel\ProductVariationType object
     *
     * @param \App\Propel\ProductVariationType|ObjectCollection $productVariationType the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductVariationType($productVariationType, $comparison = null)
    {
        if ($productVariationType instanceof \App\Propel\ProductVariationType) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $productVariationType->getProductId(), $comparison);
        } elseif ($productVariationType instanceof ObjectCollection) {
            return $this
                ->useProductVariationTypeQuery()
                ->filterByPrimaryKeys($productVariationType->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductVariationType() only accepts arguments of type \App\Propel\ProductVariationType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductVariationType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductVariationType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductVariationType');

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
            $this->addJoinObject($join, 'ProductVariationType');
        }

        return $this;
    }

    /**
     * Use the ProductVariationType relation ProductVariationType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ProductVariationTypeQuery A secondary query class using the current class as primary query
     */
    public function useProductVariationTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductVariationType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductVariationType', '\App\Propel\ProductVariationTypeQuery');
    }

    /**
     * Filter the query by a related \App\Propel\WishlistProduct object
     *
     * @param \App\Propel\WishlistProduct|ObjectCollection $wishlistProduct the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByWishlistProduct($wishlistProduct, $comparison = null)
    {
        if ($wishlistProduct instanceof \App\Propel\WishlistProduct) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $wishlistProduct->getProductId(), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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
     * @param   ChildProduct $product Object to remove from the list of results
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function prune($product = null)
    {
        if ($product) {
            $this->addUsingAlias(ProductTableMap::COL_PRODUCT_ID, $product->getProductId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTableMap::clearInstancePool();
            ProductTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // delegate behavior
    /**
    * Filter the query by resource_type column
    *
    * Example usage:
    * <code>
        * $query->filterByResourceType(1234); // WHERE resource_type = 1234
        * $query->filterByResourceType(array(12, 34)); // WHERE resource_type IN (12, 34)
        * $query->filterByResourceType(array('min' => 12)); // WHERE resource_type > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildProductQuery The current query, for fluid interface
    */
    public function filterByResourceType($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterByResourceType($value, $comparison)->endUse();
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
    public function orderByResourceType($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderByResourceType($order)->endUse();
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
    * @return $this|ChildProductQuery The current query, for fluid interface
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
    * @return $this|ChildProductQuery The current query, for fluid interface
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
    * @return $this|ChildProductQuery The current query, for fluid interface
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
    * @return $this|ChildProductQuery The current query, for fluid interface
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
    * @return $this|ChildProductQuery The current query, for fluid interface
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
    * @return $this|ChildProductQuery The current query, for fluid interface
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
     * @return     $this|ChildProductQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ProductTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildProductQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProductTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildProductQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProductTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildProductQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProductTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildProductQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ProductTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildProductQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProductTableMap::COL_CREATED_AT);
    }

} // ProductQuery
