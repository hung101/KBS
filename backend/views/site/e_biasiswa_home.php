<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Alert;

// table reference
use app\models\AdminEBiasiswa;

use common\models\general\GeneralFunction;
use app\models\general\GeneralVariable;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = GeneralLabel::permohonan_e_biasiswa;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="list-group">
    <?php 
        $results = AdminEBiasiswa::find()->where(['=', 'aktif', 1])->andwhere(['>=', 'tarikh_tamat', date(GeneralVariable::saveDateFormat)])->andwhere(['<=', 'tarikh_mula', date(GeneralVariable::saveDateFormat)])->orderBy('tarikh_tamat')->all();
        
        if(count($results) > 0){
            foreach ($results as $modelAdminEBiasiswa) { 
                echo '<a href="'.Url::to(['/permohonan-e-biasiswa/load', 'admin_e_biasiswa_id' => $modelAdminEBiasiswa->admin_e_biasiswa_id]).'" class="list-group-item">';
                echo '<h4 class="list-group-item-heading">'.$modelAdminEBiasiswa->nama.'</h4>';
                echo '<p class="list-group-item-text">'.GeneralLabel::tarikh_permohonan_dibuka.' '.GeneralFunction::convert($modelAdminEBiasiswa->tarikh_mula).' '.strtolower(GeneralLabel::hingga).' '.GeneralFunction::convert($modelAdminEBiasiswa->tarikh_tamat).'</p>';
                echo '<!--<p class="list-group-item-text">'.Html::a(GeneralLabel::muat_turun_syarat_kelayakan, 'javascript:void(0);', ['onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl . '/' . $modelAdminEBiasiswa->muat_naik_syarat_kelayakan . '");']).'</p>-->';
                echo '</a>';
            }
        } else {
            echo Alert::widget([
                'options' => [
                    'class' => 'alert-info',
                ],
                'body' => GeneralLabel::tiada_apa_apa_permohonan_membenarkan_pada_masa_ini,
            ]);
        }
    ?>
        
        <!--<a href="<?=Url::to(['permohonan-e-biasiswa/index'])?>" class="list-group-item">
          <h4 class="list-group-item-heading">Sejarah Permohonan</h4>
          <p class="list-group-item-text">Senarai Permohonan</p>
        </a>-->
    </div>

</div>
