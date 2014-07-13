<?php

class Chart_Model {
	
	protected $chartName = "";
	protected $chartValue = "";
	protected $chartTitle = "";
	protected $chartLabel = "";
	protected $chartLabelPosition = "";
	protected $chartLabelHeightAdjust = "";
	protected $chartTicks = "";
	protected $showTickLabels = '';
	protected $chartMin = "";
	protected $chartMax = "";
	protected $chartIntervals = "";
	protected $chartIntervalColors = "";
	protected $arrDataPoints = array();
	protected $arrDataPointNames = array();
	protected $arrDataPointLabel = array();
	protected $chartDataRenderer = "";
	protected $chartDatasets = "";
	protected $chartHeight = "";
	protected $chartWidth = "";
	
	public function newChart(){
		try {
			$this->chartName = "";
			$this->chartValue = "";
			$this->chartTitle = "";
			$this->chartLabel = "";
			$this->chartLabelPosition = "";
			$this->chartLabelHeightAdjust = "";
			$this->chartTicks = "";
			$this->showTickLabels = '';
			$this->chartMin = "";
			$this->chartMax = "";
			$this->chartIntervals = "";
			$this->chartIntervalColors = "";
			$this->arrDataPoints = array();
			$this->arrDataPointNames = array();
			$this->arrDataPointLabel = array();
			$this->chartDataRenderer = "";
			$this->chartDatasets = "";
			$this->chartHeight = "";
			$this->chartWidth = "";
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function setChartName($aChartName){
		if(!empty($aChartName)){
			$this->chartName = $aChartName;
		}
	}
	
	public function setChartValue($aChartValue){
		if(!empty($aChartValue)){
			$this->chartValue = $aChartValue;
		}
	}
	
	public function setChartTitle($aChartTitle){
		if(!empty($aChartTitle)){
			$this->chartTitle = $aChartTitle;
		}
	}
	
	public function setChartLabel($aChartLabel){
		if(!empty($aChartLabel)){
			$this->chartLabel = $aChartLabel;
		}
	}
	
	public function setChartLabelPosition($aChartLabelPosition){
		if(!empty($aChartLabelPosition)){
			$this->chartLabelPosition = $aChartLabelPosition;
		}
	}
	
	public function setChartLabelHeightAdjust($aChartLabelHeightAdjust){
		if(!empty($aChartLabelHeightAdjust)){
			$this->chartLabelHeightAdjust = $aChartLabelHeightAdjust;
		}
	}
	
	public function setChartTicks($aChartTicks){
		if(!empty($aChartTicks)){
			$this->chartTicks = $aChartTicks;
		}
	}
	
	public function setShowTickLabels($aShowTickLabels){
		if(!empty($aShowTickLabels)){
			$this->showTickLabels = $aShowTickLabels;
		}
	}
	
	public function setChartMin($aChartMin){
			$this->chartMin = $aChartMin;
	}
	
	public function setChartMax($aChartMax){
		if(!empty($aChartMax)){
			$this->chartMax = $aChartMax;
		}
	}
	
	public function setChartIntervals($aChartIntervals){
		if(!empty($aChartIntervals)){
			$this->chartIntervals = $aChartIntervals;
		}
	}
	
	public function setChartIntervalColors($aChartIntervalColors){
		if(!empty($aChartIntervalColors)){
			$this->chartIntervalColors = $aChartIntervalColors;
		}
	}
	
	public function addDataPointLabel($aDataPointLabel){
		array_push($this->arrDataPointLabel, $aDataPointLabel);
	}
	
	public function setChartDataRenderer($aDataRenderer){
		if(!empty($aDataRenderer)){
			$this->chartDataRenderer = $aDataRenderer;
		}
	}
	
	public function setChartDatasets($aDatasets){
		if(!empty($aDatasets)){
			$this->chartDatasets = $aDatasets;
		}
	}
	
	public function setChartHeight($aChartHeight){
		if(!empty($aChartHeight)){
			$this->chartHeight = $aChartHeight;
		}
	}
	
	public function setChartWidth($aChartWidth){
		if(!empty($aChartWidth)){
			$this->chartWidth = $aChartWidth;
		}
	}
	
	public function displayGauge(){
		try{
			$chartval = "chartVal";
			$datarenderer = "";
			$jsrendererdoc = "";
			if(!$this->chartDataRenderer == ""){
				$chartval = "";
				$datarenderer = "dataRenderer: datarenderer$this->chartName,";
				
				$jsrendererdoc =<<<DOC
				var datarenderer$this->chartName = function() {
				var ret = null;
				$.ajax({
					async: false,
					url: '$this->chartDataRenderer',
					dataType:"json",
					success: function(data) {
						ret = data;
					}
				});
				return ret;
			};
DOC;
			}
			
			$labelposition = "";
			if(!$this->chartLabelPosition == ""){
				$labelposition = "labelPosition: '$this->chartLabelPosition',";
			}
			
			$labelheightadjust = "";
			if(!$this->chartLabelHeightAdjust == ""){
				$labelheightadjust = "labelHeightAdjust: $this->chartLabelHeightAdjust,";
			}
			
			$htmlbody = "<div id=\"$this->chartName\" style=\"height:$this->chartHeight;width:$this->chartWidth;float:left;margin 0 0 0 0;\"></div>";
			$jsdoc =<<<DOC
				$jsrendererdoc;
				var chartVal = [$this->chartValue];
				$this->chartName = jQuery.jqplot('$this->chartName',[$chartval],{
      			 	title: '$this->chartTitle',	
      			 	$datarenderer
       				seriesDefaults: {
           				renderer: jQuery.jqplot.MeterGaugeRenderer,
           				rendererOptions: {
           				label: '$this->chartLabel',
           				$labelposition
           				$labelheightadjust
           				ticks: $this->chartTicks,
           				showTickLabels: $this->showTickLabels,
               			min: $this->chartMin,
               			max: $this->chartMax,
               			intervals:$this->chartIntervals,
               			intervalColors:$this->chartIntervalColors
           			}
       			}
   		});
DOC;
			return array(
				"chart-js" => $jsdoc,
				"chart-html" => $htmlbody
			);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function displayChart(){
		try{
			$chartval = "chartVal";
			$datarenderer = "";
			$jsrendererdoc = "";
			
			if(!$this->chartDataRenderer == ""){
				$chartval = "";
				$datarenderer = "dataRenderer: datarenderer$this->chartName,";
			
				$jsrendererdoc =<<<DOC
				var datarenderer$this->chartName = function() {
				var ret = null;
				$.ajax({
					async: false,
					url: '$this->chartDataRenderer',
					dataType:"json",
					success: function(data) {
						ret = data;
					}
				});
				return ret;
			};
DOC;
			
			}	
			$labelposition = "";
			if(!$this->chartLabelPosition == ""){
				$labelposition = "labelPosition: '$this->chartLabelPosition',";
			}
				
			$labelheightadjust = "";
			if(!$this->chartLabelHeightAdjust == ""){
				$labelheightadjust = "labelHeightAdjust: $this->chartLabelHeightAdjust,";
			}
			
			$chartDataPointLabel = "";
			foreach($this->arrDataPointLabel as $aDataPointLabel){
				$chartDataPointLabel .= "{label:'".$aDataPointLabel."'},";
			}
				
			$htmlbody = "<div id=\"$this->chartName\" style=\"height:$this->chartHeight;width:$this->chartWidth;float:left;margin 0 0 0 0;\"></div>";
			
			$jsdoc =<<<DOC
			$jsrendererdoc
     		jQuery.jqplot('$this->chartName', $this->chartDatasets, {
     			highlighter: {
				      show: false,
				},
				cursor: {
				      show: true,
				      zoom: true,
				      tooltipLocation:'sw'
				},
				legend:{
				        show: true,
				        placement: 'outside',
				        background: 'white',
            			textColor: 'black',
            			fillalpha: 100
				},
				series: [
				        $chartDataPointLabel
				    ],
				$datarenderer
			});
DOC;
			return array(
					"chart-js" => $jsdoc,
					"chart-html" => $htmlbody
			);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
}
