<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanAcara */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::program;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pelan, 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->perancangan_program_id, 'url' => ['view', 'id' => $model->perancangan_program_id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penyertaan-sukan-acara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_jkk', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
