@extends('layouts.dashboard')

@section('content')
    <div class="bd bgc-white">
        <div class="layers">
            <div class="layer w-100 p-20">
                <h4 class="lh-1">The Brainiacs</h4>
            </div>
            <div class="layer w-100">
                <div class="bgc-light-blue-500 c-white p-15">
                    <div class="peers ai-c jc-sb gap-40">
                        <div class="peer peer-greed">
                            <h6>Team Leader: Kenneth Paul Cabrillas</h6>
                            <p class="mB-0">We are the brainiacs</p>
                        </div>
                        <div class="peer">
                            <h3 class="text-right">5</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive p-20">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class=" bdwT-0">Name</th>
                            <th class=" bdwT-0">Status</th>
                            <th class=" bdwT-0">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="fw-600">Item #1 Name</td>
                            <td><span class="badge bgc-red-50 c-red-700 p-10 lh-0 tt-c badge-pill">Unavailable</span> </td>
                            <td>Nov 18</td>
                        </tr>
                        <tr>
                            <td class="fw-600">Item #2 Name</td>
                            <td><span class="badge bgc-deep-purple-50 c-deep-purple-700 p-10 lh-0 tt-c badge-pill">New</span></td>
                            <td>Nov 19</td>
                        </tr>
                        <tr>
                            <td class="fw-600">Item #3 Name</td>
                            <td><span class="badge bgc-pink-50 c-pink-700 p-10 lh-0 tt-c badge-pill">New</span></td>
                            <td>Nov 20</td>
                        </tr>
                        <tr>
                            <td class="fw-600">Item #4 Name</td>
                            <td><span class="badge bgc-green-50 c-green-700 p-10 lh-0 tt-c badge-pill">Unavailable</span></td>
                            <td>Nov 21</td>
                        </tr>
                        <tr>
                            <td class="fw-600">Item #5 Name</td>
                            <td><span class="badge bgc-red-50 c-red-700 p-10 lh-0 tt-c badge-pill">New</span></td>
                            <td>Nov 22</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--<div class="ta-c bdT w-100 p-20">--}}
            {{--<a href="#">Check all the sales</a>--}}
        {{--</div>--}}
    </div>
@endsection
