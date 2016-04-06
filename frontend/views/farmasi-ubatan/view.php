<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\FarmasiUbatan */

$this->title = $model->farmasi_ubatan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::farmasi_ubatans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="farmasi-ubatan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->farmasi_ubatan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->farmasi_ubatan_id], [
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
            'farmasi_ubatan_id',
            'farmasi_permohonan_ubatan_id',
            'nama_ubat',
            'size',
            'kuantiti',
            'harga',
        ],
    ]);*/ ?>

</div>
