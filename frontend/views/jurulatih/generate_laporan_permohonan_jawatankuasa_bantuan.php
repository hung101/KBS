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
$grandTotal = 0;

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

<div class="form-title" align="center">LAPORAN PERMOHONAN JAWATANKUASA BANTUAN</div>

Dari: <?= $mulaDisplay ?><br />
Hingga: <?= $hinggaDisplay ?>
<br /><br />
<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th class="border1 padding1">BIL</th>
        <th class="border2 padding1">MAKLUMAT PERMOHONAN</th>
        <th class="border2 padding1">CADANGAN PERMOHONAN</th>
        <th class="border2 padding1">JUMLAH</th>
        <th class="border2 padding1">MAKLUMAT KONTRAK TERDAHULU</th>
        <th class="border2 padding1">CATATAN</th>
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
                    <td>Permohonan</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Program</td>
                    <td>:</td>
                    <td><?= $program ?></td>
                </tr>
                <tr>
                    <td>Sukan</td>
                    <td>:</td>
                    <td><?= $sukan ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $item->nama ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td><?= $item->refStatusJurulatih->desc ?></td>
                </tr>
                <tr>
                    <td>Asal</td>
                    <td>:</td>
                    <td><?= $warganegara ?></td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td><?= $item->umur_jurulatih ?></td>
                </tr>
                <tr>
                    <td>Pusat Latihan</td>
                    <td>:</td>
                    <td><?= $item->pusat_latihan ?></td>
                </tr>
            </table>
        </td>
        <td valign="top" class="border2">
            <table>
                <tr>
                    <td>Tempoh Kontrak</td>
                    <td>:</td>
                    <td><?= $tarikhMulaLantik.'-'.$tarikhTamatLantik ?>(<?= (isset($item->refJurulatihSukan[0]->jumlah_bulan))?$item->refJurulatihSukan[0]->jumlah_bulan:null ?> Bulan)</td>
                </tr>
                <tr>
                    <td>Jumlah Gaji</td>
                    <td>:</td>
                    <td>RM <?= (isset($item->refJurulatihSukan[0]->jumlah))?$item->refJurulatihSukan[0]->jumlah:null ?></td>
                </tr>
                <tr>
                    <td>Jumlah Bulan</td>
                    <td>:</td>
                    <td><?= (isset($item->refJurulatihSukan[0]->jumlah_bulan))?$item->refJurulatihSukan[0]->jumlah_bulan:null ?></td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>:</td>
                    <td><?= (isset($item->refJurulatihSukan[0]->jumlah_keseluruhan))?'RM '.$item->refJurulatihSukan[0]->jumlah_keseluruhan:null ?></td>
                </tr>
                <tr>
                    <td>Bersamaan USD</td>
                    <td>:</td>
                    <td><?= (isset($item->refJurulatihSukan[0]->bersamaan_usd))?$item->refJurulatihSukan[0]->bersamaan_usd:null ?></td>
                </tr>
                <tr>
                    <td>Kontrak Mulai</td>
                    <td>:</td>
                    <td><?= $tarikhMulaLantik ?></td>
                </tr>
                <tr>
                    <td>Kenaikan Mulai</td>
                    <td>:</td>
                    <td><?= $tarikhMulaLantik ?></td>
                </tr>
                <tr>
                    <td>Tamat Kontrak</td>
                    <td>:</td>
                    <td><?= $tarikhTamatLantik ?></td>
                </tr>
                <tr>
                    <td>Letak Jawatan</td>
                    <td>:</td>
                    <td><?= (isset($item->refJurulatihSukan[0]->letak_jawatan))?date('d.m.Y', strtotime($item->refJurulatihSukan[0]->letak_jawatan)):null ?></td>
                </tr>
            </table>
        </td>
        <td class="border2">
            <?php
            if(isset($item->refJurulatihSukan[0]->jumlah_keseluruhan))
            {
                $grandTotal = $grandTotal+$item->refJurulatihSukan[0]->jumlah_keseluruhan;
                echo 'RM '.$item->refJurulatihSukan[0]->jumlah_keseluruhan;
            }        
            ?>
        </td>
        <td valign="top" class="border2">
            <table border="0" cellspacing="0" cellpadding="0">
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
    </tr>
    <?php
    $bil++;
    }
    ?>
    <tr>
        <td class="border1"></td>
        <td class="border2"></td>
        <td align="center" class="border2"><b>JUMLAH KESELURUHAN</b></td>
        <td class="border2" align="center"><b>RM <?= ($grandTotal>0)?number_format($grandTotal, 2):0.00 ?></b></td>
        <td class="border2"></td>
        <td class="border2"></td>
    </tr>
</table>