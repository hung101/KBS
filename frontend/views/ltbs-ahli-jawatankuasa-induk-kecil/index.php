<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LtbsAhliJawatankuasaIndukKecilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::ahli_jawatan_induk_id;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-ahli-jawatankuasa-induk-kecil-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-induk-kecil']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-induk-kecil']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-induk-kecil']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Ahli Jawatankuasa Induk', Url::to(['create', 'profil_badan_sukan_id' => $profil_badan_sukan_id]), ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ahli_jawatan_id',
            //'jenis_jawatankuasa',
            //'nama_jawatankuasa',
            [
                'attribute' => 'nama_penuh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_penuh,
                ]
            ],
            //'jawatan',
            [
                'attribute' => 'jawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jawatan,
                ],
                'value' => 'refJawatanInduk.desc'
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
            // 'bangsa',
            // 'umur',
            // 'pekerjaan',
            // 'nama_majikan',
            // 'tarikh_mula_memegang_jawatan',
            // 'pengiktirafan_yang_diterima',
            // 'kursus_yang_pernah_diikuti_oleh_pemegang_jawatan',

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
