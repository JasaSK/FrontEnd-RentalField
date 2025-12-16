<!-- Di bagian sebelum </body> -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
<!-- Fallback for older browsers -->
<script nomodule src="{{ asset('js/global-alert-initializer.js') }}"></script>
