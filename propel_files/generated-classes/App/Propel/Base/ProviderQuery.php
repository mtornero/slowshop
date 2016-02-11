<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\Provider as ChildProvider;
use App\Propel\ProviderQuery as ChildProviderQuery;
use App\Propel\Map\ProviderTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'provider' table.
 *
 *
 *
 * @method     ChildProviderQuery orderByProviderId($order = Criteria::ASC) Order by the provider_id column
 * @method     ChildProviderQuery orderByResourceId($order = Criteria::ASC) Order by the resource_id column
 * @method     ChildProviderQuery orderByProviderName($order = Criteria::ASC) Order by the provider_name column
 * @method     ChildProviderQuery orderByProviderDescription($order = Criteria::ASC) Order by the provider_description column
 * @method     ChildProviderQuery orderByProviderIsOwn($order = Criteria::ASC) Order by the provider_is_own column
 * @method     ChildProviderQuery orderByProviderIsActive($order = Criteria::ASC) Order by the provider_is_active column
 * @method     ChildProviderQuery orderByProviderPic($order = Criteria::ASC) Order by the provider_pic column
 * @method     ChildProviderQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProviderQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProviderQuery groupByProviderId() Group by the provider_id column
 * @method     ChildProviderQuery groupByResourceId() Group by the resource_id column
 * @method     ChildProviderQuery groupByProviderName() Group by the provider_name column
 * @method     ChildProviderQuery groupByProviderDescription() Group by the provider_description column
 * @method     ChildProviderQuery groupByProviderIsOwn() Group by the provider_is_own column
 * @method     ChildProviderQuery groupByProviderIsActive() Group by the provider_is_active column
 * @method     ChildProviderQuery groupByProviderPic() Group by the provider_pic column
 * @method     ChildProviderQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProviderQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProviderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProviderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProviderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProviderQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProviderQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProviderQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProviderQuery leftJoinResource($relationAlias = null) Adds a LEFT JOIN clause to the query using the Resource relation
 * @method     ChildProviderQuery rightJoinResource($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Resource relation
 * @method     ChildProviderQuery innerJoinResource($relationAlias = null) Adds a INNER JOIN clause to the query using the Resource relation
 *
 * @method     ChildProviderQuery joinWithResource($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Resource relation
 *
 * @method     ChildProviderQuery leftJoinWithResource() Adds a LEFT JOIN clause and with to the query using the Resource relation
 * @method     ChildProviderQuery rightJoinWithResource() Adds a RIGHT JOIN clause and with to the query using the Resource relation
 * @method     ChildProviderQuery innerJoinWithResource() Adds a INNER JOIN clause and with to the query using the Resource relation
 *
 * @method     ChildProviderQuery leftJoinFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the File relation
 * @method     ChildProviderQuery rightJoinFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the File relation
 * @method     ChildProviderQuery innerJoinFile($relationAlias = null) Adds a INNER JOIN clause to the query using the File relation
 *
 * @method     ChildProviderQuery joinWithFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the File relation
 *
 * @method     ChildProviderQuery leftJoinWithFile() Adds a LEFT JOIN clause and with to the query using the File relation
 * @method     ChildProviderQuery rightJoinWithFile() Adds a RIGHT JOIN clause and with to the query using the File relation
 * @method     ChildProviderQuery innerJoinWithFile() Adds a INNER JOIN clause and with to the query using the File relation
 *
 * @method     ChildProviderQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildProviderQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildProviderQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildProviderQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildProviderQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildProviderQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildProviderQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     \App\Propel\ResourceQuery|\App\Propel\FileQuery|\App\Propel\ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProvider findOne(ConnectionInterface $con = null) Return the first ChildProvider matching the query
 * @method     ChildProvider findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProvider matching the query, or a new ChildProvider object populated from the query conditions when no match is found
 *
 * @method     ChildProvider findOneByProviderId(int $provider_id) Return the first ChildProvider filtered by the provider_id column
 * @method     ChildProvider findOneByResourceId(int $resource_id) Return the first ChildProvider filtered by the resource_id column
 * @method     ChildProvider findOneByProviderName(string $provider_name) Return the first ChildProvider filtered by the provider_name column
 * @method     ChildProvider findOneByProviderDescription(string $provider_description) Return the first ChildProvider filtered by the provider_description column
 * @method     ChildProvider findOneByProviderIsOwn(boolean $provider_is_own) Return the first ChildProvider filtered by the provider_is_own column
 * @method     ChildProvider findOneByProviderIsActive(boolean $provider_is_active) Return the first ChildProvider filtered by the provider_is_active column
 * @method     ChildProvider findOneByProviderPic(int $provider_pic) Return the first ChildProvider filtered by the provider_pic column
 * @method     ChildProvider findOneByCreatedAt(string $created_at) Return the first ChildProvider filtered by the created_at column
 * @method     ChildProvider findOneByUpdatedAt(string $updated_at) Return the first ChildProvider filtered by the updated_at column *

 * @method     ChildProvider requirePk($key, ConnectionInterface $con = null) Return the ChildProvider by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvider requireOne(ConnectionInterface $con = null) Return the first ChildProvider matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProvider requireOneByProviderId(int $provider_id) Return the first ChildProvider filtered by the provider_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvider requireOneByResourceId(int $resource_id) Return the first ChildProvider filtered by the resource_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvider requireOneByProviderName(string $provider_name) Return the first ChildProvider filtered by the provider_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvider requireOneByProviderDescription(string $provider_description) Return the first ChildProvider filtered by the provider_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvider requireOneByProviderIsOwn(boolean $provider_is_own) Return the first ChildProvider filtered by the provider_is_own column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvider requireOneByProviderIsActive(boolean $provider_is_active) Return the first ChildProvider filtered by the provider_is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvider requireOneByProviderPic(int $provider_pic) Return the first ChildProvider filtered by the provider_pic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvider requireOneByCreatedAt(string $created_at) Return the first ChildProvider filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProvider requireOneByUpdatedAt(string $updated_at) Return the first ChildProvider filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProvider[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProvider objects based on current ModelCriteria
 * @method     ChildProvider[]|ObjectCollection findByProviderId(int $provider_id) Return ChildProvider objects filtered by the provider_id column
 * @method     ChildProvider[]|ObjectCollection findByResourceId(int $resource_id) Return ChildProvider objects filtered by the resource_id column
 * @method     ChildProvider[]|ObjectCollection findByProviderName(string $provider_name) Return ChildProvider objects filtered by the provider_name column
 * @method     ChildProvider[]|ObjectCollection findByProviderDescription(string $provider_description) Return ChildProvider objects filtered by the provider_description column
 * @method     ChildProvider[]|ObjectCollection findByProviderIsOwn(boolean $provider_is_own) Return ChildProvider objects filtered by the provider_is_own column
 * @method     ChildProvider[]|ObjectCollection findByProviderIsActive(boolean $provider_is_active) Return ChildProvider objects filtered by the provider_is_active column
 * @method     ChildProvider[]|ObjectCollection findByProviderPic(int $provider_pic) Return ChildProvider objects filtered by the provider_pic column
 * @method     ChildProvider[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProvider objects filtered by the created_at column
 * @method     ChildProvider[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProvider objects filtered by the updated_at column
 * @method     ChildProvider[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProviderQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ProviderQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\Provider', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProviderQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProviderQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProviderQuery) {
            return $criteria;
        }
        $query = new ChildProviderQuery();
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
     * @return ChildProvider|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProviderTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProviderTableMap::DATABASE_NAME);
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
     * @return ChildProvider A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT provider_id, resource_id, provider_name, provider_description, provider_is_own, provider_is_active, provider_pic, created_at, updated_at FROM provider WHERE provider_id = :p0';
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
            /** @var ChildProvider $obj */
            $obj = new ChildProvider();
            $obj->hydrate($row);
            ProviderTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProvider|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the provider_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProviderId(1234); // WHERE provider_id = 1234
     * $query->filterByProviderId(array(12, 34)); // WHERE provider_id IN (12, 34)
     * $query->filterByProviderId(array('min' => 12)); // WHERE provider_id > 12
     * </code>
     *
     * @param     mixed $providerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByProviderId($providerId = null, $comparison = null)
    {
        if (is_array($providerId)) {
            $useMinMax = false;
            if (isset($providerId['min'])) {
                $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_ID, $providerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($providerId['max'])) {
                $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_ID, $providerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_ID, $providerId, $comparison);
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
     * @see       filterByResource()
     *
     * @param     mixed $resourceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByResourceId($resourceId = null, $comparison = null)
    {
        if (is_array($resourceId)) {
            $useMinMax = false;
            if (isset($resourceId['min'])) {
                $this->addUsingAlias(ProviderTableMap::COL_RESOURCE_ID, $resourceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resourceId['max'])) {
                $this->addUsingAlias(ProviderTableMap::COL_RESOURCE_ID, $resourceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProviderTableMap::COL_RESOURCE_ID, $resourceId, $comparison);
    }

    /**
     * Filter the query on the provider_name column
     *
     * Example usage:
     * <code>
     * $query->filterByProviderName('fooValue');   // WHERE provider_name = 'fooValue'
     * $query->filterByProviderName('%fooValue%'); // WHERE provider_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $providerName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByProviderName($providerName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($providerName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $providerName)) {
                $providerName = str_replace('*', '%', $providerName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_NAME, $providerName, $comparison);
    }

    /**
     * Filter the query on the provider_description column
     *
     * Example usage:
     * <code>
     * $query->filterByProviderDescription('fooValue');   // WHERE provider_description = 'fooValue'
     * $query->filterByProviderDescription('%fooValue%'); // WHERE provider_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $providerDescription The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByProviderDescription($providerDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($providerDescription)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $providerDescription)) {
                $providerDescription = str_replace('*', '%', $providerDescription);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_DESCRIPTION, $providerDescription, $comparison);
    }

    /**
     * Filter the query on the provider_is_own column
     *
     * Example usage:
     * <code>
     * $query->filterByProviderIsOwn(true); // WHERE provider_is_own = true
     * $query->filterByProviderIsOwn('yes'); // WHERE provider_is_own = true
     * </code>
     *
     * @param     boolean|string $providerIsOwn The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByProviderIsOwn($providerIsOwn = null, $comparison = null)
    {
        if (is_string($providerIsOwn)) {
            $providerIsOwn = in_array(strtolower($providerIsOwn), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_IS_OWN, $providerIsOwn, $comparison);
    }

    /**
     * Filter the query on the provider_is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByProviderIsActive(true); // WHERE provider_is_active = true
     * $query->filterByProviderIsActive('yes'); // WHERE provider_is_active = true
     * </code>
     *
     * @param     boolean|string $providerIsActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByProviderIsActive($providerIsActive = null, $comparison = null)
    {
        if (is_string($providerIsActive)) {
            $providerIsActive = in_array(strtolower($providerIsActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_IS_ACTIVE, $providerIsActive, $comparison);
    }

    /**
     * Filter the query on the provider_pic column
     *
     * Example usage:
     * <code>
     * $query->filterByProviderPic(1234); // WHERE provider_pic = 1234
     * $query->filterByProviderPic(array(12, 34)); // WHERE provider_pic IN (12, 34)
     * $query->filterByProviderPic(array('min' => 12)); // WHERE provider_pic > 12
     * </code>
     *
     * @see       filterByFile()
     *
     * @param     mixed $providerPic The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByProviderPic($providerPic = null, $comparison = null)
    {
        if (is_array($providerPic)) {
            $useMinMax = false;
            if (isset($providerPic['min'])) {
                $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_PIC, $providerPic['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($providerPic['max'])) {
                $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_PIC, $providerPic['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_PIC, $providerPic, $comparison);
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
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProviderTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProviderTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProviderTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProviderTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProviderTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProviderTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Resource object
     *
     * @param \App\Propel\Resource|ObjectCollection $resource The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProviderQuery The current query, for fluid interface
     */
    public function filterByResource($resource, $comparison = null)
    {
        if ($resource instanceof \App\Propel\Resource) {
            return $this
                ->addUsingAlias(ProviderTableMap::COL_RESOURCE_ID, $resource->getResourceId(), $comparison);
        } elseif ($resource instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProviderTableMap::COL_RESOURCE_ID, $resource->toKeyValue('PrimaryKey', 'ResourceId'), $comparison);
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
     * @return $this|ChildProviderQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\File object
     *
     * @param \App\Propel\File|ObjectCollection $file The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProviderQuery The current query, for fluid interface
     */
    public function filterByFile($file, $comparison = null)
    {
        if ($file instanceof \App\Propel\File) {
            return $this
                ->addUsingAlias(ProviderTableMap::COL_PROVIDER_PIC, $file->getFileId(), $comparison);
        } elseif ($file instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProviderTableMap::COL_PROVIDER_PIC, $file->toKeyValue('PrimaryKey', 'FileId'), $comparison);
        } else {
            throw new PropelException('filterByFile() only accepts arguments of type \App\Propel\File or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the File relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function joinFile($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('File');

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
            $this->addJoinObject($join, 'File');
        }

        return $this;
    }

    /**
     * Use the File relation File object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\FileQuery A secondary query class using the current class as primary query
     */
    public function useFileQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'File', '\App\Propel\FileQuery');
    }

    /**
     * Filter the query by a related \App\Propel\Product object
     *
     * @param \App\Propel\Product|ObjectCollection $product the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProviderQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \App\Propel\Product) {
            return $this
                ->addUsingAlias(ProviderTableMap::COL_PROVIDER_ID, $product->getProviderId(), $comparison);
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
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useProductQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\App\Propel\ProductQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProvider $provider Object to remove from the list of results
     *
     * @return $this|ChildProviderQuery The current query, for fluid interface
     */
    public function prune($provider = null)
    {
        if ($provider) {
            $this->addUsingAlias(ProviderTableMap::COL_PROVIDER_ID, $provider->getProviderId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the provider table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProviderTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProviderTableMap::clearInstancePool();
            ProviderTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProviderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProviderTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProviderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProviderTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildProviderQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ProviderTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildProviderQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProviderTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildProviderQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProviderTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildProviderQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProviderTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildProviderQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ProviderTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildProviderQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProviderTableMap::COL_CREATED_AT);
    }

} // ProviderQuery
