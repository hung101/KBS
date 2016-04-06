<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BiomekanikAnthropometricsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::biomekanik_anthropometric;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biomekanik-anthropometrics-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Biomekanik Anthropometrics', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'biomekanik_anthropometrics_id',
            //'perkhidmatan_analisa_perlawanan_biomekanik_id',
            [
                'attribute' => 'anthropometrics',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::anthropometrics,
                ]
            ],
            [
                'attribute' => 'cm_kg',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::cm_kg,
                ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
