<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelayakanPingat */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kelayakan_pingat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelayakan_pingat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelayakan-pingat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
