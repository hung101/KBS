<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenyelidikanKomposisiPasukan */

$this->title = 'Update Penyelidikan Komposisi Pasukan: ' . ' ' . $model->penyelidikan_komposisi_pasukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Penyelidikan Komposisi Pasukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penyelidikan_komposisi_pasukan_id, 'url' => ['view', 'id' => $model->penyelidikan_komposisi_pasukan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penyelidikan-komposisi-pasukan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
