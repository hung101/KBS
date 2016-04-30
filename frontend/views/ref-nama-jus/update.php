<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefNamaJus */

$this->title = 'Update Ref Nama Jus: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Juses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-nama-jus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
