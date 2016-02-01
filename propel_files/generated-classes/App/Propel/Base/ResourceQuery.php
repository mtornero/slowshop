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
 * @method     ChildResourceQuery orderByResourceTypeId($order = Criteria::ASC) Order by the resource_type_id column
 *
 * @method     ChildResourceQuery groupByResourceId() Group by the resource_id column
 * @method     ChildResourceQuery groupByResourceTypeId() Group by the resource_type_id column
 *
 * @method     ChildResourceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildResourceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildResourceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildResourceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildResourceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildResourceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildResourceQuery leftJoinResourceType($relationAlias = null) Adds a LEFT JOIN clause to the query using the ResourceType relation
 * @method     ChildResourceQuery rightJoinResourceType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ResourceType relation
 * @method     ChildResourceQuery innerJoinResourceType($relationAlias = null) Adds a INNER JOIN clause to the query using the ResourceType relation
 *
 * @method     ChildResourceQuery joinWithResourceType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ResourceType relation
 *
 * @method     ChildResourceQuery leftJoinWithResourceType() Adds a LEFT JOIN clause and with to the query using the ResourceType relation
 * @method     ChildResourceQuery rightJoinWithResourceType() Adds a RIGHT JOIN clause and with to the query using the ResourceType relation
 * @method     ChildResourceQuery innerJoinWithResourceType() Adds a INNER JOIN clause and with to the query using the ResourceType relation
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
 * @method     \App\Propel\ResourceTypeQuery|\App\Propel\CategoryQuery|\App\Propel\ProductQuery|\App\Propel\PromotionQuery|\App\Propel\ResourceFileQuery|\App\Propel\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildResource findOne(ConnectionInterface $con = null) Return the first ChildResource matching the query
 * @method     ChildResource findOneOrCreate(ConnectionInterface $con = null) Return the first ChildResource matching the query, or a new ChildResource object populated from the query conditions when no match is found
 *
 * @method     ChildResource findOneByResourceId(int $resource_id) Return the first ChildResource filtered by the resource_id column
 * @method     ChildResource findOneByResourceTypeId(int $resource_type_id) Return the first ChildResource filtered by the resource_type_id column *

 * @method     ChildResource requirePk($key, ConnectionInterface $con = null) Return the ChildResource by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResource requireOne(ConnectionInterface $con = null) Return the first ChildResource matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildResource requireOneByResourceId(int $resource_id) Return the first ChildResource filtered by the resource_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResource requireOneByResourceTypeId(int $resource_type_id) Return the first ChildResource filtered by the resource_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildResource[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildResource objects based on current ModelCriteria
 * @method     ChildResource[]|ObjectCollection findByResourceId(int $resource_id) Return ChildResource objects filtered by the resource_id column
 * @method     ChildResource[]|ObjectCollection findByResourceTypeId(int $resource_type_id) Return ChildResource objects filtered by the resource_type_id column
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
        $sql = 'SELECT resource_id, resource_type_id FROM resource WHERE resource_id = :p0';
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
            /** @var ChildResource $obj */
            $obj = new ChildResource();
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
     * Filter the query on the resource_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByResourceTypeId(1234); // WHERE resource_type_id = 1234
     * $query->filterByResourceTypeId(array(12, 34)); // WHERE resource_type_id IN (12, 34)
     * $query->filterByResourceTypeId(array('min' => 12)); // WHERE resource_type_id > 12
     * </code>
     *
     * @see       filterByResourceType()
     *
     * @param     mixed $resourceTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function filterByResourceTypeId($resourceTypeId = null, $comparison = null)
    {
        if (is_array($resourceTypeId)) {
            $useMinMax = false;
            if (isset($resourceTypeId['min'])) {
                $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_TYPE_ID, $resourceTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resourceTypeId['max'])) {
                $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_TYPE_ID, $resourceTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_TYPE_ID, $resourceTypeId, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\ResourceType object
     *
     * @param \App\Propel\ResourceType|ObjectCollection $resourceType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildResourceQuery The current query, for fluid interface
     */
    public function filterByResourceType($resourceType, $comparison = null)
    {
        if ($resourceType instanceof \App\Propel\ResourceType) {
            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_TYPE_ID, $resourceType->getResourceTypeId(), $comparison);
        } elseif ($resourceType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ResourceTableMap::COL_RESOURCE_TYPE_ID, $resourceType->toKeyValue('PrimaryKey', 'ResourceTypeId'), $comparison);
        } else {
            throw new PropelException('filterByResourceType() only accepts arguments of type \App\Propel\ResourceType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ResourceType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceQuery The current query, for fluid interface
     */
    public function joinResourceType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ResourceType');

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
            $this->addJoinObject($join, 'ResourceType');
        }

        return $this;
    }

    /**
     * Use the ResourceType relation ResourceType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ResourceTypeQuery A secondary query class using the current class as primary query
     */
    public function useResourceTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinResourceType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ResourceType', '\App\Propel\ResourceTypeQuery');
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
