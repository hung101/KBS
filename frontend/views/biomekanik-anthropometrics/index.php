<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BiomekanikAnthropometricsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Biomekanik Anthropometric';
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
            'anthropometrics',
            'cm_kg',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
