@php
    include_once(app_path('Helpers/Helpers.php'));
@endphp

@extends('layouts.app', ['showNavbar' => true, 'scripts' => ['resources/js/components/swiper.js']])

@section('content')
    <x-section_title>
        {{ __('teachings') }}
    </x-section_title>

    <div class="swiper mb-5 mt-4">
        <div class="swiper-wrapper">
            @foreach($courses as $course)
                <div class="swiper-slide">
                    <a href="{{ route('teacher.course', ['id' => $course->id]) }}">
                        <div class="exam-card">
                            <div class="exam-card-header">
                                {{ $course->name }}
                            </div>
                            <hr />
                            <div class="d-flex flex-row align-items-center">
                                <span class="fw-light text-sm me-1">{{ __('year') }}:</span>
                                <div class="text-lg text-primary fw-bold">{{ $course->year }}</div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <span class="fw-light text-sm me-1">{{ __('semester') }}:</span>
                                <div class="text-lg text-primary fw-bold">{{ $course->semester }}</div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <span class="fw-light text-sm me-1">{{ __('credits') }}:</span>
                                <div class="text-lg text-primary fw-bold">{{ $course->credits }}</div>
                            </div>
                            <img src="{{ asset('icons/chevron_right.svg') }}" class="exam-card-icon" />
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>

    <x-section_title :link="route('teacher.exam')" :linkTitle="__('create_exam')">
        {{ __('exams') }}
    </x-section_title>

    <table class="table border-primary mt-4 table-bordered">
        <thead class="bg-secondary text-primary fw-bold">
        <tr>
            <th>{{ __('activity') }}</th>
            <th class="d-none d-md-table-cell">{{ __('description') }}</th>
            <th class="text-center">{{ __('date') }}</th>
            <th class="text-center">{{ __('room') }}</th>
            <th class="d-none d-md-table-cell text-center">{{ __('duration') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($exams as $exam)
            <tr>
                <td>{{ $exam->course_name }}</td>
                <td class="d-none d-md-table-cell">{{ $exam->description }}</td>
                <td class="text-center">{{ format_date_time($exam->date) }}</td>
                <td class="text-center">{{ $exam->room }}</td>
                <td class="d-none d-md-table-cell text-center">{{ format_time($exam->duration) }}</td>
                <td class="text-center">
                    @if(!$exam->registered && !isBeforeOrEqualNow($exam->date))
                        <a href="/teacher/exam/{{ $exam->id }}">
                            <img src="{{ asset('icons/edit.svg') }}" alt="edit" />
                        </a>
                    @elseif($exam->registered && isBeforeOrEqualNow($exam->date))
                        <a href="/teacher/exam/{{ $exam->id }}/grades">
                            <img src="{{ asset('icons/eye.svg') }}" alt="grades" />
                        </a>
                    @else
                        <a href="/teacher/exam/{{ $exam->id }}/grades">
                            <img src="{{ asset('icons/check.svg') }}" alt="check" />
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
