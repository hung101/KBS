<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratSenaraiTugas */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::mesyuarat_senarai_tugas.': ' . ' ' . $model->senarai_tugas_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::mesyuarat_senarai_tugas, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_tugas_id, 'url' => ['view', 'id' => $model->senarai_tugas_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mesyuarat-senarai-tugas-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
