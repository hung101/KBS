<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefStatusJurulatihAkkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::status_jurulatih_akk;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-jurulatih-akk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::create.' '.GeneralLabel::status_jurulatih_akk, ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::id,
                ]
            ],
            [
                'attribute' => 'desc',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::desc,
                ]
            ],
            [
                'attribute' => 'aktif',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::aktif,
                ]
            ],
            [
                'attribute' => 'created_by',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::created_by,
                ]
            ],
            [
                'attribute' => 'updated_by',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::updated_by,
                ]
            ],
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
