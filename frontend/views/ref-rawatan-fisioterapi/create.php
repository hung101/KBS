<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRawatanFisioterapi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::rawatan_fisioterapi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::rawatan_fisioterapi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rawatan-fisioterapi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
