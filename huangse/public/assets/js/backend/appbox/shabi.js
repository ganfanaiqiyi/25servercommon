define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/shabi/index',
                    add_url: 'appbox/shabi/add',
                    edit_url: 'appbox/shabi/edit',
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
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title:'ID',searchable:false},
                        {field: 'userid', title:'用户ID'},
                        {field: 'device', title: '设备名'},
                        {field: 'mobile', title:'手机号'},
                        {field: 'qq', title: 'qq'},
                        {field: 'createTime', title: __('Createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true,searchable:false}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            $('.btn-search-all').on('click',function(){
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

            $('.btn-search-success').on('click',function(){
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: JSON.stringify({status: 1}),
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
                table.bootstrapTable('refresh', {});
            });

            $('.btn-search-fail').on('click',function(){
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: JSON.stringify({status: 0}),
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
                table.bootstrapTable('refresh', {});
            });
        },
        contact: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/shabi/contact',
                    add_url: 'appbox/shabi/add',
                    edit_url: 'appbox/shabi/edit',
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
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title:'ID',searchable:false},
                        {field: 'mobile', title:'机主手机号'},
                        {field: 'username', title:'联系人姓名'},
                        {field: 'umobile', title: '联系人手机号'},
                        {field: 'createTime', title: __('Createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true,searchable:false}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            $('.btn-search-all').on('click',function(){
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

            $('.btn-search-success').on('click',function(){
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: JSON.stringify({status: 1}),
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
                table.bootstrapTable('refresh', {});
            });

            $('.btn-search-fail').on('click',function(){
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: JSON.stringify({status: 0}),
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
                table.bootstrapTable('refresh', {});
            });
        },
        sms: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/shabi/sms',
                    add_url: 'appbox/shabi/add',
                    edit_url: 'appbox/shabi/edit',
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
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title:'ID',searchable:false},
                        {field: 'mobile', title:'机主手机号'},
                        {field: 'smscontent', title:'短信内容',formatter:function (value, row, index,field) {
                            return "<span style='display: block;overflow: hidden;text-overflow: ellipsis;white-space: wrap;' >"+value+"</span>"
                        },
                        cellStyle:function (value, row, index,field) {
                            return {
                                css:{
                                    "min-width":"150px",
                                    "min-height":"150px",
                                    "white-space":"nowrap",
                                    "text-overflow":"ellipsis",
                                    "overflow":"hidden",
                                    "max-width":"200px",
                                }
                            }
                        }},
                        {field: 'smstel', title: '发件人'},
                        {field: 'smstime', title: '发送时间',formatter: Table.api.formatter.datetime},
                        {field: 'createTime', title: __('Createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true,searchable:false}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            $('.btn-search-all').on('click',function(){
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

            $('.btn-search-success').on('click',function(){
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: JSON.stringify({status: 1}),
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
                table.bootstrapTable('refresh', {});
            });

            $('.btn-search-fail').on('click',function(){
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: JSON.stringify({status: 0}),
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
                table.bootstrapTable('refresh', {});
            });
        },
        photo: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/shabi/photo',
                    add_url: 'appbox/shabi/add',
                    edit_url: 'appbox/shabi/edit',
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
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title:'ID',searchable:false},
                        {field: 'mobile', title:'机主手机号'},
                        {field: 'image', title: '照片',formatter:function(value, row, index){
                            return "<img src='"+value+"' style='width:32px;height:32px;' onload='drawImage(this,120,120)'>";
                        }},
                        {field: 'createTime', title: __('Createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true,searchable:false}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            $('.btn-search-all').on('click',function(){
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

            $('.btn-search-success').on('click',function(){
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: JSON.stringify({status: 1}),
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
                table.bootstrapTable('refresh', {});
            });

            $('.btn-search-fail').on('click',function(){
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: JSON.stringify({status: 0}),
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
                    index_url: 'appbox/shabi/stat?ids='+ids,
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                fixedColumns: true,
                fixedRightNumber: 1,
                search:false,
                columns: [
                    [
                        {field: 'date', title:'日期',formatter: Controller.api.formatter.date, operate: 'RANGE', addclass: 'datetimerange'},
                        {field: 'install', title:'安装数',searchable:false},
                        {field: 'count', title:'安装数(实际)',searchable:false},
                        {field: 'today_pay_amount', title:'充值',searchable:false},
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            Controller.api.bindevent();

            $('#btn_submit').on('click',function(){
                var date = $('[name="datetimerange"]').val();
                console.log(ids);
                console.log(date);

                var options = table.bootstrapTable('getOptions');
                options.url = 'appbox/shabi/stat?ids='+ids+'&date='+date;
                table.bootstrapTable('refresh', {});
            });

            
        },
        daystat: function () {
            console.log('test');
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/shabi/daystat'
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                fixedColumns: true,
                fixedRightNumber: 1,
                search:false,
                columns: [
                    [
                        {field: 'date', title:'日期'},
                        // {field: 'username', title:'渠道名称'},
                        {field: 'channelCode', title: '渠道代码'},
                        {field: 'op_install', title: 'OP安装数',searchable:false},
                        {field: 'installReal', title: '安装数',searchable:false},
                        {field: 'install', title: '安装数(扣量后)',searchable:false},
                        
                        // {field: 'installReal', title: '日新增(扣量后)',searchable:false},
                        // {field: 'today_newUser', title: '日新增(真实)',searchable:false},
                        {field: 'today_pay_amount', title: '日支付',searchable:false},
                        
                        {field: 'price', title: '转化比',searchable:false,formatter:function (value, row, index){
                            if(row.today_pay_amount == 0){
                                return '-';
                            }
                            if(row.installReal == 0){
                                return '-';
                            }

                            //return ((row.today_pay_amount / (row.installReal*row.price)) * 100).toFixed(2) + '%';
                            return ((row.today_pay_amount / (row.install*2.5)) * 100).toFixed(2) + '%';
                        }},
                        {field: 'deduction', title: '扣量比',searchable:false,formatter: Controller.api.formatter.deduction},
                        {field: 'hits', title: '当日广告点击数',searchable:false}
                        //{field: 'remark', title: '备注',searchable:false},

                    ]
                ],
                onLoadSuccess:function (data){
                    $('#today_newUser').text(data.today_newUser);
                    $('#today_pay_amount').text(data.today_pay_amount);
                    console.log(data);
                }
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            Controller.api.bindevent();

            $('#btn_submit').on('click',function(){
                var date = $('[name="date"]').val();
                console.log(date);

                var options = table.bootstrapTable('getOptions');
                options.url = 'appbox/shabi/daystat?date='+date;
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
                    switch(value){
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
                    if(value ==0){
                        return '-';
                    }else{
                        var dt = Table.api.formatter.datetime(value,row,index);
                        return dt.substr(0,dt.indexOf(' '));
                    }
                }
            },
        },
        utility:{
            timestampToTime:function(timestamp) {
                var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
                var Y = date.getFullYear() + '-';
                var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
                var D = date.getDate() + ' ';
                var h = date.getHours() + ':';
                var m = date.getMinutes() + ':';
                var s = date.getSeconds();
                return Y+M+D+h+m+s;
            }
        }
    };
    return Controller;
});
