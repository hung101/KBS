<?php
use app\models\JurulatihSukan;

use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefJantina;
use app\models\RefSukan;
use app\models\RefBahagianJurulatih;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

if(isset($parentModel->alamat_surat_menyurat_bandar) && $parentModel->alamat_surat_menyurat_bandar != null){
    $ref = RefBandar::findOne(['id' => $parentModel->alamat_surat_menyurat_bandar]);
    $parentModel->alamat_surat_menyurat_bandar = $ref['desc'];
}
if(isset($parentModel->alamat_surat_menyurat_negeri) && $parentModel->alamat_surat_menyurat_negeri != null){
    $ref = RefNegeri::findOne(['id' => $parentModel->alamat_surat_menyurat_negeri]);
    $parentModel->alamat_surat_menyurat_negeri = $ref['desc'];
}
$model->tarikh = date('d F Y',strtotime($model->tarikh));

$sukan = null;
$bahagian = null;
$tarikhMula = null;
$tarikhTamat = null;
$sukanList = JurulatihSukan::find()->where(['jurulatih_id' => $parentModel->jurulatih_id])->orderBy(['tarikh_mula_lantikan' => SORT_DESC])->one();
if(count($sukanList) > 0)
{
    $ref = RefSukan::findOne(['id' => $sukanList->sukan]);
    $sukan = $ref['desc'];
    $ref = RefBahagianJurulatih::findOne(['id' => $sukanList->bahagian]);
    $bahagian = $ref['desc'];
    
    if(isset($sukanList->tarikh_mula_lantikan)){
       //$tarikhMula = date('j<\s\u\p>S</\s\u\p> F Y',strtotime($sukanList->tarikh_mula_lantikan));
       $tarikhMula = date('d', strtotime($sukanList->tarikh_mula_lantikan)).' '.GeneralFunction::getMonthWord($sukanList->tarikh_mula_lantikan, $type = 2).' '.date('Y', strtotime($sukanList->tarikh_mula_lantikan));
    }
    if(isset($sukanList->tarikh_tamat_lantikan)){
       $tarikhTamat = date('j<\s\u\p>S</\s\u\p> F Y',strtotime($sukanList->tarikh_tamat_lantikan));   
    }
    
}

$selectedDate = null;
if(isset($model->tarikh) && $model->tarikh != null)
{
    $selectedDate = date('d', strtotime($model->tarikh)).' '.GeneralFunction::getMonthWord($model->tarikh, $type = 2).' '.date('Y', strtotime($model->tarikh));
}
?>

<table border="0" align="center">
    <tr>
        <td style="padding-right:10px"><img align="right" src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="100"></td>
        <td valign="top" style="padding-top:10px; text-align:center"><div class="form-title" style="text-decoration:underline">MAJLIS SUKAN NEGARA MALAYSIA</div><br />
        SURAT PERSETUJUAN TERIMA TAWARAN JURULATIH SEPENUH MASA<br />(LANTIKAN JURULATIH BARU)
        </td>
    </tr>
</table>

<table border="0" align="left" cellspacing="8">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?= $parentModel->nama ?></td>
    </tr>
    <tr>
        <td valign="top">Alamat Tetap</td>
        <td valign="top">:</td>
        <td>
            <?= ($parentModel->alamat_surat_menyurat_1)?$parentModel->alamat_surat_menyurat_1.'<br />':null ?>
            <?= ($parentModel->alamat_surat_menyurat_2)?$parentModel->alamat_surat_menyurat_2.'<br />':null ?>
            <?= ($parentModel->alamat_surat_menyurat_3)?$parentModel->alamat_surat_menyurat_3.'<br />':null ?>
            <?= ($parentModel->alamat_surat_menyurat_poskod)?$parentModel->alamat_surat_menyurat_poskod.'<br />':null ?>
            <?= ($parentModel->alamat_surat_menyurat_bandar)?$parentModel->alamat_surat_menyurat_bandar.'<br />':null ?>
            <?= ($parentModel->alamat_surat_menyurat_negeri)?$parentModel->alamat_surat_menyurat_negeri.'<br />':null ?>
        </td>
    </tr>
    </tr>
        <tr>
        <td>No. Telefon</td>
        <td>:</td>
        <td><?= $parentModel->no_telefon_bimbit ?></td>
    </tr>
        <tr>
        <td>Tarikh</td>
        <td>:</td>
        <td><?= $selectedDate ?></td>
    </tr>
    <tr>
        <td valign="top">Kepada</td>
        <td valign="top">:</td>
        <td>
            PENGARAH BAHAGIAN KHIDMAT PENGURUSAN<br />
            MAJLIS SUKAN NEGARA MALAYSIA<br />
            KOMPLEKS SUKAN NEGARA<br />
            BUKIT JALIL, SRI PETALING<br />
            57000 KUALA LUMPUR<br />
            <span class="text-bold">(U/P: CAWANGAN SUMBER MANUSIA)</span>
        </td>
    </tr>
</table>

Tuan,
<p>
    Saya bersetuju menerima tawaran lantikan Majlis sebagai <b>Jurulatih</b> beserta dengan syarat-syarat lantikan seperti yang dinyatakan di dalam surat tuan MSN bil: <b><?= $model->bil_msnm ?></b>
