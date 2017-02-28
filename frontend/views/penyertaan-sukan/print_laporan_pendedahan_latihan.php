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

$kategori_kejohanan = \app\models\RefKategoriKejohanan::findOne(['id' => $model->kategori_kejohanan])->desc;

if(isset($model->tarikh_mula))
{
    $model->tarikh_mula = date('d/m/Y',strtotime($model->tarikh_mula));
}
if(isset($model->tarikh_tamat))
{
    $model->tarikh_tamat = date('d/m/Y',strtotime($model->tarikh_tamat));
}
if(isset($model->tarikh_bertolak))
{
    $model->tarikh_bertolak = date('d/m/Y',strtotime($model->tarikh_bertolak));
}
if(isset($model->tarikh_balik))
{
    $model->tarikh_balik = date('d/m/Y',strtotime($model->tarikh_balik));
}

$pegawai = app\models\LaporanPendedahanLatihanPegawai::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->all();
$jurulatih = app\models\LaporanPendedahanLatihanJurulatih::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->all();
$atlet = app\models\LaporanPendedahanLatihanAtlet::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->all();
?> 

<!DOCTYPE html>
<body>
    <div class="form-title" style="margin:0px 0px 20px">
    LAPORAN PENDEDAHAN LATIHAN<br />
    SUKAN : <?= $model->sukan ?>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">1. MAKLUMAT PROGRAM</span><br />
    <table cellspacing="0" cellpadding="4" width="100%" border="1">
      <tr>
        <td class="text-bold" width="25%">AKTIVITI</td>
        <td><?= $model->aktiviti ?></td>
      </tr>
      <tr>
        <td class="text-bold">KATEGORI</td>
        <td><?= $kategori_kejohanan ?></td>
      </tr>
      <tr>
        <td class="text-bold">TARIKH</td>
        <td><?= $model->tarikh_mula.' - '.$model->tarikh_tamat ?></td>
      </tr>
      <tr>
        <td class="text-bold">TEMPAT</td>
        <td><?= $model->tempat ?></td>
      </tr>
      <tr>
        <td class="text-bold">TARIKH BERTOLAK</td>
        <td><?= $model->tarikh_bertolak ?></td>
      </tr>
      <tr>
        <td class="text-bold">TARIKH BALIK</td>
        <td><?= $model->tarikh_balik ?></td>
      </tr>
      <tr>
        <td class="text-bold">OBJEKTIF</td>
        <td><?= $model->objektif ?></td>
      </tr>
    </table>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">2. SENARAI PEGAWAI</span><br />
    <table cellspacing="0" cellpadding="4" width="100%" border="1">
      <tr>
        <th>BIL</th>
        <th>NAMA</th>
      </tr>
      <?php
      $counter = 1;
      foreach($pegawai as $item){
          echo '<tr>';
          echo '<td width="7%" align="center">'.$counter.'</td>';
          echo '<td>'.$item->nama.'</td>';
          echo '</tr>';
          $counter++;
      }
      
      ?>
    </table>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">3. JURULATIH</span><br />
    <table cellspacing="0" cellpadding="4" width="100%" border="1">
      <tr>
        <th>BIL</th>
        <th>NAMA</th>
      </tr>
      <?php
      $counter = 1;
      foreach($jurulatih as $item){
          $name = app\models\Jurulatih::findOne(['jurulatih_id' => $item->jurulatih_id])->nama;
          echo '<tr>';
          echo '<td width="7%" align="center">'.$counter.'</td>';
          echo '<td>'.$name.'</td>';
          echo '</tr>';
          $counter++;
      }
      ?>
    </table>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">4. ATLET</span><br />
    <table cellspacing="0" cellpadding="4" width="100%" border="1">
      <tr>
        <th>BIL</th>
        <th>NAMA</th>
        <th>JANTINA</th>
      </tr>
      <?php
      $counter = 1;
      foreach($atlet as $item){
          $a = app\models\Atlet::findOne(['atlet_id' => $item->atlet_id]);
          $jantina = app\models\RefJantina::findOne(['id' => $a->jantina])->desc;
          echo '<tr>';
          echo '<td width="7%" align="center">'.$counter.'</td>';
          echo '<td>'.$a->name_penuh.'</td>';
          echo '<td align="center">'.$jantina.'</td>';
          echo '</tr>';
          $counter++;
      }
      ?>
    </table>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">5. PENGINAPAN</span><br />
        <div class="innerText"><?= ($model->penginapan)?$model->penginapan:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">6. MAKAN</span><br />
        <div class="innerText"><?= ($model->makan)?$model->makan:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">7. PENGANGKUTAN</span><br />
        <div class="innerText"><?= ($model->pengangkutan)?$model->pengangkutan:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">8. VENUE LATIHAN</span><br />
        <div class="innerText"><?= ($model->venue_latihan)?$model->venue_latihan:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">9. JADUAL LATIHAN</span><br />
        <?php
        if($model->jadual_latihan != null && $model->jadual_latihan != '')
        {
            echo 'Ya (Sila rujuk lampiran di dalam sistem)';
        } else {
            echo 'Tiada maklumat';
        }
        ?>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">10. LATIHAN / AKTIVITI</span><br />
        <div class="innerText"><?= ($model->latihan_aktiviti)?$model->latihan_aktiviti:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">11. HAL-HAL LAIN</span><br />
        <div class="innerText"><?= ($model->hal_lain)?$model->hal_lain:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">12. LAPORAN KEWANGAN</span><br />
        <?php
        if($model->laporan_kewangan != null && $model->laporan_kewangan != '')
        {
            echo 'Ya (Sila rujuk lampiran di dalam sistem)';
        } else {
            echo 'Tiada maklumat';
        }
        ?>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">13. RUMUSAN / ULASAN</span><br />
        <div class="innerText"><?= ($model->rumusan)?$model->rumusan:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
        <div class="innerText">
            <div class="float-left" style="width:50%">
            Disediakan oleh:<br /><br /><br />
            .........................................................<br /><br />
            Nama:<br />
            Jawatan:<br />
            Tarikh:<br />
            </div>
            <div class="float-left" style="width:50%">
            Disahkan oleh:<br /><br /><br />
            .........................................................<br /><br />
            Nama:<br />
            Jawatan:<br />
            Tarikh:<br />
            </div>
            <div class="clear"></div>
        </div>
    </div>
</body>
</html>