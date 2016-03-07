<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenyertaanSukanAduanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aduan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-aduan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan-aduan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan-aduan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penyertaan-sukan-aduan']['create'])): ?>
        <p>
            <?= Html::a('Penambahan Aduan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penyertaan_sukan_aduan_id',
            'nama_pengadu',
            'tarikh_aduan',
            //'status_aduan',
            [
                'attribute' => 'status_aduan',
                'value' => 'refStatusAduanPenyertaanSukan.desc'
            ],
            //'aduan_kategori',
            [
                'attribute' => 'aduan_kategori',
                'value' => 'refKategoriAduanPenyertaanSukan.desc'
            ],
            // 'penyataan_aduan',

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
