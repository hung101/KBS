<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RehabilitasiProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rehabilitasi Program';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rehabilitasi-program-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Rehabilitasi Program', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'rehabilitasi_program_id',
            //'rehabilitasi_id',
            'tarikh',
            'nama_exercise_modality',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
