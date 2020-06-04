@include('layout.header')
<link href="https://vjs.zencdn.net/7.7.5/video-js.css" rel="stylesheet" />

<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
<script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src="https://vjs.zencdn.net/7.7.5/video.js"></script>
<script src="https://cdn.jsdelivr.net/npm/videojs-contrib-eme@3.7.0/dist/videojs-contrib-eme.min.js"></script>

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		@include('layout.topnavbar') @include('layout.sidebar')
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
								<a href="#" class="m-nav__link">
									<span class="m-nav__link-text">
										Channel List
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- END: Subheader -->

			<div class="m-content">

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

				<div class="m-portlet m-portlet--mobile">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Channel
								</h3>
							</div>
						</div>

						<div class="m-portlet__head-tools">
							<a href="{{ asset('channel/add') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
								<span>
									Add Channel
								</span>
							</a>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6">
								<form action="{{asset('content/search')}}" method="post" id="search_course" name="search_course" class="form-horizontal">
									<input name="_token" value="{{ csrf_token() }}" type="hidden">
									<div class="row" style="padding-bottom: 10px;">
										<label class="col-md-2 control-label" style="margin-top:7px;">Search </label>
										<div class="col-md-6">
											<input type="text" name="search_text" class="form-control" value="{{Request::old('search_text',$search_text)}}" />
										</div>

										<div class="col-md-1">
											<button type="submit" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" id="search">Search</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data">
							<table class="m-datatable__table" style="display: block; min-height: 300px; overflow-x: auto;">
								<thead class="m-datatable__head">
									<tr class="m-datatable__row">
										<th data-field="OrderID" class="m-datatable__cell m-datatable__cell--sort">
											<span style="width: 110px;">#</span>
										</th>
										<th data-field="ShipName" class="m-datatable__cell m-datatable__cell--sort">
											<span style="width: 110px;">Channel Name</span>
										</th>
										<th data-field="ShipName" class="m-datatable__cell m-datatable__cell--sort">
											<span style="width: 110px;">Channel Url</span>
										</th>
										<th data-field="ShipName" class="m-datatable__cell m-datatable__cell--sort">
											<span style="width: 110px;">Channel Key</span>
										</th>
										<th data-field="ShipName" class="m-datatable__cell m-datatable__cell--sort">
											<span style="width: 110px;">Status</span>
										</th>
										<th data-field="Actions" class="m-datatable__cell m-datatable__cell--sort">
											<span style="width: 110px;">Actions</span>
										</th>
									</tr>
								</thead>
								<tbody class="m-datatable__body">
									@foreach($channel as $a)
									<tr data-row="0" class="m-datatable__row">
										<td data-field="OrderID" class="m-datatable__cell">
											<span style="width: 110px;">{{$a->channel_id}}</span>
										</td>
										<td data-field="ShipName" class="m-datatable__cell">
											<span style="width: 110px;">{{$a->class_name}}</span>
										</td>
										<td data-field="ShipName" class="m-datatable__cell">
											<span style="width: 110px;">{{$a->channel_master->channel_url}}</span>
										</td>
										<td data-field="ShipName" class="m-datatable__cell">
											<span style="width: 110px;">{{$a->class_key}}</span>
										</td>
										<td data-field="ShipName" class="m-datatable__cell">
											<span style="width: 110px;">{{ucfirst($a->status)}}</span>
										</td>

										<td data-field="Actions" class="m-datatable__cell">
											<span style="overflow: visible; width: 110px;">
												<a href="{{ asset('channel/edit/'.$a->id.'/'.$channel->currentPage()) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
													<i class="la la-edit"></i>
												</a>
												<a href="javascript:;" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill preview-btn" title="View" data-url="{{ 'http://3.6.215.234/hls/'.$a->class_key.'.m3u8'}}">
													<i class="la la-eye"></i>
												</a>
												<a href="{{ asset('channel/delete/'.$a->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill tooltips confirm" confirm-text="Are You Sure?" data-placement="top" data-original-title="Delete">
													<i class="la la-trash"></i>
												</a>
											</span>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="text-center custom-paggination">
						{!!$channel->appends(\Request::except('page'))->render()!!}
					</div>
				</div>
			</div>
			<!--begin::Modal-->
			<div class="modal fade" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">
								Preview
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">
									&times;
								</span>
							</button>
						</div>
						<div class="modal-body">
							<video style="width:100%" id="my-video" class="video-js" controls preload="auto" width="640" height="264" data-setup='{" controls": true, "autoplay" : false, "preload" : "auto" }'></video>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">
								Close
							</button>
						</div>
					</div>
				</div>
			</div>
			<!--end::Modal-->
		</div>
	</div>
	@include('layout.footer')
	<script type="text/javascript">
			var player = videojs('my-video');
			player.eme();
		$(document).on("click", ".preview-btn", function() {
			player.src({
				src: $(this).data('url'),
				type: 'application/x-mpegURL'
			});
			player.play();
			$("#preview-modal").modal('show');
		});

		$(document).on("click", ".close, .close-btn", function() {
			player.pause();
		});
	</script>
