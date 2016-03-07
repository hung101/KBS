<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LtbsAhliJawatankuasaKecilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ahli Jawatankuasa Kecil / Biro ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-ahli-jawatankuasa-kecil-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-kecil']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-kecil']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-ahli-jawatankuasa-kecil']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Ahli Jawatankuasa Kecil / Biro ', Url::to(['create', 'profil_badan_sukan_id' => $profil_badan_sukan_id]), ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ahli_jawatan_id',
            'nama_jawatankuasa',
            //'jawatan',
            [
                'attribute' => 'jawatan',
                'value' => 'refJawatan.desc'
            ],
            'nama_penuh',
            'no_kad_pengenalan',
            //'jantina',
            [
                'attribute' => 'jantina',
                'value' => 'refJantina.desc'
            ],
            // 'bangsa',
            // 'umur',
            // 'no_tel',
            // 'emel',
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
