<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSekolahInstitusi */

$this->title = 'Update Ref Sekolah Institusi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sekolah Institusis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-sekolah-institusi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
