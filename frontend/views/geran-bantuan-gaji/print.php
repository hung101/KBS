<?php
use app\models\RefDokumenGeranBantuanGaji;
?>

<table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="right"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="90"></td>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?><br />MAJLIS SUKAN NEGARA</div>
			
		</td>
	</tr>
</table>

<table>
    <tr>
        <td>NAMA JURULATIH</td><td>:</td><td><?= $model->nama_jurulatih ?></td>
    </tr>
    <tr>
        <td>STATUS JURULATIH</td><td>:</td><td><?= $model->status_jurulatih ?></td>
    </tr>
    <tr>
        <td>NAMA SUKAN</td><td>:</td><td><?= $model->nama_sukan ?></td>
    </tr>
    <tr>
        <td>PROGRAM</td><td>:</td><td><?= $model->program_msn ?></td>
    </tr>
    <tr>
        <td>AGENSI PELANTIK</td><td>:</td><td><?= $model->agensi ?></td>
    </tr>
	<tr>
        <td>TARIKH MULA KONTRAK</td><td>:</td><td><?= ($model->tarikh_mula_kontrak)?date('d.m.Y', strtotime($model->tarikh_mula_kontrak)):null ?></td>
    </tr>
	<tr>
        <td>TARIKH TAMAT KONTRAK</td><td>:</td><td><?= ($model->tarikh_tamat_kontrak)?date('d.m.Y', strtotime($model->tarikh_tamat_kontrak)):null ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    MAKLUMAT PEMBAYARAN GERAN BANTUAN
</div>

<table>
    <tr>
        <td>TARIKH MULA BAYARAN</td><td>:</td><td><?= ($model->tarikh_mula)?date('d.m.Y', strtotime($model->tarikh_mula)):null ?></td>
    </tr>
    <tr>
        <td>TARIKH TAMAT BAYARAN</td><td>:</td><td><?= ($model->tarikh_tamat)?date('d.m.Y', strtotime($model->tarikh_tamat)):null ?></td>
    </tr>
    <tr>
        <td>KADAR</td><td>:</td><td><?= $model->kadar ?></td>
    </tr>
    <tr>
        <td>BULAN</td><td>:</td><td><?= $model->bulan ?></td>
    </tr>
    <tr>
        <td>JUMLAH GERAN (RM)</td><td>:</td><td><?= $model->jumlah_geran ?></td>
    </tr>
	<tr>
        <td>STATUS GERAN</td><td>:</td><td><?= $model->status_geran ?></td>
    </tr>
	<tr>
        <td valign="top">CATATAN</td><td valign="top">:</td><td valign="top"><?= $model->catatan ?></td>
    </tr>
	<tr>
        <td>STATUS PERMOHONAN</td><td>:</td><td><?= $model->status_permohonan ?></td>
    </tr>
    <tr>
        <td>RUJUKAN</td><td>:</td><td><?= $model->rujukan ?></td>
    </tr>
</table>

<h4 class="text-underline">PENGELUARAN CEK</h4>
<table>
    <tr>
        <td>BAUCAR (BR)</td><td>:</td><td><?= $model->boucher ?></td>
    </tr>
    <tr>
        <td>NO. CEK</td><td>:</td><td><?= $model->no_cek ?></td>
    </tr>
	<tr>
        <td>TARIKH</td><td>:</td><td><?= ($model->tarikh_cek)?date('d.m.Y', strtotime($model->tarikh_cek)):null ?></td>
    </tr>
</table>

<?php
if(count($GeranBantuanGajiLampiran) > 0){
?>
<h4 class="text-underline">LAMPIRAN</h4>
<ol>
	<?php
	foreach($GeranBantuanGajiLampiran as $item){
		$ref = RefDokumenGeranBantuanGaji::findOne(['id' => $item->nama_dokumen]);
		$item->nama_dokumen = $ref['desc'];
		echo '<li>'.$item->nama_dokumen.'</li>';
	}
	?>
</ol>
<?php
}
?>
<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    MPJ
</div>
<table>
    <tr>
        <td>TARIKH MPJ</td><td>:</td><td><?= ($model->tarikh_mpj)?date('d.m.Y', strtotime($model->tarikh_mpj)):null ?></td>
    </tr>
    <tr>
        <td>BILANGAN MPJ</td><td>:</td><td><?= $model->bil_mpj ?></td>
    </tr>
	<tr>
        <td>PENGERUSI</td><td>:</td><td><?= $model->pengerusi ?></td>
    </tr>    
	<tr>
        <td>CATATAN</td><td>:</td><td><?= $model->catatan_mpj ?></td>
    </tr>
</table>

<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    JKB
</div>
<table>
    <tr>
        <td>TARIKH JKB</td><td>:</td><td><?= ($model->tarikh_jkb)?date('d.m.Y', strtotime($model->tarikh_jkb)):null ?></td>
    </tr>
    <tr>
        <td>BILANGAN JKB</td><td>:</td><td><?= $model->bil_jkb ?></td>
    </tr>
	<tr>
        <td>KELULUSAN DKP</td><td>:</td><td><?= $model->kelulusan_dkp ?></td>
    </tr>    
	<tr>
        <td>CATATAN</td><td>:</td><td><?= $model->catatan_jkb ?></td>
    </tr>
</table>