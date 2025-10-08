
function getRandom(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

var apk_down_arr = apk_domain.split(',');
var apk_down_arr_length = apk_down_arr.length;
var rand_index = getRandom(0, apk_down_arr_length - 1)
var current_down_domain = apk_down_arr[rand_index]

var apk_prefix = 'ssw_'
var apk_def_name = apk_prefix + app_version + '_100' + '.apk'
var apk_name = apk_prefix + app_version + '_' + channelCode + '.apk'

// console.log("🚀 ~ apk_def_name:", apk_def_name)
// console.log("🚀 ~ apk_name:", apk_name)

function downApk() {
    let anchor = document.createElement("a");
    // anchor.target = "_blank";
    let apkUrl = current_down_domain + '/ssw/' + apk_name
    let def_apkUrl = current_down_domain + '/ssw/' + apk_def_name

    // console.log("🚀 ~ downApk ~ apkUrl:", apkUrl)
    // console.log("🚀 ~ downApk ~ def_apkUrl:", def_apkUrl)

    fetch(apkUrl, {
        method: "get",
        responseType: "blob",
    }).then((response) => {
        // console.log("🚀 ~ .then ~ response:", response)
        // 处理响应
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        anchor.href = apkUrl;
        anchor.click();
    }).catch((error) => {
        // 处理错误
        console.log("catch error:", error);
        anchor.href = def_apkUrl;
        anchor.click();
    });
}