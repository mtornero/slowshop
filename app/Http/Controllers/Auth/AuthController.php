<?php

namespace App\Http\Controllers\Auth;

use App\Propel\User;
use App\Propel\Map\UserTableMap;
use App\Propel\ConfigQuery;
use App\Propel\RoleQuery;
use Propel\Runtime\Map\TableMap;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    const DEFAULT_LOGIN_FIELD = "user_email";
    
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $user_name_is_required = "";
        $user_login_is_required = "";
        $user_email_is_required = "";
        
        $login_field = $this->loginUsername();
        ${$login_field."_is_required"} = 'required|';
        
        return Validator::make($data, [
            'user_name' => $user_name_is_required.'max:60',
            'user_login' => $user_login_is_required.'max:60',
            'user_email' => $user_email_is_required.'email|max:255|unique:user',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $keys = UserTableMap::getFieldNames(TableMap::TYPE_FIELDNAME);
        $register_data = array();
        foreach ($data as $key => $value) {
            if (in_array($key, $keys)) {
                $register_data[$key] = $value;
            }
        }
        $register_data["user_pass"] = bcrypt($data['password']);
        
        $register_data["role_id"] = RoleQuery::getClient();
        $register_data["user_is_validated"] = ConfigQuery::getRegisterMustBeValidated();
        
        $user = new User;
        $user->fromArray($register_data, TableMap::TYPE_FIELDNAME);
        $user->save();
        return $user;
    }
    
    public function loginUsername()
    {
        $login_field = ConfigQuery::getLoginField();
        if ($login_field) {
            return $login_field;
        }
        return $this::DEFAULT_LOGIN_FIELD;
    }
    
    public function registerRequiredFields()
    {
        $register_required_fields =  ConfigQuery::getRegisterRequiredFields();
        if ($register_required_fields) {
            return $register_required_fields;
        }
        return array();
        
    }
    
    public function getLogin()
    {
        $view = property_exists($this, 'loginView')
                    ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }

        return view('auth.login');
    }
    
        /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        return view('auth.register', [
                    "login_field" => $this->loginUsername(),
                    "register_required_fields" => $this->registerRequiredFields(),
                    ]);
    }
    
    
}
