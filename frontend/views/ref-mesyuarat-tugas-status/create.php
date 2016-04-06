<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefMesyuaratTugasStatus */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::mesyuarat_tugas_status;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::mesyuarat_tugas_statuses, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-mesyuarat-tugas-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
