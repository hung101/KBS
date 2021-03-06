<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GajiJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gaji Jurulatihs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaji-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Gaji Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'gaji_jurulatih_id',
            'gaji_dan_elaun_jurulatih_id',
            'jumlah',
            'tarikh_mula',
            'tarikh_tamat',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
