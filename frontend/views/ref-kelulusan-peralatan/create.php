<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanPeralatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kelulusan_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelulusan_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
