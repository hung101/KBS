<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanPenilaianPendidikanPenganjurInstructor */

$this->title = 'Create Ref Soalan Penilaian Pendidikan Penganjur Instructor';
$this->params['breadcrumbs'][] = ['label' => 'Ref Soalan Penilaian Pendidikan Penganjur Instructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-soalan-penilaian-pendidikan-penganjur-instructor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
