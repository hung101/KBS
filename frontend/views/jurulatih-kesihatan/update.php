<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihKesihatan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::jurulatih_kesihatan.': ' . ' ' . $model->jurulatih_kesihatan_id;
$this->title = GeneralLabel::updateTitle . ' Maklumat Kesihatan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_kesihatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Maklumat Kesihatan', 'url' => ['view', 'id' => $model->jurulatih_kesihatan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-kesihatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelMasalah' => $searchModelMasalah,
        'dataProviderMasalah' => $dataProviderMasalah,
        'readonly' => $readonly,
    ]) ?>

</div>
