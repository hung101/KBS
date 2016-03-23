<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\UserPeranan */

//$this->title = 'Update User Peranan: ' . ' ' . $model->user_peranan_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::user_peranan;
$this->params['breadcrumbs'][] = ['label' => 'Admin - User Peranan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::user_peranan, 'url' => ['view', 'id' => $model->user_peranan_id]];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="user-peranan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
