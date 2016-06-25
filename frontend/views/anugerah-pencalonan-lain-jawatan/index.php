<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AnugerahPencalonanLainJawatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anugerah Pencalonan Lain Jawatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-lain-jawatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Anugerah Pencalonan Lain Jawatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'anugerah_pencalonan_lain_jawatan_id',
            'anugerah_pencalonan_lain_id',
            'jawatan',
            'nama_persatuan_pertubuhan',
            'tempoh',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
