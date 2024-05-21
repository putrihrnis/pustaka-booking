<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Anggota Perpustakaan Online</title>
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }
        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            padding: 10px;
        }
        h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Laporan Data Anggota Perpustakaan Online</h3>
    <br>
    <table class="table-data">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col" nowrap>Member Sejak</th>
                        <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 2;
                    foreach ($anggota as $a) { ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $a['nama']; ?></td>
                            <td><?= $a['email']; ?></td>
                            <td><?= date('d F Y', $a['tanggal_input']); ?></td>
                            <td>
                                <picture>
                                    <source srcset="" type="image/svg+xml">
                                    <img src="<?= base_url('assets/img/profile/') . $a['image']; ?>" class="img-fluid img-thumbnail" alt="..." style="width:60px;height:80px;">
                                </picture>
                            </td>
                            <!--<td>
                                        <a href="<?
                                                    ?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                                        <a href="<?
                                                    ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $b['judul_buku']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
                                    </td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
</body>
</html>
