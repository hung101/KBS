<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
</head>
<body>
    <div class="form-title" style="margin:0px 0px 20px">
    PERMOHONAN JAWATANKUASA BANTUAN<br />
    BAHAGIAN ATLET<br />
    MAJLIS SUKAN NEGARA
    </div>
	
	<table border="0" cellspacing="2" cellpadding="0">
		<tr>
			<td class="text-bold">PROGRAM</td>
			<td>:</td>
			<td><?= $model->program ?></td>
		</tr>
		<tr>
			<td class="text-bold">SUKAN</td>
			<td>:</td>
			<td><?= $model->nama_sukan ?></td>
		</tr>
	</table>
    
    <table id="data" style="margin-top:10px">
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
      <?php
      $grandTotalPohon = 0;
      $grandTotalCadang = 0;
	  $itemBil = 1;
	  $tdStyle = 'border-bottom:0;border-right:1px solid; border-left:1px solid';
      foreach($perbelanjaanSukanModel as $key => $value)
      {
          if($key === (count($perbelanjaanSukanModel)-1)){
			  $tdStyle = 'border-bottom:1px solid;border-right:1px solid; border-left:1px solid';
		  }
      ?>
	  	<tr>
			<td style="<?= $tdStyle ?>" class="align-top">
				<?php if($key === 0) echo '1.'; ?>
			</td>
			<td class="align-top text-left" style="<?= $tdStyle ?>">
				<?php
				if($key === 0){
					if ($model->nama_kejohanan_temasya != null)
					{
						echo $model->nama_kejohanan_temasya;
					}
					?><br /><br />
					<div style="margin:40px 0px 0px">Sukan:<br /><?= $model->nama_sukan ?></div>
				<?php
				}
				?>
			</td>
			<td class="align-top text-left" style="<?= $tdStyle ?>">
			<?php
			if($key === 0){
				if ($model->tempat_penginapan != null) {
					echo 'I) '.$model->tempat_penginapan;
				}
				if ($model->tarikh_mula != null) {
					echo '<br />II) '.$model->tarikh_mula;
				}
				if ($model->tarikh_tamat != null) {
					echo '-'.$model->tarikh_tamat;
				}
				if ($totalOrang != null) {
					echo '<br />III) Atlet: '.$atletCount.', ';
					echo 'Jurulatih: '.$jurulatihCount.', ';
					echo 'Pegawai: '.$pegawaiCount.', ';
					echo 'Pengurus Sukan: '.$pengurusCount.'<br />';
					echo 'Jumlah: '.$totalOrang.' orang';
				}
			}
            ?>
			</td>
			<td class="align-top" style="<?= $tdStyle ?>">
				<?php
				$grandTotalPohon = $grandTotalPohon+$value['jumlah_pohon'];
				$ref = \app\models\RefKategoriPerbelanjaanSukan::findOne($value['kategori_perbelanjaan']);
                $kategori = $ref['desc'];
				?>
				<?= $itemBil ?>. <?= $kategori ?><br /><?= $value['perkara'] ?><br />
				<?php
				if($value['harga_pohon'] != null || $value['harga_pohon'] != '')
                {
                    echo 'RM '.$value['harga_pohon'];
                }
                if($value['orang_pohon'] != null || $value['orang_pohon'] != '')
                {
                    echo ' x '.$value['orang_pohon'];
                }
                if($value['hari_pohon'] != null || $value['hari_pohon'] != '')
                {
                    echo ' x '.$value['hari_pohon'];
                }
                ?>
                <br />Jumlah: RM <?= $value['jumlah_pohon'] ?>
			</td>
			<td class="align-bottom text-bold" style="<?= $tdStyle ?>">
			<?php
            if($key === (count($perbelanjaanSukanModel)-1))
            {
                echo 'RM '.number_format((float)$grandTotalPohon, 2, '.', '');
            }
            ?>
            </td>
			<td valign="top" style="<?= $tdStyle ?>">
				<?= $value['catatan_pohon'] ?>
			</td>
			<td class="align-top" style="<?= $tdStyle ?>">
				<?php
				$grandTotalCadang = $grandTotalCadang+$value['jumlah_cadang'];
				$ref = \app\models\RefKategoriPerbelanjaanSukan::findOne($value['kategori_perbelanjaan']);
                $kategori = $ref['desc'];
				?>
				<?= $itemBil ?>. <?= $kategori ?><br /><?= $value['perkara'] ?><br />
				<?php
				if($value['harga_cadang'] != null || $value['harga_cadang'] != '')
                {
                    echo 'RM '.$value['harga_cadang'];
                }
                if($value['orang_cadang'] != null || $value['orang_cadang'] != '')
                {
                    echo ' x '.$value['orang_cadang'];
                }
                if($value['hari_cadang'] != null || $value['hari_cadang'] != '')
                {
                    echo ' x '.$value['hari_cadang'];
                }
                ?>
                <br />Jumlah: RM <?= $value['jumlah_cadang'] ?>
			</td>
			<td class="align-bottom text-bold" style="<?= $tdStyle ?>">
			<?php
            if($key === (count($perbelanjaanSukanModel)-1))
            {
                echo 'RM '.number_format((float)$grandTotalCadang, 2, '.', '');
            }
            ?>
            </td>
			<td valign="top" style="<?= $tdStyle ?>">
				<?= $value['catatan_cadang'] ?>
			</td>
		</tr>
		<?php
		$itemBil++;
	  }
	  ?>
    </table>
</body>
</html>