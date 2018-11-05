@extends('layouts.dashboard')

@section('content')

    @if(Auth::user()->hasRole('titan'))
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-item  w-100">
                <div class="row gap-20">
                    <!-- #Total Emp ==================== -->
                    <div class='col-md-3'>
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Total Employees</h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer peer-greed">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">{{$active_employees}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- #Total Resigned ==================== -->
                    <div class='col-md-3'>
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">No. of Resigned Employee</h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer peer-greed">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">{{$resigned_employees}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- # Regular ==================== -->
                    <div class='col-md-3'>
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">No. of Regular Employee</h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer peer-greed">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">{{$regular_employees}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- #Total Project-based ==================== -->
                    <div class='col-md-3'>
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">No. of Project-based</h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer peer-greed">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">{{$project_employees}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="masonry-item col-12">
                <!-- #Site Visits ==================== -->
                <div class="bd bgc-white">
                    <div class="peers fxw-nw@lg+ ai-s">
                        <div class="peer peer-greed w-60p@lg+ w-100@lg-">
                            <div class="layers">
                                <div class="layer w-100 mB-10 bdB p-20">
                                    <h6 class="lh-1" style="font-size: large">Upcoming</h6>
                                </div>
                                <div class="layer w-100 p-20">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <h6 style="font-size: small">HR Interview</h6>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-deep-purple-50 c-deep-purple-700 ml-1">3</span>
                                                </div>
                                            </div>
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <h6 style="font-size: small">Tech Interview</h6>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-deep-purple-50 c-deep-purple-700 ml-1">7</span>
                                                </div>
                                            </div>
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <h6 style="font-size: small">Job Offer</h6>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-deep-purple-50 c-deep-purple-700 ml-1">5</span>
                                                </div>
                                            </div>
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <h6 style="font-size: small">On-boarding</h6>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-deep-purple-50 c-deep-purple-700 ml-1">3</span>
                                                </div>
                                            </div>
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <h6 style="font-size: small">Leaves</h6>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-deep-purple-50 c-deep-purple-700 ml-1">6</span>
                                                </div>
                                            </div>
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <h6 style="font-size: small">Exit Interview</h6>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-deep-purple-50 c-deep-purple-700 ml-1">2</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <h6 style="font-size: small">Birthday</h6>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-blue-50 c-deep-purple-700 ml-1">4</span>
                                                </div>
                                            </div>
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <h6 style="font-size: small">Service Anniversary</h6>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-blue-50 c-deep-purple-700 ml-1">4</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <h6 style="font-size: small">Performance Evaluation</h6>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-red-50 c-deep-purple-700 ml-1">6</span>
                                                </div>
                                            </div>
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <h6 style="font-size: small">End of Contract</h6>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-red-50 c-deep-purple-700 ml-1">4</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="peer bdL w-40p@lg+ w-100p@lg- ">
                            <div class="layers ">
                                <ul class="nav" style="text-align: center!important;">
                                    <li class="nav-item">
                                        <a href="#event" class="nav-link c-grey-800 cH-blue-500 active" id="event-tab"
                                           data-toggle="tab" role="tab" aria-controls="event" aria-selected="true">
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <small><strong>EVENT</strong></small>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-deep-purple-50 c-deep-purple-700 ml-1">3</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#news" class="nav-link c-grey-800 cH-blue-500 active" id="news-tab"
                                           data-toggle="tab" role="tab" aria-controls="news" aria-selected="true">
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <small><strong>NEWS</strong></small>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-green-50 c-deep-purple-700 ml-1">4</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#memos" class="nav-link c-grey-800 cH-blue-500 active" id="memos-tab"
                                           data-toggle="tab" role="tab" aria-controls="memos" aria-selected="true">
                                            <div class="peers ai-c jc-sb">
                                                <div class="peer peer-greed">
                                                    <small><strong>MEMOS</strong></small>
                                                </div>
                                                <div class="peer">
                                                    <span class="badge badge-pill bgc-red-50 c-deep-purple-700 ml-1">1</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                                <div class="tab-content profile-content w-100">
                                    <div class="tab-pane fade show active profile-info" id="event" role="tabpanel"
                                         aria-labelledby="event-tab">
                                        <div class="bd m-10 mT-0 p-10">
                                            <div class="row">
                                                <div class="col-md">
                                                    <span><strong>Thanks Giving 2018</strong></span><br>
                                                    <span>Dec 23, 2019 to Dec 23, 2018</span><br>
                                                    <span>Lorem ipsum dolor sit amet.</span><br>
                                                    <span>Lorem ipsum dolor sit amet, consectetur...</span><br>
                                                    <span><a href="#"><small>View more</small></a></span>

                                                </div>
                                                <div class="col-md-4">
                                                    <div style="height: 80px; background: lightgray;"></div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md">
                                                    <span><strong>Summer Outing 2019</strong></span><br>
                                                    <span>May 27, 2019 to May 30, 2019</span><br>
                                                    <span>The Mansion, El Nido, Palawan</span><br>
                                                    <span>Please bring your own sandals, towels, toiletries etc..</span><br>
                                                    <span><a href="#"><small>View more</small></a></span>

                                                </div>
                                                <div class="col-md-4">
                                                    <div style="height: 80px; background: lightgray"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade profile-info" id="news" role="tabpanel"
                                         aria-labelledby="news-tab">
                                        aa
                                    </div>
                                    <div class="tab-pane fade profile-info" id="memos" role="tabpanel"
                                         aria-labelledby="memos-tab">
                                        gg
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                Regular Emp Dashboard
            </div>
        </div>
    @endif

@endsection
{{--<div class="card-body">--}}
{{--<div class="row">--}}
{{--<div class="col">--}}
{{--<div class="card">--}}
{{--<div class="card-body">--}}
{{--Total Employees--}}
{{--<hr>--}}
{{--<h3>{{$active_employees}}</h3>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}
{{--<div class="col">--}}
{{--<div class="card">--}}
{{--<div class="card-body">--}}
{{--No. of Resigned Employee--}}
{{--<hr>--}}
{{--<h3>{{$resigned_employees}}</h3>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}
{{--<div class="col">--}}
{{--<div class="card">--}}
{{--<div class="card-body">--}}
{{--No. of Regular Employee--}}
{{--<hr>--}}
{{--<h3>{{$regular_employees}}</h3>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}
{{--<div class="col">--}}
{{--<div class="card">--}}
{{--<div class="card-body">--}}
{{--No. of Project-based--}}
{{--<hr>--}}
{{--<h3>{{$project_employees}}</h3>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}