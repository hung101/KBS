<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTindakanSelanjutnyaFisioterapi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tindakan_selanjutnya_fisioterapi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tindakan_selanjutnya_fisioterapi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tindakan-selanjutnya-fisioterapi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
