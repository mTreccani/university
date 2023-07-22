@php
    include_once(app_path('Helpers/Helpers.php'));
@endphp

@extends('layouts.app', ['showNavbar' => true, 'scripts' => ['resources/js/teacher/exam.js']])

@section('sticky-top')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                @if(isset($exam))
                    {{ __('edit_exam') }}
                @else
                    {{ __('new_exam') }}
                @endif
            </li>
        </ol>
    </nav>

    <x-section_title :backRoute="route('teacher.dashboard')">
        @if(isset($exam))
            {{ __('edit_exam') }}
        @else
            {{ __('new_exam') }}
        @endif
    </x-section_title>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ isset($exam) ? '/teacher/exam/'.$exam->id : '/teacher/exam' }}">
        @method(isset($exam) ? 'PUT' : 'POST')
        @csrf
        <div class="row">
            <div class="col-md-6 col-12">
                <label for="course">{{ __('course') }}*</label>
                <select id="course"
                        class="form-control @error('course') is-invalid @enderror"
                        name="course"
                        required
                        autofocus
                >
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}"
                            {{ ($exam->course_id ?? null) == $course->id ? 'selected' : ''  }}
                        >
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>

                @error('course')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6 col-12">
                <label for="description">{{ __('description') }}*</label>
                <input id="description"
                       class="form-control @error('description') is-invalid @enderror"
                       name="description"
                       value="{{ $exam->description ?? old('description') }}"
                       required
                       autocomplete="description"
                       maxlength="255"
                />

                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mt-md-3">
            <div class="col-md-6 col-12">
                <label for="start_date">{{ __('start_bookings') }}*</label>
                <input id="start_date"
                       type="date"
                       class="form-control @error('start_date') is-invalid @enderror"
                       name="start_date"
                       value="{{ $exam->booking_start_date ?? old('start_date') }}"
                       required
                       min="{{ tomorrow() }}"
               />

                @error('start_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6 col-12">
                <label for="end_date">{{ __('end_bookings') }}*</label>
                <input id="end_date"
                       type="date"
                       class="form-control @error('end_date') is-invalid @enderror"
                       name="end_date"
                       value="{{ $exam->booking_end_date ?? old('end_date') }}"
                       required
                />

                @error('end_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mt-md-3">
            <div class="col-md-4 col-12">
                <label for="date">{{ __('date') }}*</label>
                <input id="date"
                       type="datetime-local"
                       class="form-control @error('date') is-invalid @enderror"
                       name="date"
                       value="{{ remove_date_seconds($exam->date) ?? old('date') }}"
                       required
                />

                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-4 col-12">
                <label for="room">{{ __('room') }}</label>
                <input id="room"
                       class="form-control @error('room') is-invalid @enderror"
                       name="room"
                       value="{{ $exam->room ?? old('room') }}"
                       autocomplete="room"
                       maxlength="255"
                />

                @error('room')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-4 col-12">
                <label for="duration">{{ __('duration') }}</label>
                <input id="duration"
                       type="time"
                       min="1"
                       class="form-control @error('duration') is-invalid @enderror"
                       name="duration"
                       value="{{ remove_time_seconds($exam->duration) ?? old('duration') }}"
                       autocomplete="duration"
                />

                @error('duration')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-5 mb-2 float-end">
            @if(isset($exam))
                {{ __('edit_exam') }}
            @else
                {{ __('new_exam') }}
            @endif
        </button>
    </form>
@endsection
