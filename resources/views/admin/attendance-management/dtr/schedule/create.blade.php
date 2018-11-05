@extends('layouts.dashboard')

@section('content')
    <div class="bd bgc-white">
        <form action="{{route('generate.reports')}}" method="POST">

            {{csrf_field()}}

            <div class="layers">
                <div class="layer w-100 p-20">
                    <div class="peers">
                        <div class="peer peer-greed">
                            <h5>Scheduler</h5>
                        </div>
                        <div class="peer">
                            <label class="sr-only" for="employee">Employee</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="ti-user"></i></div>
                                </div>
                                <select name="employee" id="employee" class="form-control" >
                                    <option value="all" readonly="">- All Selected -</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->fullName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row p-0 m- w-100">
                    <div class="col bdT p-0">
                        <div class="layer w-100 fxg-1 p-30">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="shift">Employee Shift</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="ti-time"></i></div>
                                            </div>
                                            <select name="shift" id="shift" class="form-control" >
                                                <option value="all">08:00 to 05:00 - Shift 1 </option>
                                                <option value="aa">08:30 to 05:30 - Shift 2 </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="start_date">Start Date</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="ti-calendar"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control bdc-grey-200 start-date" id="start_date" placeholder="Start Date" data-provide="datepicker">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="end_date">End Date</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="ti-calendar"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control bdc-grey-200 end-date" id="end_date" placeholder="End Date" data-provide="datepicker">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="form-group">--}}
                                        {{--<div class="custom-control custom-checkbox my-1 mr-sm-2">--}}
                                            {{--<input type="checkbox" class="custom-control-input" id="sss" name="sss" value="emp_benefits.sss_num">--}}
                                            {{--<label class="custom-control-label" for="sss">Monday</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="custom-control custom-checkbox my-1 mr-sm-2">--}}
                                            {{--<input type="checkbox" class="custom-control-input" id="philhealth" name="philhealth" value="emp_benefits.philhealth_num">--}}
                                            {{--<label class="custom-control-label" for="philhealth">Tuesday</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="custom-control custom-checkbox my-1 mr-sm-2">--}}
                                            {{--<input type="checkbox" class="custom-control-input" id="hdmf" name="hdmf" value="emp_benefits.pagibig_num">--}}
                                            {{--<label class="custom-control-label" for="hdmf">Wednesday</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="custom-control custom-checkbox my-1 mr-sm-2">--}}
                                            {{--<input type="checkbox" class="custom-control-input" id="tin" name="tin" value="emp_benefits.tin_num">--}}
                                            {{--<label class="custom-control-label" for="tin">Thursday</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="custom-control custom-checkbox my-1 mr-sm-2">--}}
                                            {{--<input type="checkbox" class="custom-control-input" id="city_add" name="city_add" value="emp_addresses.unit_num">--}}
                                            {{--<label class="custom-control-label" for="city_add">Friday</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="custom-control custom-checkbox my-1 mr-sm-2">--}}
                                            {{--<input type="checkbox" class="custom-control-input" id="contact_num" name="contact_num" value="emp_contacts.mobile_num">--}}
                                            {{--<label class="custom-control-label" for="contact_num">Saturday</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="custom-control custom-checkbox my-1 mr-sm-2">--}}
                                            {{--<input type="checkbox" class="custom-control-input" id="email" name="email" value="users.email">--}}
                                            {{--<label class="custom-control-label" for="email">Sunday</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="col">
                                    <h6>Week Start</h6>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ws_mon" name="week_start" class="custom-control-input">
                                        <label class="custom-control-label" for="ws_mon">Mon</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ws_tue" name="week_start" class="custom-control-input">
                                        <label class="custom-control-label" for="ws_tue">Tue</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ws_wed" name="week_start" class="custom-control-input">
                                        <label class="custom-control-label" for="ws_wed">Wed</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ws_thu" name="week_start" class="custom-control-input">
                                        <label class="custom-control-label" for="ws_thu">Thu</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ws_fri" name="week_start" class="custom-control-input">
                                        <label class="custom-control-label" for="ws_fri">Fri</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ws_sat" name="week_start" class="custom-control-input">
                                        <label class="custom-control-label" for="ws_sat">Sat</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ws_sun" name="week_start" class="custom-control-input">
                                        <label class="custom-control-label" for="ws_sun">Sun</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="ta-r bdT w-100 p-20">
                <button type="submit" class="btn btn-info">Set Schedule</button>
            </div>
        </form>
    </div>
@endsection
