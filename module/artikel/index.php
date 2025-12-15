<?php
// Ingat: Class Database sudah di-include di index.php utama, jadi tidak perlu include lagi
$db = new Database();
$data = $db->query("SELECT * FROM artikel");
?>

<div class="row">
    <div class="col-md-12">
        <h3>Daftar Artikel</h3>
        <p><a href="artikel/tambah" class="btn btn-primary btn-sm">Tambah Artikel</a></p>
        <table class="table table-bordered">
            <tr>
                <th>Nomor</th>
                <th>Judul</th>
                <th>Aksi</th>
            </tr>
            <?php
            if ($data->num_rows > 0) {
                $no = 1;
                while ($row = $data->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['judul'] . "</td>";
                    // Link ubah menggunakan routing: artikel/ubah/ID
                    echo "<td>
                            <a href='artikel/ubah/" . $row['id'] . "' class='btn btn-warning btn-sm'>Ubah</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Belum ada data.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>