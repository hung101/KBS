<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefUniversitiInstitusiEBiasiswa */

$this->title = 'Update Ref Universiti Institusi Ebiasiswa: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Universiti Institusi Ebiasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-universiti-institusi-ebiasiswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
