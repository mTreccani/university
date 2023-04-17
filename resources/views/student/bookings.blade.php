@extends('layouts.app', ['showNavbar' => true, 'showSidebar' => true])

@section('content')

    @include(
        'components.section_title',
        ['title' => 'Lista prenotazioni', 'link' => null, 'linkTitle' => null]
    )

    <table class="table border-primary mt-4 table-bordered">
        <thead class="bg-secondary text-primary fw-bold">
        <tr>
            <th></th>
            <th>{{ __('Attività') }}</th>
            <th class="d-none d-md-table-cell">{{ __('Descrizione') }}</th>
            <th class="text-center">{{ __('Data') }}</th>
            <th class="text-center">{{ __('Aula') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center"><img src="{{ asset('icons/delete.svg') }}" /></td>
            <td>Programmazione web e servizi digitali</td>
            <td class="d-none d-md-table-cell">Prova di Laboratorio di Progr. Web</td>
            <td class="text-center">01/01/2001</td>
            <td class="text-center">N1</td>
        </tr>
        </tbody>
    </table>

@endsection
