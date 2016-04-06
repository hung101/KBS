<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJuruUrut */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::juru_urut;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::juru_urut, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-juru-urut-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
