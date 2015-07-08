<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agora Radio Station App</title>
	
	<!-- Load jQuery -->
	<script type="text/javascript" src='/js/libs/jquery-1.11.3.min.js'></script>

	<!-- Load blockUI Plugin -->
	<script type="text/javascript" src='/js/libs/jquery.blockUI.js'></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="/js/libs/bootstrap/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="/js/libs/bootstrap/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="/js/libs/bootstrap/js/bootstrap.min.js"></script>

	<!-- Custom styles for this template -->
	<link href="/css/jumbotron-narrow.css" rel="stylesheet">

</head>
<body>

	<div class="container">

		<div class="jumbotron">

			<h1>
				Select Your Radio Station
			</h1>

			<form>
			  <div class="form-group">
				<select class="form-control" id='radio_station' name='radio_station'>
					<option value="-1">-- Choose One --</option>
					@foreach ($radios as $radio)
					    <option value="{{ $radio }}">{{ $radio }}</option>
					@endforeach
				</select>
			  </div>
			</form>

			<div id="results"></div>

			<div>&copy; {{ date('Y') }} Roosevelt Purification.</div>

		</div>

	</div>

<script type="text/javascript">

$(document).ready(function(){

	// attach an on-event handler
	$("#radio_station").change(function(){
		var selected_value = $(this).val();
		if (selected_value == -1) {
			alert('Please choose a radio station.');
		} else {
			// show a loading screen
			$.blockUI({ message: '<p><h1>Please Wait...</h1></p><p><img src="/img/loading.gif" alt="Please Wait..."></p>' }); 

			// make an ajax call to laravel
			$.get('/radios/get_rock_radio_stations/' + selected_value, function(data) {
				$("#results").html(data);
				$(document).ajaxStop($.unblockUI);
			});
		}
	});

});

</script>

</body>
</html>