<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<!-- <title>
		Safar | Dashboard
	</title> -->
	<meta name="description" content="Latest updates and statistic charts">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
      WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
      });
	</script>
	<!--end::Web font -->
    <!--begin::Base Styles -->  
    <!--begin::Page Vendors -->
	<link href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors -->
	<link href="{{ asset('assets/global/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/app/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/app/custom.css') }}" rel="stylesheet" type="text/css" />	<!--end::Base Styles -->
	<link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/select2/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="{{ asset('assets/demo/default/media/img/logo/favicon.ico') }}" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">

	@section('head')
	    <link rel="stylesheet" href="{{ url('/css/dropzone.css') }}">
	    <link rel="stylesheet" href="{{ url('/css/custom.css') }}">
	@endsection
	 
	@section('js')
	    <script src="{{ url('/js/jquery.js') }}"></script>
	    <script src="{{ url('/js/dropzone.js') }}"></script>
	    <script src="{{ url('/js/dropzone-config.js') }}"></script>
	@endsection
</head>