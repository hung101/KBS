<?php
use app\models\RefPingatInsentif;

$noBottomStyle = 'border-bottom:0;border-right:1px solid; border-left:1px solid; border-top:1px solid';
$bottomStyle = 'border-bottom:1px solid;border-right:1px solid; border-left:1px solid';
$topStyle = 'border:1px solid';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta charset="UTF-8">
</head>
<body>
    <div class="form-title" style="margin:0px 0px 20px">
    PERMOHONAN JAWATANKUASA BANTUAN<br />
    BAHAGIAN ATLET<br />
    MAJLIS SUKAN NEGARA
    </div>

	<table id="data" style="width:100%">
		<tr>
			<th rowspan="2">BIL</th>
			<th rowspan="2">AKTIVITI</th>
			<th rowspan="2">I) TEMPAT<br>II) TARIKH<br>III) ATLET/PEG.<br>IV) LAIN-LAIN</th>
			<th colspan="3">PERMOHONAN</th>
			<th colspan="4">CADANGAN</th>
		</tr>
		<tr>
			<th>PERBELANJAAN DIPOHON</th>
			<th>JUMLAH</th>
			<th>CATATAN</th>
			<th>ATL/PEG</th>
			<th width="30%">PERBELANJAAN DIPOHON</th>
			<th>JUMLAH (RM)</th>
			<th width="10%">CATATAN</th>
		</tr>
		<?php
		$tdStyle = 'border-bottom:0;border-right:1px solid; border-left:1px solid';
		
		$bil = 1;
		$grandTotalInsentifAtlet = 0;
		foreach($PembayaranInsentifAtlet as $key => $value)
		{
			$grandTotalInsentifAtlet = $grandTotalInsentifAtlet+$value['nilai'];
			if(isset($value['rekod_baru']) && $value['rekod_baru'] != null)
			{
				$grandTotalInsentifAtlet = $grandTotalInsentifAtlet+$value['rekod_baru'];
			}
			if(isset($value['insentif_khas']) && $value['insentif_khas'] != null)
			{
				$grandTotalInsentifAtlet = $grandTotalInsentifAtlet+$value['insentif_khas'];
			}
			
			$ref = RefPingatInsentif::findOne(['id' => $value['pingat']]);
			$value['pingat'] = $ref['desc'];
			
			if($key === (count($PembayaranInsentifAtlet)-1)){
			  $tdStyle = $bottomStyle;
			}		
		?>
		<tr>
			<td style="<?= $tdStyle ?>" class="align-top"><?= ($key === 0)?$bil:null ?></td>
			<td style="<?= $tdStyle ?>" class="align-top"><?= ($key === 0)?strtoupper($model->nama_kejohanan):null ?></td>
			<td style="<?= $tdStyle ?>" class="align-top">
				<?php if($key === 0){ ?>
				I) <?= $model->tempat ?><br />
				II) <?= ($model->tarikh_mula != '' || $model->tarikh_mula != null)?date('d.m.Y', strtotime($model->tarikh_mula)):null ?> - 
					<?= ($model->tarikh_tamat != '' || $model->tarikh_tamat != null)?date('d.m.Y', strtotime($model->tarikh_tamat)):null ?><br />
				III) <?= $PembayaranInsentifAtletGroupCount ?> / <?= $PembayaranInsentifJurulatihGroupCount ?> orang<br />
				IV) <?= $PembayaranInsentifPersatuanGroupCount ?> orang
				<?php } ?>
			</td>
			<td style="<?= $tdStyle ?>"></td>
			<td style="<?= $tdStyle ?>"></td>
			<td style="<?= $tdStyle ?>"></td>
			<td style="<?= $tdStyle ?>" class="align-top"><?= ($key === 0)?$PembayaranInsentifAtletGroupCount.'/'.$PembayaranInsentifJurulatihGroupCount.'/'.$PembayaranInsentifPersatuanGroupCount:null ?></td>
			<td style="<?= $tdStyle ?>" class="align-top">
				<?= ($key === 0)?$model->jenis_insentif.'<br />':null ?>
				<?= $value['refAtlet']['name_penuh'] ?> 
				<?= $value['refSukan']['desc'] ?> - 
				<?= $value['refAcara']['desc'] ?>
				(<?= $value['pingat'] ?>)<br />
				Nilai:
				<?= (isset($value['rekod_baru']) && $value['rekod_baru'] != null)?'<br />Rekod baru:':null ?>
				<?= (isset($value['insentif_khas']) && $value['insentif_khas'] != null)?'<br />Insentif khas:':null ?>
			</td>
			<td style="<?= $tdStyle ?>" valign="bottom" align="right">
				<?= number_format($value['nilai'], 2) ?>
				<?= (isset($value['rekod_baru']) && $value['rekod_baru'] != null)?'<br />'.number_format($value['rekod_baru'], 2):null ?>
				<?= (isset($value['insentif_khas']) && $value['insentif_khas'] != null)?'<br />'.number_format($value['insentif_khas'], 2):null ?>
			</td>
			<?php if($key === 0){ ?>
			<td style="border-bottom:1px solid;border-right:1px solid; border-left:1px solid" valign="top" rowspan="<?= count($PembayaranInsentifAtlet)+1 ?>"><?= $model->catatan_atlet ?></td>
			<?php } ?>
		</tr>
		<?php
		}
		if(count($PembayaranInsentifAtlet) > 0)
		{
			echo '<tr><td colspan="8" style="'.$bottomStyle.'" align="right"><b>JUMLAH (RM)</b></td><td align="right" style="'.$bottomStyle.'">'.number_format((float)$grandTotalInsentifAtlet, 2).'</td></tr>';
		}

		$tdStyle = 'border-bottom:0;border-right:1px solid; border-left:1px solid';
		$bil = 2;
		$grandTotalInsentifJurulatih = 0;
		foreach($PembayaranInsentifJurulatih as $key => $value)
		{
			$grandTotalInsentifJurulatih = $grandTotalInsentifJurulatih+$value['nilai'];
			
			if($key === (count($PembayaranInsentifJurulatih)-1)){
			  $tdStyle = $bottomStyle;
			}
			if($key === 0){
				$tdStyle = $noBottomStyle;
			}
		?>
		<tr>
			<td style="<?= $tdStyle ?>" class="align-top"><?= ($key === 0)?$bil:null ?></td>
			<td style="<?= $tdStyle ?>" class="align-top"><?= ($key === 0)?strtoupper($model->nama_kejohanan):null ?></td>
			<td style="<?= $tdStyle ?>" class="align-top">
				<?php if($key === 0){ ?>
				I) <?= $model->tempat ?><br />
				II) <?= ($model->tarikh_mula != '' || $model->tarikh_mula != null)?date('d.m.Y', strtotime($model->tarikh_mula)):null ?> - 
					<?= ($model->tarikh_tamat != '' || $model->tarikh_tamat != null)?date('d.m.Y', strtotime($model->tarikh_tamat)):null ?><br />
				III) <?= $PembayaranInsentifAtletGroupCount ?> / <?= $PembayaranInsentifJurulatihGroupCount ?> orang<br />
				IV) <?= $PembayaranInsentifPersatuanGroupCount ?> orang
				<?php } ?>
			</td>
			<td style="<?= $tdStyle ?>"></td>
			<td style="<?= $tdStyle ?>"></td>
			<td style="<?= $tdStyle ?>"></td>
			<td style="<?= $tdStyle ?>" class="align-top"><?= ($key === 0)?$PembayaranInsentifAtletGroupCount.'/'.$PembayaranInsentifJurulatihGroupCount.'/'.$PembayaranInsentifPersatuanGroupCount:null ?></td>
			<td style="<?= $tdStyle ?>" class="align-top">
				<?= ($key === 0)?'SGAR<br />':null ?>
				<?= $value['refJurulatih']['nama'] ?> <?= $value['refSukan']['desc'] ?><br />
				Nilai:
			</td>
			<td style="<?= $tdStyle ?>" valign="bottom" align="right">
				<?= number_format($value['nilai'], 2) ?>
			</td>
			<?php if($key === 0){ ?>
			<td style="<?= $topStyle ?>" valign="top" rowspan="<?= count($PembayaranInsentifJurulatih)+1 ?>"><?= $model->catatan_jurulatih ?></td>
			<?php } ?>
		</tr>
		<?php
		}
		if(count($PembayaranInsentifJurulatih) > 0)
		{
			echo '<tr><td colspan="8" style="'.$bottomStyle.'" align="right"><b>JUMLAH (RM)</b></td><td align="right" style="'.$topStyle.'">'.number_format((float)$grandTotalInsentifJurulatih, 2).'</td></tr>';
		}
		
		$tdStyle = 'border-bottom:0;border-right:1px solid; border-left:1px solid';
		$bil = 3;
		$grandTotalInsentifPersatuan = 0;
		foreach($PembayaranInsentifPersatuan as $key => $value)
		{
			$grandTotalInsentifPersatuan = $grandTotalInsentifPersatuan+$value['nilai'];
			
			if($key === (count($PembayaranInsentifPersatuan)-1)){
			  $tdStyle = $bottomStyle;
			}
			
			if($key === 0){
				$tdStyle = $noBottomStyle;
			}
		?>
		<tr>
			<td style="<?= $tdStyle ?>" class="align-top"><?= ($key === 0)?$bil:null ?></td>
			<td style="<?= $tdStyle ?>" class="align-top"><?= ($key === 0)?strtoupper($model->nama_kejohanan):null ?></td>
			<td style="<?= $tdStyle ?>" class="align-top">
				<?php if($key === 0){ ?>
				I) <?= $model->tempat ?><br />
				II) <?= ($model->tarikh_mula != '' || $model->tarikh_mula != null)?date('d.m.Y', strtotime($model->tarikh_mula)):null ?> - 
					<?= ($model->tarikh_tamat != '' || $model->tarikh_tamat != null)?date('d.m.Y', strtotime($model->tarikh_tamat)):null ?><br />
				III) <?= $PembayaranInsentifAtletGroupCount ?> / <?= $PembayaranInsentifJurulatihGroupCount ?> orang<br />
				IV) <?= $PembayaranInsentifPersatuanGroupCount ?> orang
				<?php } ?>
			</td>
			<td style="<?= $tdStyle ?>"></td>
			<td style="<?= $tdStyle ?>"></td>
			<td style="<?= $tdStyle ?>"></td>
			<td style="<?= $tdStyle ?>" class="align-top"><?= ($key === 0)?$PembayaranInsentifAtletGroupCount.'/'.$PembayaranInsentifJurulatihGroupCount.'/'.$PembayaranInsentifPersatuanGroupCount:null ?></td>
			<td style="<?= $tdStyle ?>" class="align-top">
				<?= ($key === 0)?'SIKAP<br />':null ?>
				<?= $value['refProfilBadanSukan']['nama_badan_sukan'] ?><br />
				Nilai:
			</td>
			<td style="<?= $tdStyle ?>" valign="bottom" align="right">
				<?= number_format($value['nilai'], 2) ?>
			</td>
			<?php if($key === 0){ ?>
			<td style="<?= $topStyle ?>" valign="top" rowspan="<?= count($PembayaranInsentifPersatuan)+1 ?>"><?= $model->catatan_persatuan ?></td>
			<?php } ?>
		</tr>
		<?php
		}
		if(count($PembayaranInsentifPersatuan) > 0)
		{
			echo '<tr><td colspan="8" style="'.$bottomStyle.'" align="right"><b>JUMLAH (RM)</b></td><td align="right" style="'.$topStyle.'">'.number_format((float)$grandTotalInsentifPersatuan, 2).'</td></tr>';
		}
		
		?>
	</table>
</body>
</html>