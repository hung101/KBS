<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KelayakanAkademiAkkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelayakan Akademi AKK';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelayakan-akademi-akk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Kelayakan Akademi AKK', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'kelayakan_akademi_akk_id',
            //'akademi_akk_id',
            'nama_peperiksaan',
            'tahun',
            'keputusan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
