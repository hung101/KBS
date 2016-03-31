<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanPerganjuranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Permohonan Kursus Teknikal ';
$this->title = 'Pemohonan Penganjuran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perganjuran-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-perganjuran']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-perganjuran']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-perganjuran']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Permohonan Penganjuran', ['create'], ['class' => 'btn btn-success']) ?>
            <!--<?= Html::a('Tambah Permohonan Kursus Teknikal', ['create'], ['class' => 'btn btn-success']) ?>-->
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_perganjuran_id',
            [
                'attribute' => 'tarikh_kursus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_kursus,
                ]
            ],
            [
                'attribute' => 'tempat_kursus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tempat_kursus,
                ]
            ],
            [
                'attribute' => 'aktiviti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::aktiviti,
                ]
            ],
            //'nama_instructor',
            // 'kelulusan',

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
