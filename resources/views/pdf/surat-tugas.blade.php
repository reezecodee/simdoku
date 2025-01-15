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
            padding: 1rem;
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
            font-weight: bold;
            text-align: center
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
    </style>
</head>

<body>
    <p style="text-align: right">Tasikmalaya, {{ $today }}</p>
    <div style="text-align: left; line-height: 0.7">
        <p>Kepada Yth.</p>
        <p>Kepala Divisi MER Universitas Bina Sarana Informatika</p>
        <p>Bapak Ir. Naba Aji Notoseputro, M.Kom</p>
        <p>di</p>
        <p style="margin-left: 3rem; letter-spacing: 2px;"><u>JAKARTA</u></p>
    </div>
    <p style="text-align: justify">Perihal : <b>Pengajuan Surat Tugas Edu Fair dan Job Fair SMAN 10 Tasikmalaya</b></p>
    <p style="text-align: justify">Berikut kami kirimkan pengajuan Surat Tugas kegiatan <b>Surat Tugas Edu Fair dan Job
            Fair SMAN 10 Tasikmalaya</b>. Berikut Staf yang akan bertugas:</p>

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
                <td rowspan="{{ max($relatedStaffs->count(), 1) }}">{{ $loop->iteration }}</td>
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
                <td rowspan="{{ max($relatedStaffs->count(), 1) }}">
                    {{ $execution->nama_sekolah }}
                </td>
                <td rowspan="{{ max($relatedStaffs->count(), 1) }}">
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

    <br><br>

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
                <td rowspan="{{ max($relatedVolunteers->count(), 1) }}">{{ $loop->iteration }}</td>
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
                <td rowspan="{{ max($relatedVolunteers->count(), 1) }}">
                    {{ $execution->nama_sekolah }}
                </td>
                <td rowspan="{{ max($relatedVolunteers->count(), 1) }}">
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
</body>

</html>