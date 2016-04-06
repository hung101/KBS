<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefUniversitiInstitusiEBiasiswa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::universiti_institusi_ebiasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::universiti_institusi_ebiasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-universiti-institusi-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
