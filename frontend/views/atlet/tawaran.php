<?php

use kartik\helpers\Html;
use kartik\widgets\Select2;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use app\models\general\Placeholder;

use app\models\RefStatusTawaran;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pengurusan_tawaran_atlet;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-index">
    
    <?php
        $template = '{view}';
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php Pjax::begin(['timeout' => false, 'enablePushState' => false,]); ?>
    <?=Html::beginForm(['atlet/bulk'],'post');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
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
            //'tempat_lahir_bandar',
            // 'tempat_lahir_negeri',
            // 'bangsa',
            // 'agama',
            // 'jantina',
            // 'taraf_perkahwinan',
            /*[
                'attribute' => 'tinggi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tinggi,
                ]
            ],*/
            /*[
                'attribute' => 'berat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::berat,
                ]
            ],*/
            // 'bahasa_ibu',
            // 'no_sijil_lahir',
            // 'ic_no',
            // 'ic_no_lama',
            // 'passport_no',
            // 'passport_tempat_dikeluarkan',
            // 'lesen_memandu_no',
            // 'lesen_tamat_tempoh',
            // 'jenis_lesen',
            // 'tel_bimbit_no_1',
            // 'tel_bimbit_no_2',
            // 'tel_no',
            // 'emel',
            // 'facebook',
            // 'twitter',
            // 'alamat_rumah',
            // 'alamat_surat_menyurat',
            // 'msn',
            // 'dari_bahagian',
            // 'sumber',
            // 'negeri_diwakili',
            // 'nama_kecemasan',
            // 'pertalian_kecemasan',
            // 'tel_no_kecemasan',
            // 'tel_bimbit_no_kecemasan',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return (isset($model->refAtletSukan[0]->program_semasa) && $model->refAtletSukan[0]->program_semasa == RefProgramSemasaSukanAtlet::PODIUM && !isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ? '' :
                                Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-confirm' => GeneralMessage::confirmDelete,
                                        'data-method'=>'post',
                                        ]);

                    },
                    'update' => function ($url, $model) {
                         $options = [
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            ];
                        return (isset($model->refAtletSukan[0]->program_semasa) && $model->refAtletSukan[0]->program_semasa == RefProgramSemasaSukanAtlet::PODIUM && !isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['podium_kemas_kini'])) ? '' :Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                    'view' => function ($url, $model) {
                        $options = [
                            'title' => Yii::t('yii', 'View'),
                            'target' => '_blank',
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' => 'custom_button',
                            'value'=>$url
                            ];
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

        <div class="row">
            <div class="col-lg-2">
                <?php 
        //echo Html::dropDownList('action','',ArrayHelper::map(RefStatusTawaran::find()->all(),'id', 'desc'),['class'=>'dropdown',]);
    
    echo Select2::widget([
    'name' => 'action',
    'data' => ArrayHelper::map(RefStatusTawaran::find()->where('id <> :id', [':id' => RefStatusTawaran::DALAM_PROSES])->all(),'id', 'desc'),
    'options' => [
        'placeholder' => Placeholder::tindakan,
    ],
]);
    ?>
            </div>
            <div class="col-lg-2">
                <?=Html::submitButton(GeneralLabel::send, ['class' => 'btn btn-info',]);?>
            </div>
        </div>
    
    
    <?= Html::endForm();?> 

    <?php Pjax::end(); ?>

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
