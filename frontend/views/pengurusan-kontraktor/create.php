<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKontraktor */

$this->title = GeneralLabel::createTitle . ' Pengurusan Kontraktor';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kontraktor, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kontraktor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
