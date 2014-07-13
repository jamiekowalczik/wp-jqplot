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
	
	public function addDataPoints($aDataPointName, $aDataPointLabel,  $aDataPoints){
		array_push($this->arrDataPointNames,$aDataPointName);
		array_push($this->arrDataPointLabel,$aDataPointLabel);
		array_push($this->arrDataPoints,$aDataPoints);
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
					// have to use synchronous here, else the function
					// will return before the data is fetched
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
			
			$htmlbody = "<div id=\"$this->chartName\" style=\"height:180px;width:275px;float:left;margin 0 0 0 0;\"></div>";
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
			
				
			$labelposition = "";
			if(!$this->chartLabelPosition == ""){
				$labelposition = "labelPosition: '$this->chartLabelPosition',";
			}
				
			$labelheightadjust = "";
			if(!$this->chartLabelHeightAdjust == ""){
				$labelheightadjust = "labelHeightAdjust: $this->chartLabelHeightAdjust,";
			}
				
			$htmlbody = "<div id=\"$this->chartName\" style=\"height:180px;width:275px;float:left;margin 0 0 0 0;\"></div>";
			
			//[[[1, 2],[3,5.12],[5,13.1],[7,33.6],[9,85.9],[11,219.9]]]
			$jsdoc =<<<DOC
				
     		jQuery.jqplot('$this->chartName', $this->chartDatasets );
DOC;
			return array(
					"chart-js" => $jsdoc,
					"chart-html" => $htmlbody
			);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function displayLineChart(){
		try{
			$jsdoc = "";
		    $intCounter = 0;
			foreach($this->arrDataPoints as $aDataPoint){
				$dpName = $this->arrDataPointNames[$intCounter];
				$jsdoc .= "var $dpName =[";
				foreach($aDataPoint as $aVal){
					$jsdoc .= "['".$aVal["timestamp"]."', ".$aVal[$this->arrDataPointNames[$intCounter]]."],";
				}
				$jsdoc = substr($jsdoc, 0, -1);
				$jsdoc .= "];\r\n";
				$intCounter += 1;
			}
			$chartDataPointNames = "";
			foreach($this->arrDataPointNames as $aDataPointName){
				$chartDataPointNames .= $aDataPointName.",";
			}
			
			$chartDataPointLabel = "";
			foreach($this->arrDataPointLabel as $aDataPointLabel){
				$chartDataPointLabel .= "{label:'".$aDataPointLabel."'},";
			}
				   
			$htmlbody = "<div id=\"$this->chartName\" style=\"height:280px;width: 870px;float:left;\"></div>";
							  // ."<button class=\"button-reset-$this->chartName\">Reset Zoom</button>";
			$jsdoc .= <<<DOC
				 var $this->chartName = $.jqplot('$this->chartName', [$chartDataPointNames], {
				    title:{
				    	text: '$this->chartTitle',
				    	textColor: 'white'
				    },
				    axes:{
				      xaxis:{
				        renderer:$.jqplot.DateAxisRenderer,
				          tickOptions:{
				            formatString:'%b %#d, %#I %p',
					    	min:'January 1, 2014 6:00AM',
					    	tickInterval:'1 hour',
					    	textColor: 'White'
				          }
				      },
				      yaxis:{
				        tickOptions:{
				          //formatString:'$%.2f',
				          textColor: 'White'
				        }
				      }
				    },
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
				    series: [{ lineWidth: 2,
				        markerOptions: {style: 'square'}
				    }],
				    series: [
				        $chartDataPointLabel
				    ]
				  });
				  $('.button-reset-$this->chartName').click(function() { $this->chartName.resetZoom() });
DOC;
		return array(
			"chart-js" => $jsdoc,
			"chart-html" => $htmlbody
		);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	private function _logIt($data){
		$myFile = "debugme.txt";
        $fh = fopen($myFile, 'a') or die("can't open file");
        fwrite($fh, "----------\r\n".$data."\r\n----------\r\n");
        fclose($fh);
	}  
}
