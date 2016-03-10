<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefProgramSemasaSukanAtlet */

$this->title = 'Update Ref Program Semasa Sukan Atlet: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Program Semasa Sukan Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-program-semasa-sukan-atlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
