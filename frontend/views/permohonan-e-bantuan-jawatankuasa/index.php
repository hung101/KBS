<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanJawatankuasaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jawatankuasa Kerja Yang Terkini';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-jawatankuasa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Jawatankuasa Kerja Yang Terkini', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'jawatankuasa_id',
            //'permohonan_e_bantuan_id',
            'jawatan',
            'nama',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
