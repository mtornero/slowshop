<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\VariationType as ChildVariationType;
use App\Propel\VariationTypeI18nQuery as ChildVariationTypeI18nQuery;
use App\Propel\VariationTypeQuery as ChildVariationTypeQuery;
use App\Propel\Map\VariationTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'variation_type' table.
 *
 *
 *
 * @method     ChildVariationTypeQuery orderByVariationTypeId($order = Criteria::ASC) Order by the variation_type_id column
 * @method     ChildVariationTypeQuery orderByVariationTypeIsGeneral($order = Criteria::ASC) Order by the variation_type_is_general column
 * @method     ChildVariationTypeQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildVariationTypeQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildVariationTypeQuery groupByVariationTypeId() Group by the variation_type_id column
 * @method     ChildVariationTypeQuery groupByVariationTypeIsGeneral() Group by the variation_type_is_general column
 * @method     ChildVariationTypeQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildVariationTypeQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildVariationTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVariationTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVariationTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVariationTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVariationTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVariationTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVariationTypeQuery leftJoinProductVariationType($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductVariationType relation
 * @method     ChildVariationTypeQuery rightJoinProductVariationType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductVariationType relation
 * @method     ChildVariationTypeQuery innerJoinProductVariationType($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductVariationType relation
 *
 * @method     ChildVariationTypeQuery joinWithProductVariationType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductVariationType relation
 *
 * @method     ChildVariationTypeQuery leftJoinWithProductVariationType() Adds a LEFT JOIN clause and with to the query using the ProductVariationType relation
 * @method     ChildVariationTypeQuery rightJoinWithProductVariationType() Adds a RIGHT JOIN clause and with to the query using the ProductVariationType relation
 * @method     ChildVariationTypeQuery innerJoinWithProductVariationType() Adds a INNER JOIN clause and with to the query using the ProductVariationType relation
 *
 * @method     ChildVariationTypeQuery leftJoinVariation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Variation relation
 * @method     ChildVariationTypeQuery rightJoinVariation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Variation relation
 * @method     ChildVariationTypeQuery innerJoinVariation($relationAlias = null) Adds a INNER JOIN clause to the query using the Variation relation
 *
 * @method     ChildVariationTypeQuery joinWithVariation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Variation relation
 *
 * @method     ChildVariationTypeQuery leftJoinWithVariation() Adds a LEFT JOIN clause and with to the query using the Variation relation
 * @method     ChildVariationTypeQuery rightJoinWithVariation() Adds a RIGHT JOIN clause and with to the query using the Variation relation
 * @method     ChildVariationTypeQuery innerJoinWithVariation() Adds a INNER JOIN clause and with to the query using the Variation relation
 *
 * @method     ChildVariationTypeQuery leftJoinVariationTypeI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the VariationTypeI18n relation
 * @method     ChildVariationTypeQuery rightJoinVariationTypeI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VariationTypeI18n relation
 * @method     ChildVariationTypeQuery innerJoinVariationTypeI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the VariationTypeI18n relation
 *
 * @method     ChildVariationTypeQuery joinWithVariationTypeI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VariationTypeI18n relation
 *
 * @method     ChildVariationTypeQuery leftJoinWithVariationTypeI18n() Adds a LEFT JOIN clause and with to the query using the VariationTypeI18n relation
 * @method     ChildVariationTypeQuery rightJoinWithVariationTypeI18n() Adds a RIGHT JOIN clause and with to the query using the VariationTypeI18n relation
 * @method     ChildVariationTypeQuery innerJoinWithVariationTypeI18n() Adds a INNER JOIN clause and with to the query using the VariationTypeI18n relation
 *
 * @method     \App\Propel\ProductVariationTypeQuery|\App\Propel\VariationQuery|\App\Propel\VariationTypeI18nQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVariationType findOne(ConnectionInterface $con = null) Return the first ChildVariationType matching the query
 * @method     ChildVariationType findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVariationType matching the query, or a new ChildVariationType object populated from the query conditions when no match is found
 *
 * @method     ChildVariationType findOneByVariationTypeId(int $variation_type_id) Return the first ChildVariationType filtered by the variation_type_id column
 * @method     ChildVariationType findOneByVariationTypeIsGeneral(boolean $variation_type_is_general) Return the first ChildVariationType filtered by the variation_type_is_general column
 * @method     ChildVariationType findOneByCreatedAt(string $created_at) Return the first ChildVariationType filtered by the created_at column
 * @method     ChildVariationType findOneByUpdatedAt(string $updated_at) Return the first ChildVariationType filtered by the updated_at column *

 * @method     ChildVariationType requirePk($key, ConnectionInterface $con = null) Return the ChildVariationType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariationType requireOne(ConnectionInterface $con = null) Return the first ChildVariationType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVariationType requireOneByVariationTypeId(int $variation_type_id) Return the first ChildVariationType filtered by the variation_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariationType requireOneByVariationTypeIsGeneral(boolean $variation_type_is_general) Return the first ChildVariationType filtered by the variation_type_is_general column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariationType requireOneByCreatedAt(string $created_at) Return the first ChildVariationType filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVariationType requireOneByUpdatedAt(string $updated_at) Return the first ChildVariationType filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVariationType[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVariationType objects based on current ModelCriteria
 * @method     ChildVariationType[]|ObjectCollection findByVariationTypeId(int $variation_type_id) Return ChildVariationType objects filtered by the variation_type_id column
 * @method     ChildVariationType[]|ObjectCollection findByVariationTypeIsGeneral(boolean $variation_type_is_general) Return ChildVariationType objects filtered by the variation_type_is_general column
 * @method     ChildVariationType[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildVariationType objects filtered by the created_at column
 * @method     ChildVariationType[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildVariationType objects filtered by the updated_at column
 * @method     ChildVariationType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VariationTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\VariationTypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\VariationType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVariationTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVariationTypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVariationTypeQuery) {
            return $criteria;
        }
        $query = new ChildVariationTypeQuery();
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
     * @return ChildVariationType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VariationTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VariationTypeTableMap::DATABASE_NAME);
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
     * @return ChildVariationType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT variation_type_id, variation_type_is_general, created_at, updated_at FROM variation_type WHERE variation_type_id = :p0';
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
            /** @var ChildVariationType $obj */
            $obj = new ChildVariationType();
            $obj->hydrate($row);
            VariationTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVariationType|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $keys, Criteria::IN);
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
     * @param     mixed $variationTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function filterByVariationTypeId($variationTypeId = null, $comparison = null)
    {
        if (is_array($variationTypeId)) {
            $useMinMax = false;
            if (isset($variationTypeId['min'])) {
                $this->addUsingAlias(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $variationTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($variationTypeId['max'])) {
                $this->addUsingAlias(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $variationTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $variationTypeId, $comparison);
    }

    /**
     * Filter the query on the variation_type_is_general column
     *
     * Example usage:
     * <code>
     * $query->filterByVariationTypeIsGeneral(true); // WHERE variation_type_is_general = true
     * $query->filterByVariationTypeIsGeneral('yes'); // WHERE variation_type_is_general = true
     * </code>
     *
     * @param     boolean|string $variationTypeIsGeneral The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function filterByVariationTypeIsGeneral($variationTypeIsGeneral = null, $comparison = null)
    {
        if (is_string($variationTypeIsGeneral)) {
            $variationTypeIsGeneral = in_array(strtolower($variationTypeIsGeneral), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VariationTypeTableMap::COL_VARIATION_TYPE_IS_GENERAL, $variationTypeIsGeneral, $comparison);
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
     * @return $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(VariationTypeTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(VariationTypeTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariationTypeTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(VariationTypeTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(VariationTypeTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VariationTypeTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\ProductVariationType object
     *
     * @param \App\Propel\ProductVariationType|ObjectCollection $productVariationType the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildVariationTypeQuery The current query, for fluid interface
     */
    public function filterByProductVariationType($productVariationType, $comparison = null)
    {
        if ($productVariationType instanceof \App\Propel\ProductVariationType) {
            return $this
                ->addUsingAlias(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $productVariationType->getVariationTypeId(), $comparison);
        } elseif ($productVariationType instanceof ObjectCollection) {
            return $this
                ->useProductVariationTypeQuery()
                ->filterByPrimaryKeys($productVariationType->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductVariationType() only accepts arguments of type \App\Propel\ProductVariationType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductVariationType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function joinProductVariationType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductVariationType');

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
            $this->addJoinObject($join, 'ProductVariationType');
        }

        return $this;
    }

    /**
     * Use the ProductVariationType relation ProductVariationType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ProductVariationTypeQuery A secondary query class using the current class as primary query
     */
    public function useProductVariationTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductVariationType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductVariationType', '\App\Propel\ProductVariationTypeQuery');
    }

    /**
     * Filter the query by a related \App\Propel\Variation object
     *
     * @param \App\Propel\Variation|ObjectCollection $variation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildVariationTypeQuery The current query, for fluid interface
     */
    public function filterByVariation($variation, $comparison = null)
    {
        if ($variation instanceof \App\Propel\Variation) {
            return $this
                ->addUsingAlias(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $variation->getVariationTypeId(), $comparison);
        } elseif ($variation instanceof ObjectCollection) {
            return $this
                ->useVariationQuery()
                ->filterByPrimaryKeys($variation->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function joinVariation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useVariationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVariation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Variation', '\App\Propel\VariationQuery');
    }

    /**
     * Filter the query by a related \App\Propel\VariationTypeI18n object
     *
     * @param \App\Propel\VariationTypeI18n|ObjectCollection $variationTypeI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildVariationTypeQuery The current query, for fluid interface
     */
    public function filterByVariationTypeI18n($variationTypeI18n, $comparison = null)
    {
        if ($variationTypeI18n instanceof \App\Propel\VariationTypeI18n) {
            return $this
                ->addUsingAlias(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $variationTypeI18n->getVariationTypeId(), $comparison);
        } elseif ($variationTypeI18n instanceof ObjectCollection) {
            return $this
                ->useVariationTypeI18nQuery()
                ->filterByPrimaryKeys($variationTypeI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVariationTypeI18n() only accepts arguments of type \App\Propel\VariationTypeI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VariationTypeI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function joinVariationTypeI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VariationTypeI18n');

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
            $this->addJoinObject($join, 'VariationTypeI18n');
        }

        return $this;
    }

    /**
     * Use the VariationTypeI18n relation VariationTypeI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\VariationTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function useVariationTypeI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinVariationTypeI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VariationTypeI18n', '\App\Propel\VariationTypeI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVariationType $variationType Object to remove from the list of results
     *
     * @return $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function prune($variationType = null)
    {
        if ($variationType) {
            $this->addUsingAlias(VariationTypeTableMap::COL_VARIATION_TYPE_ID, $variationType->getVariationTypeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the variation_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VariationTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VariationTypeTableMap::clearInstancePool();
            VariationTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VariationTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VariationTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VariationTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VariationTypeTableMap::clearRelatedInstancePool();

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
     * @return    ChildVariationTypeQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'VariationTypeI18n';

        return $this
            ->joinVariationTypeI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('VariationTypeI18n');
        $this->with['VariationTypeI18n']->setIsWithOneToMany(false);

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
     * @return    ChildVariationTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VariationTypeI18n', '\App\Propel\VariationTypeI18nQuery');
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(VariationTypeTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(VariationTypeTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(VariationTypeTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(VariationTypeTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(VariationTypeTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildVariationTypeQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(VariationTypeTableMap::COL_CREATED_AT);
    }

} // VariationTypeQuery
