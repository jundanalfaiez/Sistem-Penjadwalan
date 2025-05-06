<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal - PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Jadwal Kuliah</h1>
    <table>
        <thead>
            <tr>
                <th>Hari</th>
                <th>Waktu</th>
                <th>Matakuliah</th>
                <th>Semester</th>
                <th>Dosen</th>
                <th>Ruangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedule as $item)
                <tr>
                    <td>{{ $item['hari'] }}</td>
                    <td>{{ $item['waktu'] }}</td>
                    <td>{{ $item['matakuliah'] }}</td>
                    <td>{{ $item['periode'] }}</td>
                    <td>{{ $item['dosen'] }}</td>
                    <td>{{ $item['ruangan'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
