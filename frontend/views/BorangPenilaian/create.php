<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BorangPenilaian */

$this->title = GeneralLabel::tambah_borang_penilaian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_penilaian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penilaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
