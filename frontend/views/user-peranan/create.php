<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\UserPeranan */

$this->title = GeneralLabel::createTitle . ' User Peranan';
$this->params['breadcrumbs'][] = ['label' => 'Admin - User Peranan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-peranan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
