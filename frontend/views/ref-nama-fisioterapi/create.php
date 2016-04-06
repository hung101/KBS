<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNamaFisioterapi */

$this->title = GeneralLabel::createTitle.' '.'Ref Nama Fisioterapi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Fisioterapis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-fisioterapi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
