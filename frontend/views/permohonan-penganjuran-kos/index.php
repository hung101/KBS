<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanPenganjuranKosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengurusan Perhimpunan/Kem Kos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-penganjuran-kos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pengurusan Perhimpunan/Kem Kos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pengurusan_perhimpunan_kem_kos_id',
            //'permohonan_perganjuran_id',
            [
                'attribute' => 'kategori_kos',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_kos,
                ]
            ],
            [
                'attribute' => 'anggaran_kos_per_kategori',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::anggaran_kos_per_kategori,
                ]
            ],
            [
                'attribute' => 'revised_kos_per_kategori',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::revised_kos_per_kategori,
                ]
            ],
            // 'approved_kos_per_kategori',
            // 'catatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
