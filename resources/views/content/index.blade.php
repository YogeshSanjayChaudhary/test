@include('layout.header')

<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->


		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		<script src="//imasdk.googleapis.com/js/sdkloader/ima3_debug.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/shaka-player/2.5.9/shaka-player.compiled.js" type="text/javascript"></script>

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
								<a href="#" class="m-nav__link">
									<span class="m-nav__link-text">
										Content
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
									Content
								</h3>
							</div>
						</div>

						<div class="m-portlet__head-tools">
							<a href="{{ asset('content/add') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
								<span>
									Add Content
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
											<span style="width: 110px;">Name</span>
										</th>
										<th data-field="ShipName" class="m-datatable__cell m-datatable__cell--sort">
											<span style="width: 110px;">Content</span>
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
									@foreach($content as $a)
									<tr data-row="0" class="m-datatable__row">
										<td data-field="OrderID" class="m-datatable__cell">
											<span style="width: 110px;">{{$a->id}}</span>
										</td>
										<td data-field="ShipName" class="m-datatable__cell">
											<span style="width: 110px;">{{$a->content_description}}</span>
										</td>
										<td data-field="ShipName" class="m-datatable__cell">
											<span style="width: 110px;">{{$a->video_url}}</span>
										</td>
										<td data-field="ShipName" class="m-datatable__cell">
											<span style="width: 110px;">{{ucfirst($a->status)}}</span>
										</td>

										<td data-field="Actions" class="m-datatable__cell">
											<span style="overflow: visible; width: 110px;">
												<a href="{{ asset('content/edit/'.$a->id.'/'.$content->currentPage()) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
													<i class="la la-edit"></i>
												</a>
												<a href="javascript:;" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill preview-btn" title="View" data-content="{{$a->content_token}}"  data-url="{{$a->destination_video}}" data-key="{{$a->video_key}}">
													<i class="la la-eye"></i>
												</a>
												<a href="{{ asset('content/delete/'.$a->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill tooltips confirm" confirm-text="Are You Sure?" data-placement="top" data-original-title="Delete">
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
						{!!$content->appends(\Request::except('page'))->render()!!}
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
<script>

    $('.preview-btn').click(function(){
			var keyid = 123;
			var kid = 123;
			  var manifestUri = $(this).data('url');
			if($(this).data('key')){
				keyid = $(this).data('key');
			}
			if($(this).data('content')){
				kid = $(this).data('content');
			}

    window.open('https://dti2.getwebwidget.com/player.php?keyid='+keyid+'&kid='+kid+'&url='+manifestUri, '_blank', 'width=600,height=700');
    return false;
    });
</script>

	@include('layout.footer')
	<script type="text/javascript">

		$(document).on("click1", ".preview-btn", function() {
		if (shaka.Player.isBrowserSupported()) {
			  var manifestUri = $(this).data('url');
			  shaka.polyfill.installAll();
			  var video = document.getElementById('my-video');
			  var shakaVideoPlayer = new shaka.Player(video);
			var keyid = 123;
			var kid = 123;
			if($(this).data('key')){
				keyid = $(this).data('key');
			}
			if($(this).data('content')){
				kid = $(this).data('content');
			}
			  window.shakaVideoPlayer = shakaVideoPlayer;
			  shakaVideoPlayer.configure({
				  drm: {
					//servers: { 'org.w3.clearkey': 'https://dogstrainingindia.com/key_url.php' }
					//servers: { 'org.w3.clearkey': '{"keys": [{"k": "hyN9IKGfWKdAwFaE5pm0qg", "kty": "oct", "kid": "oW5AK5BW43HzbTSKpiu3SQ" }], "type": "temporary"}' }
					clearKeys: {
						keyid : kid
		                           	}
				  }
				});
			  shakaVideoPlayer.load(manifestUri).then(function() {
			    console.log('The video has now been loaded!');
			  }).catch(onError);
			  //addEventListener(shakaVideoPlayer);
			//shakaVideoPlayer.play();
			$("#preview-modal").modal('show');
		} else {
		   	console.error('Browser not supported!');
		}
		});

		$(document).on("click", ".close, .close-btn", function() {
			//shakaVideoPlayer.pause();
		});




		function onErrorEvent(event) {
		  onError(event.detail);
		}

		function onError(error) {
		  console.log('Error code', error.code, 'object', error);
		}

		function addEventListener(shakaVideoPlayer){
			//shakaVideoPlayer.addEventListener('play', onPlay);
			//shakaVideoPlayer.addEventListener('playing', onPlaying);
			//shakaVideoPlayer.addEventListener('pause', onPause);
			//shakaVideoPlayer.addEventListener('ended', onEnded);
			//shakaVideoPlayer.addEventListener('seeked', onSeeked);
			//shakaVideoPlayer.addEventListener('seeking', onSeeking);
			//shakaVideoPlayer.addEventListener('waiting', onWaiting);
			//shakaVideoPlayer.addEventListener('error', onErrorEvent);
		}

	</script>
