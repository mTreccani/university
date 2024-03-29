@php
    include_once(app_path('Helpers/Helpers.php'));
@endphp

@extends('layouts.app', ['showNavbar' => true])

@section('sticky-top')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('exams') }}</li>
        </ol>
    </nav>

    <x-section_title :backRoute="route('student.dashboard')">
        {{ __('exams') }}
    </x-section_title>
@endsection

@section('content')

    <table class="table border-primary mt-4 table-bordered">
        <thead class="bg-secondary text-primary fw-bold">
            <tr>
                <th>{{ __('activity') }}</th>
                <th class="d-none d-md-table-cell">{{ __('description') }}</th>
                <th class="text-center">{{ __('date') }}</th>
                <th class="d-none d-md-table-cell text-center">{{ __('start_bookings') }}</th>
                <th class="d-none d-md-table-cell text-center">{{ __('end_bookings') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($exams as $exam)
                <tr data-id="{{ $exam->id }}">
                    <td>{{ $exam->course_name }}</td>
                    <td class="d-none d-md-table-cell">{{ $exam->description }}</td>
                    <td class="text-center">{{ format_date_time($exam->date) }}</td>
                    <td class="d-none d-md-table-cell text-center">{{ format_date($exam->booking_start_date) }}</td>
                    <td class="d-none d-md-table-cell text-center">{{ format_date($exam->booking_end_date) }}</td>
                    <td class="text-center">
                        @if($exam->user_exam_id != null && $exam->booking_end_date >= now())
                            <form action="{{ '/student/exams/'.$exam->user_exam_id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-button">
                                    <img src="{{ asset('icons/delete.svg') }}" alt="delete" />
                                </button>
                            </form>
                        @else
                            @if($exam->booking_start_date <= now() && $exam->booking_end_date >= now())
                                <form action="{{ '/student/exams/'.$exam->id }}" method="POST">
                                    @csrf
                                    <button type="submit" class="icon-button">
                                        <img src="{{ asset('icons/calendar.svg') }}" alt="book" />
                                    </button>
                                </form>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
