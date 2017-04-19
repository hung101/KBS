<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPusatLatihan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_pusat_latihan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_pusat_latihan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-pusat-latihan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
