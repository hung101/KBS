<?php
use app\models\general\Upload;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

// table reference
use app\models\RefKategoriPenilaian;
use app\models\RefSukan;
use app\models\Atlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefPeringkatKejohananTemasya;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefTemasya;
use app\models\RefAcara;
use app\models\RefKeputusan;

// $kategori_kejohanan = \app\models\RefKategoriKejohanan::findOne(['id' => $model->kategori_kejohanan])->desc;

if(isset($parentModel->tarikh_mula))
{
    $parentModel->tarikh_mula = date('d/m/Y',strtotime($parentModel->tarikh_mula));
}
if(isset($parentModel->tarikh_tamat))
{
    $parentModel->tarikh_tamat = date('d/m/Y',strtotime($parentModel->tarikh_tamat));
}

$parentModel->nama_kejohanan_temasya = \app\models\PerancanganProgramPlan::findOne(['perancangan_program_id' => $parentModel->nama_kejohanan_temasya])->nama_program;
?> 
<!DOCTYPE html>
<body>
    <div class="form-title" style="margin:0px 0px 20px; font-size:26px">
    Penilaian Prestasi Mengikut Kejohanan
    </div>
    <span class="text-bold">Kejohanan / Latihan</span> : <?= $parentModel->nama_kejohanan_temasya ?><br />
    <span class="text-bold">Tempat</span> : <?= $parentModel->tempat_penginapan ?><br />
    <span class="text-bold">Tarikh Mula</span> : <?= $parentModel->tarikh_mula ?><br />
    <span class="text-bold">Tarikh Tamat</span> : <?= $parentModel->tarikh_tamat ?><br />
    <br />
    <table cellspacing="0" cellpadding="4" width="100%" border="1">
      <tr>
        <th>Bil</th>
        <th>Atlet</th>
        <th>Nama Acara</th>
        <th>Tarikh Acara</th>
        <th>Sasaran</th>
        <th>Keputusan</th>
        <th>Catatan</th>
      </tr>
      <?php
      $counter = 1;
      foreach($model as $item)
      {
          $a = app\models\Atlet::findOne(['atlet_id' => $item->atlet]);
          $refAcara = app\models\RefAcara::findOne(['id' => $item->nama_acara]);
          if(isset($item->tarikh_acara))
            {
                $item->tarikh_acara = date('d/m/Y',strtotime($item->tarikh_acara));
            }
          $refKeputusan = app\models\RefKeputusan::findOne(['id' => $item->keputusan]);
          ?>
          <tr>
            <td align="center"><?= $counter ?></td>
            <td><?= $a->name_penuh ?></td>
            <td><?= $refAcara->desc ?></td>
            <td align="center"><?= $item->tarikh_acara ?></td>
            <td align="center"><?= $item->sasaran ?></td>
            <td align="center"><?= $refKeputusan->desc ?></td>
            <td><?= $item->catatan ?></td>
          </tr>   
          
          <?php
          $counter++;
      }
      ?>

    </table>
    
</body>
</html>
