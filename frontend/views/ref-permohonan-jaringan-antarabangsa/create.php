<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPermohonanJaringanAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::permohonan_jaringan_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_jaringan_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-permohonan-jaringan-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
