@extends('layouts.dashboard')

@section('content')

    <div class="full-container">
        <div class="remain-height pos-r scrollable">
            <div class="bgc-light-blue-500 c-white p-15">
                <div class="peers ai-c jc-sb gap-40">
                    <div class="peer peer-greed">
                        <h5 class="lh-1">{{$emp->first()->team(Auth::user())}}</h5>

                    </div>
                    <div class="peer">
                        <h6>Supervisor: {{$emp->first()->reportingTo()}}</h6>
                    </div>
                </div>
            </div>
            <div class="bgc-white bdrs-3 ">
                <table id="employee-list" class="table bdT table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class=" bdwT-0">Name</th>
                        <th class=" bdwT-0">Status</th>
                        <th class=" bdwT-0">Position</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class=" bdwT-0">Name</th>
                        <th class=" bdwT-0">Status</th>
                        <th class=" bdwT-0">Position</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($emp as $employee)
                        @if($employee->user->roles->first()->pivot->team_id === $user_team_id)
                            <tr>
                                <td class="pl-5">{{$employee->fullName}}</td>
                                <td>
                                    <span class="badge {{$employee->contract->first()->status=== 'Resigned' ? 'bgc-red-50 c-red-700' :'bgc-green-50 c-green-700'}} p-10 lh-0 tt-c badge-pill">{{$employee->contract->first()->status}}</span>
                                </td>
                                <td>{{$employee->contract->first()->position}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{--<div class="bd bgc-white">--}}
    {{--<div class="layers">--}}
    {{--<div class="layer w-100">--}}
    {{--<div class="bgc-light-blue-500 c-white p-15">--}}
    {{--<div class="peers ai-c jc-sb gap-40">--}}
    {{--<div class="peer peer-greed">--}}
    {{--<h5 class="lh-1">{{$emp->first()->team(Auth::user())}}</h5>--}}

    {{--</div>--}}
    {{--<div class="peer">--}}
    {{--<h6>Supervisor: {{$emp->first()->reportingTo()}}</h6>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="table-responsive">--}}
    {{--<table class="table">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<th class=" bdwT-0">Name</th>--}}
    {{--<th class=" bdwT-0">Status</th>--}}
    {{--<th class=" bdwT-0">Date</th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach ($emp as $employee)--}}
    {{--@if($employee->user->roles->first()->pivot->team_id === $user_team_id)--}}
    {{--<tr>--}}
    {{--<td class="fw-600">{{$employee->fullName}}</td>--}}
    {{--<td>--}}
    {{--<span class="badge bgc-red-50 c-red-700 p-10 lh-0 tt-c badge-pill">Unavailable</span>--}}
    {{--</td>--}}
    {{--<td>Nov 18</td>--}}
    {{--</tr>--}}
    {{--@endif--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="ta-c bdT w-100 p-20">--}}
    {{--<a href="#">Check all the sales</a>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection
