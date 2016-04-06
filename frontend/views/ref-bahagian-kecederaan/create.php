<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianKecederaan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bahagian_kecederaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bahagian_kecederaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-kecederaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
