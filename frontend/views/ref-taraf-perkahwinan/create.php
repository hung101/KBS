<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTarafPerkahwinan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::taraf_perkahwinan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::taraf_perkahwinan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-taraf-perkahwinan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
