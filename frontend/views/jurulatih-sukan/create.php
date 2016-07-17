<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihSukan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::sukan_dan_program;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sukan_dan_program, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelAcara' => $searchModelAcara,
        'dataProviderAcara' => $dataProviderAcara,
        'readonly' => $readonly,
    ]) ?>

</div>
