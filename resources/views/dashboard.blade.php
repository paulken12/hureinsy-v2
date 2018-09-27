@extends('layouts.dashboard')

@section('content')
    <div class="card">
        @if(Auth::user()->hasRole('titan'))
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                Total Employees
                                <hr>
                                <h3>{{$active_employees}}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                No. of Resigned Employee
                                <hr>
                                <h3>{{$resigned_employees}}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                No. of Regular Employee
                                <hr>
                                <h3>{{$regular_employees}}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                No. of Project-based
                                <hr>
                                <h3>{{$project_employees}}</h3>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card-body">
                Regular Emp Dashboard
            </div>
        @endif
    </div>
@endsection
