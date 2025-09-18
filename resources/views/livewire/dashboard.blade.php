<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 text-center">
                <h5>CNIC: {{ Auth::user()->cnic ?? 'Not available' }}</h5>
                <a href="/students" class="btn btn-primary btn-lg">
                    Go to Student Management
                </a>
            </div>
        </div>
    </div>
</main>
