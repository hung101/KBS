<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKursusAkademik */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kursus_akademik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kursus_akademik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kursus-akademik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
