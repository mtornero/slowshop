<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\ResourceFile as ChildResourceFile;
use App\Propel\ResourceFileQuery as ChildResourceFileQuery;
use App\Propel\Map\ResourceFileTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'resource_file' table.
 *
 *
 *
 * @method     ChildResourceFileQuery orderByResourceFileId($order = Criteria::ASC) Order by the resource_file_id column
 * @method     ChildResourceFileQuery orderByResourceId($order = Criteria::ASC) Order by the resource_id column
 * @method     ChildResourceFileQuery orderByFileId($order = Criteria::ASC) Order by the file_id column
 * @method     ChildResourceFileQuery orderByResourceFileIsPublic($order = Criteria::ASC) Order by the resource_file_is_public column
 *
 * @method     ChildResourceFileQuery groupByResourceFileId() Group by the resource_file_id column
 * @method     ChildResourceFileQuery groupByResourceId() Group by the resource_id column
 * @method     ChildResourceFileQuery groupByFileId() Group by the file_id column
 * @method     ChildResourceFileQuery groupByResourceFileIsPublic() Group by the resource_file_is_public column
 *
 * @method     ChildResourceFileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildResourceFileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildResourceFileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildResourceFileQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildResourceFileQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildResourceFileQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildResourceFileQuery leftJoinResource($relationAlias = null) Adds a LEFT JOIN clause to the query using the Resource relation
 * @method     ChildResourceFileQuery rightJoinResource($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Resource relation
 * @method     ChildResourceFileQuery innerJoinResource($relationAlias = null) Adds a INNER JOIN clause to the query using the Resource relation
 *
 * @method     ChildResourceFileQuery joinWithResource($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Resource relation
 *
 * @method     ChildResourceFileQuery leftJoinWithResource() Adds a LEFT JOIN clause and with to the query using the Resource relation
 * @method     ChildResourceFileQuery rightJoinWithResource() Adds a RIGHT JOIN clause and with to the query using the Resource relation
 * @method     ChildResourceFileQuery innerJoinWithResource() Adds a INNER JOIN clause and with to the query using the Resource relation
 *
 * @method     ChildResourceFileQuery leftJoinFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the File relation
 * @method     ChildResourceFileQuery rightJoinFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the File relation
 * @method     ChildResourceFileQuery innerJoinFile($relationAlias = null) Adds a INNER JOIN clause to the query using the File relation
 *
 * @method     ChildResourceFileQuery joinWithFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the File relation
 *
 * @method     ChildResourceFileQuery leftJoinWithFile() Adds a LEFT JOIN clause and with to the query using the File relation
 * @method     ChildResourceFileQuery rightJoinWithFile() Adds a RIGHT JOIN clause and with to the query using the File relation
 * @method     ChildResourceFileQuery innerJoinWithFile() Adds a INNER JOIN clause and with to the query using the File relation
 *
 * @method     \App\Propel\ResourceQuery|\App\Propel\FileQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildResourceFile findOne(ConnectionInterface $con = null) Return the first ChildResourceFile matching the query
 * @method     ChildResourceFile findOneOrCreate(ConnectionInterface $con = null) Return the first ChildResourceFile matching the query, or a new ChildResourceFile object populated from the query conditions when no match is found
 *
 * @method     ChildResourceFile findOneByResourceFileId(int $resource_file_id) Return the first ChildResourceFile filtered by the resource_file_id column
 * @method     ChildResourceFile findOneByResourceId(int $resource_id) Return the first ChildResourceFile filtered by the resource_id column
 * @method     ChildResourceFile findOneByFileId(int $file_id) Return the first ChildResourceFile filtered by the file_id column
 * @method     ChildResourceFile findOneByResourceFileIsPublic(boolean $resource_file_is_public) Return the first ChildResourceFile filtered by the resource_file_is_public column *

 * @method     ChildResourceFile requirePk($key, ConnectionInterface $con = null) Return the ChildResourceFile by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResourceFile requireOne(ConnectionInterface $con = null) Return the first ChildResourceFile matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildResourceFile requireOneByResourceFileId(int $resource_file_id) Return the first ChildResourceFile filtered by the resource_file_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResourceFile requireOneByResourceId(int $resource_id) Return the first ChildResourceFile filtered by the resource_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResourceFile requireOneByFileId(int $file_id) Return the first ChildResourceFile filtered by the file_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildResourceFile requireOneByResourceFileIsPublic(boolean $resource_file_is_public) Return the first ChildResourceFile filtered by the resource_file_is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildResourceFile[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildResourceFile objects based on current ModelCriteria
 * @method     ChildResourceFile[]|ObjectCollection findByResourceFileId(int $resource_file_id) Return ChildResourceFile objects filtered by the resource_file_id column
 * @method     ChildResourceFile[]|ObjectCollection findByResourceId(int $resource_id) Return ChildResourceFile objects filtered by the resource_id column
 * @method     ChildResourceFile[]|ObjectCollection findByFileId(int $file_id) Return ChildResourceFile objects filtered by the file_id column
 * @method     ChildResourceFile[]|ObjectCollection findByResourceFileIsPublic(boolean $resource_file_is_public) Return ChildResourceFile objects filtered by the resource_file_is_public column
 * @method     ChildResourceFile[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ResourceFileQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\ResourceFileQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\ResourceFile', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildResourceFileQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildResourceFileQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildResourceFileQuery) {
            return $criteria;
        }
        $query = new ChildResourceFileQuery();
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
     * @return ChildResourceFile|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ResourceFileTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ResourceFileTableMap::DATABASE_NAME);
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
     * @return ChildResourceFile A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT resource_file_id, resource_id, file_id, resource_file_is_public FROM resource_file WHERE resource_file_id = :p0';
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
            /** @var ChildResourceFile $obj */
            $obj = new ChildResourceFile();
            $obj->hydrate($row);
            ResourceFileTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildResourceFile|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildResourceFileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_FILE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildResourceFileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_FILE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the resource_file_id column
     *
     * Example usage:
     * <code>
     * $query->filterByResourceFileId(1234); // WHERE resource_file_id = 1234
     * $query->filterByResourceFileId(array(12, 34)); // WHERE resource_file_id IN (12, 34)
     * $query->filterByResourceFileId(array('min' => 12)); // WHERE resource_file_id > 12
     * </code>
     *
     * @param     mixed $resourceFileId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceFileQuery The current query, for fluid interface
     */
    public function filterByResourceFileId($resourceFileId = null, $comparison = null)
    {
        if (is_array($resourceFileId)) {
            $useMinMax = false;
            if (isset($resourceFileId['min'])) {
                $this->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_FILE_ID, $resourceFileId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resourceFileId['max'])) {
                $this->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_FILE_ID, $resourceFileId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_FILE_ID, $resourceFileId, $comparison);
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
     * @return $this|ChildResourceFileQuery The current query, for fluid interface
     */
    public function filterByResourceId($resourceId = null, $comparison = null)
    {
        if (is_array($resourceId)) {
            $useMinMax = false;
            if (isset($resourceId['min'])) {
                $this->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_ID, $resourceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resourceId['max'])) {
                $this->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_ID, $resourceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_ID, $resourceId, $comparison);
    }

    /**
     * Filter the query on the file_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFileId(1234); // WHERE file_id = 1234
     * $query->filterByFileId(array(12, 34)); // WHERE file_id IN (12, 34)
     * $query->filterByFileId(array('min' => 12)); // WHERE file_id > 12
     * </code>
     *
     * @see       filterByFile()
     *
     * @param     mixed $fileId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceFileQuery The current query, for fluid interface
     */
    public function filterByFileId($fileId = null, $comparison = null)
    {
        if (is_array($fileId)) {
            $useMinMax = false;
            if (isset($fileId['min'])) {
                $this->addUsingAlias(ResourceFileTableMap::COL_FILE_ID, $fileId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fileId['max'])) {
                $this->addUsingAlias(ResourceFileTableMap::COL_FILE_ID, $fileId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResourceFileTableMap::COL_FILE_ID, $fileId, $comparison);
    }

    /**
     * Filter the query on the resource_file_is_public column
     *
     * Example usage:
     * <code>
     * $query->filterByResourceFileIsPublic(true); // WHERE resource_file_is_public = true
     * $query->filterByResourceFileIsPublic('yes'); // WHERE resource_file_is_public = true
     * </code>
     *
     * @param     boolean|string $resourceFileIsPublic The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildResourceFileQuery The current query, for fluid interface
     */
    public function filterByResourceFileIsPublic($resourceFileIsPublic = null, $comparison = null)
    {
        if (is_string($resourceFileIsPublic)) {
            $resourceFileIsPublic = in_array(strtolower($resourceFileIsPublic), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_FILE_IS_PUBLIC, $resourceFileIsPublic, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\Resource object
     *
     * @param \App\Propel\Resource|ObjectCollection $resource The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildResourceFileQuery The current query, for fluid interface
     */
    public function filterByResource($resource, $comparison = null)
    {
        if ($resource instanceof \App\Propel\Resource) {
            return $this
                ->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_ID, $resource->getResourceId(), $comparison);
        } elseif ($resource instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_ID, $resource->toKeyValue('PrimaryKey', 'ResourceId'), $comparison);
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
     * @return $this|ChildResourceFileQuery The current query, for fluid interface
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
     * @return ChildResourceFileQuery The current query, for fluid interface
     */
    public function filterByFile($file, $comparison = null)
    {
        if ($file instanceof \App\Propel\File) {
            return $this
                ->addUsingAlias(ResourceFileTableMap::COL_FILE_ID, $file->getFileId(), $comparison);
        } elseif ($file instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ResourceFileTableMap::COL_FILE_ID, $file->toKeyValue('PrimaryKey', 'FileId'), $comparison);
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
     * @return $this|ChildResourceFileQuery The current query, for fluid interface
     */
    public function joinFile($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'File', '\App\Propel\FileQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildResourceFile $resourceFile Object to remove from the list of results
     *
     * @return $this|ChildResourceFileQuery The current query, for fluid interface
     */
    public function prune($resourceFile = null)
    {
        if ($resourceFile) {
            $this->addUsingAlias(ResourceFileTableMap::COL_RESOURCE_FILE_ID, $resourceFile->getResourceFileId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the resource_file table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceFileTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ResourceFileTableMap::clearInstancePool();
            ResourceFileTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ResourceFileTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ResourceFileTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ResourceFileTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ResourceFileTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ResourceFileQuery
