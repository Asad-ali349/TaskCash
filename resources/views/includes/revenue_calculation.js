
$( document ).ready(function() {
    $.get('cal_revenue').then((result)=> {
        var month_purchase_name=result.month_purchase_name;
        var month_purchase_sum=result.month_purchase_sum;
        var year_purchase_name=result.year_purchase_name;
        var year_purchase_sum=result.year_purchase_sum;
        var month_sale_name=result.month_sale_name;
        var month_sale_sum=result.month_sale_sum;
        var year_sale_name=result.year_sale_name;
        var year_sale_sum=result.year_sale_sum;



        try{
            var options1 = {
                chart: {
                fontFamily: 'Nunito, sans-serif',
                height: 365,
                type: 'area',
                zoom: {
                    enabled: false
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.2,
                    blur: 10,
                    left: -7,
                    top: 22
                },
                toolbar: {
                    show: false
                },
                events: {
                    mounted: function(ctx, config) {
                    const highest1 = ctx.getHighestValueInSeries(0);
                    const highest2 = ctx.getHighestValueInSeries(1);
            
                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
                        y: highest1,
                        label: {
                        style: {
                            cssClass: 'd-none'
                        }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#2196f3" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
            
                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
                        y: highest2,
                        label: {
                        style: {
                            cssClass: 'd-none'
                        }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#6d17cb" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
                    },
                }
                },
                colors: ['#2196f3'],
                dataLabels: {
                    enabled: false
                },
                markers: {
                discrete: [{
                seriesIndex: 0,
                dataPointIndex: 7,
                fillColor: '#000',
                strokeColor: '#000',
                size: 5
                }, {
                seriesIndex: 2,
                dataPointIndex: 11,
                fillColor: '#000',
                strokeColor: '#000',
                size: 4
                }]
                },
                subtitle: {
                // text: '$10,840',
                align: 'left',
                margin: 0,
                offsetX: 95,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '18px',
                    color:  '#4361ee'
                }
                },
                title: {
                // text: 'Total Profit',
                align: 'left',
                margin: 0,
                offsetX: -10,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '18px',
                    color:  '#0e1726'
                },
                },
                stroke: {
                    show: true,
                    curve: 'smooth',
                    width: 2,
                    lineCap: 'square'
                },
                series: [{
                    name: 'Purchase',
                    data: month_purchase_sum
                }  
                ],
                labels: month_purchase_name,
                xaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    show: true
                },
                labels: {
                    offsetX: 0,
                    offsetY: 5,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-xaxis-title',
                    },
                }
                },
                yaxis: {
                labels: {
                    formatter: function(value, index) {
                    return (value / 1000) + 'K'
                    },
                    offsetX: -22,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-yaxis-title',
                    },
                }
                },
                grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },   
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: -10
                }, 
                }, 
                legend: {
                position: 'top',
                horizontalAlign: 'right',
                offsetY: -50,
                fontSize: '16px',
                fontFamily: 'Nunito, sans-serif',
                markers: {
                    width: 10,
                    height: 10,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 12,
                    onClick: undefined,
                    offsetX: 0,
                    offsetY: 0
                },    
                itemMargin: {
                    horizontal: 0,
                    vertical: 20
                }
                },
                tooltip: {
                theme: 'dark',
                marker: {
                    show: true,
                },
                x: {
                    show: false,
                }
                },
                fill: {
                    type:"gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .28,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
                responsive: [{
                breakpoint: 575,
                options: {
                    legend: {
                        offsetY: -30,
                    },
                },
                }]
            }
            var options2 = {
                chart: {
                fontFamily: 'Nunito, sans-serif',
                height: 365,
                type: 'area',
                zoom: {
                    enabled: false
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.2,
                    blur: 10,
                    left: -7,
                    top: 22
                },
                toolbar: {
                    show: false
                },
                events: {
                    mounted: function(ctx, config) {
                    const highest1 = ctx.getHighestValueInSeries(0);
                    const highest2 = ctx.getHighestValueInSeries(1);
            
                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
                        y: highest1,
                        label: {
                        style: {
                            cssClass: 'd-none'
                        }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#2196f3" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
            
                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
                        y: highest2,
                        label: {
                        style: {
                            cssClass: 'd-none'
                        }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#6d17cb" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
                    },
                }
                },
                colors: ['#6d17cb'],
                dataLabels: {
                    enabled: false
                },
                markers: {
                discrete: [{
                seriesIndex: 0,
                dataPointIndex: 7,
                fillColor: '#000',
                strokeColor: '#000',
                size: 5
                }, {
                seriesIndex: 2,
                dataPointIndex: 11,
                fillColor: '#000',
                strokeColor: '#000',
                size: 4
                }]
                },
                subtitle: {
                // text: '$10,840',
                align: 'left',
                margin: 0,
                offsetX: 95,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '18px',
                    color:  '#4361ee'
                }
                },
                title: {
                // text: 'Total Profit',
                align: 'left',
                margin: 0,
                offsetX: -10,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '18px',
                    color:  '#0e1726'
                },
                },
                stroke: {
                    show: true,
                    curve: 'smooth',
                    width: 2,
                    lineCap: 'square'
                },
                series: [{
                    name: 'Sale',
                    data: month_sale_sum
                },  
                ],
                labels: month_sale_name,
                xaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    show: true
                },
                labels: {
                    offsetX: 0,
                    offsetY: 5,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-xaxis-title',
                    },
                }
                },
                yaxis: {
                labels: {
                    formatter: function(value, index) {
                    return (value / 1000) + 'K'
                    },
                    offsetX: -22,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-yaxis-title',
                    },
                }
                },
                grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },   
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: -10
                }, 
                }, 
                legend: {
                position: 'top',
                horizontalAlign: 'right',
                offsetY: -50,
                fontSize: '16px',
                fontFamily: 'Nunito, sans-serif',
                markers: {
                    width: 10,
                    height: 10,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 12,
                    onClick: undefined,
                    offsetX: 0,
                    offsetY: 0
                },    
                itemMargin: {
                    horizontal: 0,
                    vertical: 20
                }
                },
                tooltip: {
                theme: 'dark',
                marker: {
                    show: true,
                },
                x: {
                    show: false,
                }
                },
                fill: {
                    type:"gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .28,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
                responsive: [{
                breakpoint: 575,
                options: {
                    legend: {
                        offsetY: -30,
                    },
                },
                }]
            }




            var options3 = {
                chart: {
                fontFamily: 'Nunito, sans-serif',
                height: 365,
                type: 'area',
                zoom: {
                    enabled: false
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.2,
                    blur: 10,
                    left: -7,
                    top: 22
                },
                toolbar: {
                    show: false
                },
                events: {
                    mounted: function(ctx, config) {
                    const highest1 = ctx.getHighestValueInSeries(0);
                    const highest2 = ctx.getHighestValueInSeries(1);
            
                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
                        y: highest1,
                        label: {
                        style: {
                            cssClass: 'd-none'
                        }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#2196f3" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
            
                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
                        y: highest2,
                        label: {
                        style: {
                            cssClass: 'd-none'
                        }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#6d17cb" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
                    },
                }
                },
                colors: ['#2196f3', '#6d17cb'],
                dataLabels: {
                    enabled: false
                },
                markers: {
                discrete: [{
                seriesIndex: 0,
                dataPointIndex: 7,
                fillColor: '#000',
                strokeColor: '#000',
                size: 5
                }, {
                seriesIndex: 2,
                dataPointIndex: 11,
                fillColor: '#000',
                strokeColor: '#000',
                size: 4
                }]
                },
                subtitle: {
                // text: '$10,840',
                align: 'left',
                margin: 0,
                offsetX: 95,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '18px',
                    color:  '#4361ee'
                }
                },
                title: {
                // text: 'Total Profit',
                align: 'left',
                margin: 0,
                offsetX: -10,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '18px',
                    color:  '#0e1726'
                },
                },
                stroke: {
                    show: true,
                    curve: 'smooth',
                    width: 2,
                    lineCap: 'square'
                },
                series: [{
                    name: 'Purchase',
                    data: year_purchase_sum
                }, 
                
                ],
                labels: year_purchase_name,
                xaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    show: true
                },
                labels: {
                    offsetX: 0,
                    offsetY: 5,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-xaxis-title',
                    },
                }
                },
                yaxis: {
                labels: {
                    formatter: function(value, index) {
                    return (value / 1000) + 'K'
                    },
                    offsetX: -22,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-yaxis-title',
                    },
                }
                },
                grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },   
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: -10
                }, 
                }, 
                legend: {
                position: 'top',
                horizontalAlign: 'right',
                offsetY: -50,
                fontSize: '16px',
                fontFamily: 'Nunito, sans-serif',
                markers: {
                    width: 10,
                    height: 10,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 12,
                    onClick: undefined,
                    offsetX: 0,
                    offsetY: 0
                },    
                itemMargin: {
                    horizontal: 0,
                    vertical: 20
                }
                },
                tooltip: {
                theme: 'dark',
                marker: {
                    show: true,
                },
                x: {
                    show: false,
                }
                },
                fill: {
                    type:"gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .28,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
                responsive: [{
                breakpoint: 575,
                options: {
                    legend: {
                        offsetY: -30,
                    },
                },
                }]
            }
            var options4 = {
                chart: {
                fontFamily: 'Nunito, sans-serif',
                height: 365,
                type: 'area',
                zoom: {
                    enabled: false
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.2,
                    blur: 10,
                    left: -7,
                    top: 22
                },
                toolbar: {
                    show: false
                },
                events: {
                    mounted: function(ctx, config) {
                    const highest1 = ctx.getHighestValueInSeries(0);
                    const highest2 = ctx.getHighestValueInSeries(1);
            
                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
                        y: highest1,
                        label: {
                        style: {
                            cssClass: 'd-none'
                        }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#2196f3" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
            
                    ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
                        y: highest2,
                        label: {
                        style: {
                            cssClass: 'd-none'
                        }
                        },
                        customSVG: {
                            SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#6d17cb" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                            cssClass: undefined,
                            offsetX: -8,
                            offsetY: 5
                        }
                    })
                    },
                }
                },
                colors: ['#6d17cb'],
                dataLabels: {
                    enabled: false
                },
                markers: {
                discrete: [{
                seriesIndex: 0,
                dataPointIndex: 7,
                fillColor: '#000',
                strokeColor: '#000',
                size: 5
                }, {
                seriesIndex: 2,
                dataPointIndex: 11,
                fillColor: '#000',
                strokeColor: '#000',
                size: 4
                }]
                },
                subtitle: {
                // text: '$10,840',
                align: 'left',
                margin: 0,
                offsetX: 95,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '18px',
                    color:  '#4361ee'
                }
                },
                title: {
                // text: 'Total Profit',
                align: 'left',
                margin: 0,
                offsetX: -10,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '18px',
                    color:  '#0e1726'
                },
                },
                stroke: {
                    show: true,
                    curve: 'smooth',
                    width: 2,
                    lineCap: 'square'
                },
                series: [ 
                {
                    name: 'Sale',
                    data: year_sale_sum
                }, 
                
                ],
                labels: year_sale_name,
                xaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    show: true
                },
                labels: {
                    offsetX: 0,
                    offsetY: 5,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-xaxis-title',
                    },
                }
                },
                yaxis: {
                labels: {
                    formatter: function(value, index) {
                    return (value / 1000) + 'K'
                    },
                    offsetX: -22,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-yaxis-title',
                    },
                }
                },
                grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },   
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: -10
                }, 
                }, 
                legend: {
                position: 'top',
                horizontalAlign: 'right',
                offsetY: -50,
                fontSize: '16px',
                fontFamily: 'Nunito, sans-serif',
                markers: {
                    width: 10,
                    height: 10,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 12,
                    onClick: undefined,
                    offsetX: 0,
                    offsetY: 0
                },    
                itemMargin: {
                    horizontal: 0,
                    vertical: 20
                }
                },
                tooltip: {
                theme: 'dark',
                marker: {
                    show: true,
                },
                x: {
                    show: false,
                }
                },
                fill: {
                    type:"gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .28,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
                responsive: [{
                breakpoint: 575,
                options: {
                    legend: {
                        offsetY: -30,
                    },
                },
                }]
            }
            
        
            var chart1 = new ApexCharts(
                document.querySelector("#revenuePurchaseMonthly"),
                options1
            );
            var chart2 = new ApexCharts(
                document.querySelector("#revenueSaleMonthly"),
                options2
            );
            var chart3 = new ApexCharts(
                document.querySelector("#revenuePurchaseYearly"),
                options3
            );
            var chart4 = new ApexCharts(
                document.querySelector("#revenueSaleYearly"),
                options4
            );
            
            chart1.render();
            chart2.render();
            chart3.render();
            chart4.render();
        } catch(e) {
            console.log(e);
        }
    })
});  
