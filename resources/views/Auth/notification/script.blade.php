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
    </script>
