<?php 
function getdnow()
{
	$bulan = array(
		'01'=>'Januari',
		'02'=>'Februari',
		'03'=>'Maret',
		'04'=>'April',
		'05'=>'Mei',
		'06'=>'Juni',
		'07'=>'Juli',
		'08'=>'Agustus',
		'09'=>'September',
		'10'=>'Oktober',
		'11'=>'November',
		'12'=>'Desember');

	$m = date('m');
	$d = date('d');
	$y = date('Y');

	$bln = $bulan[$m];

	$r = $d." ".$bln." ".$y;
	return $r;
} 
?>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Dashboard <small><?php echo $this->config->item('sub_name') ?></small>
        </h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo site_url() ?>">
                    Home
                </a>
            </li>
            <li class="pull-right">
                <div class="dashboard-date-range" style="display:block">
                    <i class="fa fa-calendar"></i>
                    <span>
                        <?php echo getdnow() ?>
                    </span>
                </div>
            </li>
        </ul>

        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bar-chart-o"></i>
                    Menurut Tingkatan
                </div>
            </div>
            <div class="portlet-body">
                <div id="chart1" style="width: 100%; height: 480px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    grafik1();
});

var jumchart1 = {
    colors: ['red', 'green'],
    chart: {
        colorByPoint: true,
        renderTo: 'chart1',
        type: 'column',

    },
    plotOptions: {
        column: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                style: {
                    fontWeight: 'bold',
                    fontSize: 20
                },
                enabled: true,
            }
        }
    },
    title: {
        text: ''
    },
    yAxis: {
        min: 0,
        max: 700,
        title: {
            text: '<b style="font-size:20px">Jumlah Pegawai</b>'
        },
        labels: {
            style: {
                fontWeight: 'bold',
            }
        }
    },
    xAxis: {
        categories: [],
        crosshair: true,
        labels: {
            style: {
                fontWeight: 'bold',
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    series: []
};

function grafik1() {
    $.getJSON("<?php echo base_url()?>" + "profile/grafik1", function(json) {
        jumchart1.series[0] = json[0];
        jumchart1.series[1] = json[1];
        jumchart1.series[2] = json[2];
        jumchart1.series[3] = json[3];


        new Highcharts.Chart(jumchart1);
    });
}
</script>