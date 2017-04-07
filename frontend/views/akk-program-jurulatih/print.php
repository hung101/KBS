<?php
use app\models\Jurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefStatusJurulatih;
use app\models\RefProgramJurulatih;
?>

<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="right"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="90"></td>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?><br />MAJLIS SUKAN NEGARA</div>
			
		</td>
	</tr>
</table>

<table>
    <tr>
        <td><?= strtoupper("Senarai Kursus AKK") ?></td><td>:</td><td><?= $model->senarai_kursus_akk ?></td>
    </tr>
    <tr>
        <td>PENGANJUR</td><td>:</td><td><?= $model->penganjur ?></td>
    </tr>
	<tr>
        <td>NAMA PROGRAM</td><td>:</td><td><?= $model->nama_program ?></td>
    </tr>    
	<tr>
        <td>TARIKH PROGRAM</td><td>:</td><td><?= ($model->tarikh_program)?date('d.m.Y', strtotime($model->tarikh_program)):null ?></td>
    </tr>
	<tr>
        <td>TEMPAT PROGRAM</td><td>:</td><td><?= $model->tempat_program ?></td>
    </tr>
    <tr>
        <td>KOD KURSUS</td><td>:</td><td><?= $model->kod_kursus ?></td>
    </tr>
	<tr>
        <td>TAHAP</td><td>:</td><td><?= $model->tahap ?></td>
    </tr>    
</table>

<h4 class="text-underline">JURULATIH</h4>
<?php
if(count($AkkProgramJurulatihPeserta) > 0){
?>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<tr>
			<th>BIL</th>
			<th>JURULATIH</th>
			<th>STATUS</th>
			<th>PROGRAM</th>
			<th>SUKAN</th>
			<th>ACARA</th>
			<th>EMEL</th>
		</tr>
		<?php
		$count = 1;
		foreach($AkkProgramJurulatihPeserta as $item){
			$ref = Jurulatih::findOne(['jurulatih_id' => $item->jurulatih]);
			$item->jurulatih = $ref['nameAndIC'];
			
			$ref = RefSukan::findOne(['id' => $item->sukan]);
			$item->sukan = $ref['desc'];
			
			$ref = RefAcara::findOne(['id' => $item->acara]);
			$item->acara = $ref['desc'];
			
			$ref = RefStatusJurulatih::findOne(['id' => $item->status_jurulatih]);
			$item->status_jurulatih = $ref['desc'];
			
			$ref = RefProgramJurulatih::findOne(['id' => $item->program]);
			$item->program = $ref['desc'];
			
		?>
			<tr>
				<td align="center"><?= $count ?></td>
				<td align="center"><?= $item->jurulatih ?></td>
				<td align="center"><?= $item->status_jurulatih ?></td>
				<td align="center"><?= $item->program ?></td>
				<td align="center"><?= $item->sukan ?></td>
				<td align="center"><?= $item->acara ?></td>
				<td align="center"><?= $item->emel_pengurus_sukan ?></td>
			</tr>
		<?php
			$count++;
		}
		?>
	</table>
<?php	
}else{
	echo '<p>Tiada Maklumat</p>';
}
?>
<br />
<table>
    <tr>
        <td>CATATAN</td><td>:</td><td><?= $model->catatan ?></td>
    </tr>
	<tr>
        <td>MUAT NAIK</td><td>:</td><td><?= ($model->muat_naik != '')?'Ya (Sila rujuk lampiran di dalam sistem)':'Tiada maklumat' ?></td>
    </tr>    
	<tr>
        <td>BILANGAN MPJ</td><td>:</td><td><?= $model->bilangan_mpj ?></td>
    </tr>	
	<tr>
        <td>TARIKH MPJ</td><td>:</td><td><?= ($model->tarikh_mpj)?date('d.m.Y', strtotime($model->tarikh_mpj)):null ?></td>
    </tr>
	<tr>
        <td>KELULUSAN MPJ</td><td>:</td><td><?= $model->kelulusan_mpj ?></td>
    </tr>
	<tr>
        <td>BILANGAN JKB</td><td>:</td><td><?= $model->bilangan_jkb ?></td>
    </tr>	
	<tr>
        <td>TARIKH JKB</td><td>:</td><td><?= ($model->tarikh_jkb)?date('d.m.Y', strtotime($model->tarikh_jkb)):null ?></td>
    </tr>
	<tr>
        <td>KELULUSAN JKB</td><td>:</td><td><?= $model->kelulusan_jkb ?></td>
    </tr>
</table>