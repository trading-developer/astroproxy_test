<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\{IndexRequest, StoreRequest, UpdateRequest};
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Payment\PaymentResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;

/**
 * Class UserController
 */
class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {
        return UserResource::collection($this->userService->index($request));
    }

    /**
     * @param StoreRequest $request
     * @return UserResource
     */
    public function store(StoreRequest $request)
    {
        //Добавить политики
        return new UserResource($this->userService->create($request->validated()));
    }

    /**
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return UserResource::make($user);
    }

    /**
     * @param User $user
     * @return PaymentResource
     */
    public function payments(User $user)
    {
        return PaymentResource::collection($user->payments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UpdateRequest $request, User $user)
    {
        //Добавить политики

        $this->userService->update($user->id, $request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     */
    public function delete(User $user)
    {
        //Добавить политики

        return $this->userService->delete($user->id);
    }

    /**
     * @param User $user
     * @param string $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function attachService(User $user, $service)
    {
        $result = $this->userService->attachService($user, $service);

        return $result ? $this->successJson() : $this->failedJson();
    }
}
