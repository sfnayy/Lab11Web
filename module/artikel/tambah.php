<?php
$database = new Database();
// Action kosong artinya submit ke halaman ini sendiri
$form = new Form("", "Simpan Data");

// Menambahkan field input menggunakan method addField
$form->addField("judul", "Judul Artikel");
$form->addField("isi", "Isi Artikel", "textarea");

// Logika penyimpanan data
if (isset($_POST['judul'])) {
    $data = [
        'judul' => $_POST['judul'],
        'isi' => $_POST['isi']
    ];
    $simpan = $database->insert('artikel', $data);
    if ($simpan) {
        // Redirect sederhana menggunakan JavaScript karena header() sering bermasalah jika sudah ada output HTML
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='../artikel';</script>";
    } else {
        echo "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
    }
}
?>

<div class="row">
    <div class="col-md-6">
        <h3>Tambah Artikel</h3>
        <?php $form->displayForm(); ?>
    </div>
</div>