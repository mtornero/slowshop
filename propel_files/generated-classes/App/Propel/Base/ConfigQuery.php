<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Config as ChildConfig;
use App\Propel\ConfigI18nQuery as ChildConfigI18nQuery;
use App\Propel\ConfigQuery as ChildConfigQuery;
use App\Propel\Map\ConfigTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'config' table.
 *
 *
 *
 * @method     ChildConfigQuery orderByConfigId($order = Criteria::ASC) Order by the config_id column
 * @method     ChildConfigQuery orderByConfigCategoryId($order = Criteria::ASC) Order by the config_category_id column
 * @method     ChildConfigQuery orderByConfigKey($order = Criteria::ASC) Order by the config_key column
 * @method     ChildConfigQuery orderByConfigValue($order = Criteria::ASC) Order by the config_value column
 * @method     ChildConfigQuery orderByConfigFormat($order = Criteria::ASC) Order by the config_format column
 * @method     ChildConfigQuery orderByVersion($order = Criteria::ASC) Order by the version column
 *
 * @method     ChildConfigQuery groupByConfigId() Group by the config_id column
 * @method     ChildConfigQuery groupByConfigCategoryId() Group by the config_category_id column
 * @method     ChildConfigQuery groupByConfigKey() Group by the config_key column
 * @method     ChildConfigQuery groupByConfigValue() Group by the config_value column
 * @method     ChildConfigQuery groupByConfigFormat() Group by the config_format column
 * @method     ChildConfigQuery groupByVersion() Group by the version column
 *
 * @method     ChildConfigQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildConfigQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildConfigQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildConfigQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildConfigQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildConfigQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildConfigQuery leftJoinConfigCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ConfigCategory relation
 * @method     ChildConfigQuery rightJoinConfigCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ConfigCategory relation
 * @method     ChildConfigQuery innerJoinConfigCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the ConfigCategory relation
 *
 * @method     ChildConfigQuery joinWithConfigCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ConfigCategory relation
 *
 * @method     ChildConfigQuery leftJoinWithConfigCategory() Adds a LEFT JOIN clause and with to the query using the ConfigCategory relation
 * @method     ChildConfigQuery rightJoinWithConfigCategory() Adds a RIGHT JOIN clause and with to the query using the ConfigCategory relation
 * @method     ChildConfigQuery innerJoinWithConfigCategory() Adds a INNER JOIN clause and with to the query using the ConfigCategory relation
 *
 * @method     ChildConfigQuery leftJoinConfigI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the ConfigI18n relation
 * @method     ChildConfigQuery rightJoinConfigI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ConfigI18n relation
 * @method     ChildConfigQuery innerJoinConfigI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the ConfigI18n relation
 *
 * @method     ChildConfigQuery joinWithConfigI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ConfigI18n relation
 *
 * @method     ChildConfigQuery leftJoinWithConfigI18n() Adds a LEFT JOIN clause and with to the query using the ConfigI18n relation
 * @method     ChildConfigQuery rightJoinWithConfigI18n() Adds a RIGHT JOIN clause and with to the query using the ConfigI18n relation
 * @method     ChildConfigQuery innerJoinWithConfigI18n() Adds a INNER JOIN clause and with to the query using the ConfigI18n relation
 *
 * @method     ChildConfigQuery leftJoinConfigVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ConfigVersion relation
 * @method     ChildConfigQuery rightJoinConfigVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ConfigVersion relation
 * @method     ChildConfigQuery innerJoinConfigVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the ConfigVersion relation
 *
 * @method     ChildConfigQuery joinWithConfigVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ConfigVersion relation
 *
 * @method     ChildConfigQuery leftJoinWithConfigVersion() Adds a LEFT JOIN clause and with to the query using the ConfigVersion relation
 * @method     ChildConfigQuery rightJoinWithConfigVersion() Adds a RIGHT JOIN clause and with to the query using the ConfigVersion relation
 * @method     ChildConfigQuery innerJoinWithConfigVersion() Adds a INNER JOIN clause and with to the query using the ConfigVersion relation
 *
 * @method     \App\Propel\ConfigCategoryQuery|\App\Propel\ConfigI18nQuery|\App\Propel\ConfigVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildConfig findOne(ConnectionInterface $con = null) Return the first ChildConfig matching the query
 * @method     ChildConfig findOneOrCreate(ConnectionInterface $con = null) Return the first ChildConfig matching the query, or a new ChildConfig object populated from the query conditions when no match is found
 *
 * @method     ChildConfig findOneByConfigId(int $config_id) Return the first ChildConfig filtered by the config_id column
 * @method     ChildConfig findOneByConfigCategoryId(int $config_category_id) Return the first ChildConfig filtered by the config_category_id column
 * @method     ChildConfig findOneByConfigKey(string $config_key) Return the first ChildConfig filtered by the config_key column
 * @method     ChildConfig findOneByConfigValue(string $config_value) Return the first ChildConfig filtered by the config_value column
 * @method     ChildConfig findOneByConfigFormat(string $config_format) Return the first ChildConfig filtered by the config_format column
 * @method     ChildConfig findOneByVersion(int $version) Return the first ChildConfig filtered by the version column *

 * @method     ChildConfig requirePk($key, ConnectionInterface $con = null) Return the ChildConfig by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOne(ConnectionInterface $con = null) Return the first ChildConfig matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfig requireOneByConfigId(int $config_id) Return the first ChildConfig filtered by the config_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOneByConfigCategoryId(int $config_category_id) Return the first ChildConfig filtered by the config_category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOneByConfigKey(string $config_key) Return the first ChildConfig filtered by the config_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOneByConfigValue(string $config_value) Return the first ChildConfig filtered by the config_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOneByConfigFormat(string $config_format) Return the first ChildConfig filtered by the config_format column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildConfig requireOneByVersion(int $version) Return the first ChildConfig filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildConfig[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildConfig objects based on current ModelCriteria
 * @method     ChildConfig[]|ObjectCollection findByConfigId(int $config_id) Return ChildConfig objects filtered by the config_id column
 * @method     ChildConfig[]|ObjectCollection findByConfigCategoryId(int $config_category_id) Return ChildConfig objects filtered by the config_category_id column
 * @method     ChildConfig[]|ObjectCollection findByConfigKey(string $config_key) Return ChildConfig objects filtered by the config_key column
 * @method     ChildConfig[]|ObjectCollection findByConfigValue(string $config_value) Return ChildConfig objects filtered by the config_value column
 * @method     ChildConfig[]|ObjectCollection findByConfigFormat(string $config_format) Return ChildConfig objects filtered by the config_format column
 * @method     ChildConfig[]|ObjectCollection findByVersion(int $version) Return ChildConfig objects filtered by the version column
 * @method     ChildConfig[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ConfigQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ConfigQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\Config', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildConfigQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildConfigQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildConfigQuery) {
            return $criteria;
        }
        $query = new ChildConfigQuery();
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
     * @return ChildConfig|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ConfigTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ConfigTableMap::DATABASE_NAME);
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
     * @return ChildConfig A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT config_id, config_category_id, config_key, config_value, config_format, version FROM config WHERE config_id = :p0';
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
            /** @var ChildConfig $obj */
            $obj = new ChildConfig();
            $obj->hydrate($row);
            ConfigTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildConfig|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ConfigTableMap::COL_CONFIG_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ConfigTableMap::COL_CONFIG_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the config_id column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigId(1234); // WHERE config_id = 1234
     * $query->filterByConfigId(array(12, 34)); // WHERE config_id IN (12, 34)
     * $query->filterByConfigId(array('min' => 12)); // WHERE config_id > 12
     * </code>
     *
     * @param     mixed $configId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function filterByConfigId($configId = null, $comparison = null)
    {
        if (is_array($configId)) {
            $useMinMax = false;
            if (isset($configId['min'])) {
                $this->addUsingAlias(ConfigTableMap::COL_CONFIG_ID, $configId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($configId['max'])) {
                $this->addUsingAlias(ConfigTableMap::COL_CONFIG_ID, $configId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConfigTableMap::COL_CONFIG_ID, $configId, $comparison);
    }

    /**
     * Filter the query on the config_category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigCategoryId(1234); // WHERE config_category_id = 1234
     * $query->filterByConfigCategoryId(array(12, 34)); // WHERE config_category_id IN (12, 34)
     * $query->filterByConfigCategoryId(array('min' => 12)); // WHERE config_category_id > 12
     * </code>
     *
     * @see       filterByConfigCategory()
     *
     * @param     mixed $configCategoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function filterByConfigCategoryId($configCategoryId = null, $comparison = null)
    {
        if (is_array($configCategoryId)) {
            $useMinMax = false;
            if (isset($configCategoryId['min'])) {
                $this->addUsingAlias(ConfigTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($configCategoryId['max'])) {
                $this->addUsingAlias(ConfigTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConfigTableMap::COL_CONFIG_CATEGORY_ID, $configCategoryId, $comparison);
    }

    /**
     * Filter the query on the config_key column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigKey('fooValue');   // WHERE config_key = 'fooValue'
     * $query->filterByConfigKey('%fooValue%'); // WHERE config_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function filterByConfigKey($configKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configKey)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configKey)) {
                $configKey = str_replace('*', '%', $configKey);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigTableMap::COL_CONFIG_KEY, $configKey, $comparison);
    }

    /**
     * Filter the query on the config_value column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigValue('fooValue');   // WHERE config_value = 'fooValue'
     * $query->filterByConfigValue('%fooValue%'); // WHERE config_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configValue The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function filterByConfigValue($configValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configValue)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configValue)) {
                $configValue = str_replace('*', '%', $configValue);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigTableMap::COL_CONFIG_VALUE, $configValue, $comparison);
    }

    /**
     * Filter the query on the config_format column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigFormat('fooValue');   // WHERE config_format = 'fooValue'
     * $query->filterByConfigFormat('%fooValue%'); // WHERE config_format LIKE '%fooValue%'
     * </code>
     *
     * @param     string $configFormat The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function filterByConfigFormat($configFormat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configFormat)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $configFormat)) {
                $configFormat = str_replace('*', '%', $configFormat);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ConfigTableMap::COL_CONFIG_FORMAT, $configFormat, $comparison);
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion(1234); // WHERE version = 1234
     * $query->filterByVersion(array(12, 34)); // WHERE version IN (12, 34)
     * $query->filterByVersion(array('min' => 12)); // WHERE version > 12
     * </code>
     *
     * @param     mixed $version The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function filterByVersion($version = null, $comparison = null)
    {
        if (is_array($version)) {
            $useMinMax = false;
            if (isset($version['min'])) {
                $this->addUsingAlias(ConfigTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ConfigTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ConfigTableMap::COL_VERSION, $version, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\ConfigCategory object
     *
     * @param \App\Propel\ConfigCategory|ObjectCollection $configCategory The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildConfigQuery The current query, for fluid interface
     */
    public function filterByConfigCategory($configCategory, $comparison = null)
    {
        if ($configCategory instanceof \App\Propel\ConfigCategory) {
            return $this
                ->addUsingAlias(ConfigTableMap::COL_CONFIG_CATEGORY_ID, $configCategory->getConfigCategoryId(), $comparison);
        } elseif ($configCategory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ConfigTableMap::COL_CONFIG_CATEGORY_ID, $configCategory->toKeyValue('PrimaryKey', 'ConfigCategoryId'), $comparison);
        } else {
            throw new PropelException('filterByConfigCategory() only accepts arguments of type \App\Propel\ConfigCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ConfigCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function joinConfigCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ConfigCategory');

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
            $this->addJoinObject($join, 'ConfigCategory');
        }

        return $this;
    }

    /**
     * Use the ConfigCategory relation ConfigCategory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ConfigCategoryQuery A secondary query class using the current class as primary query
     */
    public function useConfigCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinConfigCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ConfigCategory', '\App\Propel\ConfigCategoryQuery');
    }

    /**
     * Filter the query by a related \App\Propel\ConfigI18n object
     *
     * @param \App\Propel\ConfigI18n|ObjectCollection $configI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildConfigQuery The current query, for fluid interface
     */
    public function filterByConfigI18n($configI18n, $comparison = null)
    {
        if ($configI18n instanceof \App\Propel\ConfigI18n) {
            return $this
                ->addUsingAlias(ConfigTableMap::COL_CONFIG_ID, $configI18n->getConfigId(), $comparison);
        } elseif ($configI18n instanceof ObjectCollection) {
            return $this
                ->useConfigI18nQuery()
                ->filterByPrimaryKeys($configI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByConfigI18n() only accepts arguments of type \App\Propel\ConfigI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ConfigI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function joinConfigI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ConfigI18n');

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
            $this->addJoinObject($join, 'ConfigI18n');
        }

        return $this;
    }

    /**
     * Use the ConfigI18n relation ConfigI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ConfigI18nQuery A secondary query class using the current class as primary query
     */
    public function useConfigI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinConfigI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ConfigI18n', '\App\Propel\ConfigI18nQuery');
    }

    /**
     * Filter the query by a related \App\Propel\ConfigVersion object
     *
     * @param \App\Propel\ConfigVersion|ObjectCollection $configVersion the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildConfigQuery The current query, for fluid interface
     */
    public function filterByConfigVersion($configVersion, $comparison = null)
    {
        if ($configVersion instanceof \App\Propel\ConfigVersion) {
            return $this
                ->addUsingAlias(ConfigTableMap::COL_CONFIG_ID, $configVersion->getConfigId(), $comparison);
        } elseif ($configVersion instanceof ObjectCollection) {
            return $this
                ->useConfigVersionQuery()
                ->filterByPrimaryKeys($configVersion->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByConfigVersion() only accepts arguments of type \App\Propel\ConfigVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ConfigVersion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function joinConfigVersion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ConfigVersion');

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
            $this->addJoinObject($join, 'ConfigVersion');
        }

        return $this;
    }

    /**
     * Use the ConfigVersion relation ConfigVersion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ConfigVersionQuery A secondary query class using the current class as primary query
     */
    public function useConfigVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinConfigVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ConfigVersion', '\App\Propel\ConfigVersionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildConfig $config Object to remove from the list of results
     *
     * @return $this|ChildConfigQuery The current query, for fluid interface
     */
    public function prune($config = null)
    {
        if ($config) {
            $this->addUsingAlias(ConfigTableMap::COL_CONFIG_ID, $config->getConfigId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the config table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ConfigTableMap::clearInstancePool();
            ConfigTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ConfigTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ConfigTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ConfigTableMap::clearRelatedInstancePool();

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
     * @return    ChildConfigQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'ConfigI18n';

        return $this
            ->joinConfigI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildConfigQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('ConfigI18n');
        $this->with['ConfigI18n']->setIsWithOneToMany(false);

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
     * @return    ChildConfigI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ConfigI18n', '\App\Propel\ConfigI18nQuery');
    }

    // versionable behavior

    /**
     * Checks whether versioning is enabled
     *
     * @return boolean
     */
    static public function isVersioningEnabled()
    {
        return self::$isVersioningEnabled;
    }

    /**
     * Enables versioning
     */
    static public function enableVersioning()
    {
        self::$isVersioningEnabled = true;
    }

    /**
     * Disables versioning
     */
    static public function disableVersioning()
    {
        self::$isVersioningEnabled = false;
    }

} // ConfigQuery
