<table align="center">
	<tr>
		<td><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="80"></td>
		<td align="center" class="text-bold titleSize">CAWANGAN PENGURUSAN JURULATIH<br /><?= strtoupper($title) ?></td>
	</tr>
</table>

<div class="text-center"><b>NAMA PEGAWAI</b>: <?= $model->nama_pegawai ?></div>

<table style="margin-top:10px">
    <tr>
        <td class="text-bold">TARIKH</td><td>:</td><td><?= date('d.m.Y', strtotime($model->tarikh_dinilai)) ?></td>
    </tr>
    <tr>
        <td class="text-bold">NAMA PUSAT LATIHAN</td><td>:</td><td><?= $model->pusat_latihan ?></td>
    </tr>
	<tr>
        <td class="text-bold">PROGRAM</td><td>:</td><td><?= $model->program_id ?></td>
    </tr>
    <tr>
        <td class="text-bold">SUKAN</td><td>:</td><td><?= $model->sukan_id ?></td>
    </tr>
	<tr>
        <td class="text-bold">NAMA JURULATIH</td><td>:</td><td><?= $model->jurulatih_id  ?></td>
    </tr>
</table>

<table border="1" cellspacing="0" cellpadding="5" style="margin-top:10px" width="100%">
    <tr>
        <th>BIL</th>
        <th>PEMERHATIAN</th>
        <th>SYOR</th>
        <th>ULASAN</th>
    </tr>
	<?php
	$bil = 1;
	foreach($items as $item)
	{
	?>
	<tr>
		<td align="center"><?= $bil ?></td>
		<td>
			<?= $item->refKategoriLaporanPenilaianJurulatih->desc ?>
			<?php if($item->refSubKategoriLaporanPenilaianJurulatih->desc): ?>
				:<br />-<?= $item->refSubKategoriLaporanPenilaianJurulatih->desc ?>
			<?php endif; ?>
		</td>
		<td><?= $item->syor ?></td>
		<td><?= $item->ulasan ?></td>
	</tr>
	<?php
		$bil++;
	}
	?>
</table>