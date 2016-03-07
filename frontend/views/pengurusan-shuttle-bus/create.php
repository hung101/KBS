<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanShuttleBus */

$this->title = GeneralLabel::createTitle . ' Pengurusan Pengangkutan';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Pengangkutan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-shuttle-bus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
