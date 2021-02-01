### 版本
[1.0.1版本(最新)](https://github.com/lauwen/grid/blob/master/README.md)

[1.0.0版本](https://github.com/lauwen/grid/blob/master/README1.md)
### 安装
#### 运行以下命令进行本地安装
```
composer require lauwen/grid
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
$grid->setSubGridTitle(["你的子列表标题", ...]);
$grid->setSubGridUrl(["请求的数据接口地址", ...]);    // la_id::get
$grid->setActionUrl(["保存数据的接口地址", ...]);    // la_data::post
$grid->setSubGridColumns([
    ["ID", "Name", "Price", "Quantity"],
    ...
]);  // 列标题
// 其中field为字段名，editable为该字段是否可编辑
$grid->setSubGridFields([
    [
        [
            "field"     =>  "id"
        ],
        [
            "field"     =>  "name"
        ],
        [
            "field"     =>  "price",
            "editable"  =>  true
        ],
        [
            "field"     =>  "quantity",
            "editable"  =>  true
        ],
        [
            "field"     =>  "specs"
        ],
        ...
    ],
    ...
]);    // 列字段名

或者


$grid->setSubGrid(function ($subGrid) {
    $subGrid->setSubGridTitle(["你的子列表标题", ...]);
    $subGrid->setSubGridUrl(["请求的数据接口地址", ...]);    // la_id::get
    $subGrid->setActionUrl(["保存数据的接口地址", ...]);    // la_data::post
    $subGrid->setSubGridColumns([
        ["ID", "Name", "Price", "Quantity"],
        ...
    ]);  // 列标题
    // 其中field为字段名，editable为该字段是否可编辑
    $subGrid->setSubGridFields([
        [
            [
                "field"     =>  "id"
            ],
            [
                "field"     =>  "name"
            ],
            [
                "field"     =>  "price",
                "editable"  =>  true
            ],
            [
                "field"     =>  "quantity",
                "editable"  =>  true
            ],
            [
                "field"     =>  "specs"
            ],
            ...
        ],
        [
            [
                "field"     =>  "id"
            ],
            [
                "field"     =>  "name"
            ],
            [
                "field"     =>  "price",
                "editable"  =>  true
            ],
            [
                "field"     =>  "quantity",
                "editable"  =>  true
            ],
            [
                "field"     =>  "specs"
            ],
            ...
        ]
    ]);    // 列字段名
});
```

#### 请求数据接口说明
子列表通过get类型请求方式获取数据，请求数据时会传递列表主键到数据接口，键名：la_id，获取方式可参考如下
```
$id = request()->get('la_id');
```

返回的数据格式为json数组，如果需要编辑必须返回主键为id,否则编辑后提交会有问题
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
#### 保存数据接口说明
子列表通过post类型请求方式提交数据，保存数据时会传递数据到保存接口，键名：la_data，获取方式可参考如下
```
$id = request()->post('la_data');
```

返回的数据格式为boolean类型
```
true
或者
false
```
