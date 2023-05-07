@extends('layouts.app', ['showNavbar' => true])

@section('sticky-top')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Inserimento voti
            </li>
        </ol>
    </nav>

    <x-section_title :backRoute="route('teacher.dashboard')">
        {{ $exam->course_name }}
    </x-section_title>
@endsection

@section('content')
{{--  TODO: Aggiungere dialog di conferma per l'inserimento dei voti e creare azione nel controller per salvarli
            Una volta che è stato salvato non è più possibile modificare i voti --}}
    <form>
        @foreach($users as $user)
            <div class="row mt-3">
                <div class="col-6">
                    {{ $loop->index+1 }}. {{ $user->name }} {{ $user->surname }}
                </div>
                <div class="col-6">
                    <input type="number" class="form-control" name="grade" min="0" max="30" step="1" required />
                </div>
            </div>
        @endforeach
        <button type="submit" class="primary-button my-5 float-end">{{ __('Salva') }}</button>
    </form>
@endsection
