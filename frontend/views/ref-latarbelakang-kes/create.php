<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLatarbelakangKes */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::latarbelakang_kes;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kes_latarbelakang, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-latarbelakang-kes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
