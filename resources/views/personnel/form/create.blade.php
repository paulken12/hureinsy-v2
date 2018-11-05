@extends('layouts.form')

@section('content')
    @auth()
        <personnel-form :user="{{ $user }}"
                        :gender="{{ $gender }}"
                        :profile="{{ $profile }}"
                        :civil="{{ $civilStatus }}"
                        :citizenship="{{ $citizenship }}"
                        :extension="{{ $extension }}"
                        :educations="{{ $educations }}"
                        :families="{{ $family }}"
        ></personnel-form>
    @endauth
@endsection