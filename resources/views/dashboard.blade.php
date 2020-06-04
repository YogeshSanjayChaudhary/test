@include('layout.header')
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" style="">
    <style type="text/css">

        .col-lg-3 {
            flex: 0 0 25%;
            max-width: 25%;

        }
                .dashboard-stat.blue {
            background-color: #3598dc;
        }

        .dashboard-stat {
            display: block;
            margin-bottom: 25px;
            overflow: hidden;
            border-radius: 4px;
        }

        a {
            text-shadow: none;
            color: #337ab7;
        }

        *, ::after, ::before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .dashboard-stat.dashboard-stat-v2 .visual {
            padding-top: 35px;
            margin-bottom: 40px;
        }

        .dashboard-stat .visual {
            width: 80px;
            height: 80px;
            display: block;
            float: left;
            padding-top: 10px;
            padding-left: 15px;
            margin-bottom: 15px;
            font-size: 35px;
            line-height: 35px;
        }

        a {
            text-shadow: none;
            color: #337ab7;
        }

        .dashboard-stat.blue .visual > i {
            color: #FFF;
            opacity: .1;
            filter: alpha(opacity=10);
        }

        .dashboard-stat .visual > i {
            margin-left: -35px;
            font-size: 110px;
            line-height: 110px;
        }

        [class*=" fa-"]:not(.fa-stack), [class*=" glyphicon-"], [class*=" icon-"], [class^="fa-"]:not(.fa-stack), [class^="glyphicon-"], [class^="icon-"] {
            display: inline-block;
            line-height: 14px;
            -webkit-font-smoothing: antialiased;
        }

        .fa {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
                font-size: 14px;
                line-height: 1;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        *, ::after, ::before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .dashboard-stat .details {
            position: absolute;
            right: 15px;
            padding-right: 15px;
        }

        .dashboard-stat.blue .details .number, .dashboard-stat.red .details .number, .dashboard-stat.green .details .number {
            color: #FFF;
        }

        .dashboard-stat .details .number {
            padding-top: 25px;
            text-align: right;
            font-size: 34px;
            line-height: 36px;
            letter-spacing: -1px;
            margin-bottom: 0;
            font-weight: 300;
        }

        .dashboard-stat.blue .details .desc, .dashboard-stat.red .details .desc, .dashboard-stat.green .details .desc {
            color: #FFF;
            opacity: 1;
            filter: alpha(opacity=100);
        }

        .dashboard-stat .details .desc {
            text-align: right;
            font-size: 16px;
            letter-spacing: 0;
            font-weight: 300;
        }

        .dashboard-stat::after {
            clear: both;
        }

        .dashboard-stat::after, .dashboard-stat::before {
            content: " ";
            display: table;
        }

        .dashboard-stat.red {
            background-color: #e7505a;
        }

        .dashboard-stat.green {
            background-color: #32c5d2;
        }

        .dashboard-stat .visual > i {
            margin-left: -35px;
            font-size: 110px;
            line-height: 110px;
        }

        .dashboard-stat.red .visual > i, .dashboard-stat.green .visual > i {
            color: #FFF;
            opacity: .1;
            filter: alpha(opacity=10);
        }

    </style>
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
@include('layout.topnavbar')
@include('layout.sidebar')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">
                        Dashboard
                    </h3>
                </div>
            </div>

           <!--  <h5 style="margin-top: 20px;">All Stats</h5>

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                        <div class="visual">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="123">123</span>
                            </div>
                            <div class="desc"> Total Subscription </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                        <div class="visual">
                            <i class="flaticon-coins"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="12345">12345</div>
                            <div class="desc"> Payment </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                        <div class="visual">
                            <i class="flaticon-open-box"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="98">98</span>
                            </div>
                            <div class="desc"> XYZ </div>
                        </div>
                    </a>
                </div>
            </div> -->


        </div>
    </div>
@include('layout.footer')
<script type="text/javascript">
   // setTimeout(function(){
   //     location.reload();
   // },10000);
</script>