<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

use app\models\Jurulatih;
use app\models\RefStatusJurulatih;
use app\models\RefKeaktifanJurulatih;
use app\models\RefSukan;
use app\models\RefProgramJurulatih;
use app\models\RefStatusTawaran;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::senarai_jurulatih;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['update'])){
            //$template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['delete'])){
            //$template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) . (($desc !=null) ? ' - ' . $desc : '')?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
 <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Status</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <?php
            //status Jurulatih
            $modelStatuses = RefStatusJurulatih::find()->where(['=', 'aktif', 1])->all();
            
            foreach($modelStatuses as $modelStatus){
                $countJurulatih = Jurulatih::find()->where(['=', 'status_jurulatih', $modelStatus->id])->count();
                echo '<div class="btn-group" role="group">';
                echo Html::a($modelStatus->desc . ' - ' . $countJurulatih, ['index','filter_type'=>'status_jurulatih', 'id'=>$modelStatus->id, 'desc'=>'Status : ' . $modelStatus->desc], ['class'=>'btn btn-info']);
                echo '</div>';
            }
          ?>
      </div>
    </div>
  </div>
     
  <!--<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Keaktifan</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <?php
            //Keaktifan Jurulatih
            $modelStatuses = RefKeaktifanJurulatih::find()->where(['=', 'aktif', 1])->all();
            
            foreach($modelStatuses as $modelStatus){
                $countJurulatih = Jurulatih::find()->where(['=', 'status_keaktifan_jurulatih', $modelStatus->id])->count();
                echo '<div class="btn-group" role="group">';
                echo Html::a($modelStatus->desc . ' - ' . $countJurulatih, ['index','filter_type'=>'status_keaktifan_jurulatih', 'id'=>$modelStatus->id, 'desc'=>'Keaktifan : ' . $modelStatus->desc], ['class'=>'btn btn-info']);
                echo '</div>';
            }
          ?>
      </div>
    </div>
  </div>-->
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Status Tawaran</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <?php
            //Keaktifan Jurulatih
            $modelStatuses = RefStatusTawaran::find()->where(['=', 'aktif', 1])->all();
            
            foreach($modelStatuses as $modelStatus){
                $countJurulatih = Jurulatih::find()->where(['=', 'status_tawaran', $modelStatus->id])->count();
                echo '<div class="btn-group" role="group">';
                echo Html::a($modelStatus->desc . ' - ' . $countJurulatih, ['index','filter_type'=>'status_tawaran_id', 'id'=>$modelStatus->id, 'desc'=>'Status Tawaran : ' . $modelStatus->desc], ['class'=>'btn btn-info']);
                echo '</div>';
            }
          ?>
      </div>
    </div>
  </div>
     
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Sukan</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      
          <?php
            //Sukan Jurulatih
            $modelStatuses = RefSukan::find()->where(['=', 'aktif', 1])->all();
            
            echo '<div class="btn-group btn-group-justified" role="group" aria-label="...">';
            
            $counter = 0;
            
            foreach($modelStatuses as $modelStatus){
                $countJurulatih = Jurulatih::find()->where(['=', 'nama_sukan', $modelStatus->id])->count();
                echo '<div class="btn-group" role="group">';
                echo Html::a($modelStatus->desc . ' - ' . $countJurulatih, ['index','filter_type'=>'sukan', 'id'=>$modelStatus->id, 'desc'=>'Sukan : ' . $modelStatus->desc], ['class'=>'btn btn-info']);
                echo '</div>';
                $counter++;
                if($counter%6==0){
                    echo '</div>';
                    echo '<div class="btn-group btn-group-justified" role="group" aria-label="...">';
                }
            }
            
            echo '</div>';
          ?>
    </div>
  </div>
     
     <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
        Program</a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
      
          <?php
            //Program Jurulatih
            $modelStatuses = RefProgramJurulatih::find()->where(['=', 'aktif', 1])->all();
            
            echo '<div class="btn-group btn-group-justified" role="group" aria-label="...">';
            
            $counter = 0;
            
            foreach($modelStatuses as $modelStatus){
                $countJurulatih = Jurulatih::find()->where(['=', 'program', $modelStatus->id])->count();
                echo '<div class="btn-group" role="group">';
                echo Html::a($modelStatus->desc . ' - ' . $countJurulatih, ['index','filter_type'=>'program_id', 'id'=>$modelStatus->id, 'desc'=>'Program : ' . $modelStatus->desc], ['class'=>'btn btn-info']);
                echo '</div>';
                $counter++;
                if($counter%6==0){
                    echo '</div>';
                    echo '<div class="btn-group btn-group-justified" role="group" aria-label="...">';
                }
            }
            
            echo '</div>';
          ?>
    </div>
  </div>
     
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
        Sijil</a>
      </h4>
    </div>
    <div id="collapse5" class="panel-collapse collapse">
      <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <?php
                //Sijil Jurulatih
                $countJurulatih = Jurulatih::find()->joinWith(['refJurulatihSpkk'])->where(['=', 'tbl_jurulatih_spkk.jenis_spkk', 1])->where(['=', 'tbl_jurulatih_spkk.tahap', 1])->groupBy('tbl_jurulatih.jurulatih_id')->count();
            ?>
          <?= Html::a('Sains Sukan I - ' . $countJurulatih, ['index','filter_type'=>'sijil', 'id'=>1, 'id2'=>1, 'desc'=>'Sijil : Sains Sukan I'], ['class'=>'btn btn-info']) ?>
        </div>
        <div class="btn-group" role="group">
            <?php
                //Sijil Jurulatih
                $countJurulatih = Jurulatih::find()->joinWith(['refJurulatihSpkk'])->where(['=', 'tbl_jurulatih_spkk.jenis_spkk', 1])->where(['=', 'tbl_jurulatih_spkk.tahap', 2])->groupBy('tbl_jurulatih.jurulatih_id')->count();
            ?>
          <?= Html::a('Sains Sukan II - ' . $countJurulatih, ['index','filter_type'=>'sijil', 'id'=>1, 'id2'=>2, 'desc'=>'Sijil : Sains Sukan II'], ['class'=>'btn btn-info']) ?>
        </div>
        <div class="btn-group" role="group">
            <?php
                //Sijil Jurulatih
                $countJurulatih = Jurulatih::find()->joinWith(['refJurulatihSpkk'])->where(['=', 'tbl_jurulatih_spkk.jenis_spkk', 1])->where(['=', 'tbl_jurulatih_spkk.tahap', 3])->groupBy('tbl_jurulatih.jurulatih_id')->count();
            ?>
          <?= Html::a('Sains Sukan III - ' . $countJurulatih, ['index','filter_type'=>'sijil', 'id'=>1, 'id2'=>3, 'desc'=>'Sijil : Sains Sukan III'], ['class'=>'btn btn-info']) ?>
        </div>
          <div class="btn-group" role="group">
            <?php
                //Sijil Jurulatih
                $countJurulatih = Jurulatih::find()->joinWith(['refJurulatihSpkk'])->where(['=', 'tbl_jurulatih_spkk.jenis_spkk', 2])->where(['=', 'tbl_jurulatih_spkk.tahap', 1])->groupBy('tbl_jurulatih.jurulatih_id')->count();
            ?>
          <?= Html::a('Sukan Spesifik I - ' . $countJurulatih, ['index','filter_type'=>'sijil', 'id'=>2, 'id2'=>1, 'desc'=>'Sijil : Sukan Spesifik I'], ['class'=>'btn btn-info']) ?>
        </div>
          <div class="btn-group" role="group">
            <?php
                //Sijil Jurulatih
                $countJurulatih = Jurulatih::find()->joinWith(['refJurulatihSpkk'])->where(['=', 'tbl_jurulatih_spkk.jenis_spkk', 2])->where(['=', 'tbl_jurulatih_spkk.tahap', 2])->groupBy('tbl_jurulatih.jurulatih_id')->count();
            ?>
          <?= Html::a('Sukan Spesifik II - ' . $countJurulatih, ['index','filter_type'=>'sijil', 'id'=>2, 'id2'=>2, 'desc'=>'Sijil : Sukan Spesifik II'], ['class'=>'btn btn-info']) ?>
        </div>
          <div class="btn-group" role="group">
            <?php
                //Sijil Jurulatih
                $countJurulatih = Jurulatih::find()->joinWith(['refJurulatihSpkk'])->where(['=', 'tbl_jurulatih_spkk.jenis_spkk', 2])->where(['=', 'tbl_jurulatih_spkk.tahap', 3])->groupBy('tbl_jurulatih.jurulatih_id')->count();
            ?>
          <?= Html::a('Sukan Spesifik III - ' . $countJurulatih, ['index','filter_type'=>'sijil', 'id'=>2, 'id2'=>3, 'desc'=>'Sijil : Sukan Spesifik III'], ['class'=>'btn btn-info']) ?>
        </div>
      </div>
    </div>
  </div>
     
</div> 

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'jurulatih_id',
             [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            [
                'attribute' => 'ic_no',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::ic_no,
                ],
            ],
            /*[
                'attribute' => 'bahagian',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::bahagian,
                ],
                'value' => 'refBahagianJurulatih.desc'
            ],*/
            //'cawangan',
            /*[
                'attribute' => 'cawangan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::cawangan,
                ],
                'value' => 'refCawangan.desc'
            ],*/
            //'nama_sukan',
            [
                'attribute' => 'nama_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            //'nama_acara',
            [
                'attribute' => 'program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
                'value' => 'refProgramJurulatih.desc'
            ],
            [
                'attribute' => 'status_tawaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_tawaran,
                ],
                'value' => 'refStatusTawaran.desc'
            ],
            //'program',
           // 'gambar',
            
            //'sub_cawangan_pelapis',
            /*[
                'attribute' => 'sub_cawangan_pelapis',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sub_cawangan_pelapis,
                ],
                'value' => 'refSubProgramPelapisJurulatih.desc'
            ],*/
           // 'lain_lain_program',
            // 'pusat_latihan',
            // 'status_jurulatih',
            // 'status_permohonan',
            // 'status_keaktifan_jurulatih',
            
            // 'bangsa',
            // 'agama',
            // 'jantina',
            // 'warganegara',
            // 'tarikh_lahir',
            // 'tempat_lahir',
            // 'taraf_perkahwinan',
            // 'bil_tanggungan',
            // 'ic_no',
            // 'ic_no_lama',
            // 'ic_tentera',
            // 'passport_no',
            // 'tamat_tempoh',
            // 'no_visa',
            // 'tamat_visa_tempoh',
            // 'no_permit_kerja',
            // 'tamat_permit_tempoh',
            // 'alamat_rumah_1',
            // 'alamat_rumah_2',
            // 'alamat_rumah_3',
            // 'alamat_rumah_negeri',
            // 'alamat_rumah_bandar',
            // 'alamat_rumah_poskod',
            // 'alamat_surat_menyurat_1',
            // 'alamat_surat_menyurat_2',
            // 'alamat_surat_menyurat_3',
            // 'alamat_surat_menyurat_negeri',
            // 'alamat_surat_menyurat_bandar',
            // 'alamat_surat_menyurat_poskod',
            // 'no_telefon',
            // 'emel',
            // 'status',
            // 'sektor',
            // 'jawatan',
            // 'no_telefon_pejabat',
            // 'nama_majikan',
            // 'alamat_majikan_1',
            // 'alamat_majikan_2',
            // 'alamat_majikan_3',
            // 'alamat_majikan_negeri',
            // 'alamat_majikan_bandar',
            // 'alamat_majikan_poskod',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]);

                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
