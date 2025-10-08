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

define(['jquery', 'bootstrap', 'backend', 'table', 'form', 'jstree'], function ($, undefined, Backend, Table, Form, undefined) {
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
                    index_url: 'appbox/apps/list_ajax',
                    add_url: 'appbox/apps/add',
                    edit_url: 'appbox/apps/edit',
                    del_url: 'appbox/apps/del',
                    table: 'appbox_apps',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'sort',
                pagination:false,
                columns: [
                    [
                        // {checkbox: true},
                        {field: 'image', title: '图标',formatter:function(value, row, index){
                            return "<img src='"+value+"' style='width:32px;height:32px;' onload='drawImage(this,54,54)'>";
                        }},
                        {field: 'name', title: __('Name')},
                        {field: 'type', title: '类型',formatter:function(value, row, index){
                            switch(value){
                                case 'applet':
                                    return '小程序';
                                default:
                                    return '外部链接';
                            }
                        }},
                        {field: 'version', title: '最新版本'},
                        {field: 'status', title: __('Status'), formatter: Table.api.formatter.status},
                        {field: 'url', title: '链接'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                        // {field: 'createtime', title: __('Createtime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        // {field: 'updatetime', title: __('Updatetime'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        
                    ]
                ]
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
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"), null, null, function () {
                    if ($("#treeview").size() > 0) {
                        var r = $("#treeview").jstree("get_all_checked");
                        $("input[name='row[rules]']").val(r.join(','));
                    }
                    return true;
                });
                //渲染权限节点树
                //销毁已有的节点树
                $("#treeview").jstree("destroy");
                Controller.api.rendertree(nodeData);
                //全选和展开
                $(document).on("click", "#checkall", function () {
                    $("#treeview").jstree($(this).prop("checked") ? "check_all" : "uncheck_all");
                });
                $(document).on("click", "#expandall", function () {
                    $("#treeview").jstree($(this).prop("checked") ? "open_all" : "close_all");
                });
                $("select[name='row[pid]']").trigger("change");
            },
            rendertree: function (content) {
                $("#treeview")
                        .on('redraw.jstree', function (e) {
                            $(".layer-footer").attr("domrefresh", Math.random());
                        })
                        .jstree({
                            "themes": {"stripes": true},
                            "checkbox": {
                                "keep_selected_style": false,
                            },
                            "types": {
                                "root": {
                                    "icon": "fa fa-folder-open",
                                },
                                "menu": {
                                    "icon": "fa fa-folder-open",
                                },
                                "file": {
                                    "icon": "fa fa-file-o",
                                }
                            },
                            "plugins": ["checkbox", "types"],
                            "core": {
                                'check_callback': true,
                                "data": content
                            }
                        });
            }
        }
    };
    return Controller;
});