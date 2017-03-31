<table align="center" style="margin-bottom:10px">
	<tr>
		<td align="center" class="text-bold titleSize"><?= strtoupper($title) ?></td>
	</tr>
</table>

<table>
	<tr>
		<td class="text-bold">Negara</td><td>:</td><td><?= $model->nama_negara ?></td>
	</tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:10px 0px">
    BUTIRAN
</div>

<table>
	<tr>
		<td class="text-bold">Nama Pegawai Kedutaan</td><td>:</td><td><?= $model->nama_pegawai_embassy ?></td>
	</tr>
	<tr>
		<td class="text-bold">No. Telefon</td><td>:</td><td><?= $model->no_telefon ?></td>
	</tr>
		<tr>
		<td class="text-bold" valign="top">Alamat</td><td valign="top">:</td><td valign="top"><?= ($model->alamat_1)?$model->alamat_1.'<br />':'' ?><?= ($model->alamat_2)?$model->alamat_2.'<br />':'' ?><?= ($model->alamat_3)?$model->alamat_3.'<br />':'' ?></td>
	</tr>
	<tr>
		<td class="text-bold">Poskod</td><td>:</td><td><?= $model->alamat_poskod ?></td>
	</tr>
	<tr>
		<td class="text-bold">Bandar</td><td>:</td><td><?= $model->alamat_bandar ?></td>
	</tr>
	<tr>
		<td class="text-bold">Negeri</td><td>:</td><td><?= $model->alamat_negeri ?></td>
	</tr>
	<tr>
		<td class="text-bold">No.Faks</td><td>:</td><td><?= $model->no_faks ?></td>
	</tr>
	<tr>
		<td class="text-bold">GPS</td><td>:</td><td><?= $model->gps ?></td>
	</tr>
	<tr>
		<td class="text-bold">Matawang</td><td>:</td><td><?= $model->currency ?></td>
	</tr>
	<tr>
		<td class="text-bold">Malaysia (RM)</td><td>:</td><td><?= $model->malaysia_rm ?></td>
	</tr>
	<tr>
		<td class="text-bold">Iklim</td><td>:</td><td><?= $model->climate ?></td>
	</tr>
	<tr>
		<td class="text-bold">Suhu (&deg;C)</td><td>:</td><td><?= $model->celcius ?></td>
	</tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:10px 0px">
    HAL-HAL LAIN
</div>

<table>
	<tr>
		<td class="text-bold">Catatan</td><td>:</td><td><?= $model->catatan ?></td>
	</tr>
</table>

<div class="title-header-wrap" style="height:36px; line-height:36px; margin:10px 0px">
    BUTIRAN NEGARA
</div>

<table>
	<tr>
		<td class="text-bold">Negara</td><td>:</td><td><?= $model->country ?></td>
	</tr>
	<tr>
		<td class="text-bold">Kawasan</td><td>:</td><td><?= $model->region ?></td>
	</tr>
	<tr>
		<td class="text-bold">Negeri</td><td>:</td><td><?= $model->state ?></td>
	</tr>
	<tr>
		<td class="text-bold">Kerajaan (Datuk Bandar)</td><td>:</td><td><?= $model->goverment_mayor ?></td>
	</tr>
	<tr>
		<td class="text-bold">Kawasan (Perbandaran)</td><td>:</td><td><?= $model->area_municipality ?></td>
	</tr>
	<tr>
		<td class="text-bold">Jumlah Penduduk</td><td>:</td><td><?= $model->population ?></td>
	</tr>
	<tr>
		<td class="text-bold">Zon Masa</td><td>:</td><td><?= $model->timezone ?></td>
	</tr>
	<tr>
		<td class="text-bold">Zon Masa Malaysia</td><td>:</td><td><?= $model->malaysian_timezone ?></td>
	</tr>
	<tr>
		<td class="text-bold">Kod Kawasan</td><td>:</td><td><?= $model->area_code ?></td>
	</tr>
	<tr>
		<td class="text-bold">Ekonomi GDP</td><td>:</td><td><?= $model->economy_gpp ?></td>
	</tr>
	<tr>
		<td class="text-bold">Sukan</td><td>:</td><td><?= $model->popular_sports ?></td>
	</tr>
	<tr>
		<td class="text-bold">Pengangkutan</td><td>:</td><td><?= $model->public_transportation ?></td>
	</tr>
</table>