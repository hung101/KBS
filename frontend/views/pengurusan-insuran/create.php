<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsuran */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_insurans;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_insurans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
