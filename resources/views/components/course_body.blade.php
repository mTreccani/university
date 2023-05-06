@props(['course' => null])

<div class="row mb-3">
        <div class="col-md-4 col-12">
            <span>Semestre: </span>
            <span class="fw-bold text-lg">{{ $course->semester }}</span>
</div>
<div class="col-md-4 col-12">
    <span>Anno: </span>
    <span class="fw-bold text-lg">{{ $course->year }}</span>
</div>
<div class="col-md-4 col-12">
    <span>Crediti: </span>
    <span class="fw-bold text-lg">{{ $course->credits }}</span>
</div>
</div>

<x-section_title>
    Obiettivi formativi
</x-section_title>
<div class="mb-3">{{ $course->formative_objectives }}</div>

<x-section_title>
    Prerequisiti
</x-section_title>
<div class="mb-3">{{ $course->prerequisites }}</div>

<x-section_title>
    Programma del corso
</x-section_title>
<div>{{ $course->course_schedule }}</div>
