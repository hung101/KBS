<?php
use app\models\PermohonanKemudahanTicketKapalTerbangSukan;
use app\models\PermohonanKemudahanTicketKapalTerbangAtlet;
use app\models\PermohonanKemudahanTicketKapalTerbangJurulatih;
use app\models\PermohonanKemudahanTicketKapalTerbangPegawai;
use app\models\PermohonanKemudahanTicketKapalTerbangPengurusSukan;

use app\models\RefBahagianAduan;
use app\models\PerancanganProgram;
use app\models\RefSukan;
use app\models\Jurulatih;
use app\models\Atlet;
use app\models\RefStatusPermohonanKemudahan;

$ref = RefBahagianAduan::findOne(['id' => $parentModel->bahagian]);
$parentModel->bahagian = $ref['desc'];

$ref = RefStatusPermohonanKemudahan::findOne(['id' => $parentModel->kelulusan]);
$parentModel->kelulusan = $ref['desc'];

$ref = PerancanganProgram::findOne(['perancangan_program_id' => $parentModel->nama_program]);
$parentModel->nama_program = $ref['nama_program'];

$sukan = PermohonanKemudahanTicketKapalTerbangSukan::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->all();

$sukanName = "";
$counter = 0;
foreach($sukan as $s){
    $name = RefSukan::findOne(['id' => $s->sukan])->desc;
   // var_dump($name);
    $sukanName = $sukanName.$name;
    if($counter != count($sukan)-1){
        $sukanName = $sukanName.', ';
    }
    $counter++;
}

$atlet = PermohonanKemudahanTicketKapalTerbangAtlet::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->all();

$jurulatih = PermohonanKemudahanTicketKapalTerbangJurulatih::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->all();

$pegawai = PermohonanKemudahanTicketKapalTerbangPegawai::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->all();

$pengurus = PermohonanKemudahanTicketKapalTerbangPengurusSukan::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->all();

//process destinasi pergi / tarikh_pergi
$pergiAtlet = PermohonanKemudahanTicketKapalTerbangAtlet::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->groupBy(['tarikh_pergi', 'destinasi_pergi'])->all();

$pergiJurulatih = PermohonanKemudahanTicketKapalTerbangJurulatih::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->groupBy(['tarikh_pergi', 'destinasi_pergi'])->all();

$pergiPegawai = PermohonanKemudahanTicketKapalTerbangPegawai::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->groupBy(['tarikh_pergi', 'destinasi_pergi'])->all();

$pergiPengurus = PermohonanKemudahanTicketKapalTerbangPengurusSukan::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->groupBy(['tarikh_pergi', 'destinasi_pergi'])->all();

//process destinasi balik / tarikh_balik
$balikAtlet = PermohonanKemudahanTicketKapalTerbangAtlet::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->groupBy(['tarikh_balik', 'destinasi_balik'])->all();

$balikJurulatih = PermohonanKemudahanTicketKapalTerbangJurulatih::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->groupBy(['tarikh_balik', 'destinasi_balik'])->all();

$balikPegawai = PermohonanKemudahanTicketKapalTerbangPegawai::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->groupBy(['tarikh_balik', 'destinasi_balik'])->all();

$balikPengurus = PermohonanKemudahanTicketKapalTerbangPengurusSukan::find()->where(['permohonan_kemudahan_ticket_kapal_terbang_id' => $parentModel->permohonan_kemudahan_ticket_kapal_terbang_id])->groupBy(['tarikh_balik', 'destinasi_balik'])->all();

$namaPenumpang = [];
$destinasiList = [];

//$testArr[0] = ['destinasi' => 'Uganda', 'tarikh' => '2017-02-02'];
//$testArr[1] = ['destinasi' => 'Australia', 'tarikh' => '2017-02-02'];
//var_dump(count($pergiPegawai)); die;

