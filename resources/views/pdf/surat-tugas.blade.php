<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 14px;
            padding: 20px;
            line-height: 1.5;
        }

        .header {
            text-align: right;
            margin-bottom: 20px;
        }

        .recipient {
            margin-bottom: 20px;
        }

        .subject {
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #000;
        }

        th {
            background-color: #f2f2f2;
        }

        .volunteer {
            margin-top: 20px;
        }

        .footer {
            margin-top: 20px;
        }

        .signatures {
            display: table;
            width: 100%;
            margin-top: 30px;
        }

        .signature {
            display: table-cell;
            text-align: center;
            vertical-align: top;
            width: 50%;
        }

        .signature img {
            max-width: 150px;
            margin: 10px 0;
        }

        .signature p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Tasikmalaya, 25 Oktober 2024</h2>
    </div>
    <div class="recipient">
        <p>Kepada Yth.</p>
        <p>Kepala Divisi MER Universitas Bina Sarana Informatika</p>
        <p>Bangl. Naba Aji Notosepuro, M.Kom</p>
        <p>di</p>
        <p>JAKARTA</p>
    </div>
    <div class="subject">
        <p>Perihal: Pengajuan Surat Tugas Edu Fair dan Job Fair SMAN 10 Tasikmalaya</p>
    </div>
    <div class="table">
        <table>
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
                <tr>
                    <td>1</td>
                    <td>200809852</td>
                    <td>Agung Baitul Hikmah, S.Kom.</td>
                    <td>SMAN 10 Tasikmalaya</td>
                    <td>29 Oktober 2024<br>Pukul 07.00 - 16.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>202108185</td>
                    <td>Haerul Fatah, S.Kom, M.Kom</td>
                    <td>SMAN 10 Tasikmalaya</td>
                    <td>29 Oktober 2024<br>Pukul 07.00 - 16.00</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="volunteer">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>Sekolah</th>
                    <th>Tanggal Pelaksanaan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>19231512</td>
                    <td>Fauziah Nur Madinah</td>
                    <td>SMAN 10 Tasikmalaya</td>
                    <td>11 Oktober 2024<br>Pukul 07.00 - 16.00</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>Demikian pengajuan ini kami sampaikan. Atas segala perhatian dan kebijakannya kami mengucapkan terima kasih.</p>
        <div class="signatures">
            <div class="signature">
                <p>Koordinator Markom UBSI Tasikmalaya</p>
                <img src="signature1.png" alt="Signature 1">
                <p>Herlan Sutisna, S.T, M.Kom<br>NIP. 201706153</p>
            </div>
            <div class="signature">
                <p>Kepala Kampus UBSI Tasikmalaya</p>
                <img src="signature2.png" alt="Signature 2">
                <p>Agung Baitul Hikmah, S.Kom<br>NIP. 200809852</p>
            </div>
        </div>
    </div>
    ppp
    <br>
    {!! $image !!}
</body>

</html>
