@extends('layouts.dashboard')

@section('content')
    <schedule-form
        :employees = "{{$employees}}"
        :shifts = "{{$shifts}}">
    </schedule-form>
@endsection
