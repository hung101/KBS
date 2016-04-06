<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanEBiasiswa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_permohonan_ebiasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_permohonan_ebiasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
