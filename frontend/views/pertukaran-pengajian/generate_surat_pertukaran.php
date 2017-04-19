<?php
// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

$selectedDate = null;
if(isset($model->tarikh) && $model->tarikh != null)
{
    $selectedDate = date('d', strtotime($model->tarikh)).' '.GeneralFunction::getMonthWord($model->tarikh, $type = 2).' '.date('Y', strtotime($model->tarikh));
}

$pelepasanDateStart = null;
if(isset($parentModel->tarikh) && $parentModel->tarikh != null)
{
    $pelepasanDateStart = date('d', strtotime($parentModel->tarikh)).' '.GeneralFunction::getMonthWord($parentModel->tarikh, $type = 2).' '.date('Y', strtotime($parentModel->tarikh));
}
$pelepasanDateEnd = null;
if(isset($parentModel->tarikh_akhir) && $parentModel->tarikh_akhir != null)
{
    $pelepasanDateEnd = date('d', strtotime($parentModel->tarikh_akhir)).' '.GeneralFunction::getMonthWord($parentModel->tarikh_akhir, $type = 2).' '.date('Y', strtotime($parentModel->tarikh_akhir));
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
	PENAMATAN PENGAJIAN DI <?= strtoupper($parentModel->nama_pengajian_sekarang) ?>
</div>
<p>
    Dengan segala hormatnya, saya ingin menarik perhatian <?= $model->gelaran ?> kepada perkara di atas.
</p>
<p>
2.&nbsp;&nbsp;&nbsp;&nbsp;Adalah dimaklumkan bahawa atlet/mahasiswa <?= $parentModel->atlet_id ?> (No. Matrik <?= $parentModel->sebab ?>) <?= $parentModel->kategori_pengajian ?> bagi Sukan <?= $parentModel->sukan ?> di bawah program Majlis Sukan Negara Malaysia telah mengemukakan permohonan menamatkan pengajian di <?= $parentModel->nama_pengajian_sekarang ?> kerana telah mendapat tawaran pengajian di <?= $parentModel->nama_pertukaran_pengajian ?>.
</p>
<p>
Segala kerjasama daripada pihak <?= $model->gelaran ?> dalam perkara ini amatlah dihargai dan didahului dengan ucapan ribuan terima kasih.
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