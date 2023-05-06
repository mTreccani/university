@extends('layouts.app', ['showNavbar' => true])

@section('sticky-top')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $course->name }}</li>
        </ol>
    </nav>

    <x-section_title :backRoute="route('student.dashboard')">
        {{ $course->name }}
    </x-section_title>
@endsection

@section('content')
    <x-course_body :course="$course"></x-course_body>
@endsection
