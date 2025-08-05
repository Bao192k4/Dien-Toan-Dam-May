<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Ghi chú của bạn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white">
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Xin chào, <?= $_SESSION['name'] ?> 👋</h4>
        <a href="?action=logout" class="btn btn-outline-danger">Đăng xuất</a>
    </div>

    <form method="post" action="?action=search" class="input-group mb-3">
        <input type="text" name="keyword" class="form-control" placeholder="Tìm ghi chú...">
        <button class="btn btn-outline-secondary" type="submit">Tìm</button>
    </form>

    <a href="?action=addnote" class="btn btn-primary mb-3">➕ Thêm ghi chú</a>

    <?php if (!empty($notes)): ?>
    <div class="row">
        <?php foreach ($notes as $note): ?>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($note['name_note']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($note['data'])) ?></p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="?action=editnote&id_note=<?= $note['id_note'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                        <a href="?action=delete&id_note=<?= $note['id_note'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa ghi chú này?')">Xóa</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Bạn chưa có ghi chú nào.</p>
<?php endif; ?>

        <p class="text-muted">Bạn chưa có ghi chú nào.</p>
    
</div>
</body>
</html>