<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanBimbinganKaunselingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan Bimbingan Kaunseling';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-bimbingan-kaunseling-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-bimbingan-kaunseling']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Permohonan Bimbingan Kaunseling', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_bimbingan_kaunseling_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'value' => 'atlet.name_penuh'
            ],
            //'status_permohonan',
            [
                'attribute' => 'status_permohonan',
                'value' => 'refStatusPermohonan.desc'
            ],
            'tarikh_rujukan',
            //'nama_pemohon_rujukan',
            // 'kes_latarbelakang',
            // 'notis',
            // 'pekerjaan_bapa',
            // 'pekerjaan_ibu',
            // 'bil_adik_beradik',
            // 'no_telefon',

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
