<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisProgramBantuanMenghadiriProgramAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Program Bantuan Menghadiri Program Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Program Bantuan Menghadiri Program Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-program-bantuan-menghadiri-program-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
