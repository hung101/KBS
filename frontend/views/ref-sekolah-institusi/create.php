<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSekolahInstitusi */

$this->title = 'Create Ref Sekolah Institusi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sekolah Institusis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sekolah-institusi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
