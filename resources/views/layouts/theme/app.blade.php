<!DOCTYPE html>
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>..:: Lyons Rest ::.. | </title>

    @include('layouts.theme.styles')


</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
                
				@include('layouts.theme.sidebar')
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				@include('layouts.theme.header')
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					
                    @yield('content')


				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			    @include('layouts.theme.footer')
			<!-- /footer content -->
		</div>
	</div>

	@include('layouts.theme.scripts')

</body></html>
