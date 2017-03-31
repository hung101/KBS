<table align="center">
	<tr>
		<td align="center"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="100"></td>
	</tr>
	<tr>
		<td align="center" class="text-bold titleSize"><?= strtoupper($title) ?></td>
	</tr>
</table>

<table style="margin-top:10px">
    <tr>
        <td class="text-bold">NAMA JURULATIH</td><td>:</td><td><?= $model->nama_jurulatih_dinilai ?></td>
    </tr>
    <tr>
        <td class="text-bold">NAMA SUKAN</td><td>:</td><td><?= $model->nama_sukan ?></td>
    </tr>
	<tr>
        <td class="text-bold">NAMA ACARA</td><td>:</td><td><?= $model->nama_acara ?></td>
    </tr>
    <tr>
        <td class="text-bold">PUSAT LATIHAN</td><td>:</td><td><?= $model->pusat_latihan ?></td>
    </tr>
	<tr>
        <td class="text-bold">PENILAIAN OLEH</td><td>:</td><td><?= $model->penilaian_oleh  ?></td>
    </tr>
	<tr>
        <td class="text-bold">TARIKH DINILAI</td><td>:</td><td><?= date('d.m.Y', strtotime($model->tarikh_dinilai)) ?></td>
    </tr>
</table>

<table border="1" cellspacing="0" cellpadding="5" style="margin-top:10px" width="100%">
    <tr>
        <th>BIL</th>
        <th>KRITERIA PENILAIAN</th>
        <th>MARKAH PENILAIAN</th>
    </tr>
	<?php
	$bil = 1;
	foreach($items as $item)
	{
	?>
	<tr>
		<td align="center"><?= $bil ?></td>
		<td>
			<?= $item->refKategoriPenilaianJurulatih->desc ?>
			<?php if($item->refSubKategoriPenilaianJurulatih->desc): ?>
				<br />-<?= $item->refSubKategoriPenilaianJurulatih->desc ?>
			<?php endif; ?>
		</td>
		<td align="center"><?= $item->markah_penilaian ?></td>
	</tr>
	<?php
		$bil++;
	}
	?>
</table>