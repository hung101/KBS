<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanProjekInovasi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_permohonan_projek_inovasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_permohonan_projek_inovasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-projek-inovasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
