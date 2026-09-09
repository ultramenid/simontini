# Embed grafik/data di website lain

Hanya URL /embed/data-visualizations/{id} yang diizinkan lintas website.
Halaman artikel, beranda, CMS, dan /data-visualizations/{id} tetap SAMEORIGIN.

## Penerapan pada server Simontini

1. Include simontini-embed-map.conf di dalam konteks http {} Nginx.
2. Pada server block Simontini, GANTI directive X-Frame-Options yang sudah ada:
   
   add_header X-Frame-Options $simontini_frame_options always;

   Jangan menambahkan directive ini bersamaan dengan SAMEORIGIN yang lama.
   Pertahankan header keamanan lain. Periksa include dan location PHP yang
   memiliki add_header sendiri: header parent tidak diwariskan ketika location
   mendefinisikan add_header. Ganti juga directive X-Frame-Options di sana jika ada.
3. Jika proxy/FastCGI atau CDN juga mengirim X-Frame-Options, hilangkan duplikat
   dari sumber tersebut dan jadikan map ini pengendali header pada vhost Simontini.
   Jika ada CSP frame-ancestors, kebijakannya juga harus memberi pengecualian
   hanya pada route embed yang sama. Jangan melepas proteksi global.
4. Jalankan nginx -t, lalu reload Nginx setelah validasi berhasil.
5. Cek GET dengan ID grafik aktif:
   - /embed/data-visualizations/ID: 200, tanpa X-Frame-Options SAMEORIGIN/DENY.
   - URL yang sama dengan query string: hasil sama.
   - /, halaman artikel, /cms/login: tetap X-Frame-Options SAMEORIGIN.
   - /data-visualizations/ID: tetap SAMEORIGIN.
   - Uji iframe dari QuitCoal; pastikan grafik tampil.

Gunakan src iframe seperti:
https://stg.simontini.id/embed/data-visualizations/ID

Ganti ID dengan ID grafik aktif. Jangan gunakan URL beranda sebagai src.

Konfigurasi ini perlu dipasang pada server; push kode Laravel saja tidak
mengubah konfigurasi Nginx. Error 403 stand-alone-button.js di QuitCoal
merupakan masalah terpisah pada server QuitCoal.

Referensi:
https://nginx.org/en/docs/http/ngx_http_map_module.html
https://nginx.org/en/docs/http/ngx_http_headers_module.html
