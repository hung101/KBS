<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPemohonJaringanAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pemohon_jaringan_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pemohon_jaringan_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pemohon-jaringan-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
