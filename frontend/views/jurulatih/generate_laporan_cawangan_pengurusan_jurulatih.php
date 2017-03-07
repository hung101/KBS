<?php
use app\models\Jurulatih;


// table reference
use app\models\RefJantina;
use app\models\RefCawangan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefNegara;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefTarafPerkahwinan;
use app\models\RefBahagianJurulatih;
use app\models\RefProgramJurulatih;
use app\models\RefSubProgramPelapisJurulatih;
use app\models\RefLainProgramJurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefStatusJurulatih;
use app\models\RefStatusPermohonanJurulatih;
use app\models\RefKeaktifanJurulatih;
use app\models\RefSektorPekerjaan;
use app\models\RefAgensiJurulatih;
use app\models\RefStatusTawaran;

$mulaDisplay = null;
$hinggaDisplay = null;
$mysqlMula = null;
$mysqlTamat = null;

if($model->tarikh_dari != '')
{
    $mulaDisplay = date('d/m/Y', strtotime($model->tarikh_dari));
    $mysqlMula = date("Y-m-d H:i:s", strtotime($model->tarikh_dari));
}
if($model->tarikh_hingga != '')
{
    $hinggaDisplay = date('d/m/Y', strtotime($model->tarikh_hingga));
    $datetime = new DateTime($model->tarikh_hingga);
    $datetime->modify('+1 day');
    $mysqlTamat = $datetime->format('Y-m-d H:i:s');
}

$dataSource = Jurulatih::find()
            ->joinWith(['refCawangan'])
            ->joinWith(['refSubProgramPelapisJurulatih'])
            ->joinWith(['refSukan'])
            ->joinWith(['refAcara'])
            ->joinWith(['refBahagianJurulatih'])
            ->joinWith(['refProgramJurulatih'])
            ->joinWith(['refJurulatihSpkk'])
            ->joinWith(['refStatusTawaran'])
            ->joinWith(['refJurulatihSukan' => function($query) {
                        $query->orderBy(['tbl_jurulatih_sukan.created' => SORT_DESC])->one();
                    },
            ]);
 
if($mysqlMula != null)
{
    $dataSource = $dataSource->andFilterWhere(['>=', 'tbl_jurulatih.created', $mysqlMula]);
}
if($mysqlTamat != null)
{
    $dataSource = $dataSource->andFilterWhere(['<', 'tbl_jurulatih.created', $mysqlTamat]);
}  
            
$dataSource = $dataSource->all();

?>

