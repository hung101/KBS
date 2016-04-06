<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisProgramJaringanAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_program_jaringan_antarabangsa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_program_jaringan_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-program-jaringan-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
