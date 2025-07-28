 <!-- latest jquery-->
 <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
 <!-- Bootstrap js-->
 <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
 <!-- feather icon js-->
 <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
 <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
 <!-- scrollbar js-->
 <script src="{{ asset('assets/js/scrollbar/simplebar.min.js') }}"></script>
 <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
 <!-- Sidebar jquery-->
 <script src="{{ asset('assets/js/config.js') }}"></script>
 <!-- Plugins JS start-->
 <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
 <script src="{{ asset('assets/js/sidebar-pin.js') }}"></script>
 <script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
 <script src="{{ asset('assets/js/slick/slick.js') }}"></script>
 <script src="{{ asset('assets/js/header-slick.js') }}"></script>

 @yield('scripts')
 <!-- Plugins JS Ends-->
 <!-- Theme js-->
 <!-- Theme js-->

 <script src="{{ asset('assets/js/script.js') }}"></script>
 <script src="{{ asset('assets/js/script1.js') }}"></script>
 <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
 <script>
    let lastActivity = Date.now();
    const inactivityLimit = 8 * 60 * 1000; // 10 menit

    function checkInactivity() {
        const currentTime = Date.now();
        const inactiveTime = currentTime - lastActivity;

        if (inactiveTime > inactivityLimit) {
            logout();
        }
    }

    function logout() {
        console.log("User  has been logged out due to inactivity.");

        $.ajax({
            url: '/logout',
            type: 'GET',
            success: function(response) {
                window.location.reload();
                // window.location.href = '/login'; 
            },
            error: function(xhr, status, error) {
                console.error("Logout failed:", error);
            }
        });
    }
    document.addEventListener('mousemove', resetTimer);
    document.addEventListener('keypress', resetTimer);

    function resetTimer() {
        lastActivity = Date.now();
    }

    // Memeriksa aktivitas setiap menit
    setInterval(checkInactivity, 60 * 1000);
    // console.log(lastActivity);
    
</script>
<script>
    $(document).on('click', '.tahun-option', function () {
        let tahun = $(this).data('value');
        
        // Set session via AJAX
        $.ajax({
            url: '/set-tahun-session',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                tahun: tahun
            },
            beforeSend: function () {
                $('#loading-overlay').fadeIn(); // Tampilkan loading sebelum AJAX jalan
            },
            success: function (response) {
                $('#current-year').text(response.tahun);
                location.reload(); // Reload halaman
            },
            complete: function () {
                $('#loading-overlay').fadeOut(); // Sembunyikan loading saat selesai
            },
            error: function () {
                $('#loading-overlay').fadeOut(); // Tetap sembunyikan jika error
                alert('Terjadi kesalahan. Coba lagi.');
            }
        });

    });

</script>

