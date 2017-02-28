<?php


?>

<!DOCTYPE html>
<body>
    <div class="form-title" style="margin:0px 0px 20px">
    PERMOHONAN JAWATANKUASA BANTUAN<br />
    BAHAGIAN ATLET<br />
    MAJLIS SUKAN NEGARA
    <?php
    if(isset($model->bilangan_jkb) && $model->bilangan_jkb != null){
        echo '<br />BIL : '.$model->bilangan_jkb.'<br />';
    }
    ?>
    </div>
    
    <table class="aTable" cellspacing="0" cellpadding="0">
      <tr>
        <th rowspan="2">BIL</th>
        <th rowspan="2">AKTIVITI</th>
        <th rowspan="2">I) TEMPAT<br>II) TARIKH<br>III) ATLET/PEG.<br>IV) LAIN-LAIN</th>
        <th colspan="3">PERMOHONAN</th>
        <th colspan="3">CADANGAN</th>
      </tr>
      <tr>
        <th>PERBELANJAAN DIPOHON</th>
        <th>JUMLAH</th>
        <th>CATATAN</th>
        <th>ANGGARAN PERBELANJAAN</th>
        <th>JUMLAH</th>
        <th>CATATAN</th>
      </tr>
      <tr>
        <td class="align-top">1.</td>
        <td class="align-top"><?= $model->nama_aktiviti ?><br /><br /><br /><div style="margin:40px 0px 0px">Sukan:<br /><?= $model->sukan ?></div></td>
        <td class="align-top text-left">I) <?= $model->tempat.', '.$model->negeri ?><br />
            II) <?= $model->tarikh_mula,'-'.$model->tarikh_tamat ?><br />
            III) <?= $totalOrang ?> orang
        </td>
        <td class="align-top">
            <?php
            $count = 1;
            $grandTotal = 0;
            foreach($binaanKosModel as $item)
            {
                $grandTotal = $grandTotal+$item->jumlah_dipohon;
                $kategori = \app\models\RefKategoriPerbelanjaan::findOne($item->kategori_perbelanjaan)->desc;
            ?>
            <div style="margin-bottom:50px">
            <?= $count ?>. <?= $kategori ?><br /><?= $item->perbelanjaan_dipohon ?>
            <?php
            if($item->kadar_pohon != null && $item->bilangan_pohon != null && $item->hari_pohon != null)
            {
                echo '<br />RM '.$item->kadar_pohon.' x '.$item->bilangan_pohon.' x '.$item->hari_pohon;
            } 
            ?>
                <br />Jumlah: RM <?= $item->jumlah_dipohon ?><br /><br />
            </div>
            <?php
                $count++;
            }
            ?>
        </td>
        <td class="align-bottom text-bold">RM <?= number_format((float)$grandTotal, 2, '.', '') ?></td>
        <td>
            <?php
            foreach($binaanKosModel as $item)
            {
                echo $item->catatan.'<br /><br />';
            }
            ?>
        </td>
        <td class="align-top">
            <?php
            $count = 1;
            $grandTotal = 0;
            foreach($binaanKosModel as $item)
            {
                $grandTotal = $grandTotal+$item->anggaran_perbelanjaan;
                $kategori = \app\models\RefKategoriPerbelanjaan::findOne($item->kategori_perbelanjaan)->desc;
            ?>
            <div style="margin-bottom:50px">
            <?= $count ?>. <?= $kategori ?><br /><?= $item->perbelanjaan_dipohon ?>
            <?php
            if($item->kadar_cadangan != null && $item->bilangan_cadangan != null && $item->hari_cadangan != null)
            {
                echo '<br />RM '.$item->kadar_cadangan.' x '.$item->bilangan_cadangan.' x '.$item->hari_cadangan;
            } 
            ?>
                <br />Jumlah: RM <?= $item->anggaran_perbelanjaan ?><br /><br />
            </div>
            <?php
                $count++;
            }
            ?>
        </td>
        <td class="align-bottom text-bold">RM <?= number_format((float)$grandTotal, 2, '.', '') ?></td>
        <td>
            <?php
            foreach($binaanKosModel as $item)
            {
                echo $item->catatan_cadangan.'<br /><br />';
            }
            ?>
        </td>
      </tr>
    </table>
</body>
</html>