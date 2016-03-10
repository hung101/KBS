<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanBantuanPentadbiranPejabat */

$this->title = 'Create Ref Status Permohonan Bantuan Pentadbiran Pejabat';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Bantuan Pentadbiran Pejabats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-bantuan-pentadbiran-pejabat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
