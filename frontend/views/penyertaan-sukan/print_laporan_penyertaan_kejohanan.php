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

$nama_kejohanan = \app\models\PerancanganProgramPlan::findOne(['perancangan_program_id' => $model->nama_kejohanan])->nama_program;
$kategori_kejohanan = \app\models\RefKategoriKejohanan::findOne(['id' => $model->kategori_kejohanan])->desc;
$status = \app\models\RefStatusKejohanan::findOne(['id' => $model->status])->desc;

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

$pegawai = app\models\LaporanPenyertaanKejohananPegawai::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->all();
$pengurus = app\models\LaporanPenyertaanKejohananPengurus::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->all();
$jurulatih = app\models\LaporanPenyertaanKejohananJurulatih::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->all();
$atlet = app\models\LaporanPenyertaanKejohananAtlet::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->all();
$prestasi = app\models\LaporanPenyertaanKejohananPrestasi::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->all();
$ranking = app\models\LaporanPenyertaanKejohananRanking::find()->where(['penyertaan_sukan_id' => $model->penyertaan_sukan_id])->all();
?> 

<!DOCTYPE html>
<body>
    <div class="form-title" style="margin:0px 0px 20px">
    LAPORAN PENYERTAAN KEJOHANAN<br />
    SUKAN : <?= $model->sukan ?>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">1. MAKLUMAT KEJOHANAN</span><br />
    <table cellspacing="0" cellpadding="4" width="100%" border="1">
      <tr>
        <td class="text-bold" width="25%">NAMA</td>
        <td><?= $nama_kejohanan ?></td>
      </tr>
      <tr>
        <td class="text-bold">KATEGORI</td>
        <td><?= $kategori_kejohanan ?></td>
      </tr>
      <tr>
        <td class="text-bold">STATUS</td>
        <td><?= $status ?></td>
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
    </table>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">2. PEGAWAI PASUKAN</span><br />
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
    <span class="text-bold">3. PENGURUS PASUKAN</span><br />
    <table cellspacing="0" cellpadding="4" width="100%" border="1">
      <tr>
        <th>BIL</th>
        <th>NAMA</th>
      </tr>
      <?php
      $counter = 1;
      foreach($pengurus as $item){
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
    <span class="text-bold">4. JURULATIH</span><br />
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
    <span class="text-bold">5. ATLET</span><br />
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
    <span class="text-bold">6. PENGINAPAN</span><br />
        <div class="innerText"><?= ($model->penginapan)?$model->penginapan:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">7. MAKAN</span><br />
        <div class="innerText"><?= ($model->makan)?$model->makan:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">8. PENGANGKUTAN</span><br />
        <div class="innerText"><?= ($model->pengangkutan)?$model->pengangkutan:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">9. VENUE PERTANDINGAN</span><br />
        <div class="innerText"><?= ($model->venue_pertandingan)?$model->venue_pertandingan:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">10. PENYERTAAN NEGARA LAIN</span><br />
        <div class="innerText"><?= ($model->penyertaan_negara_lain)?$model->penyertaan_negara_lain:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">11. JADUAL PERTANDINGAN</span><br />
        <?php
        if($model->jadual_pertandingan != null && $model->jadual_pertandingan != '')
        {
            echo 'Ya (Sila rujuk lampiran di dalam sistem)';
        } else {
            echo 'Tiada maklumat';
        }
        ?>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">12. PRESTASI ATLET NEGARA</span><br />
        <table cellspacing="0" cellpadding="4" width="100%" border="1">
          <tr>
            <th>BIL</th>
            <th>NAMA</th>
            <th>ACARA</th>
            <th>SASARAN</th>
            <th>PENCAPAIAN</th>
            <th>CACATAN</th>
          </tr>
          <?php
          $counter = 1;
          foreach($prestasi as $item){
              $a = app\models\Atlet::findOne(['atlet_id' => $item->atlet_id]);
              $acara = \app\models\RefAcara::findOne(['id' => $item->acara])->desc;
              echo '<tr>';
              echo '<td width="7%" align="center">'.$counter.'</td>';
              echo '<td>'.$a->name_penuh.'</td>';
              echo '<td align="center">'.$acara.'</td>';
              echo '<td align="center">'.$item->sasaran.'</td>';
              echo '<td align="center">'.$item->pencapaian.'</td>';
              echo '<td align="center">'.$item->catatan.'</td>';
              echo '</tr>';
              $counter++;
          }
          ?>
        </table>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">13. KEDUDUKAN RANKING</span><br />
    <?php
    if(count($ranking) > 0)
    {
    ?>
        <table cellspacing="0" cellpadding="4" width="100%" border="1">
          <tr>
            <th>RANKING</th>
            <th>NEGARA</th>
            <th>EMAS</th>
            <th>PERAK</th>
            <th>GANGSA</th>
          </tr>
          <?php
          $counter = 1;
          foreach($ranking as $item){
              echo '<tr>';
              echo '<td align="center">'.$item->ranking.'</td>';
              echo '<td align="center">'.$item->negara.'</td>';
              echo '<td align="center">'.$item->emas.'</td>';
              echo '<td align="center">'.$item->perak.'</td>';
              echo '<td align="center">'.$item->gangsa.'</td>';
              echo '</tr>';
              $counter++;
          }
          ?>
        </table>
    <?php
    } else echo 'Tiada maklumat';
    ?>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">14. ULASAN PRESTASI</span><br />
        <div class="innerText"><?= ($model->ulasan_prestasi)?$model->ulasan_prestasi:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">15. RUMUSAN PRESTASI</span><br />
        <div class="innerText"><?= ($model->rumusan_prestasi)?$model->rumusan_prestasi:'Tiada maklumat' ?></div>
    </div>
    
    <div class="sectionWrap">
    <span class="text-bold">16. LAPORAN KEWANGAN</span><br />
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
    <span class="text-bold">17. RUMUSAN</span><br />
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