<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Kursus */

//$this->title = 'Update Kursus: ' . ' ' . $model->kursus_id;
$this->title = GeneralLabel::updateTitle . ' CCE';
$this->params['breadcrumbs'][] = ['label' => 'Akademi Kejurulatihan Kebangsaan (AKK)', 'url' => ['akademi-akk/index']];
$this->params['breadcrumbs'][] = ['label' => 'CCE', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' CCE', 'url' => ['view', 'id' => $model->kursus_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kursus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
