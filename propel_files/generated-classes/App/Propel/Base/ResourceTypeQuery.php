<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\ResourceType as ChildResourceType;
use App\Propel\ResourceTypeI18nQuery as ChildResourceTypeI18nQuery;
use App\Propel\ResourceTypeQuery as ChildResourceTypeQuery;
use App\Propel\Map\ResourceTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'resource_type' table.
 *
 *
 *
 * @method     ChildResourceTypeQuery orderByResourceTypeId($order = Criteria::ASC) Order by the resource_type_id column
 * @method     ChildResourceTypeQuery orderByResourceTypeCode($order = Criteria::ASC) Order by the resource_type_code column
 *
 * @method     ChildResourceTypeQuery groupByResourceTypeId() Group by the resource_type_id column
 * @method     ChildResourceTypeQuery groupByResourceTypeCode() Group by the resource_type_code column
 *
 * @method     ChildResourceTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildResourceTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildResourceTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildResourceTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildResourceTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildResourceTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildResourceTypeQuery leftJoinResource($relationAlias = null) Adds a LEFT JOIN clause to the query using the Resource relation
 * @method     ChildResourceTypeQuery rightJoinResource($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Resource relation
 * @method     ChildResourceTypeQuery innerJoinResource($relationAlias = null) Adds a INNER JOIN clause to the query using the Resource relation
 *
 * @method     ChildResourceTypeQuery joinWithResource($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Resource relation
 *
 * @method     ChildResourceTypeQuery leftJoinWithResource() Adds a LEFT JOIN clause and with to the query using the Resource relation
 * @method     ChildResourceTypeQuery rightJoinWithResource() Adds a RIGHT JOIN clause and with to the query using the Resource relation
 * @method     ChildResourceTypeQuery innerJoinWithResource() Adds a INNER JOIN clause and with to the query using the Resource relation
 *
 * @method     ChildResourceTypeQuery leftJoinResourceTypeI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the ResourceTypeI18n relation
 * @method     ChildResourceTypeQuery rightJoinResourceTypeI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ResourceTypeI18n relation
 * @method     ChildResourceTypeQuery innerJoinResourceTypeI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the ResourceTypeI18n relation
 *
 * @method     ChildResourceTypeQuery joinWithResourceTypeI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ResourceTypeI18n relation
 *
 * @method     ChildResourceTypeQuery leftJoinWithResourceTypeI18n() Adds a LEFT JOIN clause and with to the query using the ResourceTypeI18n relation
 * @method     ChildResourceTypeQuery rightJoinWithResourceTypeI18n() Adds a RIGHT JOIN clause and with to the query using the ResourceTypeI18n relation
 * @method     ChildResourceTypeQuery innerJoinWithResourceTypeI18n() Adds a INNER JOIN clause and with to the query using the ResourceTypeI18n relation
 *
 * @method     \App\Propel\ResourceQuery|\App\Propel\ResourceTypeI18nQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildResourceType findOne(ConnectionInterface $con = null) Return the first ChildResourceType matching the query
 * @method     ChildResourceType findOneOrCreate(ConnectionInterface $con = null) Return the first ChildResourceType matching the query, or a new ChildResourceType object populated from the query conditions when no match is found
 *
 * @method     ChildResourceType findOneByResourceTypeId(int $resource_type_id) Return the first ChildResourceType filtered by the resource_type_id column
 * @method     ChildResourceType findOneByResourceTypeCode(string $resource_type_code) Return the first ChildResourceType filtered by the resource_type_code column *

 * @method     ChildResourceType requirePk($key, ConnectionInterface $con = null) Return the ChildResourceType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResourceType requireOne(ConnectionInterface $con = null) Return the first ChildResourceType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildResourceType requireOneByResourceTypeId(int $resource_type_id) Return the first ChildResourceType filtered by the resource_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResourceType requireOneByResourceTypeCode(string $resource_type_code) Return the first ChildResourceType filtered by the resource_type_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildResourceType[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildResourceType objects based on current ModelCriteria
 * @method     ChildResourceType[]|ObjectCollection findByResourceTypeId(int $resource_type_id) Return ChildResourceType objects filtered by the resource_type_id column
 * @method     ChildResourceType[]|ObjectCollection findByResourceTypeCode(string $resource_type_code) Return ChildResourceType objects filtered by the resource_type_code column
 * @method     ChildResourceType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ResourceTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ResourceTypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\ResourceType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildResourceTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildResourceTypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildResourceTypeQuery) {
            return $criteria;
        }
        $query = new ChildResourceTypeQuery();
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
     * @return ChildResourceType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ResourceTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ResourceTypeTableMap::DATABASE_NAME);
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
     * @return ChildResourceType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT resource_type_id, resource_type_code FROM resource_type WHERE resource_type_id = :p0';
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
            /** @var ChildResourceType $obj */
            $obj = new ChildResourceType();
            $obj->hydrate($row);
            ResourceTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildResourceType|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildResourceTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildResourceTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID, $keys, Criteria::IN);
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
     * @param     mixed $resourceTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceTypeQuery The current query, for fluid interface
     */
    public function filterByResourceTypeId($resourceTypeId = null, $comparison = null)
    {
        if (is_array($resourceTypeId)) {
            $useMinMax = false;
            if (isset($resourceTypeId['min'])) {
                $this->addUsingAlias(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID, $resourceTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resourceTypeId['max'])) {
                $this->addUsingAlias(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID, $resourceTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID, $resourceTypeId, $comparison);
    }

    /**
     * Filter the query on the resource_type_code column
     *
     * Example usage:
     * <code>
     * $query->filterByResourceTypeCode('fooValue');   // WHERE resource_type_code = 'fooValue'
     * $query->filterByResourceTypeCode('%fooValue%'); // WHERE resource_type_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $resourceTypeCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceTypeQuery The current query, for fluid interface
     */
    public function filterByResourceTypeCode($resourceTypeCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resourceTypeCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $resourceTypeCode)) {
                $resourceTypeCode = str_replace('*', '%', $resourceTypeCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResourceTypeTableMap::COL_RESOURCE_TYPE_CODE, $resourceTypeCode, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Resource object
     *
     * @param \App\Propel\Resource|ObjectCollection $resource the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceTypeQuery The current query, for fluid interface
     */
    public function filterByResource($resource, $comparison = null)
    {
        if ($resource instanceof \App\Propel\Resource) {
            return $this
                ->addUsingAlias(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID, $resource->getResourceTypeId(), $comparison);
        } elseif ($resource instanceof ObjectCollection) {
            return $this
                ->useResourceQuery()
                ->filterByPrimaryKeys($resource->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildResourceTypeQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\ResourceTypeI18n object
     *
     * @param \App\Propel\ResourceTypeI18n|ObjectCollection $resourceTypeI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildResourceTypeQuery The current query, for fluid interface
     */
    public function filterByResourceTypeI18n($resourceTypeI18n, $comparison = null)
    {
        if ($resourceTypeI18n instanceof \App\Propel\ResourceTypeI18n) {
            return $this
                ->addUsingAlias(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID, $resourceTypeI18n->getResourceTypeId(), $comparison);
        } elseif ($resourceTypeI18n instanceof ObjectCollection) {
            return $this
                ->useResourceTypeI18nQuery()
                ->filterByPrimaryKeys($resourceTypeI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByResourceTypeI18n() only accepts arguments of type \App\Propel\ResourceTypeI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ResourceTypeI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildResourceTypeQuery The current query, for fluid interface
     */
    public function joinResourceTypeI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ResourceTypeI18n');

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
            $this->addJoinObject($join, 'ResourceTypeI18n');
        }

        return $this;
    }

    /**
     * Use the ResourceTypeI18n relation ResourceTypeI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ResourceTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function useResourceTypeI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinResourceTypeI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ResourceTypeI18n', '\App\Propel\ResourceTypeI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildResourceType $resourceType Object to remove from the list of results
     *
     * @return $this|ChildResourceTypeQuery The current query, for fluid interface
     */
    public function prune($resourceType = null)
    {
        if ($resourceType) {
            $this->addUsingAlias(ResourceTypeTableMap::COL_RESOURCE_TYPE_ID, $resourceType->getResourceTypeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the resource_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ResourceTypeTableMap::clearInstancePool();
            ResourceTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ResourceTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ResourceTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ResourceTypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildResourceTypeQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'ResourceTypeI18n';

        return $this
            ->joinResourceTypeI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildResourceTypeQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('ResourceTypeI18n');
        $this->with['ResourceTypeI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ChildResourceTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ResourceTypeI18n', '\App\Propel\ResourceTypeI18nQuery');
    }

} // ResourceTypeQuery
