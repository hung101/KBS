<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKehadiranMedia */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kehadiran_media;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kehadiran_media, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kehadiran-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
