<table width="100%" border="1" cellspacing="0" cellpadding="10">
	<tr>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?></div>
		</td>
	</tr>
</table>

<br />
<table>
    <tr>
        <td>BADAN SUKAN</td><td>:</td><td><?= $model->profil_badan_sukan_id ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Nama") ?></td><td>:</td><td><?= $model->nama ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("Peringkat Badan Sukan") ?></td><td>:</td><td><?= $model->peringkat_badan_sukan ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Alamat Badan Sukan") ?></td><td valign="top">:</td><td><?= ($model->alamat_badan_sukan_1)?$model->alamat_badan_sukan_1.'<br />':null ?><?= ($model->alamat_badan_sukan_2)?$model->alamat_badan_sukan_2.'<br />':null ?><?= ($model->alamat_badan_sukan_3)?$model->alamat_badan_sukan_3.'<br />':null ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Negeri") ?></td><td>:</td><td><?= $model->alamat_badan_sukan_negeri ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Bandar") ?></td><td>:</td><td><?= $model->alamat_badan_sukan_bandar ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Poskod") ?></td><td>:</td><td><?= $model->alamat_badan_sukan_poskod ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Nama Penuh Presiden Badan Sukan") ?></td><td>:</td><td><?= $model->nama_penuh_presiden_badan_sukan ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("No. Tel") ?></td><td>:</td><td><?= $model->no_tel_bimbit_presiden_badan_sukan ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("Emel") ?></td><td>:</td><td><?= $model->emel_presiden_badan_sukan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Nama Penuh Setiausaha Badan Sukan") ?></td><td>:</td><td><?= $model->nama_penuh_setiausaha_badan_sukan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("No. Tel") ?></td><td>:</td><td><?= $model->no_tel_bimbit_setiausaha_badan_sukan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Emel") ?></td><td>:</td><td><?= $model->emel_setiausaha_badan_sukan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Status") ?></td><td>:</td><td><?= $model->status ?></td>
    </tr>
</table>

