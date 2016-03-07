<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranPemantuan */

$this->title = 'Pengamjuran Pemantuan';
$this->params['breadcrumbs'][] = ['label' => 'Pengamjuran Pemantuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-pemantuan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
