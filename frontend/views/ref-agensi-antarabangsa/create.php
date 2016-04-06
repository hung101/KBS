<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::agensi_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::agensi_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