<div class="form-title" align="center">LAPORAN CAWANGAN PENGURUSAN JURULATIH</div>
<div class="text-bold" style="font-size:14px;border:2px solid; padding:6px; margin:4px 0px 6px" align="center">
MESYUARAT PENYELARASAN PELANTIKAN, PELANJUTAN DAN PENAMATAN KONTRAK JURULATIH LUAR NEGARA DAN TEMPATAN
</div>
<?php
$br = '<br />';
if ($mulaDisplay != null) {
    echo 'Dari: '.$mulaDisplay.'<br />';
    $br = '<br />';
}
if ($hinggaDisplay != null) {
    echo 'Hingga: '.$hinggaDisplay;
    $br = $br.'<br />';
}
echo $br;
?>
<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th class="border1 padding1">BIL</th>
        <th class="border2 padding1">MAKLUMAT PERMOHONAN</th>
        <th class="border2 padding1">STATUS<br />PERMOHONAN</th>
        <th class="border2 padding1">JUSTIFIKASI<br />CADANGAN</th>
        <th class="border2 padding1">CADANGAN PERMOHONAN</th>
        <th class="border2 padding1">RUJUKAN KONTRAK TERDAHULU</th>
        <th class="border2 padding1">CATATAN</th>
        <th class="border2 padding1">KEPUTUSAN<br />MESYUARAT</th>
    </tr>
    <?php
    $bil = 1;
    foreach($dataSource as $item)
    {
        $program = null; $sukan = null; $tarikhMulaLantik = null; $tarikhTamatLantik = null;
        if(isset($item->refJurulatihSukan[0]->program))
        {
            $ref = RefProgramJurulatih::findOne(['id' => $item->refJurulatihSukan[0]->program]);
            $program = $ref['desc'];
        }

        if(isset($item->refJurulatihSukan[0]->sukan))
        {
            $ref = RefSukan::findOne(['id' => $item->refJurulatihSukan[0]->sukan]);
            $sukan = $ref['desc'];
        }
        
        $ref = RefNegara::findOne(['id' => $item->warganegara]);
        $warganegara = $ref['desc'];
        
        if(isset($item->refJurulatihSukan[0]->tarikh_mula_lantikan))
        {
            $tarikhMulaLantik = date('d.m.Y', strtotime($item->refJurulatihSukan[0]->tarikh_mula_lantikan));
        }
        
        if(isset($item->refJurulatihSukan[0]->tarikh_tamat_lantikan))
        {
            $tarikhTamatLantik = date('d.m.Y', strtotime($item->refJurulatihSukan[0]->tarikh_tamat_lantikan));
        }
    ?>
    <tr>
        <td valign="top" align="center" class="border1 padding-top3"><?= $bil ?></td>
        <td valign="top" class="border2">
            <table>
                <tr>
                    <td valign="top">Program</td>
                    <td>:</td>
                    <td><?= $program ?></td>
                </tr>
                <tr>
                    <td valign="top">Sukan</td>
                    <td>:</td>
                    <td><?= $sukan ?></td>
                </tr>
                <tr>
                    <td valign="top">Nama</td>
                    <td>:</td>
                    <td><?= $item->nama ?></td>
                </tr>
                <tr>
                    <td valign="top">Status</td>
                    <td>:</td>
                    <td><?= $item->refStatusJurulatih->desc ?></td>
                </tr>
                <tr>
                    <td valign="top">Asal</td>
                    <td>:</td>
                    <td><?= $warganegara ?></td>
                </tr>
                <tr>
                    <td valign="top">Umur</td>
                    <td>:</td>
                    <td><?= $item->umur_jurulatih ?></td>
                </tr>
                <tr>
                    <td valign="top">Pusat Latihan</td>
                    <td>:</td>
                    <td><?= $item->pusat_latihan ?></td>
                </tr>
            </table>
        </td>
        <td class="border2">&nbsp;</td>
        <td class="border2">&nbsp;</td>
        <td valign="top" class="border2">
            <table>
                <tr>
                    <td valign="top">Tempoh Kontrak</td>
                    <td>:</td>
                    <td><?= $tarikhMulaLantik.'-'.$tarikhTamatLantik ?><?= (isset($item->refJurulatihSukan[0]->jumlah_bulan))?'('.$item->refJurulatihSukan[0]->jumlah_bulan.' Bulan)':null ?></td>
                </tr>
                <tr>
                    <td valign="top">Jumlah Gaji</td>
                    <td>:</td>
                    <td><?= (isset($item->refJurulatihSukan[0]->jumlah))?'RM '.$item->refJurulatihSukan[0]->jumlah:null ?></td>
                </tr>
                <tr>
                    <td valign="top">Jumlah Bulan</td>
                    <td>:</td>
                    <td><?= (isset($item->refJurulatihSukan[0]->jumlah_bulan))?$item->refJurulatihSukan[0]->jumlah_bulan:null ?></td>
                </tr>
                <tr>
                    <td valign="top">Jumlah</td>
                    <td>:</td>
                    <td><?= (isset($item->refJurulatihSukan[0]->jumlah_keseluruhan))?'RM '.$item->refJurulatihSukan[0]->jumlah_keseluruhan:null ?></td>
                </tr>
                <tr>
                    <td valign="top">Bersamaan USD</td>
                    <td>:</td>
                    <td><?= (isset($item->refJurulatihSukan[0]->bersamaan_usd))?$item->refJurulatihSukan[0]->bersamaan_usd:null ?></td>
                </tr>
                <tr>
                    <td valign="top">Kontrak Mulai</td>
                    <td>:</td>
                    <td><?= $tarikhMulaLantik ?></td>
                </tr>
                <tr>
                    <td valign="top">Kenaikan Mulai</td>
                    <td>:</td>
                    <td><?= $tarikhMulaLantik ?></td>
                </tr>
                <tr>
                    <td valign="top">Tamat Kontrak</td>
                    <td>:</td>
                    <td><?= $tarikhTamatLantik ?></td>
                </tr>
                <tr>
                    <td valign="top">Letak Jawatan</td>
                    <td>:</td>
                    <td><?= (isset($item->refJurulatihSukan[0]->letak_jawatan))?date('d.m.Y', strtotime($item->refJurulatihSukan[0]->letak_jawatan)):null ?></td>
                </tr>
            </table>
        </td>
        <td valign="top" class="border2">
            <table border="0" cellspacing="0" cellpadding="0" style="height:100%">
                <?php
                for($x=1; $x < count($item->refJurulatihSukan); $x++)
                {
                    $ref = RefProgramJurulatih::findOne(['id' => $item->refJurulatihSukan[$x]->program]);
                    $historyProgram = $ref['desc'];
                    
                    $tarikhMulaLantik = date('d.m.Y', strtotime($item->refJurulatihSukan[$x]->tarikh_mula_lantikan));
                    $tarikhTamatLantik = date('d.m.Y', strtotime($item->refJurulatihSukan[$x]->tarikh_tamat_lantikan));
                ?>
                <tr>
                    <td class="padding2 borderBottom1"><?= $historyProgram ?></td>
                    <td class="padding2 borderBottom1"><?= $tarikhMulaLantik ?> - <?= $tarikhTamatLantik ?></td>
                    <td class="padding2 borderBottom2">RM <?= $item->refJurulatihSukan[$x]->jumlah ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </td>
        <td valign="top" class="border2">
            <table>
                <tr>
                    <td>SPKK</td>
                    <td>:</td>
                    <td><?= $item->catatan_spkk ?></td>
                </tr>
                <tr>
                    <td>Bersyarat</td>
                    <td>:</td>
                    <td><?= $item->bersyarat ?></td>
                </tr>
                <tr>
                    <td>Lain-lain</td>
                    <td>:</td>
                    <td><?= $item->lain_lain ?></td>
                </tr>
                <tr>
                    <td>Catatan</td>
                    <td>:</td>
                    <td><?= $item->catatan ?></td>
                </tr>
            </table>
        </td>
        <td class="border2"></td>
    </tr>
    <?php
    $bil++;
    }
    ?>
</table>