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
        if ($request->ajax()) {
            return $this->userRepository->userSearching($request);
        }
        $groupRole = $this->userRepository->getGroupRole();
        return view('backend.user.index', compact('groupRole'));
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
    public function store(AddUserRequest $request)
    {
        $this->userRepository->create($request->all());
        return response()->json(
            [
                'code' => 200,
                "name" => "New user added",
                "type" => "RESPONSE_OK",
                "message" => "success",
            ], Response::HTTP_OK
        );
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
        $user = $this->userRepository->find($id);
        return response()->json(
            [
                'user' => $user,
                'message' => 'success',
                "name" => "Get user successfully",
                "type" => "RESPONSE_OK",
            ], Response::HTTP_OK
        );
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
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->all();
        $id = $request->id;
        !empty($data['password']) ? $data['password'] = Hash::make($data['password']) : Arr::except($data, array('password'));
        $this->userRepository->update($id, $data);
        return response()->json(
            [
                'message' => 'success',
                "name" => "Update user successfully",
                "type" => "RESPONSE_OK",
            ], Response::HTTP_OK
        );
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
