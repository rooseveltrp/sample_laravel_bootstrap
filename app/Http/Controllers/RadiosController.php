<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Radios as Radios;

class RadiosController extends Controller
{
    /**
     * Homepage
     */
    public function index()
    {
        $radios = array(
            "dirble",
            "last.fm",
        );
        return view('radios/index', ['radios' => $radios]);
    }

    /**
     * Method to load the rock stations from the chosen service
     */
    public function get_rock_radio_stations($station=null) {

        if (!isset($station) || empty($station)) {
            die("Radio station is required.");
        }

        switch ($station) {
            case "dirble":
                $rock_stations = Radios::get_dirble_rock_stations();
                break;
            case "last.fm":
                $rock_stations = Radios::get_lastfm_rock_stations();
                break;
            default:
                $rock_stations = array();
                break;
        }

        return view('radios/rock_stations', 
            [
                'radio_station' => $station,
                'rock_stations' => $rock_stations
            ]
        );
    }
}
