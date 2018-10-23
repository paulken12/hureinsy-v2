@extends('layouts.dashboard')

@section('content')
    <div class="bd bgc-white">
        <div class="layers">
            <div class="layer w-100 p-20">
                <h4 class="lh-1">Role Management</h4>
            </div>
            <div class="layer w-100">
                <div class="peers ai-c jc-sb">
                    <div class="peer peer-greed">
                        <form action="{{route('store.recruit')}}" method="POST">
                            {{csrf_field()}}


                            <table class="table bdT " cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="pl-5 bdwT-0">Roles</th>
                                    <th class=" bdwT-0">Browse <i class="ml-2 ti-help-alt"></i></th>
                                    <th class=" bdwT-0">Read <i class="ml-2 ti-help-alt"></i></th>
                                    <th class=" bdwT-0">Create <i class="ml-2 ti-help-alt"></i></th>
                                    <th class=" bdwT-0">Edit <i class="ml-2 ti-help-alt"></i></th>
                                    <th class=" bdwT-0">Delete <i class="ml-2 ti-help-alt"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="pl-5">Role</td>
                                    <td >Browse</td>
                                    <td >Read</td>
                                    <td >Create</td>
                                    <td >Edit</td>
                                    <td >Delete</td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="ta-c bdT w-100 p-20">--}}
        {{--<a href="#">Check all the sales</a>--}}
        {{--</div>--}}
    </div>
@endsection
