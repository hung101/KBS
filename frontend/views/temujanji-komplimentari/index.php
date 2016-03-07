<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TemujanjiKomplimentariSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Temujanji Komplimentari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temujanji-komplimentari-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['temujanji-komplimentari']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['temujanji-komplimentari']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['temujanji-komplimentari']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Temujanji Komplimentari', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'temujanji_komplimentari_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'value' => 'refAtlet.name_penuh'
            ],
            //'perkhidmatan',
            [
                'attribute' => 'perkhidmatan',
                'value' => 'refPerkhidmatanKomplimentari.desc'
            ],
            'tarikh_khidmat',
            //'pegawai_yang_bertanggungjawab',
            [
                'attribute' => 'pegawai_yang_bertanggungjawab',
                'value' => 'refJuruUrut.desc'
            ],
            // 'status_temujanji',
            // 'catitan_ringkas',

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
