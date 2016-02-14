<?php

namespace App\Propel\Base;

use App\Propel\Map\ResourceTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Connection\ConnectionInterface;

/**
 * Skeleton subclass for representing a query for one of the subclasses of the 'resource' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class ResourceNewsQuery extends ResourceQuery
{

    /**
     * Returns a new \App\Propel\ResourceNewsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return \App\Propel\ResourceNewsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof \App\Propel\ResourceNewsQuery) {
            return $criteria;
        }
        $query = new \App\Propel\ResourceNewsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Filters the query to target only ResourceNews objects.
     */
    public function preSelect(ConnectionInterface $con)
    {
        $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_TYPE, ResourceTableMap::CLASSKEY_NEWS);
    }

    /**
     * Filters the query to target only ResourceNews objects.
     */
    public function preUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false)
    {
        $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_TYPE, ResourceTableMap::CLASSKEY_NEWS);
    }

    /**
     * Filters the query to target only ResourceNews objects.
     */
    public function preDelete(ConnectionInterface $con)
    {
        $this->addUsingAlias(ResourceTableMap::COL_RESOURCE_TYPE, ResourceTableMap::CLASSKEY_NEWS);
    }

    /**
     * Issue a DELETE query based on the current ModelCriteria deleting all rows in the table
     * Having the ResourceNews class.
     * This method is called by ModelCriteria::deleteAll() inside a transaction
     *
     * @param ConnectionInterface $con a connection object
     *
     * @return integer the number of deleted rows
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        // condition on class key is already added in preDelete()
        return parent::delete($con);
    }

} // ResourceNewsQuery
