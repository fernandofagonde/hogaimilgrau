    // const _API_VERSION = 1
    // const _API_KEY =  'JqDF15#V4OOyKtwUBaYyr8Ies-TsO%xdilqo'
    // const _API_TOKEN = '$S54#T5l$KqNForIFq1jLCZEKN$LDMiEupRm'
    
    /*
    * Execute On Dom Load
    */
    document.addEventListener("DOMContentLoaded", function() { 
   
        const charts = {
            'chartAffiliates': document.getElementById('chartAffiliates'),
            'chartProdespCompanies': document.getElementById('chartProdespCompanies'),
            'chartProdespEducational': document.getElementById('chartProdespEducational'),
            'chartStudents': document.getElementById('chartStudents') 
        }

        const generateCharts = []
 
        const legendLabelsConfig = {
            paddingTop: 10,
            padding: 10,
            fontSize: 1,
            usePointStyle: true,
        }
 
        const chartsOptions = {

            'chartAffiliates' : {
                type: 'doughnut',
                data: {},
                options: {
                    responsive: true, 
                    plugins: {
                        legend: { 
                            position: 'bottom', 
                            labels: legendLabelsConfig
                        }, 
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) { 
 
                                    let label = ' '+ generateCharts['chartAffiliates'].data.labels[tooltipItem.dataIndex] + ' (' + tooltipItem.formattedValue + ')'
                                    //let value = ' '+ generateCharts['chartAffiliates'].data.datasets[0].data[tooltipItem.dataIndex] + ' cliente(s)'
                                    
                                    return label
                                    
                                }
                            }
                        } 
                    },
                    borderWidth: 1
                }
            },

            'chartProdespCompanies' : {
                type: 'doughnut',
                data: {},
                options: {
                    responsive: true,
                    plugins: {
                        legend: { 
                            position: 'bottom',
                            labels: legendLabelsConfig
                        }, 
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {  

                                    let label = ' '+ generateCharts['chartProdespCompanies'].data.labels[tooltipItem.dataIndex] + ' (' + tooltipItem.formattedValue + ')'
                                    //let value = ' '+ generateCharts['chartProdespCompanies'].data.datasets[0].data[tooltipItem.dataIndex] + ' venda(s)'
                                    
                                    return label

                                }
                            }
                        }  
                    },
                    borderWidth: 1
                }
            },

            'chartProdespEducational' : {
                type: 'doughnut',
                data: {},
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom', 
                            labels: legendLabelsConfig
                        }, 
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) { 
                                    
                                    let label = ' '+ generateCharts['chartProdespEducational'].data.labels[tooltipItem.dataIndex] + ' (' + tooltipItem.formattedValue + ')'
                                    return label

                                }
                            }
                        }  
                    },
                    borderWidth: 0
                }
            },

            'chartStudents' : {
                type: 'doughnut',
                data: {},
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom', 
                            labels: legendLabelsConfig
                        }, 
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) { 
                                    
                                    let label = ' '+ generateCharts['chartStudents'].data.labels[tooltipItem.dataIndex] + ' (' + tooltipItem.formattedValue + ')'
                                    return label

                                }
                            }
                        }  
                    },
                    borderWidth: 0
                }
            },

            'chartAuditorium' : {
                type: 'doughnut',
                data: {},
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom', 
                            labels: legendLabelsConfig
                        }, 
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) { 
                                    
                                    let label = ' '+ generateCharts['chartAuditorium'].data.labels[tooltipItem.dataIndex] + ' (' + tooltipItem.formattedValue + ')'
                                    return label

                                }
                            }
                        }  
                    },
                    borderWidth: 0
                }
            },
  
        }
 
        updateChart = (chartID, chartData) => {
    
            let newOptions = chartsOptions[chartID] 
  
            newOptions.data = {
                labels: chartData.labels, 
                datasets: [{ 
                    data: chartData.data,
                    backgroundColor: chartData.bg
                }]
            }  

            chartElem = __select('#'+ chartID)  
 
            generateCharts[chartID] = new Chart(chartElem.getContext('2d'), newOptions)

        }

        if(__exists(__select('.init-chart'))) {

            __selectAll('.init-chart').forEach((el) => { 
             
                let chartID = el.getAttribute('id')
 
                let elemLabels = el.dataset.labels.split(';').filter(n => n)
                let elemData = el.dataset.values.split(';').filter(n => n)
                let elemBG = el.dataset.bg.split(';').filter(n => n)
                //let elemBorders = el.dataset.borders.split(';').filter(n => n)
  
                updateChart(chartID, { labels: elemLabels, data: elemData, bg: elemBG });  //, borders: elemBorders

            })

            updateLegends = () => {
 
                if(window.innerWidth < 1600) {

                    __selectAll('.init-chart').forEach((el) => { 

                        el.removeAttribute('style')

                        let chartID = el.getAttribute('id')
 
                        generateCharts[chartID].options.plugins.legend.position = 'bottom'
                        generateCharts[chartID].update() 

                    })  

                }
                else {

                    __selectAll('.init-chart').forEach((el) => { 

                        el.removeAttribute('style')
                        
                        let chartID = el.getAttribute('id')  

                        generateCharts[chartID].options.plugins.legend.position = 'bottom'
                        generateCharts[chartID].update() 

                    })  
                    
                }

            }

            var timeToResize = 0;

            window.addEventListener('resize', (elem) => {
 
                clearInterval(timeToResize)

                timeToResize = setTimeout(() => {

                    updateLegends()

                }, 200)
 
            })

        } 
        
    })

    
    

    
    
    
   