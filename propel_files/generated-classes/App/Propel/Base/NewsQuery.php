<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\News as ChildNews;
use App\Propel\NewsQuery as ChildNewsQuery;
use App\Propel\Map\NewsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'news' table.
 *
 *
 *
 * @method     ChildNewsQuery orderByNewsId($order = Criteria::ASC) Order by the news_id column
 * @method     ChildNewsQuery orderByResourceId($order = Criteria::ASC) Order by the resource_id column
 * @method     ChildNewsQuery orderByNewsHeadline($order = Criteria::ASC) Order by the news_headline column
 * @method     ChildNewsQuery orderByNewsOpening($order = Criteria::ASC) Order by the news_opening column
 * @method     ChildNewsQuery orderByNewsBody($order = Criteria::ASC) Order by the news_body column
 * @method     ChildNewsQuery orderByNewsPic($order = Criteria::ASC) Order by the news_pic column
 * @method     ChildNewsQuery orderByNewsFrom($order = Criteria::ASC) Order by the news_from column
 * @method     ChildNewsQuery orderByNewsTo($order = Criteria::ASC) Order by the news_to column
 * @method     ChildNewsQuery orderByNewsFor($order = Criteria::ASC) Order by the news_for column
 * @method     ChildNewsQuery orderByNewsWeight($order = Criteria::ASC) Order by the news_weight column
 * @method     ChildNewsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildNewsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildNewsQuery groupByNewsId() Group by the news_id column
 * @method     ChildNewsQuery groupByResourceId() Group by the resource_id column
 * @method     ChildNewsQuery groupByNewsHeadline() Group by the news_headline column
 * @method     ChildNewsQuery groupByNewsOpening() Group by the news_opening column
 * @method     ChildNewsQuery groupByNewsBody() Group by the news_body column
 * @method     ChildNewsQuery groupByNewsPic() Group by the news_pic column
 * @method     ChildNewsQuery groupByNewsFrom() Group by the news_from column
 * @method     ChildNewsQuery groupByNewsTo() Group by the news_to column
 * @method     ChildNewsQuery groupByNewsFor() Group by the news_for column
 * @method     ChildNewsQuery groupByNewsWeight() Group by the news_weight column
 * @method     ChildNewsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildNewsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildNewsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNewsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNewsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNewsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNewsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNewsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNewsQuery leftJoinResourceRelatedByResourceId($relationAlias = null) Adds a LEFT JOIN clause to the query using the ResourceRelatedByResourceId relation
 * @method     ChildNewsQuery rightJoinResourceRelatedByResourceId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ResourceRelatedByResourceId relation
 * @method     ChildNewsQuery innerJoinResourceRelatedByResourceId($relationAlias = null) Adds a INNER JOIN clause to the query using the ResourceRelatedByResourceId relation
 *
 * @method     ChildNewsQuery joinWithResourceRelatedByResourceId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ResourceRelatedByResourceId relation
 *
 * @method     ChildNewsQuery leftJoinWithResourceRelatedByResourceId() Adds a LEFT JOIN clause and with to the query using the ResourceRelatedByResourceId relation
 * @method     ChildNewsQuery rightJoinWithResourceRelatedByResourceId() Adds a RIGHT JOIN clause and with to the query using the ResourceRelatedByResourceId relation
 * @method     ChildNewsQuery innerJoinWithResourceRelatedByResourceId() Adds a INNER JOIN clause and with to the query using the ResourceRelatedByResourceId relation
 *
 * @method     ChildNewsQuery leftJoinFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the File relation
 * @method     ChildNewsQuery rightJoinFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the File relation
 * @method     ChildNewsQuery innerJoinFile($relationAlias = null) Adds a INNER JOIN clause to the query using the File relation
 *
 * @method     ChildNewsQuery joinWithFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the File relation
 *
 * @method     ChildNewsQuery leftJoinWithFile() Adds a LEFT JOIN clause and with to the query using the File relation
 * @method     ChildNewsQuery rightJoinWithFile() Adds a RIGHT JOIN clause and with to the query using the File relation
 * @method     ChildNewsQuery innerJoinWithFile() Adds a INNER JOIN clause and with to the query using the File relation
 *
 * @method     ChildNewsQuery leftJoinResourceRelatedByNewsFor($relationAlias = null) Adds a LEFT JOIN clause to the query using the ResourceRelatedByNewsFor relation
 * @method     ChildNewsQuery rightJoinResourceRelatedByNewsFor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ResourceRelatedByNewsFor relation
 * @method     ChildNewsQuery innerJoinResourceRelatedByNewsFor($relationAlias = null) Adds a INNER JOIN clause to the query using the ResourceRelatedByNewsFor relation
 *
 * @method     ChildNewsQuery joinWithResourceRelatedByNewsFor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ResourceRelatedByNewsFor relation
 *
 * @method     ChildNewsQuery leftJoinWithResourceRelatedByNewsFor() Adds a LEFT JOIN clause and with to the query using the ResourceRelatedByNewsFor relation
 * @method     ChildNewsQuery rightJoinWithResourceRelatedByNewsFor() Adds a RIGHT JOIN clause and with to the query using the ResourceRelatedByNewsFor relation
 * @method     ChildNewsQuery innerJoinWithResourceRelatedByNewsFor() Adds a INNER JOIN clause and with to the query using the ResourceRelatedByNewsFor relation
 *
 * @method     \App\Propel\ResourceQuery|\App\Propel\FileQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildNews findOne(ConnectionInterface $con = null) Return the first ChildNews matching the query
 * @method     ChildNews findOneOrCreate(ConnectionInterface $con = null) Return the first ChildNews matching the query, or a new ChildNews object populated from the query conditions when no match is found
 *
 * @method     ChildNews findOneByNewsId(int $news_id) Return the first ChildNews filtered by the news_id column
 * @method     ChildNews findOneByResourceId(int $resource_id) Return the first ChildNews filtered by the resource_id column
 * @method     ChildNews findOneByNewsHeadline(string $news_headline) Return the first ChildNews filtered by the news_headline column
 * @method     ChildNews findOneByNewsOpening(string $news_opening) Return the first ChildNews filtered by the news_opening column
 * @method     ChildNews findOneByNewsBody(string $news_body) Return the first ChildNews filtered by the news_body column
 * @method     ChildNews findOneByNewsPic(int $news_pic) Return the first ChildNews filtered by the news_pic column
 * @method     ChildNews findOneByNewsFrom(string $news_from) Return the first ChildNews filtered by the news_from column
 * @method     ChildNews findOneByNewsTo(string $news_to) Return the first ChildNews filtered by the news_to column
 * @method     ChildNews findOneByNewsFor(int $news_for) Return the first ChildNews filtered by the news_for column
 * @method     ChildNews findOneByNewsWeight(int $news_weight) Return the first ChildNews filtered by the news_weight column
 * @method     ChildNews findOneByCreatedAt(string $created_at) Return the first ChildNews filtered by the created_at column
 * @method     ChildNews findOneByUpdatedAt(string $updated_at) Return the first ChildNews filtered by the updated_at column *

 * @method     ChildNews requirePk($key, ConnectionInterface $con = null) Return the ChildNews by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOne(ConnectionInterface $con = null) Return the first ChildNews matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNews requireOneByNewsId(int $news_id) Return the first ChildNews filtered by the news_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByResourceId(int $resource_id) Return the first ChildNews filtered by the resource_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByNewsHeadline(string $news_headline) Return the first ChildNews filtered by the news_headline column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByNewsOpening(string $news_opening) Return the first ChildNews filtered by the news_opening column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByNewsBody(string $news_body) Return the first ChildNews filtered by the news_body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByNewsPic(int $news_pic) Return the first ChildNews filtered by the news_pic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByNewsFrom(string $news_from) Return the first ChildNews filtered by the news_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByNewsTo(string $news_to) Return the first ChildNews filtered by the news_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByNewsFor(int $news_for) Return the first ChildNews filtered by the news_for column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByNewsWeight(int $news_weight) Return the first ChildNews filtered by the news_weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByCreatedAt(string $created_at) Return the first ChildNews filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNews requireOneByUpdatedAt(string $updated_at) Return the first ChildNews filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNews[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildNews objects based on current ModelCriteria
 * @method     ChildNews[]|ObjectCollection findByNewsId(int $news_id) Return ChildNews objects filtered by the news_id column
 * @method     ChildNews[]|ObjectCollection findByResourceId(int $resource_id) Return ChildNews objects filtered by the resource_id column
 * @method     ChildNews[]|ObjectCollection findByNewsHeadline(string $news_headline) Return ChildNews objects filtered by the news_headline column
 * @method     ChildNews[]|ObjectCollection findByNewsOpening(string $news_opening) Return ChildNews objects filtered by the news_opening column
 * @method     ChildNews[]|ObjectCollection findByNewsBody(string $news_body) Return ChildNews objects filtered by the news_body column
 * @method     ChildNews[]|ObjectCollection findByNewsPic(int $news_pic) Return ChildNews objects filtered by the news_pic column
 * @method     ChildNews[]|ObjectCollection findByNewsFrom(string $news_from) Return ChildNews objects filtered by the news_from column
 * @method     ChildNews[]|ObjectCollection findByNewsTo(string $news_to) Return ChildNews objects filtered by the news_to column
 * @method     ChildNews[]|ObjectCollection findByNewsFor(int $news_for) Return ChildNews objects filtered by the news_for column
 * @method     ChildNews[]|ObjectCollection findByNewsWeight(int $news_weight) Return ChildNews objects filtered by the news_weight column
 * @method     ChildNews[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildNews objects filtered by the created_at column
 * @method     ChildNews[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildNews objects filtered by the updated_at column
 * @method     ChildNews[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class NewsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\NewsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\News', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNewsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNewsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildNewsQuery) {
            return $criteria;
        }
        $query = new ChildNewsQuery();
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
     * @return ChildNews|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NewsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NewsTableMap::DATABASE_NAME);
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
     * @return ChildNews A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT news_id, resource_id, news_headline, news_opening, news_body, news_pic, news_from, news_to, news_for, news_weight, created_at, updated_at FROM news WHERE news_id = :p0';
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
            /** @var ChildNews $obj */
            $obj = new ChildNews();
            $obj->hydrate($row);
            NewsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildNews|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the news_id column
     *
     * Example usage:
     * <code>
     * $query->filterByNewsId(1234); // WHERE news_id = 1234
     * $query->filterByNewsId(array(12, 34)); // WHERE news_id IN (12, 34)
     * $query->filterByNewsId(array('min' => 12)); // WHERE news_id > 12
     * </code>
     *
     * @param     mixed $newsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByNewsId($newsId = null, $comparison = null)
    {
        if (is_array($newsId)) {
            $useMinMax = false;
            if (isset($newsId['min'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_ID, $newsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newsId['max'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_ID, $newsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_ID, $newsId, $comparison);
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
     * @see       filterByResourceRelatedByResourceId()
     *
     * @param     mixed $resourceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByResourceId($resourceId = null, $comparison = null)
    {
        if (is_array($resourceId)) {
            $useMinMax = false;
            if (isset($resourceId['min'])) {
                $this->addUsingAlias(NewsTableMap::COL_RESOURCE_ID, $resourceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resourceId['max'])) {
                $this->addUsingAlias(NewsTableMap::COL_RESOURCE_ID, $resourceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_RESOURCE_ID, $resourceId, $comparison);
    }

    /**
     * Filter the query on the news_headline column
     *
     * Example usage:
     * <code>
     * $query->filterByNewsHeadline('fooValue');   // WHERE news_headline = 'fooValue'
     * $query->filterByNewsHeadline('%fooValue%'); // WHERE news_headline LIKE '%fooValue%'
     * </code>
     *
     * @param     string $newsHeadline The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByNewsHeadline($newsHeadline = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newsHeadline)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $newsHeadline)) {
                $newsHeadline = str_replace('*', '%', $newsHeadline);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_HEADLINE, $newsHeadline, $comparison);
    }

    /**
     * Filter the query on the news_opening column
     *
     * Example usage:
     * <code>
     * $query->filterByNewsOpening('fooValue');   // WHERE news_opening = 'fooValue'
     * $query->filterByNewsOpening('%fooValue%'); // WHERE news_opening LIKE '%fooValue%'
     * </code>
     *
     * @param     string $newsOpening The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByNewsOpening($newsOpening = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newsOpening)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $newsOpening)) {
                $newsOpening = str_replace('*', '%', $newsOpening);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_OPENING, $newsOpening, $comparison);
    }

    /**
     * Filter the query on the news_body column
     *
     * Example usage:
     * <code>
     * $query->filterByNewsBody('fooValue');   // WHERE news_body = 'fooValue'
     * $query->filterByNewsBody('%fooValue%'); // WHERE news_body LIKE '%fooValue%'
     * </code>
     *
     * @param     string $newsBody The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByNewsBody($newsBody = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($newsBody)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $newsBody)) {
                $newsBody = str_replace('*', '%', $newsBody);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_BODY, $newsBody, $comparison);
    }

    /**
     * Filter the query on the news_pic column
     *
     * Example usage:
     * <code>
     * $query->filterByNewsPic(1234); // WHERE news_pic = 1234
     * $query->filterByNewsPic(array(12, 34)); // WHERE news_pic IN (12, 34)
     * $query->filterByNewsPic(array('min' => 12)); // WHERE news_pic > 12
     * </code>
     *
     * @see       filterByFile()
     *
     * @param     mixed $newsPic The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByNewsPic($newsPic = null, $comparison = null)
    {
        if (is_array($newsPic)) {
            $useMinMax = false;
            if (isset($newsPic['min'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_PIC, $newsPic['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newsPic['max'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_PIC, $newsPic['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_PIC, $newsPic, $comparison);
    }

    /**
     * Filter the query on the news_from column
     *
     * Example usage:
     * <code>
     * $query->filterByNewsFrom('2011-03-14'); // WHERE news_from = '2011-03-14'
     * $query->filterByNewsFrom('now'); // WHERE news_from = '2011-03-14'
     * $query->filterByNewsFrom(array('max' => 'yesterday')); // WHERE news_from > '2011-03-13'
     * </code>
     *
     * @param     mixed $newsFrom The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByNewsFrom($newsFrom = null, $comparison = null)
    {
        if (is_array($newsFrom)) {
            $useMinMax = false;
            if (isset($newsFrom['min'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_FROM, $newsFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newsFrom['max'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_FROM, $newsFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_FROM, $newsFrom, $comparison);
    }

    /**
     * Filter the query on the news_to column
     *
     * Example usage:
     * <code>
     * $query->filterByNewsTo('2011-03-14'); // WHERE news_to = '2011-03-14'
     * $query->filterByNewsTo('now'); // WHERE news_to = '2011-03-14'
     * $query->filterByNewsTo(array('max' => 'yesterday')); // WHERE news_to > '2011-03-13'
     * </code>
     *
     * @param     mixed $newsTo The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByNewsTo($newsTo = null, $comparison = null)
    {
        if (is_array($newsTo)) {
            $useMinMax = false;
            if (isset($newsTo['min'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_TO, $newsTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newsTo['max'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_TO, $newsTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_TO, $newsTo, $comparison);
    }

    /**
     * Filter the query on the news_for column
     *
     * Example usage:
     * <code>
     * $query->filterByNewsFor(1234); // WHERE news_for = 1234
     * $query->filterByNewsFor(array(12, 34)); // WHERE news_for IN (12, 34)
     * $query->filterByNewsFor(array('min' => 12)); // WHERE news_for > 12
     * </code>
     *
     * @see       filterByResourceRelatedByNewsFor()
     *
     * @param     mixed $newsFor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByNewsFor($newsFor = null, $comparison = null)
    {
        if (is_array($newsFor)) {
            $useMinMax = false;
            if (isset($newsFor['min'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_FOR, $newsFor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newsFor['max'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_FOR, $newsFor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_FOR, $newsFor, $comparison);
    }

    /**
     * Filter the query on the news_weight column
     *
     * Example usage:
     * <code>
     * $query->filterByNewsWeight(1234); // WHERE news_weight = 1234
     * $query->filterByNewsWeight(array(12, 34)); // WHERE news_weight IN (12, 34)
     * $query->filterByNewsWeight(array('min' => 12)); // WHERE news_weight > 12
     * </code>
     *
     * @param     mixed $newsWeight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByNewsWeight($newsWeight = null, $comparison = null)
    {
        if (is_array($newsWeight)) {
            $useMinMax = false;
            if (isset($newsWeight['min'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_WEIGHT, $newsWeight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newsWeight['max'])) {
                $this->addUsingAlias(NewsTableMap::COL_NEWS_WEIGHT, $newsWeight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_NEWS_WEIGHT, $newsWeight, $comparison);
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
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(NewsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(NewsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(NewsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(NewsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NewsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Resource object
     *
     * @param \App\Propel\Resource|ObjectCollection $resource The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNewsQuery The current query, for fluid interface
     */
    public function filterByResourceRelatedByResourceId($resource, $comparison = null)
    {
        if ($resource instanceof \App\Propel\Resource) {
            return $this
                ->addUsingAlias(NewsTableMap::COL_RESOURCE_ID, $resource->getResourceId(), $comparison);
        } elseif ($resource instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NewsTableMap::COL_RESOURCE_ID, $resource->toKeyValue('PrimaryKey', 'ResourceId'), $comparison);
        } else {
            throw new PropelException('filterByResourceRelatedByResourceId() only accepts arguments of type \App\Propel\Resource or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ResourceRelatedByResourceId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function joinResourceRelatedByResourceId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ResourceRelatedByResourceId');

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
            $this->addJoinObject($join, 'ResourceRelatedByResourceId');
        }

        return $this;
    }

    /**
     * Use the ResourceRelatedByResourceId relation Resource object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ResourceQuery A secondary query class using the current class as primary query
     */
    public function useResourceRelatedByResourceIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinResourceRelatedByResourceId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ResourceRelatedByResourceId', '\App\Propel\ResourceQuery');
    }

    /**
     * Filter the query by a related \App\Propel\File object
     *
     * @param \App\Propel\File|ObjectCollection $file The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNewsQuery The current query, for fluid interface
     */
    public function filterByFile($file, $comparison = null)
    {
        if ($file instanceof \App\Propel\File) {
            return $this
                ->addUsingAlias(NewsTableMap::COL_NEWS_PIC, $file->getFileId(), $comparison);
        } elseif ($file instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NewsTableMap::COL_NEWS_PIC, $file->toKeyValue('PrimaryKey', 'FileId'), $comparison);
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
     * @return $this|ChildNewsQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\Resource object
     *
     * @param \App\Propel\Resource|ObjectCollection $resource The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNewsQuery The current query, for fluid interface
     */
    public function filterByResourceRelatedByNewsFor($resource, $comparison = null)
    {
        if ($resource instanceof \App\Propel\Resource) {
            return $this
                ->addUsingAlias(NewsTableMap::COL_NEWS_FOR, $resource->getResourceId(), $comparison);
        } elseif ($resource instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NewsTableMap::COL_NEWS_FOR, $resource->toKeyValue('PrimaryKey', 'ResourceId'), $comparison);
        } else {
            throw new PropelException('filterByResourceRelatedByNewsFor() only accepts arguments of type \App\Propel\Resource or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ResourceRelatedByNewsFor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function joinResourceRelatedByNewsFor($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ResourceRelatedByNewsFor');

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
            $this->addJoinObject($join, 'ResourceRelatedByNewsFor');
        }

        return $this;
    }

    /**
     * Use the ResourceRelatedByNewsFor relation Resource object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\ResourceQuery A secondary query class using the current class as primary query
     */
    public function useResourceRelatedByNewsForQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinResourceRelatedByNewsFor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ResourceRelatedByNewsFor', '\App\Propel\ResourceQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildNews $news Object to remove from the list of results
     *
     * @return $this|ChildNewsQuery The current query, for fluid interface
     */
    public function prune($news = null)
    {
        if ($news) {
            $this->addUsingAlias(NewsTableMap::COL_NEWS_ID, $news->getNewsId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the news table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NewsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NewsTableMap::clearInstancePool();
            NewsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NewsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NewsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NewsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NewsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildNewsQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(NewsTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildNewsQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(NewsTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildNewsQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(NewsTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildNewsQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(NewsTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildNewsQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(NewsTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildNewsQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(NewsTableMap::COL_CREATED_AT);
    }

} // NewsQuery
