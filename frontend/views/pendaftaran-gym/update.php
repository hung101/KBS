<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranGym */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pendaftaran_gym.': ' . ' ' . $model->pendaftaran_gym_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::pendaftaran_gym;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pendaftaran_gym, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pendaftaran_gym, 'url' => ['view', 'id' => $model->pendaftaran_gym_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendaftaran-gym-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
