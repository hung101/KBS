<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspTamatPengesahanPengajianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengesahan Tamat Pengajian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tamat-pengesahan-pengajian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle . ' Pengesahan Tamat Pengajian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_tamat_pengesahan_pengajian_id',
            'nama_ipts',
            //'pengajian',
            [
                'attribute' => 'pengajian',
                'value' => 'refPengajianEBiasiswa.desc'
            ],
            'bidang',
            //'cgpa_pngk',
            // 'tarikh_tamat',

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
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

</div>
