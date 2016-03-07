<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanMouMoaAntarabangsaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan MOU - MOA Antarabangsa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-mou-moa-antarabangsa-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-mou-moa-antarabangsa']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-mou-moa-antarabangsa']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-mou-moa-antarabangsa']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Pengurusan MOU - MOA Antarabangsa', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_mou_moa_antarabangsa_id',
            //'nama_negara_terlibat',
            [
                'attribute' => 'nama_negara_terlibat',
                'value' => 'refNegara.desc'
            ],
            //'agensi',
            [
                'attribute' => 'agensi',
                'value' => 'refAgensiAntarabangsa.desc'
            ],
            //'asas_asas_pertimbangan',
            'jangka_waktu_mula',
             'jangka_waktu_tamat',
            // 'status',
            // 'tajuk_mou_moa',
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
