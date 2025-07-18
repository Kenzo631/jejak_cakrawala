<?php
// footer.php (Lokasi: blog/dashboard/footer.php)
// File ini akan di-include oleh index.php
?>
    </div> <footer class="bg-dark text-center text-white py-4">
        <div class="container">
            <h5 class="fw-bold mb-3">Jejak Cakrawala</h5>
            <div class="mt-3">
                <small>&copy; <?php echo date('Y'); ?> Jejak Cakrawala. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../assets/js/custom.js"></script>

</body>
<script>
// Saat halaman selesai dimuat, jalankan fade-in
document.addEventListener('DOMContentLoaded', function() {
    document.body.classList.add('loaded');

    // Ambil semua link di sidebar
    const links = document.querySelectorAll('.sidebar .nav-link');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            // Jika href ada dan bukan link external
            if (href && !href.startsWith('http') && href !== '#') {
                e.preventDefault(); // cegah pindah langsung

                // Tambahkan fade-out
                document.body.classList.remove('loaded');
                document.body.classList.add('fade-out');

                // Setelah animasi selesai (500ms), pindah halaman
                setTimeout(() => {
                    window.location.href = href;
                }, 500);
            }
        });
    });
});
</script>
</html>