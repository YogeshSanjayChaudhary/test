@include('layout.header')
<link href="https://vjs.zencdn.net/7.7.5/video-js.css" rel="stylesheet" />

<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
<script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src="https://vjs.zencdn.net/7.7.5/video.js"></script>
<script src="https://cdn.jsdelivr.net/npm/videojs-contrib-eme@3.7.0/dist/videojs-contrib-eme.min.js"></script>

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        @include('layout.topnavbar')
        @include('layout.sidebar')
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator">
                            Channel
                        </h3>
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                            <li class="m-nav__item m-nav__item--home">
                                <a href="{{ asset('/') }}" class="m-nav__link m-nav__link--icon">
                                    <i class="m-nav__link-icon la la-home"></i>
                                </a>
                            </li>
                            <li class="m-nav__separator">
                                -
                            </li>
                            <li class="m-nav__item">
                                <a href="{{ asset('class') }}" class="m-nav__link">
                                    <span class="m-nav__link-text">
                                        Channel
                                    </span>
                                </a>
                            </li>
                            <li class="m-nav__separator">
                                -
                            </li>
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
                                    <span class="m-nav__link-text">
                                        Add Channel
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- END: Subheader -->
            <div class="m-content">

                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(Session::get('success'))
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <span> {{Session::get('success')}} </span>
                </div>
                @endif
                @if(Session::get('error'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> {{Session::get('error')}} </span>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <!--begin::Portlet-->
                        <div class="m-portlet m-portlet--tab">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon m--hide">
                                            <i class="la la-gear"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">
                                            Add Channel
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <!--begin::Form-->
                            <form action="{{ asset('channel/add') }}" method="post" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="m-portlet__body">

                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Stream Server</label>
                                        <div class="col-5">
                                            <select id="channel_id" name="channel_id" class="form-control m-input">
                                                <option value="">Select Stream Server</option>
                                        @foreach($streams as $key => $stream)
                                            <option rel="{{$stream->channel_url}}" {{(Request::old('id') == $stream->id) ? 'selected' : ''}} value="{{$stream->id}}">{{$stream->channel_name}}</option>
                                        @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Stream Url</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control m-input" placeholder="Enter Video Url" id="video_url" name="video_url" value="{{Request::old('video_url')}}" readonly>
                                        </div>
                                    </div>


                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Stream Key</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control m-input" placeholder="Enter Video Key" id="class_key" name="class_key" value="{{ md5(time()) }}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Channel Name</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control m-input" placeholder="Enter Channel Name" id="class_name" name="class_name" value="{{Request::old('class_name')}}">
                                        </div>
                                    </div>


                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Status</label>
                                        <div class="col-5">
                                            <select id="status" name="status" class="form-control m-input">
                                                <option value="">Select Status</option>
                                                <option value="active" {{(Request::old('status') == 'active') ? 'selected' : ''}} selected>Active</option>
                                                <option value="inactive" {{(Request::old('status') == 'inactive') ? 'selected' : ''}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-10">
                                                <button type="submit" class="btn btn-success">
                                                    Submit
                                                </button>
                                                <button type="button" class="btn btn-secondary" onclick="window.open('{{ asset('channel') }}','_self')">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end::Portlet-->
                    </div>
                </div>
            </div>
        </div>
        @include('layout.footer')
        <script>
		$("#channel_id").change(function(){
			$("#video_url").val($(this).children("option:selected").attr("rel"));
		});

        </script>
