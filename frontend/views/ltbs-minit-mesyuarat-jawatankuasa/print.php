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
        <td><?= strtoupper("Tarikh") ?></td><td>:</td><td><?= $model->tarikh ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Tempat") ?></td><td>:</td><td><?= $model->tempat ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Korum Mesyuarat Mengikut Perlembagaan") ?></td><td valign="top">:</td><td valign="top"><?= $model->mengikut_perlembagaan ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Kehadiran Ahli Yang Layak Mengundi") ?></td><td>:</td><td><?= $model->kehadiran_ahli_yang_layak_mengundi ?></td>
    </tr>
    <tr>
        <td><?= strtoupper("Minit AJK") ?></td><td>:</td><td><?= ($model->minit_ajk_muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Notis AGM") ?></td><td>:</td><td><?= ($model->notis_agm_muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	    <tr>
        <td><?= strtoupper("Minit AGM") ?></td><td>:</td><td><?= ($model->minit_agm_muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Laporan Kewangan") ?></td><td>:</td><td><?= ($model->laporan_kewangan_muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	    <tr>
        <td><?= strtoupper("Laporan Aktiviti") ?></td><td>:</td><td><?= ($model->laporan_aktiviti_muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Borang PT 1@2 / MYKB 1@2") ?></td><td>:</td><td><?= ($model->borang_pt_muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	    <tr>
        <td><?= strtoupper("Senarai Ahli Jawatankuasa") ?></td><td>:</td><td><?= ($model->senarai_ahli_jawatankuasa_muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	    <tr>
        <td><?= strtoupper("Senarai Ahli / Gabungan Terkini") ?></td><td>:</td><td><?= ($model->senarai_ahli_gabungan_terkini_muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>
	<tr>
        <td><?= strtoupper("Status") ?></td><td>:</td><td><?= $model->status ?></td>
    </tr>
	<tr>
        <td valign="top"><?= strtoupper("Catatan") ?></td><td valign="top">:</td><td valign="top"><?= $model->catatan ?></td>
    </tr>
</table>

