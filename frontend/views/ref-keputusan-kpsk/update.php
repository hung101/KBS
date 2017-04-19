<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefKeputusanKpsk */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::keputusan." KPSK".': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::keputusan." KPSK", 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-keputusan-kpsk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
