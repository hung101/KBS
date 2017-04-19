<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanInsentif */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kelulusan_insentif;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelulusan_insentif, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-insentif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
