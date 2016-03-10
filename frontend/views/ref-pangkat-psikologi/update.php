<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPangkatPsikologi */

$this->title = 'Update Ref Pangkat Psikologi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Pangkat Psikologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-pangkat-psikologi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
