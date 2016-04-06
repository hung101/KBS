<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanPenilaianPendidikanPenganjurInstructor */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::soalan_penilaian_pendidikan_penganjur_instructor;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::soalan_penilaian_pendidikan_penganjur_instructor, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-soalan-penilaian-pendidikan-penganjur-instructor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
