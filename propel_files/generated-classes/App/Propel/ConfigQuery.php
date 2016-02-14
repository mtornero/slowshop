<?php

namespace App\Propel;

use App\Propel\Base\ConfigQuery as BaseConfigQuery;
use App\Parsers\CamelCase;

/**
 * Skeleton subclass for performing query and update operations on the 'config' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class ConfigQuery extends BaseConfigQuery
{
    
    use CamelCase;
    
    public function __callStatic($name, $arguments)
    {
        $name = preg_replace("/^get/", "", $name);
        $key = self::from_camel_case($name);
        
        $config = self::create()->filterByConfigKey($key)->findOne();
        
        if (empty($config)) {
            return FALSE;
        }
        return $config->output();
    }
    

}
