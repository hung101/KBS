<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPemohonJaringanAntarabangsa */

$this->title = 'Update Ref Pemohon Jaringan Antarabangsa: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Pemohon Jaringan Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-pemohon-jaringan-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
