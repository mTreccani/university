@extends('layouts.app', ['showNavbar' => true, 'showSidebar' => true])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Lista prenotazioni') }}</li>
        </ol>
    </nav>

    <x-section_title showBackButton="true">TITLE</x-section_title>

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
        <tr>
            <td>Programmazione web e servizi digitali</td>
            <td class="d-none d-md-table-cell">Prova di Laboratorio di Progr. Web</td>
            <td class="text-center">01/01/2001</td>
            <td class="text-center">N1</td>
            <td class="text-center"><img src="{{ asset('icons/delete.svg') }}" /></td>
        </tr>
        </tbody>
    </table>

@endsection
