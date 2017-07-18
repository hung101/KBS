<?php
// contant values
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefKategoriPersatuan;
use app\models\RefKategoriProgram;
use app\models\RefSokongan;
use app\models\RefBank;
use app\models\RefNegeri;
use app\models\RefBandar;
use app\models\RefLaporanEBantuan;
use app\models\RefNegeriSokonganEBantuan;
use app\models\RefKelulusanHqEBantuan;
use app\models\RefStatusPermohonanEBantuan;
use app\models\RefPeringkatProgram;
use app\models\RefPejabatYangMendaftarkan;
use app\models\RefParlimen;
use app\models\RefPeringkatBadanSukan;
use app\models\RefJawatanInduk;
use common\models\User;

$ref = RefNegeri::findOne(['id' => $model->alamat_surat_menyurat_negeri]);
$model->alamat_surat_menyurat_negeri = $ref['desc'];

$ref = RefBandar::findOne(['id' => $model->alamat_surat_menyurat_bandar]);
$model->alamat_surat_menyurat_bandar = $ref['desc'];

$ref = RefStatusPermohonanEBantuan::findOne(['id' => $model->status_permohonan]);
$model->status_permohonan = $ref['desc'];

$negara_negeri = 'Negara';
$negeri = '';

if($model->sokongan == RefSokongan::DISOKONG_NEGERI){
    $negara_negeri = 'Negeri';
    $negeri = $model->alamat_surat_menyurat_negeri;
}

// check by Urusetia who processed the application identify whether is negari or negara
/*if($UrusetiaModel = User::findOne(['id' => $model->updated_by]) !== null){
    if($UrusetiaModel->urusetia_negeri_e_bantuan != ''){
        $ref = RefNegeri::findOne(['id' => $UrusetiaModel->urusetia_negeri_e_bantuan]);
        $negeri = $ref['desc'];
        $negara_negeri = 'Negeri';
    }
}*/


?>

<table>
    <tr>
        <td width="18%"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/img/malaysia-logo.jpg" width="15%" alt="Malaysia Logo"></td>
        <td width="43%" style="font-size:10px">
            <b>JABATAN BELIA DAN SUKAN NEGARA</b><br>
            <b><i>NATIONAL YOUTH AND SPORTS DEPARTMENT</i></b><br>
            Aras 2, 11, 12 dan 13, Menara KBS<br>
            No. 27, Persiaran Perdana, Presint 4<br>
            Pusat Pentadbiran Kerajaan Persekutuan<br>
            62570 PUTRAJAYA<br>
            MALAYSIA
        </td>
        <td width="24%" style="vertical-align: bottom;">
            <table style="font-size:8px" border="0" cellspacing="0">
                <tr>
                    <td>1MOCC</td><td>:</td><td>+603-8000 8000</td>
                </tr>
                <tr>
                    <td>Faks (Fax)</td><td>:</td><td>+603-8881 0092 (P&K)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td><td>&nbsp;</td><td>+603-8888 8761 (Belia)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td><td>&nbsp;</td><td>+603-8888 8759 (Sukan)</td>
                </tr>
                <tr>
                    <td>&nbsp;</td><td>&nbsp;</td><td>+603-8888 8780 (Rakan Muda)</td>
                </tr>
                <tr>
                    <td>Laman Web</td><td>:</td><td>www.kbs.gov.my</td>
                </tr>
                <tr>
                    <td>Email</td><td>:</td><td>pbjbsn@gmail.com</td>
                </tr>
            </table>
        </td>
        <td width="15%" style="text-align: right"><img src="<?=Yii::$app->getUrlManager()->getBaseUrl()?>/img/kbs-logo.jpg" width="15%" alt="KBS Logo"></td>
    </tr>
</table>
<hr>
<div style="float:left; width:60%">
	&nbsp;
</div>
<div style="float:left; width:40%; text-align:right">
	<table border="0" align="right" cellspacing="0">
		<tr>
			<td>Ruj Kami</td>
			<td>:</td>
			<td>JBSN.S.400/2/9/9-2</td>
		</tr>
		<tr>
			<td>Tarikh</td>
			<td>:</td>
			<td><?= date('d/m/Y', strtotime($model->updated)) ?></td>
		</tr>
	</table>
</div>
<div style="clear:both"></div>
<p>
<?= $model->nama_pertubuhan_persatuan ?><br />
<?= $model->alamat_surat_menyurat_1 ?><br />
<?php if($model->alamat_surat_menyurat_2 != ''):?>
<?= $model->alamat_surat_menyurat_2 ?><br />
<?php endif;?>
<?php if($model->alamat_surat_menyurat_3 != ''):?>
<?= $model->alamat_surat_menyurat_3 ?><br />
<?php endif;?>
<?= $model->alamat_surat_menyurat_poskod ?><br />
<?= $model->alamat_surat_menyurat_negeri ?><br />
</p>
<p>Tuan/Puan,</p>
<p><b>PERMOHONAN BANTUAN BAGI PROGRAM <?= strtoupper($model->nama_program) ?></b></p>
<p>
    Dengan hormatnya merujuk kepada perkara di atas.
</p>
<p>
2.&nbsp;&nbsp;&nbsp;&nbsp;Dimaklumkan bahawa permohonan bantuan bagi program <?= strtoupper($model->nama_program) ?> telah dibincangkan di dalam 
<b>Mesyuarat Jawatankuasa Pemberian Bantuan Jabatan Belia dan Sukan <?=$negara_negeri?> <?=($negara_negeri=='Negara'?'':$negeri)?> Bil. <?= strtoupper($model->bil_mesyuarat) ?></b> dan keputusan adalah seperti berikut :-
	<table border="1" style="border-collapse:collapse;" cellspacing="0" cellpadding="0" width="95%" align="center">
            <tr>
                <td  width="40%"><b>Pertubuhan/Persatuan/Kelab</b></td>
                <td  width="60%"><?= $model->nama_pertubuhan_persatuan ?></td>
            </tr>
            <tr>
                <td><b>No. ID</b></td>
                <td><?= $model->ebantuan_id ?></td>
            </tr>
            <tr>
                <td><b>Status Permohonan</b></td>
                <td><?= strtoupper($model->status_permohonan) ?></td>
            </tr>
	</table>
</p>
<p>
3.&nbsp;&nbsp;&nbsp;&nbsp;Jabatan menghargai usaha tuan di dalam melaksanakan program-program  pembangunan belia dan sukan di negara ini.
</p>
<p>
Sekian, terima kasih.
</p>
<br /><br />

Ketua Pengarah<br />
Jabatan Belia dan Sukan Negara<br />
<br /><br />
Ini adalah cetakan computer tidak perlu tandatangan 