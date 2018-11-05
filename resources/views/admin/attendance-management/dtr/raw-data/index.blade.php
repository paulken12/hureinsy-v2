@extends('layouts.dashboard')

@section('content')

    <import-raw></import-raw>
    {{--<div class="bd bgc-white">--}}
        {{--<form action="{{route('import.file')}}" method="POST" enctype="multipart/form-data">--}}

            {{--{{csrf_field()}}--}}

            {{--<div class="layers">--}}
                {{--<div class="layer w-100 p-20">--}}
                    {{--<div class="peers">--}}
                        {{--<div class="peer peer-greed">--}}
                            {{--<h5 class="lh-1">Import Raw Data</h5>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="container-fluid bdT p-20">--}}
                    {{--<div class="custom-file">--}}
                        {{--<input type="file" class="custom-file-input" id="import_file" name="import_file" required>--}}
                        {{--<label class="custom-file-label" for="import_file">Choose file...</label>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                    {{--<div class="form-row">--}}
                        {{--<div class="col">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="start_date">Start Date</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-prepend">--}}
                                        {{--<div class="input-group-text"><i class="ti-calendar"></i></div>--}}
                                    {{--</div>--}}
                                    {{--<input type="text" class="form-control bdc-grey-200 start-date" id="start_date" name="start_date"--}}
                                           {{--placeholder="Start Date" data-provide="datepicker"--}}
                                           {{--data-date-format="yyyy-mm-dd">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="end_date">End Date</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-prepend">--}}
                                        {{--<div class="input-group-text"><i class="ti-calendar"></i></div>--}}
                                    {{--</div>--}}
                                    {{--<input type="text" class="form-control bdc-grey-200 end-date" id="end_date" name="end_date"--}}
                                           {{--placeholder="End Date" data-provide="datepicker"--}}
                                           {{--data-date-format="yyyy-mm-dd">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}
            {{--<div class="ta-r bdT w-100 p-20">--}}
                {{--<button type="submit" class="btn btn-info">Import</button>--}}
            {{--</div>--}}
        {{--</form>--}}
    {{--</div>--}}
@endsection
