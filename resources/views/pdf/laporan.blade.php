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
            <h2>{{ $report->judul }}</h2>
            @if($report->kutipan)
            <h3 style="font-style: italic">"{{ $report->kutipan }}"</h3>
            @endif
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
            <h3>{{ date('Y') }}</h3>
        </div>

        <br><br>

        <div class="kata-pengantar new-page">
            <h3 style="text-align: center">KATA PENGANTAR</h3>
            {!! paragraph($report->kata_pengantar) !!}
        </div>

        <br><br>

        <div class="pendahuluan new-page">
            <h3 style="text-align: center">BAB I</h3>
            <h3 style="text-align: center">PENDAHULUAN</h3>
            <p class="normal-paragraph" style="font-weight: bold">1.1 Latar Belakang</p>
            {!! paragraph($introduction->latar_belakang) !!}
            <p class="normal-paragraph" style="font-weight: bold">1.2 Tujuan Kegiatan</p>
            {!! paragraph($introduction->tujuan_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">1.3 Manfaat Kegiatan</p>
            {!! paragraph($introduction->manfaat_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">1.4 Indikator Keberhasilan</p>
            {!! paragraph($introduction->indikator_keberhasilan) !!}
        </div>

        <br><br>

        <div class="pelaksanaan-kegiatan new-page">
            <h3 style="text-align: center">BAB II</h3>
            <h3 style="text-align: center">PELAKSANAAN KEGIATAN</h3>
            <p class="normal-paragraph" style="font-weight: bold">2.1 Nama dan Tema Kegiatan</p>
            {!! paragraph($planActivity->tema_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">2.2 Deskripsi Kegiatan</p>
            {!! paragraph($planActivity->deskripsi_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">2.3 Penyelenggara Kegiatan</p>
            {!! paragraph($planActivity->penyelenggara_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">2.4 Pemateri atau Narasumber</p>
            {!! paragraph($planActivity->pemateri_narasumber) !!}
            <p class="normal-paragraph" style="font-weight: bold">2.5 Peserta Kegiatan</p>
            {!! paragraph($planActivity->peserta_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">2.6 Waktu Pelaksanaan</p>
            {!! paragraph($planActivity->waktu_pelaksanaan) !!}
            <p class="normal-paragraph" style="font-weight: bold">2.7 Evaluasi Kegiatan</p>
            <div style="margin-left: 20px">
                <p class="normal-paragraph" style="font-weight: bold;">a. Jumlah Peserta</p>
                <p>- Jumlah peserta daftar: {{ $evaluation->peserta_daftar }} Orang</p>
                <p>- Jumlah peserta hadir: {{ $evaluation->peserta_hadir }}, yang terdiri siswa dan guru, mahasiswa
                    serta masyarakat umum, dengan rincian persentase sebagai berikut:</p>
                @php
                $image = base64_encode(file_get_contents($pieChart1));
                $base64 = 'data:image/'.pathinfo($pieChart1, PATHINFO_EXTENSION).';base64,'.$image;
                @endphp
                <div style="text-align: center">
                    <img src="{{ $base64 }}" alt="" srcset="">
                </div>

                <p class="normal-paragraph" style="font-weight: bold;">b. Kepuasan Peserta</p>
                @php
                $image = base64_encode(file_get_contents($pieChart2));
                $base64 = 'data:image/'.pathinfo($pieChart2, PATHINFO_EXTENSION).';base64,'.$image;
                @endphp
                <div style="text-align: center">
                    <img src="{{ $base64 }}" alt="" srcset="">
                </div>

                <p class="normal-paragraph" style="font-weight: bold;">c. Penilaian Tentang Acara</p>
                @php
                $path = public_path($pieChart3);
                $image = base64_encode(file_get_contents($pieChart3));
                $base64 = 'data:image/'.pathinfo($pieChart3, PATHINFO_EXTENSION).';base64,'.$image;
                @endphp
                <div style="text-align: center">
                    <img src="{{ $base64 }}" alt="" srcset="">
                </div>

            </div>

            @if($schedules->isNotEmpty())
            <p class="normal-paragraph" style="font-weight: bold">2.8 Susunan Acara</p>
            <style>
                .table1 td:nth-child(1),
                .table1 th:nth-child(1) {
                    width: 5%;
                }

                .table1 td:nth-child(2),
                .table1 th:nth-child(2) {
                    width: 20%;
                }

                .table1 td:nth-child(3),
                .table1 th:nth-child(3) {
                    width: 40%;
                }

                .table1 td:nth-child(4),
                .table1 th:nth-child(4) {
                    width: 25%;
                }
            </style>

            <table class="custom-table table1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>WAKTU</th>
                        <th>Sub acara</th>
                        <th>KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $item)
                    <tr>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $item->waktu }}</td>
                        <td>{{ $item->sub_acara }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <p class="normal-paragraph" style="font-weight: bold">2.9 Susunan Panitia</p>

            <style>
                .table2 td:nth-child(1),
                .table2 th:nth-child(1) {
                    width: 45%;
                }

                .table2 td:nth-child(2),
                .table2 th:nth-child(2) {
                    width: 55%;
                }
            </style>

            <table class="table2">
                <tbody>
                    @foreach ($roles as $role)
                    <tr style="border: 0 solid white">
                        <td style="border: 0 solid white">{{ $titles[$loop->iteration - 1] }}</td>
                        <td style="border: 0 solid white">{{ $committee->$role }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($budgetRealizations->isNotEmpty())
            <p class="normal-paragraph" style="font-weight: bold">2.10 Realisasi Anggaran</p>
            <style>
                .table3 td:nth-child(1),
                .table3 th:nth-child(1) {
                    width: 5%;
                }

                .table3 td:nth-child(2),
                .table3 th:nth-child(2) {
                    width: 55%;
                }
                .table3 td:nth-child(3),
                .table3 th:nth-child(3) {
                    width: 5%;
                }
                .table3 td:nth-child(4),
                .table3 th:nth-child(4) {
                    width: 35%;
                }
            </style>

            <table class="custom-table table3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggaran</th>
                        <th>Jumlah</th>
                        <th>(Rupiah)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgetRealizations as $item)
                    <tr>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $item->anggaran }}</td>
                        <td style="text-align: center">{{ $item->jumlah }}</td>
                        <td>{{ idr($item->rupiah) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="text-align: center; font-weight: bold; font-style: italic">Total
                            Pengeluaran</td>
                        <td style="font-weight: bold">{{ idr($budgetRealizations->sum('rupiah')) }}</td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>

        <br><br>

        <div class="penutup new-page">
            <h3 style="text-align: center">BAB III</h3>
            <h3 style="text-align: center">PENUTUP</h3>
            {!! $report->penutup !!}
            <p class="normal-paragraph" style="text-align: center">Tasikmalaya, {{ $date }}</p>
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
                    @php
                    $path = storage_path('app/public/'.$report->signature->tanda_tangan);
                    $image = base64_encode(file_get_contents($path));
                    $base64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$image;
                    @endphp
                    <div class="signature-column">
                        <p class="signature-title">Pelaksana,</p>
                        <div>
                            <img src="{{ $base64 }}" width="120" alt="" srcset="">
                        </div>
                        <p class="signature-name"><u>{{ $report->signature->nama_pemilik }}</u></p>
                        <p class="signature-title" style="font-weight: bold">Ketua Pelaksana</p>
                    </div>
                </div>
                <div class="signature-wrapper">
                    <div class="signature-column">
                        <p class="signature-title">Menyetujui,</p>
                        <div>
                            <br><br>
                        </div>
                        <p class="signature-name"><u>{{ $report->signature2->nama_pemilik }}</u></p>
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
            {!! $report->press_release !!}
            <p>2. Dokumentasi Acara</p>
            @foreach ($documentations as $item)
            @php
            $path = public_path('storage/'.$item->filename);
            $image = base64_encode(file_get_contents($path));
            $base64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$image;
            @endphp
            <br>
            <img src="{{ $base64 }}" style="width: 100%" alt="" srcset="">
            <br><br>
            @endforeach

            <p>3. Daftar Hadir Peserta</p>
            @foreach ($attendances as $item)
            @php
            $path = public_path('storage/'.$item->filename);
            $image = base64_encode(file_get_contents($path));
            $base64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$image;
            @endphp
            <br>
            <img src="{{ $base64 }}" style="width: 100%" alt="" srcset="">
            <br><br>
            @endforeach
            <p>4. Bukti Kwitansi</p>
            @foreach ($receipts as $item)
            @php
            $path = public_path('storage/'.$item->filename);
            $image = base64_encode(file_get_contents($path));
            $base64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$image;
            @endphp
            <br>
            <img src="{{ $base64 }}" style="width: 100%" alt="" srcset="">
            <br><br>
            @endforeach
        </div>
    </div>
</body>

</html>