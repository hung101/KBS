<?php
use app\models\PenyertaanSukan;
use app\models\PenyertaanSukanAcara;
use app\models\PenyertaanSukanJurulatih;
use app\models\PenyertaanSukanPegawai;

use app\models\general\GeneralLabel;
// table reference
use app\models\RefSukan;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefKeputusan;

//search data
$datas = PenyertaanSukan::find()->where(['nama_sukan' => $model->nama_sukan, 'program' => $model->program])->all();
//var_dump(count($datas)); die;
?>

<!DOCTYPE html>
<body>
    <div id="filterWrap" style="margin-bottom:5px">
        <span class="text-bold"><?= GeneralLabel::sukan ?></span> : <?= RefSukan::findOne(['id' => $model->nama_sukan])->desc ?><br />
        <span class="text-bold"><?= GeneralLabel::program ?></span> : <?= RefProgramSemasaSukanAtlet::findOne(['id' => $model->program])->desc ?>
    </div>
    <div class="form-title" style="margin:0px 0px 20px; font-size:24px">
        <?= strtoupper(GeneralLabel::competition_and_training_information) ?>
    </div>

    <table cellspacing="0" cellpadding="4" border="1" width="100%">
      <tr>
        <th rowspan="2">NO</th>
        <th rowspan="2">DETAILS</th>
        <th rowspan="2">PLACE</th>
        <th rowspan="2">DATE</th>
        <th colspan="3">PARTICIPATION</th>
        <th colspan="3">OVERALL RESULT</th>
      </tr>
      <tr>
        <th>ATHLETE</th>
        <th>COACH</th>
        <th>OFFICER</th>
        <th>TARGET</th>
        <th>RESULT</th>
        <th>REMARKS</th>
      </tr>
      <?php
        $count = 1;
        foreach($datas as $item)
        {
            $mula = null; $tamat = null;
            $competionName = \app\models\PerancanganProgramPlan::findOne(['perancangan_program_id' => $item->nama_kejohanan_temasya])->nama_program;
            
            if(isset($item->tarikh_mula))
            {
                $mula = date('d/m/Y',strtotime($item->tarikh_mula));
            }
            
            if(isset($item->tarikh_tamat))
            {
                $tamat = date('d/m/Y',strtotime($item->tarikh_tamat));
            }
            //count orang
            $atletCount = PenyertaanSukanAcara::find()->where(['penyertaan_sukan_id' => $item->penyertaan_sukan_id])->count();
            $jurulatihCount = PenyertaanSukanJurulatih::find()->where(['penyertaan_sukan_id' => $item->penyertaan_sukan_id])->count();
            $pegawaiCount = PenyertaanSukanPegawai::find()->where(['penyertaan_sukan_id' => $item->penyertaan_sukan_id])->count();
            
            //count pingat
            //get emas, perak, gangsa id
            $emas = RefKeputusan::find()->select('id')->where(['like', 'desc', 'emas'])->andWhere(['aktif' => 1]);
            $perak = RefKeputusan::find()->select('id')->where(['like', 'desc', 'perak'])->andWhere(['aktif' => 1]);
            $gangsa = RefKeputusan::find()->select('id')->where(['like', 'desc', 'gangsa'])->andWhere(['aktif' => 1]);
            
            $emasCount = PenyertaanSukanAcara::find()->where(['IN', 'keputusan', $emas])
                        ->andWhere(['penyertaan_sukan_id' => $item->penyertaan_sukan_id])->count();
            
            $perakCount = PenyertaanSukanAcara::find()->where(['IN', 'keputusan', $perak])
                        ->andWhere(['penyertaan_sukan_id' => $item->penyertaan_sukan_id])->count();
                        
            $gangsaCount = PenyertaanSukanAcara::find()->where(['IN', 'keputusan', $gangsa])
                        ->andWhere(['penyertaan_sukan_id' => $item->penyertaan_sukan_id])->count();
                        
            $arrayMerge = [];
            if(isset($emas->one()->id)) $arrayMerge[] = $emas->one()->id;
            if(isset($perak->one()->id)) $arrayMerge[] = $perak->one()->id;
            if(isset($gangsa->one()->id)) $arrayMerge[] = $gangsa->one()->id;
                        
            //select for rank type
            $allRank = PenyertaanSukanAcara::find()->where(['NOT IN', 'keputusan', $arrayMerge])
                        ->andWhere(['penyertaan_sukan_id' => $item->penyertaan_sukan_id])->groupBy('keputusan')
                        ->all();
            $resultStr = '';
            if($emasCount > 0) {
                $resultStr = $resultStr.$emasCount.' EMAS';
                if($perakCount > 0 || $gangsaCount > 0 || count($allRank) > 0) {
                    $resultStr = $resultStr.', ';
                }
            }
            if($perakCount > 0) {
                $resultStr = $resultStr.$perakCount.' PERAK';
                if($gangsaCount > 0 || count($allRank) > 0) {
                    $resultStr = $resultStr.', ';
                }
            }
            if($gangsaCount > 0) {
                $resultStr = $resultStr.$gangsaCount.' GANGSA';
                if(count($allRank) > 0) {
                    $resultStr = $resultStr.', ';
                }
            } 
            if(count($allRank) > 0) {
                $counter = 0;
                foreach($allRank as $rank) {
                    $rankName = RefKeputusan::findOne(['id' => $rank->keputusan])->desc;
                    $countRank = PenyertaanSukanAcara::find()->where(['keputusan' => $rank->keputusan])
                                 ->andWhere(['penyertaan_sukan_id' => $item->penyertaan_sukan_id])->count();
                    $resultStr = $resultStr.$countRank.' Rank '.$rankName;
                    if($counter != (count($allRank)-1))
                    {
                       $resultStr = $resultStr.', '; 
                    }
                    $counter++;
                }
            }
            
        ?>
          <tr>
            <td align="center"><?= $count ?></td>
            <td><?= $competionName ?></td>
            <td align="center"><?= $item->tempat_penginapan ?></td>
            <td align="center"><?= $mula.' - '.$tamat ?></td>
            <td align="center"><?= $atletCount ?></td>
            <td align="center"><?= $jurulatihCount ?></td>
            <td align="center"><?= $pegawaiCount ?></td>
            <td><?= $item->sasaran_kejohanan ?></td>
            <td><?= $resultStr ?></td>
            <td><?= $item->catatan ?></td>
          </tr>
        <?php
            $count++;
        }
      ?>

    </table>
</body>
</html>