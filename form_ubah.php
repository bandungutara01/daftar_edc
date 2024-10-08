<div class="d-flex flex-column flex-lg-row mt-5 mb-4">
    <!-- judul halaman -->
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Siswa</h3>
    </div>
    <!-- breadcrumbs -->
    <div class="ms-5 ms-lg-0 pt-lg-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="https://pustakakoding.com/" class="text-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="?halaman=data" class="text-dark text-decoration-none">Siswa</a></li>
                <li class="breadcrumb-item" aria-current="page">Ubah</li>
            </ol>
        </nav>
    </div>
</div>

<?php
// mengecek data GET "id_siswa"
if (isset($_GET['id'])) {
    // ambil data GET dari tombol ubah
    $id_siswa = $_GET['id'];

    // sql statement untuk menampilkan data dari tabel "tbl_siswa" berdasarkan "id_siswa"
    $query = $mysqli->query("SELECT * FROM tbl_siswa WHERE id_siswa='$id_siswa'")
                             or die('Ada kesalahan pada query tampil data : ' . $mysqli->error);
    // ambil data hasil query
    $data = $query->fetch_assoc();
}
?>

<div class="bg-white rounded-4 shadow-sm p-4 mb-5">
    <!-- judul form -->
    <div class="alert alert-primary rounded-4 mb-5" role="alert">
        <i class="fa-solid fa-pen-to-square me-2"></i> Ubah Data EDC
    </div>
    <!-- form ubah data -->
    <form action="proses_ubah.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-xl-6">
                <div class="row g-0">
                    <div class="mb-3 col-xl-6 pe-xl-3">
                        <label class="form-label">ID EDC <span class="text-danger">*</span></label>
                        <input type="text" name="id_siswa" class="form-control" value="<?php echo $data['id_siswa']; ?>" readonly>
                    </div>

                    <div class="mb-3 col-xl-6 pe-xl-3">
                        <label class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                        <input type="text" name="tanggal_daftar" class="form-control datepicker" autocomplete="off" value="<?php echo date('d-m-Y', strtotime($data['tanggal_daftar'])); ?>" required>
                        <div class="invalid-feedback">Tanggal daftar tidak boleh kosong.</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="mb-3 ps-xl-3">
                    <label class="form-label">Bank EDC <span class="text-danger">*</span></label>
                    <select name="kelas" class="form-select" autocomplete="off" required>
                        <option value="<?php echo $data['kelas']; ?>"><?php echo $data['kelas']; ?></option>
                        <option disabled value="">-- Pilih --</option>
                        <option value="BRI">BRI</option>
                        <option value="BNI">BNI</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BCA">BCA</option>
                        <option value="Web Design">Web Design</option>
                    </select>
                    <div class="invalid-feedback">Kelas tidak boleh kosong.</div>
                </div>
            </div>
        </div>

        <hr class="mb-4-2">

        <div class="row">
            <div class="col-xl-6">
                <div class="mb-3 pe-xl-3">
                    <label class="form-label">Nama Mesin <span class="text-danger">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $data['nama_lengkap']; ?>">
                </div>

                <div class="mb-3 pe-xl-3">
                    <label class="form-label">MDR On Us <span class="text-danger">*</span></label>
                    <textarea name="alamat" rows="2" class="form-control" required><?php echo $data['alamat']; ?></textarea>
                </div>

                <div class="mb-3 pe-xl-3">
                    <label class="form-label">MDR Off Us <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" autocomplete="off" value="<?php echo $data['email']; ?>">
                </div>

                <div class="mb-3 pe-xl-3">
                    <label class="form-label">MDR Qris<span class="text-danger">*</span></label>
                    <input type="text" name="whatsapp" class="form-control" maxlength="13" value="<?php echo $data['whatsapp']; ?>">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="mb-3 ps-xl-3">
                    <label class="form-label">Foto Profil</label>
                    <input type="file" accept=".jpg, .jpeg, .png" id="foto" name="foto" class="form-control" autocomplete="off">

                    <div class="mt-4">
                        <img id="preview_foto" src="images/<?php echo $data['foto_profil']; ?>" class="border border-2 img-fluid rounded-4 shadow-sm" alt="Foto Profil" width="240" height="240">
                    </div>

                    <div class="form-text mt-4">
                        Keterangan : <br>
                        - Tipe file yang bisa diunggah adalah *.jpg atau *.png. <br>
                        - Ukuran file yang bisa diunggah maksimal 1 Mb.
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4 pb-2 mt-5 border-top">
            <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                <!-- button simpan data -->
                <input type="submit" name="simpan" value="Simpan" class="btn btn-primary rounded-pill py-2 px-4">
                <!-- button kembali ke halaman tampil data -->
                <a href="?halaman=data" class="btn btn-secondary rounded-pill py-2 px-4">Batal</a>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    // validasi file dan preview file sebelum diunggah
    document.getElementById('foto').onchange = function() {
        // mengambil value dari file
        var fileInput = document.getElementById('foto');
        var filePath = fileInput.value;
        var fileSize = fileInput.files[0].size;
        // tentukan extension file yang diperbolehkan
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        // Jika tipe file yang diunggah tidak sesuai dengan "allowedExtensions"
        if (!allowedExtensions.exec(filePath)) {
            alert("Tipe file tidak sesuai. Harap unggah file yang memiliki tipe *.jpg atau *.png.");
            // reset input file
            fileInput.value = "";
            // tampilkan file default
            document.getElementById("preview_foto").src = "images/img-default.png";
        }
        // jika ukuran file yang diunggah lebih dari 1 Mb
        else if (fileSize > 1000000) {
            alert("Ukuran file lebih dari 1 Mb. Harap unggah file yang memiliki ukuran maksimal 1 Mb.");
            // reset input file
            fileInput.value = "";
            // tampilkan file default
            document.getElementById("preview_foto").src = "images/img-default.png";
        }
        // jika file yang diunggah sudah sesuai, tampilkan preview file
        else {
            var reader = new FileReader();

            reader.onload = function(e) {
                // preview file
                document.getElementById("preview_foto").src = e.target.result;
            };
            // membaca file sebagai data URL
            reader.readAsDataURL(this.files[0]);
        }
    };
</script>