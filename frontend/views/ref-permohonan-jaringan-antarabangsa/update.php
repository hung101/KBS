<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPermohonanJaringanAntarabangsa */

$this->title = 'Update Ref Permohonan Jaringan Antarabangsa: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Permohonan Jaringan Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-permohonan-jaringan-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
