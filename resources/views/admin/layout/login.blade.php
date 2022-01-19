@extends('/admin/layout/base')

@section('body')
	<body class="login">
		@yield('content')

		<script src="{{ mix('admin/js/app.js') }}"></script>

		@yield('script')
	</body>
@endsection
