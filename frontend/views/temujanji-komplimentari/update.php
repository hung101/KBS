<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\TemujanjiKomplimentari */

//$this->title = 'Update Temujanji Komplimentari: ' . ' ' . $model->temujanji_komplimentari_id;
$this->title = GeneralLabel::updateTitle . ' Temujanji Komplimentari';
$this->params['breadcrumbs'][] = ['label' => 'Temujanji Komplimentari', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Temujanji Komplimentari', 'url' => ['view', 'id' => $model->temujanji_komplimentari_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temujanji-komplimentari-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
