<?php
$current_folder = basename(dirname($_SERVER['SCRIPT_NAME']));
?>

<aside class="sidebar">
    <h5 class="mb-4 fw-bold"><i class="bi bi-list"></i> Menu</h5>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="../dashboard/index.php" class="nav-link <?= ($current_folder == 'dashboard') ? 'active' : '' ?>">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="../gunung/index.php" class="nav-link <?= ($current_folder == 'gunung') ? 'active' : '' ?>">
                <i class="fas fa-mountain"></i> Gunung
            </a>
        </li>
        <li class="nav-item">
            <a href="../jadwal/index.php" class="nav-link <?= ($current_folder == 'jadwal') ? 'active' : '' ?>">
                <i class="bi bi-calendar-event"></i> Jadwal Pendakian
            </a>
        </li>
        <li class="nav-item">
            <a href="../pendaki/index.php" class="nav-link <?= ($current_folder == 'pendaki') ? 'active' : '' ?>">
                <i class="bi bi-people-fill"></i> Data Pendaki
            </a>
        </li>
        <li class="nav-item mt-auto">
            <a href="../auth/logout.php" class="nav-link logout rounded">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </a>
        </li>
    </ul>
</aside>
