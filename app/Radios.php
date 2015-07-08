<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Radios extends Model
{
	/**
	 * Method to get an array of rock channels from dirble
	 */
    public static function get_dirble_rock_stations() 
    {

    	$api_key = config('app.api_key_dirble');

		$client = new \GuzzleHttp\Client();
		$res = $client->get(
			'http://api.dirble.com/v2/categories/primary', 
			['query' => 
				['token' => $api_key]
			]);

		if ($res->getStatusCode() != 200) {
			return false;
		}

		$channels = json_decode((string)$res->getBody());

		if ($channels == NULL) {
			return false;
		}

		// rock channel ID
		$rock_channel_id = NULL;
		foreach ($channels as $channel) {
			if (isset($channel->title) && ($channel->title == 'Rock')) {
				$rock_channel_id = $channel->id;
			}
		}

		// get all the stations
		$request_stations = $client->get(
			"http://api.dirble.com/v2/category/$rock_channel_id/stations", 
			['query' => 
				[
					'token' => $api_key,
					'per_page' => 5
				]
			]);

		if ($request_stations->getStatusCode() != 200) {
			return false;
		}

		$stations = json_decode((string)$request_stations->getBody());

		$rock_stations = array();

		if ($stations != NULL) {
			foreach ($stations as $rock_station) {
				$obj = new \stdClass;
				$obj->id = $rock_station->id;

				if (isset($rock_station->name)) {
					$obj->name = $rock_station->name;
				}	

				if (isset($rock_station->image->thumb->url)) {
					$obj->thumb_url = $rock_station->image->thumb->url;
				}				

				if (isset($rock_station->categories[0]->description)) {
					$obj->description = $rock_station->categories[0]->description;
				}				

				if (isset($rock_station->website)) {
					$obj->website = $rock_station->website;
				}

				$rock_stations[$rock_station->id] = $obj;
			}
		}

		return $rock_stations;
    }

    /**
     * Method to get an array of rock artists from last.fm
     */
    public static function get_lastfm_rock_stations() 
    {
    	$api_key = config('app.api_key_lastfm');

		$client = new \GuzzleHttp\Client();
		$res = $client->get(
			'http://ws.audioscrobbler.com/2.0', 
			['query' => 
				[
					'method' => 'tag.getTopArtists',
					'tag' => 'rock',
					'format' => 'json',
					'limit' => 5,
					'api_key' => $api_key
				]
			]);

		if ($res->getStatusCode() != 200) {
			return false;
		}

		$stations = json_decode((string)$res->getBody(), true);

		if ($stations == NULL) {
			return false;
		}

		$rock_stations = array();

		if ($stations != NULL && isset($stations['topartists']['artist'])) {
			foreach ($stations['topartists']['artist'] as $rock_station) {
				$obj = new \stdClass;
				$obj->id = md5($rock_station['mbid']);

				if (isset($rock_station['name'])) {
					$obj->name = $rock_station['name'];
				}	

				if (isset($rock_station['image'][2]['#text'])) {
					$obj->thumb_url = $rock_station['image'][2]['#text'];
				}				

				if (isset($rock_station['url'])) {
					$obj->website = $rock_station['url'];
				}

				$rock_stations[md5($rock_station['mbid'])] = $obj;
			}
		}

		return $rock_stations;
    }
}
