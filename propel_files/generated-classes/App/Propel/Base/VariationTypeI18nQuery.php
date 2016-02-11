<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\VariationTypeI18n as ChildVariationTypeI18n;
use App\Propel\VariationTypeI18nQuery as ChildVariationTypeI18nQuery;
use App\Propel\Map\VariationTypeI18nTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'variation_type_i18n' table.
 *
 *
 *
 * @method     ChildVariationTypeI18nQuery orderByVariationTypeId($order = Criteria::ASC) Order by the variation_type_id column
 * @method     ChildVariationTypeI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildVariationTypeI18nQuery orderByVariationTypeName($order = Criteria::ASC) Order by the variation_type_name column
 *
 * @method     ChildVariationTypeI18nQuery groupByVariationTypeId() Group by the variation_type_id column
 * @method     ChildVariationTypeI18nQuery groupByLocale() Group by the locale column
 * @method     ChildVariationTypeI18nQuery groupByVariationTypeName() Group by the variation_type_name column
 *
 * @method     ChildVariationTypeI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVariationTypeI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVariationTypeI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVariationTypeI18nQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVariationTypeI18nQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVariationTypeI18nQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVariationTypeI18nQuery leftJoinVariationType($relationAlias = null) Adds a LEFT JOIN clause to the query using the VariationType relation
 * @method     ChildVariationTypeI18nQuery rightJoinVariationType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VariationType relation
 * @method     ChildVariationTypeI18nQuery innerJoinVariationType($relationAlias = null) Adds a INNER JOIN clause to the query using the VariationType relation
 *
 * @method     ChildVariationTypeI18nQuery joinWithVariationType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VariationType relation
 *
 * @method     ChildVariationTypeI18nQuery leftJoinWithVariationType() Adds a LEFT JOIN clause and with to the query using the VariationType relation
 * @method     ChildVariationTypeI18nQuery rightJoinWithVariationType() Adds a RIGHT JOIN clause and with to the query using the VariationType relation
 * @method     ChildVariationTypeI18nQuery innerJoinWithVariationType() Adds a INNER JOIN clause and with to the query using the VariationType relation
 *
 * @method     \App\Propel\VariationTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVariationTypeI18n findOne(ConnectionInterface $con = null) Return the first ChildVariationTypeI18n matching the query
 * @method     ChildVariationTypeI18n findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVariationTypeI18n matching the query, or a new ChildVariationTypeI18n object populated from the query conditions when no match is found
 *
 * @method     ChildVariationTypeI18n findOneByVariationTypeId(int $variation_type_id) Return the first ChildVariationTypeI18n filtered by the variation_type_id column
 * @method     ChildVariationTypeI18n findOneByLocale(string $locale) Return the first ChildVariationTypeI18n filtered by the locale column
 * @method     ChildVariationTypeI18n findOneByVariationTypeName(string $variation_type_name) Return the first ChildVariationTypeI18n filtered by the variation_type_name column *

 * @method     ChildVariationTypeI18n requirePk($key, ConnectionInterface $con = null) Return the ChildVariationTypeI18n by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariationTypeI18n requireOne(ConnectionInterface $con = null) Return the first ChildVariationTypeI18n matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVariationTypeI18n requireOneByVariationTypeId(int $variation_type_id) Return the first ChildVariationTypeI18n filtered by the variation_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariationTypeI18n requireOneByLocale(string $locale) Return the first ChildVariationTypeI18n filtered by the locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariationTypeI18n requireOneByVariationTypeName(string $variation_type_name) Return the first ChildVariationTypeI18n filtered by the variation_type_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVariationTypeI18n[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVariationTypeI18n objects based on current ModelCriteria
 * @method     ChildVariationTypeI18n[]|ObjectCollection findByVariationTypeId(int $variation_type_id) Return ChildVariationTypeI18n objects filtered by the variation_type_id column
 * @method     ChildVariationTypeI18n[]|ObjectCollection findByLocale(string $locale) Return ChildVariationTypeI18n objects filtered by the locale column
 * @method     ChildVariationTypeI18n[]|ObjectCollection findByVariationTypeName(string $variation_type_name) Return ChildVariationTypeI18n objects filtered by the variation_type_name column
 * @method     ChildVariationTypeI18n[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VariationTypeI18nQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\VariationTypeI18nQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\VariationTypeI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVariationTypeI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVariationTypeI18nQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVariationTypeI18nQuery) {
            return $criteria;
        }
        $query = new ChildVariationTypeI18nQuery();
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
     * @param array[$variation_type_id, $locale] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildVariationTypeI18n|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VariationTypeI18nTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VariationTypeI18nTableMap::DATABASE_NAME);
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
     * @return ChildVariationTypeI18n A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT variation_type_id, locale, variation_type_name FROM variation_type_i18n WHERE variation_type_id = :p0 AND locale = :p1';
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
            /** @var ChildVariationTypeI18n $obj */
            $obj = new ChildVariationTypeI18n();
            $obj->hydrate($row);
            VariationTypeI18nTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildVariationTypeI18n|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVariationTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(VariationTypeI18nTableMap::COL_VARIATION_TYPE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(VariationTypeI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVariationTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(VariationTypeI18nTableMap::COL_VARIATION_TYPE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(VariationTypeI18nTableMap::COL_LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildVariationTypeI18nQuery The current query, for fluid interface
     */
    public function filterByVariationTypeId($variationTypeId = null, $comparison = null)
    {
        if (is_array($variationTypeId)) {
            $useMinMax = false;
            if (isset($variationTypeId['min'])) {
                $this->addUsingAlias(VariationTypeI18nTableMap::COL_VARIATION_TYPE_ID, $variationTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($variationTypeId['max'])) {
                $this->addUsingAlias(VariationTypeI18nTableMap::COL_VARIATION_TYPE_ID, $variationTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariationTypeI18nTableMap::COL_VARIATION_TYPE_ID, $variationTypeId, $comparison);
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
     * @return $this|ChildVariationTypeI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VariationTypeI18nTableMap::COL_LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the variation_type_name column
     *
     * Example usage:
     * <code>
     * $query->filterByVariationTypeName('fooValue');   // WHERE variation_type_name = 'fooValue'
     * $query->filterByVariationTypeName('%fooValue%'); // WHERE variation_type_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $variationTypeName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariationTypeI18nQuery The current query, for fluid interface
     */
    public function filterByVariationTypeName($variationTypeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($variationTypeName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $variationTypeName)) {
                $variationTypeName = str_replace('*', '%', $variationTypeName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VariationTypeI18nTableMap::COL_VARIATION_TYPE_NAME, $variationTypeName, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\VariationType object
     *
     * @param \App\Propel\VariationType|ObjectCollection $variationType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVariationTypeI18nQuery The current query, for fluid interface
     */
    public function filterByVariationType($variationType, $comparison = null)
    {
        if ($variationType instanceof \App\Propel\VariationType) {
            return $this
                ->addUsingAlias(VariationTypeI18nTableMap::COL_VARIATION_TYPE_ID, $variationType->getVariationTypeId(), $comparison);
        } elseif ($variationType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VariationTypeI18nTableMap::COL_VARIATION_TYPE_ID, $variationType->toKeyValue('PrimaryKey', 'VariationTypeId'), $comparison);
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
     * @return $this|ChildVariationTypeI18nQuery The current query, for fluid interface
     */
    public function joinVariationType($relationAlias = null, $joinType = 'LEFT JOIN')
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
    public function useVariationTypeQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinVariationType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VariationType', '\App\Propel\VariationTypeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVariationTypeI18n $variationTypeI18n Object to remove from the list of results
     *
     * @return $this|ChildVariationTypeI18nQuery The current query, for fluid interface
     */
    public function prune($variationTypeI18n = null)
    {
        if ($variationTypeI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(VariationTypeI18nTableMap::COL_VARIATION_TYPE_ID), $variationTypeI18n->getVariationTypeId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(VariationTypeI18nTableMap::COL_LOCALE), $variationTypeI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the variation_type_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VariationTypeI18nTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VariationTypeI18nTableMap::clearInstancePool();
            VariationTypeI18nTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VariationTypeI18nTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VariationTypeI18nTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VariationTypeI18nTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VariationTypeI18nTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VariationTypeI18nQuery
