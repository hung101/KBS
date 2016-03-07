<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMaklumatPsk */

$this->title = GeneralLabel::createTitle .' Pengurusan Maklumat PSK';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Maklumat PSK', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-maklumat-psk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
