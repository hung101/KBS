<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihSukan */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::sukan_dan_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sukan_dan_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::sukan_dan_program, 'url' => ['view', 'id' => $model->jurulatih_sukan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelAcara' => $searchModelAcara,
        'dataProviderAcara' => $dataProviderAcara,
        'readonly' => $readonly,
    ]) ?>

</div>
