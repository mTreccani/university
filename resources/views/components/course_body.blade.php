@props(['course' => null])

<div class="row mb-3">
    <div class="col-md-4 col-12">
        <span>{{ __('semester') }}: </span>
        <span class="fw-bold text-lg">{{ $course->semester }}</span>
    </div>
    <div class="col-md-4 col-12">
        <span>{{ __('year') }}: </span>
        <span class="fw-bold text-lg">{{ $course->year }}</span>
    </div>
    <div class="col-md-4 col-12">
        <span>{{ __('credits') }}: </span>
        <span class="fw-bold text-lg">{{ $course->credits }}</span>
    </div>
</div>

<x-section_title>
    {{ __('formative_objectives') }}
</x-section_title>
<div class="mb-3">{{ $course->formative_objectives }}</div>

<x-section_title>
    {{ __('prerequisites') }}
</x-section_title>
<div class="mb-3">{{ $course->prerequisites }}</div>

<x-section_title>
    {{ __('course_schedule') }}
</x-section_title>
<div>{{ $course->course_schedule }}</div>
