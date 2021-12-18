/*Dashboard Init*/
 
"use strict"; 
$(document).ready(function() {
	/*Toaster Alert*/
	$.toast({
		heading: 'Welcome Back!',
		text: '<p>You have successfully completed level 1.</p><button class="btn btn-primary btn-sm mt-10">Play again</button>',
		position: 'bottom-left',
		loaderBg:'#3a55b1',
		class: 'jq-toast-primary',
		hideAfter: 3500, 
		stack: 6,
		showHideTransition: 'fade'
	});
	if( $('#m_chart_3').length > 0 ){
		// Line Chart
		var data=[{ y: '100', a: 10, b: 20},
				  { y: '200', a: 30, b: 50},
				  { y: '300', a: 20, b: 40},
				  { y: '400', a: 50, b: 70},
				  { y: '500', a: 10, b: 40},
				  
				];
		var lineChart = Morris.Line({
				element: 'm_chart_3',
				data: data,
				xkey: 'y',
				ykeys: ['a', 'b'],
				labels: ['Total Income', 'Total Outcome'],
				gridLineColor: '#eaecec',
				resize: true,
				gridTextColor:'#5e7d8a',
				gridTextFamily:"Inherit",
				hideHover: 'auto',
				behaveLikeLine: true,
				smooth:true,
				pointSize: 3,
				lineWidth:2,
				pointFillColors:['#3a55b1','#9caad8'],
				pointStrokeColors: ['#3a55b1','#9caad8'],
				lineColors: ['#3a55b1','#9caad8'],
			});	
	}
});

var sparklineLogin = function() { 
	if( $('#sparkline_1').length > 0 ){
		$("#sparkline_1").sparkline([2,4,4,6,8,5,6,4,8,6,6,2 ], {
			type: 'bar',
			width: '100%',
			height: '45',
			barWidth: '10',
			resize: true,
			barSpacing: '5',
			barColor: '#3a55b1',	
			highlightSpotColor: '#3a55b1'
		});
	}
	if( $('#sparkline_2').length > 0 ){
		$("#sparkline_2").sparkline([7,4,5,6,8,5,6,4,9,6,6,2 ], {
			type: 'bar',
			width: '100%',
			height: '45',
			barWidth: '10',
			resize: true,
			barSpacing: '5',
			barColor: '#3a55b1',	
			highlightSpotColor: '#3a55b1'
		});
	}
	if( $('#sparkline_3').length > 0 ){
		$("#sparkline_3").sparkline([5,4,5,5,8,5,6,4,5,6,6,2 ], {
			type: 'bar',
			width: '100%',
			height: '45',
			barWidth: '10',
			resize: true,
			barSpacing: '5',
			barColor: '#3a55b1',	
			highlightSpotColor: '#3a55b1'
		});
	}
	if( $('#sparkline_4').length > 0 ){
		$("#sparkline_4").sparkline([20,4,4], {
			type: 'pie',
			width: '50',
			height: '50',
			resize: true,
			sliceColors: ['#3a55b1', '#9caad8', '#536bbb']
		});
	}
	if( $('#sparkline_5').length > 0 ){
		$("#sparkline_5").sparkline([10,30,20], {
			type: 'pie',
			width: '50',
			height: '50',
			resize: true,
			sliceColors: ['#3a55b1', '#9caad8', '#536bbb']
		});
	}
}

