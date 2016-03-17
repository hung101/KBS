<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SoalanPenilaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Soalan Penilaian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soalan-penilaian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Soalan Penilaian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'soalan_penilaian_id',
            //'borang_penilaian_id',
            'bahagian',
            'soalan',
            'jawapan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
