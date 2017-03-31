<?php
use app\models\PembayaranInsentifAtlet;
use app\models\PerancanganProgramPlan;
use app\models\RefPingatInsentif;
use app\models\RefJenisInsentif;
?>

<div class="form-title" style="margin:0px 0px 20px">
<?= strtoupper($title) ?>
</div>

<?php
if(count($query) > 0){
?>
<table border="1" cellspacing="0" cellpadding="10" style="width:100%">
	<tr>
		<th>SUKAN</th>
		<th width="30%">NAMA KEJOHANAN<br />TARIKH/TEMPAT</th>
		<th>SUB SUKAN</th>
		<th>ACARA</th>
		<th>PENCAPAIAN</th>
		<th>SHAKAM</th>
		<th>SHAKAR</th>
		<th>REKOD BARU</th>
	</tr>
	<?php
	$bil = 1;
	foreach($query as $key => $value)
	{
		$items = PembayaranInsentifAtlet::find()->joinWith(['refAtlet'])->joinWith(['refAcara'])->joinWith(['refPembayaranInsentif'])
				 ->where(['atlet' => $value['atlet']])
				 ->andWhere(['tbl_pembayaran_insentif_atlet.sukan' => $value['sukan']])
				 ->andWhere(['IS NOT', 'tbl_pembayaran_insentif_atlet.sukan', null]);
		
		if(isset($model->sukan) && $model->sukan != '')
		{
			$items = $items->andFilterWhere(['tbl_pembayaran_insentif_atlet.sukan' => $model->sukan]);
		}
		
		$items = $items->all();
	?>	
	<tr>
		<td colspan="8"><?= $value['refAtlet']['name_penuh'].' - '.$value['refSukan']['desc']  ?></td>
	</tr>
	<?php
		foreach($items as $item)
		{
			$kejohananId = $item->refPembayaranInsentif->nama_kejohanan;
			$ref = PerancanganProgramPlan::findOne(['perancangan_program_id' => $kejohananId]);
			$kejohanan = $ref['nama_program'];
			
			$ref = RefPingatInsentif::findOne(['id' => $item->pingat]);
			$item->pingat = $ref['desc'];

			$ref = RefJenisInsentif::findOne(['id' => $item->refPembayaranInsentif->jenis_insentif]);
			$jenis_insentif = $ref['desc'];
			
			if($jenis_insentif === "SHAKAM"){
				$shakamTD = 'RM '.number_format($item->nilai, 2);
			} else{
				$shakamTD = 'RM '.number_format(0, 2);
			}
			if($jenis_insentif === "SHAKAR"){
				$shakarTD = 'RM '.number_format($item->nilai, 2);
			} else{
				$shakarTD = 'RM '.number_format(0, 2);
			}
			?>
			<tr>
				<td><?= $bil ?></td>
				<td><b><?= $kejohanan ?></b><br />
					<?= ($item->refPembayaranInsentif->tarikh_mula != null)?date('d.m.Y', strtotime($item->refPembayaranInsentif->tarikh_mula)):null ?> - 
					<?= ($item->refPembayaranInsentif->tarikh_tamat != null)?date('d.m.Y', strtotime($item->refPembayaranInsentif->tarikh_tamat)):null ?>
					<?= ($item->refPembayaranInsentif->tempat != null)?' / '.$item->refPembayaranInsentif->tempat:null ?>
				</td>
				<td></td>
				<td><?= $item->refAcara->desc ?></td>
				<td><?= $item->pingat ?></td>
				<td><?= $shakamTD ?></td>
				<td><?= $shakarTD ?></td>
				<td><?= ($item->rekod_baru != null)?'RM '.$item->rekod_baru:'RM '.number_format(0, 2); ?></td>
			</tr>
			<?php
			$bil++;
		}
	}
	?>
</table>
<?php
} else {
	echo '<p>TIADA REKOD</p>';
}
?>