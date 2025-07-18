<?php include 'header.php'; ?>
<!-- Project Section -->

<?php
// Ambil halaman saat ini dari URL, default ke 1
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5; // jumlah data per halaman
$offset = ($page - 1) * $limit;

// Hitung total data
$totalData = $conn->query("SELECT COUNT(*) as total FROM gunung")->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

// Ambil data berdasarkan halaman
$gunung = $conn->query("SELECT * FROM gunung LIMIT $limit OFFSET $offset");

?>
<div class="w3-container w3-padding-64" id="projects" data-aos="fade-up" data-aos-delay="300">
    <h2 class="w3-center w3-xxlarge orange-button"><b>Daftar Gunung</b></h2>
    <hr style="width:60px; border: 3px solid #C89B4B" class="w3-round w3-margin-bottom">


    <div class="filter-section">
        <button class="filter-btn active" onclick="filterMountains('all')">Semua</button>
        <button class="filter-btn" onclick="filterMountains('mudah')">Mudah</button>
        <button class="filter-btn" onclick="filterMountains('sedang')">Sedang</button>
        <button class="filter-btn" onclick="filterMountains('sulit')">Sulit</button>
    </div>

    <div class="w3-row-padding w3-padding-32 ">
        <?php if ($gunung && $gunung->num_rows > 0): ?>
            <?php while ($row = $gunung->fetch_assoc()): ?>
                <div class="mountain-card" data-difficulty="<?= strtolower(htmlspecialchars($row['kesulitan'])) ?>">
                    <div class="card-image"
                        style="background-image: url('../assets/images/<?= htmlspecialchars($row['gambar_gunung']) ?>')">
                        <div class="difficulty-badge difficulty-<?= htmlspecialchars($row['kesulitan']) ?>">
                            <?= htmlspecialchars($row['kesulitan']) ?>
                        </div>
                    </div>
                    <div class="card-content">
                        <h2 class="mountain-name"><?= htmlspecialchars($row['nama_gunung']) ?></h2>
                        <div class="mountain-location"><?= htmlspecialchars($row['lokasi_gunung']) ?></div>

                        <div class="mountain-stats">
                            <div class="stat-item">
                                <span class="stat-value"><?= htmlspecialchars($row['tinggi_gunung']) ?></span>
                                <div class="stat-label">Ketinggian</div>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value"><?= htmlspecialchars($row['estimasi_waktu']) ?></span>
                                <div class="stat-label">Estimasi Waktu</div>
                            </div>
                        </div>

                        <div class="trail-info">
                            <div class="trail-label">Jalur Pendakian:</div>
                            <div class="trail-value"><?= htmlspecialchars($row['jalur_gunung']) ?></div>
                        </div>

                        <div class="trail-info">
                            <div class="trail-label">Biaya Paket:</div>
                            <div class="trail-value"><?= htmlspecialchars(formatRupiah($row['biaya_paket'])) ?></div>
                        </div>

                        <p class="mountain-description"><?= htmlspecialchars($row['deskripsi']) ?></p>

                        <div class="timestamps">
                            <span>Dibuat: <?= htmlspecialchars($row['created_at']) ?></span>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="w3-padding">Tidak ada jadwal yang ditemukan.</p>
        <?php endif; ?>
    </div>

    <div class="w3-center w3-padding">
    <?php if ($totalPages > 1): ?>
        <div class="w3-bar">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="w3-button <?= $i == $page ? 'w3-black' : 'w3-border' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>
    <script>
        // Filter logic untuk kesulitan gunung
        function filterMountains(difficulty) {
            // Ambil semua button filter
            const buttons = document.querySelectorAll('.filter-btn');

            // Remove active class dari semua button
            buttons.forEach(btn => btn.classList.remove('active'));

            // Add active class ke button yang diklik
            event.target.classList.add('active');

            // Ambil semua mountain cards
            const mountainCards = document.querySelectorAll('.mountain-card');

            // Loop melalui setiap card
            mountainCards.forEach(card => {
                const cardDifficulty = card.getAttribute('data-difficulty');

                if (difficulty === 'all') {
                    // Tampilkan semua cards dengan animation fade in
                    card.style.display = 'block';
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';

                    // Animate fade in
                    setTimeout(() => {
                        card.style.transition = 'all 0.3s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);

                } else if (cardDifficulty === difficulty) {
                    // Tampilkan card yang sesuai dengan filter dengan animation
                    card.style.display = 'block';
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';

                    // Animate fade in
                    setTimeout(() => {
                        card.style.transition = 'all 0.3s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);

                } else {
                    // Sembunyikan card yang tidak sesuai dengan animation fade out
                    card.style.transition = 'all 0.3s ease';
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(-20px)';

                    // Hide after animation
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });

            // Update counter (opsional)
            updateMountainCounter(difficulty);
        }

        // Function untuk update counter (opsional)
        function updateMountainCounter(difficulty) {
            const mountainCards = document.querySelectorAll('.mountain-card');
            let visibleCount = 0;

            if (difficulty === 'all') {
                visibleCount = mountainCards.length;
            } else {
                mountainCards.forEach(card => {
                    if (card.getAttribute('data-difficulty') === difficulty) {
                        visibleCount++;
                    }
                });
            }

            // Update counter display jika ada element counter
            const counterElement = document.getElementById('mountain-counter');
            if (counterElement) {
                counterElement.textContent = `Menampilkan ${visibleCount} gunung`;
            }
        }

        // Alternative: Filter dengan query parameter untuk URL
        function filterMountainsWithURL(difficulty) {
            // Update URL parameter
            const url = new URL(window.location);
            if (difficulty === 'all') {
                url.searchParams.delete('filter');
            } else {
                url.searchParams.set('filter', difficulty);
            }
            window.history.pushState({}, '', url);

            // Jalankan filter
            filterMountains(difficulty);
        }

        // Initialize filter berdasarkan URL parameter saat halaman load
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const filterParam = urlParams.get('filter');

            if (filterParam && ['mudah', 'sedang', 'sulit'].includes(filterParam)) {
                // Set active button
                const activeButton = document.querySelector(`[onclick="filterMountains('${filterParam}')"]`);
                if (activeButton) {
                    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                    activeButton.classList.add('active');
                }

                // Apply filter
                const mountainCards = document.querySelectorAll('.mountain-card');
                mountainCards.forEach(card => {
                    const cardDifficulty = card.getAttribute('data-difficulty');
                    if (cardDifficulty !== filterParam) {
                        card.style.display = 'none';
                    }
                });

                updateMountainCounter(filterParam);
            }
        });

        // Enhanced version dengan loading state
        function filterMountainsEnhanced(difficulty) {
            // Show loading state
            const container = document.querySelector('.w3-row-padding');
            const loadingDiv = document.createElement('div');
            loadingDiv.className = 'loading-state';
            loadingDiv.innerHTML = '<p style="text-align: center; padding: 20px;">Memuat...</p>';

            // Update button states
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => {
                btn.classList.remove('active');
                btn.disabled = true; // Disable during filtering
            });

            event.target.classList.add('active');

            // Simulate loading delay (remove this in production)
            setTimeout(() => {
                const mountainCards = document.querySelectorAll('.mountain-card');
                let visibleCards = 0;

                mountainCards.forEach((card, index) => {
                    const cardDifficulty = card.getAttribute('data-difficulty');

                    if (difficulty === 'all' || cardDifficulty === difficulty) {
                        card.style.display = 'block';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';

                        // Staggered animation
                        setTimeout(() => {
                            card.style.transition = 'all 0.3s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, index * 50);

                        visibleCards++;
                    } else {
                        card.style.transition = 'all 0.3s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(-20px)';

                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });

                // Re-enable buttons
                buttons.forEach(btn => btn.disabled = false);

                // Show message if no results
                const existingMessage = document.querySelector('.no-results');
                if (existingMessage) {
                    existingMessage.remove();
                }

                if (visibleCards === 0) {
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.className = 'no-results';
                    noResultsDiv.innerHTML = `
                <div style="text-align: center; padding: 40px;">
                    <h3>Tidak ada gunung ditemukan</h3>
                    <p>Tidak ada gunung dengan tingkat kesulitan "${difficulty}"</p>
                </div>
            `;
                    container.appendChild(noResultsDiv);
                }

                updateMountainCounter(difficulty);

            }, 300); // Remove this delay in production
        }
    </script>
    <?php include 'footer.php'; ?>