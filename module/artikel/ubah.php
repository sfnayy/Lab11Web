<?php
$id = isset($segments[2]) ? $segments[2] : null;
$database = new Database();
$form = new Form("", "Update Data");

// Redirect jika tidak ada ID
if (!$id) {
    header("Location: ../artikel");
    exit;
}

// Ambil data lama berdasarkan ID
// Fungsi get() di Class Database kita mengembalikan array satu baris
$data_lama = $database->get("artikel", "id=" . $id);

// Tambahkan field form
$form->addField("judul", "Judul Artikel");
$form->addField("isi", "Isi Artikel", "textarea");

// Tampilkan form dengan value lama (Manual injeksi value karena Class Form kita sederhana)
// Catatan: Class Form di praktikum ini belum punya fitur "setValue" otomatis,
// jadi kita akali dengan Javascript atau modifikasi library.
// Agar simpel sesuai modul, kita biarkan form kosong atau isi manual lewat $_POST update.
// Tapi mari kita buat logika Update-nya:

if (isset($_POST['judul'])) {
    $data_baru = [
        'judul' => $_POST['judul'],
        'isi' => $_POST['isi']
    ];
    $update = $database->update('artikel', $data_baru, "id=" . $id);
    if ($update) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='../../artikel';</script>";
    } else {
        echo "<div class='alert alert-danger'>Gagal mengupdate data.</div>";
    }
}
?>

<div class="row">
    <div class="col-md-6">
        <h3>Ubah Artikel</h3>
        <div class="alert alert-info">
            Edit Data untuk: <b><?php echo $data_lama['judul']; ?></b>
        </div>
        <?php $form->displayForm(); ?>
    </div>
</div>