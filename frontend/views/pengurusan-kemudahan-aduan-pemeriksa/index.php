<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanKemudahanAduanPemeriksaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-pemeriksa-pemeriksa-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['update']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-aduan-pemeriksa']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['delete']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-aduan-pemeriksa']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-kemudahan-aduan-pemeriksa']['create']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['pengurusan-kemudahan-aduan-pemeriksa']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle .' ' . GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_kemudahan_aduan_id',
            
            //'kategori_aduan',
            [
                'attribute' => 'kategori_aduan',
                'value' => 'refKategoriAduanKemudahan.desc'
            ],
            //'pengurusan_kemudahan_venue_id',
            [
                'attribute' => 'pengurusan_kemudahan_venue_id',
                'value' => 'refPengurusanVenue.nama_venue'
            ],
            //'venue',
            //'peralatan',
            [
                'attribute' => 'peralatan',
                'value' => 'refPeralatanKemudahan.desc'
            ],
             'tarikh_aduan',
            // 'nama_pengadu',
            // 'kenyataan_aduan',
            // 'tindakan_ulasan',

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
