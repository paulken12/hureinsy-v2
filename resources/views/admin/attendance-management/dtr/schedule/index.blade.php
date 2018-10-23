@extends('layouts.dashboard')

@section('content')
    <div class="bd bgc-white">
        <form action="{{route('generate.reports')}}" method="POST">

            {{csrf_field()}}

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

              schedules

            </div>
            <div class="ta-r bdT w-100 p-20">
                <button type="submit" class="btn btn-info">Generate Report</button>
            </div>
        </form>
    </div>
@endsection
