<?php

namespace App\Http\Controllers;

use App\Http\Filters\UserFilter;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\BasePaginationResourceCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepo;

    private $userService;

    public function __construct(UserRepository $userRepo, UserService $userService)
    {
        $this->userRepo = $userRepo;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return BasePaginationResourceCollection
     */
    public function index(Request $request): BasePaginationResourceCollection
    {
        $filter = new UserFilter($request);
        $users = $this->userRepo->getAllWithFilter($filter);

        return new BasePaginationResourceCollection($users, UserResource::class);
    }

    /**
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->validated());

        return response()->json(new UserResource($user), 201);
    }

    /**
     * @param $id
     * @return UserResource | JsonResponse
     */
    public function show($id): UserResource | JsonResponse
    {
        $user = $this->userRepo->findById($id);
        if (!$user) {
            return response()->json(['error' => __('messages.user_not_found')], 404);
        }

        return new UserResource($user);
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => __('messages.user_not_found')], 404);
        }

        $user = $this->userService->updateUser($user, $request->validated());

        return response()->json(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => __('messages.user_not_found')], 404);
        }

        $this->userService->deleteUser($user);

        return response()->json(['message' => __('messages.user_deleted_successfully')]);
    }
}
