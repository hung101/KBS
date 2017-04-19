<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kelulusan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelulusan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
