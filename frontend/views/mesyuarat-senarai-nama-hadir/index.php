<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MesyuaratSenaraiNamaHadirSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Nama Ahli';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-senarai-nama-hadir-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Senarai Nama Ahli', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_nama_hadir_id',
            //'mesyuarat_id',
            'nama',
            'kehadiran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
