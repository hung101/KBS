<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBadanSukanAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::badan_sukan_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::badan_sukan_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-badan-sukan-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
