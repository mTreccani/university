<select class="form-control" id="locale">
    @foreach(config('app.available_locales') as $code)
        <option value="{{ $code }}" @if(app()->currentLocale() === $code) selected @endif>{{ __($code) }}</option>
    @endforeach
</select>
