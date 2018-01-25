# upyun-banma-sdk
又拍云人工智能使用SDK
## 使用说明

### 安装

#### PHP >= 5.5

1.使用 `composer` 安装
```
composer require upyun-banma/sdk
```

### 示例 

初始化配置: 
```
require_once('vendor/autoload.php');
require_once('src/upyun.class.php');
// 初始化 UpYun
$upyun = new UpYun ('ClientKey', 'ClientSecret','/image/url/check');//参数获取可以参考文档：http://docs.upyun.com/ai/audit/ /image/url/check 是你需要请求的接口 URI 。 
```

### 请求使用  

```
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
```
### 处理结果示例 

```
Server: marco/1.12
Content-Type: application/json
Connection: keep-alive
X-Request-Id: 6bb0a05e13a158778ab173337b2bf6b5
Content-Length: 155
Date: Thu, 25 Jan 2018 03:59:54 GMT
X-Request-Path: poc-hgh-a-23, 403-zj-fud-202
{"porn":{"scores":[0.9992928504943848,0.00022050888219382614,0.0004866310628131032],"rate":0.9992928504943848,"label":0,"review":false},"status_code":200}
```

## 许可证

UPYUN PHP-SDK 基于 MIT 开源协议

<http://www.opensource.org/licenses/MIT>



