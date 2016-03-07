<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TempahanKursusPersatuan */

$this->title = $model->tempahan_kursus_persatuan_id;
$this->params['breadcrumbs'][] = ['label' => 'Tempahan Kursus Persatuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kursus-persatuan-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->tempahan_kursus_persatuan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->tempahan_kursus_persatuan_id], [
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
            'tempahan_kursus_persatuan_id',
            'kursus_persatuan_id',
            'tarikh',
            'jenis_tempahan',
            'unit_tempahan',
            'kos_tempahan',
        ],
    ]);*/ ?>

</div>
