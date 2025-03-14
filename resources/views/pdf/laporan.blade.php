<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 11pt;
            padding: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        p {
            text-indent: 25px;
            text-align: justify;
            line-height: 1.5;
        }

        .normal-paragraph {
            text-indent: 0;
            text-align: left;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #D9D9D9;
            text-align: center;
            font-weight: normal;
        }

        table td:nth-child(1),
        table th:nth-child(1) {
            width: 5%;
        }

        table td:nth-child(2),
        table th:nth-child(2) {
            width: 15%;
        }

        table td:nth-child(3),
        table th:nth-child(3) {
            width: 35%;
        }

        table td:nth-child(4),
        table th:nth-child(4) {
            width: 20%;
        }

        table td:nth-child(5),
        table th:nth-child(5) {
            width: 25%;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .signature-container {
            width: 100%;
            margin-top: 50px;
            text-align: center;
        }

        .signature-wrapper {
            width: 100%;
            display: table;
            margin: 0 auto;
        }

        .signature-column {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 10px;
        }

        .signature-title {
            font-weight: normal;
            margin-bottom: 10px;
            text-align: center;
        }

        .signature-name {
            font-weight: bold;
            margin-top: 5px;
            margin-bottom: 0;
            text-align: center;
        }

        .new-page {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="paper">
        <div class="cover" style="text-align: center">
            <h2>LAPORAN</h2>
            <h2>SHARING ILMU BARENG TDKF</h2>
            <h3 style="font-style: italic">"Langkah Mudah Menjadi Content Creator Tanpa Ribet"</h3>
            <br><br><br><br><br><br><br>
            @php
            $path = public_path('images/logo/logo-bsi.png');
            $image = base64_encode(file_get_contents($path));
            $base64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$image;
            @endphp
            <img src="{{ $base64 }}" width="200" alt="" srcset="">
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <h3>UNIVERSITAS BINA SARANA INFORMATIKA KAMPUS KOTA</h3>
            <h3>TASIKMALAYA</h3>
            <h3>2024</h3>
        </div>

        <br><br>

        <div class="kata-pengantar new-page">
            <h3 style="text-align: center">KATA PENGANTAR</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, earum corporis! Vero itaque
                repellendus accusantium nulla placeat? Dolorem porro fuga saepe, sint, inventore repellat tempore fugit
                quia facere molestias, repellendus alias delectus illum! Ullam officia ad sed reiciendis possimus culpa.
                Corrupti libero modi minus harum! Expedita error praesentium accusamus ut.</p>
        </div>

        <br><br>

        <div class="pendahuluan new-page">
            <h3 style="text-align: center">BAB I</h3>
            <h3 style="text-align: center">PENDAHULUAN</h3>
            <p class="normal-paragraph" style="font-weight: bold">1.1 Latar Belakang</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint ad, vel, suscipit blanditiis nulla enim
                alias, ea quo nemo natus inventore quidem! Iste pariatur necessitatibus dignissimos? Illo quam maxime
                impedit alias culpa aliquid temporibus pariatur dicta itaque voluptatem. Error, laudantium nihil. Quas,
                ab illo illum maiores ut labore dignissimos eos!</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint ad, vel, suscipit blanditiis nulla enim
                alias, ea quo nemo natus inventore quidem! Iste pariatur necessitatibus dignissimos? Illo quam maxime
                impedit alias culpa aliquid temporibus pariatur dicta itaque voluptatem. Error, laudantium nihil. Quas,
                ab illo illum maiores ut labore dignissimos eos!</p>
            <p class="normal-paragraph" style="font-weight: bold">1.2 Tujuan Kegiatan</p>
            <ol>
                <li style="font-weight: bold">Lorem ipsum dolor sit amet consectetur.</li>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam quae laborum ratione recusandae eaque!
                    Dolor cum saepe praesentium recusandae nam.</p>
                <li style="font-weight: bold">Lorem ipsum dolor sit amet consectetur.</li>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam quae laborum ratione recusandae eaque!
                    Dolor cum saepe praesentium recusandae nam.</p>
                <li style="font-weight: bold">Lorem ipsum dolor sit amet consectetur.</li>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam quae laborum ratione recusandae eaque!
                    Dolor cum saepe praesentium recusandae nam.</p>
            </ol>
            <p class="normal-paragraph" style="font-weight: bold">1.3 Manfaat Kegiatan</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eum, inventore, velit facere dignissimos, dicta
                neque accusamus exercitationem laudantium porro totam aliquid unde perspiciatis ipsa voluptatibus ipsam
                qui cum ad sit obcaecati vero! Nostrum, molestias debitis! Rerum, quos quae aperiam reprehenderit odio
                dolor expedita molestias? Minus ab voluptates harum maiores illo!</p>
            <p class="normal-paragraph" style="font-weight: bold">1.4 Indikator Keberhasilan</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro, nesciunt.</p>
            <ol>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, voluptates?</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, voluptates?</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, voluptates?</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, voluptates?</li>
            </ol>
        </div>

        <br><br>

        <div class="pelaksanaan-kegiatan new-page">
            <h3 style="text-align: center">BAB II</h3>
            <h3 style="text-align: center">PELAKSANAAN KEGIATAN</h3>
            <p class="normal-paragraph" style="font-weight: bold">2.1 Nama dan Tema Kegiatan</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iure repellat accusantium eos optio quaerat
                sint illum at placeat doloremque amet.</p>
            <p class="normal-paragraph" style="font-weight: bold">2.2 Deskripsi Kegiatan</p>
            <ol>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, voluptates?</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, voluptates?</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, voluptates?</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel, voluptates?</li>
            </ol>
            <p class="normal-paragraph" style="font-weight: bold">2.3 Penyelenggara Kegiatan</p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi impedit dolores temporibus mollitia error
            eveniet, architecto iure? Tenetur, ipsum quia.
            <p class="normal-paragraph" style="font-weight: bold">2.4 Pemateri atau Narasumber</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates illo harum, assumenda ut error
                magnam nemo eum eligendi. Animi, similique!</p>
            <p class="normal-paragraph" style="font-weight: bold">2.5 Peserta Kegiatan</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam deserunt corrupti, ullam eligendi
                perferendis ratione mollitia quasi nostrum id adipisci.</p>
            <p class="normal-paragraph" style="font-weight: bold">2.6 Waktu Pelaksanaan</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam deserunt corrupti, ullam eligendi
                perferendis ratione mollitia quasi nostrum id adipisci.</p>
            <p class="normal-paragraph" style="font-weight: bold">2.7 Evaluasi Kegiatan</p>
            <div style="margin-left: 20px">
                <p class="normal-paragraph" style="font-weight: bold;">a. Jumlah Peserta</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam deserunt corrupti, ullam eligendi
                    perferendis ratione mollitia quasi nostrum id adipisci.</p>
                @php
                $path = public_path('charts/pie.png');
                $image = base64_encode(file_get_contents($path));
                $base64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$image;
                @endphp
                <img src="{{ $base64 }}" alt="" srcset="">

                <p class="normal-paragraph" style="font-weight: bold;">b. Kepuasan Peserta</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam deserunt corrupti, ullam eligendi
                    perferendis ratione mollitia quasi nostrum id adipisci.</p>
                <img src="{{ $base64 }}" alt="" srcset="">

                <p class="normal-paragraph" style="font-weight: bold;">c. Penilaian Tentang Acara</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam deserunt corrupti, ullam eligendi
                    perferendis ratione mollitia quasi nostrum id adipisci.</p>
                <img src="{{ $base64 }}" alt="" srcset="">

            </div>

            <p class="normal-paragraph" style="font-weight: bold">2.8 Susunan Acara</p>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>WAKTU</th>
                        <th>Sub acara</th>
                        <th>KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>10:20 - 20:20</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>10:20 - 20:20</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>10:20 - 20:20</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                    </tr>
                </tbody>
            </table>

            <p class="normal-paragraph" style="font-weight: bold">2.9 Susunan Panitia</p>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>WAKTU</th>
                        <th>Sub acara</th>
                        <th>KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>10:20 - 20:20</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>10:20 - 20:20</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>10:20 - 20:20</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                    </tr>
                </tbody>
            </table>

            <p class="normal-paragraph" style="font-weight: bold">2.10 Realisasi Anggaran</p>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Anggaran</th>
                        <th>Jumlah</th>
                        <th>(Rupiah)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>10:20 - 20:20</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                    </tr>
                    <tr>
                        <td>10:20 - 20:20</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                    </tr>
                    <tr>
                        <td>10:20 - 20:20</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; font-weight: bold; font-style: italic">Total
                            Pengeluaran</td>
                        <td style="font-weight: bold">Rp. 20000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br><br>

        <div class="penutup new-page">
            <h3 style="text-align: center">BAB III</h3>
            <h3 style="text-align: center">PENUTUP</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis quia ad recusandae sed quis!
                Veritatis sint perferendis ex repellat inventore totam blanditiis, ut ullam nobis, expedita possimus ab
                assumenda aperiam quae asperiores harum. Magni qui atque ipsa ipsum repellat, distinctio repudiandae a
                quia sed aut labore harum saepe! Quasi, debitis.</p>
            <p class="normal-paragraph" style="text-align: center">Tasikmalaya, 24 Agustus 2024</p>
            <p class="normal-paragraph" style="text-align: center">Hormat Kami,</p>

            <div class="signature-container">
                <div class="signature-wrapper">
                    @php
                    $path = storage_path('app/public/'.$user->tanda_tangan);
                    $image = base64_encode(file_get_contents($path));
                    $base64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$image;
                    @endphp

                    <div class="signature-column">
                        <p class="signature-title">Mengetahui,</p>
                        <div>
                            <img src="{{ $base64 }}" width="120" alt="" srcset="">
                        </div>
                        <p class="signature-name"><u>{{ $user->nama }}</u></p>
                        <p class="signature-title" style="font-weight: bold">Kepala Kampus UBSI Tasikmalaya</p>
                    </div>
                    <div class="signature-column">
                        <p class="signature-title">Pelaksana,</p>
                        <div>
                            <img src="{{ $base64 }}" width="120" alt="" srcset="">
                        </div>
                        <p class="signature-name"><u>Nama test</u></p>
                        <p class="signature-title" style="font-weight: bold">Ketua Pelaksana</p>
                    </div>
                </div>
                <div class="signature-wrapper">
                    <div class="signature-column">
                        <p class="signature-title">Menyetujui,</p>
                        <div>
                            <img src="{{ $base64 }}" width="120" alt="" srcset="">
                        </div>
                        <p class="signature-name"><u>Ir. Naba Aji Notoseputro, M.Kom</u></p>
                        <p class="signature-title" style="font-weight: bold">Kadiv DMER Universitas Bina Sarana
                            Informatika</p>
                    </div>
                </div>
            </div>
        </div>

        <br><br>

        <div class="lampiran-lampiran new-page">
            <p class="normal-paragraph" style="font-weight: bold">Lampiran-lampiran</p>
            <p>1. Press Release</p>
            <ul>
                <li>Lorem ipsum dolor sit amet.</li>
                <li>Lorem ipsum dolor sit amet.</li>
                <li>Lorem ipsum dolor sit amet.</li>
                <li>Lorem ipsum dolor sit amet.</li>
            </ul>
            <p>2. Dokumentasi Acara</p>
            @php
            $path = public_path('charts/dokumentasi.jpg');
            $image = base64_encode(file_get_contents($path));
            $base64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$image;
            @endphp
            <br>
            <img src="{{ $base64 }}" style="width: 100%" alt="" srcset="">
            <br><br>
            <img src="{{ $base64 }}" style="width: 100%" alt="" srcset="">
            <br><br>
            <img src="{{ $base64 }}" style="width: 100%" alt="" srcset="">
            <br><br>
            <p>3. Daftar Hadir Peserta</p>
            <br>
            <img src="{{ $base64 }}" style="width: 100%" alt="" srcset="">
            <br><br>
            <img src="{{ $base64 }}" style="width: 100%" alt="" srcset="">
            <br><br>
            <p>4. Bukti Kwitansi</p>
            <br>
            <img src="{{ $base64 }}" style="width: 100%" alt="" srcset="">
            <br><br>
            <img src="{{ $base64 }}" style="width: 100%" alt="" srcset="">
            <br><br>
        </div>
    </div>
</body>

</html>