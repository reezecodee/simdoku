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
            padding: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: normal;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
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
        }

        .signature-name {
            font-weight: bold;
            margin-top: 5px;
            margin-bottom: 0;
        }

        .signature-nip {
            margin-top: 3px;
        }
    </style>
</head>

<body>
    <p style="text-align: right">Tasikmalaya, {{ $today }}</p>
    <div style="text-align: left; line-height: 0.7">
        <p>Kepada Yth.</p>
        <p>Kepala Divisi MER Universitas Bina Sarana Informatika</p>
        <p>{{ $letter->kepala_devisi_mer }}</p>
        <p>di</p>
        <p style="margin-left: 3rem; letter-spacing: 2px;"><u>JAKARTA</u></p>
    </div>
    <p style="text-align: justify">Perihal : <b>{{ $letter->perihal }}</b></p>
    <p style="text-align: justify; line-height: 1.5">Berikut kami kirimkan pengajuan Surat Tugas kegiatan <b>{{
            $letter->nama_acara }}</b>. Berikut Staf yang akan bertugas:</p>
    @if($executionStaffs->isNotEmpty())
    <table class="custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Sekolah</th>
                <th>Tanggal Pelaksanaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($executionStaffs as $execution)
            @php
            $relatedStaffs = $execution->staff;
            @endphp
            <tr>
                <td style="text-align: center" rowspan="{{ max($relatedStaffs->count(), 1) }}">{{ $loop->iteration }}
                </td>
                @if($relatedStaffs->count() == 0)
                <td colspan="3">Belum ada anggota</td>
                @else
                <td>
                    {{ $relatedStaffs->first()->nip }}
                </td>
                <td>
                    {{ $relatedStaffs->first()->nama }}
                </td>
                @endif
                <td style="text-align: center" rowspan="{{ max($relatedStaffs->count(), 1) }}">
                    <b>{{ $execution->nama_sekolah }}</b>
                </td>
                <td style="text-align: center" rowspan="{{ max($relatedStaffs->count(), 1) }}">
                    {{ $execution->tgl_pelaksanaan }}
                </td>
            </tr>

            @if($relatedStaffs->count() > 1)
            @foreach ($relatedStaffs->skip(1) as $staff)
            <tr wire:key="{{ $staff->id }}">
                <td>
                    {{ $staff->nip }}
                </td>
                <td>
                    {{ $staff->nama }}
                </td>
            </tr>
            @endforeach
            @endif
            @endforeach
        </tbody>
    </table>
    @endif

    @if($executionVolunteers->isNotEmpty())
    <p><b>Volunteer:</b></p>

    <table class="custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Sekolah</th>
                <th>Tanggal Pelaksanaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($executionVolunteers as $execution)
            @php
            $relatedVolunteers = $execution->volunteer;
            @endphp
            <tr>
                <td style="text-align: center" rowspan="{{ max($relatedVolunteers->count(), 1) }}">{{ $loop->iteration
                    }}</td>
                @if($relatedVolunteers->count() == 0)
                <td colspan="3">Belum ada anggota</td>
                @else
                <td>
                    {{ $relatedVolunteers->first()->nim }}
                </td>
                <td>
                    {{ $relatedVolunteers->first()->nama }}
                </td>
                @endif
                <td style="text-align: center" rowspan="{{ max($relatedVolunteers->count(), 1) }}">
                    <b>{{ $execution->nama_sekolah }}</b>
                </td>
                <td style="text-align: center" rowspan="{{ max($relatedVolunteers->count(), 1) }}">
                    {{ $execution->tgl_pelaksanaan }}
                </td>
            </tr>

            @if($relatedVolunteers->count() > 1)
            @foreach ($relatedVolunteers->skip(1) as $volunteer)
            <tr wire:key="{{ $volunteer->id }}">
                <td>
                    {{ $volunteer->nim }}
                </td>
                <td>
                    {{ $volunteer->nama }}
                </td>
            </tr>
            @endforeach
            @endif
            @endforeach
        </tbody>
    </table>
    @endif

    <p style="text-align: justify; text-indent: 3rem; line-height: 1.5">
        Demikian pengajuan ini kami sampaikan. Atas segala perhatian dan kebijakannya kami mengucapkan terimakasih</p>

    <div class="signature-container">
        <div class="signature-wrapper">
            <div class="signature-column">
                <p class="signature-title">Koordinator Markom UBSI Tasikmalaya</p>
                <div>
                    <img src="{{ $imgbase64 }}" width="120" alt="" srcset="">
                </div>
                <p class="signature-name">{{ $letter->signature->nama_pemilik }}</p>
                <p class="signature-nip">NIP. 201706153</p>
            </div>
            @php
            $path = storage_path('app/public/'.$user->tanda_tangan);
            $image = base64_encode(file_get_contents($path));
            $base64 = 'data:image/'.pathinfo($path, PATHINFO_EXTENSION).';base64,'.$image;
            @endphp
            <div class="signature-column">
                <p class="signature-title">Kepala Kampus UBSI Tasikmalaya</p>
                <div>
                    <img src="{{ $base64 }}" width="120" alt="" srcset="">
                </div>
                <p class="signature-name">{{ $user->nama }}</p>
                <p class="signature-nip">NIP. {{ $user->nip }}</p>
            </div>
        </div>
    </div>
</body>

</html>