<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PsikologiAktivitiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::aktiviti_psikologi;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psikologi-aktiviti-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-aktiviti']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-aktiviti']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['psikologi-aktiviti']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle .' ' . GeneralLabel::aktiviti_psikologi, ['create', 'psikologi_profil_id' => $psikologi_profil_id], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'psikologi_aktiviti_id',
            //'psikologi_profil_id',
            [
                'attribute' => 'nama_aktiviti',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_aktiviti,
                ]
            ],
            [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATETIME);
                },
            ],
            [
                'attribute' => 'tarikh_tamat',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_tamat,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATETIME);
                },
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
