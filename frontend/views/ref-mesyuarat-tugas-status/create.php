<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefMesyuaratTugasStatus */

$this->title = GeneralLabel::createTitle.' '.'Ref Mesyuarat Tugas Status';
$this->params['breadcrumbs'][] = ['label' => 'Ref Mesyuarat Tugas Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-mesyuarat-tugas-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
