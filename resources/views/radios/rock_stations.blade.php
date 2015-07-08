<h2>
	Rock Stations from {{ $radio_station }}
</h2>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	@foreach ($rock_stations as $rock_station)
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="rock_station_{{ $rock_station->id }}">
				<h4 class="panel-title">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#rock_station_collapse_{{ $rock_station->id }}" aria-expanded="true" aria-controls="rock_station_collapse_{{ $rock_station->id }}">
					{{ $rock_station->name }}
				</a>
      			</h4>
    		</div>
    		<div id="rock_station_collapse_{{ $rock_station->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="rock_station_{{ $rock_station->id }}">
      			<div class="panel-body">

					@if (isset($rock_station->thumb_url))
					    <img src="{{ $rock_station->thumb_url }}" alt="{{ $rock_station->name }}">
					@endif

					@if (isset($rock_station->description))
					    {{ $rock_station->description }}
					@endif

					@if (isset($rock_station->website))
					    <a href="{{ $rock_station->website }}" target="_blank">{{ $rock_station->website }}</a>
					@endif		
        			
      			</div>
    		</div>
  		</div>
	@endforeach
</div>