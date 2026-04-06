<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesan - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #f4f7f6; font-family: 'Inter', sans-serif; }
        .edit-container { max-width: 600px; margin: 100px auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .form-label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; }
        .form-input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 20px; }
        .btn-update { background: #28a745; color: white; padding: 12px 30px; border-radius: 8px; border: none; cursor: pointer; width: 100%; font-weight: 700; }
    </style>
</head>
<body>
    <div class="edit-container">
        <h1 class="text-2xl font-bold mb-6">Edit Pesan Tamu</h1>
        <form action="{{ route('admin.update', $entry) }}" method="POST">
            @csrf
            @method('PUT')
            
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-input" value="{{ $entry->name }}">
            
            <label class="form-label">Telepon</label>
            <input type="text" name="phone" class="form-input" value="{{ $entry->phone }}">
            
            <label class="form-label">Alamat</label>
            <input type="text" name="address" class="form-input" value="{{ $entry->address }}">
            
            <label class="form-label">Pesan</label>
            <textarea name="message" rows="5" class="form-input">{{ $entry->message }}</textarea>
            
            <button type="submit" class="btn-update">Update Pesan</button>
        </form>
    </div>
</body>
</html>
