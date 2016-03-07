<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranGym */

//$this->title = 'Update Pendaftaran Gym: ' . ' ' . $model->pendaftaran_gym_id;
$this->title = GeneralLabel::updateTitle . ' Pendaftaran GYM';
$this->params['breadcrumbs'][] = ['label' => 'Pendaftaran GYM', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pendaftaran GYM', 'url' => ['view', 'id' => $model->pendaftaran_gym_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendaftaran-gym-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
