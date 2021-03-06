<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanAkademi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kelulusan_akademi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelulusan_akademis, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-akademi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
