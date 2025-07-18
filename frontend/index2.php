<?php include 'header.php'; ?>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
<div style="position: relative; width: 100%; max-width: 1500px;">
  <img src="../assets/images/mount.jpg" alt="Architecture" style="width:100%; height:auto; display:block;">
  <div style="
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.4); /* hitam dengan opacity */
  "></div>
</div>  
<div class="w3-display-middle w3-margin-top w3-center">
<div class="w3-display-container" style="text-align:center; padding:60px 20px;" data-aos="zoom-in" data-aos-duration="1200">
  <h1 class="w3-xxlarge w3-text-white" style="text-shadow: 2px 2px 8px #000;" data-aos="fade-up" data-aos-delay="200">
    <span class="w3-hide-small w3-text-light-grey">Selamat datang di website <strong>JEJAK CAKRAWALA</strong></span>
  </h1>
  <br>
  <h1 class="w3-xlarge w3-text-white" style="text-shadow: 2px 2px 8px #000;" data-aos="fade-up" data-aos-delay="500">
    <span class="w3-hide-small w3-text-light-grey"><em>Tak Hanya Mendaki Tapi Menemukan Arti</em></span>
  </h1>
</div>


</div>
</header>



  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="projects" data-aos="fade-up" data-aos-delay="300">
      <h2 class="w3-center w3-xxlarge orange-button"><b>Gunung Populer</b></h2>

       <hr style="width:60px; border: 3px solid #C89B4B" class="w3-round w3-margin-bottom">

<div class="w3-row-padding w3-padding-32 ">
  <?php if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="w3-col l3 m6 w3-margin-bottom">
        <div class="w3-card-4 w3-hover-shadow" style="position: relative;">
          
          <!-- Image with overlay title -->
          <div class="w3-display-container">
            <img src="../assets/images/<?= htmlspecialchars($row['gambar_gunung']) ?>" alt="<?= htmlspecialchars($row['nama_gunung']) ?>" style="width:100%; height:200px; object-fit:cover;">
            <div class="w3-display-bottomleft w3-black w3-opacity w3-padding-small" style="font-weight: bold;">
              <?= htmlspecialchars($row['nama_gunung']) ?>
            </div>
          </div>

          <!-- Button to detail page -->
          <div class="w3-container">
            <p>
              <a href="detail_gunung.php?id=<?= $row['id']; ?>" class="w3-button w3-block w3-dark-grey w3-small w3-margin-top">Lihat Detail</a>
            </p>
          </div>
          
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="w3-padding">Tidak ada gunung yang ditemukan.</p>
  <?php endif; ?>
