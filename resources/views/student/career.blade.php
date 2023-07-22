@extends('layouts.app', ['showNavbar' => true])

@section('sticky-top')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __('home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('career') }}</li>
        </ol>
    </nav>

    <x-section_title :backRoute="route('student.dashboard')">
        {{ __('career') }}
    </x-section_title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 d-flex flex-column justify-content-center">
            <div class="fw-bold text-lg mb-3 text-center">{{ __('all_exams') }}</div>
            <div class="border border-primary rounded-3 p-3 text-center mb-2 w-100">
                <span>{{ __('arithmetic_average') }}: </span>
                <span class="fw-bold"> {{ round($average, 0) }}</span>
            </div>
            <div class="border border-primary rounded-3 p-3 text-center mb-2 w-100">
                <span>{{ __('weighted_average') }}: </span>
                <span class="fw-bold"> {{ round($weightedAverage, 0) }}</span>
            </div>
            <div class="border border-primary rounded-3 p-3 text-center mb-2 w-100">
                <span>{{ __('credits') }}: </span>
                <span class="fw-bold">{{ $doneCredits }}/{{ $totalCredits }}</span>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <canvas id="last-exams"></canvas>
        </div>
    </div>
    <table class="table border-primary mt-4 table-bordered">
        <thead class="bg-secondary text-primary fw-bold">
            <tr>
                <th>{{ __('activity') }}</th>
                <th class="d-none d-md-table-cell text-center">{{ __('year') }}</th>
                <th class="d-none d-md-table-cell text-center">{{ __('semester') }}</th>
                <th class="d-none d-md-table-cell text-center">{{ __('credits') }}</th>
                <th class="text-center">{{ __("grade") }}</th>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">

    window.onload = () => {
        let doneExams = {{ Js::from($doneExams) }};
        doneExams = Object.values(doneExams);

        const data = {
            labels: doneExams.map(exam => exam.name),
            datasets: [
                {
                    label: "{{ __('done_exams')  }}",
                    barPercentage: 0.5,
                    backgroundColor: '#E6F0FA',
                    borderColor: '#3C5896',
                    borderWidth: 1,
                    data: doneExams.map(exam => exam.grade),
                    order: 2
                },
                {
                    label: "{{ __('average_trend') }}",
                    backgroundColor: '#3C5896',
                    borderColor: '#3C5896',
                    data: doneExams.map(exam => exam.average),
                    type: 'line',
                    order: 1
                },
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: false // Hide X axis labels
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: "{{ __('last_ten_exams') }}",
                        font: {
                            size: 18,
                            weight: '400'
                        },
                        color: '#000'
                    },
                }
            }
        };

        new Chart(
            document.getElementById('last-exams'),
            config
        );
    }

</script>
