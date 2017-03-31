<table align="center">
	<tr>
		<td align="center"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="100"></td>
	</tr>
	<tr>
		<td align="center" class="text-bold titleSize">BAHAGIAN PENGURUSAN SUKAN<br />CAWANGAN PENGURUSAN BADAN SUKAN</td>
	</tr>
	<tr>
		<td align="center"><p class="text-underline text-bold"><?= $title ?></p></td>
	</tr>
</table>

<table>
	<tr>
		<td class="text-bold">Agensi</td><td>:</td><td><?= $model->pengurusan_permohonan_kursus_persatuan_id ?></td>
	</tr>
	<tr>
		<td class="text-bold">Nama Kursus</td><td>:</td><td>Kursus Pengurusan Sukan Kebangsaan (KPSK)</td>
	</tr>
	<tr>
		<td class="text-bold">Tahap</td><td>:</td><td><?= $model->tahap ?></td>
	</tr>
	<tr>
		<td class="text-bold">Kod Kursus</td><td>:</td><td><?= $model->kod_kursus ?></td>
	</tr>
	<tr>
		<td class="text-bold">Nama Penyelaras</td><td>:</td><td><?= $model->nama_penyelaras ?></td>
	</tr>
	<tr>
		<td class="text-bold">Tarikh Mula Kursus</td><td>:</td><td><?= date('d.m.Y', strtotime($model->tarikh_kursus)) ?></td>
	</tr>
		<tr>
		<td class="text-bold">Tarikh Tamat Kursus</td><td>:</td><td><?= date('d.m.Y', strtotime($model->tarikh_tamat_kursus)) ?></td>
	</tr>
	<tr>
		<td class="text-bold">Tempat Kursus</td><td>:</td><td><?= $model->tempat_kursus ?></td>
	</tr>
	<tr>
		<td class="text-bold">Instruktur</td><td>:</td><td><?= $model->instructor ?></td>
	</tr>
</table>

<table width="100%" align="center" style="text-align:center;margin:10px 0px" border="1" cellspacing="0" cellpadding="4">
	<tr>
		<td class="text-bold">Amat tidak setuju</td>
		<td class="text-bold">Tidak setuju</td>
		<td class="text-bold">Kurang setuju</td>
		<td class="text-bold">Setuju</td>
		<td class="text-bold">Sangat setuju</td>
	</tr>
	<tr>
		<td>1</td>
		<td>2</td>
		<td>3</td>
		<td>4</td>
		<td>5</td>
	</tr>
</table>

<table width="100%" style="" border="1" cellspacing="0" cellpadding="4">
	<tr>
		<th>BIL</th>
		<th>SOALAN</th>
		<th>SKALA</th>
	</tr>
	<?php
	$bil = 1;
	foreach($items as $item){
		?>
		<tr>
			<td align="center"><?= $bil ?></td>
			<td><?= $item->refSoalanPenilaianPendidikanPenganjurInstructor->desc ?></td>
			<td align="center"><?= $item->refRatingSoalan->desc ?></td>
		</tr>
		<?php
		$bil++;
	}
	?>
</table>