<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElaunJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Elaun Jurulatih';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaun-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Elaun Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'elaun_jurulatih_id',
            //'gaji_dan_elaun_jurulatih_id',
            'jenis_elaun',
            'jumlah_elaun',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
