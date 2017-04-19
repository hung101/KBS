<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanInsuran */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_permohonan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_permohonan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-insuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
