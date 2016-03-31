<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlTemujanjiFisioterapiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::temujanji_fisioterapi;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-temujanji-fisioterapi-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-fisioterapi']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-fisioterapi']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['pl-temujanji-fisioterapi']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::temujanji_fisioterapi, ['create'], ['class' => 'btn btn-success']) ?>
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
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_temujanji,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);
                },
            ],
            //'doktor_pegawai_perubatan',
            //'makmal_perubatan',
            //'status_temujanji',
            [
                'attribute' => 'nama_fisioterapi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_fisioterapi,
                ],
                'value' => 'refNamaFisioterapi.desc'
            ],
            [
                'attribute' => 'status_temujanji',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_temujanji,
                ],
                'value' => 'refStatusTemujanjiPesakitLuar.desc'
            ],
            // 'pegawai_yang_bertanggungjawab',
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
