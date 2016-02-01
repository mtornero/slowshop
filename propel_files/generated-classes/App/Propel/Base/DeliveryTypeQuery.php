<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\DeliveryType as ChildDeliveryType;
use App\Propel\DeliveryTypeI18nQuery as ChildDeliveryTypeI18nQuery;
use App\Propel\DeliveryTypeQuery as ChildDeliveryTypeQuery;
use App\Propel\Map\DeliveryTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'delivery_type' table.
 *
 *
 *
 * @method     ChildDeliveryTypeQuery orderByDeliveryTypeId($order = Criteria::ASC) Order by the delivery_type_id column
 * @method     ChildDeliveryTypeQuery orderByDeliveryTypeCode($order = Criteria::ASC) Order by the delivery_type_code column
 * @method     ChildDeliveryTypeQuery orderByDeliveryTypeIsActive($order = Criteria::ASC) Order by the delivery_type_is_active column
 *
 * @method     ChildDeliveryTypeQuery groupByDeliveryTypeId() Group by the delivery_type_id column
 * @method     ChildDeliveryTypeQuery groupByDeliveryTypeCode() Group by the delivery_type_code column
 * @method     ChildDeliveryTypeQuery groupByDeliveryTypeIsActive() Group by the delivery_type_is_active column
 *
 * @method     ChildDeliveryTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDeliveryTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDeliveryTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDeliveryTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDeliveryTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDeliveryTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDeliveryTypeQuery leftJoinDelivery($relationAlias = null) Adds a LEFT JOIN clause to the query using the Delivery relation
 * @method     ChildDeliveryTypeQuery rightJoinDelivery($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Delivery relation
 * @method     ChildDeliveryTypeQuery innerJoinDelivery($relationAlias = null) Adds a INNER JOIN clause to the query using the Delivery relation
 *
 * @method     ChildDeliveryTypeQuery joinWithDelivery($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Delivery relation
 *
 * @method     ChildDeliveryTypeQuery leftJoinWithDelivery() Adds a LEFT JOIN clause and with to the query using the Delivery relation
 * @method     ChildDeliveryTypeQuery rightJoinWithDelivery() Adds a RIGHT JOIN clause and with to the query using the Delivery relation
 * @method     ChildDeliveryTypeQuery innerJoinWithDelivery() Adds a INNER JOIN clause and with to the query using the Delivery relation
 *
 * @method     ChildDeliveryTypeQuery leftJoinDeliveryTypeI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the DeliveryTypeI18n relation
 * @method     ChildDeliveryTypeQuery rightJoinDeliveryTypeI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DeliveryTypeI18n relation
 * @method     ChildDeliveryTypeQuery innerJoinDeliveryTypeI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the DeliveryTypeI18n relation
 *
 * @method     ChildDeliveryTypeQuery joinWithDeliveryTypeI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DeliveryTypeI18n relation
 *
 * @method     ChildDeliveryTypeQuery leftJoinWithDeliveryTypeI18n() Adds a LEFT JOIN clause and with to the query using the DeliveryTypeI18n relation
 * @method     ChildDeliveryTypeQuery rightJoinWithDeliveryTypeI18n() Adds a RIGHT JOIN clause and with to the query using the DeliveryTypeI18n relation
 * @method     ChildDeliveryTypeQuery innerJoinWithDeliveryTypeI18n() Adds a INNER JOIN clause and with to the query using the DeliveryTypeI18n relation
 *
 * @method     \App\Propel\DeliveryQuery|\App\Propel\DeliveryTypeI18nQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDeliveryType findOne(ConnectionInterface $con = null) Return the first ChildDeliveryType matching the query
 * @method     ChildDeliveryType findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDeliveryType matching the query, or a new ChildDeliveryType object populated from the query conditions when no match is found
 *
 * @method     ChildDeliveryType findOneByDeliveryTypeId(int $delivery_type_id) Return the first ChildDeliveryType filtered by the delivery_type_id column
 * @method     ChildDeliveryType findOneByDeliveryTypeCode(string $delivery_type_code) Return the first ChildDeliveryType filtered by the delivery_type_code column
 * @method     ChildDeliveryType findOneByDeliveryTypeIsActive(boolean $delivery_type_is_active) Return the first ChildDeliveryType filtered by the delivery_type_is_active column *

 * @method     ChildDeliveryType requirePk($key, ConnectionInterface $con = null) Return the ChildDeliveryType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryType requireOne(ConnectionInterface $con = null) Return the first ChildDeliveryType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeliveryType requireOneByDeliveryTypeId(int $delivery_type_id) Return the first ChildDeliveryType filtered by the delivery_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryType requireOneByDeliveryTypeCode(string $delivery_type_code) Return the first ChildDeliveryType filtered by the delivery_type_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryType requireOneByDeliveryTypeIsActive(boolean $delivery_type_is_active) Return the first ChildDeliveryType filtered by the delivery_type_is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeliveryType[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDeliveryType objects based on current ModelCriteria
 * @method     ChildDeliveryType[]|ObjectCollection findByDeliveryTypeId(int $delivery_type_id) Return ChildDeliveryType objects filtered by the delivery_type_id column
 * @method     ChildDeliveryType[]|ObjectCollection findByDeliveryTypeCode(string $delivery_type_code) Return ChildDeliveryType objects filtered by the delivery_type_code column
 * @method     ChildDeliveryType[]|ObjectCollection findByDeliveryTypeIsActive(boolean $delivery_type_is_active) Return ChildDeliveryType objects filtered by the delivery_type_is_active column
 * @method     ChildDeliveryType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DeliveryTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\DeliveryTypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\DeliveryType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDeliveryTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDeliveryTypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDeliveryTypeQuery) {
            return $criteria;
        }
        $query = new ChildDeliveryTypeQuery();
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
     * @return ChildDeliveryType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DeliveryTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DeliveryTypeTableMap::DATABASE_NAME);
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
     * @return ChildDeliveryType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT delivery_type_id, delivery_type_code, delivery_type_is_active FROM delivery_type WHERE delivery_type_id = :p0';
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
            /** @var ChildDeliveryType $obj */
            $obj = new ChildDeliveryType();
            $obj->hydrate($row);
            DeliveryTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDeliveryType|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DeliveryTypeTableMap::COL_DELIVERY_TYPE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DeliveryTypeTableMap::COL_DELIVERY_TYPE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the delivery_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryTypeId(1234); // WHERE delivery_type_id = 1234
     * $query->filterByDeliveryTypeId(array(12, 34)); // WHERE delivery_type_id IN (12, 34)
     * $query->filterByDeliveryTypeId(array('min' => 12)); // WHERE delivery_type_id > 12
     * </code>
     *
     * @param     mixed $deliveryTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function filterByDeliveryTypeId($deliveryTypeId = null, $comparison = null)
    {
        if (is_array($deliveryTypeId)) {
            $useMinMax = false;
            if (isset($deliveryTypeId['min'])) {
                $this->addUsingAlias(DeliveryTypeTableMap::COL_DELIVERY_TYPE_ID, $deliveryTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryTypeId['max'])) {
                $this->addUsingAlias(DeliveryTypeTableMap::COL_DELIVERY_TYPE_ID, $deliveryTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryTypeTableMap::COL_DELIVERY_TYPE_ID, $deliveryTypeId, $comparison);
    }

    /**
     * Filter the query on the delivery_type_code column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryTypeCode('fooValue');   // WHERE delivery_type_code = 'fooValue'
     * $query->filterByDeliveryTypeCode('%fooValue%'); // WHERE delivery_type_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryTypeCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function filterByDeliveryTypeCode($deliveryTypeCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryTypeCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $deliveryTypeCode)) {
                $deliveryTypeCode = str_replace('*', '%', $deliveryTypeCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DeliveryTypeTableMap::COL_DELIVERY_TYPE_CODE, $deliveryTypeCode, $comparison);
    }

    /**
     * Filter the query on the delivery_type_is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryTypeIsActive(true); // WHERE delivery_type_is_active = true
     * $query->filterByDeliveryTypeIsActive('yes'); // WHERE delivery_type_is_active = true
     * </code>
     *
     * @param     boolean|string $deliveryTypeIsActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function filterByDeliveryTypeIsActive($deliveryTypeIsActive = null, $comparison = null)
    {
        if (is_string($deliveryTypeIsActive)) {
            $deliveryTypeIsActive = in_array(strtolower($deliveryTypeIsActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DeliveryTypeTableMap::COL_DELIVERY_TYPE_IS_ACTIVE, $deliveryTypeIsActive, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Delivery object
     *
     * @param \App\Propel\Delivery|ObjectCollection $delivery the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function filterByDelivery($delivery, $comparison = null)
    {
        if ($delivery instanceof \App\Propel\Delivery) {
            return $this
                ->addUsingAlias(DeliveryTypeTableMap::COL_DELIVERY_TYPE_ID, $delivery->getDeliveryTypeId(), $comparison);
        } elseif ($delivery instanceof ObjectCollection) {
            return $this
                ->useDeliveryQuery()
                ->filterByPrimaryKeys($delivery->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDelivery() only accepts arguments of type \App\Propel\Delivery or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Delivery relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function joinDelivery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Delivery');

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
            $this->addJoinObject($join, 'Delivery');
        }

        return $this;
    }

    /**
     * Use the Delivery relation Delivery object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\DeliveryQuery A secondary query class using the current class as primary query
     */
    public function useDeliveryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDelivery($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Delivery', '\App\Propel\DeliveryQuery');
    }

    /**
     * Filter the query by a related \App\Propel\DeliveryTypeI18n object
     *
     * @param \App\Propel\DeliveryTypeI18n|ObjectCollection $deliveryTypeI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function filterByDeliveryTypeI18n($deliveryTypeI18n, $comparison = null)
    {
        if ($deliveryTypeI18n instanceof \App\Propel\DeliveryTypeI18n) {
            return $this
                ->addUsingAlias(DeliveryTypeTableMap::COL_DELIVERY_TYPE_ID, $deliveryTypeI18n->getDeliveryTypeId(), $comparison);
        } elseif ($deliveryTypeI18n instanceof ObjectCollection) {
            return $this
                ->useDeliveryTypeI18nQuery()
                ->filterByPrimaryKeys($deliveryTypeI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDeliveryTypeI18n() only accepts arguments of type \App\Propel\DeliveryTypeI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DeliveryTypeI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function joinDeliveryTypeI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DeliveryTypeI18n');

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
            $this->addJoinObject($join, 'DeliveryTypeI18n');
        }

        return $this;
    }

    /**
     * Use the DeliveryTypeI18n relation DeliveryTypeI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\DeliveryTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function useDeliveryTypeI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinDeliveryTypeI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DeliveryTypeI18n', '\App\Propel\DeliveryTypeI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDeliveryType $deliveryType Object to remove from the list of results
     *
     * @return $this|ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function prune($deliveryType = null)
    {
        if ($deliveryType) {
            $this->addUsingAlias(DeliveryTypeTableMap::COL_DELIVERY_TYPE_ID, $deliveryType->getDeliveryTypeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the delivery_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DeliveryTypeTableMap::clearInstancePool();
            DeliveryTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DeliveryTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DeliveryTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DeliveryTypeTableMap::clearRelatedInstancePool();

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
     * @return    ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'DeliveryTypeI18n';

        return $this
            ->joinDeliveryTypeI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildDeliveryTypeQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('DeliveryTypeI18n');
        $this->with['DeliveryTypeI18n']->setIsWithOneToMany(false);

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
     * @return    ChildDeliveryTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DeliveryTypeI18n', '\App\Propel\DeliveryTypeI18nQuery');
    }

} // DeliveryTypeQuery
