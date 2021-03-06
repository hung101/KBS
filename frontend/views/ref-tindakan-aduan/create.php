<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefTindakanAduan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tindakan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tindakan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tindakan-aduan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
