<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\PromotionType as ChildPromotionType;
use App\Propel\PromotionTypeI18nQuery as ChildPromotionTypeI18nQuery;
use App\Propel\PromotionTypeQuery as ChildPromotionTypeQuery;
use App\Propel\Map\PromotionTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'promotion_type' table.
 *
 *
 *
 * @method     ChildPromotionTypeQuery orderByPromotionTypeId($order = Criteria::ASC) Order by the promotion_type_id column
 * @method     ChildPromotionTypeQuery orderByPromotionTypeCode($order = Criteria::ASC) Order by the promotion_type_code column
 *
 * @method     ChildPromotionTypeQuery groupByPromotionTypeId() Group by the promotion_type_id column
 * @method     ChildPromotionTypeQuery groupByPromotionTypeCode() Group by the promotion_type_code column
 *
 * @method     ChildPromotionTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPromotionTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPromotionTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPromotionTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPromotionTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPromotionTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPromotionTypeQuery leftJoinPromotion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Promotion relation
 * @method     ChildPromotionTypeQuery rightJoinPromotion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Promotion relation
 * @method     ChildPromotionTypeQuery innerJoinPromotion($relationAlias = null) Adds a INNER JOIN clause to the query using the Promotion relation
 *
 * @method     ChildPromotionTypeQuery joinWithPromotion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Promotion relation
 *
 * @method     ChildPromotionTypeQuery leftJoinWithPromotion() Adds a LEFT JOIN clause and with to the query using the Promotion relation
 * @method     ChildPromotionTypeQuery rightJoinWithPromotion() Adds a RIGHT JOIN clause and with to the query using the Promotion relation
 * @method     ChildPromotionTypeQuery innerJoinWithPromotion() Adds a INNER JOIN clause and with to the query using the Promotion relation
 *
 * @method     ChildPromotionTypeQuery leftJoinPromotionTypeI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the PromotionTypeI18n relation
 * @method     ChildPromotionTypeQuery rightJoinPromotionTypeI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PromotionTypeI18n relation
 * @method     ChildPromotionTypeQuery innerJoinPromotionTypeI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the PromotionTypeI18n relation
 *
 * @method     ChildPromotionTypeQuery joinWithPromotionTypeI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PromotionTypeI18n relation
 *
 * @method     ChildPromotionTypeQuery leftJoinWithPromotionTypeI18n() Adds a LEFT JOIN clause and with to the query using the PromotionTypeI18n relation
 * @method     ChildPromotionTypeQuery rightJoinWithPromotionTypeI18n() Adds a RIGHT JOIN clause and with to the query using the PromotionTypeI18n relation
 * @method     ChildPromotionTypeQuery innerJoinWithPromotionTypeI18n() Adds a INNER JOIN clause and with to the query using the PromotionTypeI18n relation
 *
 * @method     \App\Propel\PromotionQuery|\App\Propel\PromotionTypeI18nQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPromotionType findOne(ConnectionInterface $con = null) Return the first ChildPromotionType matching the query
 * @method     ChildPromotionType findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPromotionType matching the query, or a new ChildPromotionType object populated from the query conditions when no match is found
 *
 * @method     ChildPromotionType findOneByPromotionTypeId(int $promotion_type_id) Return the first ChildPromotionType filtered by the promotion_type_id column
 * @method     ChildPromotionType findOneByPromotionTypeCode(string $promotion_type_code) Return the first ChildPromotionType filtered by the promotion_type_code column *

 * @method     ChildPromotionType requirePk($key, ConnectionInterface $con = null) Return the ChildPromotionType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotionType requireOne(ConnectionInterface $con = null) Return the first ChildPromotionType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPromotionType requireOneByPromotionTypeId(int $promotion_type_id) Return the first ChildPromotionType filtered by the promotion_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPromotionType requireOneByPromotionTypeCode(string $promotion_type_code) Return the first ChildPromotionType filtered by the promotion_type_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPromotionType[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPromotionType objects based on current ModelCriteria
 * @method     ChildPromotionType[]|ObjectCollection findByPromotionTypeId(int $promotion_type_id) Return ChildPromotionType objects filtered by the promotion_type_id column
 * @method     ChildPromotionType[]|ObjectCollection findByPromotionTypeCode(string $promotion_type_code) Return ChildPromotionType objects filtered by the promotion_type_code column
 * @method     ChildPromotionType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PromotionTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\PromotionTypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\PromotionType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPromotionTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPromotionTypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPromotionTypeQuery) {
            return $criteria;
        }
        $query = new ChildPromotionTypeQuery();
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
     * @return ChildPromotionType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PromotionTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PromotionTypeTableMap::DATABASE_NAME);
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
     * @return ChildPromotionType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT promotion_type_id, promotion_type_code FROM promotion_type WHERE promotion_type_id = :p0';
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
            /** @var ChildPromotionType $obj */
            $obj = new ChildPromotionType();
            $obj->hydrate($row);
            PromotionTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPromotionType|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPromotionTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PromotionTypeTableMap::COL_PROMOTION_TYPE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPromotionTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PromotionTypeTableMap::COL_PROMOTION_TYPE_ID, $keys, Criteria::IN);
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
     * @param     mixed $promotionTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionTypeQuery The current query, for fluid interface
     */
    public function filterByPromotionTypeId($promotionTypeId = null, $comparison = null)
    {
        if (is_array($promotionTypeId)) {
            $useMinMax = false;
            if (isset($promotionTypeId['min'])) {
                $this->addUsingAlias(PromotionTypeTableMap::COL_PROMOTION_TYPE_ID, $promotionTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promotionTypeId['max'])) {
                $this->addUsingAlias(PromotionTypeTableMap::COL_PROMOTION_TYPE_ID, $promotionTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PromotionTypeTableMap::COL_PROMOTION_TYPE_ID, $promotionTypeId, $comparison);
    }

    /**
     * Filter the query on the promotion_type_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotionTypeCode('fooValue');   // WHERE promotion_type_code = 'fooValue'
     * $query->filterByPromotionTypeCode('%fooValue%'); // WHERE promotion_type_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $promotionTypeCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPromotionTypeQuery The current query, for fluid interface
     */
    public function filterByPromotionTypeCode($promotionTypeCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($promotionTypeCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $promotionTypeCode)) {
                $promotionTypeCode = str_replace('*', '%', $promotionTypeCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PromotionTypeTableMap::COL_PROMOTION_TYPE_CODE, $promotionTypeCode, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Promotion object
     *
     * @param \App\Propel\Promotion|ObjectCollection $promotion the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPromotionTypeQuery The current query, for fluid interface
     */
    public function filterByPromotion($promotion, $comparison = null)
    {
        if ($promotion instanceof \App\Propel\Promotion) {
            return $this
                ->addUsingAlias(PromotionTypeTableMap::COL_PROMOTION_TYPE_ID, $promotion->getPromotionTypeId(), $comparison);
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
     * @return $this|ChildPromotionTypeQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\PromotionTypeI18n object
     *
     * @param \App\Propel\PromotionTypeI18n|ObjectCollection $promotionTypeI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPromotionTypeQuery The current query, for fluid interface
     */
    public function filterByPromotionTypeI18n($promotionTypeI18n, $comparison = null)
    {
        if ($promotionTypeI18n instanceof \App\Propel\PromotionTypeI18n) {
            return $this
                ->addUsingAlias(PromotionTypeTableMap::COL_PROMOTION_TYPE_ID, $promotionTypeI18n->getPromotionTypeId(), $comparison);
        } elseif ($promotionTypeI18n instanceof ObjectCollection) {
            return $this
                ->usePromotionTypeI18nQuery()
                ->filterByPrimaryKeys($promotionTypeI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPromotionTypeI18n() only accepts arguments of type \App\Propel\PromotionTypeI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PromotionTypeI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPromotionTypeQuery The current query, for fluid interface
     */
    public function joinPromotionTypeI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PromotionTypeI18n');

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
            $this->addJoinObject($join, 'PromotionTypeI18n');
        }

        return $this;
    }

    /**
     * Use the PromotionTypeI18n relation PromotionTypeI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\PromotionTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function usePromotionTypeI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPromotionTypeI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PromotionTypeI18n', '\App\Propel\PromotionTypeI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPromotionType $promotionType Object to remove from the list of results
     *
     * @return $this|ChildPromotionTypeQuery The current query, for fluid interface
     */
    public function prune($promotionType = null)
    {
        if ($promotionType) {
            $this->addUsingAlias(PromotionTypeTableMap::COL_PROMOTION_TYPE_ID, $promotionType->getPromotionTypeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the promotion_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PromotionTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PromotionTypeTableMap::clearInstancePool();
            PromotionTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PromotionTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PromotionTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PromotionTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PromotionTypeTableMap::clearRelatedInstancePool();

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
     * @return    ChildPromotionTypeQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'PromotionTypeI18n';

        return $this
            ->joinPromotionTypeI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildPromotionTypeQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('PromotionTypeI18n');
        $this->with['PromotionTypeI18n']->setIsWithOneToMany(false);

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
     * @return    ChildPromotionTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PromotionTypeI18n', '\App\Propel\PromotionTypeI18nQuery');
    }

} // PromotionTypeQuery
