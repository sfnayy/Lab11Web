<?php
// Cek Login
if (!isset($_SESSION['is_login'])) {
    header('Location: ' . BASE_URL . '/user/login');
    exit;
}

$db = new Database();

// --- LOGIKA PENCARIAN & PAGINATION ---

// 1. Ambil keyword pencarian (jika ada)
$q = isset($_GET['q']) ? $_GET['q'] : "";

// 2. Buat klausa WHERE jika ada pencarian
$where = "";
if ($q) {
    // Cari berdasarkan Judul
    $where = " WHERE judul LIKE '%{$q}%' OR kategori LIKE '%{$q}%'";
}

// 3. Konfigurasi Pagination
$limit = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// 4. Hitung Total Data (Sesuai Filter Pencarian)
// Penting: Hitung total data yang COCOK dengan pencarian saja
$query_total = "SELECT COUNT(*) AS total FROM artikel" . $where;
$result_total = $db->query($query_total);
$row_total = $result_total->fetch_assoc();
$total_data = $row_total['total'];

// 5. Hitung Jumlah Halaman
$total_pages = ceil($total_data / $limit);

// 6. Query Data Utama (Gabungan Filter + Limit)
$sql = "SELECT * FROM artikel" . $where . " ORDER BY id DESC LIMIT {$offset}, {$limit}";
$result = $db->query($sql);
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Data Artikel</h4>
        <a href="tambah" class="btn btn-light btn-sm text-primary fw-bold">+ Tambah Artikel</a>
    </div>
    
    <div class="card-body">
        
        <form method="GET" action="" class="mb-3">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Cari judul atau kategori..." value="<?= htmlspecialchars($q) ?>">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
                <?php if ($q): ?>
                    <a href="index" class="btn btn-outline-secondary">Reset</a>
                <?php endif; ?>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="text-center">
                                <?php if (isset($row['gambar']) && $row['gambar']): ?>
                                    <img src="<?= BASE_URL . '/gambar/' . $row['gambar'] ?>" alt="Img" width="50" class="img-thumbnail">
                                <?php else: ?>
                                    <span class="text-muted small">No Img</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $row['judul'] ?></td>
                            <td><?= $row['kategori'] ?? '-' ?></td>
                            <td><?= $row['penulis'] ?? '-' ?></td>
                            <td class="text-center">
                                <a href="ubah?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="hapus?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Data tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($total_pages > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                
                <?php if ($page > 1): ?>
                    <li><a href="?page=<?= $page - 1 ?>&q=<?= $q ?>">&laquo; Prev</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li>
                        <a href="?page=<?= $i ?>&q=<?= $q ?>" class="<?= ($page == $i) ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li><a href="?page=<?= $page + 1 ?>&q=<?= $q ?>">Next &raquo;</a></li>
                <?php endif; ?>
                
            </ul>
        </nav>
        <?php endif; ?>
        
    </div>
</div>