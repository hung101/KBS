<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenilaianPestasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penilaian Pestasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-pestasi-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['penilaian-pestasi']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Penilaian Pestasi', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penilaian_pestasi_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'value' => 'atlet.name_penuh'
            ],
            'tahap_sihat',
            'pencapaian_sukan_dalam_tahun_yang_dinilai',
            'kecederaan_jika_ada',
            // 'laporan_kesihatan',
            // 'elaun_yang_diterima',
            // 'skim_hadiah_kemenangan_sukan',

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
