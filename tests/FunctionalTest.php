<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FunctionalTest extends TestCase
{
    /**
     * Test all the methods on the Radios Controller
     */
    public function testRadiosController() {

        // test the home page (index) path
        $this->visit('/')
             ->see('Agora Radio Station App');

        // test the 'get_rock_radio_stations' path
        $this->visit('/radios/get_rock_radio_stations/dirble')
             ->see('Rock Stations from dirble');

        $this->visit('/radios/get_rock_radio_stations/last.fm')
             ->see('Rock Stations from last.fm');        

        // should get a 404 error
        $this->call('GET', '/radios/get_rock_radio_stations');
        $this->assertResponseStatus(404);
    }
}
