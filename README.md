
# 基于PhalApi2的JWT拓展


## 描述

JSON Web Token（JWT）是一个非常轻巧的规范。这个规范允许我们使用JWT在用户和服务器之间传递安全可靠的信息。

其他具体的信息请用户自行搜索.

附上:

官网地址:[http://www.phalapi.net/](http://www.phalapi.net/ "PhalApi官网")

项目GitHub地址:[https://github.com/twodayw/phalapi2-jwt.git](https://github.com/twodayw/phalapi2-jwt.git "项目Git地址")


## 安装PhalApi2-JWT

在项目的composer.json文件中，添加：

```
{
    "require": {
        "phalapi/jwt": "dev-master"
    }
}
```

配置好后，执行composer update更新操作即可。

## 配置文件
我们需要在 **./config/app.php** 配置文件中追加以下配置：

```
    /**
     * 扩展类库 - JWT扩展
     */
	'jwt' => array(
		'iss' => 'phalapi.net',
		'key' => 'secret'
	),

```

## 入门使用

初始化PhalApi2-JWT,在config/di.php中加入如下代码

```

//jwt扩展
$di->jwt = new \Phalapi\JWT\Lite($di->config->get('app.jwt.key'));

```

常用基础操作(具体API可以查阅代码中src/Lite.php)

```
// 生成JWT
\PhalApi\DI()->jwt->encodeJwt($payload);
// 从header中获取AUTHORIZATION验证
\PhalApi\DI()->jwt->decodeJwt();
// 传入JWT验证
\PhalApi\DI()->jwt->decodeJwtByParam($token);
    
```


**如果大家有更好的建议可以私聊或加入到PhalApi大家庭中前来一同维护PhalApi**
**注:笔者能力有限有说的不对的地方希望大家能够指出,也希望多多交流!**
