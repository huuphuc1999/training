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

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

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
        try {
            if ($request->ajax()) {
                return $this->userRepository->userSearching($request);
            }
            $groupRole = $this->userRepository->getGroupRole();
            return view('backend.user.index', compact('groupRole'));
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request submitted by users
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        try {
            $this->userRepository->create($request->all());
            return $this->successResponce($message = 'New user added');
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!');
        }

    }

    /**
     *  Lock user or unlock user
     *
     * @param int $id used to update the user
     *
     * @return \Illuminate\Http\Response
     */
    public function userLockOrUnlock($id)
    {
        try {
            $this->userRepository->userLockOrUnlock($id);
            return response()->json(
                [
                    'message' => 'Update status user successfully',
                    "type" => "RESPONSE_OK",
                ], Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!');
        }
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
        try {
            $user = $this->userRepository->find($id);
            return $this->successResponce($user, $message = 'Get user details successfully');
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!');
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request submitted by admin
     * @param int                      $id      used to update the user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $data = $request->all();
            $id = $request->id;
            !empty($data['password']) ? $data['password'] = Hash::make($data['password']) : Arr::except($data, array('password'));
            $this->userRepository->update($id, $data);
            return $this->successResponce($message = 'Update user successfully');
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!');
        }

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
        try {
            $role = $this->userRepository->getUserRole($id);
            if ($role == 'Admin') {
                return $this->errorsResponce($message = 'You cannot delete Admin!');
            }
            $status = $this->userRepository->deleteUser($id);
            return $this->successResponce($message = 'Delete user successfully');
        } catch (\Throwable $th) {
            return $this->errorsResponce($message = 'Somethings went wrong, try agian!');
        }

    }
}
