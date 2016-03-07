<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanMaklumBalasPesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kehadiran Peserta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-maklum-balas-peserta-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklum-balas-peserta']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklum-balas-peserta']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-maklum-balas-peserta']['create'])): ?>
    <p>
        <?= Html::a(GeneralLabel::createTitle . ' Kehadiran Peserta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_maklum_balas_peserta_id',
            'nama_penganjuran_kursus',
            //'kod_kursus',
            //'tarikh_kursus',
            //'catatan',
            [
                'attribute' => 'jantina',
                'value' => 'refJantina.desc'
            ],
            [
                'attribute' => 'bangsa',
                'value' => 'refBangsa.desc'
            ],

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
