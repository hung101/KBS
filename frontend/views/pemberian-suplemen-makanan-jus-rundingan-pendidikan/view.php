<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PemberianSuplemenMakananJusRundinganPendidikan */

$this->title = $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id;
$this->params['breadcrumbs'][] = ['label' => 'Pemberian Suplemen Makanan Jus Rundingan Pendidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemberian-suplemen-makanan-jus-rundingan-pendidikan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id], [
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
            'pemberian_suplemen_makanan_jus_rundingan_pendidikan_id',
            'perkhidmatan_permakanan_id',
            'nama_suplemen_makanan_jus_rundingan_pendidikan',
            'kuantiti_ml_g',
            'harga',
        ],
    ]);*/ ?>

</div>
