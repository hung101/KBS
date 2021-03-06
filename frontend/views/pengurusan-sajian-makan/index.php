<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanSajianMakanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::pengurusan_sajian_makan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-sajian-makan-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-sajian-makan']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-sajian-makan']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-sajian-makan']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_sajian_makan, ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a(GeneralLabel::laporan_jadual_waktu_sajian_makanan_atlet, ['laporan-jadual-waktu-sajian-makanan-atlet'], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_sajian_makan_id',
            //'atlet_id',
            [
                'attribute' => 'atlet_id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet_id,
                ],
                //'value' => 'refAtlet.name_penuh'
            ],
            [
                'attribute' => 'tarikh_mula',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_mula,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);
                },
            ],
            [
                'attribute' => 'tarikh_akhir',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_akhir,
                ],
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_akhir, GeneralFunction::TYPE_DATE);
                },
            ],
            //'bilangan_tempahan_makan',

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
