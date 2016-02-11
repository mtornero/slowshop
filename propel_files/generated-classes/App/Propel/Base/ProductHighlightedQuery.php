<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\ProductHighlighted as ChildProductHighlighted;
use App\Propel\ProductHighlightedQuery as ChildProductHighlightedQuery;
use App\Propel\Map\ProductHighlightedTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product_highlighted' table.
 *
 *
 *
 * @method     ChildProductHighlightedQuery orderByProductHighlightedId($order = Criteria::ASC) Order by the product_highlighted_id column
 * @method     ChildProductHighlightedQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildProductHighlightedQuery orderByProductHighlightedFor($order = Criteria::ASC) Order by the product_highlighted_for column
 * @method     ChildProductHighlightedQuery orderByProductHighlightedFrom($order = Criteria::ASC) Order by the product_highlighted_from column
 * @method     ChildProductHighlightedQuery orderByProductHighlightedTo($order = Criteria::ASC) Order by the product_highlighted_to column
 * @method     ChildProductHighlightedQuery orderByProductHighlightedWeight($order = Criteria::ASC) Order by the product_highlighted_weight column
 * @method     ChildProductHighlightedQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProductHighlightedQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProductHighlightedQuery groupByProductHighlightedId() Group by the product_highlighted_id column
 * @method     ChildProductHighlightedQuery groupByProductId() Group by the product_id column
 * @method     ChildProductHighlightedQuery groupByProductHighlightedFor() Group by the product_highlighted_for column
 * @method     ChildProductHighlightedQuery groupByProductHighlightedFrom() Group by the product_highlighted_from column
 * @method     ChildProductHighlightedQuery groupByProductHighlightedTo() Group by the product_highlighted_to column
 * @method     ChildProductHighlightedQuery groupByProductHighlightedWeight() Group by the product_highlighted_weight column
 * @method     ChildProductHighlightedQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProductHighlightedQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProductHighlightedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductHighlightedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductHighlightedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductHighlightedQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductHighlightedQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductHighlightedQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductHighlightedQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildProductHighlightedQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildProductHighlightedQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildProductHighlightedQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildProductHighlightedQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildProductHighlightedQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildProductHighlightedQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildProductHighlightedQuery leftJoinResource($relationAlias = null) Adds a LEFT JOIN clause to the query using the Resource relation
 * @method     ChildProductHighlightedQuery rightJoinResource($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Resource relation
 * @method     ChildProductHighlightedQuery innerJoinResource($relationAlias = null) Adds a INNER JOIN clause to the query using the Resource relation
 *
 * @method     ChildProductHighlightedQuery joinWithResource($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Resource relation
 *
 * @method     ChildProductHighlightedQuery leftJoinWithResource() Adds a LEFT JOIN clause and with to the query using the Resource relation
 * @method     ChildProductHighlightedQuery rightJoinWithResource() Adds a RIGHT JOIN clause and with to the query using the Resource relation
 * @method     ChildProductHighlightedQuery innerJoinWithResource() Adds a INNER JOIN clause and with to the query using the Resource relation
 *
 * @method     \App\Propel\ProductQuery|\App\Propel\ResourceQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductHighlighted findOne(ConnectionInterface $con = null) Return the first ChildProductHighlighted matching the query
 * @method     ChildProductHighlighted findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProductHighlighted matching the query, or a new ChildProductHighlighted object populated from the query conditions when no match is found
 *
 * @method     ChildProductHighlighted findOneByProductHighlightedId(int $product_highlighted_id) Return the first ChildProductHighlighted filtered by the product_highlighted_id column
 * @method     ChildProductHighlighted findOneByProductId(int $product_id) Return the first ChildProductHighlighted filtered by the product_id column
 * @method     ChildProductHighlighted findOneByProductHighlightedFor(int $product_highlighted_for) Return the first ChildProductHighlighted filtered by the product_highlighted_for column
 * @method     ChildProductHighlighted findOneByProductHighlightedFrom(string $product_highlighted_from) Return the first ChildProductHighlighted filtered by the product_highlighted_from column
 * @method     ChildProductHighlighted findOneByProductHighlightedTo(string $product_highlighted_to) Return the first ChildProductHighlighted filtered by the product_highlighted_to column
 * @method     ChildProductHighlighted findOneByProductHighlightedWeight(int $product_highlighted_weight) Return the first ChildProductHighlighted filtered by the product_highlighted_weight column
 * @method     ChildProductHighlighted findOneByCreatedAt(string $created_at) Return the first ChildProductHighlighted filtered by the created_at column
 * @method     ChildProductHighlighted findOneByUpdatedAt(string $updated_at) Return the first ChildProductHighlighted filtered by the updated_at column *

 * @method     ChildProductHighlighted requirePk($key, ConnectionInterface $con = null) Return the ChildProductHighlighted by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductHighlighted requireOne(ConnectionInterface $con = null) Return the first ChildProductHighlighted matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductHighlighted requireOneByProductHighlightedId(int $product_highlighted_id) Return the first ChildProductHighlighted filtered by the product_highlighted_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductHighlighted requireOneByProductId(int $product_id) Return the first ChildProductHighlighted filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductHighlighted requireOneByProductHighlightedFor(int $product_highlighted_for) Return the first ChildProductHighlighted filtered by the product_highlighted_for column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductHighlighted requireOneByProductHighlightedFrom(string $product_highlighted_from) Return the first ChildProductHighlighted filtered by the product_highlighted_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductHighlighted requireOneByProductHighlightedTo(string $product_highlighted_to) Return the first ChildProductHighlighted filtered by the product_highlighted_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductHighlighted requireOneByProductHighlightedWeight(int $product_highlighted_weight) Return the first ChildProductHighlighted filtered by the product_highlighted_weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductHighlighted requireOneByCreatedAt(string $created_at) Return the first ChildProductHighlighted filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductHighlighted requireOneByUpdatedAt(string $updated_at) Return the first ChildProductHighlighted filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductHighlighted[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProductHighlighted objects based on current ModelCriteria
 * @method     ChildProductHighlighted[]|ObjectCollection findByProductHighlightedId(int $product_highlighted_id) Return ChildProductHighlighted objects filtered by the product_highlighted_id column
 * @method     ChildProductHighlighted[]|ObjectCollection findByProductId(int $product_id) Return ChildProductHighlighted objects filtered by the product_id column
 * @method     ChildProductHighlighted[]|ObjectCollection findByProductHighlightedFor(int $product_highlighted_for) Return ChildProductHighlighted objects filtered by the product_highlighted_for column
 * @method     ChildProductHighlighted[]|ObjectCollection findByProductHighlightedFrom(string $product_highlighted_from) Return ChildProductHighlighted objects filtered by the product_highlighted_from column
 * @method     ChildProductHighlighted[]|ObjectCollection findByProductHighlightedTo(string $product_highlighted_to) Return ChildProductHighlighted objects filtered by the product_highlighted_to column
 * @method     ChildProductHighlighted[]|ObjectCollection findByProductHighlightedWeight(int $product_highlighted_weight) Return ChildProductHighlighted objects filtered by the product_highlighted_weight column
 * @method     ChildProductHighlighted[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProductHighlighted objects filtered by the created_at column
 * @method     ChildProductHighlighted[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProductHighlighted objects filtered by the updated_at column
 * @method     ChildProductHighlighted[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductHighlightedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ProductHighlightedQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\ProductHighlighted', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductHighlightedQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductHighlightedQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductHighlightedQuery) {
            return $criteria;
        }
        $query = new ChildProductHighlightedQuery();
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
     * @return ChildProductHighlighted|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProductHighlightedTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductHighlightedTableMap::DATABASE_NAME);
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
     * @return ChildProductHighlighted A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT product_highlighted_id, product_id, product_highlighted_for, product_highlighted_from, product_highlighted_to, product_highlighted_weight, created_at, updated_at FROM product_highlighted WHERE product_highlighted_id = :p0';
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
            /** @var ChildProductHighlighted $obj */
            $obj = new ChildProductHighlighted();
            $obj->hydrate($row);
            ProductHighlightedTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProductHighlighted|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the product_highlighted_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductHighlightedId(1234); // WHERE product_highlighted_id = 1234
     * $query->filterByProductHighlightedId(array(12, 34)); // WHERE product_highlighted_id IN (12, 34)
     * $query->filterByProductHighlightedId(array('min' => 12)); // WHERE product_highlighted_id > 12
     * </code>
     *
     * @param     mixed $productHighlightedId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByProductHighlightedId($productHighlightedId = null, $comparison = null)
    {
        if (is_array($productHighlightedId)) {
            $useMinMax = false;
            if (isset($productHighlightedId['min'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID, $productHighlightedId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productHighlightedId['max'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID, $productHighlightedId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID, $productHighlightedId, $comparison);
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
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the product_highlighted_for column
     *
     * Example usage:
     * <code>
     * $query->filterByProductHighlightedFor(1234); // WHERE product_highlighted_for = 1234
     * $query->filterByProductHighlightedFor(array(12, 34)); // WHERE product_highlighted_for IN (12, 34)
     * $query->filterByProductHighlightedFor(array('min' => 12)); // WHERE product_highlighted_for > 12
     * </code>
     *
     * @see       filterByResource()
     *
     * @param     mixed $productHighlightedFor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByProductHighlightedFor($productHighlightedFor = null, $comparison = null)
    {
        if (is_array($productHighlightedFor)) {
            $useMinMax = false;
            if (isset($productHighlightedFor['min'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FOR, $productHighlightedFor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productHighlightedFor['max'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FOR, $productHighlightedFor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FOR, $productHighlightedFor, $comparison);
    }

    /**
     * Filter the query on the product_highlighted_from column
     *
     * Example usage:
     * <code>
     * $query->filterByProductHighlightedFrom('2011-03-14'); // WHERE product_highlighted_from = '2011-03-14'
     * $query->filterByProductHighlightedFrom('now'); // WHERE product_highlighted_from = '2011-03-14'
     * $query->filterByProductHighlightedFrom(array('max' => 'yesterday')); // WHERE product_highlighted_from > '2011-03-13'
     * </code>
     *
     * @param     mixed $productHighlightedFrom The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByProductHighlightedFrom($productHighlightedFrom = null, $comparison = null)
    {
        if (is_array($productHighlightedFrom)) {
            $useMinMax = false;
            if (isset($productHighlightedFrom['min'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FROM, $productHighlightedFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productHighlightedFrom['max'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FROM, $productHighlightedFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FROM, $productHighlightedFrom, $comparison);
    }

    /**
     * Filter the query on the product_highlighted_to column
     *
     * Example usage:
     * <code>
     * $query->filterByProductHighlightedTo('2011-03-14'); // WHERE product_highlighted_to = '2011-03-14'
     * $query->filterByProductHighlightedTo('now'); // WHERE product_highlighted_to = '2011-03-14'
     * $query->filterByProductHighlightedTo(array('max' => 'yesterday')); // WHERE product_highlighted_to > '2011-03-13'
     * </code>
     *
     * @param     mixed $productHighlightedTo The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByProductHighlightedTo($productHighlightedTo = null, $comparison = null)
    {
        if (is_array($productHighlightedTo)) {
            $useMinMax = false;
            if (isset($productHighlightedTo['min'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_TO, $productHighlightedTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productHighlightedTo['max'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_TO, $productHighlightedTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_TO, $productHighlightedTo, $comparison);
    }

    /**
     * Filter the query on the product_highlighted_weight column
     *
     * Example usage:
     * <code>
     * $query->filterByProductHighlightedWeight(1234); // WHERE product_highlighted_weight = 1234
     * $query->filterByProductHighlightedWeight(array(12, 34)); // WHERE product_highlighted_weight IN (12, 34)
     * $query->filterByProductHighlightedWeight(array('min' => 12)); // WHERE product_highlighted_weight > 12
     * </code>
     *
     * @param     mixed $productHighlightedWeight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByProductHighlightedWeight($productHighlightedWeight = null, $comparison = null)
    {
        if (is_array($productHighlightedWeight)) {
            $useMinMax = false;
            if (isset($productHighlightedWeight['min'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_WEIGHT, $productHighlightedWeight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productHighlightedWeight['max'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_WEIGHT, $productHighlightedWeight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_WEIGHT, $productHighlightedWeight, $comparison);
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
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductHighlightedTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProductHighlightedTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductHighlightedTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Product object
     *
     * @param \App\Propel\Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \App\Propel\Product) {
            return $this
                ->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_ID, $product->getProductId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_ID, $product->toKeyValue('PrimaryKey', 'ProductId'), $comparison);
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
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\Resource object
     *
     * @param \App\Propel\Resource|ObjectCollection $resource The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function filterByResource($resource, $comparison = null)
    {
        if ($resource instanceof \App\Propel\Resource) {
            return $this
                ->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FOR, $resource->getResourceId(), $comparison);
        } elseif ($resource instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_FOR, $resource->toKeyValue('PrimaryKey', 'ResourceId'), $comparison);
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
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function joinResource($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useResourceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinResource($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Resource', '\App\Propel\ResourceQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProductHighlighted $productHighlighted Object to remove from the list of results
     *
     * @return $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function prune($productHighlighted = null)
    {
        if ($productHighlighted) {
            $this->addUsingAlias(ProductHighlightedTableMap::COL_PRODUCT_HIGHLIGHTED_ID, $productHighlighted->getProductHighlightedId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product_highlighted table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductHighlightedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductHighlightedTableMap::clearInstancePool();
            ProductHighlightedTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductHighlightedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductHighlightedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductHighlightedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductHighlightedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ProductHighlightedTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProductHighlightedTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProductHighlightedTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProductHighlightedTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ProductHighlightedTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildProductHighlightedQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProductHighlightedTableMap::COL_CREATED_AT);
    }

} // ProductHighlightedQuery
