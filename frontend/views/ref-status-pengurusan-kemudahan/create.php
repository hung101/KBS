<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPengurusanKemudahan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-pengurusan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
