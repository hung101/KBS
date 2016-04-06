<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefMesyuaratAhliStatus */

$this->title = GeneralLabel::createTitle.' '.'Ref Mesyuarat Ahli Status';
$this->params['breadcrumbs'][] = ['label' => 'Ref Mesyuarat Ahli Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-mesyuarat-ahli-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
