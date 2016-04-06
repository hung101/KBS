<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefMesyuaratAhliStatus */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::mesyuarat_ahli_status;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::mesyuarat_ahli_statuses, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-mesyuarat-ahli-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
