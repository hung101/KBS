<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiMedia */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::agensi_media.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::agensi_media, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-agensi-media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
