<script src="{{ asset('js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // 🔹 Global SweetAlert
    document.addEventListener('DOMContentLoaded', function() {

        // ✅ Success flash message
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // ✅ Error flash message
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
        @endif

        // ✅ Custom Swal
        @if (session('swal'))
            Swal.fire({
                icon: "{{ session('swal.icon') ?? 'info' }}",
                title: "{{ session('swal.title') ?? '' }}",
                text: "{{ session('swal.text') ?? '' }}",
                @if (session('swal.timer'))
                    timer: {{ session('swal.timer') }},
                    showConfirmButton: false
                @endif
            });
        @endif

        // ✅ Menampilkan semua error validasi
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: `
                    <ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
            });
        @endif
    });

    document.getElementById('logoutButton')?.addEventListener('click', function(e) {
        e.preventDefault(); // cegah submit langsung
        Swal.fire({
            title: 'Apakah Anda yakin ingin logout?',
            text: "Anda bisa login kembali nanti.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#13810A',
            cancelButtonColor: '#8B0C17',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('verified_success'))
            Swal.fire({
                icon: 'success',
                title: 'Verifikasi Berhasil!',
                text: '{{ session('verified_success') }}',
                confirmButtonText: 'Login'
            }).then(() => {
                window.location.href = "{{ route('PageLogin') }}";
            });
        @endif
    });
</script>
