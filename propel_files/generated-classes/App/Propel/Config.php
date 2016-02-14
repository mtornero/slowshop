<?php

namespace App\Propel;

use App\Propel\Base\Config as BaseConfig;

/**
 * Skeleton subclass for representing a row from the 'config' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Config extends BaseConfig
{
    public function output()
    {
        $output = FALSE;
        switch ($this->config_format) {
            case 'boolean':
                $output = (bool)$this->config_value;
                break;
            
            case 'array':
                $output = json_decode($this->config_value);
                break;
            
            case 'string':
            default:
                $output = (string)$this->config_value;
                break;
        }
        
        return $output;
    }
}
