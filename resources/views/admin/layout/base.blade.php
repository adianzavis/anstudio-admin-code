<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
	<meta charset="utf-8">
	<link href="{{ asset('admin/images/logo.svg') }}" rel="shortcut icon">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Development/Desgin agenture anstudio">
	<meta name="keywords" content="Development/Desgin agenture anstudio">
	<meta name="author" content="anstudio">
	@yield('head')
	<link rel="stylesheet" href="{{ mix('admin/css/app.css') }}" />
</head>

@yield('body')

</html>
