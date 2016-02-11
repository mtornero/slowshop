<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\ProductVariationType as ChildProductVariationType;
use App\Propel\ProductVariationTypeQuery as ChildProductVariationTypeQuery;
use App\Propel\Map\ProductVariationTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product_variation_type' table.
 *
 *
 *
 * @method     ChildProductVariationTypeQuery orderByProductVariationTypeId($order = Criteria::ASC) Order by the product_variation_type_id column
 * @method     ChildProductVariationTypeQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildProductVariationTypeQuery orderByVariationTypeId($order = Criteria::ASC) Order by the variation_type_id column
 * @method     ChildProductVariationTypeQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProductVariationTypeQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProductVariationTypeQuery groupByProductVariationTypeId() Group by the product_variation_type_id column
 * @method     ChildProductVariationTypeQuery groupByProductId() Group by the product_id column
 * @method     ChildProductVariationTypeQuery groupByVariationTypeId() Group by the variation_type_id column
 * @method     ChildProductVariationTypeQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProductVariationTypeQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProductVariationTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductVariationTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductVariationTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductVariationTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductVariationTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductVariationTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductVariationTypeQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildProductVariationTypeQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildProductVariationTypeQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildProductVariationTypeQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildProductVariationTypeQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildProductVariationTypeQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildProductVariationTypeQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildProductVariationTypeQuery leftJoinVariationType($relationAlias = null) Adds a LEFT JOIN clause to the query using the VariationType relation
 * @method     ChildProductVariationTypeQuery rightJoinVariationType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VariationType relation
 * @method     ChildProductVariationTypeQuery innerJoinVariationType($relationAlias = null) Adds a INNER JOIN clause to the query using the VariationType relation
 *
 * @method     ChildProductVariationTypeQuery joinWithVariationType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VariationType relation
 *
 * @method     ChildProductVariationTypeQuery leftJoinWithVariationType() Adds a LEFT JOIN clause and with to the query using the VariationType relation
 * @method     ChildProductVariationTypeQuery rightJoinWithVariationType() Adds a RIGHT JOIN clause and with to the query using the VariationType relation
 * @method     ChildProductVariationTypeQuery innerJoinWithVariationType() Adds a INNER JOIN clause and with to the query using the VariationType relation
 *
 * @method     ChildProductVariationTypeQuery leftJoinProductVariation($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductVariation relation
 * @method     ChildProductVariationTypeQuery rightJoinProductVariation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductVariation relation
 * @method     ChildProductVariationTypeQuery innerJoinProductVariation($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductVariation relation
 *
 * @method     ChildProductVariationTypeQuery joinWithProductVariation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductVariation relation
 *
 * @method     ChildProductVariationTypeQuery leftJoinWithProductVariation() Adds a LEFT JOIN clause and with to the query using the ProductVariation relation
 * @method     ChildProductVariationTypeQuery rightJoinWithProductVariation() Adds a RIGHT JOIN clause and with to the query using the ProductVariation relation
 * @method     ChildProductVariationTypeQuery innerJoinWithProductVariation() Adds a INNER JOIN clause and with to the query using the ProductVariation relation
 *
 * @method     \App\Propel\ProductQuery|\App\Propel\VariationTypeQuery|\App\Propel\ProductVariationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductVariationType findOne(ConnectionInterface $con = null) Return the first ChildProductVariationType matching the query
 * @method     ChildProductVariationType findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProductVariationType matching the query, or a new ChildProductVariationType object populated from the query conditions when no match is found
 *
 * @method     ChildProductVariationType findOneByProductVariationTypeId(int $product_variation_type_id) Return the first ChildProductVariationType filtered by the product_variation_type_id column
 * @method     ChildProductVariationType findOneByProductId(int $product_id) Return the first ChildProductVariationType filtered by the product_id column
 * @method     ChildProductVariationType findOneByVariationTypeId(int $variation_type_id) Return the first ChildProductVariationType filtered by the variation_type_id column
 * @method     ChildProductVariationType findOneByCreatedAt(string $created_at) Return the first ChildProductVariationType filtered by the created_at column
 * @method     ChildProductVariationType findOneByUpdatedAt(string $updated_at) Return the first ChildProductVariationType filtered by the updated_at column *

 * @method     ChildProductVariationType requirePk($key, ConnectionInterface $con = null) Return the ChildProductVariationType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductVariationType requireOne(ConnectionInterface $con = null) Return the first ChildProductVariationType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductVariationType requireOneByProductVariationTypeId(int $product_variation_type_id) Return the first ChildProductVariationType filtered by the product_variation_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductVariationType requireOneByProductId(int $product_id) Return the first ChildProductVariationType filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductVariationType requireOneByVariationTypeId(int $variation_type_id) Return the first ChildProductVariationType filtered by the variation_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductVariationType requireOneByCreatedAt(string $created_at) Return the first ChildProductVariationType filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductVariationType requireOneByUpdatedAt(string $updated_at) Return the first ChildProductVariationType filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductVariationType[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProductVariationType objects based on current ModelCriteria
 * @method     ChildProductVariationType[]|ObjectCollection findByProductVariationTypeId(int $product_variation_type_id) Return ChildProductVariationType objects filtered by the product_variation_type_id column
 * @method     ChildProductVariationType[]|ObjectCollection findByProductId(int $product_id) Return ChildProductVariationType objects filtered by the product_id column
 * @method     ChildProductVariationType[]|ObjectCollection findByVariationTypeId(int $variation_type_id) Return ChildProductVariationType objects filtered by the variation_type_id column
 * @method     ChildProductVariationType[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProductVariationType objects filtered by the created_at column
 * @method     ChildProductVariationType[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProductVariationType objects filtered by the updated_at column
 * @method     ChildProductVariationType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductVariationTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ProductVariationTypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\ProductVariationType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductVariationTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductVariationTypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductVariationTypeQuery) {
            return $criteria;
        }
        $query = new ChildProductVariationTypeQuery();
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
     * @return ChildProductVariationType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProductVariationTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductVariationTypeTableMap::DATABASE_NAME);
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
     * @return ChildProductVariationType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT product_variation_type_id, product_id, variation_type_id, created_at, updated_at FROM product_variation_type WHERE product_variation_type_id = :p0';
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
            /** @var ChildProductVariationType $obj */
            $obj = new ChildProductVariationType();
            $obj->hydrate($row);
            ProductVariationTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProductVariationType|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_VARIATION_TYPE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_VARIATION_TYPE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the product_variation_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductVariationTypeId(1234); // WHERE product_variation_type_id = 1234
     * $query->filterByProductVariationTypeId(array(12, 34)); // WHERE product_variation_type_id IN (12, 34)
     * $query->filterByProductVariationTypeId(array('min' => 12)); // WHERE product_variation_type_id > 12
     * </code>
     *
     * @param     mixed $productVariationTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function filterByProductVariationTypeId($productVariationTypeId = null, $comparison = null)
    {
        if (is_array($productVariationTypeId)) {
            $useMinMax = false;
            if (isset($productVariationTypeId['min'])) {
                $this->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_VARIATION_TYPE_ID, $productVariationTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productVariationTypeId['max'])) {
                $this->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_VARIATION_TYPE_ID, $productVariationTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_VARIATION_TYPE_ID, $productVariationTypeId, $comparison);
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
     * @see       filterByProduct()
     *
     * @param     mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the variation_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVariationTypeId(1234); // WHERE variation_type_id = 1234
     * $query->filterByVariationTypeId(array(12, 34)); // WHERE variation_type_id IN (12, 34)
     * $query->filterByVariationTypeId(array('min' => 12)); // WHERE variation_type_id > 12
     * </code>
     *
     * @see       filterByVariationType()
     *
     * @param     mixed $variationTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function filterByVariationTypeId($variationTypeId = null, $comparison = null)
    {
        if (is_array($variationTypeId)) {
            $useMinMax = false;
            if (isset($variationTypeId['min'])) {
                $this->addUsingAlias(ProductVariationTypeTableMap::COL_VARIATION_TYPE_ID, $variationTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($variationTypeId['max'])) {
                $this->addUsingAlias(ProductVariationTypeTableMap::COL_VARIATION_TYPE_ID, $variationTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductVariationTypeTableMap::COL_VARIATION_TYPE_ID, $variationTypeId, $comparison);
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
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProductVariationTypeTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProductVariationTypeTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductVariationTypeTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProductVariationTypeTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProductVariationTypeTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductVariationTypeTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Product object
     *
     * @param \App\Propel\Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \App\Propel\Product) {
            return $this
                ->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_ID, $product->getProductId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_ID, $product->toKeyValue('PrimaryKey', 'ProductId'), $comparison);
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
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\VariationType object
     *
     * @param \App\Propel\VariationType|ObjectCollection $variationType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function filterByVariationType($variationType, $comparison = null)
    {
        if ($variationType instanceof \App\Propel\VariationType) {
            return $this
                ->addUsingAlias(ProductVariationTypeTableMap::COL_VARIATION_TYPE_ID, $variationType->getVariationTypeId(), $comparison);
        } elseif ($variationType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductVariationTypeTableMap::COL_VARIATION_TYPE_ID, $variationType->toKeyValue('PrimaryKey', 'VariationTypeId'), $comparison);
        } else {
            throw new PropelException('filterByVariationType() only accepts arguments of type \App\Propel\VariationType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VariationType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function joinVariationType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VariationType');

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
            $this->addJoinObject($join, 'VariationType');
        }

        return $this;
    }

    /**
     * Use the VariationType relation VariationType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\VariationTypeQuery A secondary query class using the current class as primary query
     */
    public function useVariationTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVariationType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VariationType', '\App\Propel\VariationTypeQuery');
    }

    /**
     * Filter the query by a related \App\Propel\ProductVariation object
     *
     * @param \App\Propel\ProductVariation|ObjectCollection $productVariation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function filterByProductVariation($productVariation, $comparison = null)
    {
        if ($productVariation instanceof \App\Propel\ProductVariation) {
            return $this
                ->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_VARIATION_TYPE_ID, $productVariation->getProductVariationTypeId(), $comparison);
        } elseif ($productVariation instanceof ObjectCollection) {
            return $this
                ->useProductVariationQuery()
                ->filterByPrimaryKeys($productVariation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductVariation() only accepts arguments of type \App\Propel\ProductVariation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductVariation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function joinProductVariation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductVariation');

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
            $this->addJoinObject($join, 'ProductVariation');
        }

        return $this;
    }

    /**
     * Use the ProductVariation relation ProductVariation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ProductVariationQuery A secondary query class using the current class as primary query
     */
    public function useProductVariationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductVariation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductVariation', '\App\Propel\ProductVariationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProductVariationType $productVariationType Object to remove from the list of results
     *
     * @return $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function prune($productVariationType = null)
    {
        if ($productVariationType) {
            $this->addUsingAlias(ProductVariationTypeTableMap::COL_PRODUCT_VARIATION_TYPE_ID, $productVariationType->getProductVariationTypeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product_variation_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductVariationTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductVariationTypeTableMap::clearInstancePool();
            ProductVariationTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductVariationTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductVariationTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductVariationTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductVariationTypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ProductVariationTypeTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProductVariationTypeTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProductVariationTypeTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProductVariationTypeTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ProductVariationTypeTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildProductVariationTypeQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProductVariationTypeTableMap::COL_CREATED_AT);
    }

} // ProductVariationTypeQuery
