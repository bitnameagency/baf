/*Dashboard4 Init*/
 
"use strict"; 
$(document).ready(function() {
	/*Toaster Alert*/
	$.toast({
		heading: 'Welcome Back!',
		text: '<p>You have successfully completed level 1.</p><button class="btn btn-primary btn-sm mt-10">Play again</button>',
		position: 'top-right',
		loaderBg:'#3a55b1',
		class: 'jq-toast-primary',
		hideAfter: 3500, 
		stack: 6,
		showHideTransition: 'fade'
	});
	
	/*Owl Carousel*/
	$('#owl_demo_1').owlCarousel({
		items: 1,
		animateOut: 'fadeOut',
		loop: true,
		margin: 10,
		autoplay: true,
		mouseDrag: false,
		dots:false

	});
});

/*****E-Charts function start*****/
var echartsConfig = function() { 
	if( $('#e_chart_3').length > 0 ){
		var eChart_3 = echarts.init(document.getElementById('e_chart_3'));
		var option1 = {
			title: {
				text: 'Awesome Chart'
			},
			xAxis: {
				data: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
			},
			yAxis: {},
			series: [{
				type: 'line',
				data:[220, 182, 191, 234, 290, 330, 310]
			}]
		};
		var myData = ['a1', 'a2', 'a3', 'a4', 'a5', 'a6', 'a7'];
		var databeast = {
			2006: [389, 259, 262, 324, 232, 176, 196],
			2007: [111, 315, 139, 375, 204, 352, 163],
			2008: [227, 210, 328, 292, 241, 110, 130],
			2009: [100, 350, 300, 250, 200, 150, 100],
			2010: [280, 128, 255, 254, 313, 143, 360],
			2011: [121, 388, 233, 309, 133, 308, 297],
			2012: [200, 350, 300, 250, 200, 150, 100],
			2013: [380, 129, 173, 101, 310, 393, 386],
			2014: [363, 396, 388, 108, 325, 120, 180],
			2015: [300, 350, 300, 250, 200, 150, 100],
		};
		var databeauty = {
			2006: [121, 388, 233, 309, 133, 308, 297],
			2007: [200, 350, 300, 250, 200, 150, 100],
			2008: [380, 129, 173, 101, 310, 393, 386],
			2009: [363, 396, 388, 108, 325, 120, 180],
			2010: [300, 350, 300, 250, 200, 150, 100],
			2011: [100, 350, 300, 250, 200, 150, 100],
			2012: [280, 128, 255, 254, 313, 143, 360],
			2013: [389, 259, 262, 324, 232, 176, 196],
			2014: [111, 315, 139, 375, 204, 352, 163],
			2015: [227, 210, 328, 292, 241, 110, 130],
		};
		var timeLineData = [2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015];
		option1 = {
			baseOption: {
				timeline: {
					show: true,
					axisType: 'category',
					tooltip: {
						show: true,
						trigger: 'axis',
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
					autoPlay: true,
					currentIndex: 6,
					playInterval: 1000,
					 checkpointStyle: {
						color: 'transparent',
						borderColor: '#3a55b1'
					},
					itemStyle: {
						normal: {
							color: '#3a55b1'
						},
						emphasis: {
							color: '#3a55b1'
						}
					},
					controlStyle: {
						show:false
					},
					lineStyle: {
						color: '#3a55b1'
					},
					label: {
						normal: {
							show: true,
							interval: 'auto',
							formatter: '{value}',
							textStyle: {
								color: '#324148',
								fontFamily: '"Poppins", sans-serif',
								fontSize: 12
							}
						},
					},
					data: [],
				},
				tooltip: {
				show: true,
				trigger: 'axis',
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
			grid: [{
					show: false,
					left: '4%',
					top: '3%',
					bottom: 60,
					containLabel: true,
					width: '46%',
				}, {
					show: false,
					left: '50.5%',
					top: '3%',
					bottom: 60,
					width: '0%',
				}, {
					show: false,
					right: '4%',
					top: '3%',
					bottom: 60,
					containLabel: true,
					width: '46%',
				}, ],

				xAxis: [
					{
					type: 'category',
					inverse: true,
					position: 'top',
					axisLine: {
						show:false
					},
					axisTick: {
						show:false
					},
					axisLabel: {
						textStyle: {
							color: '#5e7d8a'
						}
					},
					splitLine: {
						lineStyle: {
							color: 'transparent',
						}
					},
				}, {
					gridIndex: 1,
					show: false,
				}, {
					gridIndex: 2,
					type: 'category',
					axisLine: {
						show: false,
					},
					axisTick: {
						show: false,
					},
					position: 'top',
					axisLabel: {
						textStyle: {
							color: '#5e7d8a'
						}
					},
					splitLine: {
						lineStyle: {
							color: 'transparent',
						}
					},
				}, ],
				yAxis: [{
					type: 'value',
					inverse: true,
					position: 'right',
					axisLine: {
						show: false
					},
					axisTick: {
						show: false
					},
					splitLine: {
						lineStyle: {
							color: 'transparent',
						}
					},
					axisLabel: {
						show: false,
					},
					data: myData,
				}, {
					gridIndex: 1,
					type: 'value',
					inverse: true,
					position: 'left',
					axisLine: {
						show: false
					},
					axisTick: {
						show: false
					},
					axisLabel: {
						show: true,
						textStyle: {
							color: '#5e7d8a'
						}

					},
					splitLine: {
						lineStyle: {
							color: 'transparent',
						}
					},
					data: myData.map(function(value) {
						return {
							value: value,
							textStyle: {
								align: 'center',
							}
						}
					}),
				}, {
					gridIndex: 2,
					type: 'value',
					inverse: true,
					position: 'left',
					axisLine: {
						show: false
					},
					axisTick: {
						show: false
					},
					axisLabel: {
						show: false,
						textStyle: {
							color: '#5e7d8a'
						}

					},
					splitLine: {
						lineStyle: {
							color: 'transparent',
						}
					},
					data: myData,
				}, ],
				series: [],

			},

			options: [],
		};
		for (var i = 0; i < timeLineData.length; i++) {
			option1.baseOption.timeline.data.push(timeLineData[i]);
			option1.options.push({
			   series: [{
						name: 's1',
						type: 'bar',
						barGap: 20,
						barWidth: 20,
						label: {
							normal: {
								show: false,
							},
							emphasis: {
								show: true,
								position: 'left',
								offset: [0, 0],
								textStyle: {
									color: '#fff',
									fontSize: 14,
								},
							},
						},
						itemStyle: {
							normal: {
								color: '#798cca',
							},
							emphasis: {
								color: '#798cca',
							},
						},
						data: databeast[timeLineData[i]],
					},


					{
						name: 's2',
						type: 'bar',
						barGap: 20,
						barWidth: 20,
						xAxisIndex: 2,
						yAxisIndex: 2,
						label: {
							normal: {
								show: false,
							},
							emphasis: {
								show: true,
								position: 'right',
								offset: [0, 0],
								textStyle: {
									color: '#fff',
									fontSize: 14,
								},
							},
						},
						itemStyle: {
							normal: {
								color: '#3a55b1',
							},
							emphasis: {
								color: '#3a55b1',
							},
						},
						data: databeauty[timeLineData[i]],
					}
				]
			});
		}
		eChart_3.setOption(option1);
		eChart_3.resize();
	}
}
/*****E-Charts function end*****/

/*****Resize function start*****/
var echartResize;
$(window).on("resize", function () {
	/*E-Chart Resize*/
	clearTimeout(echartResize);
	echartResize = setTimeout(echartsConfig, 200);
}).resize(); 
/*****Resize function end*****/

/*****Function Call start*****/
echartsConfig();
/*****Function Call end*****/