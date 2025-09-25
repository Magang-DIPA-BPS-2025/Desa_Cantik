<footer class="footer">
    <div class="container">
        <div class="row">

            <!-- Kolom 1: Contact Info -->
            <div class="col-md-4 footer-col">
                <h4>Contact Info</h4>
                <img src="{{ asset('landing/images/footer/logobps.png') }}"
                     alt="BPS Logo" class="footer-logo">

                <p>
                    Badan Pusat Statistik Provinsi Sulawesi Selatan<br>
                    (BPS - Statistics Sulawesi Selatan Province)
                </p>
                <p>Jl. Haji Bau No.6 Makassar 90125 Sulawesi Selatan</p>
                <p>
                    Telp (0411) 854838<br>
                    (Sentral) 872879<br>
                    Faks (0411) 851225
                </p>
                <p>
                    Mailbox : <a href="mailto:pst7300@bps.go.id">pst7300@bps.go.id</a><br>
                    WhatsApp :
                    <a href="http://s.bps.go.id/wa-pst" target="_blank">
                        http://s.bps.go.id/wa-pst
                    </a>
                </p>
            </div>

            <!-- Kolom 2: Sosial Media -->
            <div class="col-md-4 footer-col">
                <h4>Sosial Media</h4>
                <div class="social-links">
                    <a href="https://facebook.com" target="_blank" class="social fb">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="social ig">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://youtube.com" target="_blank" class="social yt">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
                <p class="privacy">
                    <a href="#">Kebijakan Privasi</a>
                </p>
            </div>

            <!-- Kolom 3: Maps -->
            <div class="col-md-4 footer-col">
                <h4>Lokasi Kami</h4>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d997.8399967192212!2d119.405861!3d-5.179667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1694700000000!5m2!1sid!2sid"
                    width="100%"
                    height="220"
                    style="border:0; border-radius:8px;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
                <p class="map-info">
                    Kelurahan Maccini Sombala, Kec. Tamalate, Kota Makassar<br>
                    Luas: 2,04 km² | 72 RT | 9 RW<br>
                    Koordinat: 5°10'46.80" LS, 119°24'21.10" BT
                </p>
            </div>

        </div>
    </div>
</footer>

<style>
/* Footer */
.footer {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    padding: 50px 0 20px;
    border-top: 3px solid #C0D09D;
    color: #444;
    font-size: 15px;
}

.footer h4 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 20px;
    padding-left: 10px;
    border-left: 4px solid #C0D09D;
    color: #222;
}

.footer-logo {
    width: 90px;
    margin-bottom: 15px;
    display: block;
}

.footer p {
    margin-bottom: 10px;
    line-height: 1.6;
}

.footer a {
    color: #2c3e50;
    text-decoration: none;
    transition: all 0.3s ease;
}
.footer a:hover {
    color: #C0D09D;
    text-decoration: underline;
}

/* Social media */
.social-links {
    margin-top: 10px;
}
.social {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    margin-right: 10px;
    border-radius: 50%;
    background: #eee;
    font-size: 18px;
    transition: all 0.3s ease;
}
.social:hover {
    transform: translateY(-3px);
    color: #fff;
}
.social.fb:hover { background: #3b5998; }
.social.ig:hover { background: #E1306C; }
.social.yt:hover { background: #FF0000; }

.privacy {
    margin-top: 20px;
    font-size: 14px;
}

/* Map Info */
.map-info {
    margin-top: 10px;
    font-size: 13px;
    color: #666;
    line-height: 1.5;
}
</style>
