<?php

namespace Tests\Unit;

use Portfolio\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase {
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser() {
        $user = factory(User::class)->create([
            'email' => 'test@mail.ru',
        ]);
        $this->assertEquals('test@mail.ru', $user->email);
        $this->assertEquals('1', $user->status);

        factory(User::class, 3)->create();

        $users = User::get();

        $this->assertEquals(4, $user->count());
    }
}
