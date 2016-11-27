<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihPendidikan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::jurulatih_pendidikan.': ' . ' ' . $model->jurulatih_pendidikan_id;
$this->title = GeneralLabel::updateTitle . ' '.GeneralLabel::pendidikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pendidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '.GeneralLabel::pendidikan, 'url' => ['view', 'id' => $model->jurulatih_pendidikan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-pendidikan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
