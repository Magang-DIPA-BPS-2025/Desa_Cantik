<footer id="landing-footer" class="footer">
    <div class="footer-container">
        <div class="row">

            <!-- Kolom 1: CONTACT INFO -->
            <div class="col-md-4 footer-col">
                <h4>KONTAK INFO</h4>
                <div class="logo-container">
                    <img src="{{ asset('landing/images/footer/logobps.png') }}"
                         alt="BPS Logo" class="footer-logo">
                    <img src="{{ asset('landing/images/footer/pangkep.png') }}"
                         alt="BPS Logo" class="footer-logo">
                </div>
                <p>
                    Pemerintah Desa Manggalung Kabupaten Pangkep Provinsi Sulawesi Selatan<br>
                    (BPS - Badan Pusat Statistika Provinsi Sulawesi Selatan )
                </p>
                <p>
    Telp Kepala Desa : <a href="tel:085244993977">Hubungi Kepala Desa</a><br>
    Telp Sekretaris Desa : <a href="tel:085244648513">Hubungi Sekretaris Desa</a><br>
</p>

                <p>
    Mailbox : <a href="mailto:pst7300@bps.go.id">pst7300@bps.go.id</a><br>
    WhatsApp :
    <a href="https://wa.me/6285244648513" target="_blank">
        Hubungi Kami
    </a>
</p>

            </div>

            <!-- Kolom 2: JAM OPERASIONAL -->
            <div class="col-md-4 footer-col">
                <h4>JAM OPERASIONAL</h4>
                <div class="operational-hours">
                    <div class="hours-item">
                        <span class="days">Senin - Jum'at</span>
                        <span class="hours">08.00 - 16.00 WITA</span>
                    </div>
                    <div class="hours-item">
                        <span class="days">Sabtu - Minggu</span>
                        <span class="hours">Tutup</span>
                    </div>
                </div>
            </div>

            <!-- Kolom 3: LOKASI KAMI -->
            <div class="col-md-4 footer-col">
                <h4>LOKASI KAMI</h4>
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d997.8399967192212!2d119.6170!3d-4.6104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1694700000000!5m2!1sid!2sid"
                        width="100%"
                        height="260"
                        style="border:0; border-radius:8px;"
                        allowfullscreen=""
                        loading="lazy"
                        title="Lokasi Kantor Desa Manggalung">
                    </iframe>
                </div>
                <p class="map-info">
                    Kantor Desa Manggalung<br>
                    Manggalung, Kecamatan Mandalle<br>
                    Kabupaten Pangkajene Dan Kepulauan<br>
                    Sulawesi Selatan<br>
                    <strong>Koordinat: 4°36'37.44" LS, 119°37'01.20" BT</strong>
                </p>
            </div>

        </div>
        
        <!-- Garis Horizontal -->
        <div class="footer-divider"></div>
        
        <!-- Footer Copyright -->
        <div class="footer-bottom">
            <div class="footer-copyright">
                <p>&copy; 2025 Powered by Magang Universitas Dipa Makassar</p>
            </div>
            <div class="footer-social">
                <a href="https://facebook.com" target="_blank" class="social fb">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="social ig">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://youtube.com/@manggalungtv9536?si=BPFm8DnTOL1FiSL3" target="_blank" class="social yt">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- Script Aksesibilitas -->
<script src="https://cdn.jsdelivr.net/npm/sienna-accessibility@latest/dist/sienna-accessibility.umd.js" defer></script>

<style>
#landing-footer {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    padding: 50px 0 0;
    border-top: 3px solid #C0D09D;
    color: #444;
    font-size: 15px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    position: relative;
}

/* Isolated container to avoid conflicts with global .container */
#landing-footer .footer-container {
    max-width: 1140px;
    padding-left: 15px;
    padding-right: 15px;
    margin-left: auto;
    margin-right: auto;
}

#landing-footer .row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

#landing-footer .footer-col {
    padding: 0 15px;
    flex: 1;
    min-width: 300px;
    margin-bottom: 30px;
}

#landing-footer h4 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 20px;
    padding-left: 10px;
    border-left: 4px solid #C0D09D;
    color: #222;
}

