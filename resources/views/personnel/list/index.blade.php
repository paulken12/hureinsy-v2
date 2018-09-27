@extends('layouts.dashboard')

@section('content')
    <div class="full-container">
        <div class="remain-height pos-r scrollable">
            <div class="bgc-white bdrs-3 ">
                <table id="employee-list" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="text-center">Image</th>
                        <th>Name</th>
                        <th>Team</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="text-center">Image</th>
                        <th>Name</th>
                        <th>Team</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($employees as $employee)
                        @if($employee->isVerified($employee))
                            <tr>
                                <td class="text-center">
                                    <img class="bdrs-50p w-3r h-3r" alt="User Avatar"
                                         src="{{$employee->user->avatar_path}}">
                                </td>
                                <td>

                                    <div class="peer">
                                        <h6 class="c-grey-900 mB-5"><a href="{{$employee->path()}}">{{$employee->first_name . " " . $employee->last_name}}</a></h6>
                                        <div class="peer peer-greed">
                                            <i class="mR-10 ti-id-badge"></i>
                                            <span>{{$employee->company_id}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="peer">
                                        <p>My Team</p>
                                        <div class="peer peer-greed">
                                            <i class="mR-10 ti-id-badge"></i>
                                            <span>Active</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#"><span><i class="fa fa-print"></i> </span> <small> Print &nbsp;</small></a>
                                    <a href="#"><span><i class="fa fa-file-excel-o"></i></span> <small> Excel &nbsp;</small></a>

                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--<div class="full-container">--}}
        {{--<div class="profile-app">--}}
            {{--<div class="bgc-white">--}}
                {{--<div class="layers">--}}
                    {{--<div class="layer w-100">--}}
                        {{--<div class="layer w-100">--}}
                            {{--@foreach ($employees as $employee)--}}
                                {{--<div class="profile-list-item peers fxw-nw pY-10 pX-20 bdB bgcH-grey-100 cur-p">--}}
                                    {{--<div class="peer peer-greed ov-h">--}}
                                        {{--<div class="peers ai-c">--}}
                                            {{--<div class="peer mR-20">--}}
                                                {{--<img class="bdrs-50p w-3r h-3r" alt="User Avatar"--}}
                                                     {{--src="{{$employee->user->avatar_path}}">--}}
                                            {{--</div>--}}
                                            {{--<div class="peer">--}}
                                                {{--<h6 class="c-grey-900 mB-5">{{$employee->first_name . " " . $employee->last_name}}</h6>--}}
                                                {{--<div class="peer peer-greed">--}}
                                                    {{--<i class="mR-10 ti-id-badge"></i>--}}
                                                    {{--<span>{{$employee->company_id}}</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="peer">--}}
                                        {{--<span class="c-grey-900 mB-5">My Team</span>--}}
                                        {{--<div class="peer peer-greed">--}}
                                            {{--<i class="mR-10 ti-id-badge"></i>--}}
                                            {{--<span></span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


@endsection
