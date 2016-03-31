<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenjadualanUjianFisiologiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penjadualan Ujian Fisiologi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjadualan-ujian-fisiologi-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penjadualan-ujian-fisiologi']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penjadualan-ujian-fisiologi']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['penjadualan-ujian-fisiologi']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Penjadualan Ujian Fisiologi', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'penjadualan_ujian_fisiologi_id',
            //'atlet_id',
            /*[
                'attribute' => 'atlet_id',
                'value' => 'refAtlet.name_penuh'
            ],*/
            [
                'attribute' => 'perkhidmatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::perkhidmatan,
                ]
            ],
            //'tarikh_masa',
            [
                'attribute' => 'tarikh_masa',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_masa,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_masa, GeneralFunction::TYPE_DATETIME);
                },
            ],
            [
                'attribute' => 'pegawai_yang_bertanggungjawab',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pegawai_yang_bertanggungjawab,
                ]
            ],
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
