=== jqPlot for WordPress ===
Contributors: JK
Donate link: http://www.google.com
Tags: javascript, jquery, excanvas, jqplot
Requires at least: 3.0
Tested up to: 3.6
Stable tag: 1.3

jqPlot is a pure JavaScript charting plugin for the jQuery javascript framework. 

== Description ==
jqPlot is a plotting and charting plugin for the jQuery Javascript framework. jqPlot produces beautiful line, bar and pie charts with many features.

jqPlot is a plotting plugin for the jQuery Javascript framework. jqPlot produces beautiful charts with many features including:

* Line charts. 
* Bar charts. 
* Pie charts. 
* Rotated axis text. 
* Open Hi Low Close and Candlestick charts. 
* Customize colors, shadows, markers, ticks and more. 
* Date axes with customizable formatting. 
* Automatic trend line computation. 
* Tooltips and data point highlighting. 
* Data point labels. 
* Sensible defaults for ease of use. 

jqPlot has been tested on IE 7, IE 8, Firefox, Safari, and Opera. You can see jqPlot in action on the[tests &  examples page](http://www.jqplot.com/tests/). 

== Installation ==
1. Upload `wp-jqplot/` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Shortcode Examples ==
[wp-jqplot type="gauge" name="mygauge" label="my chart" labelposition="bottom" labelheightadjust="-10" datarendererurl="/getinfo.php"]

[wp-jqplot type="gauge" name="mygauge1" label="my chart" labelposition="bottom" labelheightadjust="-10" value="33"]

[wp-jqplot type="line" name="linechart" datasets="1,2 next 3,5 next 4,6 next 2,1"]

[wp-jqplot type="line" name="linechart" datasets="1,2 next 3,5 next 4,6 next 2,1;1,7 next 3,10 next 4,4" datapointlabel="Temperature,Humidity"]

[wp-jqplot type="line" name="history" width="100%" height="225px" datarendererurl="/getinfo1.php" datapointlabel="solar,humid,temp"]

== Changelog ==
= 0.7.12.0 = 
* Initial version
* Based on 1.0
