
function inputVal(val,unit){
    $("[name='val']").val(val);
    $("[name='unit']").val(unit);
}

define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form, undefined) {
    
    var Controller = {
        index: function () {
            $('.btn-usersearch').removeAttr('disabled');
            $('.btn-usersearch').click(function(){
                var act = $(this).attr('act');
                var val = '';

                switch(act){
                    case 'userid':
                        val = $('[name="userid"]').val();
                        if(!val){
                            alert('请输入用户id');
                            return;
                        }
                        location.href = "info?uid=" + val;
                        break;
                    case 'username':
                        val = $('[name="username"]').val();
                        if(!val){
                            alert('请输入用户名');
                            return;
                        }
                        location.href = "info?username=" + val;
                        break;
                    case 'deviceid':
                        val = $('[name="deviceid"]').val();
                        if(!val){
                            alert('请输入用户设备id');
                            return;
                        }
                        location.href = "info?deviceId=" + val;
                        break;
                    default:
                        return;
                }

                
                
                
            });
        },
        info:function(){
            $('.btn-usersearch').removeAttr('disabled');
            $('.btn-usersearch').click(function(){
                var act = $(this).attr('act');
                var val = '';

                switch(act){
                    case 'userid':
                        val = $('[name="userid"]').val();
                        if(!val){
                            alert('请输入用户id');
                            return;
                        }
                        location.href = "info?uid=" + val;
                        break;
                    case 'username':
                        val = $('[name="username"]').val();
                        if(!val){
                            alert('请输入用户名');
                            return;
                        }
                        location.href = "info?username=" + val;
                        break;
                    case 'deviceid':
                        val = $('[name="deviceid"]').val();
                        if(!val){
                            alert('请输入用户设备id');
                            return;
                        }
                        location.href = "info?deviceId=" + val;
                        break;
                    default:
                        return;
                }

                
                
                
            });

            $('.btn-edit-vip').click(function(){
                var uid = $(this).attr('uid');

                Fast.api.open("appbox/tool/editvip?ids=" + uid, "VIP编辑", {
                    callback:function(value){
                        //在这里可以接收弹出层中使用`Fast.api.close(data)`进行回传数据
                    }
                });
            });
            
            $('.btn-resetpassword').click(function(){
                var uid = $(this).attr('uid');

                Fast.api.open("appbox/tool/resetpassword?ids=" + uid, "修改密码", {
                    callback:function(value){
                        //在这里可以接收弹出层中使用`Fast.api.close(data)`进行回传数据
                    }
                });
            });

            $('.btn-edit-vip').removeAttr('disabled');
            $('.btn-resetpassword').removeAttr('disabled');
        },
        editvip:function(){
            Controller.api.bindevent();
            Form.api.bindevent($("form[role=form]"));
        }
    };
    return Controller;
});