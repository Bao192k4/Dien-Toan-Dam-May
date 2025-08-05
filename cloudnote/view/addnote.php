<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm ghi chú</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Thêm ghi chú mới</h3>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="name_note" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="data" rows="5" class="form-control" required></textarea>
        </div>
        <button type="submit" name="add" class="btn btn-success">Lưu ghi chú</button>
        <a href="?action=home" class="btn btn-secondary ms-2">Quay lại</a>
    </form>
</div>
</body>
</html>