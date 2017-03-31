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
    <?php
    if(isset($model->bilangan_jkb) && $model->bilangan_jkb != null){
        echo '<br />BIL : '.$model->bilangan_jkb.'<br />';
    }
    ?>
    </div>
    
    <table id="data">
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
      foreach($binaanKosModel as $key => $value)
      {
		  if($key === (count($binaanKosModel)-1)){
			  $tdStyle = 'border-bottom:1px solid;border-right:1px solid; border-left:1px solid';
		  }
		?>
		<tr>
			<td style="<?= $tdStyle ?>" class="align-top">
				<?php if($key === 0) echo '1.'; ?>
			</td>
			<td style="<?= $tdStyle ?>">
			<?php 
				if($key === 0){
					if ($model->nama_aktiviti != null)
					{
						echo $model->nama_aktiviti.'<br /><br />';
					}
					echo 'Sukan:<br />'.$model->sukan;
				}
			?>
			</td>
			<td class="align-top text-left" style="<?= $tdStyle ?>">
				<?php
				if($key === 0){
					if ($model->tempat != null) {
						echo 'I) '.$model->tempat;
					}
					if ($model->negeri != null) {
						echo ', '.$model->negeri.'<br />';
					}
					if ($model->tarikh_mula != null) {
						echo 'II) '.$model->tarikh_mula;
					}
					if ($model->tarikh_tamat != null) {
						echo '-'.$model->tarikh_tamat.'<br />';
					}
					if ($totalOrang != null) {
						echo $totalOrang.' orang';
					}
				}
				?>
			</td>
			<td class="align-top" style="<?= $tdStyle ?>">
				<?php
				$grandTotalPohon = $grandTotalPohon+$value['jumlah_dipohon'];
				$ref = \app\models\RefKategoriPerbelanjaan::findOne($value['kategori_perbelanjaan']);
                $kategori = $ref['desc'];
				?>
				<?= $itemBil ?>. <?= $kategori ?><br /><?= $value['perbelanjaan_dipohon'] ?>
				<?php
				if($value['kadar_pohon'] != null && $value['bilangan_pohon'] != null && $value['hari_pohon'] != null)
				{
					echo '<br />RM '.$value['kadar_pohon'].' x '.$value['bilangan_pohon'].' x '.$value['hari_pohon'];
				} 
				?>
					<br />Jumlah: RM <?= $value['jumlah_dipohon'] ?>
			</td>
			<td class="align-bottom text-bold" style="<?= $tdStyle ?>">
			<?php
            if($key === (count($binaanKosModel)-1))
            {
                echo 'RM '.number_format((float)$grandTotalPohon, 2, '.', '');
            }
            ?>
            </td>
			<td valign="top" style="<?= $tdStyle ?>">
				<?= $value['catatan'] ?>
			</td>
			<td class="align-top" style="<?= $tdStyle ?>">
				<?php
				$grandTotalCadang = $grandTotalCadang+$value['anggaran_perbelanjaan'];
				$ref = \app\models\RefKategoriPerbelanjaan::findOne($value['kategori_perbelanjaan']);
                $kategori = $ref['desc'];
				?>
				<?= $itemBil ?>. <?= $kategori ?><br /><?= $value['perbelanjaan_dipohon'] ?>
				<?php
				if($value['kadar_cadangan'] != null && $value['bilangan_cadangan'] != null && $value['hari_cadangan'] != null)
				{
					echo '<br />RM '.$value['kadar_cadangan'].' x '.$value['bilangan_cadangan'].' x '.$value['hari_cadangan'];
				} 
				?>
					<br />Jumlah: RM <?= $value['anggaran_perbelanjaan'] ?>
			</td>
			<td class="align-bottom text-bold" style="<?= $tdStyle ?>">
			<?php
            if($key === (count($binaanKosModel)-1))
            {
                echo 'RM '.number_format((float)$grandTotalCadang, 2, '.', '');
            }
            ?>
            </td>
			<td valign="top" style="<?= $tdStyle ?>">
				<?= $value['catatan_cadangan'] ?>
			</td>
		</tr>
		<?php
		$itemBil++;
	  }
	  ?>
    </table>
</body>
</html>