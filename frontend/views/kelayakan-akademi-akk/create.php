<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KelayakanAkademiAkk */

$this->title = 'Tambah Kelayakan Akademi AKK';
$this->params['breadcrumbs'][] = ['label' => 'Kelayakan Akademi AKK', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelayakan-akademi-akk-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
