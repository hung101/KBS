<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JenisKebajikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jenis Kebajikan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-kebajikan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jenis-kebajikan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jenis-kebajikan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jenis-kebajikan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Jenis Kebajikan', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'jenis_kebajikan_id',
            //'jenis_kebajikan',
            [
                'attribute' => 'jenis_kebajikan',
                'value' => 'refJenisKebajikan.desc'
            ],
            'perkara',
            'sukan_sea_para_asean',
            'sukan_asia_komenwel_para_asia_ead',
            // 'sukan_olimpik_paralimpik',
            // 'kejohanan_asia_dunia',

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
