<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanKemudahanSediaAdaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Kemudahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-sedia-ada-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['update']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-sedia-ada']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['delete']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-sedia-ada']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-sedia-ada']['create']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-sedia-ada']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Pengurusan Kemudahan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_kemudahan_sedia_ada_id',
            //'pengurusan_kemudahan_venue_id',
            [
                'attribute' => 'pengurusan_kemudahan_venue_id',
                'value' => 'refPengurusanVenue.nama_venue'
            ],
            //'nama_kemudahan',
            'keluasan_padang',
            'jumlah_kapasiti',
            'size',
            //'bilangan_kekerapan_penyenggaran',
            // 'kekerapan_penggunaan',
            // 'kekerapan_kerosakan_berlaku',
            // 'cost_pembaikian',

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
