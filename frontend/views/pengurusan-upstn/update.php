<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanUpstn */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pengurusan_upstn.': ' . ' ' . $model->pengurusan_upstn_id;
$this->title = GeneralLabel::updateTitle . ' USPTN';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_usptn, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' USPTN', 'url' => ['view', 'id' => $model->pengurusan_upstn_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-upstn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanUpstnAtlet' => $searchModelPengurusanUpstnAtlet,
        'dataProviderPengurusanUpstnAtlet' => $dataProviderPengurusanUpstnAtlet,
        'searchModelPengurusanUpstnJurulatih' => $searchModelPengurusanUpstnJurulatih,
        'dataProviderPengurusanUpstnJurulatih' => $dataProviderPengurusanUpstnJurulatih,
        'readonly' => $readonly,
    ]) ?>

</div>
