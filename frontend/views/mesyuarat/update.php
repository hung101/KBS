<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Mesyuarat */

//$this->title = 'Update Mesyuarat: ' . ' ' . $model->mesyuarat_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::mesyuarat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::mesyuarat, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::mesyuarat, 'url' => ['view', 'id' => $model->mesyuarat_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'SNHsearchModel' => $SNHsearchModel,
        'SNHdataProvider' => $SNHdataProvider,
        'STsearchModel' => $STsearchModel,
        'STdataProvider' => $STdataProvider,
    ]) ?>

</div>
