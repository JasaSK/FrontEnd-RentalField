<!-- SweetAlert2 CDN -->

<script src="{{ asset('js/edit-banner.js') }}"></script>
<script src="{{ asset('js/edit-gallery.js') }}"></script>
<script src="{{ asset('js/edit-lapangan.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true
            });
        @endif

        @if($errors->any())
            @foreach ($errors->all() as $error)
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ $error }}",
                    timer: 4000,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            @endforeach
        @endif

    });
</script>
