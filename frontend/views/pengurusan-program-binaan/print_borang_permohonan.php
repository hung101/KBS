<?php
$grandTotalPohon = 0;
foreach($binaanKosModel as $item)
{
    $grandTotalPohon = $grandTotalPohon+$item->jumlah_dipohon;
}

?>

<div class="float-left" style="width:14%">
    <img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="">
</div>
<div class="float-left form-title-center" style="width:80%">
    BORANG PERMOHONAN/PENGANJURAN AKTIVITI
</div>
<div class="clear"></div>
<div class="title-header-wrap" style="margin:20px 0px">
    MAKLUMAT AKTIVITI<br /><span class="smaller">(TINDAKAN USPTN)</span>
</div>

<table>
    <tr>
        <td>AKTIVITI</td><td>:</td><td><?= $model->nama_aktiviti ?></td>
    </tr>
    <tr>
        <td>TAHAP</td><td>:</td><td><?= $model->usptn_tahap ?></td>
    </tr>
    <tr>
        <td>TEMPAT</td><td>:</td><td><?= $model->tempat ?></td>
    </tr>
    <tr>
        <td>NEGERI</td><td>:</td><td><?= $model->negeri ?></td>
    </tr>
    <tr>
        <td>SUKAN</td><td>:</td><td><?= $sukanList?></td>
    </tr>
    <tr>
        <td>TARIKH</td><td>:</td><td><?= $model->tarikh_mula.' - '.$model->tarikh_tamat ?></td>
    </tr>
    <tr>
        <td>JUMLAH<br />DIPOHON</td><td>:</td><td>RM <?= number_format((float)$grandTotalPohon, 2, '.', '') ?></td>
    </tr>
</table>
<br />

<table border="0" width="90%" cellpadding="4" cellspacing="10" align="center">
    <tr>
        <td></th>
        <td style="text-align:center">Atlet</td>
        <td style="text-align:center">Jurulatih</td>
        <td style="text-align:center">Pegawai</td>
        <td style="text-align:center">Teknikal</td>
        <td style="text-align:center">Urusetia</td>
        <th style="text-align:center">JUMLAH</th>
    </tr>
    <tr>
        <td style="text-align:center">Lelaki</td>
        <td style="text-align:center" class="solid"><?= $atletCount['male'] ?></td>
        <td style="text-align:center" class="solid"><?= $jurulatihCount['male'] ?></td>
        <td style="text-align:center" class="solid"><?= $pegawaiCount['male'] ?></td>
        <td style="text-align:center" class="solid"><?= $teknikalCount['male'] ?></td>
        <td style="text-align:center" class="solid"><?= $urusetiaCount['male'] ?></td>
        <td style="text-align:center" class="solid2"><?= $totalLelaki = $atletCount['male']+$jurulatihCount['male']+$pegawaiCount['male']+$teknikalCount['male']+$urusetiaCount['male'] ?></td>
    </tr>
    <tr>
        <td style="text-align:center">Wanita</td>        
        <td style="text-align:center" class="solid"><?= $atletCount['female'] ?></td>
        <td style="text-align:center" class="solid"><?= $jurulatihCount['female'] ?></td>
        <td style="text-align:center" class="solid"><?= $pegawaiCount['female'] ?></td>
        <td style="text-align:center" class="solid"><?= $teknikalCount['female'] ?></td>
        <td style="text-align:center" class="solid"><?= $urusetiaCount['female'] ?></td>
        <td style="text-align:center" class="solid2"><?= $totalPerempuan = $atletCount['female']+$jurulatihCount['female']+$pegawaiCount['female']+$teknikalCount['female']+$urusetiaCount['female'] ?></td>
    </tr>
    <tr>
        <td style="text-align:center; font-weight:bold">JUMLAH</td>
        <td style="text-align:center" class="solid2"><?= $atletCount['male']+$atletCount['female'] ?></td>
        <td style="text-align:center" class="solid2"><?= $jurulatihCount['male']+$jurulatihCount['female'] ?></td>
        <td style="text-align:center" class="solid2"><?= $pegawaiCount['male']+$pegawaiCount['female'] ?></td>
        <td style="text-align:center" class="solid2"><?= $teknikalCount['male']+$teknikalCount['female'] ?></td>
        <td style="text-align:center" class="solid2"><?= $urusetiaCount['male']+$urusetiaCount['female'] ?></td>
        <td style="text-align:center" class="solid2"><?= $totalLelaki+$totalPerempuan ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="margin:20px 0px">
    CADANGAN & KELULUSAN<br /><span class="smaller">(TINDAKAN CAWANGAN PELAPIS)</span>
</div>

<table class="aTable" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <th>BIL</th>
    <th>PERKARA</th>
    <th>KADAR</th>
    <th>BILANGAN</th>
    <th>HARI</th>
    <th>JUMLAH</th>
  </tr>
  <?php
    $count = 1;
    foreach($binaanKosModel as $item)
    {
        $kategori = \app\models\RefKategoriPerbelanjaan::findOne($item->kategori_perbelanjaan)->desc;
    ?>
        <tr>
            <td align="center"><?= $count ?></td>
            <td><?= '('.$kategori.') '.$item->perbelanjaan_dipohon ?></td>
            <td align="center"><?= $item->kadar_cadangan ?></td>
            <td align="center"><?= $item->bilangan_cadangan ?></td>
            <td align="center"><?= $item->hari_cadangan ?></td>
            <td>RM <?= $item->anggaran_perbelanjaan ?></td>
        </tr> 
    <?php
    $count++;
    }
  ?>
</table>
<br />
<table>
    <tr>
        <td>SOKONGAN KETUA UNIT/CAWANGAN (RM)</td><td>:</td><td><?= $model->usptn_sokongan ?></td>
		<td>TARIKH</td><td>:</td><td><?= ($model->tarikh_sokongan)?date('d.m.Y', strtotime($model->tarikh_sokongan)):null ?></td>
    </tr>
    <tr>
        <td>SOKONGAN PENGARAH (RM)</td><td>:</td><td><?= $model->usptn_kelulusan ?></td>
		<td>TARIKH</td><td>:</td><td><?= ($model->tarikh_lulus)?date('d.m.Y', strtotime($model->tarikh_lulus)):null ?></td>
    </tr>
    <tr>
        <td>STATUS PERMOHONAN</td><td>:</td><td><?= $model->status_permohonan ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="margin:20px 0px; padding:10px 0px">
    BILANGAN PERMOHONAN / KUOTA & LAPORAN TERTUNGGAK
</div>

<table width="70%" align="center" border="0">
    <tr>
        <td align="center" style="border:2px solid;padding:5px">PERMOHONAN / KUOTA</td>
        <td>:</td>
        <td style="border:1px solid;padding:5px"><?= $model->usptn_kuota_lap ?></td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td align="center" style="border:2px solid;padding:5px">LAP. TERTUNGGAK</td>
        <td>:</td>
        <td style="border:1px solid;padding:5px"><?= $model->usptn_lap_tertunggak ?></td>
    </tr>
</table>