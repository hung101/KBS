<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSubProgramPelapisJurulatih */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::sub_program_pelapis_jurulatih.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sub_program_pelapis_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-sub-program-pelapis-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
