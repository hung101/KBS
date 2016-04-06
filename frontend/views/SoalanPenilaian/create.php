<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SoalanPenilaian */

$this->title = GeneralLabel::tambah_soalan_penilaian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::soalan_penilaian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soalan-penilaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
