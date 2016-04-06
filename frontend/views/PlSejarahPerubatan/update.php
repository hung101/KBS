<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PlSejarahPerubatan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pl_sejarah_perubatan.': ' . ' ' . $model->pl_sejarah_perubatan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pl_sejarah_perubatans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pl_sejarah_perubatan_id, 'url' => ['view', 'id' => $model->pl_sejarah_perubatan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pl-sejarah-perubatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
