<!DOCTYPE html>
<html lang="{{ $langcode }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ $title }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ serverName }}/bitnameagencyframework/admin/themes/default/favicon.ico">
    <link rel="icon" href="{{ serverName }}/bitnameagencyframework/admin/themes/default/favicon.ico" type="image/x-icon">
	
    <!-- Toggles CSS -->
    <link href="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
	
	<!-- Toastr CSS -->
    <link href="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

	
	@php	
	echo hookSystem::do_action("boardmeta");
	@endphp
	
    <!-- Custom CSS -->
    <link href="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/css/style.css" rel="stylesheet" type="text/css">


	
</head>
