<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

		<style type="text/css">
			.formset-cont {
				width: 70%; 
				margin: 0 auto; 
				margin-top: 90px;
			}
			.formset-cont .formset-header {
				background-color: #17A589;
				padding: 20px 0px;
			}
			.formset-cont .formset-header h3 {
				color: #FFF;
			}
			.formset-cont .formset-info {
				padding: 20px 0px 0px 0px;
			}
			.formset-cont .formset-fieldnav {
				padding: 20px 0px;
			}

		</style>
  		<title>Formset</title>
	</head>
	<body>
		<div class="container-fluid formset-cont">
			@yield('content')
		</div>
	</body>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
	@yield('script')
</html>