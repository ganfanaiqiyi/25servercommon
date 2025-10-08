define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/order/index',
                    add_url: '',
                    edit_url: '',
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
                sortName:'createTime',
                columns: [
                    [
                        {field: 'id', title:'订单号'},
                        {field: 'amount', title:'金额',searchable:false},
                        {field: 'uid', title: '用户ID'},
                        // {field: 'username', title: '用户名'},
                        {field: 'remark', title: '备注'},
                        {field: 'paymentMethod', title: '支付通道', formatter: Controller.api.formatter.paymentMethod},
                        {field: 'status', title: __('Status'), formatter: Controller.api.formatter.status,searchList:{'0':'等待支付','1':'支付成功','2':'支付失败'}},
                        // {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate},
                        {field: 'createTime', title: __('Createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'updateTime', title: '支付时间', formatter: Controller.api.formatter.updateTime, operate: 'RANGE', addclass: 'datetimerange', sortable: true,searchable:false},

                        // {field: 'state', checkbox: true,},
                        // {field: 'id', title: 'ID', operate: false},
                        // {field: 'username', title: __('Username'), formatter: Table.api.formatter.search},
                        // {field: 'title', title: __('Title'), operate: 'LIKE %...%', placeholder: '模糊搜索'},
                        // {field: 'url', title: __('Url'), formatter: Table.api.formatter.url},
                        // {field: 'ip', title: __('IP'), events: Table.api.events.ip, formatter: Table.api.formatter.search},
                        // {field: 'browser', title: __('Browser'), operate: false, formatter: Controller.api.formatter.browser},
                        // {field: 'createtime', title: __('Create time'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        // {
                        //     field: 'operate', title: __('Operate'), table: table,
                        //     events: Table.api.events.operate,
                        //     buttons: [{
                        //         name: 'detail',
                        //         text: __('Detail'),
                        //         icon: 'fa fa-list',
                        //         classname: 'btn btn-info btn-xs btn-detail btn-dialog',
                        //         url: 'auth/adminlog/detail'
                        //     }],
                        //     formatter: Table.api.formatter.operate
                        // }
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
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            },
            formatter: {
                status: function (value, row, index) {
                    switch(value){
                        case 0:
                            return '<span style="color:blue;">等待支付</span>';
                        case 1:
                            return '<span style="color:green;">支付成功</span>';
                        case 2:
                            return '<span style="color:red;">支付失败</span>';
                        default:
                            return '<span style="color:#eee;">未知状态</span>';
                    }
                    return '<a class="btn btn-xs btn-browser">' + row.useragent.split(" ")[0] + '</a>';
                },
                updateTime: function (value, row, index) {
                    if(row.status != 1){
                        return '-';
                    }else{
                        return Controller.utility.timestampToTime(value);
                    }
                    
                },
                paymentMethod: function (value, row, index) {
                    switch(value){
                        case 'gx_alipay':
                            return '歌行-支付宝';
                        case 'gx_wechat':
                            return '歌行-微信';
                        case 'star_alipayH5':
                            return '新星-支付宝';
                        case 'star_wechat':
                            return '新星-微信';
                        case 'mn_alipay':
                                return '猛男-支付宝';
                        default:
                            return value;
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
