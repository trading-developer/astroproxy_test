<?php

namespace App\Repositories\User;

use App\Http\Resources\User\UserResource;
use App\Models\Payment;
use App\Models\User;
use function Symfony\Component\String\u;

class UserRepository
{

    /**
     * @param $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($request)
    {
        $perPage = $request->input('per_page', 10);

        $users = User::query();

        return $users->paginate($perPage);
    }

    /**
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function create($request)
    {
        return User::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => bcrypt($request['password']),
        ]);
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function show(int $id): ?User
    {
        return User::query()
            ->with(['payments'])
            ->where('id', $id)
            ->first();
    }

    /**
     * @param int $id
     * @return Payment[]
     */
    public function showPayments(int $id): array
    {
        $user = $this->show($id);

        if (!$user) {
            return [];
        }

        return $user->payments;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return User::find($id)->delete();
    }

    /**
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update(int $id, array $data)
    {
        $user = User::query()->where('id', $id);

        return $user->update([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'phone' => $data['phone'] ?? $user->phone,
        ]);
    }
}
