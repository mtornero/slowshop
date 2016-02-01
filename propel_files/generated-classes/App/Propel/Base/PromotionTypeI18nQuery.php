<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\PromotionTypeI18n as ChildPromotionTypeI18n;
use App\Propel\PromotionTypeI18nQuery as ChildPromotionTypeI18nQuery;
use App\Propel\Map\PromotionTypeI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'promotion_type_i18n' table.
 *
 *
 *
 * @method     ChildPromotionTypeI18nQuery orderByPromotionTypeId($order = Criteria::ASC) Order by the promotion_type_id column
 * @method     ChildPromotionTypeI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildPromotionTypeI18nQuery orderByPromotionTypeName($order = Criteria::ASC) Order by the promotion_type_name column
 *
 * @method     ChildPromotionTypeI18nQuery groupByPromotionTypeId() Group by the promotion_type_id column
 * @method     ChildPromotionTypeI18nQuery groupByLocale() Group by the locale column
 * @method     ChildPromotionTypeI18nQuery groupByPromotionTypeName() Group by the promotion_type_name column
 *
 * @method     ChildPromotionTypeI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPromotionTypeI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPromotionTypeI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPromotionTypeI18nQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPromotionTypeI18nQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPromotionTypeI18nQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPromotionTypeI18nQuery leftJoinPromotionType($relationAlias = null) Adds a LEFT JOIN clause to the query using the PromotionType relation
 * @method     ChildPromotionTypeI18nQuery rightJoinPromotionType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PromotionType relation
 * @method     ChildPromotionTypeI18nQuery innerJoinPromotionType($relationAlias = null) Adds a INNER JOIN clause to the query using the PromotionType relation
 *
 * @method     ChildPromotionTypeI18nQuery joinWithPromotionType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PromotionType relation
 *
 * @method     ChildPromotionTypeI18nQuery leftJoinWithPromotionType() Adds a LEFT JOIN clause and with to the query using the PromotionType relation
 * @method     ChildPromotionTypeI18nQuery rightJoinWithPromotionType() Adds a RIGHT JOIN clause and with to the query using the PromotionType relation
 * @method     ChildPromotionTypeI18nQuery innerJoinWithPromotionType() Adds a INNER JOIN clause and with to the query using the PromotionType relation
 *
 * @method     \App\Propel\PromotionTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPromotionTypeI18n findOne(ConnectionInterface $con = null) Return the first ChildPromotionTypeI18n matching the query
 * @method     ChildPromotionTypeI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPromotionTypeI18n matching the query, or a new ChildPromotionTypeI18n object populated from the query conditions when no match is found
 *
 * @method     ChildPromotionTypeI18n findOneByPromotionTypeId(int $promotion_type_id) Return the first ChildPromotionTypeI18n filtered by the promotion_type_id column
 * @method     ChildPromotionTypeI18n findOneByLocale(string $locale) Return the first ChildPromotionTypeI18n filtered by the locale column
 * @method     ChildPromotionTypeI18n findOneByPromotionTypeName(string $promotion_type_name) Return the first ChildPromotionTypeI18n filtered by the promotion_type_name column *

 * @method     ChildPromotionTypeI18n requirePk($key, ConnectionInterface $con = null) Return the ChildPromotionTypeI18n by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotionTypeI18n requireOne(ConnectionInterface $con = null) Return the first ChildPromotionTypeI18n matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPromotionTypeI18n requireOneByPromotionTypeId(int $promotion_type_id) Return the first ChildPromotionTypeI18n filtered by the promotion_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotionTypeI18n requireOneByLocale(string $locale) Return the first ChildPromotionTypeI18n filtered by the locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotionTypeI18n requireOneByPromotionTypeName(string $promotion_type_name) Return the first ChildPromotionTypeI18n filtered by the promotion_type_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPromotionTypeI18n[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPromotionTypeI18n objects based on current ModelCriteria
 * @method     ChildPromotionTypeI18n[]|ObjectCollection findByPromotionTypeId(int $promotion_type_id) Return ChildPromotionTypeI18n objects filtered by the promotion_type_id column
 * @method     ChildPromotionTypeI18n[]|ObjectCollection findByLocale(string $locale) Return ChildPromotionTypeI18n objects filtered by the locale column
 * @method     ChildPromotionTypeI18n[]|ObjectCollection findByPromotionTypeName(string $promotion_type_name) Return ChildPromotionTypeI18n objects filtered by the promotion_type_name column
 * @method     ChildPromotionTypeI18n[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PromotionTypeI18nQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\PromotionTypeI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\PromotionTypeI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPromotionTypeI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPromotionTypeI18nQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPromotionTypeI18nQuery) {
            return $criteria;
        }
        $query = new ChildPromotionTypeI18nQuery();
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
     * @param array[$promotion_type_id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPromotionTypeI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PromotionTypeI18nTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PromotionTypeI18nTableMap::DATABASE_NAME);
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
     * @return ChildPromotionTypeI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT promotion_type_id, locale, promotion_type_name FROM promotion_type_i18n WHERE promotion_type_id = :p0 AND locale = :p1';
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
            /** @var ChildPromotionTypeI18n $obj */
            $obj = new ChildPromotionTypeI18n();
            $obj->hydrate($row);
            PromotionTypeI18nTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildPromotionTypeI18n|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPromotionTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PromotionTypeI18nTableMap::COL_PROMOTION_TYPE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PromotionTypeI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPromotionTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PromotionTypeI18nTableMap::COL_PROMOTION_TYPE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PromotionTypeI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildPromotionTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPromotionTypeId($promotionTypeId = null, $comparison = null)
    {
        if (is_array($promotionTypeId)) {
            $useMinMax = false;
            if (isset($promotionTypeId['min'])) {
                $this->addUsingAlias(PromotionTypeI18nTableMap::COL_PROMOTION_TYPE_ID, $promotionTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promotionTypeId['max'])) {
                $this->addUsingAlias(PromotionTypeI18nTableMap::COL_PROMOTION_TYPE_ID, $promotionTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTypeI18nTableMap::COL_PROMOTION_TYPE_ID, $promotionTypeId, $comparison);
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
     * @return $this|ChildPromotionTypeI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PromotionTypeI18nTableMap::COL_LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the promotion_type_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionTypeName('fooValue');   // WHERE promotion_type_name = 'fooValue'
     * $query->filterByPromotionTypeName('%fooValue%'); // WHERE promotion_type_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $promotionTypeName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPromotionTypeName($promotionTypeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($promotionTypeName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $promotionTypeName)) {
                $promotionTypeName = str_replace('*', '%', $promotionTypeName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PromotionTypeI18nTableMap::COL_PROMOTION_TYPE_NAME, $promotionTypeName, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\PromotionType object
     *
     * @param \App\Propel\PromotionType|ObjectCollection $promotionType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPromotionTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPromotionType($promotionType, $comparison = null)
    {
        if ($promotionType instanceof \App\Propel\PromotionType) {
            return $this
                ->addUsingAlias(PromotionTypeI18nTableMap::COL_PROMOTION_TYPE_ID, $promotionType->getPromotionTypeId(), $comparison);
        } elseif ($promotionType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PromotionTypeI18nTableMap::COL_PROMOTION_TYPE_ID, $promotionType->toKeyValue('PrimaryKey', 'PromotionTypeId'), $comparison);
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
     * @return $this|ChildPromotionTypeI18nQuery The current query, for fluid interface
     */
    public function joinPromotionType($relationAlias = null, $joinType = 'LEFT JOIN')
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
    public function usePromotionTypeQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPromotionType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PromotionType', '\App\Propel\PromotionTypeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPromotionTypeI18n $promotionTypeI18n Object to remove from the list of results
     *
     * @return $this|ChildPromotionTypeI18nQuery The current query, for fluid interface
     */
    public function prune($promotionTypeI18n = null)
    {
        if ($promotionTypeI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PromotionTypeI18nTableMap::COL_PROMOTION_TYPE_ID), $promotionTypeI18n->getPromotionTypeId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PromotionTypeI18nTableMap::COL_LOCALE), $promotionTypeI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the promotion_type_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PromotionTypeI18nTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PromotionTypeI18nTableMap::clearInstancePool();
            PromotionTypeI18nTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PromotionTypeI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PromotionTypeI18nTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PromotionTypeI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PromotionTypeI18nTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PromotionTypeI18nQuery
