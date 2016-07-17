<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefKelulusanGeranBantuanGajiJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Kelulusan Geran Bantuan Gaji Jurulatihs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-geran-bantuan-gaji-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Kelulusan Geran Bantuan Gaji Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
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
