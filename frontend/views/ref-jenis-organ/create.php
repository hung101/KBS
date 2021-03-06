<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisOrgan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_organ;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_organ, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-organ-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
