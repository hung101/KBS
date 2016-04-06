<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKumpulanDarah */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kumpulan_darah;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kumpulan_darah, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kumpulan-darah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
