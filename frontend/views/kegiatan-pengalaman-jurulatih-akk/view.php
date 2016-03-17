<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\KegiatanPengalamanJurulatihAkk */

$this->title = $model->kegiatan_pengalaman_jurulatih_akk_id;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Pengalaman Jurulatih Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-pengalaman-jurulatih-akk-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kegiatan_pengalaman_jurulatih_akk_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kegiatan_pengalaman_jurulatih_akk_id], [
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
            'kegiatan_pengalaman_jurulatih_akk_id',
            'akademi_akk_id',
            'nama_sukan_pertandingan',
            'tahun',
            'peranan',
            'persatuan_sukan',
        ],
    ]);*/ ?>

</div>
