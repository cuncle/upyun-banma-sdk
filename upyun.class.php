<?php
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
class UpYun {
    //请求URI
    private $_apiUri;

    //密钥 ClientKey
    private $_client_key;

    //密钥 ClientSecret
    private $_client_secret;

     /**
     * 初始化 UpYun 人工智能接口
     * @param $client_key 请求的key
     * @param $client_secret 请求的密钥
     * @param $apiUri 请求接口的uri 
     */
    public function __construct($_client_key, $_client_secret,$_apiUri)
    {
        $this->_client_key= $_client_key;
        $this->_client_secret= $_client_secret;
        $this->_apiUri = $_apiUri;
    }

    //请求时间GMT 
    public function GMTdate($data)
    {
        $GMTdate = gmdate('D, d M Y H:i:s') . ' GMT'; 
        return $GMTdate;
    }

    //签名计算
    public function createSign($data)
    {   $signstr = array();
        $signstr['method'] = 'POST';
        $signstr['uri'] =  $this->_apiUri;
        $signstr['date'] = $this->GMTdate($data);
        $signature = base64_encode(hash_hmac('sha1', implode('&', $signstr), $this->_client_secret, true));
        return $signature;
    } 
    // client 用例

    public function process($data, $url,$method = 'POST') {
        $sign = $this->createSign($data);
        $date_gmt_header = gmdate('D, d M Y H:i:s') . ' GMT';
        $sign_header =  "UPYUN ".$this->_client_key.":".$sign; 
        $client = new Client([
            'timeout' => '30',
        ]);
        $method = 'POST';
        $response = $client->request($method, $url, [
            'headers' => [
                'Authorization' =>   $sign_header,
                'Date' => $date_gmt_header
            ],
            'body' => $data
        ]);
        foreach ($response->getHeaders() as $name => $values) {
            echo $name . ': ' . implode(', ', $values) . "\r\n";
        };
        $body = $response->getBody()->getContents();
        //$code = $response->getStatusCode(); 
        echo $body;
        return json_decode($body, true);
    }

       //请求data
       public function request($data)
       {
         $data=json_encode($data); 
         $this->process($data, 'http://banma.api.upyun.com'.$this->_apiUri, 'POST');
       }
    }
 ?>
