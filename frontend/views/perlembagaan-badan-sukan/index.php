<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PerlembagaanBadanSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perlembagaan Badan Sukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perlembagaan-badan-sukan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['perlembagaan-badan-sukan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['PJS']['perlembagaan-badan-sukan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['perlembagaan-badan-sukan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' Perlembagaan Badan Sukan', Url::to(['create', 'profil_badan_sukan_id' => $profil_badan_sukan_id]), ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'perlembagaan_badan_sukan_id',
            //'tarikh_kelulusan_Terkini',
            //'bilangan_pindaan_perlembagaan_dilakukan',
            //'tarikh_pindaan',
            //'tarikh_kelulusan',
            [
                'attribute' => 'tarikh_kelulusan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_kelulusan,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_kelulusan);
                },
            ],
            // 'muat_naik',

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
