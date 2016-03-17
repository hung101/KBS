<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PengurusanSoalanPenilaianPendidikanPenganjurSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Soalan Penilaian Pendidikan Penganjur/Instructor';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-soalan-penilaian-pendidikan-penganjur-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pengurusan Soalan Penilaian Pendidikan Penganjur/Instructor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_soalan_penilaian_pendidikan_penganjur_id',
            //'pengurusan_penilaian_pendidikan_penganjur_intructor_id',
            'soalan',
            'rating',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
