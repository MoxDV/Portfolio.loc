<?php

namespace Tests\Browser;

use Portfolio\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class AuthTest
 * @package Tests\Browser
 *
 * Класс для теста систымы утентификации и регистрации.
 */
class AuthTest extends DuskTestCase {
    use DatabaseMigrations;

    /**
     * Тест авторизации пользователя.
     */
    public function testLogin(){
        $userAct = factory(User::class)->create();
        $userNotAct1 = factory(User::class)->create(['status' => 0 ]);
        $userNotAct2 = factory(User::class)->create(['status' => 2 ]);

        $this->browse(function (Browser $browser)
        use ($userAct, $userNotAct1, $userNotAct2){
            $browser->visit('/login')
                ->pause(0000);
            // Тестирование с незаполненными данными.
            $browser->clickLink('Вход')
                ->assertPathIs('/login');

            // Тестирование с неточными данными.
            $browser
                ->type('email', $userAct->email)
                ->type('password', 'test123')
                ->clickLink('Вход');
            $browser
                ->assertPathIs('/login');

            // Тестирование аутентификации не активированного пользователя
            $browser
                ->type('email', $userNotAct1->email)
                ->type('password', 'secret')
                ->clickLink('Вход');
            $browser
                ->assertPathIs('/login');

            // Тестирование аутентификации деактивированного пользователя
            $browser
                ->type('email', $userNotAct2->email)
                ->type('password', 'secret')
                ->clickLink('Вход');
            $browser
                ->assertPathIs('/login');

            // Тестирование аутентификации активированного пользователя
            $browser
                ->type('email', $userAct->email)
                ->type('password', 'secret')
                ->clickLink('Вход');
            $browser
                ->assertPathIs('/home');

            // Тестирование аутентификации зарегистрированного пользователя
            /*$browser->visit('/login')
                ->assertPathIs('/');*/
        });
    }
}
