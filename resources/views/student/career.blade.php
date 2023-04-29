@extends('layouts.app', ['showNavbar' => true])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('La tua carriera') }}</li>
        </ol>
    </nav>

    <x-section_title backRoute="{{ route('student.dashboard') }}">
        {{ __('La tua carriera') }}
    </x-section_title>

    <table class="table border-primary mt-4 table-bordered">
        <thead class="bg-secondary text-primary fw-bold">
            <tr>
                <th>{{ __('Attività') }}</th>
                <th class="d-none d-md-table-cell text-center">{{ __('Anno') }}</th>
                <th class="d-none d-md-table-cell text-center">{{ __('Semestre') }}</th>
                <th class="d-none d-md-table-cell text-center">{{ __('Crediti') }}</th>
                <th class="text-center">{{ __("Voto") }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td class="d-none d-md-table-cell text-center">{{ $course->year }}</td>
                    <td class="d-none d-md-table-cell text-center">{{ $course->semester }}</td>
                    <td class="d-none d-md-table-cell text-center">{{ $course->credits }}</td>
                    <td class="text-center">{{ $course->grade ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