</div>
  </div>


  <!-- About Section -->
  <div class="w3-container w3-padding-32 animate-fadeIn" id="about" data-aos="fade-up" data-aos-delay="300" style="background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(210,165,95,0.07);">
    <h2 class="w3-center w3-xxlarge orange-button" style="color:#D2A55F;"><b>Tentang Kami</b></h2>
    <p class="w3-center w3-large w3-opacity" style="font-family:'Poppins',sans-serif;"><i>Jejak Cakrawala - Tak hanya mendaki, tapi menemukan arti.</i></p>
    <hr style="width:60px; border: 3px solid #C89B4B" class="w3-round w3-margin-bottom">

    <div class="w3-row-padding w3-margin-top">
      <div class="w3-col m6 w3-padding-large">
        <p class="w3-xlarge" style="color:#C89B4B;font-family:'Poppins',sans-serif;"><b>Platform Digital Pendakian Modern</b></p>
        <p style="font-size:17px; color:#333; font-family:'Poppins',sans-serif;">Jejak Cakrawala adalah solusi terintegrasi bagi para pencinta alam dan pendaki gunung di Indonesia. Kami mengedepankan <span style='color:#D2A55F;font-weight:bold;'>keamanan</span>, <span style='color:#D2A55F;font-weight:bold;'>edukasi</span>, dan <span style='color:#D2A55F;font-weight:bold;'>komunitas</span> dalam setiap langkah pendakian. Melalui teknologi, kami memudahkan perencanaan, pendaftaran, hingga akses informasi terkini seputar gunung dan jalur pendakian.</p>
        <ul class="w3-ul w3-large w3-margin-top" style="font-family:'Poppins',sans-serif;">
          <li><i class="fa fa-check-circle" style="color:#C89B4B;"></i> Informasi gunung & jadwal resmi</li>
          <li><i class="fa fa-check-circle" style="color:#C89B4B;"></i> Pendaftaran online yang aman & mudah</li>
          <li><i class="fa fa-check-circle" style="color:#C89B4B;"></i> Komunitas aktif & inspiratif</li>
        </ul>
      </div>
      <div class="w3-col m6 w3-padding-large w3-center">
        <img src="../assets/images/jejak_cakrawala.png" alt="Jejak Cakrawala" style="max-width:320px;width:90%;border-radius:18px;box-shadow:0 4px 24px rgba(210,165,95,0.13);background:#f4f6f9;">
      </div>
    </div>

    <div class="w3-row-padding w3-margin-top">
      <div class="w3-col m4">
        <div class="w3-card w3-white w3-padding w3-center" style="border-radius:14px;box-shadow:0 2px 12px rgba(210,165,95,0.07);">
          <h4 style="color:#D2A55F;">📅 Jadwal Pendakian</h4>
          <p style="color:#555;">Lihat jadwal buka/tutup jalur, cuaca, dan musim terbaik untuk setiap gunung.</p>
        </div>
      </div>
      <div class="w3-col m4">
        <div class="w3-card w3-white w3-padding w3-center" style="border-radius:14px;box-shadow:0 2px 12px rgba(210,165,95,0.07);">
          <h4 style="color:#D2A55F;">📝 Pendaftaran Online</h4>
          <p style="color:#555;">Daftar pendakian langsung dari rumah. Cepat, aman, dan resmi.</p>
        </div>
      </div>
      <div class="w3-col m4">
        <div class="w3-card w3-white w3-padding w3-center" style="border-radius:14px;box-shadow:0 2px 12px rgba(210,165,95,0.07);">
          <h4 style="color:#D2A55F;">⛰️ Gunung Populer</h4>
          <p style="color:#555;">Lihat info lengkap gunung favorit seperti Semeru, Rinjani, Prau, dan lainnya.</p>
        </div>
      </div>
    </div>

    <div class="w3-container w3-margin-top animate-fadeIn delay-2">
      <div class="w3-row-padding" style="gap:32px;">
        <div class="w3-col m6 s12">
          <div class="w3-card w3-padding-large w3-center" style="background: linear-gradient(90deg, #fff7e6 0%, #f5e6c8 100%); box-shadow:0 2px 12px rgba(210,165,95,0.08); border-radius:16px; height:100%; display:flex; flex-direction:column; justify-content:center;">
            <h3 style="color:#C89B4B;margin-bottom:10px;font-family:'Poppins',sans-serif;"><b><i class="fa fa-bullseye" style="color:#D2A55F;"></i> Visi Kami</b></h3>
            <blockquote style="font-size:22px; font-style:italic; color:#a67c2c; border-left:4px solid #D2A55F; margin:0; padding-left:18px; background:rgba(255,255,255,0.7); font-family:'Poppins',sans-serif;">
              "Menjadi platform pendakian gunung terdepan di Indonesia yang menginspirasi, mengedukasi, dan mempermudah setiap orang untuk menjelajahi alam dengan aman, bijak, dan bermakna."
            </blockquote>
          </div>
        </div>
        <div class="w3-col m6 s12 animate-fadeIn delay-3">
          <div class="w3-card w3-padding-large" style="background: #fff; border-radius:16px; box-shadow:0 2px 12px rgba(210,165,95,0.10); height:100%;">
            <h3 style="color:#C89B4B;font-family:'Poppins',sans-serif;"><b><i class="fa fa-list-ul" style="color:#D2A55F;"></i> Misi Kami</b></h3>
            <ul style="list-style:none; padding:0; margin:0; font-family:'Poppins',sans-serif;">
              <li style="margin-bottom:18px; display:flex; align-items:flex-start; gap:12px;">
                <span style="background:#D2A55F;color:#fff;min-width:32px;min-height:32px;display:flex;align-items:center;justify-content:center;border-radius:50%;font-weight:bold;font-size:1.1em;">1</span>
                <span style="color:#555; font-size:16px;">Meningkatkan kesadaran, keamanan, dan kenyamanan dalam kegiatan pendakian melalui teknologi yang mudah diakses oleh siapa saja.</span>
              </li>
              <li style="margin-bottom:18px; display:flex; align-items:flex-start; gap:12px;">
                <span style="background:#D2A55F;color:#fff;min-width:32px;min-height:32px;display:flex;align-items:center;justify-content:center;border-radius:50%;font-weight:bold;font-size:1.1em;">2</span>
                <span style="color:#555; font-size:16px;">Menjadi penghubung antara pendaki, basecamp, dan komunitas untuk memastikan informasi yang akurat dan terkini.</span>
              </li>
              <li style="margin-bottom:0; display:flex; align-items:flex-start; gap:12px;">
                <span style="background:#D2A55F;color:#fff;min-width:32px;min-height:32px;display:flex;align-items:center;justify-content:center;border-radius:50%;font-weight:bold;font-size:1.1em;">3</span>
                <span style="color:#555; font-size:16px;">Mendorong kolaborasi dan berbagi pengalaman antar pendaki untuk membangun komunitas yang inspiratif dan saling mendukung.</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="w3-container w3-margin-top">
      <h3 class="w3-text-brown"><b>Tim pemandu kami yang berpengalaman</b></h3>


      <div class="w3-row-padding w3-grayscale">
        <div class="w3-col l3 m6 w3-margin-bottom">
          <img src="../assets/images/person1.jpg" alt="Ahmad Rasyid" style="width:100%; height:250px;">
          <h3 >Ahmad Rasyid</h3>
          <p class="w3-opacity">Pengalaman 12 tahun</p>
          <p style="height:100px;">Ahmad adalah pendiri komunitas pendaki Langkah Alam Nusantara.  </p>
          <p><button class="w3-button w3-light-grey w3-block">Kontak</button></p>
        </div>

        <!-- Siti Nurlaila -->
        <div class="w3-col l3 m6 w3-margin-bottom">
          <img src="../assets/images/person2.jpg" alt="Siti Nurlaila" style="width:100%; height:250px;">
          <h3>Siti Nurlaila</h3>
          <p class="w3-opacity">Pengalaman 8 tahun</p>
          <p style="height:100px;">Siti aktif mengedukasi pendaki pemula soal konservasi. Ia mampu memandu kelompok internasional karena fasih berbahasa Inggris.</p>
          <p><button class="w3-button w3-light-grey w3-block">Kontak</button></p>
        </div>

        <!-- Dede Ramadhan -->
        <div class="w3-col l3 m6 w3-margin-bottom">
          <img src="../assets/images/person3.jpg" alt="Dede Ramadhan" style="width:100%;height:250px;">
          <h3>Dede Ramadhan</h3>
          <p class="w3-opacity">Pengalaman 7 tahun</p>
          <p style="height:100px;">Dede ahli dalam membaca peta dan navigasi hutan. Bertanggung jawab dalam logistik dan perizinan pendakian.</p>
          <p><button class="w3-button w3-light-grey w3-block">Kontak</button></p>
        </div>

        <!-- I Made Arta Wijaya -->
        <div class="w3-col l3 m6 w3-margin-bottom">
          <img src="../assets/images/person4.jpg" alt="I Made Arta Wijaya" style="width:100%;height:250px;">
          <h3>I Made Arta Wijaya</h3>
          <p class="w3-opacity">Pengalaman 10 tahun</p>
          <p style="height:100px;">Made adalah pemandu teknis dan ahli rescue. Berpengalaman dalam evakuasi serta memasak di lapangan.</p>
          <p><button class="w3-button w3-light-grey w3-block">Kontak</button></p>
        </div>

     
      </div>
      </div>
      </div>

