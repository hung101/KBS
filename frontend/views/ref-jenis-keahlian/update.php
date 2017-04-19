<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKeahlian */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::jenis_keahlian.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_keahlian, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-jenis-keahlian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
