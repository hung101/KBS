<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PerkhidmatanPermakananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::perkhidmatan_permakanan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perkhidmatan-permakanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::createTitle .' '.GeneralLabel::perkhidmatan_permakanan_without_sukan, ['create', 'permohonan_perkhidmatan_permakanan_id' => ''], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'perkhidmatan_permakanan_id',
            //'permohonan_perkhidmatan_permakanan_id',
            [
                'attribute' => 'tarikh',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh,
                ],'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh, GeneralFunction::TYPE_DATE);
                },
            ],
            [
                'attribute' => 'pegawai_yang_bertanggungjawab',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::pegawai_yang_bertanggungjawab,
                ]
            ],
            //'catitan_ringkas',

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
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>

</div>
