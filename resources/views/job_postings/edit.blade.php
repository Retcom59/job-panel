<!DOCTYPE html>
<html>
<head>
    <title>İlanı Düzenle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="container">
        <h1>İlanı Düzenle</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('job-postings.update', $jobPosting->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Başlık</label>
                <input type="text" name="title" class="form-control" value="{{ $jobPosting->title }}">
            </div>

            <div class="mb-3">
                <label>Açıklama</label>
                <textarea name="description" class="form-control">{{ $jobPosting->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Lokasyon</label>
                <input type="text" name="location" class="form-control" value="{{ $jobPosting->location }}">
            </div>

            <div class="mb-3">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                 Yayında mı?
                </label>
            </div>

            <button type="submit" class="btn btn-success">Güncelle</button>
        </form>
    </div>
</body>
</html>
