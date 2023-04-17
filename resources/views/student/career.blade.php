@extends('layouts.app', ['showNavbar' => true, 'showSidebar' => true])

@section('content')

    @include(
        'components.section_title',
        ['title' => 'La tua carriera', 'link' => null, 'linkTitle' => null]
    )

    <table class="table border-primary mt-4 table-bordered">
        <thead class="bg-secondary text-primary fw-bold">
        <tr>
            <th>{{ __('Attività') }}</th>
            <th class="d-none d-md-table-cell">{{ __('Descrizione') }}</th>
            <th class="d-none d-md-table-cell text-center">{{ __('Anno') }}</th>
            <th class="d-none d-md-table-cell text-center">{{ __('Semestre') }}</th>
            <th class="d-none d-md-table-cell">{{ __('Tipologia') }}</th>
            <th class="text-center">{{ __("Voto") }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Programmazione web e servizi digitali</td>
            <td class="d-none d-md-table-cell">Prova di Laboratorio di Progr. Web</td>
            <td class="d-none d-md-table-cell text-center">1</td>
            <td class="d-none d-md-table-cell text-center">2</td>
            <td class="d-none d-md-table-cell">Obbligatorio</td>
            <td class="text-center">-</td>
        </tr>
        </tbody>
    </table>

@endsection
