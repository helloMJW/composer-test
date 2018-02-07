# composer-test
php-composer测试-composer包本地开发调试与自动拉取github

### step1-建立文件夹

|--composer-test
|--|--mypack
|--|--mypack-test

### step2-composer初始compoer.json文件

```
cd composer-test
composer init #按提示完成基本信息填写
```

### step3-composer.json文件修改

在文件内的最外层大括号里的末尾添加

```
    "autoload": {
        "psr-4": {
            "mypack\\myclass\\": "mypack/"
        }
    }
```
> tip: "mypack\\myclass\\": "mypack/" 类中的命令空间对应类所在的文件夹

### step4-开始写class

在composer-test/mypack/myclass.php 新建类文件
```
<?php
namespace mypack\myclass;

class mypackclass
{
	public function hellopack()
	{
		return 'hello-composer';
	}

}
```

### step5-安装包

在composer-test文件夹下执行`composer install`

### step6-编写测试代码

在composer-test/mypack-test/myclasstest.php建立测试文件
```
<?php
require dirname(__DIR__) . '/vendor/autoload.php';
$mypack = new mypack\myclass\mypackclass();

echo $mypack->hellopack();
```

### step7-自动加载文件

回到composer-test目录, 执行`composer dump-autoload --optimize`

### step8-再次回到测试目录composer-test/mypack-test

运行 `php myclass.php`  输出`hello composer`  

### 现在本地composer开发测试完成. 下步上传到composer并让其自动拉取github变更
