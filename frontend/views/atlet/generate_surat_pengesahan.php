<?php
// contant values
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

use app\models\RefSukan;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\PembayaranElaun;
use app\models\AtletKewanganElaun;


$selectedDate = null;
if(isset($model->tarikh) && $model->tarikh != null)
{
    $selectedDate = date('d', strtotime($model->tarikh)).' '.GeneralFunction::getMonthWord($model->tarikh, $type = 2).' '.date('Y', strtotime($model->tarikh));
}

//var_dump($parentModel->refAtletSukan[0]->nama_sukan); die;

$ref = RefSukan::findOne($parentModel->refAtletSukan[0]->nama_sukan);
$parentModel->refAtletSukan[0]->nama_sukan = $ref['desc'];

$ref = RefProgramSemasaSukanAtlet::findOne($parentModel->refAtletSukan[0]->program_semasa);
$parentModel->refAtletSukan[0]->program_semasa = $ref['desc'];

$elaun = null;
$PembayaranElaun = AtletKewanganElaun::find()->where(['atlet_id' => $parentModel->atlet_id])->orderBy(['tarikh_mula' => SORT_DESC])->one();
if($PembayaranElaun !== null){
	$elaun = 'RM '.number_format($PembayaranElaun->jumlah_elaun, 2);
}
?>
<div style="float:left; width:60%">
	&nbsp;
</div>
<div style="float:left; width:40%; text-align:right">
	<table border="0" align="right" cellspacing="0">
		<tr>
			<td>Rujukan MSN</td>
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
<p>
<b>Kepada Sesiapa Yang Berkenaan</b>
</p>
<p>Tuan/Puan,</p>
<p><b>PENGESAHAN ATLET SUKAN <?= strtoupper($parentModel->refAtletSukan[0]->nama_sukan) ?></b></p>
<p>
    Dengan segala hormatnya, saya ingin menarik perhatian tuan/puan kepada perkara di atas.
</p>
<p>
2.&nbsp;&nbsp;&nbsp;&nbsp;Adalah disahkan bahawa atlet tersebut adalah di bawah Program Majlis Sukan Negara Malaysia. Butiran-butiran atlet adalah seperti berikut:-
	<table border="0" cellspacing="0" cellpadding="0" width="60%" align="center">
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $parentModel->name_penuh ?></td>
		</tr>
		<tr>
			<td>No. K/P</td>
			<td>:</td>
			<td><?= $parentModel->ic_no ?></td>
		</tr>
		<tr>
			<td>Sukan</td>
			<td>:</td>
			<td><?= $parentModel->refAtletSukan[0]->nama_sukan ?></td>
		</tr>
		<tr>
			<td>Program</td>
			<td>:</td>
			<td><?= $parentModel->refAtletSukan[0]->program_semasa ?></td>
		</tr>
		<tr>
			<td>Elaun</td>
			<td>:</td>
			<td><?= $elaun ?></td>
		</tr>
	</table>
</p>
<p>
3.&nbsp;&nbsp;&nbsp;&nbsp;Sehubungan dengan itu, pihak tuan/puan boleh menghubungi Pengurus Sukan <?= $parentModel->refAtletSukan[0]->nama_sukan ?> <?= $model->nama_pengurus_sukan ?> di talian <?= $model->no_telefon_pengurus ?> bagi sebarang pertanyaan. 
</p>
<p>
Segala kerjasama daripada pihak tuan/puan dalam perkara ini amatlah dihargai dan didahului dengan ucapan ribuan terima kasih.
</p>
<p>
Sekian.
</p>
<p style="font-style:italic">
	<b>' KE ARAH KECEMERLANGAN SUKAN '<b>
</p>
<p>
Saya yang menurut perintah,
<br /><br /><br />

</p>
<?php if($parentModel->cacat == '0'): ?>
<b>(JEFRI NGADIRIN)</b><br />
Pemangku Pengarah<br />
Bahagian Atlet<br />
b/p Ketua Pengarah<br />
Majlis Sukan Negara Malaysia
<?php else: ?>
Yang Menurut Perintah<br />
En Mohd Safrushahar Yusoff<br />
Pemangku Pengarah<br />
Pengarah Bahagian Paralimpik<br />
Majlis Sukan Negara Malaysia
<?php endif; ?>
