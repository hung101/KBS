<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNamaFisioterapi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::nama_fisioterapi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::nama_fisioterapi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-fisioterapi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
