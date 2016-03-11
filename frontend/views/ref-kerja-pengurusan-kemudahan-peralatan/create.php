<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKerjaPengurusanKemudahanPeralatan */

$this->title = 'Create Ref Kerja Pengurusan Kemudahan Peralatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kerja Pengurusan Kemudahan Peralatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kerja-pengurusan-kemudahan-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
