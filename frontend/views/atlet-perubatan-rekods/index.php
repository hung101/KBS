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

$this->title = GeneralLabel::rekod_perubatan_sains_sukan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::button('<span class="glyphicon glyphicon-refresh"></span>', ['value'=>Url::to(['index']),'class' => 'btn btn-info', 'onclick' => 'updateRenderAjax("'.Url::to(['index']).'", "'.GeneralVariable::tabPerubatanRekodsID.'");']) ?>
    </p>
    
    <!-- Six Step HPT - START -->
    <div class="panel panel-default copyright-wrap" id="sixstep-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#sixstep-body"><?= GeneralLabel::six_step ?> - HPT</a>
            <button type="button" class="close" data-target="#sixstep-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="sixstep-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderSS,
            //'filterModel' => $searchModelSS,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'atlet_id',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                    ],
                    'value' => 'atlet.name_penuh'
                ],
                [
                    'attribute' => 'stage',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::stage,
                    ],
                    'value' => 'refSixStepStage.desc'
                ],
                [
                    'attribute' => 'status',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status,
                    ],
                    'value' => 'refSixStepStatus.desc'
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
    
    <!-- Six Step Biomekanik - START -->
    <div class="panel panel-default copyright-wrap" id="sixstep_biomekanik-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#sixstep_biomekanik-body"><?= GeneralLabel::six_step .' - '.GeneralLabel::biomekanik; ?></a>
            <button type="button" class="close" data-target="#sixstep_biomekanik-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="sixstep_biomekanik-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderSSB,
            //'filterModel' => $searchModelSSB,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'atlet_id',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                    ],
                    'value' => 'atlet.name_penuh'
                ],
                [
                'attribute' => 'stage',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::stage,
                ],
                'value' => 'refSixstepBiomekanikStage.desc'
            ],
            [
                'attribute' => 'status',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status,
                ],
                'value' => 'refSixstepBiomekanikStatus.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/six-step-biomekanik/view', 'id' => $model->six_step_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Six Step Biomekanik - END -->
    
    <!-- Six Step Fisiologi - START -->
    <div class="panel panel-default copyright-wrap" id="sixstep_fisiologi-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#sixstep_fisiologi-body"><?= GeneralLabel::six_step.' - '.GeneralLabel::fisiologi; ?></a>
            <button type="button" class="close" data-target="#sixstep_fisiologi-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="sixstep_fisiologi-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderSSF,
            //'filterModel' => $searchModelSSF,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'atlet_id',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                    ],
                    'value' => 'atlet.name_penuh'
                ],
            [
                'attribute' => 'stage',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::stage,
                ],
                'value' => 'refSixstepFisiologiStage.desc'
            ],
            [
                'attribute' => 'status',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status,
                ],
                'value' => 'refSixstepFisiologiStatus.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/six-step-fisiologi/view', 'id' => $model->six_step_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Six Step Fisiologi - END -->
    
    <!-- Six Step Psikologi - START -->
    <div class="panel panel-default copyright-wrap" id="sixstep_psikologi-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#sixstep_psikologi-body"><?= GeneralLabel::six_step.' - '.GeneralLabel::psikologi; ?></a>
            <button type="button" class="close" data-target="#sixstep_psikologi-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="sixstep_psikologi-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderSSP,
            //'filterModel' => $searchModelSSP,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'atlet_id',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                    ],
                    'value' => 'atlet.name_penuh'
                ],
            [
                'attribute' => 'stage',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::stage,
                ],
                'value' => 'refSixstepPsikologiStage.desc'
            ],
            [
                'attribute' => 'status',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status,
                ],
                'value' => 'refSixstepPsikologiStatus.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/six-step-psikologi/view', 'id' => $model->six_step_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Six Step Psikologi - END -->
    
    <!-- Six Step Satelit - START -->
    <div class="panel panel-default copyright-wrap" id="sixstep_satelit-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#sixstep_satelit-body"><?= GeneralLabel::six_step ?> - ISN Negeri</a>
            <button type="button" class="close" data-target="#sixstep_satelit-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="sixstep_satelit-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderSSS,
            //'filterModel' => $searchModelSSS,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'atlet_id',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                    ],
                    'value' => 'atlet.name_penuh'
                ],
            [
                'attribute' => 'stage',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::stage,
                ],
                'value' => 'refSixstepSatelitStage.desc'
            ],
            [
                'attribute' => 'status',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status,
                ],
                'value' => 'refSixstepSatelitStatus.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/six-step-satelit/view', 'id' => $model->six_step_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Six Step Satelit - END -->
    
    <!-- Six Step Suaian Fizikal - START -->
    <div class="panel panel-default copyright-wrap" id="sixstep_suaian_fizikal-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#sixstep_suaian_fizikal-body"><?= GeneralLabel::six_step.' - '.GeneralLabel::suaian_fizikal_gym; ?></a>
            <button type="button" class="close" data-target="#sixstep_suaian_fizikal-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="sixstep_suaian_fizikal-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderSSSF,
            //'filterModel' => $searchModelSSSF,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'atlet_id',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                    ],
                    'value' => 'atlet.name_penuh'
                ],
            [
                'attribute' => 'stage',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::stage,
                ],
                'value' => 'refSixstepSuaianFizikalStage.desc'
            ],
            [
                'attribute' => 'status',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status,
                ],
                'value' => 'refSixstepSuaianFizikalStatus.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/six-step-suaian-fizikal/view', 'id' => $model->six_step_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Six Step Suaian Fizikal - END -->
    
    <!-- Temujanji - START -->
    <div class="panel panel-default copyright-wrap" id="temujanji-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#temujanji-body"><?= GeneralLabel::temujanji ?></a>
            <button type="button" class="close" data-target="#temujanji-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="temujanji-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderPLT,
            //'filterModel' => $searchModelPLT,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'tarikh_temujanji',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_temujanji,
                ],
                'format' => 'raw',
                /*'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);
                },*/
            ],
            [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_atlet,
                ],
                'value' => 'atlet.name_penuh'
            ],
            
            [
                'attribute' => 'jenis_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            [
                'attribute' => 'kategori_atlet',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_atlet,
                ],
                'value' => 'refProgramSemasaSukanAtlet.desc'
            ],
            //'makmal_perubatan',
            //'status_temujanji',
            [
                'attribute' => 'status_temujanji',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_temujanji,
                ],
                'value' => 'refStatusTemujanjiPesakitLuar.desc'
            ],
            [
                'attribute' => 'makmal_perubatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::makmal_perubatan,
                ],
                'value' => 'refJenisTemujanjiPesakitLuar.desc'
            ],
            // 'pegawai_yang_bertanggungjawab',
            [
                'attribute' => 'pegawai_yang_bertanggungjawab',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pegawai_yang_bertanggungjawab,
                ],
                'value' => 'refPegawaiPerubatan.desc'
            ],
            [
                'attribute' => 'kehadiran_pesakit',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kehadiran_pesakit,
                ],
                'value' => 'refStatusKehadiran.desc'
            ],
            // 'catitan_ringkas',
            /*[
                'attribute' => 'catatan_tambahan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::catatan_tambahan,
                ]
            ],*/ 
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/pl-temujanji/view', 'id' => $model->six_step_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Temujanji - END -->

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
