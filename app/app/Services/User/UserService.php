<?php

namespace App\Services\User;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index($request)
    {
        return $this->userRepository->index($request);
    }

    public function create($request)
    {
        return $this->userRepository->create($request);
    }


    /**
     * @param int $id
     * @return \App\Models\User|null
     */
    public function show(int $id)
    {
        return $this->userRepository->show($id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function showPayments(int $id): array
    {
        return $this->userRepository->showPayments($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function delete($id)
    {
        if ($id === Auth::id()) {
            return response()->json([
                'message' => 'Вы не можете удалить свой аккаунт'
            ], 500);
        }

        Payment::query()->where('user_id', $id)->delete();

        return $this->userRepository->delete((int)$id);
    }

    /**
     * @param int $userId
     * @param array $data
     * @return int
     */
    public function update(int $userId, array $data): int
    {
        return $this->userRepository->update($userId, $data);
    }

    /**
     * @param User $user
     * @param $serviceId
     * @return Payment
     */
    public function attachService(User $user, $serviceId): ?Payment
    {
        $service = Service::find($serviceId);

        return Payment::create([
            'total' => $service->price,
            'status' => Payment::STATUS_NEW,
            'payment_method' => Payment::PAYMENT_METHOD_VISA,
            'service_id' => $service->id,
            'user_id' => $user->id,
            'comment' => $service->name,
        ]);
    }
}