foreach($pergiAtlet as $pa){
    $destinasiList[] = ['destinasi' => $pa->destinasi_pergi, 'tarikh' => $pa->tarikh_pergi];
}
foreach($pergiJurulatih as $pj){
    $exist = false;
    foreach($destinasiList as $key=>$i)
    {
        if($i['destinasi'] === $pj->destinasi_pergi && $i['tarikh'] === $pj->tarikh_pergi) $exist = true;
    }
    if(!$exist) $destinasiList[] = ['destinasi' => $pj->destinasi_pergi, 'tarikh' => $pj->tarikh_pergi];
}
foreach($pergiPegawai as $pg){
    $exist = false;
    foreach($destinasiList as $key=>$i)
    {
        if($i['destinasi'] === $pg->destinasi_pergi && $i['tarikh'] === $pg->tarikh_pergi) $exist = true;
    }
    if(!$exist) $destinasiList[] = ['destinasi' => $pg->destinasi_pergi, 'tarikh' => $pg->tarikh_pergi];
}
foreach($pergiPengurus as $pgs){
    $exist = false;
    foreach($destinasiList as $key=>$i)
    {
        if($i['destinasi'] === $pgs->destinasi_pergi && $i['tarikh'] === $pgs->tarikh_pergi) $exist = true;
    }
    if(!$exist) $destinasiList[] = ['destinasi' => $pgs->destinasi_pergi, 'tarikh' => $pgs->tarikh_pergi];
}
foreach($balikAtlet as $a){
    $exist = false;
    foreach($destinasiList as $key=>$i)
    {
        if($i['destinasi'] === $a->destinasi_balik && $i['tarikh'] === $a->tarikh_balik) $exist = true;
    }
    if(!$exist) $destinasiList[] = ['destinasi' => $a->destinasi_balik, 'tarikh' => $a->tarikh_balik];
}
foreach($balikJurulatih as $bj){
    $exist = false;
    foreach($destinasiList as $key=>$i)
    {
        if($i['destinasi'] === $bj->destinasi_balik && $i['tarikh'] === $bj->tarikh_balik) $exist = true;
    }
    if(!$exist) $destinasiList[] = ['destinasi' => $bj->destinasi_balik, 'tarikh' => $bj->tarikh_balik];
}
foreach($balikPegawai as $bp){
    $exist = false;
    foreach($destinasiList as $key=>$i)
    {
        if($i['destinasi'] === $bp->destinasi_balik && $i['tarikh'] === $bp->tarikh_balik) $exist = true;
    }
    if(!$exist) $destinasiList[] = ['destinasi' => $bp->destinasi_balik, 'tarikh' => $bp->tarikh_balik];
}
foreach($balikPengurus as $bps){
    $exist = false;
    foreach($destinasiList as $key=>$i)
    {
        if($i['destinasi'] === $bps->destinasi_balik && $i['tarikh'] === $bps->tarikh_balik) $exist = true;
    }
    if(!$exist) $destinasiList[] = ['destinasi' => $bps->destinasi_balik, 'tarikh' => $bps->tarikh_balik];
}

// echo '<pre>';
// var_dump($destinasiList);
// die;

