<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefRawatanFisioterapi */

$this->title = 'Update Ref Rawatan Fisioterapi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Rawatan Fisioterapis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-rawatan-fisioterapi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
