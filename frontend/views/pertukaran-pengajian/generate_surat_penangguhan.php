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
			<td>Bil</td>
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
	PERMOHONAN PENANGGUHAN PENGAJIAN - <?= strtoupper($parentModel->tempoh_penangguhan) ?> BAGI ATLET/MAHASISWA <?= strtoupper($parentModel->atlet_id) ?> (NO. MATRIK : <?= $parentModel->sebab ?>)
</div>
<p>
    Dengan segala hormatnya, saya ingin menarik perhatian <?= $model->gelaran ?> kepada perkara di atas.
</p>
<p>
2.&nbsp;&nbsp;&nbsp;&nbsp;Sukacita dimaklumkan bahawa atlet/mahasiswa yang tersebut di atas adalah merupakan atlet Sukan <?= $parentModel->sukan ?> Program <?= $parentModel->program ?> di bawah Majlis Sukan Negara Malaysia telah mengemukakan permohonan untuk menangguhkan pengajian beliau bagi <?= $parentModel->tempoh_penangguhan ?>. Ini adalah kerana beliau ingin menumpukan sepenuh perhatian kepada latihan dan kejohanan bagi persediaan menghadapi <?= $parentModel->kejohanan_program ?>.
</p>
<p>
3.&nbsp;&nbsp;&nbsp;&nbsp;Sehubungan dengan itu, Majlis memohon pertimbangan dan kelulusan <?= $model->gelaran ?> penangguhan pengajian atlet tersebut pada <b><?= $parentModel->tempoh_penangguhan ?></b> bagi membolehkan beliau menjalani latihan secara sepenuh masa dan mengambil bahagian dalam kejohanan seperti yang telah ditetapkan.
</p>
<p>
Segala kerjasama daripada pihak <?= $model->gelaran ?> dalam perkara ini amatlah dihargai dan didahului dengan ucapan ribuan terima kasih.
</p>
<p style="font-style:italic">
	<b>' KE ARAH KECEMERLANGAN SUKAN '<b>
</p>
<p>
Saya yang menurut perintah,
<br /><br /><br />

</p>
<b>(JEFRI NGADIRIN)</b><br />
Pemangku Pengarah<br />
Bahagian Atlet<br />
b/p Ketua Pengarah<br />
Majlis Sukan Negara Malaysia