@extends('layouts.dashboard')

@section('content')
    <div class="bd bgc-white">
        <div class="layers">
            <div class="layer w-100 p-20">
                <h4 class="lh-1">New Recruit Details</h4>
            </div>
            <div class="layer w-100">
                <div class="pr-5 pl-5 pb-5">
                    <div class="peers ai-c jc-sb">
                        <div class="peer peer-greed">
                            <form action="{{route('store.recruit')}}" method="POST">
                                {{csrf_field()}}


                                <div class="form-row">
                                    <div class="col">
                                        <label class="sr-only" for="company_id">Company ID</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="ti-id-badge"></i></div>
                                            </div>
                                            <input type="text" class="form-control" id="company_id"
                                                   value="{{$company_id}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <label class="sr-only" for="report_to">Report to</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <small>Reporting to</small>
                                                </div>
                                            </div>
                                            <select name="report_to" id="report_to" class="form-control">
                                                @foreach ($users as $user)
                                                    @foreach ($admins as $admin)
                                                        @if($user->roles->pluck('name')->first() === $admin->name)
                                                            <option value="{{$user->id}}">{{$user->name ." - ". $admin->display_name}}</option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="first_name">First name</label>
                                            <input type="text" id="first_name" name="first_name" class="form-control"
                                                   title="First name" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="middle_name">Middle name</label>
                                            <input type="text" id="middle_name" name="middle_name" class="form-control"
                                                   title="Middle name" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="last_name">Last name</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"
                                                   title="Last name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label class="sr-only" for="email">Email</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="ti-email"></i></div>
                                                </div>
                                                <input type="email" class="form-control" name="email" id="email"
                                                       placeholder="Email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">

                                            <label class="sr-only" for="role_key">Role</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="ti-eye"></i></div>
                                                </div>
                                                <select name="role_key" id="role_key" class="form-control">
                                                    @foreach ($roles as $role)
                                                        <option value="{{$role->name}}">{{$role->display_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success float-right" type="submit">Create Account</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="ta-c bdT w-100 p-20">--}}
        {{--<a href="#">Check all the sales</a>--}}
        {{--</div>--}}
    </div>
@endsection
