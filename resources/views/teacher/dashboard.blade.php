@extends('layouts.app', ['showNavbar' => true, 'showSidebar' => true])

@section('content')
    @include(
        'components.section_title',
        ['title' => 'Insegnamenti', 'link' => null, 'linkTitle' => null]
    )

    <div class="swiper mb-5 mt-4">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="exam-card">
                    <div class="exam-card-header">
                        Programmazione web e servizi digitali
                    </div>
                    <hr />
                    <div class="d-flex flex-row align-items-center">
                        <span class="fw-light text-sm me-1">Anno:</span>
                        <div class="text-lg text-primary fw-bold">2022/2023</div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span class="fw-light text-sm me-1">Semestre:</span>
                        <div class="text-lg text-primary fw-bold">2</div>
                    </div>
                    <img src="{{ asset('icons/chevron_right.svg') }}" class="exam-card-icon" />
                </div>
            </div>
            <div class="swiper-slide"><div class="exam-card"></div></div>
            <div class="swiper-slide"><div class="exam-card"></div></div>
            <div class="swiper-slide"><div class="exam-card"></div></div>
            <div class="swiper-slide"><div class="exam-card"></div></div>
            <div class="swiper-slide"><div class="exam-card"></div></div>
            <div class="swiper-slide"><div class="exam-card"></div></div>
            <div class="swiper-slide"><div class="exam-card"></div></div>
            <div class="swiper-slide"><div class="exam-card"></div></div>

        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>

    @include(
        'components.section_title',
        ['title' => 'Appelli', 'link' => route('teacher.exam', 'A'), 'linkTitle' => 'Crea appello']
    )

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
        <tr>
            <td>Programmazione web e servizi digitali</td>
            <td class="d-none d-md-table-cell">Prova di Laboratorio di Progr. Web</td>
            <td class="text-center">15/06/2023</td>
            <td class="d-none d-md-table-cell text-center">15/06/2023</td>
            <td class="d-none d-md-table-cell text-center">15/06/2023</td>
            <td class="text-center"><img class="cursor-pointer" src="{{ asset('icons/delete.svg') }}" onclick="console.log('click')" /></td>
        </tr>
        </tbody>
    </table>
@endsection
