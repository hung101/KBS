<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BiomekanikAnthropometrics */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::biomekanik_anthropometrics.': ' . ' ' . $model->biomekanik_anthropometrics_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::biomekanik_anthropometrics, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->biomekanik_anthropometrics_id, 'url' => ['view', 'id' => $model->biomekanik_anthropometrics_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="biomekanik-anthropometrics-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
