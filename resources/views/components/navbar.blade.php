<div class="navbar">
    <img src="{{ asset('images/logo.svg') }}">
    <div class="d-flex flex-row align-items-center">
        <span class="fw-bold d-none d-md-block">{{ auth()->user()->fullName() }}</span>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="icon-button" type="submit">
                <img src="{{ asset('icons/logout.svg') }}" alt="logout">
            </button>
        </form>
    </div>
</div>
