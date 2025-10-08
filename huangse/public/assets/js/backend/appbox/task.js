function drawImage(ImgD, width_s, height_s) {
    var image = new Image();
    image.src = ImgD.src;

    var w=0,h=0;

   
    if (image.width > 0 && image.height > 0) {
        flag = true;
        if (image.width / image.height >= width_s / height_s) {
            
            if (image.width > width_s) {
                
                w = width_s;
                h = (image.height * width_s) / image.width;
            } else {
                w = image.width;
                h = image.height;
            }
        }
        else {
            if (image.height > height_s) {
                h = height_s;
                w = (image.width * height_s) / image.height;
            } else {
                w = image.width;
                h = image.height;
            }
        }
    }

    $(ImgD).css('width',w);
    $(ImgD).css('height',h);

}

define(['jquery', 'bootstrap', 'backend', 'table', 'form', 'jstree','bootstrap-editable.min'], function ($, undefined, Backend, Table, Form, undefined) {
    
    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/task/index',
                    add_url: 'appbox/task/add',
                    edit_url: 'appbox/task/edit',
                    del_url: 'appbox/task/del',
                    table: 'appbox_task_list',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                pagination:false,
                columns: [
                    [
                        // {checkbox: true},
                        {field: 'icon', title: '图标',formatter:Table.api.formatter.image},
                        {field: 'title', title: '标题',editable: true},
                        {field: 'summary', title:'描述'},
                        {field: 'url', title: '链接',formatter: Table.api.formatter.url},
                        {field: 'rewardDuration', title: '奖励',formatter: function(value, row, index){
                            var v = value.replace('day','日');
                            return v;
                        }},
                        {field: 'status', title: '状态',formatter: Table.api.formatter.status,searchable:false},
                        {field: 'operate', title: "操作", table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ],
                
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        examine: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/task/examine',
                    table: 'appbox_task_submit',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                pagination:true,
                filter: `{"a.status": 0}`,
                columns: [
                    [
                        // {checkbox: true},
                        {field: 'icon', title: '图标',formatter:Table.api.formatter.image},
                        {field: 'title', title: '标题',editable: true},
                        {field: 'uid', title:'用户ID'},
                        {field: 'content', title: '截图',formatter: function(value, row, index){
                            //return `<a href="/uploads/${value}" target="_blank"><img src="/uploads/${value}" class="smallimg" style="width:32px;height:32px;' onload='drawImage(this,120,120)" /></a>`;
                            return `<img src="/uploads/${value}" class="smallimg" onload="drawImage(this,42,42)"  />`;
                        }},
                        {field: 'rewardDuration', title: '奖励'},
                        {field: 'status', title: '状态',formatter: function (value, row, index) {
                            switch(value){
                                case 0:
                                    return '<span style="color:blue;">等待审核</span>';
                                case 1:
                                    return '<span style="color:green;">审核成功</span>';
                                case 2:
                                    return '<span style="color:red;">审核失败</span>';
                                default:
                                    return '<span style="color:#eee;">未知状态</span>';
                            }
                            return '<a class="btn btn-xs btn-browser">' + row.useragent.split(" ")[0] + '</a>';
                        },searchable:false},
                        //{field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                        {
                            field: 'operate', title: '操作', table: table,
                            events: Table.api.events.operate,
                            buttons: [{
                                name: 'status',
                                text: '通过',
                                icon: 'fa fa-check',
                                classname: 'btn btn-success btn-xs btn-detail btn-ajax',
                                refresh: true,
                                url: 'appbox/task/setstatus?status=1'
                            },{
                                name: 'status',
                                text: '驳回',
                                icon: 'fa fa-close',
                                classname: 'btn btn-danger btn-xs btn-detail btn-ajax',
                                refresh: true,
                                url: 'appbox/task/setstatus?status=2'
                            }],
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ],
                queryParams:function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: `{"a.status": 0}`,
                        offset: params.offset,
                        limit: params.limit,
                    };
                },
                onLoadSuccess :function(){
                    var zoo = new zoom('mask', 'bigimg','smallimg');
                    zoo.init();
                }
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            $('.btn-search-default').on('click',function(){
                var options = table.bootstrapTable('getOptions');
                options.queryParams = function (params) {
                    return {
                        search: params.search,
                        sort: params.sort,
                        order: params.order,
                        filter: `{"a.status": 0}`,
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
                        //filter: JSON.stringify({status: 1}),
                        filter: `{"a.status": 1}`,
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
                        filter: `{"a.status": 2}`,
                        offset: params.offset,
                        limit: params.limit,
                    };
                };
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
                Form.api.bindevent($("form[role=form]"), function(){
                    $.get('appbox/ads/removeCache');
                    console.log('success');
                }, null, function () {
                    //console.log(success); 
                    return true;
                });
                
            }
            
        }
    };
    return Controller;
});