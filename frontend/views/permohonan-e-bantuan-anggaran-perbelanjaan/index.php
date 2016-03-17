<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanAnggaranPerbelanjaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anggaran Perbelanjaan Program / Aktiviti Yang Dipohon';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-anggaran-perbelanjaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Anggaran Perbelanjaan Program / Aktiviti Yang Dipohon', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'anggaran_perbelanjaan_id',
            //'permohonan_e_bantuan_id',
            'butir_butir_perbelanjaan',
            'jumlah_perbelanjaan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
