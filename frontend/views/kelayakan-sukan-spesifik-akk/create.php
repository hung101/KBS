<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KelayakanSukanSpesifikAkk */

$this->title = 'Tambah Kelayakan Sukan Spesifik AKK';
$this->params['breadcrumbs'][] = ['label' => 'Kelayakan Sukan Spesifik AKK', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelayakan-sukan-spesifik-akk-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
