@extends('master')
@section('dashboard')

<div class="page-wrapper">
    <div class="page-container">

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">overview</h2>
                                <button class="au-btn au-btn-icon au-btn--blue">
                                    <i class="zmdi zmdi-plus"></i>add item</button>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-25">
                        <div class="col-sm-6 col-lg-12">
                            <a href="{{ route('students.get_students') }}" style="text-decoration: none; display: block;">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ $stdcount }}</h2>
                                                <span>Total Students</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2025 Colorlib. All rights reserved. Template by <a
                                        href="https://colorlib.com" rel="nofollow" target="_blank">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

@endsection