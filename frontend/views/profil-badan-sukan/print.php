<table width="100%" border="1" cellspacing="0" cellpadding="10">
	<tr>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?></div>
		</td>
	</tr>
</table>

<br />
<?php
if($model->gambar != NULL && $model->gambar != ''){
	?>
	<img src="<?= Yii::$app->request->BaseUrl.'/'.$model->gambar ?>" width="200px" align="center">
	<?php
}
?>
<table>
    <tr>
        <td>NAMA BADAN SUKAN</td><td>:</td><td><?= $model->nama_badan_sukan ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("Nama Badan Sukan Sebelum Ini") ?></td><td>:</td><td><?= $model->nama_badan_sukan_sebelum_ini ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("Sijil Pendaftaran") ?></td><td>:</td><td><?= ($model->no_pendaftaran_sijil_pendaftaran != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("No Pendaftaran") ?></td><td>:</td><td><?= $model->no_pendaftaran ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("Tarikh Lulus Pendaftaran") ?></td><td>:</td><td><?= $model->tarikh_lulus_pendaftaran ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("Peringkat Badan Sukan") ?></td><td>:</td><td><?= $model->peringkat_badan_sukan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Jenis Sukan") ?></td><td>:</td><td><?= $model->jenis_sukan ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Alamat Tetap Badan Sukan") ?></td><td valign="top">:</td><td><?= ($model->alamat_tetap_badan_sukan_1)?$model->alamat_tetap_badan_sukan_1.'<br />':null ?><?= ($model->alamat_tetap_badan_sukan_2)?$model->alamat_tetap_badan_sukan_2.'<br />':null ?><?= ($model->alamat_tetap_badan_sukan_3)?$model->alamat_tetap_badan_sukan_3.'<br />':null ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Negeri") ?></td><td>:</td><td><?= $model->alamat_tetap_badan_sukan_negeri ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Bandar") ?></td><td>:</td><td><?= $model->alamat_tetap_badan_sukan_bandar ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Poskod") ?></td><td>:</td><td><?= $model->alamat_tetap_badan_sukan_poskod ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("No Telefon Pejabat") ?></td><td>:</td><td><?= $model->no_telefon_pejabat ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("No Telefon Pejabat 2") ?></td><td>:</td><td><?= $model->no_telefon_pejabat_2 ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("No Telefon Pejabat 3") ?></td><td>:</td><td><?= $model->no_telefon_pejabat_3 ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("No Faks Pejabat") ?></td><td>:</td><td><?= $model->no_faks_pejabat ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("No Telefon Bimbit") ?></td><td>:</td><td><?= $model->no_tel_bimbit ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Emel Badan Sukan") ?></td><td>:</td><td><?= $model->emel_badan_sukan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Pengelola Badan Sukan Antarabangsa") ?></td><td>:</td><td><?= $model->pengiktirafan_yang_pernah_diterima_badan_sukan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Status") ?></td><td>:</td><td><?= $model->status ?></td>
    </tr>
</table>

