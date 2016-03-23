<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\UjianSaringan */

//$this->title = 'Update Maklumat Bakat: ' . ' ' . $model->ujian_saringan_id;
$this->title = GeneralLabel::updateTitle . ' Maklumat Bakat';
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Bakat', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Maklumat Bakat', 'url' => ['view', 'id' => $model->ujian_saringan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ujian-saringan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
