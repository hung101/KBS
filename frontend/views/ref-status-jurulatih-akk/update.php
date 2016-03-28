<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusJurulatihAkk */

$this->title = 'Update Ref Status Jurulatih Akk: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Jurulatih Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-jurulatih-akk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
