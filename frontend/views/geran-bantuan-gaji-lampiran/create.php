<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsuranLampiran */

$this->title = 'Create Pengurusan Insuran Lampiran';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Insuran Lampirans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insuran-lampiran-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
