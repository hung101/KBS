<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PemberianJusPemulihan */

$this->title = $model->pemberian_jus_pemulihan_id;
$this->params['breadcrumbs'][] = ['label' => 'Pemberian Jus Pemulihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemberian-jus-pemulihan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pemberian_jus_pemulihan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pemberian_jus_pemulihan_id], [
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
            'pemberian_jus_pemulihan_id',
            'perkhidmatan_permakanan_id',
            'kategori_atlet',
            'sukan',
            'acara',
            'atlet',
            'nama_jus',
            'jenis_jus',
            'kuantiti',
            'berat_badan',
            'buah',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
