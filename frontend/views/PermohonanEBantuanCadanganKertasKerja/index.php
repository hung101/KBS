<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanCadanganKertasKerjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan e-Bantuan Cadangan Kertas Kerja';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-cadangan-kertas-kerja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Permohonan e-Bantuan Cadangan Kertas Kerja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'permohonan_e_bantuan_cadangan_kertas_kerja_id',
            //'permohonan_e_bantuan_id',
            'nama_cadangan_kertas_kerja',
            //'muat_naik',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
