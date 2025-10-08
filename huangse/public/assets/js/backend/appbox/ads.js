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
    //读取选中的条目
    $.jstree.core.prototype.get_all_checked = function (full) {
        var obj = this.get_selected(), i, j;
        for (i = 0, j = obj.length; i < j; i++) {
            obj = obj.concat(this.get_node(obj[i]).parents);
        }
        obj = $.grep(obj, function (v, i, a) {
            return v != '#';
        });
        obj = obj.filter(function (itm, i, a) {
            return i == a.indexOf(itm);
        });
        return full ? $.map(obj, $.proxy(function (i) {
            return this.get_node(i);
        }, this)) : obj;
    };
    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/ads/index',
                    add_url: 'appbox/ads/add',
                    edit_url: 'appbox/ads/edit',
                    del_url: 'appbox/ads/del',
                    table: 'appbox_ads',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                pagination:false,
                search:false,
                commonSearch: true,
                showToggle: false,
                showColumns: false,
                showExport: false,
                columns: [
                    [
                        // {checkbox: true},
                        {field: 'positionId', title:'广告位Id',
                            searchList: Config.AdPosition,
                            formatter: Table.api.formatter.normal
                        },
                        {field: 'image', title: '图片',operate: false,formatter:function(value, row, index){
                            return "<img src='"+value+"' style='width:32px;height:32px;' onload='drawImage(this,60,60)'>";
                        }},
                        {field: 'title', title: __('标题'),operate: 'like',editable: true},
                        // {field: 'desc', title: __('desc')},
                        {field: 'todayHits', title:'今日点击',operate: false,},
                        {field: 'yesterdayHits', title:'昨日点击',operate: false,},
                        {field: 'url', title: '链接',formatter: Table.api.formatter.url},
                        {field: 'status', title: '状态',operate: false,formatter: Table.api.formatter.status,searchable:false},
                        {field: 'operate', title: __('单项修改'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate},
                        {field: 'operate', title: "全局修改(此功能为批量修改，请谨慎使用！)", table: table, events: Table.api.events.operate,
                            buttons:[
                                {
                                    name:'change',//名称 
                                    text:'修改链接',
                                    title:'修改链接',
                                    classname: 'btn btn-xs btn-info btn-view btn-dialog',
                                    icon: 'fa fa-pencil',//图标 可在添加菜单规则处 搜索图标见示例图
                                    url: 'appbox/ads/change?',//接口地址 控制器名/方法名
                                    visible:function(row){//判断显示隐藏 只有状态为待审核时展示操作按钮
                                        return true;//显示
                                    },
                                    refresh:true
                                },
                                {
                                    name:'changeicon',//名称 
                                    text:'修改图标',
                                    title:'修改图标',
                                    classname: 'btn btn-xs btn-info btn-view btn-dialog',
                                    icon: 'fa fa-pencil',//图标 可在添加菜单规则处 搜索图标见示例图
                                    url: 'appbox/ads/changeicon?',//接口地址 控制器名/方法名
                                    visible:function(row){//判断显示隐藏 只有状态为待审核时展示操作按钮
                                        return true;//显示
                                    },
                                    refresh:true
                                },
                                {
                                    name:'enableAll',//名称 
                                    text:'启用',
                                    title:'启用',
                                    classname: 'btn btn-xs btn-info btn-view btn-ajax',
                                    icon: 'fa fa-check',//图标 可在添加菜单规则处 搜索图标见示例图
                                    url: 'appbox/ads/enableAll?',//接口地址 控制器名/方法名
                                    visible:function(row){//判断显示隐藏 只有状态为待审核时展示操作按钮
                                        return true;//显示
                                    },
                                    refresh:true
                                },
                                {
                                    name:'disableAll',//名称 
                                    text:'禁用',
                                    title:'禁用',
                                    classname: 'btn btn-xs btn-info btn-view btn-ajax',
                                    icon: 'fa fa-close',//图标 可在添加菜单规则处 搜索图标见示例图
                                    url: 'appbox/ads/disableAll?',//接口地址 控制器名/方法名
                                    visible:function(row){//判断显示隐藏 只有状态为待审核时展示操作按钮
                                        return true;//显示
                                    },
                                    refresh:true
                                }
                            ],
                            formatter: Table.api.formatter.buttons
                        }
                        // {field: 'createtime', title: __('Createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        // {field: 'updatetime', title: __('Updatetime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        
                    ]
                ],
                rowStyle: function(row, index) {
                    if(index == 0){
                        window.lastRowClass = 'success';
                        return {classes: 'success'}; 
                    }

                    var rows = $('#table').bootstrapTable('getData', true);

                    
                    if(row.positionId != rows[index-1].positionId){
                        if(window.lastRowClass == 'success'){
                            window.lastRowClass = 'info';
                        }else{
                            window.lastRowClass = 'success';
                        }
                    }

                    return {classes: window.lastRowClass}; 
                }
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        change: function () {
            Controller.api.bindevent();
        },
        changeicon: function () {
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