<div class="d-flex flex-column flex-lg-row mt-5 mb-4">
    <!-- judul halaman -->
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>EDC</h3>
    </div>
    <!-- breadcrumbs -->
    <div class="ms-5 ms-lg-0 pt-lg-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="https://pustakakoding.com/" class="text-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="?halaman=data" class="text-dark text-decoration-none">Data EDC</a></li>
                <li class="breadcrumb-item" aria-current="page">Entri</li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-5">
    <!-- judul form -->
    <div class="alert alert-primary rounded-4 mb-5" role="alert">
        <i class="fa-solid fa-pen-to-square me-2"></i> Entri Data EDC
    </div>
    <!-- form entri data -->
    <form action="proses_simpan.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-xl-6">
                <div class="row g-0">
                    <div class="mb-3 col-xl-6 pe-xl-3">
                        <?php
                        // membuat "id_siswa"
                        // sql statement untuk menampilkan 5 digit terakhir dari "id_siswa" pada tabel "tbl_siswa"
                        $query = $mysqli->query("SELECT RIGHT(id_siswa,5) as nomor FROM tbl_siswa ORDER BY id_siswa DESC LIMIT 1")
                                                 or die('Ada kesalahan pada query tampil data : ' . $mysqli->error);
                        // ambil jumlah baris data hasil query
                        $rows = $query->num_rows;

                        // cek hasil query
                        // jika "id_siswa" sudah ada
                        if ($rows <> 0) {
                            // ambil data hasil query
                            $data = $query->fetch_assoc();
                            // nomor urut "id_siswa" yang terakhir + 1
                            $nomor_urut = $data['nomor'] + 1;
                        }
                        // jika "id_siswa" belum ada
                        else {
                            // nomor urut "id_siswa" = 1
                            $nomor_urut = 1;
                        }

                        // menambahkan karakter "ID-" diawal dan karakter "0" disebelah kiri nomor urut
                        $id_siswa = "ID-" . str_pad($nomor_urut, 5, "0", STR_PAD_LEFT);
                        ?>
                        <label class="form-label">ID EDC <span class="text-danger">*</span></label>
                        <!-- tampilkan "id_siswa" -->
                        <input type="text" name="id_siswa" class="form-control" value="<?php echo $id_siswa; ?>" readonly>
                    </div>

                </div>
            </div>

            <div class="col-xl-6">
                <div class="mb-3 ps-xl-3">
                    <label class="form-label">Bank EDC <span class="text-danger">*</span></label>
                    <select name="kelas" class="form-select">
                        <option selected disabled value="">-- Pilih --</option>
                        <option value="BRI">BRI</option>
                        <option value="BNI">BNI</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BCA">BCA</option>
                    </select>
                </div>
            </div>
        </div>

        <hr class="mb-4-2">

        <div class="row">
            <div class="col-xl-6">
                <div class="mb-3 pe-xl-3">
                    <label class="form-label">Nama Mesin <span class="text-danger">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-control">
                </div>

                <div class="mb-3 pe-xl-3">
                    <label class="form-label">MDR ON US <span class="text-danger">*</span></label>
                    <input type="text" name="alamat" class="form-control">
                </div>

                <div class="mb-3 pe-xl-3">
                    <label class="form-label">MDR OF US <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control">
                </div>

                <div class="mb-3 pe-xl-3">
                    <label class="form-label">MDR QRIS <span class="text-danger">*</span></label>
                    <input type="text" name="whatsapp" class="form-control" maxlength="13">
                </div>
            </div>

            <div class="col-xl-6">
                <div class="mb-3 ps-xl-3">
                    <label class="form-label">Foto Bank EDC <span class="text-danger">*</span></label>
                    <input type="file" accept=".jpg, .jpeg, .png" id="foto" name="foto" class="form-control" autocomplete="off" required>
                    <div class="invalid-feedback">Foto profil tidak boleh kosong.</div>

                    <div class="mt-4">
                        <img id="preview_foto" src="images/img-default.png" class="border border-2 img-fluid rounded-4 shadow-sm" alt="Foto Profil" width="240" height="240">
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