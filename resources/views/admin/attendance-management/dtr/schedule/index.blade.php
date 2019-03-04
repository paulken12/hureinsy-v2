@extends('layouts.dashboard')

@section('content')
    <div class="bd bgc-white">
        <div class="layers">
            <div class="layer w-100 p-20">
                <div class="peers">
                    <div class="peer peer-greed">
                        <h5 class="lh-1">Employee Schedule</h5>

                    </div>
                    <div class="peer">
                        <h6><a href="{{route('employee.attendance')}}">Scheduler</a></h6>
                    </div>
                </div>
            </div>

            <table id="sched-list" class="table" cellspacing="0" width="100%">
                <thead>
                    <tr class="text-primary">
                        <th class="text-center">Employee id</th>
                        <th>Employee name</th>
                        <th>Shift</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedlist as $lists)
                        <tr>
                            <th class="text-center">{{$lists->empBasic->company_id}}</th>
                            <td>{{$lists->empBasic->last_name .', '. $lists->empBasic->first_name}}</td>
                            <td>{{$lists->attShift->display_name .' - '. date('h:i A', strtotime($lists->attShift->time_in)) .' to '. date('h:i A', strtotime($lists->attShift->time_out))}}</td>
                            <td>{{date('M d, Y', strtotime($lists->start_date))}}</td>
                            <td>{{date('M d, Y', strtotime($lists->end_date))}}</td>
                            <td><a href="{{route('employee.attendance.show', $lists->id)}}" class="btn btn-primary">view</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
