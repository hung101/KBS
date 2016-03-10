<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusMouMaoAntarabangsa */

$this->title = 'Update Ref Status Mou Mao Antarabangsa: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Mou Mao Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-mou-mao-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
