<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanJurulatih */

$this->title = 'Update Anugerah Pencalonan Jurulatih: ' . $model->anugerah_pencalonan_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Pencalonan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anugerah_pencalonan_jurulatih_id, 'url' => ['view', 'id' => $model->anugerah_pencalonan_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anugerah-pencalonan-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
