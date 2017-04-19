<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefProgramMsn */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::program." MSN";
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::program." MSN", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-msn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
