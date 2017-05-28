<?php

use kartik\helpers\Html;
use kartik\widgets\Select2;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use app\models\general\Placeholder;
use common\models\general\GeneralFunction;

use app\models\RefStatusTawaran;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::agenda_perbincangan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    
    
    <!-- Atlet - START -->
    <div class="panel panel-default copyright-wrap" id="atlet-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#atlet-body"><?= GeneralLabel::atlet ?></a>
            <button type="button" class="close" data-target="#atlet-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="atlet-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?php Pjax::begin(['timeout' => false, 'enablePushState' => false,]); ?>
        <?php //echo Html::beginForm(['atlet/bulk'],'post');?>
        <?= GridView::widget([
            'dataProvider' => $dataProviderAtlet,
            //'filterModel' => $searchModelAtlet,
            'columns' => [
                /*[
                    'class' => 'yii\grid\CheckboxColumn',
                ],*/
                ['class' => 'yii\grid\SerialColumn'],
                //'atlet_id',
                [
                    'attribute' => 'ic_no',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::ic_no,
                    ]
                ],
                [
                    'attribute' => 'name_penuh',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::name_penuh,
                    ]
                ],
                /*[
                    'attribute' => 'tawaran',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tawaran,
                    ]
                ],*/
                /*[
                    'attribute' => 'tawaran',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tawaran,
                    ],
                    'value' => function ($model) {
                        return $model->tawaran == 1 ? GeneralLabel::yes : GeneralLabel::no;
                    },
                ],*/
                [
                    'attribute' => 'tawaran',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tawaran,
                    ],
                    'filter'=>false,
                    'value' => 'refStatusTawaran.desc'
                ],
                /*[
                    'attribute' => 'tarikh_lahir',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_lahir,
                    ]
                ],*/
                /*[
                    'attribute' => 'umur',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::umur,
                    ]
                ],*/
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/atlet/view', 'id' => $model->atlet_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '{view}',
                ],
            ],
        ]); ?>

                <div class="row">
                    <div class="col-lg-2">
                        <?php 
                //echo Html::dropDownList('action','',ArrayHelper::map(RefStatusTawaran::find()->all(),'id', 'desc'),['class'=>'dropdown',]);

            /*echo Select2::widget([
            'name' => 'action',
            'data' => ArrayHelper::map(RefStatusTawaran::find()->where('id <> :id', [':id' => RefStatusTawaran::DALAM_PROSES])->all(),'id', 'desc'),
            'options' => [
                'placeholder' => Placeholder::tindakan,
            ],
        ]);*/
            ?>
                    </div>
                    <div class="col-lg-2">
                        <?php //echo Html::submitButton(GeneralLabel::send, ['class' => 'btn btn-info',]);?>
                    </div>
                    <?php //echo Html::endForm();?> 

                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Atlet - END -->
    
    
    <!-- Jurulatih - START -->
    <div class="panel panel-default copyright-wrap" id="jurulatih-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#jurulatih-body"><?= GeneralLabel::jurulatih ?></a>
            <button type="button" class="close" data-target="#jurulatih-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="jurulatih-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderJurulatih,
            //'filterModel' => $searchModelJurulatih,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'ic_no',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::ic_no,
                    ]
                ],
                [
                    'attribute' => 'nama',
                    'filterInputOptions' => [
                        'class'       => 'form-control',
                        'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama,
                    ]
                ],
                [
                'attribute' => 'status_tawaran',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_tawaran,
                ],
                'value' => 'refStatusTawaran.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/jurulatih/view', 'id' => $model->jurulatih_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '{view}',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Jurulatih - END -->
    
    <!-- Program Binaan - START -->
    <div class="panel panel-default copyright-wrap" id="program_binaan-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#program_binaan-body"><?= GeneralLabel::program_binaan ?></a>
            <button type="button" class="close" data-target="#program_binaan-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="program_binaan-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderPengurusanProgramBinaan,
            //'filterModel' => $searchModelPengurusanProgramBinaan,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                /*[
                'attribute' => 'aktiviti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::aktiviti,
                ],
                'value' => 'refPerancanganProgram.nama_program'
            ],*/
            [
                'attribute' => 'nama_aktiviti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_aktiviti,
                ]
            ],
             [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);
                },
            ],
             [
                'attribute' => 'tarikh_tamat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tamat,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);
                },
            ],
            [
                'attribute' => 'status_permohonan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_permohonan,
                ],
                'value' => 'refStatusPermohonanProgramBinaan.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/pengurusan-program-binaan/view', 'id' => $model->pengurusan_program_binaan_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '{view}',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Program Binaan - END -->
    
    <!-- Permohonan Peralatan - START -->
    <div class="panel panel-default copyright-wrap" id="permohonan_peralatan-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#permohonan_peralatan-body"><?= GeneralLabel::permohonan_peralatan ?></a>
            <button type="button" class="close" data-target="#permohonan_peralatan-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="permohonan_peralatan-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderPermohonanPeralatan,
            //'filterModel' => $searchModelPermohonanPeralatan,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                /*[
                'attribute' => 'cawangan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::cawangan,
                ],
                'value' => 'refCawangan.desc'
            ],
            [
                'attribute' => 'sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            [
                'attribute' => 'program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
                'value' => 'refProgram.desc'
            ],*/
             [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATETIME);
                },
            ],
             [
                'attribute' => 'jumlah_peralatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jumlah_peralatan,
                ]
            ],
            [
                'attribute' => 'kelulusan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kelulusan,
                ],
                'value' => 'refKelulusan.desc'
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/permohonan-peralatan/view', 'id' => $model->permohonan_peralatan_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '{view}',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Permohonan Peralatan - END -->
    
    
    <!-- Kejohanan - START -->
    <div class="panel panel-default copyright-wrap" id="kejohanan-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#kejohanan-body"><?= GeneralLabel::kejohanan ?></a>
            <button type="button" class="close" data-target="#kejohanan-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="kejohanan-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderKejohanan,
            //'filterModel' => $searchModelKejohanan,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                /*[
                'attribute' => 'nama_sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_sukan,
                ],
                'value' => 'refSukan.desc'
            ],*/
            [
                'attribute' => 'tempat_penginapan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tempat_penginapan,
                ]
            ],
            [
                'attribute' => 'tempat_latihan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tempat_latihan,
                ]
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/penyertaan-sukan/view', 'id' => $model->penyertaan_sukan_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '{view}',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Kejohanan - END -->
    
    <!-- Pusat Latihan - START -->
    <div class="panel panel-default copyright-wrap" id="pusat_latihan-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#pusat_latihan-body"><?= GeneralLabel::pusat_latihan ?></a>
            <button type="button" class="close" data-target="#pusat_latihan-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="pusat_latihan-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderPusatLatihan,
            //'filterModel' => $searchModelPusatLatihan,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'nama_pusat_latihan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pusat_latihan,
                ],
            ],
            [
                'attribute' => 'alamat_negeri',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::alamat_negeri,
                ],
                'value' => 'refNegeri.desc'
            ],
            [
                'attribute' => 'no_telefon',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_telefon,
                ],
            ],
            [
                'attribute' => 'no_faks',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_faks,
                ],
            ],
            [
                'attribute' => 'tarikh_program_bermula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_program_bermula,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_program_bermula, GeneralFunction::TYPE_DATE);
                },
            ],
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/profil-pusat-latihan/view', 'id' => $model->profil_pusat_latihan_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '{view}',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Pusat Latihan - END -->
    
    
    <!-- Program - START -->
    <div class="panel panel-default copyright-wrap" id="program-list">
        <div class="panel-heading"><a data-toggle="collapse" href="#program-body"><?= GeneralLabel::program ?></a>
            <button type="button" class="close" data-target="#program-list" data-dismiss="alert"> <span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div id="program-body" class="panel-collapse collapse">
            <div class="panel-body">
                <?= GridView::widget([
            'dataProvider' => $dataProviderProgram,
            //'filterModel' => $searchModelProgram,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'cawangan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::cawangan             ],
                    'value' => 'refCawangan.desc'
            ],
            [
                'attribute' => 'sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                    'value' => 'refSukan.desc'
            ],
            [
                'attribute' => 'program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
                'value' => 'refProgramSemasaSukanAtlet.desc'
            ],
            [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula);
                },
            ],
            [
                'attribute' => 'tarikh_tamat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tamat,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat);
                },
            ],
            
            //'muat_naik',
            /*[
                'attribute' => 'muat_naik',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::muat_naik,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->muat_naik){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->muat_naik .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],*/
            /*[
                'attribute' => 'status_program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_program,
                ],
                    'value' => 'refStatusProgram.desc'
            ],*/
                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '', ['value'=>Url::to(['/perancangan-program-plan/view', 'id' => $model->perancangan_program_plan_master_id]), 'class' => 'custom_button']);
                        },
                    ],
                    'template' => '{view}',
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <!-- Program - END -->

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