<!-- Contact Section -->
<div class="w3-container w3-padding-80" id="contact" data-aos="fade-up" data-aos-delay="300">
  <h2 class="w3-center w3-xxlarge orange-button"><b>Kontak</b></h2>
  <hr style="width:60px; border: 3px solid #C89B4B" class="w3-round w3-margin-bottom">

  <form action="../action_page.php" target="_blank">
    <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
    <input class="w3-input w3-section w3-border" type="text" placeholder="Email" required name="Email">
    <input class="w3-input w3-section w3-border" type="text" placeholder="Subject" required name="Subject">
    <input class="w3-input w3-section w3-border" type="text" placeholder="Comment" required name="Comment">
    <button class="w3-button w3-black w3-section" type="submit">
      <i class="fa fa-paper-plane"></i> SEND MESSAGE
    </button>
  </form>

  <!-- Office Address and Social Media -->
  <div class="w3-section w3-padding">
    <h4><b>Alamat Kantor:</b></h4>
    <p><i class="fa fa-map-marker w3-text-orange" style="width:20px"></i> Jl. Contoh No.123, Jakarta, Indonesia</p>
    

    <h4><b>Lokasi Kami di Google Maps:</b></h4>
    <div class="w3-container w3-margin-top w3-padding-small">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.447671611505!2d112.7304562147751!3d-7.290154074348266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd12f3f1a8d%3A0x1b4974c735674c4f!2sTunjungan%20Plaza!5e0!3m2!1sen!2sid!4v1628848039509!5m2!1sen!2sid" 
        width="100%" 
        height="300" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy"></iframe>
    </div>
  </div>
  


<!-- Floating Social Media Sidebar -->
<div class="social-sidebar">
  <a href="https://www.instagram.com/namaakun" target="_blank" class="social-icon instagram" title="Instagram">
    <i class="fa fa-instagram"></i>
  </a>
  <a href="https://www.youtube.com/channel/namachannel" target="_blank" class="social-icon youtube" title="YouTube">
    <i class="fa fa-youtube"></i>
  </a>
  <a href="https://www.facebook.com/namaakun" target="_blank" class="social-icon facebook" title="Facebook">
    <i class="fa fa-facebook"></i>
  </a>
</div>
<?php include 'footer.php'; ?>