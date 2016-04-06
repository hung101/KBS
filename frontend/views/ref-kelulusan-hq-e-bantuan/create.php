<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanHqEBantuan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kelulusan_hq_ebantuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelulusan_hq_ebantuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-hq-ebantuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
