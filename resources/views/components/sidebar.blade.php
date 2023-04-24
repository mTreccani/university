<div class="offcanvas offcanvas-start show"
     data-bs-backdrop="false"
     tabindex="-1"
     id="offcanvas"
>
    <div class="d-flex justify-content-end p-3 d-md-none">
        <button type="button" class="btn-close text-reset d-md-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="offcanvas-user">
            <span class="fw-bold">{{ auth()->user()->fullName() }}</span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="icon-button" type="submit">
                    <img src="{{ asset('icons/logout.svg') }}" alt="logout">
                </button>
            </form>
        </div>
        <a class="offcanvas-item" href="{{ route('student.dashboard', 'A') }}">Dashboard</a>
        <a class="offcanvas-item" href="{{ route('student.career', 'A') }}">Career</a>
        <a class="offcanvas-item" href="{{ route('student.bookings', 'A') }}">Bookings</a>

        <a class="offcanvas-item" href="{{ route('teacher.dashboard', 'A') }}">Dashboard</a>
        <a class="offcanvas-item" href="{{ route('teacher.exam', 'A') }}">Exam</a>
    </div>
</div>

<script>
    const myOffcanvas = document.getElementById('offcanvas')
    myOffcanvas.addEventListener('hide.bs.offcanvas', event => {
        if (window.innerWidth > 768) {
            event.preventDefault()
        }
    });
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            myOffcanvas.classList.add('show')
        }
    });
</script>
