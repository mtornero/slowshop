<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\FileType as ChildFileType;
use App\Propel\FileTypeI18nQuery as ChildFileTypeI18nQuery;
use App\Propel\FileTypeQuery as ChildFileTypeQuery;
use App\Propel\Map\FileTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'file_type' table.
 *
 *
 *
 * @method     ChildFileTypeQuery orderByFileTypeId($order = Criteria::ASC) Order by the file_type_id column
 * @method     ChildFileTypeQuery orderByFileTypeCode($order = Criteria::ASC) Order by the file_type_code column
 *
 * @method     ChildFileTypeQuery groupByFileTypeId() Group by the file_type_id column
 * @method     ChildFileTypeQuery groupByFileTypeCode() Group by the file_type_code column
 *
 * @method     ChildFileTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFileTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFileTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFileTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFileTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFileTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFileTypeQuery leftJoinFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the File relation
 * @method     ChildFileTypeQuery rightJoinFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the File relation
 * @method     ChildFileTypeQuery innerJoinFile($relationAlias = null) Adds a INNER JOIN clause to the query using the File relation
 *
 * @method     ChildFileTypeQuery joinWithFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the File relation
 *
 * @method     ChildFileTypeQuery leftJoinWithFile() Adds a LEFT JOIN clause and with to the query using the File relation
 * @method     ChildFileTypeQuery rightJoinWithFile() Adds a RIGHT JOIN clause and with to the query using the File relation
 * @method     ChildFileTypeQuery innerJoinWithFile() Adds a INNER JOIN clause and with to the query using the File relation
 *
 * @method     ChildFileTypeQuery leftJoinFileTypeI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the FileTypeI18n relation
 * @method     ChildFileTypeQuery rightJoinFileTypeI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FileTypeI18n relation
 * @method     ChildFileTypeQuery innerJoinFileTypeI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the FileTypeI18n relation
 *
 * @method     ChildFileTypeQuery joinWithFileTypeI18n($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FileTypeI18n relation
 *
 * @method     ChildFileTypeQuery leftJoinWithFileTypeI18n() Adds a LEFT JOIN clause and with to the query using the FileTypeI18n relation
 * @method     ChildFileTypeQuery rightJoinWithFileTypeI18n() Adds a RIGHT JOIN clause and with to the query using the FileTypeI18n relation
 * @method     ChildFileTypeQuery innerJoinWithFileTypeI18n() Adds a INNER JOIN clause and with to the query using the FileTypeI18n relation
 *
 * @method     \App\Propel\FileQuery|\App\Propel\FileTypeI18nQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFileType findOne(ConnectionInterface $con = null) Return the first ChildFileType matching the query
 * @method     ChildFileType findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFileType matching the query, or a new ChildFileType object populated from the query conditions when no match is found
 *
 * @method     ChildFileType findOneByFileTypeId(int $file_type_id) Return the first ChildFileType filtered by the file_type_id column
 * @method     ChildFileType findOneByFileTypeCode(string $file_type_code) Return the first ChildFileType filtered by the file_type_code column *

 * @method     ChildFileType requirePk($key, ConnectionInterface $con = null) Return the ChildFileType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFileType requireOne(ConnectionInterface $con = null) Return the first ChildFileType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFileType requireOneByFileTypeId(int $file_type_id) Return the first ChildFileType filtered by the file_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFileType requireOneByFileTypeCode(string $file_type_code) Return the first ChildFileType filtered by the file_type_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFileType[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFileType objects based on current ModelCriteria
 * @method     ChildFileType[]|ObjectCollection findByFileTypeId(int $file_type_id) Return ChildFileType objects filtered by the file_type_id column
 * @method     ChildFileType[]|ObjectCollection findByFileTypeCode(string $file_type_code) Return ChildFileType objects filtered by the file_type_code column
 * @method     ChildFileType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FileTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\FileTypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\FileType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFileTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFileTypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFileTypeQuery) {
            return $criteria;
        }
        $query = new ChildFileTypeQuery();
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
     * @return ChildFileType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FileTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FileTypeTableMap::DATABASE_NAME);
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
     * @return ChildFileType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT file_type_id, file_type_code FROM file_type WHERE file_type_id = :p0';
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
            /** @var ChildFileType $obj */
            $obj = new ChildFileType();
            $obj->hydrate($row);
            FileTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFileType|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFileTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FileTypeTableMap::COL_FILE_TYPE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFileTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FileTypeTableMap::COL_FILE_TYPE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the file_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFileTypeId(1234); // WHERE file_type_id = 1234
     * $query->filterByFileTypeId(array(12, 34)); // WHERE file_type_id IN (12, 34)
     * $query->filterByFileTypeId(array('min' => 12)); // WHERE file_type_id > 12
     * </code>
     *
     * @param     mixed $fileTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileTypeQuery The current query, for fluid interface
     */
    public function filterByFileTypeId($fileTypeId = null, $comparison = null)
    {
        if (is_array($fileTypeId)) {
            $useMinMax = false;
            if (isset($fileTypeId['min'])) {
                $this->addUsingAlias(FileTypeTableMap::COL_FILE_TYPE_ID, $fileTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fileTypeId['max'])) {
                $this->addUsingAlias(FileTypeTableMap::COL_FILE_TYPE_ID, $fileTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTypeTableMap::COL_FILE_TYPE_ID, $fileTypeId, $comparison);
    }

    /**
     * Filter the query on the file_type_code column
     *
     * Example usage:
     * <code>
     * $query->filterByFileTypeCode('fooValue');   // WHERE file_type_code = 'fooValue'
     * $query->filterByFileTypeCode('%fooValue%'); // WHERE file_type_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fileTypeCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileTypeQuery The current query, for fluid interface
     */
    public function filterByFileTypeCode($fileTypeCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fileTypeCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fileTypeCode)) {
                $fileTypeCode = str_replace('*', '%', $fileTypeCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FileTypeTableMap::COL_FILE_TYPE_CODE, $fileTypeCode, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\File object
     *
     * @param \App\Propel\File|ObjectCollection $file the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFileTypeQuery The current query, for fluid interface
     */
    public function filterByFile($file, $comparison = null)
    {
        if ($file instanceof \App\Propel\File) {
            return $this
                ->addUsingAlias(FileTypeTableMap::COL_FILE_TYPE_ID, $file->getFileTypeId(), $comparison);
        } elseif ($file instanceof ObjectCollection) {
            return $this
                ->useFileQuery()
                ->filterByPrimaryKeys($file->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildFileTypeQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\FileTypeI18n object
     *
     * @param \App\Propel\FileTypeI18n|ObjectCollection $fileTypeI18n the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFileTypeQuery The current query, for fluid interface
     */
    public function filterByFileTypeI18n($fileTypeI18n, $comparison = null)
    {
        if ($fileTypeI18n instanceof \App\Propel\FileTypeI18n) {
            return $this
                ->addUsingAlias(FileTypeTableMap::COL_FILE_TYPE_ID, $fileTypeI18n->getFileTypeId(), $comparison);
        } elseif ($fileTypeI18n instanceof ObjectCollection) {
            return $this
                ->useFileTypeI18nQuery()
                ->filterByPrimaryKeys($fileTypeI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFileTypeI18n() only accepts arguments of type \App\Propel\FileTypeI18n or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FileTypeI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFileTypeQuery The current query, for fluid interface
     */
    public function joinFileTypeI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FileTypeI18n');

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
            $this->addJoinObject($join, 'FileTypeI18n');
        }

        return $this;
    }

    /**
     * Use the FileTypeI18n relation FileTypeI18n object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\FileTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function useFileTypeI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinFileTypeI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FileTypeI18n', '\App\Propel\FileTypeI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFileType $fileType Object to remove from the list of results
     *
     * @return $this|ChildFileTypeQuery The current query, for fluid interface
     */
    public function prune($fileType = null)
    {
        if ($fileType) {
            $this->addUsingAlias(FileTypeTableMap::COL_FILE_TYPE_ID, $fileType->getFileTypeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the file_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FileTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FileTypeTableMap::clearInstancePool();
            FileTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FileTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FileTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FileTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FileTypeTableMap::clearRelatedInstancePool();

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
     * @return    ChildFileTypeQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'FileTypeI18n';

        return $this
            ->joinFileTypeI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    $this|ChildFileTypeQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'en_US', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('FileTypeI18n');
        $this->with['FileTypeI18n']->setIsWithOneToMany(false);

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
     * @return    ChildFileTypeI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'en_US', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FileTypeI18n', '\App\Propel\FileTypeI18nQuery');
    }

} // FileTypeQuery
