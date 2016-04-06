<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPenajaansokongan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_penajaansokongan.': ' . ' ' . $model->penajaan_sokongan_id;
$this->title = GeneralLabel::penajaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_penajaansokongans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penajaan_sokongan_id, 'url' => ['view', 'id' => $model->penajaan_sokongan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-penajaansokongan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
