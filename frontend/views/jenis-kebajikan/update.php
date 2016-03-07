<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JenisKebajikan */

//$this->title = GeneralLabel::updateTitle . ' Jenis Kebajikan: ' . ' ' . $model->jenis_kebajikan_id;
$this->title = GeneralLabel::updateTitle . ' Jenis Kebajikan';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Kebajikan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Jenis Kebajikan', 'url' => ['view', 'id' => $model->jenis_kebajikan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-kebajikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
