define(['jquery', 'bootstrap', 'backend', 'table', 'form', 'echarts', 'echarts-theme'], function ($, undefined, Backend, Table, Form, Echarts, undefined) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/agent/index',
                    add_url: 'appbox/agent/add',
                    edit_url: 'appbox/agent/edit',
                    del_url: '',
                    multi_url: '',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                fixedColumns: true,
                fixedRightNumber: 1,
                search: false,
                columns: [
                    [
                        { checkbox: true },
                        { field: 'id', title: 'ID', searchable: false },
                        //{field: 'username', title:'用户名'},
                        { field: 'channelCode', title: '渠道代码' },
                        { field: 'price', title: '单价' },
                        //{field: 'total_pay_amount', title: '总支付'},
                        // {field: 'today_newUser', title: '今日新增',searchable:false},
                        // {field: 'today_pay_amount', title: '今日支付',searchable:false},
                        { field: 'deduction', title: '扣量', searchable: false, formatter: Controller.api.formatter.deduction },
                        { field: 'remark', title: '备注', searchable: false },
                        { field: 'status', title: '状态', formatter: Controller.api.formatter.status, searchList: { '0': '禁用', '1': '启用' } },
                        // {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate},
                        { field: 'createTime', title: __('Createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true, searchable: false },
                        {
                            field: 'operate', title: __('Operate'), table: table,
                            events: Table.api.events.operate,
                            buttons: [{
                                name: 'detail',
                                text: '统计',
                                icon: 'fa fa-list',
                                classname: 'btn btn-info btn-xs btn-detail btn-dialog',
                                url: 'appbox/agent/stat'
                            }],
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            $('.btn-search-all').on('click', function () {
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: "",
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
                table.bootstrapTable('refresh', {});
            });

            $('.btn-search-success').on('click', function () {
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: JSON.stringify({ status: 1 }),
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
                table.bootstrapTable('refresh', {});
            });

            $('.btn-search-fail').on('click', function () {
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: JSON.stringify({ status: 0 }),
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
                table.bootstrapTable('refresh', {});
            });
        },
        stat: function () {

            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/agent/stat?ids=' + ids,
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                fixedColumns: true,
                fixedRightNumber: 1,
                search: false,
                columns: [
                    [
                        { field: 'date', title: '日期', formatter: Controller.api.formatter.date, operate: 'RANGE', addclass: 'datetimerange' },
                        { field: 'install', title: '安装数', searchable: false },
                        { field: 'count', title: '安装数(实际)', searchable: false },
                        { field: 'today_pay_amount', title: '充值', searchable: false },
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            Controller.api.bindevent();

            $('#btn_submit').on('click', function () {
                var date = $('[name="datetimerange"]').val();
                console.log(ids);
                console.log(date);

                var options = table.bootstrapTable('getOptions');
                options.url = 'appbox/agent/stat?ids=' + ids + '&date=' + date;
            });


        },
        ruozhi: function () {
            console.log("ruozhi")
            // 基于准备好的dom，初始化echarts实例
            var lineChart = Echarts.init(document.getElementById('line-chart'), 'walden');
            var lineChart2 = Echarts.init(document.getElementById('line-chart2'), 'walden');
            var lineChart3 = Echarts.init(document.getElementById('line-chart3'), 'walden');
            option = {
                title: {
                    text: '活跃用户统计表'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    }
                },
                legend: {
                    data: ['总活跃用户数','新增用户数','老用户数']
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                grid: {
 
                },
                xAxis: [
                    {
                        type: 'category',
                        name:"日期",
                        boundaryGap: false,
                        data: Config.arrayTime
                    }
                ],
                yAxis: {
                    type: 'value',
                    name:"人数"
                },
                series: [
                    {
                        name: '总活跃用户数',
                        type: 'line',
                        stack: 'Total',
                        yAxisIndex: 0,
                        areaStyle: {},
                        emphasis: {
                            focus: 'series'
                        },
                        data: Config.totalUserCount
                    },
                    {
                        name: '新增用户数',
                        type: 'line',
                        stack: 'Total',
                        yAxisIndex: 0,
                        areaStyle: {},
                        emphasis: {
                            focus: 'series'
                        },
                        data: Config.arrayNewUserCount
                    },
                    {
                        name: '老用户数',
                        type: 'line',
                        stack: 'Total',
                        yAxisIndex: 0,
                        areaStyle: {},
                        emphasis: {
                            focus: 'series'
                        },
                        data: Config.arrayOldUserCount
                    }
                ]
            };
            option2 = {

                title: {
                    text: '老用户统计表'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    }
                },
                legend: {
                    data: ['所有老用户今日活跃数', '昨日注册用户今日活跃数' ,'七日前当天注册用户今日活跃数']
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                grid: {
 
                },
                xAxis: [
                    {
                        type: 'category',
                        name:"日期",
                        boundaryGap: false,
                        data: Config.arrayTime
                    }
                ],
                yAxis: {
                    type: 'value',
                    name:"人数"
                },
                series: [
                    {
                        name: '所有老用户今日活跃数',
                        type: 'line',
                        stack: 'Total',
                        yAxisIndex: 0,
                        areaStyle: {},
                        emphasis: {
                            focus: 'series'
                        },
                        data: Config.arrayOldUserCount
                    },
                    {
                        name: '昨日注册用户今日活跃数',
                        type: 'line',
                        stack: 'Total',
                        yAxisIndex: 0,
                        areaStyle: {},
                        emphasis: {
                            focus: 'series'
                        },
                        data: Config.arrayPreUserCount
                    },
                    // {
                    //     name: '七日前当天注册用户总人数',
                    //     type: 'line',
                    //     stack: 'Total',
                    //     yAxisIndex: 0,
                    //     areaStyle: {},
                    //     label: {
                    //         show: false
                    //     },
                    //     emphasis: {
                    //         focus: 'series'
                    //     },
                    //     data: Config.arrayPreNewUserCount
                    // },
                    {
                        name: '七日前当天注册用户今日活跃数',
                        type: 'line',
                        stack: 'Total',
                        yAxisIndex: 0,
                        areaStyle: {},
                        emphasis: {
                            focus: 'series'
                        },
                        data: Config.arrayPreUserCount7
                    }
                    // ,
                    // {
                    //     name: '七日前当天注册用户总人数',
                    //     type: 'line',
                    //     stack: 'Total',
                    //     yAxisIndex: 0,
                    //     areaStyle: {},
                    //     label: {
                    //         show: false
                    //     },
                    //     emphasis: {
                    //         focus: 'series'
                    //     },
                    //     data: Config.arrayPreNewUserCount7
                    // }
                ]
            };
            option3 = {

                title: {
                    text: '留存率统计表'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    }
                },
                legend: {
                    data: ['一日留存率','七日留存率']
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                grid: {
 
                },
                xAxis: [
                    {
                        type: 'category',
                        name:"日期",
                        boundaryGap: false,
                        data: Config.arrayTime
                    }
                ],
                yAxis: {
                    type: 'value',
                    name:"人数"
                },
                series: [
                    {
                        name: '一日留存率',
                        type: 'line',
                        stack: 'Total',
                        yAxisIndex: 0,
                        areaStyle: {},
                        emphasis: {
                            focus: 'series'
                        },
                        data: Config.arrayLiucun
                    },
                    {
                        name: '七日留存率',
                        type: 'line',
                        stack: 'Total',
                        yAxisIndex: 0,
                        areaStyle: {},
                        emphasis: {
                            focus: 'series'
                        },
                        data: Config.arrayLiucun7
                    }
                ]
            };

            // 使用刚指定的配置项和数据显示图表。
            lineChart.setOption(option);
            lineChart2.setOption(option2);
            lineChart3.setOption(option3);



            // $(window).resize(function () {
            //     lineChart.resize();
            // });

            // $(document).on("click", ".btn-refresh", function () {
            //     setTimeout(function () {
            //         lineChart.resize();
            //     }, 0);
            // });
        },
        shabi: function (data) {
            console.log('shabi');

            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/agent/shabi'
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                fixedColumns: true,
                fixedRightNumber: 1,
                search: false,
                columns: [
                    [
                        { field: 'time', title: '日期' },
                        { field: 'count', title: '当天注册上方选择日期登录人数' },
                        { field: 'count2', title: '当天注册总人数', searchable: false },
                        { field: 'liucun', title: '留存率', searchable: false }
                    ]
                ],
                onLoadSuccess: function (data) {
                    $('#zongliucun').text(data.zongliucun);
                    console.log(data);
                }
            });




            // 为表格绑定事件
            Table.api.bindevent(table);
            Controller.api.bindevent();

            $('#btn_submit').on('click', function () {
                var date = $('[name="date"]').val();
                console.log(date);

                var options = table.bootstrapTable('getOptions');
                options.url = 'appbox/agent/shabi?date=' + date;
                table.bootstrapTable('refresh', {});
            });
        },
        daystat: function () {
            console.log('test');
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/agent/daystat'
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                fixedColumns: true,
                fixedRightNumber: 1,
                search: false,
                columns: [
                    [
                        { field: 'date', title: '日期' },
                        // {field: 'username', title:'渠道名称'},
                        { field: 'channelCode', title: '渠道代码' },
                        { field: 'op_install', title: 'OP安装数', searchable: false },
                        { field: 'installReal', title: '安装数', searchable: false },
                        { field: 'install', title: '安装数(扣量后)', searchable: false },

                        // {field: 'installReal', title: '日新增(扣量后)',searchable:false},
                        // {field: 'today_newUser', title: '日新增(真实)',searchable:false},
                        { field: 'today_pay_amount', title: '日支付', searchable: false },

                        {
                            field: 'price', title: '转化比', searchable: false, formatter: function (value, row, index) {
                                if (row.today_pay_amount == 0) {
                                    return '-';
                                }
                                if (row.installReal == 0) {
                                    return '-';
                                }

                                //return ((row.today_pay_amount / (row.installReal*row.price)) * 100).toFixed(2) + '%';
                                return ((row.today_pay_amount / (row.install * 2.5)) * 100).toFixed(2) + '%';
                            }
                        },
                        { field: 'deduction', title: '扣量比', searchable: false, formatter: Controller.api.formatter.deduction },
                        { field: 'hits', title: '当日广告点击数', searchable: false }
                        //{field: 'remark', title: '备注',searchable:false},

                    ]
                ],
                onLoadSuccess: function (data) {
                    $('#today_newUser').text(data.today_newUser);
                    $('#today_pay_amount').text(data.today_pay_amount);
                    console.log(data);
                }
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            Controller.api.bindevent();

            $('#btn_submit').on('click', function () {
                var date = $('[name="date"]').val();
                console.log(date);

                var options = table.bootstrapTable('getOptions');
                options.url = 'appbox/agent/daystat?date=' + date;
                table.bootstrapTable('refresh', {});
            });
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            },
            formatter: {
                status: function (value, row, index) {
                    switch (value) {
                        case 0:
                            return '<span style="color:red;">禁用</span>';
                        case 1:
                            return '<span style="color:green;">正常</span>';
                        default:
                            return '<span style="color:#eee;">未知状态</span>';
                    }
                    return '<a class="btn btn-xs btn-browser">' + row.useragent.split(" ")[0] + '</a>';
                },
                deduction: function (value, row, index) {
                    return Math.floor(value * 100) + "%";
                },
                date: function (value, row, index) {
                    //return Table.api.formatter.datetime(value,row,index);
                    if (value == 0) {
                        return '-';
                    } else {
                        var dt = Table.api.formatter.datetime(value, row, index);
                        return dt.substr(0, dt.indexOf(' '));
                    }
                }
            },
        },
        utility: {
            timestampToTime: function (timestamp) {
                var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
                var Y = date.getFullYear() + '-';
                var M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
                var D = date.getDate() + ' ';
                var h = date.getHours() + ':';
                var m = date.getMinutes() + ':';
                var s = date.getSeconds();
                return Y + M + D + h + m + s;
            }
        }
    };
    return Controller;
});
