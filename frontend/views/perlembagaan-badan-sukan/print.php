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
        <td><?= strtoupper("Tarikh Kelulusan") ?></td><td>:</td><td><?= $model->tarikh_kelulusan ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("Muat Naik") ?></td><td>:</td><td><?= ($model->muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Status") ?></td><td>:</td><td><?= $model->status ?></td>
    </tr>
</table>

