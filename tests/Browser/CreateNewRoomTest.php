<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateNewRoomTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::find(10))
                ->visit(route('rooms.index'))
                ->press('New Room')
                ->pause(1000)
                /* ->whenAvailable('.modal', function ($modal) {
                    $modal
                        ->assertSee('ADD NEW ROOM')
                        ->typeSlowly('branch', 'Mirpur 13')
                        ->type('room_no', '506')
                        ->press('Submit')
                        ->assertSee('Rooms');
                }); */
                // ->screenshot('new-room-page')
                // ->assertSee('ADD NEW ROOM');
                // ->typeSlowly('branch', 'Mirpur 13')
                // ->type('room_no', '506')
                ->press('Submit');
                // ->assertSee('Rooms');
        });
    }
}
