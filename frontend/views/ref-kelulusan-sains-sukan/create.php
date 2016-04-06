<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanSainsSukan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kelulusan_sains_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelulusan_sains_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-sains-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
