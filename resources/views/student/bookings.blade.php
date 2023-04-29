@extends('layouts.app', ['showNavbar' => true])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Lista prenotazioni') }}</li>
        </ol>
    </nav>

    <x-section_title backRoute="{{ route('student.dashboard') }}">
        {{ __('Lista prenotazioni') }}
    </x-section_title>

    <table class="table border-primary mt-4 table-bordered">
        <thead class="bg-secondary text-primary fw-bold">
            <tr>
                <th>{{ __('Attività') }}</th>
                <th class="d-none d-md-table-cell">{{ __('Descrizione') }}</th>
                <th class="text-center">{{ __('Data') }}</th>
                <th class="text-center">{{ __('Aula') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($exams as $exam)
                <tr>
                    <td>{{ $exam->course_name }}</td>
                    <td class="d-none d-md-table-cell">{{ $exam->description }}</td>
                    <td class="text-center">{{ $exam->date }}</td>
                    <td class="text-center">{{ $exam->room }}</td>
                    <td class="text-center"><img src="{{ asset('icons/delete.svg') }}" /></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
