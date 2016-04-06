<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenyelidikanKomposisiPasukan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::penyelidikan_komposisi_pasukan.': ' . ' ' . $model->penyelidikan_komposisi_pasukan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyelidikan_komposisi_pasukan, 'url' => ['index']];
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
