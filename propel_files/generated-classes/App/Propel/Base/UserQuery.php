<?php

namespace App\Propel\Base;

use \Exception;
use \PDO;
use App\Propel\User as ChildUser;
use App\Propel\UserQuery as ChildUserQuery;
use App\Propel\Map\UserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user' table.
 *
 *
 *
 * @method     ChildUserQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserQuery orderByResourceId($order = Criteria::ASC) Order by the resource_id column
 * @method     ChildUserQuery orderByUseName($order = Criteria::ASC) Order by the user_name column
 * @method     ChildUserQuery orderByUserSurname($order = Criteria::ASC) Order by the user_surname column
 * @method     ChildUserQuery orderByUserLogin($order = Criteria::ASC) Order by the user_login column
 * @method     ChildUserQuery orderByUserPass($order = Criteria::ASC) Order by the user_pass column
 * @method     ChildUserQuery orderByUserPassIsTemp($order = Criteria::ASC) Order by the user_pass_is_temp column
 * @method     ChildUserQuery orderByRememberToken($order = Criteria::ASC) Order by the remember_token column
 * @method     ChildUserQuery orderByUserEmail($order = Criteria::ASC) Order by the user_email column
 * @method     ChildUserQuery orderByUserPhone($order = Criteria::ASC) Order by the user_phone column
 * @method     ChildUserQuery orderByUserAddress($order = Criteria::ASC) Order by the user_address column
 * @method     ChildUserQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     ChildUserQuery orderByUserIsValidated($order = Criteria::ASC) Order by the user_is_validated column
 * @method     ChildUserQuery orderByUserIsActive($order = Criteria::ASC) Order by the user_is_active column
 * @method     ChildUserQuery orderByUserPic($order = Criteria::ASC) Order by the user_pic column
 * @method     ChildUserQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUserQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUserQuery groupByUserId() Group by the user_id column
 * @method     ChildUserQuery groupByResourceId() Group by the resource_id column
 * @method     ChildUserQuery groupByUseName() Group by the user_name column
 * @method     ChildUserQuery groupByUserSurname() Group by the user_surname column
 * @method     ChildUserQuery groupByUserLogin() Group by the user_login column
 * @method     ChildUserQuery groupByUserPass() Group by the user_pass column
 * @method     ChildUserQuery groupByUserPassIsTemp() Group by the user_pass_is_temp column
 * @method     ChildUserQuery groupByRememberToken() Group by the remember_token column
 * @method     ChildUserQuery groupByUserEmail() Group by the user_email column
 * @method     ChildUserQuery groupByUserPhone() Group by the user_phone column
 * @method     ChildUserQuery groupByUserAddress() Group by the user_address column
 * @method     ChildUserQuery groupByRoleId() Group by the role_id column
 * @method     ChildUserQuery groupByUserIsValidated() Group by the user_is_validated column
 * @method     ChildUserQuery groupByUserIsActive() Group by the user_is_active column
 * @method     ChildUserQuery groupByUserPic() Group by the user_pic column
 * @method     ChildUserQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUserQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserQuery leftJoinFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the File relation
 * @method     ChildUserQuery rightJoinFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the File relation
 * @method     ChildUserQuery innerJoinFile($relationAlias = null) Adds a INNER JOIN clause to the query using the File relation
 *
 * @method     ChildUserQuery joinWithFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the File relation
 *
 * @method     ChildUserQuery leftJoinWithFile() Adds a LEFT JOIN clause and with to the query using the File relation
 * @method     ChildUserQuery rightJoinWithFile() Adds a RIGHT JOIN clause and with to the query using the File relation
 * @method     ChildUserQuery innerJoinWithFile() Adds a INNER JOIN clause and with to the query using the File relation
 *
 * @method     ChildUserQuery leftJoinRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the Role relation
 * @method     ChildUserQuery rightJoinRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Role relation
 * @method     ChildUserQuery innerJoinRole($relationAlias = null) Adds a INNER JOIN clause to the query using the Role relation
 *
 * @method     ChildUserQuery joinWithRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Role relation
 *
 * @method     ChildUserQuery leftJoinWithRole() Adds a LEFT JOIN clause and with to the query using the Role relation
 * @method     ChildUserQuery rightJoinWithRole() Adds a RIGHT JOIN clause and with to the query using the Role relation
 * @method     ChildUserQuery innerJoinWithRole() Adds a INNER JOIN clause and with to the query using the Role relation
 *
 * @method     ChildUserQuery leftJoinResource($relationAlias = null) Adds a LEFT JOIN clause to the query using the Resource relation
 * @method     ChildUserQuery rightJoinResource($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Resource relation
 * @method     ChildUserQuery innerJoinResource($relationAlias = null) Adds a INNER JOIN clause to the query using the Resource relation
 *
 * @method     ChildUserQuery joinWithResource($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Resource relation
 *
 * @method     ChildUserQuery leftJoinWithResource() Adds a LEFT JOIN clause and with to the query using the Resource relation
 * @method     ChildUserQuery rightJoinWithResource() Adds a RIGHT JOIN clause and with to the query using the Resource relation
 * @method     ChildUserQuery innerJoinWithResource() Adds a INNER JOIN clause and with to the query using the Resource relation
 *
 * @method     ChildUserQuery leftJoinOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Order relation
 * @method     ChildUserQuery rightJoinOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Order relation
 * @method     ChildUserQuery innerJoinOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the Order relation
 *
 * @method     ChildUserQuery joinWithOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Order relation
 *
 * @method     ChildUserQuery leftJoinWithOrder() Adds a LEFT JOIN clause and with to the query using the Order relation
 * @method     ChildUserQuery rightJoinWithOrder() Adds a RIGHT JOIN clause and with to the query using the Order relation
 * @method     ChildUserQuery innerJoinWithOrder() Adds a INNER JOIN clause and with to the query using the Order relation
 *
 * @method     ChildUserQuery leftJoinSocialView($relationAlias = null) Adds a LEFT JOIN clause to the query using the SocialView relation
 * @method     ChildUserQuery rightJoinSocialView($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SocialView relation
 * @method     ChildUserQuery innerJoinSocialView($relationAlias = null) Adds a INNER JOIN clause to the query using the SocialView relation
 *
 * @method     ChildUserQuery joinWithSocialView($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SocialView relation
 *
 * @method     ChildUserQuery leftJoinWithSocialView() Adds a LEFT JOIN clause and with to the query using the SocialView relation
 * @method     ChildUserQuery rightJoinWithSocialView() Adds a RIGHT JOIN clause and with to the query using the SocialView relation
 * @method     ChildUserQuery innerJoinWithSocialView() Adds a INNER JOIN clause and with to the query using the SocialView relation
 *
 * @method     ChildUserQuery leftJoinSocialLike($relationAlias = null) Adds a LEFT JOIN clause to the query using the SocialLike relation
 * @method     ChildUserQuery rightJoinSocialLike($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SocialLike relation
 * @method     ChildUserQuery innerJoinSocialLike($relationAlias = null) Adds a INNER JOIN clause to the query using the SocialLike relation
 *
 * @method     ChildUserQuery joinWithSocialLike($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SocialLike relation
 *
 * @method     ChildUserQuery leftJoinWithSocialLike() Adds a LEFT JOIN clause and with to the query using the SocialLike relation
 * @method     ChildUserQuery rightJoinWithSocialLike() Adds a RIGHT JOIN clause and with to the query using the SocialLike relation
 * @method     ChildUserQuery innerJoinWithSocialLike() Adds a INNER JOIN clause and with to the query using the SocialLike relation
 *
 * @method     ChildUserQuery leftJoinSocialComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the SocialComment relation
 * @method     ChildUserQuery rightJoinSocialComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SocialComment relation
 * @method     ChildUserQuery innerJoinSocialComment($relationAlias = null) Adds a INNER JOIN clause to the query using the SocialComment relation
 *
 * @method     ChildUserQuery joinWithSocialComment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SocialComment relation
 *
 * @method     ChildUserQuery leftJoinWithSocialComment() Adds a LEFT JOIN clause and with to the query using the SocialComment relation
 * @method     ChildUserQuery rightJoinWithSocialComment() Adds a RIGHT JOIN clause and with to the query using the SocialComment relation
 * @method     ChildUserQuery innerJoinWithSocialComment() Adds a INNER JOIN clause and with to the query using the SocialComment relation
 *
 * @method     ChildUserQuery leftJoinSocialRecommendationRelatedByUserId($relationAlias = null) Adds a LEFT JOIN clause to the query using the SocialRecommendationRelatedByUserId relation
 * @method     ChildUserQuery rightJoinSocialRecommendationRelatedByUserId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SocialRecommendationRelatedByUserId relation
 * @method     ChildUserQuery innerJoinSocialRecommendationRelatedByUserId($relationAlias = null) Adds a INNER JOIN clause to the query using the SocialRecommendationRelatedByUserId relation
 *
 * @method     ChildUserQuery joinWithSocialRecommendationRelatedByUserId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SocialRecommendationRelatedByUserId relation
 *
 * @method     ChildUserQuery leftJoinWithSocialRecommendationRelatedByUserId() Adds a LEFT JOIN clause and with to the query using the SocialRecommendationRelatedByUserId relation
 * @method     ChildUserQuery rightJoinWithSocialRecommendationRelatedByUserId() Adds a RIGHT JOIN clause and with to the query using the SocialRecommendationRelatedByUserId relation
 * @method     ChildUserQuery innerJoinWithSocialRecommendationRelatedByUserId() Adds a INNER JOIN clause and with to the query using the SocialRecommendationRelatedByUserId relation
 *
 * @method     ChildUserQuery leftJoinSocialRecommendationRelatedBySocialRecommendationTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the SocialRecommendationRelatedBySocialRecommendationTo relation
 * @method     ChildUserQuery rightJoinSocialRecommendationRelatedBySocialRecommendationTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SocialRecommendationRelatedBySocialRecommendationTo relation
 * @method     ChildUserQuery innerJoinSocialRecommendationRelatedBySocialRecommendationTo($relationAlias = null) Adds a INNER JOIN clause to the query using the SocialRecommendationRelatedBySocialRecommendationTo relation
 *
 * @method     ChildUserQuery joinWithSocialRecommendationRelatedBySocialRecommendationTo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SocialRecommendationRelatedBySocialRecommendationTo relation
 *
 * @method     ChildUserQuery leftJoinWithSocialRecommendationRelatedBySocialRecommendationTo() Adds a LEFT JOIN clause and with to the query using the SocialRecommendationRelatedBySocialRecommendationTo relation
 * @method     ChildUserQuery rightJoinWithSocialRecommendationRelatedBySocialRecommendationTo() Adds a RIGHT JOIN clause and with to the query using the SocialRecommendationRelatedBySocialRecommendationTo relation
 * @method     ChildUserQuery innerJoinWithSocialRecommendationRelatedBySocialRecommendationTo() Adds a INNER JOIN clause and with to the query using the SocialRecommendationRelatedBySocialRecommendationTo relation
 *
 * @method     ChildUserQuery leftJoinUserPeriodicPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserPeriodicPlan relation
 * @method     ChildUserQuery rightJoinUserPeriodicPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserPeriodicPlan relation
 * @method     ChildUserQuery innerJoinUserPeriodicPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the UserPeriodicPlan relation
 *
 * @method     ChildUserQuery joinWithUserPeriodicPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserPeriodicPlan relation
 *
 * @method     ChildUserQuery leftJoinWithUserPeriodicPlan() Adds a LEFT JOIN clause and with to the query using the UserPeriodicPlan relation
 * @method     ChildUserQuery rightJoinWithUserPeriodicPlan() Adds a RIGHT JOIN clause and with to the query using the UserPeriodicPlan relation
 * @method     ChildUserQuery innerJoinWithUserPeriodicPlan() Adds a INNER JOIN clause and with to the query using the UserPeriodicPlan relation
 *
 * @method     ChildUserQuery leftJoinWishlist($relationAlias = null) Adds a LEFT JOIN clause to the query using the Wishlist relation
 * @method     ChildUserQuery rightJoinWishlist($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Wishlist relation
 * @method     ChildUserQuery innerJoinWishlist($relationAlias = null) Adds a INNER JOIN clause to the query using the Wishlist relation
 *
 * @method     ChildUserQuery joinWithWishlist($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Wishlist relation
 *
 * @method     ChildUserQuery leftJoinWithWishlist() Adds a LEFT JOIN clause and with to the query using the Wishlist relation
 * @method     ChildUserQuery rightJoinWithWishlist() Adds a RIGHT JOIN clause and with to the query using the Wishlist relation
 * @method     ChildUserQuery innerJoinWithWishlist() Adds a INNER JOIN clause and with to the query using the Wishlist relation
 *
 * @method     \App\Propel\FileQuery|\App\Propel\RoleQuery|\App\Propel\ResourceQuery|\App\Propel\OrderQuery|\App\Propel\SocialViewQuery|\App\Propel\SocialLikeQuery|\App\Propel\SocialCommentQuery|\App\Propel\SocialRecommendationQuery|\App\Propel\UserPeriodicPlanQuery|\App\Propel\WishlistQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUser findOne(ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser findOneByUserId(int $user_id) Return the first ChildUser filtered by the user_id column
 * @method     ChildUser findOneByResourceId(int $resource_id) Return the first ChildUser filtered by the resource_id column
 * @method     ChildUser findOneByUseName(string $user_name) Return the first ChildUser filtered by the user_name column
 * @method     ChildUser findOneByUserSurname(string $user_surname) Return the first ChildUser filtered by the user_surname column
 * @method     ChildUser findOneByUserLogin(string $user_login) Return the first ChildUser filtered by the user_login column
 * @method     ChildUser findOneByUserPass(string $user_pass) Return the first ChildUser filtered by the user_pass column
 * @method     ChildUser findOneByUserPassIsTemp(string $user_pass_is_temp) Return the first ChildUser filtered by the user_pass_is_temp column
 * @method     ChildUser findOneByRememberToken(string $remember_token) Return the first ChildUser filtered by the remember_token column
 * @method     ChildUser findOneByUserEmail(string $user_email) Return the first ChildUser filtered by the user_email column
 * @method     ChildUser findOneByUserPhone(string $user_phone) Return the first ChildUser filtered by the user_phone column
 * @method     ChildUser findOneByUserAddress(string $user_address) Return the first ChildUser filtered by the user_address column
 * @method     ChildUser findOneByRoleId(int $role_id) Return the first ChildUser filtered by the role_id column
 * @method     ChildUser findOneByUserIsValidated(boolean $user_is_validated) Return the first ChildUser filtered by the user_is_validated column
 * @method     ChildUser findOneByUserIsActive(boolean $user_is_active) Return the first ChildUser filtered by the user_is_active column
 * @method     ChildUser findOneByUserPic(int $user_pic) Return the first ChildUser filtered by the user_pic column
 * @method     ChildUser findOneByCreatedAt(string $created_at) Return the first ChildUser filtered by the created_at column
 * @method     ChildUser findOneByUpdatedAt(string $updated_at) Return the first ChildUser filtered by the updated_at column *

 * @method     ChildUser requirePk($key, ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneByUserId(int $user_id) Return the first ChildUser filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByResourceId(int $resource_id) Return the first ChildUser filtered by the resource_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUseName(string $user_name) Return the first ChildUser filtered by the user_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserSurname(string $user_surname) Return the first ChildUser filtered by the user_surname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserLogin(string $user_login) Return the first ChildUser filtered by the user_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserPass(string $user_pass) Return the first ChildUser filtered by the user_pass column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserPassIsTemp(string $user_pass_is_temp) Return the first ChildUser filtered by the user_pass_is_temp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByRememberToken(string $remember_token) Return the first ChildUser filtered by the remember_token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserEmail(string $user_email) Return the first ChildUser filtered by the user_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserPhone(string $user_phone) Return the first ChildUser filtered by the user_phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserAddress(string $user_address) Return the first ChildUser filtered by the user_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByRoleId(int $role_id) Return the first ChildUser filtered by the role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserIsValidated(boolean $user_is_validated) Return the first ChildUser filtered by the user_is_validated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserIsActive(boolean $user_is_active) Return the first ChildUser filtered by the user_is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserPic(int $user_pic) Return the first ChildUser filtered by the user_pic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByCreatedAt(string $created_at) Return the first ChildUser filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUpdatedAt(string $updated_at) Return the first ChildUser filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @method     ChildUser[]|ObjectCollection findByUserId(int $user_id) Return ChildUser objects filtered by the user_id column
 * @method     ChildUser[]|ObjectCollection findByResourceId(int $resource_id) Return ChildUser objects filtered by the resource_id column
 * @method     ChildUser[]|ObjectCollection findByUseName(string $user_name) Return ChildUser objects filtered by the user_name column
 * @method     ChildUser[]|ObjectCollection findByUserSurname(string $user_surname) Return ChildUser objects filtered by the user_surname column
 * @method     ChildUser[]|ObjectCollection findByUserLogin(string $user_login) Return ChildUser objects filtered by the user_login column
 * @method     ChildUser[]|ObjectCollection findByUserPass(string $user_pass) Return ChildUser objects filtered by the user_pass column
 * @method     ChildUser[]|ObjectCollection findByUserPassIsTemp(string $user_pass_is_temp) Return ChildUser objects filtered by the user_pass_is_temp column
 * @method     ChildUser[]|ObjectCollection findByRememberToken(string $remember_token) Return ChildUser objects filtered by the remember_token column
 * @method     ChildUser[]|ObjectCollection findByUserEmail(string $user_email) Return ChildUser objects filtered by the user_email column
 * @method     ChildUser[]|ObjectCollection findByUserPhone(string $user_phone) Return ChildUser objects filtered by the user_phone column
 * @method     ChildUser[]|ObjectCollection findByUserAddress(string $user_address) Return ChildUser objects filtered by the user_address column
 * @method     ChildUser[]|ObjectCollection findByRoleId(int $role_id) Return ChildUser objects filtered by the role_id column
 * @method     ChildUser[]|ObjectCollection findByUserIsValidated(boolean $user_is_validated) Return ChildUser objects filtered by the user_is_validated column
 * @method     ChildUser[]|ObjectCollection findByUserIsActive(boolean $user_is_active) Return ChildUser objects filtered by the user_is_active column
 * @method     ChildUser[]|ObjectCollection findByUserPic(int $user_pic) Return ChildUser objects filtered by the user_pic column
 * @method     ChildUser[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUser objects filtered by the created_at column
 * @method     ChildUser[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUser objects filtered by the updated_at column
 * @method     ChildUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserQuery extends ModelCriteria
{

    // delegate behavior

    protected $delegatedFields = [
        'ResourceType' => 'Resource',
        'SocialViews' => 'Resource',
        'SocialLikes' => 'Resource',
        'SocialDislikes' => 'Resource',
        'SocialComments' => 'Resource',
        'SocialFavourites' => 'Resource',
        'SocialRecommendations' => 'Resource',
    ];

protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Propel\Base\UserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'slowshop', $modelName = '\\App\\Propel\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserQuery) {
            return $criteria;
        }
        $query = new ChildUserQuery();
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
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
     * @return ChildUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT user_id, resource_id, user_name, user_surname, user_login, user_pass, user_pass_is_temp, remember_token, user_email, user_phone, user_address, role_id, user_is_validated, user_is_active, user_pic, created_at, updated_at FROM user WHERE user_id = :p0';
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
            /** @var ChildUser $obj */
            $obj = new ChildUser();
            $obj->hydrate($row);
            UserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserTableMap::COL_USER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserTableMap::COL_USER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_ID, $userId, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByResourceId($resourceId = null, $comparison = null)
    {
        if (is_array($resourceId)) {
            $useMinMax = false;
            if (isset($resourceId['min'])) {
                $this->addUsingAlias(UserTableMap::COL_RESOURCE_ID, $resourceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resourceId['max'])) {
                $this->addUsingAlias(UserTableMap::COL_RESOURCE_ID, $resourceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_RESOURCE_ID, $resourceId, $comparison);
    }

    /**
     * Filter the query on the user_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUseName('fooValue');   // WHERE user_name = 'fooValue'
     * $query->filterByUseName('%fooValue%'); // WHERE user_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $useName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUseName($useName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($useName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $useName)) {
                $useName = str_replace('*', '%', $useName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_NAME, $useName, $comparison);
    }

    /**
     * Filter the query on the user_surname column
     *
     * Example usage:
     * <code>
     * $query->filterByUserSurname('fooValue');   // WHERE user_surname = 'fooValue'
     * $query->filterByUserSurname('%fooValue%'); // WHERE user_surname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userSurname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserSurname($userSurname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userSurname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userSurname)) {
                $userSurname = str_replace('*', '%', $userSurname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_SURNAME, $userSurname, $comparison);
    }

    /**
     * Filter the query on the user_login column
     *
     * Example usage:
     * <code>
     * $query->filterByUserLogin('fooValue');   // WHERE user_login = 'fooValue'
     * $query->filterByUserLogin('%fooValue%'); // WHERE user_login LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userLogin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserLogin($userLogin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userLogin)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userLogin)) {
                $userLogin = str_replace('*', '%', $userLogin);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_LOGIN, $userLogin, $comparison);
    }

    /**
     * Filter the query on the user_pass column
     *
     * Example usage:
     * <code>
     * $query->filterByUserPass('fooValue');   // WHERE user_pass = 'fooValue'
     * $query->filterByUserPass('%fooValue%'); // WHERE user_pass LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userPass The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserPass($userPass = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userPass)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userPass)) {
                $userPass = str_replace('*', '%', $userPass);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_PASS, $userPass, $comparison);
    }

    /**
     * Filter the query on the user_pass_is_temp column
     *
     * Example usage:
     * <code>
     * $query->filterByUserPassIsTemp('fooValue');   // WHERE user_pass_is_temp = 'fooValue'
     * $query->filterByUserPassIsTemp('%fooValue%'); // WHERE user_pass_is_temp LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userPassIsTemp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserPassIsTemp($userPassIsTemp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userPassIsTemp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userPassIsTemp)) {
                $userPassIsTemp = str_replace('*', '%', $userPassIsTemp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_PASS_IS_TEMP, $userPassIsTemp, $comparison);
    }

    /**
     * Filter the query on the remember_token column
     *
     * Example usage:
     * <code>
     * $query->filterByRememberToken('fooValue');   // WHERE remember_token = 'fooValue'
     * $query->filterByRememberToken('%fooValue%'); // WHERE remember_token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rememberToken The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByRememberToken($rememberToken = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rememberToken)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rememberToken)) {
                $rememberToken = str_replace('*', '%', $rememberToken);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_REMEMBER_TOKEN, $rememberToken, $comparison);
    }

    /**
     * Filter the query on the user_email column
     *
     * Example usage:
     * <code>
     * $query->filterByUserEmail('fooValue');   // WHERE user_email = 'fooValue'
     * $query->filterByUserEmail('%fooValue%'); // WHERE user_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserEmail($userEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userEmail)) {
                $userEmail = str_replace('*', '%', $userEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_EMAIL, $userEmail, $comparison);
    }

    /**
     * Filter the query on the user_phone column
     *
     * Example usage:
     * <code>
     * $query->filterByUserPhone('fooValue');   // WHERE user_phone = 'fooValue'
     * $query->filterByUserPhone('%fooValue%'); // WHERE user_phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userPhone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserPhone($userPhone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userPhone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userPhone)) {
                $userPhone = str_replace('*', '%', $userPhone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_PHONE, $userPhone, $comparison);
    }

    /**
     * Filter the query on the user_address column
     *
     * Example usage:
     * <code>
     * $query->filterByUserAddress('fooValue');   // WHERE user_address = 'fooValue'
     * $query->filterByUserAddress('%fooValue%'); // WHERE user_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserAddress($userAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userAddress)) {
                $userAddress = str_replace('*', '%', $userAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_ADDRESS, $userAddress, $comparison);
    }

    /**
     * Filter the query on the role_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoleId(1234); // WHERE role_id = 1234
     * $query->filterByRoleId(array(12, 34)); // WHERE role_id IN (12, 34)
     * $query->filterByRoleId(array('min' => 12)); // WHERE role_id > 12
     * </code>
     *
     * @see       filterByRole()
     *
     * @param     mixed $roleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByRoleId($roleId = null, $comparison = null)
    {
        if (is_array($roleId)) {
            $useMinMax = false;
            if (isset($roleId['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roleId['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ROLE_ID, $roleId, $comparison);
    }

    /**
     * Filter the query on the user_is_validated column
     *
     * Example usage:
     * <code>
     * $query->filterByUserIsValidated(true); // WHERE user_is_validated = true
     * $query->filterByUserIsValidated('yes'); // WHERE user_is_validated = true
     * </code>
     *
     * @param     boolean|string $userIsValidated The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserIsValidated($userIsValidated = null, $comparison = null)
    {
        if (is_string($userIsValidated)) {
            $userIsValidated = in_array(strtolower($userIsValidated), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_IS_VALIDATED, $userIsValidated, $comparison);
    }

    /**
     * Filter the query on the user_is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByUserIsActive(true); // WHERE user_is_active = true
     * $query->filterByUserIsActive('yes'); // WHERE user_is_active = true
     * </code>
     *
     * @param     boolean|string $userIsActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserIsActive($userIsActive = null, $comparison = null)
    {
        if (is_string($userIsActive)) {
            $userIsActive = in_array(strtolower($userIsActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_IS_ACTIVE, $userIsActive, $comparison);
    }

    /**
     * Filter the query on the user_pic column
     *
     * Example usage:
     * <code>
     * $query->filterByUserPic(1234); // WHERE user_pic = 1234
     * $query->filterByUserPic(array(12, 34)); // WHERE user_pic IN (12, 34)
     * $query->filterByUserPic(array('min' => 12)); // WHERE user_pic > 12
     * </code>
     *
     * @see       filterByFile()
     *
     * @param     mixed $userPic The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserPic($userPic = null, $comparison = null)
    {
        if (is_array($userPic)) {
            $useMinMax = false;
            if (isset($userPic['min'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_PIC, $userPic['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userPic['max'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_PIC, $userPic['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_PIC, $userPic, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UserTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UserTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UserTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UserTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \App\Propel\File object
     *
     * @param \App\Propel\File|ObjectCollection $file The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByFile($file, $comparison = null)
    {
        if ($file instanceof \App\Propel\File) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_PIC, $file->getFileId(), $comparison);
        } elseif ($file instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserTableMap::COL_USER_PIC, $file->toKeyValue('PrimaryKey', 'FileId'), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\Role object
     *
     * @param \App\Propel\Role|ObjectCollection $role The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByRole($role, $comparison = null)
    {
        if ($role instanceof \App\Propel\Role) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ROLE_ID, $role->getRoleId(), $comparison);
        } elseif ($role instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserTableMap::COL_ROLE_ID, $role->toKeyValue('PrimaryKey', 'RoleId'), $comparison);
        } else {
            throw new PropelException('filterByRole() only accepts arguments of type \App\Propel\Role or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Role relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinRole($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Role');

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
            $this->addJoinObject($join, 'Role');
        }

        return $this;
    }

    /**
     * Use the Role relation Role object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\RoleQuery A secondary query class using the current class as primary query
     */
    public function useRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Role', '\App\Propel\RoleQuery');
    }

    /**
     * Filter the query by a related \App\Propel\Resource object
     *
     * @param \App\Propel\Resource|ObjectCollection $resource The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByResource($resource, $comparison = null)
    {
        if ($resource instanceof \App\Propel\Resource) {
            return $this
                ->addUsingAlias(UserTableMap::COL_RESOURCE_ID, $resource->getResourceId(), $comparison);
        } elseif ($resource instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserTableMap::COL_RESOURCE_ID, $resource->toKeyValue('PrimaryKey', 'ResourceId'), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
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
     * Filter the query by a related \App\Propel\Order object
     *
     * @param \App\Propel\Order|ObjectCollection $order the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByOrder($order, $comparison = null)
    {
        if ($order instanceof \App\Propel\Order) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $order->getUserId(), $comparison);
        } elseif ($order instanceof ObjectCollection) {
            return $this
                ->useOrderQuery()
                ->filterByPrimaryKeys($order->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrder() only accepts arguments of type \App\Propel\Order or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Order relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinOrder($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Order');

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
            $this->addJoinObject($join, 'Order');
        }

        return $this;
    }

    /**
     * Use the Order relation Order object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\OrderQuery A secondary query class using the current class as primary query
     */
    public function useOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Order', '\App\Propel\OrderQuery');
    }

    /**
     * Filter the query by a related \App\Propel\SocialView object
     *
     * @param \App\Propel\SocialView|ObjectCollection $socialView the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterBySocialView($socialView, $comparison = null)
    {
        if ($socialView instanceof \App\Propel\SocialView) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $socialView->getUserId(), $comparison);
        } elseif ($socialView instanceof ObjectCollection) {
            return $this
                ->useSocialViewQuery()
                ->filterByPrimaryKeys($socialView->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySocialView() only accepts arguments of type \App\Propel\SocialView or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SocialView relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinSocialView($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SocialView');

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
            $this->addJoinObject($join, 'SocialView');
        }

        return $this;
    }

    /**
     * Use the SocialView relation SocialView object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\SocialViewQuery A secondary query class using the current class as primary query
     */
    public function useSocialViewQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSocialView($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SocialView', '\App\Propel\SocialViewQuery');
    }

    /**
     * Filter the query by a related \App\Propel\SocialLike object
     *
     * @param \App\Propel\SocialLike|ObjectCollection $socialLike the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterBySocialLike($socialLike, $comparison = null)
    {
        if ($socialLike instanceof \App\Propel\SocialLike) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $socialLike->getUserId(), $comparison);
        } elseif ($socialLike instanceof ObjectCollection) {
            return $this
                ->useSocialLikeQuery()
                ->filterByPrimaryKeys($socialLike->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySocialLike() only accepts arguments of type \App\Propel\SocialLike or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SocialLike relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinSocialLike($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SocialLike');

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
            $this->addJoinObject($join, 'SocialLike');
        }

        return $this;
    }

    /**
     * Use the SocialLike relation SocialLike object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\SocialLikeQuery A secondary query class using the current class as primary query
     */
    public function useSocialLikeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSocialLike($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SocialLike', '\App\Propel\SocialLikeQuery');
    }

    /**
     * Filter the query by a related \App\Propel\SocialComment object
     *
     * @param \App\Propel\SocialComment|ObjectCollection $socialComment the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterBySocialComment($socialComment, $comparison = null)
    {
        if ($socialComment instanceof \App\Propel\SocialComment) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $socialComment->getUserId(), $comparison);
        } elseif ($socialComment instanceof ObjectCollection) {
            return $this
                ->useSocialCommentQuery()
                ->filterByPrimaryKeys($socialComment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySocialComment() only accepts arguments of type \App\Propel\SocialComment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SocialComment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinSocialComment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SocialComment');

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
            $this->addJoinObject($join, 'SocialComment');
        }

        return $this;
    }

    /**
     * Use the SocialComment relation SocialComment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\SocialCommentQuery A secondary query class using the current class as primary query
     */
    public function useSocialCommentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSocialComment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SocialComment', '\App\Propel\SocialCommentQuery');
    }

    /**
     * Filter the query by a related \App\Propel\SocialRecommendation object
     *
     * @param \App\Propel\SocialRecommendation|ObjectCollection $socialRecommendation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterBySocialRecommendationRelatedByUserId($socialRecommendation, $comparison = null)
    {
        if ($socialRecommendation instanceof \App\Propel\SocialRecommendation) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $socialRecommendation->getUserId(), $comparison);
        } elseif ($socialRecommendation instanceof ObjectCollection) {
            return $this
                ->useSocialRecommendationRelatedByUserIdQuery()
                ->filterByPrimaryKeys($socialRecommendation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySocialRecommendationRelatedByUserId() only accepts arguments of type \App\Propel\SocialRecommendation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SocialRecommendationRelatedByUserId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinSocialRecommendationRelatedByUserId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SocialRecommendationRelatedByUserId');

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
            $this->addJoinObject($join, 'SocialRecommendationRelatedByUserId');
        }

        return $this;
    }

    /**
     * Use the SocialRecommendationRelatedByUserId relation SocialRecommendation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\SocialRecommendationQuery A secondary query class using the current class as primary query
     */
    public function useSocialRecommendationRelatedByUserIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSocialRecommendationRelatedByUserId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SocialRecommendationRelatedByUserId', '\App\Propel\SocialRecommendationQuery');
    }

    /**
     * Filter the query by a related \App\Propel\SocialRecommendation object
     *
     * @param \App\Propel\SocialRecommendation|ObjectCollection $socialRecommendation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterBySocialRecommendationRelatedBySocialRecommendationTo($socialRecommendation, $comparison = null)
    {
        if ($socialRecommendation instanceof \App\Propel\SocialRecommendation) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $socialRecommendation->getSocialRecommendationTo(), $comparison);
        } elseif ($socialRecommendation instanceof ObjectCollection) {
            return $this
                ->useSocialRecommendationRelatedBySocialRecommendationToQuery()
                ->filterByPrimaryKeys($socialRecommendation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySocialRecommendationRelatedBySocialRecommendationTo() only accepts arguments of type \App\Propel\SocialRecommendation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SocialRecommendationRelatedBySocialRecommendationTo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinSocialRecommendationRelatedBySocialRecommendationTo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SocialRecommendationRelatedBySocialRecommendationTo');

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
            $this->addJoinObject($join, 'SocialRecommendationRelatedBySocialRecommendationTo');
        }

        return $this;
    }

    /**
     * Use the SocialRecommendationRelatedBySocialRecommendationTo relation SocialRecommendation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\SocialRecommendationQuery A secondary query class using the current class as primary query
     */
    public function useSocialRecommendationRelatedBySocialRecommendationToQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSocialRecommendationRelatedBySocialRecommendationTo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SocialRecommendationRelatedBySocialRecommendationTo', '\App\Propel\SocialRecommendationQuery');
    }

    /**
     * Filter the query by a related \App\Propel\UserPeriodicPlan object
     *
     * @param \App\Propel\UserPeriodicPlan|ObjectCollection $userPeriodicPlan the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserPeriodicPlan($userPeriodicPlan, $comparison = null)
    {
        if ($userPeriodicPlan instanceof \App\Propel\UserPeriodicPlan) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $userPeriodicPlan->getUserId(), $comparison);
        } elseif ($userPeriodicPlan instanceof ObjectCollection) {
            return $this
                ->useUserPeriodicPlanQuery()
                ->filterByPrimaryKeys($userPeriodicPlan->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserPeriodicPlan() only accepts arguments of type \App\Propel\UserPeriodicPlan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserPeriodicPlan relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinUserPeriodicPlan($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserPeriodicPlan');

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
            $this->addJoinObject($join, 'UserPeriodicPlan');
        }

        return $this;
    }

    /**
     * Use the UserPeriodicPlan relation UserPeriodicPlan object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\UserPeriodicPlanQuery A secondary query class using the current class as primary query
     */
    public function useUserPeriodicPlanQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserPeriodicPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserPeriodicPlan', '\App\Propel\UserPeriodicPlanQuery');
    }

    /**
     * Filter the query by a related \App\Propel\Wishlist object
     *
     * @param \App\Propel\Wishlist|ObjectCollection $wishlist the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByWishlist($wishlist, $comparison = null)
    {
        if ($wishlist instanceof \App\Propel\Wishlist) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $wishlist->getUserId(), $comparison);
        } elseif ($wishlist instanceof ObjectCollection) {
            return $this
                ->useWishlistQuery()
                ->filterByPrimaryKeys($wishlist->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWishlist() only accepts arguments of type \App\Propel\Wishlist or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Wishlist relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinWishlist($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Wishlist');

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
            $this->addJoinObject($join, 'Wishlist');
        }

        return $this;
    }

    /**
     * Use the Wishlist relation Wishlist object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Propel\WishlistQuery A secondary query class using the current class as primary query
     */
    public function useWishlistQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWishlist($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Wishlist', '\App\Propel\WishlistQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUser $user Object to remove from the list of results
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserTableMap::COL_USER_ID, $user->getUserId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserTableMap::clearInstancePool();
            UserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // delegate behavior
    /**
    * Filter the query by resource_type column
    *
    * Example usage:
    * <code>
        * $query->filterByResourceType(1234); // WHERE resource_type = 1234
        * $query->filterByResourceType(array(12, 34)); // WHERE resource_type IN (12, 34)
        * $query->filterByResourceType(array('min' => 12)); // WHERE resource_type > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildUserQuery The current query, for fluid interface
    */
    public function filterByResourceType($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterByResourceType($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderByResourceType($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderByResourceType($order)->endUse();
    }
    /**
    * Filter the query by social_views column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialViews(1234); // WHERE social_views = 1234
        * $query->filterBySocialViews(array(12, 34)); // WHERE social_views IN (12, 34)
        * $query->filterBySocialViews(array('min' => 12)); // WHERE social_views > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildUserQuery The current query, for fluid interface
    */
    public function filterBySocialViews($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialViews($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialViews($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialViews($order)->endUse();
    }
    /**
    * Filter the query by social_likes column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialLikes(1234); // WHERE social_likes = 1234
        * $query->filterBySocialLikes(array(12, 34)); // WHERE social_likes IN (12, 34)
        * $query->filterBySocialLikes(array('min' => 12)); // WHERE social_likes > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildUserQuery The current query, for fluid interface
    */
    public function filterBySocialLikes($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialLikes($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialLikes($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialLikes($order)->endUse();
    }
    /**
    * Filter the query by social_dislikes column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialDislikes(1234); // WHERE social_dislikes = 1234
        * $query->filterBySocialDislikes(array(12, 34)); // WHERE social_dislikes IN (12, 34)
        * $query->filterBySocialDislikes(array('min' => 12)); // WHERE social_dislikes > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildUserQuery The current query, for fluid interface
    */
    public function filterBySocialDislikes($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialDislikes($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialDislikes($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialDislikes($order)->endUse();
    }
    /**
    * Filter the query by social_comments column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialComments(1234); // WHERE social_comments = 1234
        * $query->filterBySocialComments(array(12, 34)); // WHERE social_comments IN (12, 34)
        * $query->filterBySocialComments(array('min' => 12)); // WHERE social_comments > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildUserQuery The current query, for fluid interface
    */
    public function filterBySocialComments($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialComments($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialComments($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialComments($order)->endUse();
    }
    /**
    * Filter the query by social_favourites column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialFavourites(1234); // WHERE social_favourites = 1234
        * $query->filterBySocialFavourites(array(12, 34)); // WHERE social_favourites IN (12, 34)
        * $query->filterBySocialFavourites(array('min' => 12)); // WHERE social_favourites > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildUserQuery The current query, for fluid interface
    */
    public function filterBySocialFavourites($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialFavourites($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialFavourites($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialFavourites($order)->endUse();
    }
    /**
    * Filter the query by social_recommendations column
    *
    * Example usage:
    * <code>
        * $query->filterBySocialRecommendations(1234); // WHERE social_recommendations = 1234
        * $query->filterBySocialRecommendations(array(12, 34)); // WHERE social_recommendations IN (12, 34)
        * $query->filterBySocialRecommendations(array('min' => 12)); // WHERE social_recommendations > 12
        * </code>
    *
    * @param     mixed $value The value to use as filter.
    *              Use scalar values for equality.
    *              Use array values for in_array() equivalent.
    *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
    * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
    *
    * @return $this|ChildUserQuery The current query, for fluid interface
    */
    public function filterBySocialRecommendations($value = null, $comparison = null)
    {
        return $this->useResourceQuery()->filterBySocialRecommendations($value, $comparison)->endUse();
    }

    /**
    * Adds an ORDER BY clause to the query
    * Usability layer on top of Criteria::addAscendingOrderByColumn() and Criteria::addDescendingOrderByColumn()
    * Infers $column and $order from $columnName and some optional arguments
    * Examples:
    *   $c->orderBy('Book.CreatedAt')
    *    => $c->addAscendingOrderByColumn(BookTableMap::CREATED_AT)
    *   $c->orderBy('Book.CategoryId', 'desc')
    *    => $c->addDescendingOrderByColumn(BookTableMap::CATEGORY_ID)
    *
    * @param string $order      The sorting order. Criteria::ASC by default, also accepts Criteria::DESC
    *
    * @return $this|ModelCriteria The current object, for fluid interface
    */
    public function orderBySocialRecommendations($order = Criteria::ASC)
    {
        return $this->useResourceQuery()->orderBySocialRecommendations($order)->endUse();
    }

    /**
     * Adds a condition on a column based on a column phpName and a value
     * Uses introspection to translate the column phpName into a fully qualified name
     * Warning: recognizes only the phpNames of the main Model (not joined tables)
     * <code>
     * $c->filterBy('Title', 'foo');
     * </code>
     *
     * @see Criteria::add()
     *
     * @param string $column     A string representing thecolumn phpName, e.g. 'AuthorId'
     * @param mixed  $value      A value for the condition
     * @param string $comparison What to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ModelCriteria The current object, for fluid interface
     */
    public function filterBy($column, $value, $comparison = Criteria::EQUAL)
    {
        if (isset($this->delegatedFields[$column])) {
            $methodUse = "use{$this->delegatedFields[$column]}Query";

            return $this->{$methodUse}()->filterBy($column, $value, $comparison)->endUse();
        } else {
            return $this->add($this->getRealColumnName($column), $value, $comparison);
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UserTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UserTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserTableMap::COL_CREATED_AT);
    }

} // UserQuery
