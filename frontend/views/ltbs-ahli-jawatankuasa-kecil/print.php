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
        <td><?= strtoupper("Nama Jawatankuasa") ?></td><td>:</td><td><?= $model->nama_jawatankuasa ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("Jawatan") ?></td><td>:</td><td><?= $model->jawatan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Nama Penuh") ?></td><td>:</td><td><?= $model->nama_penuh ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("No. Kad Pengenalan") ?></td><td>:</td><td><?= $model->no_kad_pengenalan ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("Jantina") ?></td><td>:</td><td><?= $model->jantina ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Bangsa") ?></td><td>:</td><td><?= $model->bangsa ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Umur") ?></td><td>:</td><td><?= $model->umur ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("No Telefon") ?></td><td>:</td><td><?= $model->no_tel ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Emel") ?></td><td>:</td><td><?= $model->emel ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Pekerjaan") ?></td><td>:</td><td><?= $model->pekerjaan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Nama Majikan") ?></td><td>:</td><td><?= $model->nama_majikan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Tarikh Mula Memegang Jawatan") ?></td><td>:</td><td><?= $model->tarikh_mula_memegang_jawatan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Pengiktirafan Yang Diterima") ?></td><td>:</td><td><?= $model->pengiktirafan_yang_diterima ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Kursus Yang Pernah Diikuti").'<br />'.strtoupper("Oleh Pemegang Jawatan") ?></td><td valign="top">:</td><td valign="top"><?= $model->kursus_yang_pernah_diikuti_oleh_pemegang_jawatan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Status") ?></td><td>:</td><td><?= $model->status ?></td>
    </tr>
</table>

