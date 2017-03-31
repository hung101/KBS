<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanProgramBinaanAtletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anugerah Ahli Jawatankuasa Pemilihan Item';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-ahli-jawantankuasa-pemilihan-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Anugerah Ahli Jawatankuasa Pemilihan Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'anugerah_ahli_jawantankuasa_pemilihan_id',
            'perwakilan',
            'nama',
            'jawatan',
            'session_id',
            'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
