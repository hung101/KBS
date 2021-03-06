<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PendaftaranGym */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pendaftaran_gym;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pendaftaran_gym, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendaftaran-gym-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
