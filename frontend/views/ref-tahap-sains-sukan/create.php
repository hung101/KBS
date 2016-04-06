<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapSainsSukan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tahap_sains_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tahap_sains_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-sains-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
