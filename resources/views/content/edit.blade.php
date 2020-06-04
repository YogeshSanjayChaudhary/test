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
                            Content
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
                                        Content
                                    </span>
                                </a>
                            </li>
                            <li class="m-nav__separator">
                                -
                            </li>
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
                                    <span class="m-nav__link-text">
                                        Edit Content
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
                                            Edit Content
                                    </div>
                                </div>
                            </div>
                            <!--begin::Form-->
                            <form action="{{ asset('content/edit/'.$content->id) }}" method="post" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="last_page" value="{{Request::old('last_page',$last_page)}}">

                                <div class="m-portlet__body">

                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Content Name</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control m-input" placeholder="Enter Content Name" id="content_id" name="content_id" value="{{$content->content_id}}">
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Description</label>
                                        <div class="col-5">
                                            <textarea class="form-control m-input" placeholder="Enter Content Description" id="content_description" name="content_description">{{$content->content_description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Video Url</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control m-input" placeholder="Enter Video Url" id="video_url" name="video_url" value="{{Request::old('video_url', $content->video_url)}}">
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Video Key</label>
                                        <div class="col-5">
                                            <input type="text" class="form-control m-input" placeholder="Enter Video Key" id="video_key" name="video_key" value="{{Request::old('video_key', $content->video_key)}}">
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Preview</label>
                                        <div class="col-5">
                                            <div id="myElement"></div>
                                            <video id="my-video" class="video-js" controls preload="auto" width="640" height="264" data-setup='{" controls": true, "autoplay" : false, "preload" : "auto" }'></video>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Status</label>
                                        <div class="col-5">
                                            <select id="status" name="status" class="form-control m-input">
                                                <option value="">Select Status</option>
                                                <option value="active" {{($content->status == 'active') ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{($content->status == 'inactive') ? 'selected' : ''}}>Inactive</option>
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
                                                    Save
                                                </button>
                                                <a class="btn btn-secondary" href="{{ url('content') }}">
                                                    Cancel
                                                </a>
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
            var player = videojs('my-video');
            player.eme();
            updateVideoSrc();

            $(document).on("change", "#video_url", function() {
                updateVideoSrc();
            });

            $(document).on("change", "#video_key", function() {
                updateVideoSrc();
            });

            function updateVideoSrc() {
                if ($('#video_url').val() && $('#video_key').val()) {
                    player.src({
                        src: $('#video_url').val(),
                        type: 'application/dash+xml',
                        keySystems: {
                            'com.widevine.alpha': 'https://mediar.keydelivery.centralindia.media.azure.net/Widevine/?kid=' + $('#video_key').val(),
                        }
                    });
                    $('#my-video').show();
                } else {
                    $('#my-video').hide();
                }
            }
        </script>
