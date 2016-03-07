<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenjadualanUjianFisiologi */

$this->title = GeneralLabel::createTitle . ' Penjadualan Ujian Fisiologi';
$this->params['breadcrumbs'][] = ['label' => 'Penjadualan Ujian Fisiologi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjadualan-ujian-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
