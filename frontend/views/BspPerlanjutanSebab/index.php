<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BspPerlanjutanSebabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sebab Pelanjutan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-sebab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Sebab Pelanjutan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_perlanjutan_sebab_id',
            //'bsp_perlanjutan_id',
            'sebab',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
