<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TempahanKemudahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::tempahan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kemudahan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['tempahan-kemudahan']['update']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['tempahan-kemudahan']['delete']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['tempahan-kemudahan']['create']) || isset(Yii::$app->user->identity->peranan_akses['KBS']['tempahan-kemudahan']['create'])): ?>
        <p>
            <?= Html::a('Tempahan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'tempahan_kemudahan_id',
            'nama',
            //'no_kad_pengenalan',
            //'location_alamat_1',
            //'venue',
            [
                'attribute' => 'venue',
                'value' => 'refPengurusanKemudahanVenue.nama_venue'
            ],
            //'tarikh_mula',
            [
                'attribute' => 'tarikh_mula',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATETIME);
                },
            ],
            [
                'attribute' => 'jenis_kadar',
                'value' => 'refJenisKadarKemudahan.desc'
            ],
            'quantity_kadar',
            'bayaran_sewa',
            [
                'attribute' => 'status',
                'value' => 'refStatusTempahanKemudahan.desc'
            ],
            //'tarikh_akhir',
            // 'catatan',

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
