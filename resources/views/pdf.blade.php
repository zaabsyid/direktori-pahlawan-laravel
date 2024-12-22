<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Pahlawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }

        img {
            width: 60px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Direktori Pahlawan</h1>
        <h4>Alfa Falah - 1152000029</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Pahlawan</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pahlawans as $index => $pahlawan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ public_path('storage/' . $pahlawan->photo) }}" alt="{{ $pahlawan->name }}">
                        </td>
                        <td>{{ $pahlawan->name }}</td>
                        <td>{{ $pahlawan->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="footer">
            &copy; {{ date('Y') }} Direktori Pahlawan
        </div> --}}
    </div>
</body>

</html>
