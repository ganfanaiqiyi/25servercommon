define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form, undefined) {
    var Controller = {
        index: function (data) {
            console.log('test');
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'appbox/tongji/index'
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
                        {field: 'count', title: '当天注册今日登录人数'},
                        {field: 'count2', title: '当天注册总人数',searchable:false},
                        {field: 'liucun', title: '留存率',searchable:false}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            Controller.api.bindevent();

            $('#btn_submit').on('click',function(){
                var date = $('[name="date"]').val();
                console.log(date);

                var options = table.bootstrapTable('getOptions');
                options.url = 'appbox/tongji/index?date='+date;
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