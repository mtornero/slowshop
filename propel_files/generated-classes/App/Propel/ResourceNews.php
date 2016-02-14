<?php

namespace App\Propel;

use App\Propel\Map\ResourceTableMap;


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'resource' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class ResourceNews extends Resource
{

    /**
     * Constructs a new ResourceNews class, setting the resource_type column to ResourceTableMap::CLASSKEY_NEWS.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setResourceType(ResourceTableMap::CLASSKEY_NEWS);
    }

} // ResourceNews
