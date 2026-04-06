<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Buku Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #f4f7f6; font-family: 'Inter', sans-serif; }
        .admin-container { max-width: 1000px; margin: 50px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; color: #666; }
        .btn-edit { color: #007bff; text-decoration: none; margin-right: 10px; font-weight: 600; }
        .btn-delete { color: #dc3545; background: none; border: none; cursor: pointer; font-weight: 600; padding: 0; }
        .alert-success { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Admin Panel - Daftar Tamu</h1>
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-black">← Kembali ke Web</a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Pesan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                <tr>
                    <td><strong>{{ $entry->name }}</strong></td>
                    <td>{{ $entry->phone }}</td>
                    <td>{{ $entry->address }}</td>
                    <td class="italic">"{{ Str::limit($entry->message, 50) }}"</td>
                    <td>
                        <a href="{{ route('admin.edit', $entry) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('admin.destroy', $entry) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Hapus pesan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