</p>
<p>
2.&nbsp;&nbsp;&nbsp;&nbsp;Saya akan melapor diri untuk bertugas mulai: <?= $tarikhMula ?>
</p>
<p>
3.&nbsp;&nbsp;&nbsp;&nbsp;Bersama ini dikemukakan dokumen berikut seperti yang diarahkan untuk tindakan tuan:-
</p>
<div>
    <table cellspacing="0" cellpadding="5">
        <tr>
            <td>i)</td>
            <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
            <td>Borang Maklumat Diri;</td>
        </tr>
        <tr>
            <td>ii)</td>
            <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
            <td>Empat(4) keping gambar ukuran pasport(latar belakang putih);</td>
        </tr>
        <tr>
            <td>iii)</td>
            <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
            <td>Akaun Bank (No._______________________________ Bank: _________________________) salinan disertakan.</td>
        </tr>
        <tr>
            <td>iv)</td>
            <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
            <td>Satu Salinan Kad Pengenalan</td>
        </tr>
        <tr>
            <td valign="top">v)</td>
            <td valign="top"><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
            <td valign="top">Salinan Kad KWSP atau No. Ahli sahaja.
                <br/>
                <table>
                    <tr>
                        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                        <td>Ada, nyatakan No. Ahli ___________________________</td>
                        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                        <td>Tiada</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>vi)</td>
            <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
            <td>Salinan Kad Pengenalan Ibubapa / Penjaga / Isteri / Suami / Anak;</td>
        </tr>
        <tr>
            <td>vii)</td>
            <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
            <td>Salinan Sijil Nikah / Sijil Pendaftaran Perkahwinan (jika berkaitan)</td>
        </tr>
        <tr>
            <td>viii)</td>
            <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
            <td>Satu Salinan Sijil-sijil Persekolahan, Diploma / Ijazah (yang berkaitan); dan</td>
        </tr>    
        <tr>
            <td>ix)</td>
            <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
            <td>Satu Salinan Resume (yang dikemaskini)</td>
        </tr>
    </table>
</div>

<pagebreak />
<p>Sekian, terima kasih.</p>
<div class="float-left" style="width:40%">
<p>Yang benar,</p>
<br /><br /><br />
_____________________________________<br /><br />
Nama:<br />
Tarikh : 
</div>
<div class="float-left" style="width:56%; padding-left:20px">
    <div style="width:100%; border:1px solid">
        <div style="text-align:center;padding:10px 0px 10px">Untuk Kegunaan<br />Cawangan Pentabiran & Sumber Manusia</div>
        <div style="border-top:1px solid">
            <table border="0" align="left" cellspacing="8">
                <tr>
                    <td>Diterima Oleh:-</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Nama pegawai</td>
                    <td>:</td>
                    <td>.....................................................</td>
                </tr>
                <tr>
                    <td>Tarikh</td>
                    <td>:</td>
                    <td>.....................................................</td>
                </tr>
            </table>
            <table align="left" cellspacing="8">
                <tr>
                    <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                    <td>Lengkap</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
                    <td>Tidak Lengkap</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="clear"></div>

<pagebreak />

<div align="center" class="text-bold" style="font-size:16px">
    SENARAI SEMAKAN KEPADA<br />PEGAWAI/ ANGGOTA/ JURULATIH/ ATLET<br />KE LANTIKAN PERTAMA DI MAJLIS SUKAN NEGARA MALAYSIA
</div>
<p>
Majlis mengucapkan tahniah kepada tuan/puan telah ditawarkan perkhidmatan di Majlis, untuk memudahkan urusan pelantikan ini, Senarai Semakan ini boleh dijadikan panduan untuk tuan/puan ikuti. Sila penuhi/ lengkapkan arahan/ butiran bertanda <span class="square">&nbsp;&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;&nbsp;</span> berikut:-
</p>
<table cellspacing="0" cellpadding="5">
    <tr>
        <td></td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>Surat Lantikan;</td>
    </tr>
    <tr>
        <td>a)</td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>SURAT SETUJU TERIMA (LAMPIRAN A) tawaran pelantikan;</td>
    </tr>
    <tr>
        <td>b)</td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>LAMPIRAN mengenai syarat-syarat kontrak lantikan;</td>
    </tr>
    <tr>
        <td>c)</td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>Borang Butiran Peribadi</td>
    </tr>
    <tr>
        <td>d)</td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>Gambar (empat(4) keping ukuran pasport)</td>
    </tr>
    <tr>
        <td>e)</td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>Akaun Bank (No. ...................................) salinan disertakan;</td>
    </tr>
</table>

<div style="width:90%; border:2px solid; padding:20px; margin:20px 0px">
    TUAN DICADANGKAN MEMBUKA AKAUN SIMPANAN DI SALAH SATU BANK BERIKUT:-
    <ul style="list-style-type:none">
        <li class="text-bold">1. CIMB BANK BERHAD</li>
        <li class="text-bold">2. MALAYAN BANKING BERHAD</li>
        <li class="text-bold">3. PERWIRA AFFIN BANK BERHAD</li>
    </ul>
    Sila kemukakan <span style="text-decoration:underline" class="text-bold">sesalinan fotostat buku simpanan</span> tuan/ puan ketika melapor diri. Segala bayaran gaji/ elaun/ apa-apa tuntutan akan dikreditkan ke akaun simpanan tuan/ puan. Majlis tidak bertanggungjawab ke atas sebarang kelewatan pembayaran yang disebabkan tuan/ puan tidak mempunyai akaun di mana-mana bank di atas.
</div>

<table cellspacing="0" cellpadding="5">
    <tr>
        <td>f)</td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>Satu Salinan Kad Pengenalan Diri;</td>
    </tr>
    <tr>
        <td>g)</td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>Satu Salinan Sijil-sijil Persekolahan, Diploma dan Ijazah (yang berkaitan)</td>
    </tr>
    <tr>
        <td>h)</td>
        <td><div class="square">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td>No. Kad Pengenalan Ibu bapa/ Penjaga (untuk rekod Pentadbiran)</td>
    </tr>
</table>