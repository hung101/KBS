<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPerokokDataKlinikal */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_perokok_data_klinikal;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_perokok_data_klinikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-perokok-data-klinikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
