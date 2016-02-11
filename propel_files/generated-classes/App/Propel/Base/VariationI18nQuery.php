<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\VariationI18n as ChildVariationI18n;
use App\Propel\VariationI18nQuery as ChildVariationI18nQuery;
use App\Propel\Map\VariationI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'variation_i18n' table.
 *
 *
 *
 * @method     ChildVariationI18nQuery orderByVariationId($order = Criteria::ASC) Order by the variation_id column
 * @method     ChildVariationI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildVariationI18nQuery orderByVariationName($order = Criteria::ASC) Order by the variation_name column
 *
 * @method     ChildVariationI18nQuery groupByVariationId() Group by the variation_id column
 * @method     ChildVariationI18nQuery groupByLocale() Group by the locale column
 * @method     ChildVariationI18nQuery groupByVariationName() Group by the variation_name column
 *
 * @method     ChildVariationI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVariationI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVariationI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVariationI18nQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVariationI18nQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVariationI18nQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVariationI18nQuery leftJoinVariation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Variation relation
 * @method     ChildVariationI18nQuery rightJoinVariation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Variation relation
 * @method     ChildVariationI18nQuery innerJoinVariation($relationAlias = null) Adds a INNER JOIN clause to the query using the Variation relation
 *
 * @method     ChildVariationI18nQuery joinWithVariation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Variation relation
 *
 * @method     ChildVariationI18nQuery leftJoinWithVariation() Adds a LEFT JOIN clause and with to the query using the Variation relation
 * @method     ChildVariationI18nQuery rightJoinWithVariation() Adds a RIGHT JOIN clause and with to the query using the Variation relation
 * @method     ChildVariationI18nQuery innerJoinWithVariation() Adds a INNER JOIN clause and with to the query using the Variation relation
 *
 * @method     \App\Propel\VariationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVariationI18n findOne(ConnectionInterface $con = null) Return the first ChildVariationI18n matching the query
 * @method     ChildVariationI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVariationI18n matching the query, or a new ChildVariationI18n object populated from the query conditions when no match is found
 *
 * @method     ChildVariationI18n findOneByVariationId(int $variation_id) Return the first ChildVariationI18n filtered by the variation_id column
 * @method     ChildVariationI18n findOneByLocale(string $locale) Return the first ChildVariationI18n filtered by the locale column
 * @method     ChildVariationI18n findOneByVariationName(string $variation_name) Return the first ChildVariationI18n filtered by the variation_name column *

 * @method     ChildVariationI18n requirePk($key, ConnectionInterface $con = null) Return the ChildVariationI18n by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariationI18n requireOne(ConnectionInterface $con = null) Return the first ChildVariationI18n matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVariationI18n requireOneByVariationId(int $variation_id) Return the first ChildVariationI18n filtered by the variation_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariationI18n requireOneByLocale(string $locale) Return the first ChildVariationI18n filtered by the locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariationI18n requireOneByVariationName(string $variation_name) Return the first ChildVariationI18n filtered by the variation_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVariationI18n[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVariationI18n objects based on current ModelCriteria
 * @method     ChildVariationI18n[]|ObjectCollection findByVariationId(int $variation_id) Return ChildVariationI18n objects filtered by the variation_id column
 * @method     ChildVariationI18n[]|ObjectCollection findByLocale(string $locale) Return ChildVariationI18n objects filtered by the locale column
 * @method     ChildVariationI18n[]|ObjectCollection findByVariationName(string $variation_name) Return ChildVariationI18n objects filtered by the variation_name column
 * @method     ChildVariationI18n[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VariationI18nQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\VariationI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\VariationI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVariationI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVariationI18nQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVariationI18nQuery) {
            return $criteria;
        }
        $query = new ChildVariationI18nQuery();
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
     * @param array[$variation_id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildVariationI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VariationI18nTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VariationI18nTableMap::DATABASE_NAME);
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
     * @return ChildVariationI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT variation_id, locale, variation_name FROM variation_i18n WHERE variation_id = :p0 AND locale = :p1';
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
            /** @var ChildVariationI18n $obj */
            $obj = new ChildVariationI18n();
            $obj->hydrate($row);
            VariationI18nTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildVariationI18n|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVariationI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(VariationI18nTableMap::COL_VARIATION_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(VariationI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVariationI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(VariationI18nTableMap::COL_VARIATION_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(VariationI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the variation_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVariationId(1234); // WHERE variation_id = 1234
     * $query->filterByVariationId(array(12, 34)); // WHERE variation_id IN (12, 34)
     * $query->filterByVariationId(array('min' => 12)); // WHERE variation_id > 12
     * </code>
     *
     * @see       filterByVariation()
     *
     * @param     mixed $variationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariationI18nQuery The current query, for fluid interface
     */
    public function filterByVariationId($variationId = null, $comparison = null)
    {
        if (is_array($variationId)) {
            $useMinMax = false;
            if (isset($variationId['min'])) {
                $this->addUsingAlias(VariationI18nTableMap::COL_VARIATION_ID, $variationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($variationId['max'])) {
                $this->addUsingAlias(VariationI18nTableMap::COL_VARIATION_ID, $variationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariationI18nTableMap::COL_VARIATION_ID, $variationId, $comparison);
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
     * @return $this|ChildVariationI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VariationI18nTableMap::COL_LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the variation_name column
     *
     * Example usage:
     * <code>
     * $query->filterByVariationName('fooValue');   // WHERE variation_name = 'fooValue'
     * $query->filterByVariationName('%fooValue%'); // WHERE variation_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $variationName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariationI18nQuery The current query, for fluid interface
     */
    public function filterByVariationName($variationName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($variationName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $variationName)) {
                $variationName = str_replace('*', '%', $variationName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VariationI18nTableMap::COL_VARIATION_NAME, $variationName, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Variation object
     *
     * @param \App\Propel\Variation|ObjectCollection $variation The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVariationI18nQuery The current query, for fluid interface
     */
    public function filterByVariation($variation, $comparison = null)
    {
        if ($variation instanceof \App\Propel\Variation) {
            return $this
                ->addUsingAlias(VariationI18nTableMap::COL_VARIATION_ID, $variation->getVariationId(), $comparison);
        } elseif ($variation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VariationI18nTableMap::COL_VARIATION_ID, $variation->toKeyValue('PrimaryKey', 'VariationId'), $comparison);
        } else {
            throw new PropelException('filterByVariation() only accepts arguments of type \App\Propel\Variation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Variation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVariationI18nQuery The current query, for fluid interface
     */
    public function joinVariation($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Variation');

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
            $this->addJoinObject($join, 'Variation');
        }

        return $this;
    }

    /**
     * Use the Variation relation Variation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\VariationQuery A secondary query class using the current class as primary query
     */
    public function useVariationQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinVariation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Variation', '\App\Propel\VariationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVariationI18n $variationI18n Object to remove from the list of results
     *
     * @return $this|ChildVariationI18nQuery The current query, for fluid interface
     */
    public function prune($variationI18n = null)
    {
        if ($variationI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(VariationI18nTableMap::COL_VARIATION_ID), $variationI18n->getVariationId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(VariationI18nTableMap::COL_LOCALE), $variationI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the variation_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VariationI18nTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VariationI18nTableMap::clearInstancePool();
            VariationI18nTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VariationI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VariationI18nTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VariationI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VariationI18nTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VariationI18nQuery
