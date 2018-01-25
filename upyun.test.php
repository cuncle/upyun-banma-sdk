<?php
require  __DIR__ . '/../vendor/autoload.php';
require  __DIR__ . '/../src/upyun.class.php';
// 初始化 UpYun
$upyun = new UpYun ('ClientKey', 'ClientSecret','/image/url/check');//参数获取可以参考文档：http://docs.upyun.com/ai/audit/

// 设置请求任务
$data = array(
    'url' => 'http://demo.b0.upaiyun.com/demo.png',        // 鉴黄的URL
    'notify_url' => 'http://notify.http.com/post',      //回调通知地址
);
// 调用拉取函数
try {
    //返回对应的任务ids
    $ids = $upyun->request($data);
    print $ids;
} catch(Exception $e) {
    echo $e->getCode();     // 错误代码
    echo $e->getMessage();  // 具体错误信息
}
