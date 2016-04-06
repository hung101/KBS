<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Kursus */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::kursus.': ' . ' ' . $model->kursus_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::cce;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akademi_kejurulatihan_kebangsaan_akk, 'url' => ['akademi-akk/index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::cce, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::cce, 'url' => ['view', 'id' => $model->kursus_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kursus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
