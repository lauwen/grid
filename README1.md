### 版本
[1.0.0版本](https://github.com/lauwen/grid/blob/master/README1.md)

[1.0.1版本(最新)](https://github.com/lauwen/grid/blob/master/README.md)
#### 运行以下命令进行本地安装
```
composer require lauwen/grid:1.0.0
```

#### 发布静态文件
```
php artisan vendor:publish --provider=Lauwen\Grid\GridServiceProvider
```

### 使用
#### 在laravel-admin的grid中使用
首先引入\Lauwen\Grid\Grid替换原有的Grid
```
$grid = new \Lauwen\Grid\Grid(new Model());
```

然后调用
```
$grid->setSubGridTitle("你的子列表标题");
$grid->setSubGridUrl("请求的数据接口地址");    // la_id::get
$grid->setSubGridColumns(["ID", "Name", "Price", "Quantity"]);  // 列标题
$grid->setSubGridFields(['detail_id', 'name', 'price', 'quantity']);    // 列字段名

或者

$grid->setSubGrid(function ($subGrid) {
    $subGrid->setSubGridTitle("你的子列表标题");
    $subGrid->setSubGridUrl("请求的数据接口地址");    // la_id::get
    $subGrid->setSubGridColumns(["ID", "Name", "Price", "Quantity"]);  // 列标题
    $subGrid->setSubGridFields(['id', 'name', 'price', 'quantity']);    // 列字段名
});
```

#### 数据接口说明
子列表通过get类型请求方式获取数据，请求数据时会传递列表主键到数据接口，键名：la_id，获取方式可参考如下
```
$id = request()->get('la_id');
```

返回的数据格式为json数组
```
[
    {
        "id": 10,
        "name": "Pork",
        "price": "25.00",
        "quantity": 2
    },
    {
        "id": 20,
        "name": "Beef",
        "price": "45.00",
        "quantity": 1
    }
]
```
