<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Propel\ConfigQuery;

class User extends Authenticatable
{
    
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function getAuthPassword()
    {
        return $this->user_pass;
    }
    
    public function getShownUsername()
    {
       $shown_user_name = "";
       
       $required_fields = ConfigQuery::getRegisterRequiredFields();
       if (!empty($required_fields)) {
           if (in_array("user_name", $required_fields)) {
               $shown_user_name = "user_name";
           } elseif (in_array("user_login", $required_fields)) {
               $shown_user_name = "user_name";
           } elseif (in_array("user_email", $required_fields)) {
               $shown_user_name = "user_email";
           }
       }
       
       if (empty($shown_user_name)) {
           $shown_user_name = ConfigQuery::getLoginField();
       }
       return $this->$shown_user_name;
    }
    
    public function getEmailForPasswordReset()
    {
        return $this->user_email;
    }
}
