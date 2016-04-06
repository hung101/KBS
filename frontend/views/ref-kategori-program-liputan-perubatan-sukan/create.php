<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriProgramLiputanPerubatanSukan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_program_liputan_perubatan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_program_liputan_perubatan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-program-liputan-perubatan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
