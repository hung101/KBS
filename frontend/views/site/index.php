<?php
use miloschuman\highcharts\Highcharts;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;
use dosamigos\chartjs\ChartJs;
use yii\helpers\ArrayHelper;

use app\models\PermohonanEBiasiswa;

$connection = Yii::$app->getDb();

// global variables
$class_color_progress_bar = array(
    "progress-bar progress-bar-aqua", 
    "progress-bar progress-bar-red", 
    "progress-bar progress-bar-green",
    "progress-bar progress-bar-yellow",
    "progress-bar progress-bar-purple",
    );

$class_bootstrap = array(
    "success", 
    "info",
    "warning",
    "danger",
    );

$class_bootstrap_runner = 0;


$session = Yii::$app->getSession();
$sql_desc_selector = 'desc';

if($session->get('language') == "BM"){
    $sql_desc_selector = 'desc';
}elseif($session->get('language') == "EN"){
    $sql_desc_selector = 'desc_en';
}

/* @var $this yii\web\View */
$this->title = GeneralLabel::kementerian_belia_dan_sukan_malaysia_dashboard;
?>
<div class="site-index">

    <!--<div class="jumbotron">
        <h1><?= GeneralMessage::selamat_datang ?></h1>

        <p class="lead"><?= GeneralMessage::sistem_pengurusan_sukan_bersepadu ?></p>
    </div>-->

    <div class="body-content">
        <h1>
        Dashboard
        <small><?= GeneralMessage::sistem_pengurusan_sukan_bersepadu ?></small>
      </h1>

        <div class="row" id="dashboard-content">
        
        
            <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['module']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['atlet'])): ?>
          <?php
                                
            // Atlet Jumlah START

            $command = $connection->createCommand('
                SELECT COUNT(*) as JUMLAH FROM tbl_atlet', [':year' => date("Y")]);

            $result = $command->queryAll();

            $jumlahKeseluruhanAtlet= 0;

            foreach ($result as $row){
                $jumlahKeseluruhanAtlet = $row['JUMLAH'];
            }

            // Atlet Jumlah END
          ?>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$jumlahKeseluruhanAtlet?></h3>

              <p><?=GeneralLabel::atlet?></p>
            </div>
            <div class="icon">
              <i class="ion ion-android-bicycle"></i>
            </div>
            <a href="#" class="small-box-footer"><!--Maklumat lanjut <i class="fa fa-arrow-circle-right"></i>--></a>
          </div>
        </div>
          <?php endif; ?>
        <!-- ./col -->
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['module']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['jurulatih'])): ?>
        <?php
                                
            // Jurulatih Jumlah START

            $command = $connection->createCommand('
                SELECT COUNT(*) as JUMLAH FROM tbl_jurulatih', [':year' => date("Y")]);

            $result = $command->queryAll();

            $jumlahKeseluruhanJurulatih= 0;

            foreach ($result as $row){
                $jumlahKeseluruhanJurulatih = $row['JUMLAH'];
            }

            // Jurulatih Jumlah END
          ?>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <!--<h3>4<sup style="font-size: 20px">%</sup></h3>-->
                <h3><?=$jumlahKeseluruhanJurulatih?></h3>

              <p><?=GeneralLabel::jurulatih?></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            <a href="#" class="small-box-footer"><!--Maklumat lanjut <i class="fa fa-arrow-circle-right"></i>--></a>
          </div>
        </div>
        <?php endif; ?>
        <!-- ./col -->
        <!--<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <!--<div class="small-box bg-yellow">
            <div class="inner">
              <h3>28</h3>

              <p>Pengguna Dalaman</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-color-filter"></i>
            </div>
            <a href="#" class="small-box-footer">Maklumat lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!--<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <!--<div class="small-box bg-red">
            <div class="inner">
              <h3>33</h3>

              <p>Pengguna Awam</p>
            </div>
            <div class="icon">
              <i class="ion ion-earth"></i>
            </div>
            <a href="#" class="small-box-footer">Maklumat lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          
          
          
          <!--<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Statistik</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
           <!-- <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Perbandingan: Apr 2016 - Mei 2016</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    
<?php /*echo ChartJs::widget([
    'type' => 'Line',
    'clientOptions' => [
        'multiTooltipTemplate' => "<%= datasetLabel %> - <%= value %>",
    ],
    'options' => [
        'height' => 100,
        'id'=>'chartPerbandingan102',
    ],
    'data' => [
        'labels' => ["Permohonan", "Cadangan", "Kelulusan", "Perbelanjaan"],
        'datasets' => [
            [
                'label' =>  "April",
                'fillColor' => "rgba(220,220,220,0.5)",
                'strokeColor' => "rgba(220,220,220,1)",
                'pointColor' => "rgba(220,220,220,1)",
                'pointStrokeColor' => "#fff",
                'data' => [286653.16, 292070.00, 236187.30, 247794.58]
            ],
            [
                'label' =>  "Mei",
                'fillColor' => "rgba(151,187,205,0.5)",
                'strokeColor' => "rgba(151,187,205,1)",
                'pointColor' => "rgba(151,187,205,1)",
                'pointStrokeColor' => "#fff",
                'data' => [345365.25, 301103.10, 295234.12, 288133.23]
            ]
        ]
    ],
]);*/
?>
                    
                    <!--<div id="chartLegend_chartPerbandingan" class="chart-legend"></div>
                  </div>
                  <!-- /.chart-responsive -->
                <!--</div>
                <!-- /.col -->
                <!--<div class="col-md-4">
                  <p class="text-center">
                    <strong>Jumlah Kelulusan Mengikut Program</strong>
                  </p>
                  <div class="progress-group">
                    <span class="progress-text">Senior</span>
                    <span class="progress-number"><b>RM 50,400.10</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 17%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <!--<div class="progress-group">
                    <span class="progress-text">Pelapis Kebangsaan</span>
                    <span class="progress-number"><b>RM 43,133.15</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 15%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <!--<div class="progress-group">
                    <span class="progress-text">Pelapis Serantau</span>
                    <span class="progress-number"><b>RM 78,167.01</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 27%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <!--<div class="progress-group">
                    <span class="progress-text">Pelapis Negeri</span>
                    <span class="progress-number"><b>RM 47,300.20</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 16%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <!-- /.progress-group -->
                  <!--<div class="progress-group">
                    <span class="progress-text">Bakat</span>
                    <span class="progress-number"><b>RM 76,233.66</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-purple" style="width: 25%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
               <!-- </div>
                <!-- /.col -->
              <!--</div>
              <!-- /.row -->
            <!--</div>
            <!-- ./box-body -->
            <!--<div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">RM 345,365.25</h5>
                    <span class="description-text">JUMLAH PERMOHONAN</span>
                  </div>
                  <!-- /.description-block -->
                <!--</div>
                <!-- /.col -->
                <!--<div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 3%</span>
                    <h5 class="description-header">RM 301,103.10</h5>
                    <span class="description-text">JUMLAH CADANGAN</span>
                  </div>
                  <!-- /.description-block -->
                <!--</div>
                <!-- /.col -->
                <!--<div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">RM 295,234.12</h5>
                    <span class="description-text">JUMLAH KELULUSAN</span>
                  </div>
                  <!-- /.description-block -->
                <!--</div>
                <!-- /.col -->
                <!--<div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 14%</span>
                    <h5 class="description-header">RM 288,133.23</h5>
                    <span class="description-text">JUMLAH PERBELANJAAN</span>
                  </div>
                  <!-- /.description-block -->
                <!--</div>
              </div>
              <!-- /.row -->
            <!--</div>
            <!-- /.box-footer -->
          <!--</div>
          <!-- /.box -->
          
          
          
          
          <!-- Atlet - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['module']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['atlet'])): ?>
          
          <?php
            
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::atlet?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="status-program_-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Atlet Program START
            
                                $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM,
                                        ( SELECT SUM(inner1.JUMLAH) FROM
                                            (SELECT COUNT(*) AS JUMLAH,
                                                (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = att.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM
                                                FROM `tbl_atlet` att 
                                                WHERE att.cacat = 0
                                                GROUP BY PROGRAM) inner1 ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_atlet` a 
                                        WHERE a.cacat = 0
                                        GROUP BY PROGRAM
                                    ) final ', [':year' => date("Y")]);

                                $result = $command->queryAll();

                                $chartDataAtletProgram = array();
                                $jumlahKeseluruhanAtletProgram= 0;

                                foreach ($result as $row){
                                    $chartDataAtletProgram[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM'],  (double)$row['PERATUS']];
                                    $jumlahKeseluruhanAtletProgram= $row['JUMLAH_KESELURUHAN'];
                                }

                                //print_r($chartDataAtletProgram);

                                // Atlet Program END
            
                                if($chartDataAtletProgram){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::program],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataAtletProgram,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanAtletProgram?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                // Atlet Mengikut Sukan  START
                                $command = $connection->createCommand('
                                    SELECT *, 
                                    SUM(final.SUB_JUMLAH) AS JUMLAH,
                                    IFNULL((SUM(final.SUB_JUMLAH) / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS SUB_JUMLAH,
                                        (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM,
                                        (SELECT (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = ass.nama_sukan) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS SUKAN,
                                        (SELECT ass.nama_sukan FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS SUKAN_ID,
                                        ( SELECT SUM(inner1.JUMLAH) FROM
                                            (SELECT COUNT(*) AS JUMLAH,
                                                (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = att.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM
                                                FROM `tbl_atlet` att 
                                                WHERE att.cacat = 0
                                                GROUP BY PROGRAM) inner1 ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_atlet` a 
                                        WHERE a.cacat = 0
                                        GROUP BY SUKAN_ID,PROGRAM
                                    ) final 
                                    GROUP BY final.SUKAN_ID
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                $result = $command->queryAll();
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($result as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Atlet Mengikut Sukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- Atlet - END -->
          
          
          
          
          
          <!-- Atlet (Paralimpik) - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['module']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['atlet-paralimpik'])): ?>
          
          <?php
            
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::atlet_paralimpik?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="status-program_pengaj-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Atlet Program START
            
                                $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM,
                                        ( SELECT SUM(inner1.JUMLAH) FROM
                                            (SELECT COUNT(*) AS JUMLAH,
                                                (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = att.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM
                                                FROM `tbl_atlet` att 
                                                WHERE att.cacat = 1
                                                GROUP BY PROGRAM) inner1 ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_atlet` a 
                                        WHERE a.cacat = 1
                                        GROUP BY PROGRAM
                                    ) final ', [':year' => date("Y")]);

                                $result = $command->queryAll();

                                $chartDataAtletProgram = array();
                                $jumlahKeseluruhanAtletProgram= 0;

                                foreach ($result as $row){
                                    $chartDataAtletProgram[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM'],  (double)$row['PERATUS']];
                                    $jumlahKeseluruhanAtletProgram= $row['JUMLAH_KESELURUHAN'];
                                }

                                //print_r($chartDataAtletProgram);

                                // Atlet Program END
            
                                if($chartDataAtletProgram){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::program],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataAtletProgram,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanAtletProgram?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                // Atlet Mengikut Sukan  START
                                $command = $connection->createCommand('
                                    SELECT *, 
                                    SUM(final.SUB_JUMLAH) AS JUMLAH,
                                    IFNULL((SUM(final.SUB_JUMLAH) / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS SUB_JUMLAH,
                                        (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM,
                                        (SELECT (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = ass.nama_sukan) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS SUKAN,
                                        (SELECT ass.nama_sukan FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS SUKAN_ID,
                                        ( SELECT SUM(inner1.JUMLAH) FROM
                                            (SELECT COUNT(*) AS JUMLAH,
                                                (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = att.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM
                                                FROM `tbl_atlet` att 
                                                WHERE att.cacat = 1
                                                GROUP BY PROGRAM) inner1 ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_atlet` a 
                                        WHERE a.cacat = 1
                                        GROUP BY SUKAN_ID,PROGRAM
                                    ) final 
                                    GROUP BY final.SUKAN_ID
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                $result = $command->queryAll();
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($result as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Atlet Mengikut Sukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- Atlet (Paralimpik) - END -->
          
          
          
          
          
          
          <!-- Jurulatih - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['module']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['jurulatih'])): ?>
          
          <?php
            
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::jurulatih?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="jurulatih_status-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Jurulatih Status - START
            
                                $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_status_jurulatih r WHERE r.id = p.status_jurulatih) AS STATUS_JURULATIH,
                                        (SELECT COUNT(*) FROM `tbl_jurulatih` pe ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_jurulatih` p
                                        GROUP BY p.status_jurulatih
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                $result = $command->queryAll();

                                $chartDataJurulatihStatus = array();
                                $jumlahKeseluruhanJurulatihStatus= 0;

                                foreach ($result as $row){
                                    $chartDataJurulatihStatus[] = [$row['JUMLAH'] . ' - ' . $row['STATUS_JURULATIH'],  (double)$row['PERATUS']];
                                    $jumlahKeseluruhanJurulatihStatus= $row['JUMLAH_KESELURUHAN'];
                                }

                                //print_r($chartDataJurulatihStatus);

                                // Jurulatih Status -  END
            
                                if($chartDataJurulatihStatus){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::status],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataJurulatihStatus,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanJurulatihStatus?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                
                                // Jurulatih Program - START
                                $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        IFNULL((SELECT ass.program FROM tbl_jurulatih_sukan ass WHERE ass.jurulatih_id = a.jurulatih_id ORDER BY ass.created DESC LIMIT 1 ),"") AS PROGRAM_ID,
                                        (SELECT (SELECT r.desc FROM tbl_ref_program_jurulatih r WHERE r.id = ass.program) FROM tbl_jurulatih_sukan ass WHERE ass.jurulatih_id = a.jurulatih_id ORDER BY ass.created DESC LIMIT 1 ) AS PROGRAM,
                                        ( SELECT SUM(inner1.JUMLAH) FROM
                                            (SELECT COUNT(*) AS JUMLAH,
                                                (SELECT (SELECT r.desc FROM tbl_ref_program_jurulatih r WHERE r.id = ass.program) FROM tbl_jurulatih_sukan ass WHERE ass.jurulatih_id = att.jurulatih_id ORDER BY ass.created DESC LIMIT 1 ) AS PROGRAM
                                                FROM `tbl_jurulatih` att 
                                                GROUP BY PROGRAM) inner1 ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_jurulatih` a 
                                        GROUP BY PROGRAM_ID
                                    ) final ', [':year' => date("Y")]);

                                    $result = $command->queryAll();

                                    $chartDataJurulatihProgram = array();
                                    $jumlahKeseluruhanJurulatihProgram = 0;

                                    foreach ($result as $row){
                                        $chartDataJurulatihProgram[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanJurulatihProgram= $row['JUMLAH_KESELURUHAN'];
                                    }

                                    //print_r($chartDataJurulatihProgram);

                                    // Jurulatih Program - END
            
                                if($chartDataJurulatihProgram){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::program],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataJurulatihProgram,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanJurulatihProgram?></strong>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <?php
                                
                                // Jurulatih Negara - START
                                $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.desc FROM tbl_ref_negara r WHERE r.id = p.warganegara) AS NEGARA,
                                        (SELECT COUNT(*) FROM `tbl_jurulatih` pe ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_jurulatih` p
                                        GROUP BY p.warganegara
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $result = $command->queryAll();

                                    $chartDataJurulatihNegara = array();
                                    $jumlahKeseluruhanJurulatihNegara = 0;

                                    foreach ($result as $row){
                                        $chartDataJurulatihNegara[] = [$row['JUMLAH'] . ' - ' . $row['NEGARA'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanJurulatihNegara= $row['JUMLAH_KESELURUHAN'];
                                    }

                                    //print_r($chartDataJurulatihProgram);

                                    // Jurulatih Negara - END
            
                                if($chartDataJurulatihNegara){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::negara],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataJurulatihNegara,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanJurulatihNegara?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                // Jurulatih Mengikut Sukan - START
                                $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT ass.program FROM tbl_jurulatih_sukan ass WHERE ass.jurulatih_id = a.jurulatih_id ORDER BY ass.created DESC LIMIT 1 ) AS PROGRAM_ID,
                                        (SELECT (SELECT r.desc FROM tbl_ref_program_jurulatih r WHERE r.id = ass.program) FROM tbl_jurulatih_sukan ass WHERE ass.jurulatih_id = a.jurulatih_id ORDER BY ass.created DESC LIMIT 1 ) AS PROGRAM,
                                        (SELECT (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = ass.sukan) FROM tbl_jurulatih_sukan ass WHERE ass.jurulatih_id = a.jurulatih_id ORDER BY ass.created DESC LIMIT 1 ) AS SUKAN,
                                        (SELECT ass.sukan FROM tbl_jurulatih_sukan ass WHERE ass.jurulatih_id = a.jurulatih_id ORDER BY ass.created DESC LIMIT 1 ) AS SUKAN_ID,
                                        ( SELECT SUM(inner1.JUMLAH) FROM
                                            (SELECT COUNT(*) AS JUMLAH,
                                                (SELECT (SELECT r.desc FROM tbl_ref_program_jurulatih r WHERE r.id = ass.program) FROM tbl_jurulatih_sukan ass WHERE ass.jurulatih_id = att.jurulatih_id ORDER BY ass.created DESC LIMIT 1 ) AS PROGRAM
                                                FROM `tbl_jurulatih` att 
                                                GROUP BY PROGRAM) inner1 ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_jurulatih` a 
                                        GROUP BY SUKAN_ID
                                    ) final  
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                $result = $command->queryAll();
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($result as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Jurulatih Mengikut Sukan - END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                        </div>  
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- Jurulatih - END -->
          
          
          
          
          
          
          
          <!-- Insentif - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['module']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['insentif'])): ?>
          
          <?php
            
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            
            
            
          ?>
          
          <div class="box-body nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a id="tab1" href="#insentif_tahun_1-chart" data-toggle="tab"><?=date("Y")?></a></li>
                    <li><a id="tab2" href="#insentif_tahun_1-chart" data-toggle="tab"><?=date("Y",strtotime("-1 year"))?></a></li>
                    <li><a id="tab3" href="#insentif_tahun_1-chart" data-toggle="tab"><?=date("Y",strtotime("-2 year"))?></a></li>
                    <li><a id="tab4" href="#insentif_tahun_1-chart" data-toggle="tab"><?=date("Y",strtotime("-3 year"))?></a></li>
                    <li class="pull-left header"><?=GeneralLabel::statistik?></li>
                  </ul>
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="insentif_tahun_1-chart" style="position: relative;">
                        <br>
                        <div class="row">
                            <div class="col-lg-8">
                                <?php
                                
                                // Jenis Insentif - START
            
                                $command = $connection->createCommand('
                                    SELECT *, IFNULL(sub_1.SHAKAM + sub_1.INSENTIF_KHAS + sub_1.SHAKAR + sub_1.REKOD_BARU + sub_1.SGAR + sub_1.SIKAP,0) AS JUMLAH_KESELURUHAN
                                    FROM (
                                            SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 1),0.0) AS SHAKAM,
                                            IFNULL((SELECT SUM(ia.insentif_khas)
                                                    FROM `tbl_pembayaran_insentif_atlet` ia
                                                    LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id=ia.pembayaran_insentif_id
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS INSENTIF_KHAS,
                                            IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 2),0.0) AS SHAKAR,
                                            IFNULL((SELECT SUM(s.nilai_rekod_baharu) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS REKOD_BARU,
                                            IFNULL((SELECT SUM(ij.nilai)
                                                    FROM `tbl_pembayaran_insentif_jurulatih` ij
                                                    LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id = ij.pembayaran_insentif_id
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS SGAR,
                                            IFNULL((SELECT SUM(s.nilai_sikap)
                                                    FROM tbl_pembayaran_insentif s
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS SIKAP

                                    ) sub_1', [':year' => date("Y")]);

                                $resultTahun1 = $command->queryAll();

                                
                                $jumlahKeseluruhanInsentif_TAHUN_1 = 0;
                                
                                $SHAKAM_TAHUN_1 = 0;
                                $INSENTIF_KHAS_TAHUN_1 = 0;
                                $SHAKAR_TAHUN_1 = 0;
                                $REKOD_BARU_TAHUN_1 = 0;
                                $SGAR_TAHUN_1 = 0;
                                $SIKAP_TAHUN_1 = 0;

                                foreach ($resultTahun1 as $row){
                                    $SHAKAM_TAHUN_1 = $row['SHAKAM'];
                                    $INSENTIF_KHAS_TAHUN_1 = $row['INSENTIF_KHAS'];
                                    $SHAKAR_TAHUN_1 = $row['SHAKAR'];
                                    $REKOD_BARU_TAHUN_1 = $row['REKOD_BARU'];
                                    $SGAR_TAHUN_1 = $row['SGAR'];
                                    $SIKAP_TAHUN_1 = $row['SIKAP'];
                                    $jumlahKeseluruhanInsentif_TAHUN_1 = $row['JUMLAH_KESELURUHAN'];
                                }
                                
                                /*$chartDataInsentif = array(
                                    $SHAKAM => 'SHAKAM',
                                    $INSENTIF_KHAS => GeneralLabel::insentif_khas,
                                    $SHAKAR => 'SHAKAR',
                                    $REKOD_BARU => GeneralLabel::rekod_baru,
                                    $SGAR => 'SGAR',
                                    $SIKAP => 'SIKAP',
                                );
                                print_r($chartDataInsentif);
                                krsort($chartDataInsentif);
                                
                                $chartDataInsentifSorted = array();*/
                                
                                
                                
                                $command = $connection->createCommand('
                                    SELECT *, IFNULL(sub_1.SHAKAM + sub_1.INSENTIF_KHAS + sub_1.SHAKAR + sub_1.REKOD_BARU + sub_1.SGAR + sub_1.SIKAP,0) AS JUMLAH_KESELURUHAN
                                    FROM (
                                            SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 1),0.0) AS SHAKAM,
                                            IFNULL((SELECT SUM(ia.insentif_khas)
                                                    FROM `tbl_pembayaran_insentif_atlet` ia
                                                    LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id=ia.pembayaran_insentif_id
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS INSENTIF_KHAS,
                                            IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 2),0.0) AS SHAKAR,
                                            IFNULL((SELECT SUM(s.nilai_rekod_baharu) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS REKOD_BARU,
                                            IFNULL((SELECT SUM(ij.nilai)
                                                    FROM `tbl_pembayaran_insentif_jurulatih` ij
                                                    LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id = ij.pembayaran_insentif_id
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS SGAR,
                                            IFNULL((SELECT SUM(s.nilai_sikap)
                                                    FROM tbl_pembayaran_insentif s
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS SIKAP

                                    ) sub_1', [':year' => date("Y",strtotime("-1 year"))]);

                                $resultTahun2 = $command->queryAll();

                                
                                $jumlahKeseluruhanInsentif_TAHUN_2 = 0;
                                
                                $SHAKAM_TAHUN_2 = 0;
                                $INSENTIF_KHAS_TAHUN_2 = 0;
                                $SHAKAR_TAHUN_2 = 0;
                                $REKOD_BARU_TAHUN_2 = 0;
                                $SGAR_TAHUN_2 = 0;
                                $SIKAP_TAHUN_2 = 0;

                                foreach ($resultTahun2 as $row){
                                    $SHAKAM_TAHUN_2 = $row['SHAKAM'];
                                    $INSENTIF_KHAS_TAHUN_2 = $row['INSENTIF_KHAS'];
                                    $SHAKAR_TAHUN_2 = $row['SHAKAR'];
                                    $REKOD_BARU_TAHUN_2 = $row['REKOD_BARU'];
                                    $SGAR_TAHUN_2 = $row['SGAR'];
                                    $SIKAP_TAHUN_2 = $row['SIKAP'];
                                    $jumlahKeseluruhanInsentif_TAHUN_2 = $row['JUMLAH_KESELURUHAN'];
                                }
                                
                                
                                $command = $connection->createCommand('
                                    SELECT *, IFNULL(sub_1.SHAKAM + sub_1.INSENTIF_KHAS + sub_1.SHAKAR + sub_1.REKOD_BARU + sub_1.SGAR + sub_1.SIKAP,0) AS JUMLAH_KESELURUHAN
                                    FROM (
                                            SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 1),0.0) AS SHAKAM,
                                            IFNULL((SELECT SUM(ia.insentif_khas)
                                                    FROM `tbl_pembayaran_insentif_atlet` ia
                                                    LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id=ia.pembayaran_insentif_id
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS INSENTIF_KHAS,
                                            IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 2),0.0) AS SHAKAR,
                                            IFNULL((SELECT SUM(s.nilai_rekod_baharu) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS REKOD_BARU,
                                            IFNULL((SELECT SUM(ij.nilai)
                                                    FROM `tbl_pembayaran_insentif_jurulatih` ij
                                                    LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id = ij.pembayaran_insentif_id
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS SGAR,
                                            IFNULL((SELECT SUM(s.nilai_sikap)
                                                    FROM tbl_pembayaran_insentif s
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS SIKAP

                                    ) sub_1', [':year' => date("Y",strtotime("-2 year"))]);

                                $resultTahun3 = $command->queryAll();

                                
                                $jumlahKeseluruhanInsentif_TAHUN_3 = 0;
                                
                                $SHAKAM_TAHUN_3 = 0;
                                $INSENTIF_KHAS_TAHUN_3 = 0;
                                $SHAKAR_TAHUN_3 = 0;
                                $REKOD_BARU_TAHUN_3 = 0;
                                $SGAR_TAHUN_3 = 0;
                                $SIKAP_TAHUN_3 = 0;

                                foreach ($resultTahun3 as $row){
                                    $SHAKAM_TAHUN_3 = $row['SHAKAM'];
                                    $INSENTIF_KHAS_TAHUN_3 = $row['INSENTIF_KHAS'];
                                    $SHAKAR_TAHUN_3 = $row['SHAKAR'];
                                    $REKOD_BARU_TAHUN_3 = $row['REKOD_BARU'];
                                    $SGAR_TAHUN_3 = $row['SGAR'];
                                    $SIKAP_TAHUN_3 = $row['SIKAP'];
                                    $jumlahKeseluruhanInsentif_TAHUN_3 = $row['JUMLAH_KESELURUHAN'];
                                }
                                
                                $command = $connection->createCommand('
                                    SELECT *, IFNULL(sub_1.SHAKAM + sub_1.INSENTIF_KHAS + sub_1.SHAKAR + sub_1.REKOD_BARU + sub_1.SGAR + sub_1.SIKAP,0) AS JUMLAH_KESELURUHAN
                                    FROM (
                                            SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 1),0.0) AS SHAKAM,
                                            IFNULL((SELECT SUM(ia.insentif_khas)
                                                    FROM `tbl_pembayaran_insentif_atlet` ia
                                                    LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id=ia.pembayaran_insentif_id
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS INSENTIF_KHAS,
                                            IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 2),0.0) AS SHAKAR,
                                            IFNULL((SELECT SUM(s.nilai_rekod_baharu) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS REKOD_BARU,
                                            IFNULL((SELECT SUM(ij.nilai)
                                                    FROM `tbl_pembayaran_insentif_jurulatih` ij
                                                    LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id = ij.pembayaran_insentif_id
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS SGAR,
                                            IFNULL((SELECT SUM(s.nilai_sikap)
                                                    FROM tbl_pembayaran_insentif s
                                                    WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0) AS SIKAP

                                    ) sub_1', [':year' => date("Y",strtotime("-3 year"))]);

                                $resultTahun4 = $command->queryAll();

                                
                                $jumlahKeseluruhanInsentif_TAHUN_4 = 0;
                                
                                $SHAKAM_TAHUN_4 = 0;
                                $INSENTIF_KHAS_TAHUN_4 = 0;
                                $SHAKAR_TAHUN_4 = 0;
                                $REKOD_BARU_TAHUN_4 = 0;
                                $SGAR_TAHUN_4 = 0;
                                $SIKAP_TAHUN_4 = 0;

                                foreach ($resultTahun4 as $row){
                                    $SHAKAM_TAHUN_4 = $row['SHAKAM'];
                                    $INSENTIF_KHAS_TAHUN_4 = $row['INSENTIF_KHAS'];
                                    $SHAKAR_TAHUN_4 = $row['SHAKAR'];
                                    $REKOD_BARU_TAHUN_4 = $row['REKOD_BARU'];
                                    $SGAR_TAHUN_4 = $row['SGAR'];
                                    $SIKAP_TAHUN_4 = $row['SIKAP'];
                                    $jumlahKeseluruhanInsentif_TAHUN_4 = $row['JUMLAH_KESELURUHAN'];
                                }
                                // Jenis Insentif-  END
                                
                                  ?>
                                <p class="text-center" id="label-title-insentif-year">
                                    <strong><?=GeneralLabel::tahun;?> <?=date("Y");?></strong>
                                  </p>
                                <div class="chart" id="chartTahun1">
                                    <!-- Chart Canvas -->

                                    <?php echo ChartJs::widget([
                                        'type' => 'Line',
                                        'clientOptions' => [
                                            'tooltipTemplate' => "RM <%= addCommas(value) %>",
                                        ],
                                        'options' => [
                                            'height' => 100,
                                            'id'=>'chartPerbandingan_tahun_1',
                                        ],
                                        'data' => [
                                            'labels' => ["SHAKAM", GeneralLabel::insentif_khas, "SHAKAR", GeneralLabel::rekod_baru, "SGAR", "SIKAP"],
                                            'datasets' => [
                                                [
                                                    'label' =>  date("Y"),
                                                    'fillColor' => "rgba(220,220,220,0.5)",
                                                    'strokeColor' => "rgba(220,220,220,1)",
                                                    'pointColor' => "rgba(220,220,220,1)",
                                                    'pointStrokeColor' => "#fff",
                                                    'data' => [$SHAKAM_TAHUN_1, $INSENTIF_KHAS_TAHUN_1, $SHAKAR_TAHUN_1, $REKOD_BARU_TAHUN_1, $SGAR_TAHUN_1, $SIKAP_TAHUN_1]
                                                ],
                                            ]
                                        ],
                                    ]);
                                    ?>
                                    
                                        <!--<div id="chartLegend_chartPerbandingan_tahun_1" class="chart-legend"></div>-->
                                      </div>
                            </div>
                            <div class="col-md-4">
                                <div id="dataTahun1">
                                    <p class="text-center">
                                        <strong><?=GeneralLabel::jumlah_mengikut_jenis_insentif?></strong>
                                      </p>
                                      <?php
                                      // Jenis Insentif Sort - START
                                      $command = $connection->createCommand('
                                          SELECT *
              FROM (

                      SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 1),0.0) AS JUMLAH, "SHAKAM" AS JENIS_INSENTIF
                      UNION
                      SELECT IFNULL((SELECT SUM(ia.insentif_khas)
                              FROM `tbl_pembayaran_insentif_atlet` ia
                              LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id=ia.pembayaran_insentif_id
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "INSENTIF_KHAS"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 2),0.0), "SHAKAR"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.nilai_rekod_baharu) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "REKOD_BARU"
                      UNION
                      SELECT IFNULL((SELECT SUM(ij.nilai)
                              FROM `tbl_pembayaran_insentif_jurulatih` ij
                              LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id = ij.pembayaran_insentif_id
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "SGAR"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.nilai_sikap)
                              FROM tbl_pembayaran_insentif s
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "SIKAP"

              ) sub_1 
              ORDER BY JUMLAH DESC', [':year' => date("Y")]);

                                      $result = $command->queryAll();

                                      //echo 'color class = ' . $class_color_progress_bar[0];

                                      $color_class_runner = 0;

                                      foreach ($result as $row){
                                          // replace those translation string label on dashboard
                                          $jenisInsentif = trim($row['JENIS_INSENTIF']);
                                          $jenisInsentif = str_replace("INSENTIF_KHAS",GeneralLabel::insentif_khas,$jenisInsentif);
                                          $jenisInsentif = str_replace("REKOD_BARU",GeneralLabel::rekod_baru,$jenisInsentif);
                                          
                                          $widthPercent = 0;
                                          
                                          if($jumlahKeseluruhanInsentif_TAHUN_2 > 0){
                                              $widthPercent = number_format((($row['JUMLAH']/$jumlahKeseluruhanInsentif_TAHUN_2)*100),2);
                                          } 

                                          //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                          echo '<div class="progress-group">
                                        <span class="progress-text">'.$jenisInsentif.'</span>
                                        <span class="progress-number"><b> RM '.number_format($row['JUMLAH'],2).'</b></span>

                                        <div class="progress sm">
                                          <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$widthPercent.'%"></div>
                                        </div>
                                      </div>';

                                          $color_class_runner++;

                                          if($color_class_runner == count($class_color_progress_bar)){
                                              $color_class_runner = 0;
                                          }
                                      }

                                      // Jenis Insentif Sort - END
                                      ?>
                                      <!-- /.progress-group -->
                                      <p class="text-right">
                                          <br>
                                        <strong><?=GeneralLabel::jumlah_without_RM?> : RM <?=number_format($jumlahKeseluruhanInsentif_TAHUN_1,2)?></strong>
                                      </p>
                                </div>
                                <div id="dataTahun2" style="display: none;">
                                    <p class="text-center">
                                        <strong><?=GeneralLabel::jumlah_mengikut_jenis_insentif?></strong>
                                      </p>
                                      <?php
                                      // Jenis Insentif Sort - START
                                      $command = $connection->createCommand('
                                          SELECT *
              FROM (

                      SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 1),0.0) AS JUMLAH, "SHAKAM" AS JENIS_INSENTIF
                      UNION
                      SELECT IFNULL((SELECT SUM(ia.insentif_khas)
                              FROM `tbl_pembayaran_insentif_atlet` ia
                              LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id=ia.pembayaran_insentif_id
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "INSENTIF_KHAS"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 2),0.0), "SHAKAR"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.nilai_rekod_baharu) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "REKOD_BARU"
                      UNION
                      SELECT IFNULL((SELECT SUM(ij.nilai)
                              FROM `tbl_pembayaran_insentif_jurulatih` ij
                              LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id = ij.pembayaran_insentif_id
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "SGAR"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.nilai_sikap)
                              FROM tbl_pembayaran_insentif s
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "SIKAP"

              ) sub_1 
              ORDER BY JUMLAH DESC', [':year' => date("Y",strtotime("-1 year"))]);

                                      $result = $command->queryAll();

                                      //echo 'color class = ' . $class_color_progress_bar[0];

                                      $color_class_runner = 0;

                                      foreach ($result as $row){
                                          // replace those translation string label on dashboard
                                          $jenisInsentif = trim($row['JENIS_INSENTIF']);
                                          $jenisInsentif = str_replace("INSENTIF_KHAS",GeneralLabel::insentif_khas,$jenisInsentif);
                                          $jenisInsentif = str_replace("REKOD_BARU",GeneralLabel::rekod_baru,$jenisInsentif);
                                          
                                          $widthPercent = 0;
                                          
                                          if($jumlahKeseluruhanInsentif_TAHUN_2 > 0){
                                              $widthPercent = number_format((($row['JUMLAH']/$jumlahKeseluruhanInsentif_TAHUN_2)*100),2);
                                          } 

                                          //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                          echo '<div class="progress-group">
                                        <span class="progress-text">'.$jenisInsentif.'</span>
                                        <span class="progress-number"><b> RM '.number_format($row['JUMLAH'],2).'</b></span>

                                        <div class="progress sm">
                                          <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$widthPercent.'%"></div>
                                        </div>
                                      </div>';

                                          $color_class_runner++;

                                          if($color_class_runner == count($class_color_progress_bar)){
                                              $color_class_runner = 0;
                                          }
                                      }

                                      // Jenis Insentif Sort - END
                                      ?>
                                      <!-- /.progress-group -->
                                      <p class="text-right">
                                          <br>
                                        <strong><?=GeneralLabel::jumlah_without_RM?> : RM <?=number_format($jumlahKeseluruhanInsentif_TAHUN_2,2)?></strong>
                                      </p>
                                </div>
                                <div id="dataTahun3" style="display: none;">
                                    <p class="text-center">
                                        <strong><?=GeneralLabel::jumlah_mengikut_jenis_insentif?></strong>
                                      </p>
                                      <?php
                                      // Jenis Insentif Sort - START
                                      $command = $connection->createCommand('
                                          SELECT *
              FROM (

                      SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 1),0.0) AS JUMLAH, "SHAKAM" AS JENIS_INSENTIF
                      UNION
                      SELECT IFNULL((SELECT SUM(ia.insentif_khas)
                              FROM `tbl_pembayaran_insentif_atlet` ia
                              LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id=ia.pembayaran_insentif_id
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "INSENTIF_KHAS"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 2),0.0), "SHAKAR"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.nilai_rekod_baharu) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "REKOD_BARU"
                      UNION
                      SELECT IFNULL((SELECT SUM(ij.nilai)
                              FROM `tbl_pembayaran_insentif_jurulatih` ij
                              LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id = ij.pembayaran_insentif_id
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "SGAR"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.nilai_sikap)
                              FROM tbl_pembayaran_insentif s
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "SIKAP"

              ) sub_1 
              ORDER BY JUMLAH DESC', [':year' => date("Y",strtotime("-2 year"))]);

                                      $result = $command->queryAll();

                                      //echo 'color class = ' . $class_color_progress_bar[0];

                                      $color_class_runner = 0;

                                      foreach ($result as $row){
                                          // replace those translation string label on dashboard
                                          $jenisInsentif = trim($row['JENIS_INSENTIF']);
                                          $jenisInsentif = str_replace("INSENTIF_KHAS",GeneralLabel::insentif_khas,$jenisInsentif);
                                          $jenisInsentif = str_replace("REKOD_BARU",GeneralLabel::rekod_baru,$jenisInsentif);
                                          
                                          $widthPercent = 0;
                                          
                                          if($jumlahKeseluruhanInsentif_TAHUN_3 > 0){
                                              $widthPercent = number_format((($row['JUMLAH']/$jumlahKeseluruhanInsentif_TAHUN_3)*100),2);
                                          } 

                                          //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                          echo '<div class="progress-group">
                                        <span class="progress-text">'.$jenisInsentif.'</span>
                                        <span class="progress-number"><b> RM '.number_format($row['JUMLAH'],2).'</b></span>

                                        <div class="progress sm">
                                          <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$widthPercent.'%"></div>
                                        </div>
                                      </div>';

                                          $color_class_runner++;

                                          if($color_class_runner == count($class_color_progress_bar)){
                                              $color_class_runner = 0;
                                          }
                                      }

                                      // Jenis Insentif Sort - END
                                      ?>
                                      <!-- /.progress-group -->
                                      <p class="text-right">
                                          <br>
                                        <strong><?=GeneralLabel::jumlah_without_RM?> : RM <?=number_format($jumlahKeseluruhanInsentif_TAHUN_3,2)?></strong>
                                      </p>
                                </div>
                                <div id="dataTahun4" style="display: none;">
                                    <p class="text-center">
                                        <strong><?=GeneralLabel::jumlah_mengikut_jenis_insentif?></strong>
                                      </p>
                                      <?php
                                      // Jenis Insentif Sort - START
                                      $command = $connection->createCommand('
                                          SELECT *
              FROM (

                      SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 1),0.0) AS JUMLAH, "SHAKAM" AS JENIS_INSENTIF
                      UNION
                      SELECT IFNULL((SELECT SUM(ia.insentif_khas)
                              FROM `tbl_pembayaran_insentif_atlet` ia
                              LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id=ia.pembayaran_insentif_id
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "INSENTIF_KHAS"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.jumlah) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year AND s.jenis_insentif = 2),0.0), "SHAKAR"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.nilai_rekod_baharu) FROM tbl_pembayaran_insentif s WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "REKOD_BARU"
                      UNION
                      SELECT IFNULL((SELECT SUM(ij.nilai)
                              FROM `tbl_pembayaran_insentif_jurulatih` ij
                              LEFT JOIN tbl_pembayaran_insentif s ON s.pembayaran_insentif_id = ij.pembayaran_insentif_id
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "SGAR"
                      UNION
                      SELECT IFNULL((SELECT SUM(s.nilai_sikap)
                              FROM tbl_pembayaran_insentif s
                              WHERE YEAR(s.tarikh_pembayaran_insentif) = :year),0.0), "SIKAP"

              ) sub_1 
              ORDER BY JUMLAH DESC', [':year' => date("Y",strtotime("-3 year"))]);

                                      $result = $command->queryAll();

                                      //echo 'color class = ' . $class_color_progress_bar[0];

                                      $color_class_runner = 0;

                                      foreach ($result as $row){
                                          // replace those translation string label on dashboard
                                          $jenisInsentif = trim($row['JENIS_INSENTIF']);
                                          $jenisInsentif = str_replace("INSENTIF_KHAS",GeneralLabel::insentif_khas,$jenisInsentif);
                                          $jenisInsentif = str_replace("REKOD_BARU",GeneralLabel::rekod_baru,$jenisInsentif);

                                          //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                          $widthPercent = 0;
                                          
                                          if($jumlahKeseluruhanInsentif_TAHUN_4 > 0){
                                              $widthPercent = number_format((($row['JUMLAH']/$jumlahKeseluruhanInsentif_TAHUN_4)*100),2);
                                          } 
                                          
                                          echo '<div class="progress-group">
                                        <span class="progress-text">'.$jenisInsentif.'</span>
                                        <span class="progress-number"><b> RM '.number_format($row['JUMLAH'],2).'</b></span>

                                        <div class="progress sm">
                                          <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '. $widthPercent .'%"></div>
                                        </div>
                                      </div>';

                                          $color_class_runner++;

                                          if($color_class_runner == count($class_color_progress_bar)){
                                              $color_class_runner = 0;
                                          }
                                      }

                                      // Jenis Insentif Sort - END
                                      ?>
                                      <!-- /.progress-group -->
                                      <p class="text-right">
                                          <br>
                                        <strong><?=GeneralLabel::jumlah_without_RM?> : RM <?=number_format($jumlahKeseluruhanInsentif_TAHUN_4,2)?></strong>
                                      </p>
                                </div>
                              </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
      
      <?php
$LABEL_SHAKAM = "SHAKAM";
$LABEL_INSENTIF_KHAS = GeneralLabel::insentif_khas;
$LABEL_SHAKAR = "SHAKAR";
$LABEL_REKOD_BARU = GeneralLabel::rekod_baru;
$LABEL_SGAR = "SGAR";
$LABEL_SIKAP = "SIKAP";

$LABEL_YEAR_1 = GeneralLabel::tahun . ' ' . date("Y");
$LABEL_YEAR_2 = GeneralLabel::tahun . ' ' . date("Y",strtotime("-1 year"));
$LABEL_YEAR_3 = GeneralLabel::tahun . ' ' . date("Y",strtotime("-2 year"));
$LABEL_YEAR_4 = GeneralLabel::tahun . ' ' . date("Y",strtotime("-3 year"));

$script = <<< JS
        
var data1 = {
    labels: ["$LABEL_SHAKAM", "$LABEL_INSENTIF_KHAS", "$LABEL_SHAKAR", "$LABEL_REKOD_BARU", "$LABEL_SGAR", "$LABEL_SIKAP"],
    datasets: [{ 
        fillColor: "rgba(220,220,220,0.5)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#fff",
        data: [$SHAKAM_TAHUN_1, $INSENTIF_KHAS_TAHUN_1, $SHAKAR_TAHUN_1, $REKOD_BARU_TAHUN_1, $SGAR_TAHUN_1, $SIKAP_TAHUN_1] 
    }]
};
var data2 = {
    labels: ["$LABEL_SHAKAM", "$LABEL_INSENTIF_KHAS", "$LABEL_SHAKAR", "$LABEL_REKOD_BARU", "$LABEL_SGAR", "$LABEL_SIKAP"],
    datasets: [{ 
        fillColor: "rgba(220,220,220,0.5)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#fff",
        data: [$SHAKAM_TAHUN_2, $INSENTIF_KHAS_TAHUN_2, $SHAKAR_TAHUN_2, $REKOD_BARU_TAHUN_2, $SGAR_TAHUN_2, $SIKAP_TAHUN_2] 
    }]
};
        
var data3 = {
    labels: ["$LABEL_SHAKAM", "$LABEL_INSENTIF_KHAS", "$LABEL_SHAKAR", "$LABEL_REKOD_BARU", "$LABEL_SGAR", "$LABEL_SIKAP"],
    datasets: [{ 
        fillColor: "rgba(220,220,220,0.5)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#fff",
        data: [$SHAKAM_TAHUN_3, $INSENTIF_KHAS_TAHUN_3, $SHAKAR_TAHUN_3, $REKOD_BARU_TAHUN_3, $SGAR_TAHUN_3, $SIKAP_TAHUN_3] 
    }]
};
        
var data4 = {
    labels: ["$LABEL_SHAKAM", "$LABEL_INSENTIF_KHAS", "$LABEL_SHAKAR", "$LABEL_REKOD_BARU", "$LABEL_SGAR", "$LABEL_SIKAP"],
    datasets: [{ 
        fillColor: "rgba(220,220,220,0.5)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#fff",
        data: [$SHAKAM_TAHUN_4, $INSENTIF_KHAS_TAHUN_4, $SHAKAR_TAHUN_4, $REKOD_BARU_TAHUN_4, $SGAR_TAHUN_4, $SIKAP_TAHUN_4] 
    }]
};
        
var options = {
    // String - Template string for single tooltips
    tooltipTemplate: "RM <%= addCommas(value) %>",
    // String - Template string for multiple tooltips
    //multiTooltipTemplate: "<%= value + ' %' %>",
    responsive : true,
      animation: true,
      showScale: true,
};
        
var ctx1 = document.getElementById('chartPerbandingan_tahun_1').getContext('2d');
var chart1 = new Chart(ctx1).Line(data1, options);
        
$('#tab1').on('shown.bs.tab', function (e) {
        hideAllInsentifData();
        $('#dataTahun1').show(); 
        $('#label-title-insentif-year').html("<strong>$LABEL_YEAR_1</strong>"); 
    $('#chartPerbandingan_tahun_1').remove(); // this is my <canvas> element
    $('#chartTahun1').append('<canvas id="chartPerbandingan_tahun_1" height="100"><canvas>');
    ctx1 = document.getElementById('chartPerbandingan_tahun_1').getContext('2d');
    chart1 = new Chart(ctx1).Line(data1, options);
        
});

$('#tab2').on('shown.bs.tab', function (e) {
        hideAllInsentifData();
        $('#dataTahun2').show(); 
        $('#label-title-insentif-year').html("<strong>$LABEL_YEAR_2</strong>"); 
    $('#chartPerbandingan_tahun_1').remove(); // this is my <canvas> element
    $('#chartTahun1').append('<canvas id="chartPerbandingan_tahun_1" height="100"><canvas>');
    ctx1 = document.getElementById('chartPerbandingan_tahun_1').getContext('2d');
    chart1 = new Chart(ctx1).Line(data2, options);
});
        
$('#tab3').on('shown.bs.tab', function (e) {
        hideAllInsentifData();
        $('#dataTahun3').show(); 
        $('#label-title-insentif-year').html("<strong>$LABEL_YEAR_3</strong>"); 
    $('#chartPerbandingan_tahun_1').remove(); // this is my <canvas> element
    $('#chartTahun1').append('<canvas id="chartPerbandingan_tahun_1" height="100"><canvas>');
    ctx1 = document.getElementById('chartPerbandingan_tahun_1').getContext('2d');
    chart1 = new Chart(ctx1).Line(data3, options);
});
        
$('#tab4').on('shown.bs.tab', function (e) {
        hideAllInsentifData();
        $('#dataTahun4').show(); 
        $('#label-title-insentif-year').html("<strong>$LABEL_YEAR_4</strong>"); 
    $('#chartPerbandingan_tahun_1').remove(); // this is my <canvas> element
    $('#chartTahun1').append('<canvas id="chartPerbandingan_tahun_1" height="100"><canvas>');
    ctx1 = document.getElementById('chartPerbandingan_tahun_1').getContext('2d');
    chart1 = new Chart(ctx1).Line(data4, options);
});
        
function hideAllInsentifData(){
        
        $('#dataTahun1').hide(); 
        $('#dataTahun2').hide();
        $('#dataTahun3').hide(); 
        $('#dataTahun4').hide(); 
}
        
JS;
        
$this->registerJs($script);
?>
          
          <?php endif; ?>
          <!-- Insentif - END -->
          
          
          
          
          
          <!-- Sukarelawan - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['module']) && isset(Yii::$app->user->identity->peranan_akses['MSN']['dashboard-msn']['sukarelawan'])): ?>
          
          <?php
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
          ?>
          
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::sukarelawan?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="sukarelawan-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Sukarelawan Negeri - START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                        IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                        FROM
                                        (
                                            SELECT COUNT(*) AS JUMLAH,
                                            (SELECT r.desc FROM tbl_ref_negeri r WHERE r.id = p.alamat_negeri) AS NEGERI,
                                            (SELECT COUNT(*) FROM `tbl_sukarelawan` pe) AS JUMLAH_KESELURUHAN
                                            FROM `tbl_sukarelawan` p
                                            GROUP BY p.alamat_negeri
                                        ) final 
                                        ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultSukarelawanNegeri = $command->queryAll();

                                    $chartDataSukarelawanNegeri = array();
                                    $jumlahKeseluruhanSukarelawanNegeri= 0;

                                    foreach ($resultSukarelawanNegeri as $row){
                                        $chartDataSukarelawanNegeri[] = [$row['JUMLAH'] . ' - ' . $row['NEGERI'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanSukarelawanNegeri= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Sukarelawan Negeri - - END
            
                                if($chartDataSukarelawanNegeri){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::negeri],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataSukarelawanNegeri,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanSukarelawanNegeri?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                
                                // Sukarelawan Jantina - START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                        IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                        FROM
                                        (
                                            SELECT COUNT(*) AS JUMLAH,
                                            (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_jantina r WHERE r.id = p.jantina) AS JANTINA,
                                            (SELECT COUNT(*) FROM `tbl_sukarelawan` pe) AS JUMLAH_KESELURUHAN
                                            FROM `tbl_sukarelawan` p
                                            GROUP BY p.jantina
                                        ) final 
                                        ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultSukarelawanJantina = $command->queryAll();

                                    $chartDataSukarelawanJantina = array();
                                    $jumlahKeseluruhanSukarelawanJantina = 0;

                                    foreach ($resultSukarelawanJantina as $row){
                                        $chartDataSukarelawanJantina[] = [$row['JUMLAH'] . ' - ' . $row['JANTINA'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanSukarelawanJantina= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Sukarelawan Jantina - END
            
                                if($chartDataSukarelawanJantina){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::jantina],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataSukarelawanJantina,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanSukarelawanJantina?></strong>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Sukarelawan Age - START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                        IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                        FROM
                                        (  SELECT *,COUNT(*) AS JUMLAH
						FROM
						(
						    SELECT 
						    CASE
							WHEN FLOOR(DATEDIFF (NOW(), s.tarikh_lahir)/365) >= 18 AND FLOOR(DATEDIFF (NOW(), s.tarikh_lahir)/365) <= 25
							THEN "18 - 25"
							WHEN FLOOR(DATEDIFF (NOW(), s.tarikh_lahir)/365) >= 26 AND FLOOR(DATEDIFF (NOW(), s.tarikh_lahir)/365) <= 35
							THEN "26 - 35"
							WHEN FLOOR(DATEDIFF (NOW(), s.tarikh_lahir)/365) >= 36 AND FLOOR(DATEDIFF (NOW(), s.tarikh_lahir)/365) <= 45
							THEN "36 - 45"
							WHEN FLOOR(DATEDIFF (NOW(), s.tarikh_lahir)/365) >= 46 AND FLOOR(DATEDIFF (NOW(), s.tarikh_lahir)/365) <= 55
							THEN "46 - 55"
							END AS AGE_GROUP,
						    (SELECT COUNT(*) FROM `tbl_sukarelawan` pe) AS JUMLAH_KESELURUHAN
						    FROM `tbl_sukarelawan` s
						    ) sub 
						    GROUP BY sub.AGE_GROUP
                                        ) final ', [':year' => date("Y")]);

                                    $resultSukarelawanAge = $command->queryAll();

                                    $chartDataSukarelawanAge = array();
                                    $jumlahKeseluruhanSukarelawanAge = 0;

                                    foreach ($resultSukarelawanAge as $row){
                                        $chartDataSukarelawanAge[] = [$row['JUMLAH'] . ' - ' . GeneralLabel::umur . ' ' . $row['AGE_GROUP'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanSukarelawanAge= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Sukarelawan Age - END
            
                                if($chartDataSukarelawanAge){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::umur],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataSukarelawanAge,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanSukarelawanAge?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                
                                // Sukarelawan Kecenderungan - START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                        IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                        FROM
                                        (
                                            SELECT COUNT(*) AS JUMLAH,
                                            (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_bidang_diminati_sukarelawan r WHERE r.id = p.bidang_diminati) AS KECENDERUNGAN,
                                            (SELECT COUNT(*) FROM `tbl_sukarelawan` pe) AS JUMLAH_KESELURUHAN
                                            FROM `tbl_sukarelawan` p
                                            GROUP BY p.bidang_diminati
                                        ) final 
                                        ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultSukarelawanKecenderungan = $command->queryAll();

                                    $chartDataSukarelawanKecenderungan = array();
                                    $jumlahKeseluruhanSukarelawanKecenderungan = 0;

                                    foreach ($resultSukarelawanKecenderungan as $row){
                                        $chartDataSukarelawanKecenderungan[] = [$row['JUMLAH'] . ' - ' . $row['KECENDERUNGAN'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanSukarelawanKecenderungan= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Sukarelawan Kecenderungan - END
            
                                if($chartDataSukarelawanKecenderungan){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::kecenderungan],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataSukarelawanKecenderungan,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanSukarelawanKecenderungan?></strong>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-3">
                                
                            </div>
                            <div class="col-lg-6">
                                <?php
                                
                                // Sukarelawan Bangsa - START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                        IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                        FROM
                                        (
                                            SELECT COUNT(*) AS JUMLAH,
                                            (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_bangsa r WHERE r.id = p.bangsa) AS BANGSA,
                                            (SELECT COUNT(*) FROM `tbl_sukarelawan` pe) AS JUMLAH_KESELURUHAN
                                            FROM `tbl_sukarelawan` p
                                            GROUP BY p.bangsa
                                        ) final 
                                        ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultSukarelawanBangsa = $command->queryAll();

                                    $chartDataSukarelawanBangsa = array();
                                    $jumlahKeseluruhanSukarelawanBangsa = 0;

                                    foreach ($resultSukarelawanBangsa as $row){
                                        $chartDataSukarelawanBangsa[] = [$row['JUMLAH'] . ' - ' . $row['BANGSA'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanSukarelawanBangsa= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Sukarelawan Bangsa - END
            
                                if($chartDataSukarelawanBangsa){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::bangsa],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataSukarelawanBangsa,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanSukarelawanBangsa?></strong>
                                </p>
                            </div>
                            <div class="col-lg-3">
                                
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          
          <?php endif; ?>
          <!-- Sukarelawan - END -->
          
          
          <!-- Atlet ISN - START -->
          <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['dashboard-isn']['module']) && isset(Yii::$app->user->identity->peranan_akses['ISN']['dashboard-isn']['atlet-podium'])): ?>
          <div class="row">
          <?php
                                
            // Atlet Jumlah START

            $command = $connection->createCommand('
                SELECT COUNT(*) as JUMLAH FROM tbl_atlet WHERE cacat=0', [':year' => date("Y")]);

            $result = $command->queryAll();

            $jumlahKeseluruhanAtlet= 0;

            foreach ($result as $row){
                $jumlahKeseluruhanAtlet = $row['JUMLAH'];
            }

            // Atlet Jumlah END
          ?>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$jumlahKeseluruhanAtlet?></h3>

              <p><?=GeneralLabel::atlet?></p>
            </div>
            <div class="icon">
              <i class="ion ion-android-bicycle"></i>
            </div>
            <a href="#" class="small-box-footer"><!--Maklumat lanjut <i class="fa fa-arrow-circle-right"></i>--></a>
          </div>
        </div>
        <!-- ./col -->
        <?php
                                
            // Atlet Paralimik Jumlah START

            $command = $connection->createCommand('
                SELECT COUNT(*) as JUMLAH FROM tbl_atlet WHERE cacat=1', [':year' => date("Y")]);

            $result = $command->queryAll();

            $jumlahKeseluruhanAtletPara= 0;

            foreach ($result as $row){
                $jumlahKeseluruhanAtletPara = $row['JUMLAH'];
            }

            // Atlet Paralimik Jumlah END
          ?>
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <!--<h3>4<sup style="font-size: 20px">%</sup></h3>-->
                <h3><?=$jumlahKeseluruhanAtletPara?></h3>

              <p><?=GeneralLabel::atlet . " (". GeneralLabel::paralimpik . ")"?></p>
            </div>
            <div class="icon">
              <i class="ion-ios-color-filter"></i>
            </div>
            <a href="#" class="small-box-footer"><!--Maklumat lanjut <i class="fa fa-arrow-circle-right"></i>--></a>
          </div>
        </div>
      </div>
          <?php endif; ?>
          <!-- Atlet ISN - END -->
          
          
          
          <!-- Atlet Podium - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['dashboard-isn']['module']) && isset(Yii::$app->user->identity->peranan_akses['ISN']['dashboard-isn']['atlet-podium'])): ?>
          
          <?php
            // Kumpulan Sukan START
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            $command = $connection->createCommand('
                SELECT *, 
                SUM(final.SUB_JUMLAH) AS JUMLAH,
                IFNULL((SUM(final.SUB_JUMLAH) / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS SUB_JUMLAH,
                    (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM,
                    (SELECT (SELECT r.desc FROM tbl_ref_cawangan r WHERE r.id = ass.cawangan) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS CAWANGAN,
                    (SELECT ass.cawangan FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS CAWANGAN_ID,
                    ( SELECT SUM(inner1.JUMLAH) FROM
			(SELECT COUNT(*) AS JUMLAH,
			    (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = att.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM
			    FROM `tbl_atlet` att 
			    GROUP BY PROGRAM) inner1 
			    WHERE inner1.PROGRAM LIKE "%Podium%" ) AS JUMLAH_KESELURUHAN
                    FROM `tbl_atlet` a 
                    GROUP BY CAWANGAN_ID,PROGRAM
                ) final 
                WHERE final.PROGRAM LIKE "%Podium%"
                GROUP BY final.CAWANGAN_ID', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataAtletPodiumCawangan = array();
            $jumlahKeseluruhanAtletPodiumCawangan= 0;
            
            foreach ($result as $row){
                $chartDataAtletPodiumCawangan[] = [$row['JUMLAH'] . ' - ' . $row['CAWANGAN'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanAtletPodiumCawangan= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataAtletPodiumCawangan);
            
            // Kumpulan Sukan END
            
            
            // Negeri START
            $command = $connection->createCommand('
                SELECT *, 
                SUM(final.SUB_JUMLAH) AS JUMLAH,
                IFNULL((SUM(final.SUB_JUMLAH) / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS SUB_JUMLAH,
                    (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM,
                    (SELECT (SELECT r.desc FROM tbl_ref_negeri r WHERE r.id = ass.negeri_diwakili) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS NEGERI,
                    (SELECT ass.negeri_diwakili FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS NEGERI_ID,
                    ( SELECT SUM(inner1.JUMLAH) FROM
			(SELECT COUNT(*) AS JUMLAH,
			    (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = att.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM
			    FROM `tbl_atlet` att 
			    GROUP BY PROGRAM) inner1 
			    WHERE inner1.PROGRAM LIKE "%Podium%" ) AS JUMLAH_KESELURUHAN
                    FROM `tbl_atlet` a 
                    GROUP BY NEGERI_ID,PROGRAM
                ) final 
                WHERE final.PROGRAM LIKE "%Podium%"
                GROUP BY final.NEGERI_ID', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataAtletPodiumNegeri = array();
            $jumlahKeseluruhanAtletPodiumNegeri = 0;
            
            foreach ($result as $row){
                $chartDataAtletPodiumNegeri[] = [$row['JUMLAH'] . ' - ' . $row['NEGERI'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanAtletPodiumNegeri= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataAtletPodiumNegeri);
            
            // Negeri END
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::atlet_podium?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#podium_atlet_sukan_negeri-chart" data-toggle="tab"><?=GeneralLabel::sukan?> & <?=GeneralLabel::negeri?></a></li>
                    <li><a href="#podium_atlet_acara-chart" data-toggle="tab"><?=GeneralLabel::acara?></a></li>
                    <li class="pull-left header"><?=GeneralLabel::statistik?></li>
                  </ul>
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="podium_atlet_sukan_negeri-chart" style="position: relative;">
                        <center><h3><?=GeneralLabel::jumlah_untuk_keseluruhan?></h3></center>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if($chartDataAtletPodiumCawangan){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::kumpulan_sukan],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataAtletPodiumCawangan,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> (<?=GeneralLabel::atlet?>) : <?=$jumlahKeseluruhanAtletPodiumCawangan?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if($chartDataAtletPodiumNegeri){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::negeri_diwakili],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataAtletPodiumNegeri,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> (<?=GeneralLabel::atlet?>) : <?=$jumlahKeseluruhanAtletPodiumNegeri?></strong>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-8">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                // Atlet Podium Mengikut Sukan  START
                                $command = $connection->createCommand('
                                    SELECT *, 
                                    SUM(final.SUB_JUMLAH) AS JUMLAH,
                                    IFNULL((SUM(final.SUB_JUMLAH) / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS SUB_JUMLAH,
                                        (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM,
                                        (SELECT (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = ass.nama_sukan) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS SUKAN,
                                        (SELECT ass.nama_sukan FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS SUKAN_ID,
                                        ( SELECT SUM(inner1.JUMLAH) FROM
                                            (SELECT COUNT(*) AS JUMLAH,
                                                (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = att.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM
                                                FROM `tbl_atlet` att 
                                                GROUP BY PROGRAM) inner1 
                                                WHERE inner1.PROGRAM LIKE "%Podium%" ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_atlet` a 
                                        GROUP BY SUKAN_ID,PROGRAM
                                    ) final 
                                    WHERE final.PROGRAM LIKE "%Podium%"
                                    GROUP BY final.SUKAN_ID ', [':year' => date("Y")]);

                                $result = $command->queryAll();
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($result as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Atlet Podium Mengikut Sukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> (<?=GeneralLabel::atlet?>) : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                            <div class="col-lg-2">
                            </div>
                        </div>  
                    </div>
                    <div class="chart tab-pane" id="podium_atlet_acara-chart" style="position: relative;">
                        <center><h3><?=GeneralLabel::jumlah_untuk_keseluruhan?></h3></center>
                        <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-8">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_acara?></strong>
                                </p>
                                <?php
                                // Atlet Podium Mengikut Acara  START
                                $command = $connection->createCommand('
                                    SELECT *,
                                  IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                  FROM
                                  (
                                    SELECT COUNT(*) AS JUMLAH,
                                    (SELECT r.desc FROM tbl_ref_acara r WHERE r.id = main_ass.acara) AS ACARA,
                                    (SELECT COUNT(*) FROM tbl_atlet_sukan ass
					    LEFT JOIN tbl_atlet a ON a.atlet_id = ass.atlet_id 
					    LEFT JOIN tbl_ref_program_semasa_sukan_atlet rp ON rp.id = ass.program_semasa
					    WHERE rp.desc LIKE "%Podium%") AS JUMLAH_KESELURUHAN
                                    FROM tbl_atlet_sukan main_ass
                                    LEFT JOIN tbl_atlet main_a ON main_a.atlet_id = main_ass.atlet_id 
                                    LEFT JOIN tbl_ref_program_semasa_sukan_atlet main_rp ON main_rp.id = main_ass.program_semasa
                                    WHERE main_rp.desc LIKE "%Podium%"
                                    GROUP BY main_ass.acara) final 
                                    ORDER BY PERATUS DESC ', [':year' => date("Y")]);

                                $result = $command->queryAll();
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($result as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['ACARA'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Atlet Podium Mengikut Sukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                            <div class="col-lg-2">
                            </div>
                        </div>  
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          
          
          <?php
            // Kumpulan Sukan START
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            $command = $connection->createCommand('
                SELECT *, 
                SUM(final.SUB_JUMLAH) AS JUMLAH,
                IFNULL((SUM(final.SUB_JUMLAH) / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS SUB_JUMLAH,
                    (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM,
                    (SELECT (SELECT r.desc FROM tbl_ref_cawangan r WHERE r.id = ass.cawangan) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS CAWANGAN,
                    (SELECT ass.cawangan FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS CAWANGAN_ID,
                    ( SELECT SUM(inner1.JUMLAH) FROM
			(SELECT COUNT(*) AS JUMLAH,
			    (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = att.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM
			    FROM `tbl_atlet` att 
			    GROUP BY PROGRAM) inner1 
			    WHERE inner1.PROGRAM LIKE "%Podium%" ) AS JUMLAH_KESELURUHAN
                    FROM `tbl_atlet` a 
                    GROUP BY CAWANGAN_ID,PROGRAM
                ) final 
                WHERE final.PROGRAM LIKE "%Podium%"
                GROUP BY final.CAWANGAN_ID', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataAtletPodiumCawangan = array();
            $jumlahKeseluruhanAtletPodiumCawangan= 0;
            
            foreach ($result as $row){
                $chartDataAtletPodiumCawangan[] = [$row['JUMLAH'] . ' - ' . $row['CAWANGAN'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanAtletPodiumCawangan= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataAtletPodiumCawangan);
            
            // Kumpulan Sukan END
            
            
            // Negeri START
            $command = $connection->createCommand('
                SELECT *, 
                SUM(final.SUB_JUMLAH) AS JUMLAH,
                IFNULL((SUM(final.SUB_JUMLAH) / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS SUB_JUMLAH,
                    (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM,
                    (SELECT (SELECT r.desc FROM tbl_ref_negeri r WHERE r.id = ass.negeri_diwakili) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS NEGERI,
                    (SELECT ass.negeri_diwakili FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS NEGERI_ID,
                    ( SELECT SUM(inner1.JUMLAH) FROM
			(SELECT COUNT(*) AS JUMLAH,
			    (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = att.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM
			    FROM `tbl_atlet` att 
			    GROUP BY PROGRAM) inner1 
			    WHERE inner1.PROGRAM LIKE "%Podium%" ) AS JUMLAH_KESELURUHAN
                    FROM `tbl_atlet` a 
                    GROUP BY NEGERI_ID,PROGRAM
                ) final 
                WHERE final.PROGRAM LIKE "%Podium%"
                GROUP BY final.NEGERI_ID', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataAtletPodiumNegeri = array();
            $jumlahKeseluruhanAtletPodiumNegeri = 0;
            
            foreach ($result as $row){
                $chartDataAtletPodiumNegeri[] = [$row['JUMLAH'] . ' - ' . $row['NEGERI'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanAtletPodiumNegeri= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataAtletPodiumNegeri);
            
            // Negeri END
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::atlet_podium?> (<?=GeneralLabel::paralimpik?>)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#podium_atlet_para_sukan-chart" data-toggle="tab"><?=GeneralLabel::sukan?></a></li>
                    <li><a href="#podium_atlet_para_acara-chart" data-toggle="tab"><?=GeneralLabel::acara?></a></li>
                    <li class="pull-left header"><?=GeneralLabel::statistik?></li>
                  </ul>
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="podium_atlet_para_sukan-chart" style="position: relative;">
                        <center><h3><?=GeneralLabel::jumlah_untuk_keseluruhan?></h3></center>
                        <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-8">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                // Atlet Podium Paralimpik Mengikut Sukan  START
                                $command = $connection->createCommand('
                                    SELECT *, 
                                    SUM(final.SUB_JUMLAH) AS JUMLAH,
                                    IFNULL((SUM(final.SUB_JUMLAH) / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS SUB_JUMLAH,
                                        (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM,
                                        (SELECT (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = ass.nama_sukan) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS SUKAN,
                                        (SELECT ass.nama_sukan FROM tbl_atlet_sukan ass WHERE ass.atlet_id = a.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS SUKAN_ID,
                                        ( SELECT SUM(inner1.JUMLAH) FROM
                                            (SELECT COUNT(*) AS JUMLAH,
                                                (SELECT (SELECT r.desc FROM tbl_ref_program_semasa_sukan_atlet r WHERE r.id = ass.program_semasa) FROM tbl_atlet_sukan ass WHERE ass.atlet_id = att.atlet_id ORDER BY ass.tarikh_mula_menyertai_program_msn DESC LIMIT 1 ) AS PROGRAM
                                                FROM `tbl_atlet` att 
                                                WHERE att.cacat = 1
                                                GROUP BY PROGRAM) inner1 
                                                WHERE inner1.PROGRAM LIKE "%Podium%" ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_atlet` a 
                                        WHERE a.cacat = 1
                                        GROUP BY SUKAN_ID,PROGRAM
                                    ) final 
                                    WHERE final.PROGRAM LIKE "%Podium%"
                                    GROUP BY final.SUKAN_ID ', [':year' => date("Y")]);

                                $result = $command->queryAll();
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($result as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Atlet Podium Paralimpik Mengikut Sukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> (<?=GeneralLabel::atlet?>) : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                            <div class="col-lg-2">
                            </div>
                        </div>  
                    </div>
                    <div class="chart tab-pane" id="podium_atlet_para_acara-chart" style="position: relative;">
                        <center><h3><?=GeneralLabel::jumlah_untuk_keseluruhan?></h3></center>
                        <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-8">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_acara?></strong>
                                </p>
                                <?php
                                // Atlet Podium Paralimpik Mengikut Acara  START
                                $command = $connection->createCommand('
                                    SELECT *,
                                  IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                  FROM
                                  (
                                    SELECT COUNT(*) AS JUMLAH,
                                    (SELECT r.desc FROM tbl_ref_acara r WHERE r.id = main_ass.acara) AS ACARA,
                                    (SELECT COUNT(*) FROM tbl_atlet_sukan ass
					    LEFT JOIN tbl_atlet a ON a.atlet_id = ass.atlet_id 
					    LEFT JOIN tbl_ref_program_semasa_sukan_atlet rp ON rp.id = ass.program_semasa
					    WHERE rp.desc LIKE "%Podium%" AND a.cacat = 1) AS JUMLAH_KESELURUHAN
                                    FROM tbl_atlet_sukan main_ass
                                    LEFT JOIN tbl_atlet main_a ON main_a.atlet_id = main_ass.atlet_id 
                                    LEFT JOIN tbl_ref_program_semasa_sukan_atlet main_rp ON main_rp.id = main_ass.program_semasa
                                    WHERE main_rp.desc LIKE "%Podium%" AND main_a.cacat = 1
                                    GROUP BY main_ass.acara) final 
                                    ORDER BY PERATUS DESC ', [':year' => date("Y")]);

                                $result = $command->queryAll();
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($result as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['ACARA'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Atlet Podium Mengikut Sukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                            <div class="col-lg-2">
                            </div>
                        </div>  
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- Atlet Podium - END -->
          
          
          
          
          
          
          
          <!-- Temujanji Atlet - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['dashboard-isn']['module']) && isset(Yii::$app->user->identity->peranan_akses['ISN']['dashboard-isn']['temujanji-atlet'])): ?>
          
          <?php
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
          ?>
          
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::temujanji_atlet?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#temujanji_atlet_keseluruhan-chart" data-toggle="tab"><?=GeneralLabel::keseluruhan?></a></li>
                    <li><a href="#temujanji_atlet_tahun-chart" data-toggle="tab"><?=GeneralLabel::tahun?> <?=date('Y')?></a></li>
                    <li><a href="#temujanji_atlet_bulan-chart" data-toggle="tab"><?=GeneralLabel::bulan?> <?=GeneralFunction::getMonthWord(date('Y-m-d'))?></a></li>
                    <li class="pull-left header"><?=GeneralLabel::statistik?></li>
                  </ul>
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="temujanji_atlet_keseluruhan-chart" style="position: relative;">
                        <center><h3><?=GeneralLabel::jumlah_untuk_keseluruhan?></h3></center>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Temnjanji Atlet Jenis Temujanji Keseluruhan START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                        IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                        FROM
                                        (
                                            SELECT COUNT(*) AS JUMLAH,
                                            (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_jenis_temujanji_pesakit_luar r WHERE r.id = p.makmal_perubatan) AS JENIS_TEMUJANJI,
                                            (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe) AS JUMLAH_KESELURUHAN
                                            FROM `tbl_pl_temujanji` p
                                            GROUP BY p.makmal_perubatan
                                        ) final 
                                        ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultTemujanjiAtletJenisTemujanjiOVERALL = $command->queryAll();

                                    $chartDataTemujanjiAtletJenisTemujanjiOVERALL = array();
                                    $jumlahKeseluruhanTemujanjiAtletJenisTemujanjiOVERALL = 0;

                                    foreach ($resultTemujanjiAtletJenisTemujanjiOVERALL as $row){
                                        $chartDataTemujanjiAtletJenisTemujanjiOVERALL[] = [$row['JUMLAH'] . ' - ' . $row['JENIS_TEMUJANJI'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanTemujanjiAtletJenisTemujanjiOVERALL= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Temnjanji Atlet Jenis Temujanji Keseluruhan - END
            
                                if($chartDataTemujanjiAtletJenisTemujanjiOVERALL){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::jenis_temujanji],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataTemujanjiAtletJenisTemujanjiOVERALL,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanTemujanjiAtletJenisTemujanjiOVERALL?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                
                                // Temnjanji Atlet Jenis Temujanji Keseluruhan START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_status_temujanji_pesakit_luar r WHERE r.id = p.status_temujanji) AS STATUS_TEMUJANJI,
                                        (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_pl_temujanji` p
                                        GROUP BY p.status_temujanji
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultTemujanjiAtletStatusTemujanjiOVERALL = $command->queryAll();

                                    $chartDataTemujanjiAtletStatusTemujanjiOVERALL = array();
                                    $jumlahKeseluruhanTemujanjiAtletStatusTemujanjiOVERALL = 0;

                                    foreach ($resultTemujanjiAtletStatusTemujanjiOVERALL as $row){
                                        $chartDataTemujanjiAtletStatusTemujanjiOVERALL[] = [$row['JUMLAH'] . ' - ' . $row['STATUS_TEMUJANJI'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanTemujanjiAtletStatusTemujanjiOVERALL= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Temnjanji Atlet Jenis Temujanji Keseluruhan - END
            
                                if($chartDataTemujanjiAtletStatusTemujanjiOVERALL){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::status_temujanji],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataTemujanjiAtletStatusTemujanjiOVERALL,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanTemujanjiAtletStatusTemujanjiOVERALL?></strong>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Temnjanji Atlet Kehadiran Keseluruhan START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_kelulusan r WHERE r.id = p.kehadiran_pesakit) AS KEHADIRAN,
                                        (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_pl_temujanji` p
                                        GROUP BY p.kehadiran_pesakit
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultTemujanjiAtletKehadiranOVERALL = $command->queryAll();

                                    $chartDataTemujanjiAtletKehadiranOVERALL = array();
                                    $jumlahKeseluruhanTemujanjiAtletKehadiranOVERALL = 0;

                                    foreach ($resultTemujanjiAtletKehadiranOVERALL as $row){
                                        $chartDataTemujanjiAtletKehadiranOVERALL[] = [$row['JUMLAH'] . ' - ' . $row['KEHADIRAN'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanTemujanjiAtletKehadiranOVERALL= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Temnjanji Atlet Kehadiran Keseluruhan - END
            
                                if($chartDataTemujanjiAtletKehadiranOVERALL){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::kehadiran],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataTemujanjiAtletKehadiranOVERALL,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanTemujanjiAtletKehadiranOVERALL?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                
                                // Temnjanji Atlet Sukan Keseluruhan START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = p.jenis_sukan) AS SUKAN,
                                        (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe  ) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_pl_temujanji` p
                                        GROUP BY p.jenis_sukan
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultTemujanjiAtletSukanOVERALL = $command->queryAll();
                                    
                                    // Temnjanji Atlet Sukan Keseluruhan - END
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($resultTemujanjiAtletSukanOVERALL as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="temujanji_atlet_tahun-chart" style="position: relative;">
                        <center><h3><?=GeneralLabel::jumlah_bagi_tahun?> <?=date('Y')?></h3></center>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Temnjanji Atlet Jenis Temujanji Tahun START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                        IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                        FROM
                                        (
                                            SELECT COUNT(*) AS JUMLAH,
                                            (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_jenis_temujanji_pesakit_luar r WHERE r.id = p.makmal_perubatan) AS JENIS_TEMUJANJI,
                                            (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe WHERE YEAR(pe.tarikh_temujanji) = :year ) AS JUMLAH_KESELURUHAN
                                            FROM `tbl_pl_temujanji` p
                                            WHERE YEAR(p.tarikh_temujanji) = :year
                                            GROUP BY p.makmal_perubatan
                                        ) final 
                                        ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultTemujanjiAtletJenisTemujanjiYEAR = $command->queryAll();

                                    $chartDataTemujanjiAtletJenisTemujanjiYEAR = array();
                                    $jumlahKeseluruhanTemujanjiAtletJenisTemujanjiYEAR = 0;

                                    foreach ($resultTemujanjiAtletJenisTemujanjiYEAR as $row){
                                        $chartDataTemujanjiAtletJenisTemujanjiYEAR[] = [$row['JUMLAH'] . ' - ' . $row['JENIS_TEMUJANJI'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanTemujanjiAtletJenisTemujanjiYEAR= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Temnjanji Atlet Jenis Temujanji Tahun - END
            
                                if($chartDataTemujanjiAtletJenisTemujanjiYEAR){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::jenis_temujanji],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataTemujanjiAtletJenisTemujanjiYEAR,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanTemujanjiAtletJenisTemujanjiYEAR?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                
                                // Temnjanji Atlet Jenis Temujanji Tahun START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_status_temujanji_pesakit_luar r WHERE r.id = p.status_temujanji) AS STATUS_TEMUJANJI,
                                        (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe WHERE YEAR(pe.tarikh_temujanji) = :year) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_pl_temujanji` p 
                                        WHERE YEAR(p.tarikh_temujanji) = :year
                                        GROUP BY p.status_temujanji
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultTemujanjiAtletStatusTemujanjiYEAR = $command->queryAll();

                                    $chartDataTemujanjiAtletStatusTemujanjiYEAR = array();
                                    $jumlahKeseluruhanTemujanjiAtletStatusTemujanjiYEAR = 0;

                                    foreach ($resultTemujanjiAtletStatusTemujanjiYEAR as $row){
                                        $chartDataTemujanjiAtletStatusTemujanjiYEAR[] = [$row['JUMLAH'] . ' - ' . $row['STATUS_TEMUJANJI'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanTemujanjiAtletStatusTemujanjiYEAR= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Temnjanji Atlet Jenis Temujanji Tahun - END
            
                                if($chartDataTemujanjiAtletStatusTemujanjiYEAR){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::status_temujanji],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataTemujanjiAtletStatusTemujanjiYEAR,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanTemujanjiAtletStatusTemujanjiYEAR?></strong>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Temnjanji Atlet Kehadiran Tahun START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_kelulusan r WHERE r.id = p.kehadiran_pesakit) AS KEHADIRAN,
                                        (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe WHERE YEAR(pe.tarikh_temujanji) = :year) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_pl_temujanji` p 
                                        WHERE YEAR(p.tarikh_temujanji) = :year
                                        GROUP BY p.kehadiran_pesakit
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultTemujanjiAtletKehadiranYEAR = $command->queryAll();

                                    $chartDataTemujanjiAtletKehadiranYEAR = array();
                                    $jumlahKeseluruhanTemujanjiAtletKehadiranYEAR = 0;

                                    foreach ($resultTemujanjiAtletKehadiranYEAR as $row){
                                        $chartDataTemujanjiAtletKehadiranYEAR[] = [$row['JUMLAH'] . ' - ' . $row['KEHADIRAN'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanTemujanjiAtletKehadiranYEAR= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Temnjanji Atlet Kehadiran Tahun - END
            
                                if($chartDataTemujanjiAtletKehadiranYEAR){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::kehadiran],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataTemujanjiAtletKehadiranYEAR,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanTemujanjiAtletKehadiranYEAR?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                
                                // Temnjanji Atlet Sukan Tahun START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = p.jenis_sukan) AS SUKAN,
                                        (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe  WHERE YEAR(pe.tarikh_temujanji) = :year) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_pl_temujanji` p 
                                        WHERE YEAR(p.tarikh_temujanji) = :year
                                        GROUP BY p.jenis_sukan
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                    $resultTemujanjiAtletSukanYEAR = $command->queryAll();
                                    
                                    // Temnjanji Atlet Sukan Tahun - END
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($resultTemujanjiAtletSukanYEAR as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="temujanji_atlet_bulan-chart" style="position: relative;">
                        <center><h3><?=GeneralLabel::jumlah_bagi_bulan?> <?=GeneralFunction::getMonthWord(date('Y-m-d'),2)?></h3></center>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Temnjanji Atlet Jenis Temujanji Bulan START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                        IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                        FROM
                                        (
                                            SELECT COUNT(*) AS JUMLAH,
                                            (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_jenis_temujanji_pesakit_luar r WHERE r.id = p.makmal_perubatan) AS JENIS_TEMUJANJI,
                                            (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe WHERE YEAR(pe.tarikh_temujanji) = :year AND MONTH(pe.tarikh_temujanji) = :month) AS JUMLAH_KESELURUHAN
                                            FROM `tbl_pl_temujanji` p
                                            WHERE YEAR(p.tarikh_temujanji) = :year AND MONTH(p.tarikh_temujanji) = :month
                                            GROUP BY p.makmal_perubatan
                                        ) final 
                                        ORDER BY PERATUS DESC', [':year' => date("Y"), ':month' => date("m")]);

                                    $resultTemujanjiAtletJenisTemujanjiMONTH = $command->queryAll();

                                    $chartDataTemujanjiAtletJenisTemujanjiMONTH = array();
                                    $jumlahKeseluruhanTemujanjiAtletJenisTemujanjiMONTH = 0;

                                    foreach ($resultTemujanjiAtletJenisTemujanjiMONTH as $row){
                                        $chartDataTemujanjiAtletJenisTemujanjiMONTH[] = [$row['JUMLAH'] . ' - ' . $row['JENIS_TEMUJANJI'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanTemujanjiAtletJenisTemujanjiMONTH= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Temnjanji Atlet Jenis Temujanji Bulan - END
            
                                if($chartDataTemujanjiAtletJenisTemujanjiMONTH){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::jenis_temujanji],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataTemujanjiAtletJenisTemujanjiMONTH,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanTemujanjiAtletJenisTemujanjiMONTH?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                
                                // Temnjanji Atlet Jenis Temujanji Bulan START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_status_temujanji_pesakit_luar r WHERE r.id = p.status_temujanji) AS STATUS_TEMUJANJI,
                                        (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe WHERE YEAR(pe.tarikh_temujanji) = :year AND MONTH(pe.tarikh_temujanji) = :month) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_pl_temujanji` p 
                                        WHERE YEAR(p.tarikh_temujanji) = :year AND MONTH(p.tarikh_temujanji) = :month
                                        GROUP BY p.status_temujanji
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y"), ':month' => date("m")]);

                                    $resultTemujanjiAtletStatusTemujanjiMONTH = $command->queryAll();

                                    $chartDataTemujanjiAtletStatusTemujanjiMONTH = array();
                                    $jumlahKeseluruhanTemujanjiAtletStatusTemujanjiMONTH = 0;

                                    foreach ($resultTemujanjiAtletStatusTemujanjiMONTH as $row){
                                        $chartDataTemujanjiAtletStatusTemujanjiMONTH[] = [$row['JUMLAH'] . ' - ' . $row['STATUS_TEMUJANJI'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanTemujanjiAtletStatusTemujanjiMONTH = $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Temnjanji Atlet Jenis Temujanji Bulan - END
            
                                if($chartDataTemujanjiAtletStatusTemujanjiMONTH){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::status_temujanji],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataTemujanjiAtletStatusTemujanjiMONTH,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanTemujanjiAtletStatusTemujanjiMONTH?></strong>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                
                                // Temnjanji Atlet Kehadiran Bulan START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_kelulusan r WHERE r.id = p.kehadiran_pesakit) AS KEHADIRAN,
                                        (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe WHERE YEAR(pe.tarikh_temujanji) = :year AND MONTH(pe.tarikh_temujanji) = :month) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_pl_temujanji` p 
                                        WHERE YEAR(p.tarikh_temujanji) = :year AND MONTH(p.tarikh_temujanji) = :month
                                        GROUP BY p.kehadiran_pesakit
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y"), ':month' => date("m")]);

                                    $resultTemujanjiAtletKehadiranMONTH = $command->queryAll();

                                    $chartDataTemujanjiAtletKehadiranMONTH = array();
                                    $jumlahKeseluruhanTemujanjiAtletKehadiranMONTH = 0;

                                    foreach ($resultTemujanjiAtletKehadiranMONTH as $row){
                                        $chartDataTemujanjiAtletKehadiranMONTH[] = [$row['JUMLAH'] . ' - ' . $row['KEHADIRAN'],  (double)$row['PERATUS']];
                                        $jumlahKeseluruhanTemujanjiAtletKehadiranMONTH= $row['JUMLAH_KESELURUHAN'];
                                    }
                                    // Temnjanji Atlet Kehadiran Bulan - END
            
                                if($chartDataTemujanjiAtletKehadiranMONTH){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::kehadiran],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataTemujanjiAtletKehadiranMONTH,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanTemujanjiAtletKehadiranMONTH?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                
                                // Temnjanji Atlet Sukan Bulan START
                                    $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = p.jenis_sukan) AS SUKAN,
                                        (SELECT COUNT(*) FROM `tbl_pl_temujanji` pe  WHERE YEAR(pe.tarikh_temujanji) = :year AND MONTH(pe.tarikh_temujanji) = :month) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_pl_temujanji` p 
                                        WHERE YEAR(p.tarikh_temujanji) = :year AND MONTH(p.tarikh_temujanji) = :month
                                        GROUP BY p.jenis_sukan
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y"), ':month' => date("m")]);

                                    $resultTemujanjiAtletSukanMONTH = $command->queryAll();
                                    
                                    // Temnjanji Atlet Sukan Bulan - END
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($resultTemujanjiAtletSukanMONTH as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          
          <?php endif; ?>
          <!-- Temujanji Atlet - END -->
          
          
          
          
          
          
          <!-- Jurulatih Berdaftar AKK - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['dashboard-isn']['module']) && isset(Yii::$app->user->identity->peranan_akses['ISN']['dashboard-isn']['jurulatih-berdaftar'])): ?>
          
          <?php
            // Jenis Sukan START
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            // Jurulatih Berdaftar Mengikut Sukan Keseluruhan START
            $command = $connection->createCommand('
            SELECT *,
            IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
            FROM
            (
                SELECT COUNT(*) AS JUMLAH,
                (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = p.jenis_sukan) AS SUKAN,
                (SELECT COUNT(*) FROM tbl_akademi_akk pe) AS JUMLAH_KESELURUHAN
                FROM `tbl_akademi_akk` p
                GROUP BY p.jenis_sukan
            ) final 
            ORDER BY PERATUS DESC', [':year' => date("Y")]);

            $resultOVERALL = $command->queryAll();
            
            $chartDataJurulatihBerdaftarSukanOVERALL = array();
            $jumlahKeseluruhanJurulatihBerdaftarSukanOVERALL= 0;
            
            foreach ($resultOVERALL as $row){
                $chartDataJurulatihBerdaftarSukanOVERALL[] = [$row['JUMLAH'] . ' - ' . $row['SUKAN'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanJurulatihBerdaftarSukanOVERALL= $row['JUMLAH_KESELURUHAN'];
            }
            // Jurulatih Berdaftar Mengikut Sukan Keseluruhan END
            
           
            // Jurulatih Berdaftar Mengikut Sukan Tahun START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = p.jenis_sukan) AS SUKAN,
                    (SELECT COUNT(*) FROM tbl_akademi_akk pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_akademi_akk` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.jenis_sukan
                ) final 
                ORDER BY PERATUS DESC', [':year' => date("Y")]);

            $resultYEAR = $command->queryAll();
            
            $chartDataJurulatihBerdaftarSukanYEAR = array();
            $jumlahKeseluruhanJurulatihBerdaftarSukanYEAR= 0;
            
            foreach ($resultYEAR as $row){
                $chartDataJurulatihBerdaftarSukanYEAR[] = [$row['JUMLAH'] . ' - ' . $row['SUKAN'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanJurulatihBerdaftarSukanYEAR= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataJurulatihBerdaftarSukanYEAR);
            
            // Jurulatih Berdaftar Mengikut Sukan Tahun END
            
            
            // Jurulatih Berdaftar Mengikut Sukan Tahun START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = p.jenis_sukan) AS SUKAN,
                    (SELECT COUNT(*) FROM tbl_akademi_akk pe WHERE YEAR(pe.created) = :year AND MONTH(pe.created) = :month) AS JUMLAH_KESELURUHAN
                    FROM `tbl_akademi_akk` p
                    WHERE YEAR(p.created) = :year AND MONTH(p.created) = :month
                    GROUP BY p.jenis_sukan
                ) final 
                ORDER BY PERATUS DESC', [':year' => date("Y"),':month' => date("m")]);

            $resultMONTH = $command->queryAll();
            
            $chartDataJurulatihBerdaftarSukanMONTH = array();
            $jumlahKeseluruhanJurulatihBerdaftarSukanMONTH = 0;
            
            foreach ($resultMONTH as $row){
                $chartDataJurulatihBerdaftarSukanMONTH[] = [$row['JUMLAH'] . ' - ' . $row['SUKAN'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanJurulatihBerdaftarSukanMONTH= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataJurulatihBerdaftarSukanYEAR);
            
            // Jurulatih Berdaftar Mengikut Sukan Tahun END
            
            
          ?>
          
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::jurulatih_berdaftar?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#jurulatih_berdaftar_keseluruhan-chart" data-toggle="tab"><?=GeneralLabel::keseluruhan?></a></li>
                    <li><a href="#jurulatih_berdaftar_tahun-chart" data-toggle="tab"><?=GeneralLabel::tahun?>  <?=date('Y')?></a></li>
                    <li><a href="#jurulatih_berdaftar_bulan-chart" data-toggle="tab"><?=GeneralLabel::bulan?>  <?=GeneralFunction::getMonthWord(date('Y-m-d'))?></a></li>
                    <li class="pull-left header"><?=GeneralLabel::statistik?></li>
                  </ul>
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="jurulatih_berdaftar_keseluruhan-chart" style="position: relative;">
                        <center><h3><?=GeneralLabel::jumlah_untuk_keseluruhan?></h3></center>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if($chartDataJurulatihBerdaftarSukanOVERALL){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::sukan],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataJurulatihBerdaftarSukanOVERALL,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanJurulatihBerdaftarSukanOVERALL?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($resultOVERALL as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="jurulatih_berdaftar_tahun-chart" style="position: relative;">
                        <center><h3><?=GeneralLabel::jumlah_bagi_tahun?> <?=date('Y')?></h3></center>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if($chartDataJurulatihBerdaftarSukanYEAR){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::sukan],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataJurulatihBerdaftarSukanYEAR,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanJurulatihBerdaftarSukanYEAR?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($resultYEAR as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Atlet Podium Mengikut Sukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="jurulatih_berdaftar_bulan-chart" style="position: relative;">
                        <center><h3><?=GeneralLabel::jumlah_bagi_bulan?> <?=GeneralFunction::getMonthWord(date('Y-m-d'),2)?></h3></center>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if($chartDataJurulatihBerdaftarSukanMONTH){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::sukan],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataJurulatihBerdaftarSukanMONTH,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanJurulatihBerdaftarSukanMONTH?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_sukan?></strong>
                                </p>
                                <?php
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($resultMONTH as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Atlet Podium Mengikut Sukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          
          <?php endif; ?>
          <!-- Jurulatih Berdaftar AKK - END -->
          
          
          
          
          <!-- PJS - Badan Sukan - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['dashboard-pjs']['module']) && isset(Yii::$app->user->identity->peranan_akses['PJS']['dashboard-pjs']['badan-sukan'])): ?>
          
          <?php
            // Peringkat START
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.desc FROM tbl_ref_peringkat_badan_sukan r WHERE r.id = p.peringkat_badan_sukan) AS PERINGKAT,
                    (SELECT COUNT(*) FROM tbl_profil_badan_sukan pe WHERE YEAR(pe.tarikh_lulus_pendaftaran) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_profil_badan_sukan` p
                    WHERE YEAR(p.tarikh_lulus_pendaftaran) = :year
                    GROUP BY p.peringkat_badan_sukan
                ) final ', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataBadanSukanPeringkat = array();
            $jumlahKeseluruhanBadanSukanPeringkat = 0;
            
            foreach ($result as $row){
                $chartDataBadanSukanPeringkat[] = [$row['JUMLAH'] . ' - ' . $row['PERINGKAT'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanBadanSukanPeringkat= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBadanSukanPeringkat);
            
            // Peringkat END
            
            
            // Negeri START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.desc FROM tbl_ref_negeri r WHERE r.id = p.alamat_tetap_badan_sukan_negeri) AS NEGERI,
                    (SELECT COUNT(*) FROM tbl_profil_badan_sukan pe WHERE YEAR(pe.tarikh_lulus_pendaftaran) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_profil_badan_sukan` p
                    WHERE YEAR(p.tarikh_lulus_pendaftaran) = :year
                    GROUP BY p.alamat_tetap_badan_sukan_negeri
                ) final ', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataBadanSukanNegeri = array();
            $jumlahKeseluruhanBadanSukanNegeri = 0;
            
            foreach ($result as $row){
                $chartDataBadanSukanNegeri[] = [$row['JUMLAH'] . ' - ' . $row['NEGERI'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanBadanSukanNegeri= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBadanSukanNegeri);
            
            // Negeri END
            
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::badan_sukan?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="badan_sukan_peringkat-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if($chartDataBadanSukanPeringkat){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::peringkat],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataBadanSukanPeringkat,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanBadanSukanPeringkat?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if($chartDataBadanSukanNegeri){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::negeri],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataBadanSukanNegeri,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanBadanSukanNegeri?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- PJS - Badan Sukan - END -->
          
          
          
          
          
          <!-- PJS - Penganjuran Acara Sukan - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['dashboard-pjs']['module']) && isset(Yii::$app->user->identity->peranan_akses['PJS']['dashboard-pjs']['penganjuran-acara-sukan'])): ?>
          
          <?php
            // Peringkat START
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.desc FROM tbl_ref_peringkat_badan_sukan r WHERE r.id = p.peringkat_sukan) AS PERINGKAT,
                    (SELECT COUNT(*) FROM tbl_paobs_penganjuran pe WHERE YEAR(pe.tarikh_aktiviti) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_paobs_penganjuran` p
                    WHERE YEAR(p.tarikh_aktiviti) = :year
                    GROUP BY p.peringkat_sukan
                ) final   ', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataPenganjuranAcaraSukanPeringkat = array();
            $jumlahKeseluruhanPenganjuranAcaraSukanPeringkat = 0;
            
            foreach ($result as $row){
                $chartDataPenganjuranAcaraSukanPeringkat[] = [$row['JUMLAH'] . ' - ' . $row['PERINGKAT'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanPenganjuranAcaraSukanPeringkat = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBadanSukanPeringkat);
            
            // Peringkat END
            
            
            // Negeri START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.desc FROM tbl_ref_negeri r WHERE r.id = p.alamat_lokasi_negeri) AS NEGERI,
                    (SELECT COUNT(*) FROM tbl_paobs_penganjuran pe WHERE YEAR(pe.tarikh_aktiviti) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_paobs_penganjuran` p
                    WHERE YEAR(p.tarikh_aktiviti) = :year
                    GROUP BY p.alamat_lokasi_negeri
                ) final    ', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataPenganjuranAcaraSukanNegeri = array();
            $jumlahKeseluruhanPenganjuranAcaraSukanNegeri = 0;
            
            foreach ($result as $row){
                $chartDataPenganjuranAcaraSukanNegeri[] = [$row['JUMLAH'] . ' - ' . $row['NEGERI'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanPenganjuranAcaraSukanNegeri= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataUniversiti);
            
            // Negeri END
            
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::penganjuran_acara_sukan?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="badan_sukan_peringkat-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if($chartDataPenganjuranAcaraSukanPeringkat){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::peringkat_sukan],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataPenganjuranAcaraSukanPeringkat,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanPenganjuranAcaraSukanPeringkat?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if($chartDataPenganjuranAcaraSukanNegeri){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::negeri],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataPenganjuranAcaraSukanNegeri,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanPenganjuranAcaraSukanNegeri?></strong>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-8">
                                <p class="text-center">
                                    <br>
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_mengikut_jenis_sukan?></strong>
                                </p>
                                <?php
                                // Penganjuran Acara Sukan Mengikut Jenis Sukan  START
                                $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT COUNT(*) AS JUMLAH,
                                        (SELECT r.desc FROM tbl_ref_sukan r WHERE r.id = p.jenis_sukan) AS JENIS_SUKAN,
                                        (SELECT COUNT(*) FROM tbl_paobs_penganjuran pe WHERE YEAR(pe.tarikh_aktiviti) = :year) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_paobs_penganjuran` p
                                        WHERE YEAR(p.tarikh_aktiviti) = :year
                                        GROUP BY p.jenis_sukan
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                $result = $command->queryAll();
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($result as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['JENIS_SUKAN'].'</span>
                                  <span class="progress-number"><b>'.$row['JUMLAH'].'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Bantuan Kategori Jumlah Peruntukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlah_keseluruhan?></strong>
                                </p>
                            </div>
                            <div class="col-lg-2">
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- PJS - Penganjuran Acara Sukan - END -->
          
          
          
          
          
          
          <!-- PJS - Latihan Dan Pendidikan Badan Sukan - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['dashboard-pjs']['module']) && isset(Yii::$app->user->identity->peranan_akses['PJS']['dashboard-pjs']['latihan-dan-pendidikan-badan-sukan'])): ?>
          
          <?php
            // Kategori Kursus START
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.desc FROM tbl_ref_kategori_kursus r WHERE r.id = p.kategori_kursus) AS KATEGORI,
                    (SELECT COUNT(*) FROM tbl_latihan_dan_program pe WHERE YEAR(pe.tarikh_kursus) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_latihan_dan_program` p
                    WHERE YEAR(p.tarikh_kursus) = :year
                    GROUP BY p.kategori_kursus
                ) final  ', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataLatihanDanPendidikanKategori = array();
            $jumlahKeseluruhanLatihanDanPendidikanKategori = 0;
            
            foreach ($result as $row){
                $chartDataLatihanDanPendidikanKategori[] = [$row['JUMLAH'] . ' - ' . $row['KATEGORI'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanLatihanDanPendidikanKategori= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataLatihanDanPendidikanKategori);
            
            // Kategori Kursus END
            
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::latihan_dan_pendidikan_badan_sukan?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="badan_sukan_peringkat-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if($chartDataLatihanDanPendidikanKategori){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::kategori_kursus],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataLatihanDanPendidikanKategori,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanLatihanDanPendidikanKategori?></strong>
                                </p>
                            </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- PJS - Latihan Dan Pendidikan Badan Sukan - END -->
          
          
          
          
          
          
          <!-- E-Biasiswa - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['dashboard-kbs']['module']) && isset(Yii::$app->user->identity->peranan_akses['KBS']['dashboard-kbs']['e-biasiswa'])): ?>
          
          <?php
            // Status START
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                        SELECT COUNT(*) AS JUMLAH,
                        (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_status_permohonan_e_biasiswa r WHERE r.id = p.status_permohonan) AS STATUS,
                        (SELECT COUNT(*) FROM tbl_permohonan_e_biasiswa pe WHERE YEAR(p.tarikh_permohonan) = :year) AS JUMLAH_KESELURUHAN
                        FROM `tbl_permohonan_e_biasiswa` p
                        WHERE YEAR(p.tarikh_permohonan) = :year
                        GROUP BY p.status_permohonan
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataBiasiswa = array();
            $jumlahKeseluruhanBiasiswa = 0;
            
            foreach ($result as $row){
                $chartDataBiasiswa[] = [$row['JUMLAH'] . ' - ' . $row['STATUS'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanBiasiswa= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBiasiswa);
            
            // Status END
            
            
            // Universiti START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.dashboard_desc FROM tbl_ref_universiti_institusi_e_biasiswa r WHERE r.id = p.universiti_institusi) AS UNIVERSITI,
                    (SELECT COUNT(*) FROM tbl_permohonan_e_biasiswa pe WHERE YEAR(p.tarikh_permohonan) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_permohonan_e_biasiswa` p
                    WHERE YEAR(p.tarikh_permohonan) = :year
                    GROUP BY p.universiti_institusi
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataUniversiti = array();
            $jumlahKeseluruhanUniversiti = 0;
            
            foreach ($result as $row){
                $chartDataUniversiti[] = [$row['JUMLAH'] . ' - ' . $row['UNIVERSITI'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanUniversiti= $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataUniversiti);
            
            // Universiti END
            
            
            // Program Pengajian START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_program_pengajian r WHERE r.id = p.program_pengajian) AS PROGRAM_PENGAJIAN,
                    (SELECT COUNT(*) FROM tbl_permohonan_e_biasiswa pe WHERE YEAR(p.tarikh_permohonan) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_permohonan_e_biasiswa` p
                    WHERE YEAR(p.tarikh_permohonan) = :year
                    GROUP BY p.program_pengajian
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataProgramPengajian = array();
            $jumlahKeseluruhanProgramPengajian = 0;
            
            foreach ($result as $row){
                $chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanProgramPengajian = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataProgramPengajian);
            
            // Program Pengajian END
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::ebiasiswa?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#status-program_pengajian-chart" data-toggle="tab"><?=GeneralLabel::status?> & <?=GeneralLabel::program_pengajian?></a></li>
                    <li><a href="#universiti-chart" data-toggle="tab"><?=GeneralLabel::universiti?></a></li>
                    <li class="pull-left header"><?=GeneralLabel::statistik?> <?=date("Y")?></li>
                  </ul>
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="status-program_pengajian-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if($chartDataBiasiswa){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::status],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataBiasiswa,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanBiasiswa?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if($chartDataProgramPengajian){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::program_pengajian],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataProgramPengajian,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanProgramPengajian?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="universiti-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-6">
                            <?php
                              echo Highcharts::widget([
                                      'options' => [
                                          'title' => ['text' => GeneralLabel::universiti],
                                          'plotOptions' => [
                                              'pie' => [
                                                  'cursor' => 'pointer',
                                              ],
                                          ],
                                          'series' => [
                                              [ // new opening bracket
                                                  'type' => 'pie',
                                                  'name' => GeneralLabel::peratus,
                                                  'data' => $chartDataUniversiti,
                                              ] // new closing bracket
                                          ],
                                      ],
                                  ]);
                              ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanUniversiti?></strong>
                                </p>
                            </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- E-Biasiswa - END -->
          
          
          
          
          <!-- E-Bantuan - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['dashboard-kbs']['module']) && isset(Yii::$app->user->identity->peranan_akses['KBS']['dashboard-kbs']['e-bantuan'])): ?>
          
          <?php
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            // Bantuan Kategori START
            
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_kategori_persatuan r WHERE r.id = p.kategori_persatuan) AS KATEGORI,
                    (SELECT COUNT(*) FROM tbl_permohonan_e_bantuan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_permohonan_e_bantuan` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.kategori_persatuan
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataBantuanKategori = array();
            
            $jumlahKeseluruhanBantuanKategori = 0;
            
            foreach ($result as $row){
                $chartDataBantuanKategori[] = [$row['JUMLAH'] . ' - ' . $row['KATEGORI'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanBantuanKategori = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBantuanKategori);
            
            // Bantuan Kategori END
            
            
            // Bantuan Program START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_kategori_program r WHERE r.id = p.kategori_program) AS PROGRAM,
                    (SELECT COUNT(*) FROM tbl_permohonan_e_bantuan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_permohonan_e_bantuan` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.kategori_program
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataBantuanProgram = array();
            $jumlahKeseluruhanBantuanProgram = 0;
            
            foreach ($result as $row){
                $chartDataBantuanProgram[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanBantuanProgram = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBantuanProgram);
            
            // Bantuan Program  END
            
            
            // Bantuan Peringkat START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_peringkat_program r WHERE r.id = p.peringkat_program) AS PERINGKAT,
                    (SELECT COUNT(*) FROM tbl_permohonan_e_bantuan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_permohonan_e_bantuan` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.peringkat_program
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataBantuanPeringkat = array();
            $jumlahKeseluruhanBantuanPeringkat = 0;
            
            foreach ($result as $row){
                $chartDataBantuanPeringkat[] = [$row['JUMLAH'] . ' - ' . $row['PERINGKAT'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanBantuanPeringkat = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBantuanPeringkat);
            
            // Bantuan Peringkat END
            
            
            // Bantuan Negeri START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.desc FROM tbl_ref_negeri r WHERE r.id = p.alamat_negeri) AS NEGERI,
                    (SELECT COUNT(*) FROM tbl_permohonan_e_bantuan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_permohonan_e_bantuan` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.alamat_negeri
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataBantuanNegeri = array();
            $jumlahKeseluruhanBantuanNegeri = 0;
            
            foreach ($result as $row){
                $chartDataBantuanNegeri[] = [$row['JUMLAH'] . ' - ' . $row['NEGERI'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanBantuanNegeri = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBantuanNegeri);
            
            // Bantuan Negeri END
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::ebantuan?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#bantuan_kategori-chart" data-toggle="tab"><?=GeneralLabel::kategori?></a></li>
                    <li><a href="#bantuan_program_peringkat-chart" data-toggle="tab"><?=GeneralLabel::program?> & <?=GeneralLabel::peringkat?></a></li>
                    <li><a href="#bantuan_negeri-chart" data-toggle="tab"><?=GeneralLabel::negeri?></a></li>
                    <li class="pull-left header"><?=GeneralLabel::statistik?> <?=date("Y")?></li>
                  </ul>
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="bantuan_kategori-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if($chartDataBantuanKategori){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::kategori],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataBantuanKategori,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanBantuanKategori?></strong>
                                </p>
                            </div>
                            <div class="col-lg-5">
                                <p class="text-center">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_peruntukan_mengikut_kategori?></strong>
                                </p>
                                <?php
                                // Bantuan Kategori Jumlah Peruntukan START
                                $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT SUM(p.jumlah_diluluskan) AS JUMLAH,
                                        (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_kategori_persatuan r WHERE r.id = p.kategori_persatuan) AS KATEGORI,
                                        (SELECT SUM(pe.jumlah_diluluskan) FROM tbl_permohonan_e_bantuan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_permohonan_e_bantuan` p
                                        WHERE YEAR(p.created) = :year
                                        AND p.jumlah_diluluskan > 0
                                        GROUP BY p.kategori_persatuan
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                $result = $command->queryAll();
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($result as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['KATEGORI'].'</span>
                                  <span class="progress-number"><b>RM '.number_format($row['JUMLAH'],2).'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Bantuan Kategori Jumlah Peruntukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_peruntukan?> : RM <?=number_format($jumlah_keseluruhan,2)?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="bantuan_program_peringkat-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                            <?php
                            if($chartDataBantuanProgram){
                              echo Highcharts::widget([
                                      'options' => [
                                          'title' => ['text' => GeneralLabel::program],
                                          'plotOptions' => [
                                              'pie' => [
                                                  'cursor' => 'pointer',
                                              ],
                                          ],
                                          'series' => [
                                              [ // new opening bracket
                                                  'type' => 'pie',
                                                  'name' =>  GeneralLabel::peratus,
                                                  'data' => $chartDataBantuanProgram,
                                              ] // new closing bracket
                                          ],
                                      ],
                                  ]);
                            }
                              ?>
                                <p class="text-center">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanBantuanProgram?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if($chartDataBantuanPeringkat){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::peringkat],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataBantuanPeringkat,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanBantuanPeringkat?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="bantuan_negeri-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-6">
                            <?php
                              echo Highcharts::widget([
                                      'options' => [
                                          'title' => ['text' => GeneralLabel::negeri],
                                          'plotOptions' => [
                                              'pie' => [
                                                  'cursor' => 'pointer',
                                              ],
                                          ],
                                          'series' => [
                                              [ // new opening bracket
                                                  'type' => 'pie',
                                                  'name' => GeneralLabel::peratus,
                                                  'data' => $chartDataBantuanNegeri,
                                              ] // new closing bracket
                                          ],
                                      ],
                                  ]);
                              ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanBantuanNegeri?></strong>
                                </p>
                        </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- E-Bantuan - END -->
          
          
          
          
          <!-- E-Laporan - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['dashboard-kbs']['module']) && isset(Yii::$app->user->identity->peranan_akses['KBS']['dashboard-kbs']['e-laporan'])): ?>
          
          <?php
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            // Laporan Kategori START
            
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_kategori_e_laporan r WHERE r.id = p.kategori_elaporan) AS KATEGORI,
                    (SELECT COUNT(*) FROM tbl_elaporan_pelaksanaan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_elaporan_pelaksanaan` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.kategori_elaporan
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataLaporanKategori = array();
            
            $jumlahKeseluruhanLaporanKategori = 0;
            
            foreach ($result as $row){
                $chartDataLaporanKategori[] = [$row['JUMLAH'] . ' - ' . $row['KATEGORI'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanLaporanKategori = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataLaporanKategori);
            
            // Laporan Kategori END
            
            
            // Laporan Cawangan START
            $sql_dashboard_desc_selector = 'desc_dashboard';
            if($session->get('language') == "BM"){
                $sql_dashboard_desc_selector = 'desc_dashboard';
            }elseif($session->get('language') == "EN"){
                $sql_dashboard_desc_selector = 'desc_en_dashboard';
            }
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.'.$sql_dashboard_desc_selector.' FROM tbl_ref_cawangan_e_laporan r WHERE r.id = p.cawangan) AS CAWANGAN,
                    (SELECT COUNT(*) FROM tbl_elaporan_pelaksanaan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_elaporan_pelaksanaan` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.cawangan
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataLaporanCawangan = array();
            $jumlahKeseluruhanLaporanCawangan= 0;
            
            foreach ($result as $row){
                $chartDataLaporanCawangan[] = [$row['JUMLAH'] . ' - ' . $row['CAWANGAN'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanLaporanCawangan = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBantuanProgram);
            
            // Laporan Cawangan  END
            
            
            // Laporan Peringkat START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_peringkat_e_laporan r WHERE r.id = p.peringkat) AS PERINGKAT,
                    (SELECT COUNT(*) FROM tbl_elaporan_pelaksanaan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_elaporan_pelaksanaan` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.peringkat
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataLaporanPeringkat = array();
            $jumlahKeseluruhanLaporanPeringkat = 0;
            
            foreach ($result as $row){
                $chartDataLaporanPeringkat[] = [$row['JUMLAH'] . ' - ' . $row['PERINGKAT'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanLaporanPeringkat = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBantuanPeringkat);
            
            // Laporan Peringkat END
            
            
            // Laporan Bahagian START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_bahagian_e_laporan r WHERE r.id = p.bahagian) AS BAHAGIAN,
                    (SELECT COUNT(*) FROM tbl_elaporan_pelaksanaan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_elaporan_pelaksanaan` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.bahagian
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataLaporanBahagian = array();
            $jumlahKeseluruhanLaporanBahagian = 0;
            
            foreach ($result as $row){
                $chartDataLaporanBahagian[] = [$row['JUMLAH'] . ' - ' . $row['BAHAGIAN'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanLaporanBahagian = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBantuanNegeri);
            
            // Laporan Bahagian END
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::elaporan?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#laporan_kategori-chart" data-toggle="tab"><?=GeneralLabel::kategori?></a></li>
                    <li><a href="#laporan_cawangan_peringkat-chart" data-toggle="tab"><?=GeneralLabel::cawangan?> & <?=GeneralLabel::peringkat?></a></li>
                    <li><a href="#laporan_bahagian-chart" data-toggle="tab"><?=GeneralLabel::bahagian?></a></li>
                    <li class="pull-left header"><?=GeneralLabel::statistik?> <?=date("Y")?></li>
                  </ul>
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="laporan_kategori-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if($chartDataLaporanKategori){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::kategori],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataLaporanKategori,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanLaporanKategori?></strong>
                                </p>
                            </div>
                            <div class="col-lg-5">
                                <p class="text-center">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_peruntukan_mengikut_kategori?></strong>
                                </p>
                                <?php
                                // Bantuan Kategori Jumlah Peruntukan START
                                $command = $connection->createCommand('
                                    SELECT *,
                                    IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                                    FROM
                                    (
                                        SELECT SUM(p.jumlah_bantuan_peruntukan) AS JUMLAH,
                                        (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_kategori_e_laporan r WHERE r.id = p.kategori_elaporan) AS KATEGORI,
                                        (SELECT SUM(pe.jumlah_bantuan_peruntukan) FROM tbl_elaporan_pelaksanaan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                                        FROM `tbl_elaporan_pelaksanaan` p
                                        WHERE YEAR(p.created) = :year
                                        AND p.jumlah_bantuan_peruntukan > 0
                                        GROUP BY p.kategori_elaporan
                                    ) final 
                                    ORDER BY PERATUS DESC', [':year' => date("Y")]);

                                $result = $command->queryAll();
                                
                                //echo 'color class = ' . $class_color_progress_bar[0];
                                
                                $color_class_runner = 0;
                                
                                $jumlah_keseluruhan = 0;
                                
                                foreach ($result as $row){
                                    //$chartDataProgramPengajian[] = [$row['JUMLAH'] . ' - ' . $row['PROGRAM_PENGAJIAN'],  (double)$row['PERATUS']];
                                    echo '<div class="progress-group">
                                  <span class="progress-text">'.$row['KATEGORI'].'</span>
                                  <span class="progress-number"><b>RM '.number_format($row['JUMLAH'],2).'</b></span>

                                  <div class="progress sm">
                                    <div class="'.$class_color_progress_bar[$color_class_runner].'" style="width: '.$row['PERATUS'].'%"></div>
                                  </div>
                                </div>';
                                    
                                    $jumlah_keseluruhan = $row['JUMLAH_KESELURUHAN'];
                                    
                                    $color_class_runner++;
                                    
                                    if($color_class_runner == count($class_color_progress_bar)){
                                        $color_class_runner = 0;
                                    }
                                }

                                // Bantuan Kategori Jumlah Peruntukan END
                                ?>
                                <p class="text-right">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_peruntukan?> : RM <?=number_format($jumlah_keseluruhan,2)?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="laporan_cawangan_peringkat-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                            <?php
                            if($chartDataLaporanCawangan){
                              echo Highcharts::widget([
                                      'options' => [
                                          'title' => ['text' => GeneralLabel::cawangan],
                                          'plotOptions' => [
                                              'pie' => [
                                                  'cursor' => 'pointer',
                                              ],
                                          ],
                                          'series' => [
                                              [ // new opening bracket
                                                  'type' => 'pie',
                                                  'name' =>  GeneralLabel::peratus,
                                                  'data' => $chartDataLaporanCawangan,
                                              ] // new closing bracket
                                          ],
                                      ],
                                  ]);
                            }
                              ?>
                                <p class="text-center">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanLaporanCawangan?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if($chartDataLaporanPeringkat){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::peringkat],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataLaporanPeringkat,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanLaporanPeringkat?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="laporan_bahagian-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-6">
                            <?php
                              echo Highcharts::widget([
                                      'options' => [
                                          'title' => ['text' => GeneralLabel::bahagian],
                                          'plotOptions' => [
                                              'pie' => [
                                                  'cursor' => 'pointer',
                                              ],
                                          ],
                                          'series' => [
                                              [ // new opening bracket
                                                  'type' => 'pie',
                                                  'name' => GeneralLabel::peratus,
                                                  'data' => $chartDataLaporanBahagian,
                                              ] // new closing bracket
                                          ],
                                      ],
                                  ]);
                              ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanLaporanBahagian?></strong>
                                </p>
                        </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- E-Laporan - END -->
          
          
          
          
          <!-- E-Fasiliti - START -->
          
          <?php if(isset(Yii::$app->user->identity->peranan_akses['KBS']['dashboard-kbs']['module']) && isset(Yii::$app->user->identity->peranan_akses['KBS']['dashboard-kbs']['e-laporan'])): ?>
          
          <?php
            
            // change color different dashboard box
            $dashboard_box_color = $class_bootstrap[$class_bootstrap_runner];
            $class_bootstrap_runner ++;
            if($class_bootstrap_runner == count($class_bootstrap)){$class_bootstrap_runner = 0;}
            
            // Fasiliti Kategori Hakmilik START
            
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_kategori_hakmilik r WHERE r.id = p.kategori_hakmilik) AS HAKMILIK,
                    (SELECT COUNT(*) FROM tbl_pengurusan_kemudahan_venue pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_pengurusan_kemudahan_venue` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.kategori_hakmilik
                ) final ', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataFasilitiHakmilik = array();
            
            $jumlahKeseluruhanFasilitiHakmilik = 0;
            
            foreach ($result as $row){
                $chartDataFasilitiHakmilik[] = [$row['JUMLAH'] . ' - ' . $row['HAKMILIK'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanFasilitiHakmilik = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataFasilitiHakmilik);
            
            // Fasiliti Kategori Hakmilik END
            
            
            // Fasiliti Status START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.'.$sql_desc_selector.' FROM tbl_ref_status_venue r WHERE r.id = p.status) AS STATUS,
                    (SELECT COUNT(*) FROM tbl_pengurusan_kemudahan_venue pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_pengurusan_kemudahan_venue` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.status
                ) final ', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataFasilitiStatus = array();
            $jumlahKeseluruhanFasilitiStatus = 0;
            
            foreach ($result as $row){
                $chartDataFasilitiStatus[] = [$row['JUMLAH'] . ' - ' . $row['STATUS'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanFasilitiStatus = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataFasilitiStatus);
            
            // Fasiliti Status  END
            
            
            // Laporan Peringkat START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.desc FROM tbl_ref_negeri r WHERE r.id = p.alamat_negeri) AS NEGERI,
                    (SELECT COUNT(*) FROM tbl_pengurusan_kemudahan_venue pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_pengurusan_kemudahan_venue` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.alamat_negeri
                ) final ', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataFasilitiNegeri = array();
            $jumlahKeseluruhanFasilitiNegeri= 0;
            
            foreach ($result as $row){
                $chartDataFasilitiNegeri[] = [$row['JUMLAH'] . ' - ' . $row['NEGERI'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanFasilitiNegeri = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBantuanPeringkat);
            
            // Laporan Peringkat END
            
            
            // Laporan Bahagian START
            $command = $connection->createCommand('
                SELECT *,
                IFNULL((final.JUMLAH / final.JUMLAH_KESELURUHAN) * 100,0.0) AS PERATUS
                FROM
                (
                    SELECT COUNT(*) AS JUMLAH,
                    (SELECT r.desc FROM tbl_ref_bahagian_e_laporan r WHERE r.id = p.bahagian) AS BAHAGIAN,
                    (SELECT COUNT(*) FROM tbl_elaporan_pelaksanaan pe WHERE YEAR(pe.created) = :year) AS JUMLAH_KESELURUHAN
                    FROM `tbl_elaporan_pelaksanaan` p
                    WHERE YEAR(p.created) = :year
                    GROUP BY p.bahagian
                ) final', [':year' => date("Y")]);

            $result = $command->queryAll();
            
            $chartDataLaporanBahagian = array();
            $jumlahKeseluruhanLaporanBahagian = 0;
            
            foreach ($result as $row){
                $chartDataLaporanBahagian[] = [$row['JUMLAH'] . ' - ' . $row['BAHAGIAN'],  (double)$row['PERATUS']];
                $jumlahKeseluruhanLaporanBahagian = $row['JUMLAH_KESELURUHAN'];
            }
            
            //print_r($chartDataBantuanNegeri);
            
            // Laporan Bahagian END
            
            
          ?>
          <div class="box box-<?=$dashboard_box_color;?>">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  <?=GeneralLabel::efasiliti_ekemudahan?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#fasiliti_hakmilik_status-chart" data-toggle="tab"><?=GeneralLabel::kategori_hakmilik?> & <?=GeneralLabel::status?></a></li>
                    <li><a href="#fasiliti_negeri-chart" data-toggle="tab"><?=GeneralLabel::negeri?></a></li>
                    <li class="pull-left header"><?=GeneralLabel::statistik?> <?=date("Y")?></li>
                </ul>
                  <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="fasiliti_hakmilik_status-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-6">
                            <?php
                            if($chartDataFasilitiHakmilik){
                              echo Highcharts::widget([
                                      'options' => [
                                          'title' => ['text' => GeneralLabel::kategori_hakmilik],
                                          'plotOptions' => [
                                              'pie' => [
                                                  'cursor' => 'pointer',
                                              ],
                                          ],
                                          'series' => [
                                              [ // new opening bracket
                                                  'type' => 'pie',
                                                  'name' =>  GeneralLabel::peratus,
                                                  'data' => $chartDataFasilitiHakmilik,
                                              ] // new closing bracket
                                          ],
                                      ],
                                  ]);
                            }
                              ?>
                                <p class="text-center">
                                    <br>
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanLaporanCawangan?></strong>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if($chartDataFasilitiStatus){
                                  echo Highcharts::widget([
                                          'options' => [
                                              'title' => ['text' => GeneralLabel::status],
                                              'plotOptions' => [
                                                  'pie' => [
                                                      'cursor' => 'pointer',
                                                  ],
                                              ],
                                              'series' => [
                                                  [ // new opening bracket
                                                      'type' => 'pie',
                                                      'name' => GeneralLabel::peratus,
                                                      'data' => $chartDataFasilitiStatus,
                                                  ] // new closing bracket
                                              ],
                                          ],
                                      ]);
                                }
                                  ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanLaporanPeringkat?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="fasiliti_negeri-chart" style="position: relative;">
                        <div class="row">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-6">
                            <?php
                              echo Highcharts::widget([
                                      'options' => [
                                          'title' => ['text' => GeneralLabel::negeri],
                                          'plotOptions' => [
                                              'pie' => [
                                                  'cursor' => 'pointer',
                                              ],
                                          ],
                                          'series' => [
                                              [ // new opening bracket
                                                  'type' => 'pie',
                                                  'name' => GeneralLabel::peratus,
                                                  'data' => $chartDataFasilitiNegeri,
                                              ] // new closing bracket
                                          ],
                                      ],
                                  ]);
                              ?>
                                <p class="text-center">
                                  <strong><?=GeneralLabel::jumlah_without_RM?> : <?=$jumlahKeseluruhanLaporanBahagian?></strong>
                                </p>
                        </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.box -->
          
          <?php endif; ?>
          <!-- E-Fasiliti - END -->
          
          

        </section>
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
            <!--<div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>-->
        </div>

    </div>
</div>
