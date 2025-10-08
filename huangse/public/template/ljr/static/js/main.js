const API_BASE_URL = 'https://api.18mo3.info/';
const DEFAULT_CHANNEL_CODE = 'c_1';
const APK_BASE_URL = 'https://down.18mo1b.top/download/';

var Main = {
    channelCode:'',
    isIos:false,

    init:function(){
        var that = this;

        var u = navigator.userAgent;
        this.isIos = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
        if(this.isIos){
            this.iosJump();
            return;
        }

        var data = OpenInstall.parseUrlParams();

	    if(!data){
	        data = {};
	    }
	    if(!data.channelCode){
	        data.channelCode = DEFAULT_CHANNEL_CODE;
	    }

        this.channelCode = data.channelCode;

        $.ajax({url:API_BASE_URL+"channeltrack/"+this.channelCode,success:function(result){
            if(result.code == 1 && result.data == false){
                new OpenInstall({
                    appKey : "rq1mik",
                    onready : function() {
                        var m = this;
                        $('#btn_down').click(function(){
                            m.install({data:data,channelCode:data.channelCode});
                            return false;
                        });
                        $('#bgImage').click(function(){
                            m.install({data:data,channelCode:data.channelCode});
                            return false;
                        });
                        $('.goon').click(function() {
                            m.install({data:data,channelCode:data.channelCode});
                            return false;
                        });
        
                        if(!that.isIos){
                            //直接下载
                            m.install({data:data,channelCode:data.channelCode});       
                        }
                    }
                }, data);
            }else{
                $('#btn_down').click(function(){
                    that.download();
    				return false;
                });
                $('#bgImage').click(function(){
                    that.download();
    				return false;
                });
                $('.goon').click(function() {
                    that.download();
    				return false;
    			});
            }
        }});

        //c69自己的统计
        if(this.channelCode == 'c69'){
            var _hmt = _hmt || [];
            (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?dbbf6de25d465ba15a1a6a12fea2bc24";
            var s = document.getElementsByTagName("script")[0]; 
            s.parentNode.insertBefore(hm, s);
            })();
        }
    },
    download:function(){
        if(this.isIos){
            this.iosJump();
        }else{
            location.href = APK_BASE_URL+this.channelCode;
        }
    },
    iosJump:function(){
        location.href="https://www.iufjz.com?channelCode=19_1";
        return;
    }
};
