@extends('layouts.app', ['showNavbar' => true, 'scripts' => ['resources/js/teacher/grades.js']])

@section('sticky-top')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Inserimento voti
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
                    <input type="number"
                           class="form-control"
                           name="grade[{{ $user->id }}]"
                           min="0"
                           max="30"
                           step="1"
                           required
                           value="{{ $user->grade }}"
                           {{ $exam->registered ? 'disabled' : '' }}
                    />
                </div>
            </div>
        @endforeach
        <button id="confirm-grades" type="button" class="primary-button my-5 float-end">{{ __('Salva') }}</button>
    </form>
@endsection

<x-confirmation_dialog
    title="Inserimento voti"
    message="I voti inseriti non potranno più essere modificati. Vuoi continuare?"
></x-confirmation_dialog>
