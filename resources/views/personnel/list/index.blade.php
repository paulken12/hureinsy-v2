@extends('layouts.dashboard')

@section('content')
    <div class="full-container">
        <div class="remain-height pos-r scrollable">
            <div class="bgc-white bdrs-3 ">
                <table id="employee-list" class="table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="text-center">Image</th>
                        <th>Company Id</th>
                        <th>Name</th>
                        <th>Team</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="text-center">Image</th>
                        <th>Company Id</th>
                        <th>Name</th>
                        <th>Team</th>
                        <th>Status</th>
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
                                    <span><i class="mR-10 ti-id-badge"></i> {{$employee->company_id}}</span>
                                </td>
                                <td>
                                    <h6 class="c-grey-900 m-0 "><a href="{{$employee->path()}}">{{$employee->first_name . " " . $employee->last_name}}</a></h6>
                                </td>
                                <td>
                                    <span style="font-size: 0.8rem">
                                        {{$employee->team($employee->user)}}
                                    </span>
                                </td>
                                <td>
                                    {{$employee->contract->first()->status}}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
