        @if (session('success'))
                <script>
                    $(document).ready(function() {
                        // Notifikasi toastr berhasil
                        toastr.options.positionClass = 'toast-top-right';
                        toastr.success('{{ session('success') }}', 'success');

                    });
                </script>
            </div>
        @elseif (session('error'))
            <script>
                $(document).ready(function() {
                    // Notifikasi toastr berhasil
                    toastr.error('{{ session('error') }}', 'error');
                });
            </script>
        @endif
