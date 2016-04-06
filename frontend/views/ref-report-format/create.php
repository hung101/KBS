<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefReportFormat */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::report_format;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::report_format, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-report-format-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
