<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJuruUrut */

$this->title = 'Update Ref Juru Urut: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Juru Uruts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-juru-urut-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
