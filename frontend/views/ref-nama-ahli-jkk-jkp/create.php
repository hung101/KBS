<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNamaAhliJkkJkp */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::nama_ahli_jkk_jkp;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::nama_ahli_jkk_jkp, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-ahli-jkk-jkp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
