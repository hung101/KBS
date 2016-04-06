<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPangkatPsikologi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pangkat_psikologi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pangkat_psikologi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pangkat-psikologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
