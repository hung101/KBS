<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianKategoriJurulatihKetua */

$this->title = $model->laporan_pemantauan_jurulatih_kategori_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_laporan_pemantauan_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-kategori-jurulatih-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->laporan_pemantauan_jurulatih_kategori_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->laporan_pemantauan_jurulatih_kategori_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_penilaian_kategori_jurulatih_id',
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id',
            'penilaian_kategori',
            'penilaian_sub_kategori',
            'markah_penilaian',
        ],
    ]);*/ ?>

</div>
