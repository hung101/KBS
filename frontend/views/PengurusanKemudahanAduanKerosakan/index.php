<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanKemudahanAduanKerosakanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Kemudahan Aduan Kerosakan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-kerosakan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pengurusan Kemudahan Aduan Kerosakan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_kemudahan_aduan_kerosakan_id',
            //'pengurusan_kemudahan_aduan_id',
            'jenis_kerosakan',
            'lokasi_kerosakan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
