<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefUjianStatusBiomekanik */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::ujian_status_biomekanik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::ujian_status_biomekanik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-ujian-status-biomekanik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
