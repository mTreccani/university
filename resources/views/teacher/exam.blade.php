@extends('layouts.app', ['showNavbar' => true, 'showSidebar' => true])

@section('content')
    @include(
        'components.section_title',
        ['title' => 'Esame', 'link' => null, 'linkTitle' => null]
    )

    <form>
        <div class="row mt-4">
            <div class="col-6">
                <label for="exam">{{ __('Exam') }}</label>
                <select id="exam" class="form-control @error('exam') is-invalid @enderror" name="exam" required autofocus>
                    <option value="1">Programmazione web e servizi digitali</option>
                </select>

                @error('exam')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-6">
                <label for="description">{{ __('Description') }}</label>
                <input id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">

                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <label for="room">{{ __('Room') }}</label>
                <input id="room" class="form-control @error('room') is-invalid @enderror" name="room" value="{{ old('room') }}" required autocomplete="room">

                @error('room')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-6">
                <label for="date">{{ __('Date') }}</label>
                <input id="date" type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date">

                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <label for="start">{{ __('Start date') }}</label>
                <input id="start" type="date" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" required autocomplete="start">

                @error('start')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-6">
                <label for="end">{{ __('End date') }}</label>
                <input id="end" type="date" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}" required autocomplete="end">

                @error('end')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-5 float-end">
            {{ __('Create') }}
        </button>
    </form>
@endsection
