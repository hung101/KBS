<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPerokokDataKlinikal */

$this->title = 'Update Ref Status Perokok Data Klinikal: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Perokok Data Klinikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-perokok-data-klinikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
