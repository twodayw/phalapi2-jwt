<?php
namespace Phalapi\JWT;
use Phalapi\JWT\JWT;
/**
 * JWT客户端类 JWT_Lite
 *
 * @author twoday
 */

class Lite extends JWT
{

    /**
	 * 密钥
	 */
	private $key;

	public static $allowed_algs=array('HS256','HS512','HS384','RS256','RS384','RS512');

    /**
     * @param string $key 加密密钥
     * @param bool $debug 是否开启调试模式
     */
    public function __construct($key) {
		$this->init($key);
    }

	protected function init($key){
		$this->key = $key;
	}

    /**
     * 生成JWT
     */
	public function encodeJwt($payload,$alg='HS256',$keyID=null,$head=null) {
		try{
			return JWT::encode($payload,$this->key,$alg,$keyID,$head);
		}catch(\Exception $e){
			$rs = array();
			$rs['ret'] = 401;
			$rs['msg'] = $e->getMessage();
			return $rs;
		}
	}

    /**
     * 从header中获取AUTHORIZATION验证
     */
	public function decodeJwt() {
		$rs = array();
		$jwt = '';
		if(isset($_SERVER['HTTP_AUTHORIZATION']) && !empty($_SERVER['HTTP_AUTHORIZATION'])){
			$jwt = $_SERVER['HTTP_AUTHORIZATION'];
		}else{
			$rs['ret'] = 401;
			$rs['msg'] = 'Authorization Required!';
			return $rs;
		}
		try{
			$payload = JWT::decode($jwt,$this->key,self::$allowed_algs);
			return (array)$payload;
		}catch(\Exception $e){
			$rs['ret'] = 401;
			$rs['msg'] = $e->getMessage();
			return $rs;
		}
	}

	/**
     * 传入JWT验证
     */
	public function decodeJwtByParam($token){
        try {
            $payload = JWT::decode($token, $this->key, self::$allowed_algs);
            return (array)$payload;
        }catch(\Exception $e){
			$rs = array();
            $rs['ret']=401;
            $rs['msg']=$e->getMessage();
            return $rs;
        }
    }
}
