<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKadarKemudahan */

$this->title = 'Update Ref Jenis Kadar Kemudahan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kadar Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jenis-kadar-kemudahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
