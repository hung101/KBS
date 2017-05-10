<?php
// contant values
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

$selectedDate = null;
if(isset($model->tarikh) && $model->tarikh != null)
{
    $selectedDate = date('d', strtotime($model->tarikh)).' '.GeneralFunction::getMonthWord($model->tarikh, $type = 2).' '.date('Y', strtotime($model->tarikh));
}

if(isset($parentModel->tarikh_mula) && $parentModel->tarikh_mula != null)
{
    $tarikhMula = date('d', strtotime($parentModel->tarikh_mula)).' '.GeneralFunction::getMonthWord($parentModel->tarikh_mula, $type = 2).' '.date('Y', strtotime($parentModel->tarikh_mula));
}

if(isset($parentModel->tarikh_tamat) && $parentModel->tarikh_tamat != null)
{
    $tarikhTamat = date('d', strtotime($parentModel->tarikh_tamat)).' '.GeneralFunction::getMonthWord($parentModel->tarikh_tamat, $type = 2).' '.date('Y', strtotime($parentModel->tarikh_tamat));
}
?>
<div style="float:left; width:60%">
	<div class="text-bold"><?= $model->nama_penerima ?></div>
	<div><?= $model->jawatan ?></div>
	<div><?= $model->address_1 ?></div>
	<div><?= $model->address_2 ?></div>
	<div><?= $model->address_3 ?></div>
	<div><?= $model->negeri ?></div>
</div>
<div style="float:left; width:40%; text-align:right">
	<table border="0" align="right" cellspacing="0">
		<tr>
			<td>Bil MSNM</td>
			<td>:</td>
			<td><?= $model->bil_msnm ?></td>
		</tr>
		<tr>
			<td>Tarikh</td>
			<td>:</td>
			<td><?= $selectedDate ?></td>
		</tr>
	</table>
</div>
<div style="clear:both"></div>
<br />
<?= $model->gelaran ?>,
<br /><br />
<div class="text-bold">
	MAKLUMAN ATLET SUKAN <?= strtoupper($parentModel->nama_sukan) ?> MENYERTAI KEJOHANAN <?= strtoupper($parentModel->nama_kejohanan_temasya) ?>
	<?= strtoupper($tarikhMula.' - '.$tarikhTamat.', '.$parentModel->tempat_penginapan) ?>
</div>
<p>
    Dengan segala hormatnya, saya ingin menarik perhatian <?= strtolower($model->gelaran) ?> kepada perkara di atas.
</p>
<p>
2.&nbsp;&nbsp;&nbsp;&nbsp;Sukacita dimaklumkan bahawa (<?= count($PenyertaanSukanAcara) ?>) orang atlet Sukan <?= $parentModel->nama_sukan ?> di bawah Program <?= $parentModel->program ?> Majlis Sukan Negara Malaysia telah menyertai kejohanan luar negara bagi mewakili Pasukan Kebangsaan. Senarai nama atlet yang terlibat adalah seperti berikut:
	<table border="1" width="98%" align="center" cellspacing="0" cellpadding="4" style="margin-bottom:10px">
		<tr>
			<th width="10%">Bil</th>
			<th width="50%">Nama</th>
			<th>Kejohanan</th>
		</tr>
		<?php
		$counter = 1;
		foreach($PenyertaanSukanAcara as $item){
		?>
		<tr>
			<td align="center"><?= $counter ?></td>
			<td><?= $item->refAtlet->name_penuh ?></td>
			<?php
			if($counter === 1){
				echo '<td rowspan="'.count($PenyertaanSukanAcara).'">'.$parentModel->nama_kejohanan_temasya.'<br />'.
					$tarikhMula.' - '.$tarikhTamat.'<br />'.
					$parentModel->tempat_penginapan.
					'</td>';	
			}
			?>
		</tr>
		<?php
		$counter++;
		}
		?>
	</table>
Dipanjangkan perkara ini untuk makluman pihak <?= strtolower($model->gelaran) ?>.
</p>
<p>
Sekian, terima kasih.
</p>
<p style="font-style:italic">
	<b>' KE ARAH KECEMERLANGAN SUKAN '<b>
</p>
<p>
Yang benar,
<br /><br /><br />

</p>
<b>(JEFRI NGADIRIN)</b><br />
Pemangku Pengarah<br />
Bahagian Atlet<br />
b/p Ketua Pengarah<br />
Majlis Sukan Negara Malaysia