<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Radios as Radios;

class RadioTest extends TestCase
{
    /**
     * Test the method that grabs the rock stations from dirble
     */
    public function testGetDirbleRockStations()
    {
        $result = Radios::get_dirble_rock_stations();
        $this->assertTrue((bool)$result);
        $this->assertEquals(5, count($result));
    }

    /**
     * Test the method that grabs the rock stations from lastfm
     */
    public function testGetLastfmRockStations()
    {
        $result = Radios::get_lastfm_rock_stations();
        $this->assertTrue((bool)$result);
        $this->assertEquals(5, count($result));
    }
}
