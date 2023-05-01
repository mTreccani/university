@php
    include(app_path('Helpers/helpers.php'));
@endphp

@extends('layouts.app', ['showNavbar' => true])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Lista esami') }}</li>
        </ol>
    </nav>

    <x-section_title backRoute="{{ route('student.dashboard') }}">
        {{ __('Lista esami') }}
    </x-section_title>

    <table class="table border-primary mt-4 table-bordered">
        <thead class="bg-secondary text-primary fw-bold">
            <tr>
                <th>{{ __('Attività') }}</th>
                <th class="d-none d-md-table-cell">{{ __('Descrizione') }}</th>
                <th class="text-center">{{ __('Data') }}</th>
                <th class="d-none d-md-table-cell text-center">{{ __('Inizio iscrizioni') }}</th>
                <th class="d-none d-md-table-cell text-center">{{ __('Fine iscrizioni') }}</th>
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
                    <td class="text-center" data-user_exam_id="{{ $exam->user_exam_id }}">
                        @if($exam->user_exam_id != null && $exam->booking_end_date >= now())
                            <img id="delete" src="{{ asset('icons/delete.svg') }}" alt="delete" class="cursor-pointer" />
                        @else
                            @if($exam->booking_start_date <= now() && $exam->booking_end_date >= now())
                                <img id="book" src="{{ asset('icons/calendar.svg') }}" alt="book" class="cursor-pointer"/>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
