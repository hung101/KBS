<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenjadualanUjianFisiologi */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::penjadualan_ujian_fisiologi.': ' . ' ' . $model->penjadualan_ujian_fisiologi_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::penjadualan_ujian_fisiologi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penjadualan_ujian_fisiologi, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::penjadualan_ujian_fisiologi, 'url' => ['view', 'id' => $model->penjadualan_ujian_fisiologi_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjadualan-ujian-fisiologi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
