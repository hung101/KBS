<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InventoriPeralatan */

$this->title = $model->inventori_peralatan_id;
$this->params['breadcrumbs'][] = ['label' => 'Inventori Peralatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventori-peralatan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->inventori_peralatan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->inventori_peralatan_id], [
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
            'inventori_peralatan_id',
            'inventori_id',
            'nama_peralatan',
            'no_inv_do',
            'kuantiti',
            'harga_per_unit',
            'jumlah',
            'session_id',
            'created_by',
            'updated_by',
            'created',
            'updated',
        ],
    ]);*/ ?>

</div>
