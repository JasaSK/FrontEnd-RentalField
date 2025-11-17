  @if (session('success'))
      <script>
          Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: '{{ session('success') }}',
              showConfirmButton: false,
              timer: 2000
          });
      </script>
  @endif

  

  @if (session('error'))
      <script>
          Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: '{{ session('error') }}',
          });
      </script>
  @endif
  @if ($errors->any())
      <script>
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
      </script>
  @endif
