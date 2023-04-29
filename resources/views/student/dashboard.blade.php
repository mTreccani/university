@php
    include(app_path('Helpers/helpers.php'));
@endphp

@extends('layouts.app', ['showNavbar' => true])

@section('content')
    <x-section_title link="{{ route('student.career') }}" linkTitle="{{ __('Piano carriera') }}">
        {{ __('I miei corsi') }}
    </x-section_title>

    <div class="swiper mb-5 mt-4">
        <div class="swiper-wrapper">
            @foreach($courses as $course)
                <div class="swiper-slide">
                    <div class="exam-card">
                        <div class="exam-card-header">
                            {{ $course->name }}
                        </div>
                        <hr />
                        <div class="d-flex flex-row align-items-center">
                            <span class="fw-light text-sm me-1">Anno:</span>
                            <div class="text-lg text-primary fw-bold">{{ $course->year }}</div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <span class="fw-light text-sm me-1">Semestre:</span>
                            <div class="text-lg text-primary fw-bold">{{ $course->semester }}</div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <span class="fw-light text-sm me-1">Crediti:</span>
                            <div class="text-lg text-primary fw-bold">{{ $course->credits }}</div>
                        </div>
                        <img src="{{ asset('icons/chevron_right.svg') }}" class="exam-card-icon" />
                    </div>
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>

    <x-section_title link="{{ route('student.bookings') }}" linkTitle="{{ __('Lista prenotazioni') }}">
        {{ __('Lista prenotazioni') }}
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
                <tr>
                    <td>{{ $exam->course_name }}</td>
                    <td class="d-none d-md-table-cell">{{ $exam->description }}</td>
                    <td class="text-center">{{ format_date($exam->date) }}</td>
                    <td class="d-none d-md-table-cell text-center">{{ format_date($exam->booking_start_date) }}</td>
                    <td class="d-none d-md-table-cell text-center">{{ format_date($exam->booking_end_date) }}</td>
                    <td class="text-center">
                        @if($exam->booked)
                            <img src="{{ asset('icons/check.svg') }}" alt="booked" />
                        @else
                            <img class="cursor-pointer"
                                 src="{{ asset('icons/calendar.svg') }}"
                                 onclick="console.log('{{$exam->booked}}')"
                            />
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
