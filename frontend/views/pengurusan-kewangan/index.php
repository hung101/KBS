<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanKewanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Kewangan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kewangan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kewangan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kewangan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kewangan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Pengurusan Kewangan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_kewangan_id',
            //'nama_acara_program',
            [
                'attribute' => 'nama_acara_program',
                'value' => 'refSukan.desc'
            ],
            'tarikh_acara',
            //'kategori_penggunaan',
            [
                'attribute' => 'kategori_penggunaan',
                'value' => 'refKategoriPenggunaan.desc'
            ],
            //'objektif',
            // 'harga_penggunaan',
            // 'jumlah_bajet',
            // 'jumlah_penggunaan',
            // 'catatan',
            // 'bajet_keseluruhan',
            // 'penggunaan_keseluruhan',
            // 'baki',

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
