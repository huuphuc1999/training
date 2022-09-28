<?php
/**
 * User repository
 *
 * PHP version 7
 *
 * @category  Repository
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
namespace App\Repositories;

use App\Repositories\EloquentRepository;

/**
 * A template for common problems
 *
 * @category  Repository
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
class UserRepository extends EloquentRepository
{
    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\User::class;
    }
    /**
     * Get all users that are not deleted.
     *
     * @return mixed
     */
    public function getAllUserNotDeleted()
    {
        return $this->model::orderBy('id', 'DESC')
            ->where('is_delete', 0)
            ->paginate(10);
    }
    /**
     * Get group role list.
     *
     * @return mixed
     */
    public function getGroupRole()
    {
        $role = $this->model::all();
        return $role
            ->unique('group_role')
            ->pluck('group_role');
    }

}
