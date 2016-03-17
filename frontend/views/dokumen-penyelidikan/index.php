<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DokumenPenyelidikanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dokumen Penyelidikan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dokumen-penyelidikan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Dokumen Penyelidikan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'dokumen_penyelidikan_id',
            //'permohonana_penyelidikan_id',
            'nama_dokumen',
            'muat_naik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
