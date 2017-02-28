<?php


?>

<!DOCTYPE html>
<body>
    <div class="form-title" style="margin:0px 0px 20px">
    PERMOHONAN JAWATANKUASA BANTUAN<br />
    BAHAGIAN ATLET<br />
    MAJLIS SUKAN NEGARA
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
        <td class="align-top"><?= $model->nama_kejohanan_temasya ?><br /><br /><br /><div style="margin:40px 0px 0px">Sukan:<br /><?= $model->nama_sukan ?></div></td>
        <td class="align-top text-left">I) <?= $model->tempat_penginapan ?><br />
            II) <?= $model->tarikh_mula,'-'.$model->tarikh_tamat ?><br />
            III) <?= $totalOrang ?> orang
        </td>
        <td class="align-top">
            <?php
            $count = 1;
            $grandTotal = 0;
            foreach($perbelanjaanSukanModel as $item)
            {
                $grandTotal = $grandTotal+$item->jumlah_pohon;
                $kategori = \app\models\RefKategoriPerbelanjaanSukan::findOne($item->kategori_perbelanjaan)->desc;
                ?>
                <div style="margin-bottom:50px">
                <?= $count ?>. <?= $kategori ?><br />
                <?php
                if($item->harga_pohon != null || $item->harga_pohon != '')
                {
                    echo 'RM '.$item->harga_pohon;
                }
                if($item->orang_pohon != null || $item->orang_pohon != '')
                {
                    echo ' x '.$item->orang_pohon;
                }
                if($item->hari_pohon != null || $item->hari_pohon != '')
                {
                    echo ' x '.$item->hari_pohon;
                }
                ?>
                    <br />Jumlah: RM <?= $item->jumlah_pohon ?><br /><br />
                </div>
                <?php
                $count++;
            }
            ?>
        </td>
        <td class="align-bottom text-bold">RM <?= number_format((float)$grandTotal, 2, '.', '') ?></td>
        <td class="align-top">
            <?php
            foreach($perbelanjaanSukanModel as $item)
            {
                echo $item->catatan_pohon.'<br /><br /><br /><br />';
            }
            ?>
        </td>
        <td class="align-top">
            <?php
            $count = 1;
            $grandTotal = 0;
            foreach($perbelanjaanSukanModel as $item)
            {
                $grandTotal = $grandTotal+$item->jumlah_cadang;
                $kategori = \app\models\RefKategoriPerbelanjaanSukan::findOne($item->kategori_perbelanjaan)->desc;
                ?>
                <div style="margin-bottom:50px">
                <?= $count ?>. <?= $kategori ?><br />
                <?php
                if($item->harga_cadang != null || $item->harga_cadang != '')
                {
                    echo 'RM '.$item->harga_cadang;
                }
                if($item->orang_cadang != null || $item->orang_cadang != '')
                {
                    echo ' x '.$item->orang_cadang;
                }
                if($item->hari_cadang != null || $item->hari_cadang != '')
                {
                    echo ' x '.$item->hari_cadang;
                }
                ?>
                    <br />Jumlah: RM <?= $item->jumlah_cadang ?><br /><br />
                </div>
                <?php
                $count++;
            }
            ?>
        </td>
        <td class="align-bottom text-bold">RM <?= number_format((float)$grandTotal, 2, '.', '') ?></td>
        <td class="align-top">
            <?php
            foreach($perbelanjaanSukanModel as $item)
            {
                echo $item->catatan_cadang.'<br /><br /><br /><br />';
            }
            ?>
        </td>
      </tr>
    </table>
</body>
</html>