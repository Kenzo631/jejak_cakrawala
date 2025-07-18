<?php
// contact.php (Lokasi: blog/dashboard/contact.php)
$pageTitle = "Kontak Kami";
$pageDescription = "Hubungi kami untuk pertanyaan atau kerja sama.";
?>

<section class="my-5 animate-fadeIn">
    <h2 class="text-center text-primary mb-4">Hubungi Jejak Cakrawala</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p class="lead text-center mb-4">Jangan ragu untuk menghubungi kami melalui informasi di bawah ini atau melalui formulir kontak.</p>
            <ul class="list-group list-group-flush mb-5 shadow-sm rounded">
                <li class="list-group-item d-flex align-items-center"><i class="bi bi-geo-alt-fill text-muted me-3 fs-5"></i> <strong>Alamat:</strong> Jl. Pendaki No. 17, Kaki Gunung Indah, Jakarta</li>
                <li class="list-group-item d-flex align-items-center"><i class="bi bi-telephone-fill text-muted me-3 fs-5"></i> <strong>Telepon:</strong> (021) 123-4567</li>
                <li class="list-group-item d-flex align-items-center"><i class="bi bi-envelope-fill text-muted me-3 fs-5"></i> <strong>Email:</strong> info@jejakcakrawala.com</li>
                <li class="list-group-item d-flex align-items-center"><i class="bi bi-instagram text-muted me-3 fs-5"></i> <strong>Instagram:</strong> @jejakcakrawala</li>
            </ul>

            <div class="contact-form animate-fadeIn delay-1">
                <form action="contact.php" method="POST">
                    <legend><i class="bi bi-chat-dots me-2"></i>Kirim Pesan Kepada Kami</legend>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama lengkap Anda..." required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subjek</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subjek pesan Anda..." required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@contoh.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" name="submit" class="btn btn-submit">
                            <i class="bi bi-send-fill me-2"></i> Kirim Pesan
                        </button>
                    </div>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</section>