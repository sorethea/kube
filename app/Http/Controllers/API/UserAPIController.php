<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserAPIController
 */
class UserAPIController extends AppBaseController
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the Users.
     * GET|HEAD /users
     */
    public function index(Request $request): JsonResponse
    {
//        $users = $this->userRepository->all(
//            $request->except(['skip', 'limit']),
//            $request->get('skip'),
//            $request->get('limit')
//        );
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $this->userRepository->pushCriteria(new LimitOffsetCriteria($request));
        $users = $this->userRepository->all();

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }

    /**
     * Store a newly created User in storage.
     * POST /users
     */
    public function store(CreateUserAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        return $this->sendResponse($user->toArray(), 'User saved successfully');
    }

    /**
     * Display the specified User.
     * GET|HEAD /users/{id}
     */
    public function show($id,Request $request): JsonResponse
    {
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $this->userRepository->pushCriteria(new LimitOffsetCriteria($request));
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}
     */
    public function update($id, UpdateUserAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user = $this->userRepository->update($input, $id);

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }

    /**
     * Remove the specified User from storage.
     * DELETE /users/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user->delete();

        return $this->sendSuccess('User deleted successfully');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            "phone"=>"required",
            "password"=>"required",
        ]);
        try {
            if(Auth::attempt($credentials)){
                $user = Auth::user()->with("media");
                $user->tokens()->delete();
                $token = $user->createToken("api-login");
                $user->api_token = $token->plainTextToken;
                return $this->sendResponse($user->toArray(),'User login success!');
            }else{
                $user = $this->userRepository->findByField('phone',$request->get('phone'))->first();
                if($user){
                    return $this->sendError("Unauthenticated.",403);
                }else{
                    $this->register($request);
                }
            }
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage(),$exception->getCode());
        }
    }

    public function register(Request $request){
        $request->validate([
            'phone'=>'required|unique:users',
            'password'=>'required',
        ]);
        try {
            $user = $this->userRepository->create([
                'name'=>$request->get('name')??'',
                'phone'=>$request->get('phone')??'',
                'password'=>Hash::make($request->get('password')),
                'device_token'=>$request->get('device_token')??'',
            ]);
            \auth()->login($user);
            $user = Auth::user()->with('media');
            $token = $user->creatToken('api-login');
            $user->api_token = $token->plainTextToken;
            return $this->sendResponse($user->toArray(),'User login success!');
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage(),$exception->getCode());
        }
    }
}
