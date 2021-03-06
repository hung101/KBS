<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusMouMaoAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_mou_mao_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_mou_mao_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-mou-mao-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
