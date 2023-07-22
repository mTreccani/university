@extends('layouts.app', ['showNavbar' => true, 'scripts' => ['resources/js/teacher/grades.js']])

@section('sticky-top')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ __('grades') }}
            </li>
        </ol>
    </nav>

    <x-section_title :backRoute="route('teacher.dashboard')">
        {{ $exam->course_name }}
    </x-section_title>
@endsection

@section('content')
    <form action="/teacher/exam/{{ $exam->id }}/grades" method="POST" id="grades-form">
        @csrf
        @foreach($users as $user)
            <div class="row mt-3">
                <div class="col-6">
                    {{ $loop->index+1 }}. {{ $user->name }} {{ $user->surname }}
                </div>
                <div class="col-6">
                    <select class="form-control @error("grades.".$user->user_exam_id) is-invalid @enderror"
                            name="grades[{{ $user->user_exam_id }}]"
                            required
                           {{ $exam->registered ? 'disabled' : '' }}
                    >
                        @foreach(range(0, 30) as $grade)
                            <option value="{{ $grade }}"
                                {{ ($user->grade ?? null) == $grade ? 'selected' : ''  }}
                            >
                                {{ $grade }}
                            </option>
                        @endforeach
                    </select>
                    @error("grades.".$user->user_exam_id)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endforeach
        @if(!$exam->registered)
            <button
                id="confirm-grades"
                type="button"
                class="primary-button my-5 float-end"
            >
                {{ __('save') }}
            </button>
        @endif
    </form>
@endsection

<x-confirmation_dialog
    title="{{ __('grades') }}"
    message="{{ __('confirm_grades') }}"
></x-confirmation_dialog>
<!-- I voti inseriti non potranno più essere modificati. Vuoi continuare? -->
