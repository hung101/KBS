<?php

use kartik\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AtletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::senarai_atlet;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-index">
    
    <?php
        $template = '{view}';
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['update'])){
            $template .= ' {update}';
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['atlet']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::atlet, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
    
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
                'attribute' => 'name_penuh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::name_penuh,
                ]
            ],
            [
                'attribute' => 'tarikh_lahir',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_lahir,
                ]
            ],
            [
                'attribute' => 'umur',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::umur,
                ]
            ],
            //'tempat_lahir_bandar',
            // 'tempat_lahir_negeri',
            // 'bangsa',
            // 'agama',
            // 'jantina',
            // 'taraf_perkahwinan',
            [
                'attribute' => 'tinggi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tinggi,
                ]
            ],
            [
                'attribute' => 'berat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::berat,
                ]
            ],
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

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method'=>'post',
                        ]);

                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

    <?=Html::dropDownList('action','',[''=>GeneralLabel::select_action,'1'=>GeneralLabel::offer_yes,'0'=>GeneralLabel::offer_no],['class'=>'dropdown',])?>
    <?=Html::submitButton(GeneralLabel::send, ['class' => 'btn btn-info',]);?>
    <?= Html::endForm();?> 

    <?php Pjax::end(); ?>

</div>
