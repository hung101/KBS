<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanPenilaianJurulatihSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Penilaian Jurulatih';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-jurulatih-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pengurusan Penilaian Jurulatih', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_penilaian_jurulatih_id',
            //'pengurusan_pemantauan_dan_penilaian_jurulatih_id',
            'penilaian_oleh',
            'nama',
            'tarikh_dinilai',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
