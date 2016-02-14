<?php

namespace App\Propel;

use App\Propel\Base\RoleQuery as BaseRoleQuery;
use App\Parsers\CamelCase;

/**
 * Skeleton subclass for performing query and update operations on the 'role' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class RoleQuery extends BaseRoleQuery
{
    
    use CamelCase;
    
    public function __callStatic($name, $arguments)
    {
        $name = preg_replace("/^get/", "", $name);
        $key = self::from_camel_case($name);
        
        $role = self::create()->filterByRoleCode($key)->findOne();
        
        if (empty($role)) {
            return FALSE;
        }
        return $role->getRoleId();
    }
}