/* Logo Container - Logo dengan ukuran sama persis */
#landing-footer .logo-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    max-width: 250px;
    gap: 15px;
}

#landing-footer .footer-logo {
    width: 120px;
    height: 120px;
    object-fit: contain;
    flex-shrink: 0;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

#landing-footer p {
    margin-bottom: 12px;
    line-height: 1.6;
}

#landing-footer a {
    color: #2c3e50;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}
#landing-footer a:hover {
    color: #C0D09D;
    text-decoration: underline;
}

/* Jam Operasional */
#landing-footer .operational-hours {
    margin-top: 15px;
}

#landing-footer .hours-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid #eaeaea;
}

#landing-footer .days {
    font-weight: 600;
    color: #333;
}

#landing-footer .hours {
    color: #000000ff;
    font-weight: 500;
}

#landing-footer .privacy {
    margin-top: 20px;
    font-size: 14px;
}

/* Map Container */
#landing-footer .map-container {
    margin-bottom: 15px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Map Info */
#landing-footer .map-info {
    margin-top: 15px;
    font-size: 14px;
    color: #555;
    line-height: 1.6;
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #C0D09D;
}

#landing-footer .map-info strong {
    color: #2c3e50;
    display: block;
    margin-top: 8px;
    font-size: 13px;
}

/* Garis Horizontal */
#landing-footer .footer-divider {
    height: 1px;
    background: linear-gradient(to right, transparent, #C0D09D, transparent);
    margin: 20px 0 15px;
    width: 100%;
}

/* Footer Bottom */
#landing-footer .footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0 25px;
}

#landing-footer .footer-copyright {
    color: #666;
    font-size: 14px;
}

/* Social media di footer bottom */
#landing-footer .footer-social {
    display: flex;
    gap: 10px;
}

#landing-footer .footer-social .social {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f0f0f0;
    font-size: 16px;
    transition: all 0.3s ease;
    color: #555;
}
#landing-footer .footer-social .social:hover {
    transform: translateY(-2px);
    color: #fff;
}
#landing-footer .footer-social .social.fb:hover { background: #3b5998; }
#landing-footer .footer-social .social.ig:hover { background: #E1306C; }
#landing-footer .footer-social .social.yt:hover { background: #FF0000; }

/* Responsive Design */
@media (max-width: 992px) {
    #landing-footer .footer-col {
        flex: 0 0 50%;
    }
    
    #landing-footer .logo-container {
        max-width: 230px;
    }
    
    #landing-footer .footer-logo {
        width: 110px;
        height: 110px;
    }
}

@media (max-width: 768px) {
    #landing-footer .footer-col {
        flex: 0 0 100%;
        text-align: left;
    }
    
    #landing-footer .logo-container {
        justify-content: flex-start;
        gap: 20px;
        margin: 0 0 20px 0;
        max-width: none;
    }
    
    #landing-footer h4 {
        border-left: 4px solid #C0D09D;
        padding-left: 10px;
        border-bottom: none;
        display: block;
        padding-bottom: 0;
    }
    
    #landing-footer .footer-bottom {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    #landing-footer .footer-copyright {
        margin-bottom: 0;
    }
}

@media (max-width: 480px) {
    #landing-footer {
        padding: 30px 0 0;
    }
    
    #landing-footer .logo-container {
        justify-content: space-between;
        gap: 15px;
        max-width: 250px;
    }
    
    #landing-footer .footer-logo {
        width: 100px;
        height: 100px;
    }
    
    #landing-footer .map-container iframe {
        height: 220px;
    }
    
    #landing-footer .hours-item {
        flex-direction: column;
    }
    
    #landing-footer .hours {
        margin-top: 5px;
    }
    
    #landing-footer .footer-social .social {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }
}

@media (max-width: 360px) {
    #landing-footer .logo-container {
        flex-direction: row;
        align-items: center;
        gap: 15px;
        max-width: none;
        justify-content: space-between;
    }
    
    #landing-footer .footer-logo {
        width: 95px;
        height: 95px;
    }
    
    #landing-footer .map-info {
        font-size: 13px;
        padding: 12px;
    }
}
</style>