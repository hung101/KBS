<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaianJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::penilaian_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penilaian-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
