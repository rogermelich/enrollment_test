<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PdfTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * tests User at converted the pdf
     *
     * @return void
     */
    public function test_user_at_converted_to_pdf_correctly()
    {
        $this->createUsers(25);


        $this->browse(function (Browser $browser) {
            $browser->visit('/users/pdf')
                    ->assertSee('todo');
        });
    }

    /**
     * tests Users at converted the pdf
     *
     * @return void
     */
    public function test_users_at_converted_to_pdf_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/pdf/1');
        });
    }

    public function createUsers($num = null)
    {
        factory(User::class, $num)->create();
    }
}
