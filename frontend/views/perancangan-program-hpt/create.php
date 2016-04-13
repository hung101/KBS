<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PerancanganProgramHpt */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::perancangan_program_hpt;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perancangan-program-hpt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
