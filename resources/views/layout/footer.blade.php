</div>
<footer class="m-grid__item	m-footer " style="bottom:0; position:relative; display: none;">
<div class="m-container m-container--fluid m-container--full-height m-page__container">
	<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
		<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
			<span class="m-footer__copyright">
				{{date('Y')}} ©
				<a href="#" class="m-link">
					Video Transcoding
				</a>
			</span>
		</div>
	</div>
</div>
</footer>

<!-- begin::Scroll Top -->
<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
	<i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->		    <!-- begin::Quick Nav -->
	<!-- <ul class="m-nav-sticky" style="margin-top: 30px;">

		<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Showcase" data-placement="left">
			<a href="">
				<i class="la la-eye"></i>
			</a>
		</li>
		<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Pre-sale Chat" data-placement="left">
			<a href="" >
				<i class="la la-comments-o"></i>
			</a>
		</li>

		<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Purchase" data-placement="left">
			<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank">
				<i class="la la-cart-arrow-down"></i>
			</a>
		</li>
		<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Documentation" data-placement="left">
			<a href="https://keenthemes.com/metronic/documentation.html" target="_blank">
				<i class="la la-code-fork"></i>
			</a>
		</li>
		<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Support" data-placement="left">
			<a href="https://keenthemes.com/forums/forum/support/metronic5/" target="_blank">
				<i class="la la-life-ring"></i>
			</a>
		</li>
	</ul> -->
<!-- begin::Quick Nav -->
<!--begin::Base Scripts -->
<script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--begin::Page Vendors -->
<script src="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Snippets -->
<script src="{{ asset('assets/app/js/dashboard.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app/js/bootbox.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app/js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<!--end::Page Snippets -->
<script src="{{ asset('assets/select2/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

<script>
	jQuery(document).ready(function() {
	//Metronic.init(); // init metronic core components
	//Layout.init(); // init current layout
	bootbox.init();
		if ($().select2) {
            $('.select2me').select2({
                placeholder: "Select",
                allowClear: true
            });
        }
	});

	$(document).on('click','a.confirm',function(e){
		var link = $(this).attr("href");
		e.preventDefault();
		bootbox.confirm($(this).attr('confirm-text'), function(confirmed) {
		if(confirmed)
		document.location.href = link;
		});
	});

	function getFormattedDate() {
		var date = new Date();
		var str = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + " " +  date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
		return str;
	}


    $("select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);

        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
</script>

</body>
</html>