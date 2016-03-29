<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlTemujanjiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::temujanji_makmal_perubatan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-makmal-perubatan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-makmal-perubatan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-makmal-perubatan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-makmal-perubatan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::temujanji_makmal_perubatan, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pl_temujanji_id',
            //'atlet_id',
            //'tarikh_temujanji',
            [
                'attribute' => 'tarikh_temujanji',
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);
                },
            ],
            //'doktor_pegawai_perubatan',
            //'makmal_perubatan',
            //'status_temujanji',
            [
                'attribute' => 'status_temujanji',
                'value' => 'refStatusTemujanjiPesakitLuar.desc'
            ],
            // 'pegawai_yang_bertanggungjawab',
            [
                'attribute' => 'pegawai_yang_bertanggungjawab',
                'value' => 'refPegawaiPerubatan.desc'
            ],
            // 'catitan_ringkas',
            'catatan_tambahan',

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
