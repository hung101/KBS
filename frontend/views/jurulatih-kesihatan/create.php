<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihKesihatan */

$this->title = GeneralLabel::createTitle . ' '. GeneralLabel::maklumat_kesihatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_kesihatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-kesihatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelMasalah' => $searchModelMasalah,
        'dataProviderMasalah' => $dataProviderMasalah,
        'readonly' => $readonly,
    ]) ?>

</div>
