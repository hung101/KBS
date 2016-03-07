<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SoalSelidikSebelumUjianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Soal Selidik Sebelum Ujian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-selidik-sebelum-ujian-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['soal-selidik-sebelum-ujian']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['soal-selidik-sebelum-ujian']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['soal-selidik-sebelum-ujian']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Soal Selidik Sebelum Ujian', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'soal_selidik_sebelum_ujian_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'value' => 'refAtlet.name_penuh'
            ],
            'tarikh',
            //'soalan',
            [
                'attribute' => 'soalan',
                'value' => 'refSoalanSoalSelidik.desc'
            ],
            //'jawapan',
            [
                'attribute' => 'jawapan',
                'value' => 'refJawapanSoalSelidik.desc'
            ],

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
