<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProfilPusatLatihanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::profil_pusat_latihan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-pusat-latihan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['delete'])){
            //$template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['profil-pusat-latihan']['create'])): ?>
    <p>
        <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::profil_pusat_latihan, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'profil_pusat_latihan_id',
            //'nama_pusat_latihan',
            [
                'attribute' => 'nama_pusat_latihan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pusat_latihan,
                ],
            ],
            //'alamat_1',
            //'alamat_2',
            //'alamat_3',
            //'alamat_negeri',
            [
                'attribute' => 'alamat_negeri',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::alamat_negeri,
                ],
                'value' => 'refNegeri.desc'
            ],
            // 'alamat_bandar',
            // 'alamat_poskod',
            //'no_telefon',
            [
                'attribute' => 'no_telefon',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_telefon,
                ],
            ],
            //'no_faks',
            [
                'attribute' => 'no_faks',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_faks,
                ],
            ],
            // 'emel',
            //'tarikh_program_bermula',
            [
                'attribute' => 'tarikh_program_bermula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_program_bermula,
                ],
            ],
            // 'tahun_siap_pembinaan',
            // 'kos_project',
            // 'keluasan_venue',
            // 'hakmilik',
            // 'kadar_sewaan',
            // 'status',
            // 'catatan',
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
