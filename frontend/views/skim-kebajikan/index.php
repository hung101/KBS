<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SkimKebajikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Skim Kebajikan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skim-kebajikan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['skim-kebajikan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['skim-kebajikan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['skim-kebajikan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Skim Kebajikan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'skim_kebajikan_id',
            //'jenis_bantuan_skak',
            [
                'attribute' => 'jenis_bantuan_skak',
                'value' => 'refJenisBantuanSKAK.desc'
            ],
            'jumlah_bantuan',
            //'nama_pemohon',
            [
                'attribute' => 'nama_pemohon',
                'value' => 'atlet.name_penuh'
            ],
            'nama_penerima',
            //'jenis_sukan',
            [
                'attribute' => 'jenis_sukan',
                'value' => 'refSukan.desc'
            ],
            // 'masalah_dihadapi',
            // 'tarikh_kejadian',
            // 'lokasi_kejadian',
            // 'jenis_bantuan_lain_yang_diterima',
            // 'kelulusan',

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
