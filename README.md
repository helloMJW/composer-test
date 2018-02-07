# composer-test

> php-composer测试-composer包本地开发调试与自动拉取github

### step1-建立文件夹
```
|--composer-test
|--|--mypack
|--|--mypack-test
```
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


step1 在composer网站上提交github仓库地址

注册或登录composer后, 打开地址`https://packagist.org/packages/submit`,
把仓库地址复制粘贴到输入框中提交

step2 配置github-的仓库自动向composer网站推送代码变更

打开github登录自己的账号,  找到并打开需要同步的库. 

1. Setting -> Installations &  services -> Add service 下拉选项中搜索 'Packagist'

2. 出现一个表单User(指packagist.org的用户账号), Token(packagist中的token-详看下面), Domain (填: https://packagist.org)

Toekn获取: 登录packagist.org后, 打开个人资料 `https://packagist.org/profile/`, 点击 `show API Token`, 复制字符粘贴到github仓库里需要的Token. 再次提交github库的代码, 变更的代码就自动会更新到 https://packagist.org 中. 


### 问题记录

Q: 为什么`composer require "hellomjw/composer-test"`不成功, 执行 `composer require "hellomjw/composer-test:dev-master"`才可以. 

A: 

---

Q: 为什么下载的包和每次`composer update` 都要执行`composer dump-autoload --optimize`, 否则就会报无法找到类.

A: 

---

Q: `composer update` 执行后已同步的代码并没有下载到本地? 需要删除后包及相关文件得重新下载`composer require "hellomjw/composer-test:dev-master`才可以获取到最新的文件? 

A:
---

Q: `composer require "hellomjw/composer-test:dev-master` git was not found - 但也可以下载. 

```
  - Installing hellomjw/composer-test (dev-master 5c9407c): Cloning 5c9407c3e5
    Failed to download hellomjw/composer-test from source: Failed to clone https://github.com/helloMJW/composer-test.git, git was not found, check that it is installed and in your PATH env.

sh: git: not found

    Now trying to download from dist
  - Installing hellomjw/composer-test (dev-master 5c9407c): Downloading (100%) 
```

A: 


#### 参考资料

[Composer & Laravel 包本地开发](https://segmentfault.com/a/1190000010891972)

[composer 将远程的包更改为本地开发模式](http://www.111cn.net/phper/php-cy/111484.htm)

[How to update packages](https://packagist.org/about#how-to-update-packages)
