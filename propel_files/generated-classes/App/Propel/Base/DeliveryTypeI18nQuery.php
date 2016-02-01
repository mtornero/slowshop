<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\DeliveryTypeI18n as ChildDeliveryTypeI18n;
use App\Propel\DeliveryTypeI18nQuery as ChildDeliveryTypeI18nQuery;
use App\Propel\Map\DeliveryTypeI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'delivery_type_i18n' table.
 *
 *
 *
 * @method     ChildDeliveryTypeI18nQuery orderByDeliveryTypeId($order = Criteria::ASC) Order by the delivery_type_id column
 * @method     ChildDeliveryTypeI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildDeliveryTypeI18nQuery orderByDeliveryTypeName($order = Criteria::ASC) Order by the delivery_type_name column
 *
 * @method     ChildDeliveryTypeI18nQuery groupByDeliveryTypeId() Group by the delivery_type_id column
 * @method     ChildDeliveryTypeI18nQuery groupByLocale() Group by the locale column
 * @method     ChildDeliveryTypeI18nQuery groupByDeliveryTypeName() Group by the delivery_type_name column
 *
 * @method     ChildDeliveryTypeI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDeliveryTypeI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDeliveryTypeI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDeliveryTypeI18nQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDeliveryTypeI18nQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDeliveryTypeI18nQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDeliveryTypeI18nQuery leftJoinDeliveryType($relationAlias = null) Adds a LEFT JOIN clause to the query using the DeliveryType relation
 * @method     ChildDeliveryTypeI18nQuery rightJoinDeliveryType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DeliveryType relation
 * @method     ChildDeliveryTypeI18nQuery innerJoinDeliveryType($relationAlias = null) Adds a INNER JOIN clause to the query using the DeliveryType relation
 *
 * @method     ChildDeliveryTypeI18nQuery joinWithDeliveryType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DeliveryType relation
 *
 * @method     ChildDeliveryTypeI18nQuery leftJoinWithDeliveryType() Adds a LEFT JOIN clause and with to the query using the DeliveryType relation
 * @method     ChildDeliveryTypeI18nQuery rightJoinWithDeliveryType() Adds a RIGHT JOIN clause and with to the query using the DeliveryType relation
 * @method     ChildDeliveryTypeI18nQuery innerJoinWithDeliveryType() Adds a INNER JOIN clause and with to the query using the DeliveryType relation
 *
 * @method     \App\Propel\DeliveryTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDeliveryTypeI18n findOne(ConnectionInterface $con = null) Return the first ChildDeliveryTypeI18n matching the query
 * @method     ChildDeliveryTypeI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDeliveryTypeI18n matching the query, or a new ChildDeliveryTypeI18n object populated from the query conditions when no match is found
 *
 * @method     ChildDeliveryTypeI18n findOneByDeliveryTypeId(int $delivery_type_id) Return the first ChildDeliveryTypeI18n filtered by the delivery_type_id column
 * @method     ChildDeliveryTypeI18n findOneByLocale(string $locale) Return the first ChildDeliveryTypeI18n filtered by the locale column
 * @method     ChildDeliveryTypeI18n findOneByDeliveryTypeName(string $delivery_type_name) Return the first ChildDeliveryTypeI18n filtered by the delivery_type_name column *

 * @method     ChildDeliveryTypeI18n requirePk($key, ConnectionInterface $con = null) Return the ChildDeliveryTypeI18n by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryTypeI18n requireOne(ConnectionInterface $con = null) Return the first ChildDeliveryTypeI18n matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeliveryTypeI18n requireOneByDeliveryTypeId(int $delivery_type_id) Return the first ChildDeliveryTypeI18n filtered by the delivery_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryTypeI18n requireOneByLocale(string $locale) Return the first ChildDeliveryTypeI18n filtered by the locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveryTypeI18n requireOneByDeliveryTypeName(string $delivery_type_name) Return the first ChildDeliveryTypeI18n filtered by the delivery_type_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeliveryTypeI18n[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDeliveryTypeI18n objects based on current ModelCriteria
 * @method     ChildDeliveryTypeI18n[]|ObjectCollection findByDeliveryTypeId(int $delivery_type_id) Return ChildDeliveryTypeI18n objects filtered by the delivery_type_id column
 * @method     ChildDeliveryTypeI18n[]|ObjectCollection findByLocale(string $locale) Return ChildDeliveryTypeI18n objects filtered by the locale column
 * @method     ChildDeliveryTypeI18n[]|ObjectCollection findByDeliveryTypeName(string $delivery_type_name) Return ChildDeliveryTypeI18n objects filtered by the delivery_type_name column
 * @method     ChildDeliveryTypeI18n[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DeliveryTypeI18nQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\DeliveryTypeI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\DeliveryTypeI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDeliveryTypeI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDeliveryTypeI18nQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDeliveryTypeI18nQuery) {
            return $criteria;
        }
        $query = new ChildDeliveryTypeI18nQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$delivery_type_id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildDeliveryTypeI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DeliveryTypeI18nTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DeliveryTypeI18nTableMap::DATABASE_NAME);
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
     * @return ChildDeliveryTypeI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT delivery_type_id, locale, delivery_type_name FROM delivery_type_i18n WHERE delivery_type_id = :p0 AND locale = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildDeliveryTypeI18n $obj */
            $obj = new ChildDeliveryTypeI18n();
            $obj->hydrate($row);
            DeliveryTypeI18nTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildDeliveryTypeI18n|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildDeliveryTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(DeliveryTypeI18nTableMap::COL_DELIVERY_TYPE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(DeliveryTypeI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDeliveryTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(DeliveryTypeI18nTableMap::COL_DELIVERY_TYPE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(DeliveryTypeI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByDeliveryType()
     *
     * @param     mixed $deliveryTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryTypeI18nQuery The current query, for fluid interface
     */
    public function filterByDeliveryTypeId($deliveryTypeId = null, $comparison = null)
    {
        if (is_array($deliveryTypeId)) {
            $useMinMax = false;
            if (isset($deliveryTypeId['min'])) {
                $this->addUsingAlias(DeliveryTypeI18nTableMap::COL_DELIVERY_TYPE_ID, $deliveryTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryTypeId['max'])) {
                $this->addUsingAlias(DeliveryTypeI18nTableMap::COL_DELIVERY_TYPE_ID, $deliveryTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveryTypeI18nTableMap::COL_DELIVERY_TYPE_ID, $deliveryTypeId, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryTypeI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DeliveryTypeI18nTableMap::COL_LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the delivery_type_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryTypeName('fooValue');   // WHERE delivery_type_name = 'fooValue'
     * $query->filterByDeliveryTypeName('%fooValue%'); // WHERE delivery_type_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryTypeName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveryTypeI18nQuery The current query, for fluid interface
     */
    public function filterByDeliveryTypeName($deliveryTypeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryTypeName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $deliveryTypeName)) {
                $deliveryTypeName = str_replace('*', '%', $deliveryTypeName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DeliveryTypeI18nTableMap::COL_DELIVERY_TYPE_NAME, $deliveryTypeName, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\DeliveryType object
     *
     * @param \App\Propel\DeliveryType|ObjectCollection $deliveryType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDeliveryTypeI18nQuery The current query, for fluid interface
     */
    public function filterByDeliveryType($deliveryType, $comparison = null)
    {
        if ($deliveryType instanceof \App\Propel\DeliveryType) {
            return $this
                ->addUsingAlias(DeliveryTypeI18nTableMap::COL_DELIVERY_TYPE_ID, $deliveryType->getDeliveryTypeId(), $comparison);
        } elseif ($deliveryType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DeliveryTypeI18nTableMap::COL_DELIVERY_TYPE_ID, $deliveryType->toKeyValue('PrimaryKey', 'DeliveryTypeId'), $comparison);
        } else {
            throw new PropelException('filterByDeliveryType() only accepts arguments of type \App\Propel\DeliveryType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DeliveryType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDeliveryTypeI18nQuery The current query, for fluid interface
     */
    public function joinDeliveryType($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DeliveryType');

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
            $this->addJoinObject($join, 'DeliveryType');
        }

        return $this;
    }

    /**
     * Use the DeliveryType relation DeliveryType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\DeliveryTypeQuery A secondary query class using the current class as primary query
     */
    public function useDeliveryTypeQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinDeliveryType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DeliveryType', '\App\Propel\DeliveryTypeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDeliveryTypeI18n $deliveryTypeI18n Object to remove from the list of results
     *
     * @return $this|ChildDeliveryTypeI18nQuery The current query, for fluid interface
     */
    public function prune($deliveryTypeI18n = null)
    {
        if ($deliveryTypeI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(DeliveryTypeI18nTableMap::COL_DELIVERY_TYPE_ID), $deliveryTypeI18n->getDeliveryTypeId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(DeliveryTypeI18nTableMap::COL_LOCALE), $deliveryTypeI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the delivery_type_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryTypeI18nTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DeliveryTypeI18nTableMap::clearInstancePool();
            DeliveryTypeI18nTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveryTypeI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DeliveryTypeI18nTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DeliveryTypeI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DeliveryTypeI18nTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DeliveryTypeI18nQuery
