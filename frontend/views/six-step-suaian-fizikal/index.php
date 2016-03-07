<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SixStepSuaianFizikalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Six Steps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="six-step-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-suaian-fizikal']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-suaian-fizikal']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['six-step-suaian-fizikal']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Six Step', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'six_step_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'value' => 'atlet.name_penuh'
            ],
            //'stage',
            [
                'attribute' => 'stage',
                'value' => 'refSixstepSuaianFizikalStage.desc'
            ],
            //'status',
            [
                'attribute' => 'status',
                'value' => 'refSixstepSuaianFizikalStatus.desc'
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
