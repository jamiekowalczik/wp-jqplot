<?php
/*
Plugin Name: jqPlot Charts and Graphs for jQuery
Plugin URI: http://www.google.com
Description: A pure JavaScript charting plugin for the jQuery javascript framework. 
Version: 1.0.0
Author: JK
Author URI: http://www.google.com/
*/

include 'chart_model.php';

function jqplot_shortcode( $atts ) {

	// Default Attributes
	// - - - - - - - - - - - - - - - - - - - - - - -
	extract( shortcode_atts(
		array(
			'type'			   => '',//'gauge',
			'name'			   => '', //'chart',
			'title'            => '', //'chart',
			'label'			   => '', //'chart',
			'labelposition'    => '', //'bottom',
			'labelheightadjust' => '', //'-5',
			'showticklabels'   => 'true',
			'ticks'			   => '', //10, 20, 30, 40, 50, 60, 70, 80, 90, 100',
			'width'			   => '33%',
			'height'		   => 'auto',
			'min'			   => '0', //0,
			'max'			   => '100', //100,
			'intervals'		   => '', //"0, 20, 40, 60, 80, 100",
			'intervalcolors'   => '', //'#FFA4A4', '#FF8E8E', '#FF7373', '#FF5353', '#FF2626', '#F70000',
			'value'            => '',
			'datasets'		   => '',
			'datapointlabel'   => '',
			'datarendererurl'  => ''
			), $atts )
	);

	$obj = new Chart_Model();
	$obj->newChart();
	
	// prepare data
	// - - - - - - - - - - - - - - - - - - - - - - -
	$name    = str_replace(' ', '', $name);
	$intervals = "[$intervals]";
	$intervalcolors = "[$intervalcolors]";
	$ticks = "[$ticks]";
	$chart = "";
	
	$datapointlabel = explode(",", $datapointlabel);
	$datapointlabeltotal = count($datapointlabel);
	for ($i = 0; $i < $datapointlabeltotal; $i++){
		$obj->addDataPointLabel($datapointlabel[$i]);
	}
	
	$obj->setChartName($name);
	$obj->setChartTitle($title);
	$obj->setChartLabel($label);
	$obj->setChartLabelPosition($labelposition);
	$obj->setChartLabelHeightAdjust($labelheightadjust);
	$obj->setChartDataRenderer($datarendererurl);
	$obj->setChartHeight($height);
	$obj->setChartWidth($width);
	
	if($type == "gauge"){
		$obj->setChartTicks($ticks);
		$obj->setShowTickLabels($showticklabels);
		$obj->setChartMin($min);
		$obj->setChartMax($max);
		$obj->setChartIntervals($intervals);
		$obj->setChartIntervalColors($intervalcolors);
		$obj->setChartValue($value);
		$chart = $obj->displayGauge();
	}elseif($type == "line"){
		$datasets = explode("next", str_replace(' ', '', $datasets));
		$total    = count($datasets);
		
		$chartdata = "[[";
		for ($i = 0; $i < $total; $i++) {
			$chartdata .= "[";
			$chartdata .= $datasets[$i]."],";
		}
		$chartdata = substr($chartdata, 0, -1);
		$chartdata .= "]]";
		$datasets = $chartdata;
		$obj->setChartDatasets($datasets);
		$chart = $obj->displayChart();
	}
	
	$chartjquery = $chart['chart-js'];
	$chartjs = <<<DOC
	<script type="text/javascript">
	jQuery(document).ready(function( $ ) {
		jQuery.jqplot.config.enablePlugins = true;
		$chartjquery
	});
	</script>
DOC;
	
	$currentchart = $chartjs.$chart['chart-html'];
	return $currentchart;
}

function jqplot_wp_setup(){
   wp_enqueue_script("jquery");
   wp_deregister_script('jqplot');
   wp_enqueue_script("jqplot", WP_PLUGIN_URL."/jqplot/js/jquery.jqplot.min.js",array("jquery"), "",0);
   wp_enqueue_script("jqplot.meterGuageRenderer", WP_PLUGIN_URL."/jqplot/js/plugins/jqplot.meterGaugeRenderer.min.js",array("jquery"), "",0);
   wp_enqueue_script("jqplot.jqplot.json2", WP_PLUGIN_URL."/jqplot/js/plugins/jqplot.json2.min.js",array("jquery"), "",0);
   wp_enqueue_script("jqplot.highlighter", WP_PLUGIN_URL."/jqplot/js/plugins/jqplot.highlighter.min.js",array("jquery"), "",0);
   wp_enqueue_script("jqplot.cursor", WP_PLUGIN_URL."/jqplot/js/plugins/jqplot.cursor.min.js",array("jquery"), "",0);
   wp_enqueue_script("jqplot.dateAxisRenderer", WP_PLUGIN_URL."/jqplot/js/plugins/jqplot.dateAxisRenderer.min.js",array("jquery"), "",0);
   
   wp_deregister_style('jqplot');
   wp_enqueue_style("jqplot",WP_PLUGIN_URL."/jqplot/css/jquery.jqplot.min.css",false,"");
   
   add_shortcode( 'jqplot', 'jqplot_shortcode' );
}

add_action('init', 'jqplot_wp_setup');

?>
