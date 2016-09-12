<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenilaianPenganjurKursusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::penilaian_penganjur_kursus;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-penganjur-kursus-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-penganjur-kursus']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-penganjur-kursus']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-penganjur-kursus']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::penilaian_penganjur_kursus, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penilaian_penganjur_kursus_id',
            //'pengurusan_permohonan_kursus_persatuan_id',
            [
                'attribute' => 'pengurusan_permohonan_kursus_persatuan_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::agensi,
                ],
                'value' => 'refPengurusanPermohonanKursusPersatuan.agensi'
            ],
            //'tarikh_kursus',
            [
                'attribute' => 'tarikh_kursus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_kursus,
                ]
            ],
            //'nama_penganjur_kursus',
            [
                'attribute' => 'nama_penganjur_kursus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_penganjur_kursus,
                ]
            ],
            //'kod_kursus',
            [
                'attribute' => 'kod_kursus',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kod_kursus,
                ]
            ],
            //'tempat_kursus',
            //'nama_penyelaras',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

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
