<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ManageIndividualClientTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(10))
                    ->visit(route('clients.index'))
                    // ->press('Filter')
                    // ->press('Submit')
                    ->assertSee('Manage Individual Clients');
        });
    }
}
