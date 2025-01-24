<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }

        p {
            font-size: 15px;
            line-height: 1.5;
        }

        .content {
            margin: 20px;
        }

        .page-break {
            page-break-before: always;
            /* Force page break before this element */
        }

        .page-break-after {
            page-break-after: always;
            /* Force page break after this element */
        }

        .page-break-inside {
            page-break-inside: avoid;
            /* Prevent page break inside this element */
        }

        .right-text {
            text-align: right;
            margin-top: 100px;
            /* Sesuaikan jarak atas */
            margin-right: 50px;
            /* Jarak dari sisi kanan */
        }

        .center-text {
            text-align: center;
            margin-top: 200px;
            /* Sesuaikan jarak atas */
        }

        .table-of-contents {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
        line-height: 1.5;
    }

    .table-of-contents tr td {
        padding: 5px 0;
    }

    .table-of-contents td:first-child {
        width: 50%; /* Lebar kolom untuk judul */
    }

    .table-of-contents td:nth-child(2) {
        border-bottom: 1px dotted black; /* Titik-titik penuh */
        width: 100%; /* Pastikan kolom dots penuh */
    }

    .table-of-contents td:last-child {
        text-align: right; /* Nomor halaman di kanan */
    }

    .table-of-contents .section {
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="content">
        <div style="text-align: center; text-transform: uppercase; font-weight: bold; line-height: 1">
            <h2>proposal</h2>
            <h1><i>BSI FLASH JAPANASE FESTIVAL</i></h1>
            <h2>2024</h2>
        </div>
        <div>
            @php
            $path = public_path('images/logo/logo-bsi.png'); // Lokasi file gambar
            $imageData = base64_encode(file_get_contents($path)); // Encode ke base64
            $imageBase64 = 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . $imageData;
            @endphp
            <div style="text-align: center; margin-top: 10rem">
                <img src="{{ $imageBase64 }}" width="180" alt="" srcset="">
            </div>
        </div>
        <div
            style="text-align: center; text-transform: uppercase; font-weight: bold; line-height: 1; margin-top: 20rem">
            <h2>UNIVERSITAS BINA SARANA INFORMATIKA KAMPUS KOTA</h2>
            <h2>TASIKMALAYA</h2>
            <h2>2024</h2>
        </div>
    </div>

    <!-- Page Break after this paragraph -->
    <div class="page-break-after"></div>

    <div class="content">
        <div
            style="text-align: center; text-transform: uppercase; font-weight: bold; line-height: 1; margin-bottom: 2rem">
            <h2>kata pengantar</h2>
        </div>
        <p style="text-align: justify">Assalamualaikum WR WB
            Alhamdulillahi rabbil„alamin, dengan segala kerendahan hati, kami panjatkan puji dan syukur kehadirat Allah
            SWT, karena atas izin, rahmat serta hidayah Nya, proposal acara kegiatan Festival Budaya Jepang di
            Universitas Bina Sarana Informatika dengan tema “BSI FLASH JAPANASE FESTIVAL” telah selesai disusun.

            Proposal ini disusun berdasarkan rencana pelaksanaan kegiatan Panitia BSI FLASH JAPANASE FESTIVAL, yang
            dimana akan dilaksanakan pada tanggal 18 November 2023. Kami menyadari, terselesaikannya proposal ini tidak
            terlepas dari bantuan berbagai pihak, sehingga sepatutnya kami menghaturkan rasa terima kasih kepada seluruh
            pihak terkait yang telah memberikan bantuan

            Dalam penyajian proposal ini kami tentu menyadari masih belum mendekati kesempurnaan. Oleh karena itu, besar
            harapan kami agar pembaca berkenan memberikan umpan balik berupa kritik dan saran yang sifatnya membangun
            demi terciptanya proposal yang lebih baik lagi di masa mendatang. Sebab tidak ada sesuatu yang sempurna
            tanpa disertai saran yang konstruktif. Akhir kata, semoga makalah ini bisa memberikan manfaat bagi berrbagai
            pihak. Aamiin.

            Wassalamualakium WR WB
        </p>
        <div>
            <div class="right-text" style="line-height: 0.5">
                <p>Tasikmalaya, 17 Oktober 2024</p>
                <p style="margin-right: 4rem">Penyusun</p>
            </div>
            <div class="right-text" style="margin-top: 4rem; margin-right: 4.5rem">
                <p>Agung Baitul Hikmah</p>
            </div>
        </div>
    </div>

    <!-- Page Break after this paragraph -->
    <div class="page-break-after"></div>

    <div class="content">
        <div
            style="text-align: center; text-transform: uppercase; font-weight: bold; line-height: 1; margin-bottom: 2rem">
            <h2>daftar isi</h2>
        </div>
        <table class="table-of-contents">
            <tr>
                <td style="font-weight: bold;">LEMBAR JUDUL
                <td><span class="dots"></span></td>
                <td>i</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">KATA PENGANTAR</td>
                <td><span class="dots"></span></td>
                <td>ii</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">DAFTAR ISI</td>
                <td><span class="dots"></span></td>
                    <td>iii</td>
            </tr>
            <tr class="section">
                <td>BAB I PENDAHULUAN</td>
                <td><span class="dots"></span></td>
                <td>1</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;1.1 Latar Belakang</td>
                <td><span class="dots"></span></td>
                <td>1</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;1.2 Tujuan Kegiatan</td>
                <td><span class="dots"></span></td>
                <td>1</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;1.3 Manfaat Kegiatan</td>
                <td><span class="dots"></span></td>
                <td>1</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;1.4 Indikator Keberhasilan</td>
                <td><span class="dots"></span></td>
                <td>1</td>
            </tr>
            <tr class="section">
                <td>BAB II PERENCANAAN KEGIATAN</td>
                <td><span class="dots"></span></td>
                <td>2</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;2.1 Nama dan Tema Kegiatan</td>
                <td><span class="dots"></span></td>
                <td>2</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;2.2 Deskripsi Kegiatan</td>
                <td><span class="dots"></span></td>
                <td>2</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;2.3 Penyelenggara Kegiatan</td>
                <td><span class="dots"></span></td>
                <td>2</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;2.4 Peserta Kegiatan</td>
                <td><span class="dots"></span></td>
                <td>2</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;2.5 Waktu Pelaksanaan</td>
                <td><span class="dots"></span></td>
                <td>3</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;2.6 Susunan Acara</td>
                <td><span class="dots"></span></td>
                <td>3</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;2.7 Susunan Panitia</td>
                <td><span class="dots"></span></td>
                <td>4</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;2.8 Rencana Anggaran</td>
                <td><span class="dots"></span></td>
                <td>4</td>
            </tr>
            <tr class="section">
                <td>BAB III PENUTUP</td>
                <td><span class="dots"></span></td>
                <td>5</td>
            </tr>
        </table>
    </div>
</body>

</html>