/*****E-Charts function start*****/
var echartsConfig = function() { 
	if( $('#e_chart_1').length > 0 ){
		var eChart_1 = echarts.init(document.getElementById('e_chart_1'));
		var option = {
			tooltip: {
				show: true,
				backgroundColor: '#fff',
				borderRadius:6,
				padding:6,
				axisPointer:{
					lineStyle:{
						width:0,
					}
				},
				textStyle: {
					color: '#324148',
					fontFamily: '"Poppins", sans-serif',
					fontSize: 12
				}	
			},
			series: [
				{
					type: 'pie',
					selectedMode: 'single',
					radius: ['80%', '40%'],
					labelLine: {
						normal: {
							show: false
						}
					},
					color: ['#3a55b1', '#9caad8', '#536bbb'],
					data:[
						{value:435, name:''},
						{value:679, name:''},
						{value:848, name:''},
						{value:348, name:''},
					]
				}
			]
		};
		eChart_1.setOption(option);
		eChart_1.resize();
	}
	if( $('#e_chart_2').length > 0 ){
		var eChart_2 = echarts.init(document.getElementById('e_chart_2'));
		//data
		var data = [220, 182, 191, 234, 190, 330, 310];
		var markLineData = [];
		for (var i = 1; i < data.length; i++) {
			markLineData.push([{
				xAxis: i - 1,
				yAxis: data[i - 1],
				value: (data[i] + data[i-1]).toFixed(2)
			}, {
				xAxis: i,
				yAxis: data[i]
			}]);
		}

		//option
		var option2 = {
			tooltip: {
				show: true,
				backgroundColor: '#fff',
				borderRadius:6,
				padding:6,
				axisPointer:{
					lineStyle:{
						width:0,
					}
				},
				textStyle: {
					color: '#324148',
					fontFamily: '"Poppins", sans-serif',
					fontSize: 12
				}	
			},
			color: ['#3a55b1'],	
			grid: {
				top: '25%',
				left: '3%',
				right: '3%',
				bottom: '3%',
				containLabel: true
			},
			xAxis: {
				data: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
				axisLine: {
					show:false
				},
				axisLabel: {
					textStyle: {
						color: '#324148'
					}
				},
			},
			yAxis: {
				axisLine: {
					show:false
				},
				axisLabel: {
					textStyle: {
						color: '#324148'
					}
				},
				splitLine: {
					show: false,
				},
			},
			series: [{
				type: 'line',
				data:data,
				markPoint: {
					data: [
						{type: 'max', name: '最大值'},
						{type: 'min', name: '最小值'}
					]
				},
				markLine: {
					smooth: true,
							effect: {
								show: true
							},
							distance: 10,
					label: {
						normal: {
							position: 'middle'
						}
					},
					symbol: ['none', 'none'],
					data: markLineData
				}
			}]
		};
		eChart_2.setOption(option2);
		eChart_2.resize();
	}
	if( $('#e_chart_6').length > 0 ){
		var eChart_6 = echarts.init(document.getElementById('e_chart_6'));
		var data = [];
		for (var i = 0; i <= 10; i++) {
			var theta = i / 100 * 360;
			var r = 5 * (1 + Math.sin(theta / 180 * Math.PI));
			data.push([r, theta]);
		}
		var option6 = {
			polar: {},
			tooltip: {
				show: true,
				backgroundColor: '#fff',
				borderRadius:6,
				padding:6,
				axisPointer:{
					lineStyle:{
						width:0,
					}
				},
				textStyle: {
					color: '#324148',
					fontFamily: '"Poppins", sans-serif',
					fontSize: 12
				}	
			},
			angleAxis: {
				type: 'value',
				startAngle: 0,
				axisLine: {
					lineStyle: {
						color: 'rgba(33, 33, 33, 0.1)'
					}
				},
				axisLabel: {
					textStyle: {
						color: '#324148'
					}
				},
			},
			radiusAxis: {
				axisLine: {
					lineStyle: {
						color: 'rgba(33, 33, 33, 0.1)'
					}
				},
				axisLabel: {
					textStyle: {
						color: '#324148'
					}
				},
			},
			series: [{
				coordinateSystem: 'polar',
				name: 'line',
				type: 'line',
				lineStyle: {
					normal: {
						color: '#3a55b1',
					}
				},
				itemStyle: {
					normal: {
						color: '#3a55b1',
					}
				},
				 areaStyle: {
					normal: {
						color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
						   offset: 0,
						   color: '#3a55b1'
						   }, {
						   offset: 1,
						   color: '#536bbb'
						}])
					}
					},
				
				data: data
			}]
		};
		eChart_6.setOption(option6);
		eChart_6.resize();
	}
}
/*****E-Charts function end*****/
$('#dash-tab a').on('click', function (e) {
	clearTimeout(echartResize);
	echartResize = setTimeout(echartsConfig, 200);
})

/*****Resize function start*****/
var sparkResize,echartResize;
$(window).on("resize", function () {
	/*Sparkline-Chart Resize*/
	clearTimeout(sparkResize);
	sparkResize = setTimeout(sparklineLogin, 200);
	
	/*E-Chart Resize*/
	clearTimeout(echartResize);
	echartResize = setTimeout(echartsConfig, 200);
}).resize(); 
/*****Resize function end*****/

/*****Function Call start*****/
echartsConfig();
sparklineLogin();
/*****Function Call end*****/