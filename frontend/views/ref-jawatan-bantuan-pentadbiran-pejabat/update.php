<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanBantuanPentadbiranPejabat */

$this->title = 'Update Ref Jawatan Bantuan Pentadbiran Pejabat: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Bantuan Pentadbiran Pejabats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jawatan-bantuan-pentadbiran-pejabat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
