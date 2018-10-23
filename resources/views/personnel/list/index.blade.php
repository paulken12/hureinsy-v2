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
                                    <span><a href="{{$employee->path()}}">{{$employee->first_name . " " . $employee->last_name}}</a></span>
                                </td>
                                <td>
                                    <span style="font-size: 0.8rem">
                                        {{$employee->team($employee->user)}}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{$employee->contract->first()->status=== 'Resigned' ? 'bgc-red-50 c-red-700' :'bgc-green-50 c-green-700'}} p-10 lh-0 tt-c badge-pill">{{$employee->contract->first()->status}}</span>
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
