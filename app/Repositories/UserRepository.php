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
use Yajra\Datatables\Datatables;

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
    /**
     * Handle user searching data.
     *
     * @param \Illuminate\Http\Request $request submitted by users

     * @return mixed
     */
    public function userSearching($request)
    {
        if (request()->ajax()) {
            $querySearch = \App\Models\User::query();
            if ($request->load == 'index') {
                $results = $querySearch
                    ->where('is_delete', '===', 0)
                    ->latest()
                    ->get();
            }
            if ($request->load == 'search') {
                if ($request->filled('status')) {
                    $querySearch
                        ->where('is_active', $request->status)
                        ->where('is_delete', '===', 0);
                }
                if ($request->role) {
                    $querySearch
                        ->where('group_role', $request->role)
                        ->where('is_delete', '===', 0);
                }
                if ($request->email) {
                    $querySearch
                        ->where('email', 'like', '%' . $request->email . '%')
                        ->where('is_delete', '===', 0);
                }
                if ($request->name) {
                    $querySearch
                        ->where('name', 'like', '%' . $request->name . '%')
                        ->where('is_delete', '===', 0);
                }
                $results = $querySearch;
            }

            return Datatables::of($results)
                ->addIndexColumn()
                ->addColumn(
                    'action',
                    function ($results) {
                        $btn = '<button type="button" id="' . 'editUserID-' . $results->id . '"><i class="fa fa-edit"></i></button>';
                        $btn = $btn . ' <button type="button" id="' . 'removeUserID-' . $results->id . '"><i class="fa fa-remove"></i></button>';
                        $btn = $btn . '<button type="button" id="' . 'lockUserID-' . $results->id . '" ><i class="fa fa-lock"></i></button>';
                        return $btn;
                    }
                )
                ->editColumn(
                    'is_active',
                    function ($results) {
                        $results->is_active === 1 ? $status = 'Đang hoạt động' : $status = 'Tạm khóa';
                        return $status;
                    }
                )
                ->rawColumns(['action'])
                ->make(true);
        }
    }

}
