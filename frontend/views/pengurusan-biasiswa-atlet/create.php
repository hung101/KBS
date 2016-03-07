<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanBiasiswaAtlet */

$this->title = GeneralLabel::createTitle . ' Pengurusan Biasiswa Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Biasiswa Atlet', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-biasiswa-atlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
