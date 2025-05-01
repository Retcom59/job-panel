<!DOCTYPE html>
<html>
<head>
    <title>Çöp Kutusu - İş İlanları</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="container">
        <h1>Çöp Kutusu - İş İlanları</h1>
        <a href="{{ route('job-postings.index') }}" class="btn btn-secondary mb-3">← İlanlara Geri Dön</a>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Lokasyon</th>
                    <th>Açıklama</th>
                    <th>Silinme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobPostings as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->location }}</td>
                        <td>{{ $job->description }}</td>
                        <td>{{ $job->deleted_at }}</td>
                        <td>
                            <!-- Restore İşlemi -->
                            <form action="{{ route('job-postings.restore', $job->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success">Geri Yükle</button>
                            </form>

                            <!-- Kalıcı Silme İşlemi -->
                            <form action="{{ route('job-postings.forceDelete', $job->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğine emin misin?')">Kalıcı Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
