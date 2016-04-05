<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenjadualanUjianFisiologi */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::penjadualan_ujian_fisiologi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penjadualan_ujian_fisiologi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjadualan-ujian-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
