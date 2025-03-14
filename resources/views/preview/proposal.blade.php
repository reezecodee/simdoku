<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        @page {
            size: A4;
            margin: 2.5cm;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 11pt;
            width: 21cm;
            height: auto;
            margin: auto;
            box-sizing: border-box;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .paper {
            background: white;
            width: 100%;
            height: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 2.5cm;
            box-sizing: border-box;
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
            <h3>PROPOSAL</h3>
            <h2 style="font-style: italic">{{ $proposal->judul }}</h2>
            <h3>{{ $proposal->tahun }}</h3>
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
            <h3>{{ $proposal->tahun }}</h3>
        </div>

        <br><br>

        <div class="kata-pengantar new-page">
            <h3 style="text-align: center">KATA PENGANTAR</h3>
            {!! paragraph($proposal->kata_pengantar) !!}
            <br><br><br><br>
            <p class="normal-paragraph" style="text-align: right">Tasikmalaya, {{ $date }}</p>
            <p class="normal-paragraph" style="text-align: right">Penyusun</p>
            <br><br>
            <p class="normal-paragraph" style="text-align: right">{{ $user->nama }}</p>
        </div>

        <br><br>

        <div class="pendahuluan new-page">
            <h3 style="text-align: center">BAB I</h3>
            <h3 style="text-align: center">PENDAHULUAN</h3>
            <p class="normal-paragraph" style="font-weight: bold">1.1 Latar Belakang</p>
            {!! paragraph($proposal->introduction->latar_belakang) !!}
            <p class="normal-paragraph" style="font-weight: bold">1.2 Tujuan Kegiatan</p>
            {!! paragraph($proposal->introduction->tujuan_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">1.3 Indikator Keberhasilan</p>
            {!! paragraph($proposal->introduction->indikator_keberhasilan) !!}
        </div>

        <br><br>

        <div class="perencanaan-kegiatan new-page">
            <h3 style="text-align: center">BAB II</h3>
            <h3 style="text-align: center">PERENCANAAN KEGIATAN</h3>
            <p class="normal-paragraph" style="font-weight: bold">2.1 Nama dan Tema Kegiatan</p>
            {!! paragraph($proposal->planActivity->tema_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">2.2 Deskripsi Kegiatan</p>
            {!! paragraph($proposal->planActivity->deskripsi_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">2.3 Penyelenggara Kegiatan</p>
            {!! paragraph($proposal->planActivity->penyelenggara_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">2.4 Peserta Kegiatan</p>
            {!! paragraph($proposal->planActivity->peserta_kegiatan) !!}
            <p class="normal-paragraph" style="font-weight: bold">2.5 Waktu Pelaksanaan</p>
            {!! paragraph($proposal->planActivity->waktu_pelaksanaan) !!}

            @if($planSchedules->isNotEmpty())
            <p class="normal-paragraph" style="font-weight: bold">2.6 Susunan Acara</p>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planSchedules as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kegiatan }}</td>
                        <td>{{ $item->waktu }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            @if($committees->isNotEmpty())
            <p class="normal-paragraph" style="font-weight: bold">2.7 Susunan Panitia</p>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Panitia</th>
                        <th>Peran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($committees as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->peran }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            @if($budgets->isNotEmpty())
            <p class="normal-paragraph" style="font-weight: bold">2.8 Rencana Anggaran</p>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgets as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->uraian }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" style="text-align: center">Jumlah Pengeluaran</td>
                        <td style="text-align: center">Rp. {{ $budgets->sum('total') }}</td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>

        <br><br>

        <div class="penutup new-page">
            <h3 style="text-align: center">BAB III</h3>
            <h3 style="text-align: center">PENUTUP</h3>
            {!! paragraph($proposal->penutup) !!}
            <p class="normal-paragraph" style="text-align: right">Tasikmalaya, {{ $date }}</p>
            <p class="normal-paragraph">Hormat Kami,</p>
        </div>

        <div class="signature-container">
            <div class="signature-wrapper">
                <div class="signature-column">
                    <div>
                        <img src="{{ $imgbase64 }}" width="120" alt="" srcset="">
                    </div>
                    <p class="signature-name">{{ $proposal->signature->nama_pemilik }}</p>
                    <p class="signature-title">Ketua Panitia</p>
                </div>
                @php
                $path = storage_path('app/public/'.$user->tanda_tangan);
                $image = base64_encode(file_get_contents($path));
                $base64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$image;
                @endphp
                <div class="signature-column">
                    <div>
                        <img src="{{ $base64 }}" width="120" alt="" srcset="">
                    </div>
                    <p class="signature-name">{{ $user->nama }}</p>
                    <p class="signature-title">Kepala Kampus</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>