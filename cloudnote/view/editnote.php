<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa ghi chú</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Sửa ghi chú</h3>
    <form method="post">
        <input type="hidden" name="id_note" value="<?= $note['id_note'] ?>">
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="name_note" class="form-control" value="<?= htmlspecialchars($note['name_note']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="data" rows="5" class="form-control" required><?= htmlspecialchars($note['data']) ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
        <a href="?action=home" class="btn btn-secondary ms-2">Quay lại</a>
    </form>
</div>
</body>
</html>