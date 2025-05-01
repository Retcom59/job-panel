<!DOCTYPE html>
<html>
<head>
    <title>İş İlanları</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="container">
        <h1>İş İlanları</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('job-postings.create') }}" class="btn btn-primary">Yeni İlan Ekle</a>
            

            <!-- Yayında mı? filtresi -->
            <form method="GET" class="d-flex align-items-center">
                <label for="is_active" class="me-2 mb-0">Yayında Filtresi:</label>
                <select name="is_active" id="is_active" class="form-select" onchange="this.form.submit()">
                    <option value="">Tüm İlanlar</option>
                    <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Yayında</option>
                    <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Yayında Değil</option>
                </select>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Lokasyon</th>
                    <th>Açıklama</th>
                    <th>Yayında mı?</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobPostings as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->location }}</td>
                        <td>{{ $job->description }}</td>
                        <td>{{ $job->is_active ? 'Evet' : 'Hayır' }}</td>
                        <td>
                            <a href="{{ route('job-postings.edit', $job->id) }}" class="btn btn-sm btn-warning">Düzenle</a>
                            <form action="{{ route('job-postings.destroy', $job->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğine emin misin?')">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('job-postings.trash') }}" class="btn btn-danger mb-3">Çöp Kutusu</a>

    </div>
</body>
</html>
