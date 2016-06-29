<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MesyuaratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Biasiswa : Rekods";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::button('<span class="glyphicon glyphicon-refresh"></span>', ['value'=>Url::to(['index']),'class' => 'btn btn-info', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabKewanganBiasiswaID.'");']) ?>
    </p>
    
    <!-- Six Step HPT - START -->
    <div class="panel panel-default copyright-wrap" id="sixstep-list">
        <div class="panel-heading">Biasiswa
            <button type="button" class="close" data-target="#sixstep-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="sixstep-body">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderSS,
            //'filterModel' => $searchModelSS,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'admin_e_biasiswa_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::admin_e_biasiswa_id,
                ],
                'value' => 'refSesiPermohonan.nama'
            ],
            [
                'attribute' => 'nama',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                ]
            ],
            [
                'attribute' => 'no_matriks',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_matriks,
                ]
            ],
            [
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ]
            ],
            //'jantina',
            [
                'attribute' => 'jantina',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jantina,
                ],
                'value' => 'refJantina.desc'
            ],
            // 'keturunan',
            // 'agama',
            // 'taraf_perkahwinan',
            // 'kawasan_temuduga_anda',
            // 'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
            // 'no_tel_bimbit',
            // 'no_pendaftaran_oku',
            // 'kategori_oku',
            // 'oku_lain_lain',
            // 'universiti_institusi',
            // 'program_pengajian',
            // 'kursus_bidang_pengajian',
            // 'falkulti',
            // 'kategori',
            // 'tarikh_tamat',
            // 'semester_terkini',
            // 'baki_semester_yang_tinggal',
            // 'mendapat_pembiayaan_pendidikan',
            // 'sukan',
            // 'perakuan_pemohon',
            // 'kelulusan',
            // 'status_permohonan',
            [
                'attribute' => 'status_permohonan_desc',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan_desc,
                ],
                'label' => GeneralLabel::status_permohonan_desc,
                'value' => 'refStatusPermohonanEBiasiswa.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/six-step/view', 'id' => $model->six_step_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Six Step HPT - END -->

</div>

<?php
$script = <<< JS
        
$(function(){
$('.custom_button').click(function(){
        window.open($(this).attr('value'), "PopupWindow", "width=1300,height=800,scrollbars=yes,resizable=no");
        return false;
});});
     

JS;
        
$this->registerJs($script);
?>
