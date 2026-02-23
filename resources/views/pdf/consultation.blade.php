<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rekam Medis Konsultasi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .header small {
            font-size: 12px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 18px;
            margin-bottom: 6px;
            border-bottom: 1px solid #000;
            padding-bottom: 4px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        thead th {
            border: 1px solid #000;
            padding: 6px;
            background-color: #2e7d32;
            color: #ffffff;
            text-align: center;
            font-weight: bold;
        }

        tbody td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>REKAM MEDIS PASIEN</h2>
        <small>
            Rumah Sehat • Dicetak {{ now()->timezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB
        </small>
    </div>

    <!-- ================= DATA PASIEN ================= -->
    <div class="section-title">Data Pasien</div>
    <table>
        <thead>
            <tr>
                <th>Nama Pasien</th>
                <th>No. Rekam Medis</th>
                <th>Tanggal Lahir</th>
                <th>No. Telepon</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $consultation->patient->full_name ?? '-' }}</td>
                <td>{{ $consultation->patient->medical_record_number ?? '-' }}</td>
                <td>{{ optional($consultation->patient->birth_date)->format('d/m/Y') ?? '-' }}</td>
                <td>{{ $consultation->patient->phone ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- ================= INFORMASI KONSULTASI ================= -->
    <div class="section-title">Informasi Konsultasi</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal & Waktu Konsultasi</th>
                <th>Dokter Pemeriksa</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ optional($consultation->consultation_datetime)->format('d/m/Y H:i') }}</td>
                <td>{{ $consultation->doctor->name ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- ================= CATATAN MEDIS (GABUNG) ================= -->
    <div class="section-title">Catatan Medis</div>
    <table>
        <thead>
            <tr>
                <th>Keluhan Utama</th>
                <th>Sakit yang dirasakan Sekarang</th>
                <th>Riwayat Penyakit Dahulu</th>
                <th>Pemeriksaan Fisik</th>
                <th>Diagnosis</th>
                <th>Rencana Tindakan</th>
                <th>Catatan Dokter</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{!! nl2br(e($consultation->chief_complaint)) !!}</td>
                <td>{!! nl2br(e($consultation->current_illness_history)) !!}</td>
                <td>{!! nl2br(e($consultation->past_medical_history)) !!}</td>
                <td>{!! nl2br(e($consultation->physical_examination)) !!}</td>
                <td>{!! nl2br(e($consultation->diagnosis)) !!}</td>
                <td>{!! nl2br(e($consultation->treatment_plan)) !!}</td>
                <td>{!! nl2br(e($consultation->doctor_notes)) !!}</td>
            </tr>
        </tbody>
    </table>

    <!-- ================= METADATA ================= -->
    <div class="section-title">Informasi Sistem</div>
    <table>
        <thead>
            <tr>
                <th>Dibuat Pada</th>
                <th>Terakhir Diperbarui</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ optional($consultation->created_at)->format('d/m/Y H:i') }}</td>
                <td>{{ optional($consultation->updated_at)->format('d/m/Y H:i') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- ================= TANDA TANGAN ================= -->
    <div class="footer">
        <p>Dokter Pemeriksa,</p>
        <br><br>
        <strong>{{ $consultation->doctor->name ?? '-' }}</strong>
    </div>

</body>

</html>
