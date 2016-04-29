<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLokasiKomplimentari */

$this->title = 'Create Ref Lokasi Komplimentari';
$this->params['breadcrumbs'][] = ['label' => 'Ref Lokasi Komplimentaris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lokasi-komplimentari-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
