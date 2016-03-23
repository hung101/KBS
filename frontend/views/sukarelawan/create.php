<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Sukarelawan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::sukarelawan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sukarelawan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
