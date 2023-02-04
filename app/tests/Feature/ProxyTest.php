<?php

namespace Tests\Feature;

use App\Exceptions\Handler;
use App\Models\User;
use Tests\TestCase;

class ProxyTest extends TestCase
{

    /**
     * @return void
     */
    public function testStoreOk()
    {
        $data = [
            'name' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'password' => $this->faker->password(),
        ];

        $request = $this
            ->post(route('user.store'), $data, $this->getAuthHeaders());

        $request->assertStatus(201);

        $content = json_decode($request->getContent(), true);

        unset($data['password']);

        foreach (array_keys($data) as $field) {
            $this->assertArrayHasKey($field, $content['data']);
        }
    }

    /**
     * @return void
     */
    public function testShowOk()
    {
        $user = User::factory()->create();

        $request = $this
            ->getJson(route('user.show', $user->id), $this->getAuthHeaders())
            ->assertOk();

        $content = json_decode($request->getContent(), true);

        $fields = [
            'id',
            'name',
            'email',
            'phone',
            'created_at',
        ];

        foreach ($fields as $field) {
            $this->assertArrayHasKey($field, $content['data']);
        }
    }

    /**
     * @return void
     */
    public function testShow404()
    {
        $this
            ->getJson(route('user.show', $this->randInt()))
            ->assertStatus(404)
            ->assertJson([
                'error' => Handler::ERROR_NO_DATA_FOUND
            ]);
    }

    /**
     * @return void
     */
    public function testDestroy404()
    {
        $this
            ->deleteJson(route('user.delete', $this->randInt()))
            ->assertStatus(404)
            ->assertJson([
                'error' => Handler::ERROR_NO_DATA_FOUND
            ]);
    }

    /**
     * @return void
     */
    public function testList()
    {
        $request = $this
            ->getJson(route('user.index'), $this->getAuthHeaders())
            ->assertOk();

        $content = json_decode($request->getContent(), true);

        foreach ([
                     'data',
                     'links',
                     'meta',
                 ] as $field) {
            $this->assertArrayHasKey($field, $content);
        }

        foreach ([
                     'id',
                     'name',
                     'email',
                     'phone',
                     'created_at',
                 ] as $field) {
            $this->assertArrayHasKey($field, $content['data'][0]);
        }
    }
}
