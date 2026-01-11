<!-- Di bagian sebelum </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    window.addEventListener('load', function() {
        const loader = document.getElementById('loader');

        // Tunggu 2 detik untuk animasi selesai
        setTimeout(function() {
            loader.style.opacity = '0';
            loader.style.transition = 'opacity 0.5s ease-out';

            setTimeout(function() {
                loader.style.display = 'none';
            }, 500);
        }, 1000);
    });
</script>

<!-- Pass data dari Laravel ke JavaScript -->
<script>
    // Send flash messages to JavaScript
    window.successMessage = @json(session('success'));
    window.errorMessage = @json(session('error'));
    window.verifiedSuccessMessage = @json(session('verified_success'));
    window.loginUrl = @json(route('PageLogin'));

    @if (session('swal'))
        window.swalData = @json(session('swal'));
    @endif

    @if ($errors->any())
        window.validationErrors = @json($errors->all());
    @endif
</script>

<!-- Load the minimal green alert -->
<script src="{{ asset('js/global-alert.js') }}" type="module"></script>
