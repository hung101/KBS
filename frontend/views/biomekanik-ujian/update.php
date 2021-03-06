<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BiomekanikUjian */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::biomekanik_ujian.': ' . ' ' . $model->biomekanik_ujian_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::biomekanik_ujian, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->biomekanik_ujian_id, 'url' => ['view', 'id' => $model->biomekanik_ujian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="biomekanik-ujian-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