foreach($atlet as $item){
    $name = Atlet::findOne(['atlet_id' => $item->atlet])->name_penuh;
    $namaPenumpang[] = ['name' => $name, 'tarikh_pergi' => $item->tarikh_pergi, 'flight_pergi' => $item->flight_no_pergi, 'masa_pergi' => $item->masa_pergi, 'destinasi_pergi' => $item->destinasi_pergi, 'tarikh_balik' => $item->tarikh_balik, 'flight_balik' => $item->flight_no_balik, 'masa_balik' => $item->masa_balik, 'destinasi_balik' => $item->destinasi_balik];
}
foreach($jurulatih as $item){
    $name = Jurulatih::findOne(['jurulatih_id' => $item->jurulatih])->nama;
    $namaPenumpang[] = ['name' => $name, 'tarikh_pergi' => $item->tarikh_pergi, 'flight_pergi' => $item->flight_no_pergi, 'masa_pergi' => $item->masa_pergi, 'destinasi_pergi' => $item->destinasi_pergi, 'tarikh_balik' => $item->tarikh_balik, 'flight_balik' => $item->flight_no_balik, 'masa_balik' => $item->masa_balik, 'destinasi_balik' => $item->destinasi_balik];
}
foreach($pegawai as $item){
    $namaPenumpang[] = ['name' => $item->pegawai, 'tarikh_pergi' => $item->tarikh_pergi, 'flight_pergi' => $item->flight_no_pergi, 'masa_pergi' => $item->masa_pergi, 'destinasi_pergi' => $item->destinasi_pergi, 'tarikh_balik' => $item->tarikh_balik, 'flight_balik' => $item->flight_no_balik, 'masa_balik' => $item->masa_balik, 'destinasi_balik' => $item->destinasi_balik];
}
foreach($pengurus as $item){
    $namaPenumpang[] = ['name' => $item->pengurus_sukan, 'tarikh_pergi' => $item->tarikh_pergi, 'flight_pergi' => $item->flight_no_pergi, 'masa_pergi' => $item->masa_pergi, 'destinasi_pergi' => $item->destinasi_pergi, 'tarikh_balik' => $item->tarikh_balik, 'flight_balik' => $item->flight_no_balik, 'masa_balik' => $item->masa_balik, 'destinasi_balik' => $item->destinasi_balik];
}
//var_dump($namaPenumpang); die;
?>
<!DOCTYPE html>
<body>
    <div class="float-left" style="width:14%">
        <img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="">
    </div>
    <div class="float-left form-title-center2" style="width:80%">
        BORANG PENEMPAHAN TIKET KAPAL TERBANG
    </div>
    <div class="clear"></div>
    <div class="centerHeaderForm">
    KEPADA : PENGARAH BAHAGIAN PENGURUSAN
    </div>
    <div class="centerHeaderForm" style="margin:10px 0px 40px">
    ( UP: ________________________________________________________________ )
    </div>

    <div class="sectionWrap" style="border:0px">
    <span class="text-bold">1. MAKLUMAT PEMOHON</span><br />
        <table cellspacing="4" class="leftMargin">
          <tr>
            <td class="text-bold">1.1</td>
            <td class="text-bold">Nama Pemohon</td>
            <td>:</td>
            <td><?= $parentModel->nama_pemohon ?></td>
          </tr>
          <tr>
            <td class="text-bold">1.2</td>
            <td class="text-bold">Bahagian</td>
            <td>:</td>
            <td><?= $parentModel->bahagian ?></td>
          </tr>
          <tr>
            <td class="text-bold">1.3</td>
            <td class="text-bold">Jawatan</td>
            <td>:</td>
            <td><?= $parentModel->jawatan ?></td>
          </tr>
        </table>
    </div>
    
    <div class="sectionWrap" style="border:0px">
    <span class="text-bold">2. MAKLUMAT PERJALANAN</span>
        <table cellspacing="4" class="leftMargin" cellpadding="5">
          <tr>
            <td class="text-bold" style="vertical-align:top">2.1</td>
            <td class="text-bold" style="vertical-align:top">Perjalanan</td>
            <td>:</td>
            <td>
                <table border="1" width="100%" cellspacing="0" cellpadding="5" align="center">
                    <tr>
                        <th width="40%">Destinasi</th>
                        <th>Tarikh</th>
                    </tr>
                    <?php
                    foreach($destinasiList as $list){
                    ?>
                    <tr>
                        <td width="40%"><?= $list['destinasi'] ?></td>
                        <td align="center"><?= date('d/m/Y',strtotime($list['tarikh'])) ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </td>
          </tr>
          <tr>
            <td class="text-bold">2.2</td>
            <td class="text-bold">Nama Program</td>
            <td>:</td>
            <td><?= $parentModel->nama_program ?></td>
          </tr>
          <tr>
            <td class="text-bold">2.3</td>
            <td class="text-bold">No.Fail Kelulusan</td>
            <td>:</td>
            <td><?= $parentModel->no_fail_kelulusan ?></td>
          </tr>
          <tr>
            <td class="text-bold">2.4</td>
            <td class="text-bold">Bil.Penumpang</td>
            <td>:</td>
            <td><?= $parentModel->bil_penumpang ?></td>
          </tr>
          <tr>
            <td class="text-bold">2.5</td>
            <td class="text-bold">Aktiviti</td>
            <td>:</td>
            <td><?= $parentModel->aktiviti ?></td>
          </tr>
          <tr>
            <td class="text-bold">2.6</td>
            <td class="text-bold">Kod Perbelanjaan</td>
            <td>:</td>
            <td><?= $parentModel->kod_perbelanjaan ?></td>
          </tr>
          <tr>
            <td class="text-bold">2.7</td>
            <td class="text-bold">Sukan</td>
            <td>:</td>
            <td><?= $sukanName ?></td>
          </tr>
        </table>
    </div>
    
    <div class="sectionWrap" style="border:0px">
    <span class="text-bold">3. SENARAI PENUMPANG</span><br /><br />
        <table border="1" width="100%" cellspacing="0" cellpadding="5" align="center">
          <tr>
            <th rowspan="2">Bil</th>
            <th rowspan="2">Nama</th>
            <th colspan="4">Pergi</th>
            <th colspan="4">Balik</th>
          </tr>
          <tr>
            <th>Tarikh</th>
            <th>No Flight</th>
            <th>Masa</th>
            <th>Destinasi</th>
            <th>Tarikh</th>
            <th>No Flight</th>
            <th>Masa</th>
            <th>Destinasi</th>
          </tr>
            <?php
            $bil = 1;
            foreach($namaPenumpang as $penumpang){
            ?>
                <tr>
                    <td align="center"><?= $bil ?></td>
                    <td><?= $penumpang['name'] ?></td>
                    <td><?= date('d/m/Y',strtotime($penumpang['tarikh_pergi'])) ?></td>
                    <td><?= $penumpang['flight_pergi'] ?></td>
                    <td><?= $penumpang['masa_pergi'] ?></td>
                    <td><?= $penumpang['destinasi_pergi'] ?></td>
                    <td><?= date('d/m/Y',strtotime($penumpang['tarikh_balik'])) ?></td>
                    <td><?= $penumpang['flight_balik'] ?></td>
                    <td><?= $penumpang['masa_balik'] ?></td>
                    <td><?= $penumpang['destinasi_balik'] ?></td>
                </tr>
            <?php
                $bil++;
            }
            ?>
        </table>
    </div>
    
    <div class="sectionWrap" style="border:0px">
    <span class="text-bold">4. KELULUSAN</span><br /><br />
        <table cellspacing="4" class="leftMargin">
          <tr>
            <td class="text-bold">4.1</td>
            <td class="text-bold">Status</td>
            <td>:</td>
            <td><?= $parentModel->kelulusan ?></td>
          </tr>
        </table>
    </div>
    <div class="sectionWrap">
        <div class="innerText">
            <div class="float-left" style="width:50%">
            Tandatangan Pemohon:<br /><br /><br />
            .........................................................<br /><br />
            Jawatan:<br />
            Tarikh:<br />
            </div>
            <div class="float-left" style="width:50%">
            Tandatangan:<br /><br /><br />
            .........................................................<br /><br />
            Jawatan:<br />
            Tarikh:<br />
            </div>
            <div class="clear"></div>
        </div>
    </div>
</body>
</html>