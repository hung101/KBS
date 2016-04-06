<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusHaidDataKlinikal */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_haid_data_klinikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_haid_data_klinikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-haid-data-klinikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
