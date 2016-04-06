<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisProgramJaringanAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Program Jaringan Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Program Jaringan Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-program-jaringan-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
