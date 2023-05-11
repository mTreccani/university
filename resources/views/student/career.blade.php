@extends('layouts.app', ['showNavbar' => true])

@section('sticky-top')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('La mia carriera') }}</li>
        </ol>
    </nav>

    <x-section_title :backRoute="route('student.dashboard')">
        {{ __('La mia carriera') }}
    </x-section_title>
@endsection

@section('content')
    <div class="my-2 d-flex flex-md-row flex-column align-items-baseline">
        <div class="border border-primary rounded-3 p-3 text-center me-md-2 me-0 mb-2 mb-md-0 w-100">
            <span>Media Aritmetica: </span><span class="fw-bold"> {{ $average }}</span>
        </div>
        <div class="border border-primary rounded-3 p-3 text-center me-md-2 me-0 mb-2 mb-md-0 w-100">
            <span>Media Ponderata: </span><span class="fw-bold"> {{ $weightedAverage }}</span>
        </div>
        <div class="border border-primary rounded-3 p-3 text-center me-md-2 me-0 mb-2 mb-md-0 w-100">
            <span>Crediti: </span><span class="fw-bold">{{ $doneCredits }}/{{ $totalCredits }}</span>
        </div>
        <canvas id="gradesChart"></canvas>
    </div>
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

<script>

    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('gradesChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($doneExams) !!},
                datasets: [{
                    label: 'Grades',
                    data: {!! json_encode($doneExams) !!},
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
