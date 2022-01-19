@extends('/admin/layout/base')

@section('body')
	<body class="main">
		@yield('content')

		<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
		<script src="{{ mix('admin/js/app.js') }}"></script>
        <link rel="stylesheet" href="https://use.typekit.net/rmq0uzv.css">

		@yield('script')
	</body>
@endsection
