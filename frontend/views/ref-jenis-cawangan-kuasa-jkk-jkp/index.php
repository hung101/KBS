<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefJenisCawanganKuasaJkkJkpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Jenis Cawangan Kuasa Jkk Jkps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-cawangan-kuasa-jkk-jkp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Jenis Cawangan Kuasa Jkk Jkp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'desc',
            'aktif',
            'created_by',
            'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
