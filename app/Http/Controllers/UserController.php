<?php
/**
 * User controller
 *
 * PHP version 7
 *
 * @category  Controllers
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Handle CRUD User
 *
 * @category  Controllers
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
class UserController extends Controller
{
    /**
     * Inject user Repository to construct
     */
    protected $userRepository;
    /**
     * Create a new controller instance.
     *
     * @param $userRepository use for query
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Show all users that are not deleted .
     *
     * @param \Illuminate\Http\Request $request submitted by users
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $querySearch = \App\Models\User::query();

            if ($request->status) {
                $querySearch->where('is_active', $request->status);
            }
            if ($request->role) {
                $querySearch->where('group_role', $request->role);
            }
            if ($request->email) {
                $querySearch->where('email', 'like', '%' . $request->email . '%');
            }
            if ($request->name) {
                $querySearch->where('name', 'like', '%' . $request->name . '%');
            }
            $results = $querySearch->paginate(10);
            return $results;
        }
        $users = $this->userRepository->getAllUserNotDeleted();
        $groupRole = $this->userRepository->getGroupRole();
        return view('backend.user.index', compact('users', 'groupRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request submitted by users
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $dataUser = $userRepo->getUser($request);
        // return $dataUser;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id used to display the user
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id used to edit the user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request submitted by admin
     * @param int                      $id      used to update the user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id used to delete the user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
