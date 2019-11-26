<?php

//商品
Route::group(['prefix'=>'admin/goods', 'middleware' => ['user.login']], function () {

    Route::get('add', 'admin\Goods@add');

    Route::get('list', 'admin\Goods@list');

    Route::get('editImg/{id}', 'admin\Goods@editImg');

    Route::get('editGoods/{id}', 'admin\Goods@editGoods');

    Route::post('store', 'admin\Goods@store'); //保存商品

    Route::post('edit', 'admin\Goods@editCheck');

    Route::get('delGoods/{id}', 'admin\Goods@delGoods');

    Route::get('push/{id}', 'admin\Goods@push');//商品推荐

    Route::get('editDetail/{id}', 'admin\Goods@editDetail');//商品详情

    Route::post('updateDetail', 'admin\Goods@updateDetail');//编辑详情属性

    Route::post('delDetail', 'admin\Goods@delDetail');

    Route::post('storeDetail', 'admin\Goods@storeDetail');

    Route::post('storeImg', 'admin\Goods@storeImg');

    Route::post('delImg', 'admin\Goods@delImg');


});

//商品模型规格
Route::group(['prefix'=>'admin/model', 'middleware' => ['user.login']], function(){

    Route::get('list', 'admin\Model@list');

    Route::get('add', 'admin\Model@add');

    Route::post('del', 'admin\Model@del');

    Route::post('store', 'admin\Model@store');

});

//订单
Route::group(['prefix'=>'admin/order', 'middleware' => ['user.login']], function(){

    Route::get('add', 'admin\Order@add');//添加订单，未完成功能
    
    Route::get('list', 'admin\Order@list');

    Route::post('sendOut', 'admin\Order@sendOut');//订单发货

    Route::post('status', 'admin\Order@changeStatus');//订单状态

    Route::get('getOrderDetail/{id}', 'admin\Order@getOrderDetail'); //通过id获取订单详情

    Route::get('getExpress/{id}', 'admin\Order@getExpress'); //根据订单id获取物流信息

});

//支付管理
Route::group(['prefix'=>'admin/pay', 'middleware' => ['user.login']], function(){

    Route::get('orderPay', 'admin\Finance@orderPay');

    Route::post('payNotify', 'admin\Finance@payNotify');

});


//api接口
Route::prefix('api')->group(function () {

    Route::get('type/get/{id}', 'api\Type@getType');

    Route::get('type/getall', 'api\Type@getTypeAll');

    Route::get('spec/get/{id}', 'api\Spec@getSpec');

    Route::get('attr/get/{id}', 'api\Spec@getAttr');

    Route::get('user/getId/{name}', 'api\User@getId');

    Route::get('getJoke', 'api\Index@getJoke');


});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//前台首页
Route::get('/', 'home\Index@index');


// 后台首页路由
Route::get('admin/index/index','admin\Index@index');


//后台操作->验证是否登录，验证是否有权限
Route::group(['prefix' => '/admin', 'middleware' => ['user.login', 'user.power']], function(){
    //管理员列表(搜索)
    Route::get('/adminList/index', 'admin\AdminList@index');
    //添加管理员
    Route::get('/adminList/add', 'admin\AdminList@add');
    Route::post('/adminList/sub', 'admin\AdminList@sub');
    //删除管理员
    Route::post('/adminList/del/{id}', 'admin\AdminList@del');
    //修改管理员
    Route::get('/adminList/update', 'admin\AdminList@update');
    Route::post('/adminList/upda', 'admin\AdminList@upda');

    //用户列表(搜索)
    Route::get('/userList/index', 'admin\UserList@index');
    //添加用户
    Route::get('/userList/add', 'admin\UserList@add');
    Route::post('/userList/sub', 'admin\UserList@sub');
    //删除用户
    Route::post('/userList/del/{id}', 'admin\UserList@del');
    //修改用户
    Route::get('/userList/update', 'admin\UserList@update');
    Route::post('/userList/upda', 'admin\UserList@upda');
    //更多信息
    Route::get('/userList/other', 'admin\UserList@other');

    //删除权限
    Route::post('/power/del/{id}', 'admin\Power@del');
    //添加权限
    Route::get('/power/add', 'admin\Power@add');
    Route::post('/power/sub', 'admin\Power@sub');
    //修改权限
    Route::get('/power/update', 'admin\Power@update');
    Route::post('/power/upda', 'admin\Power@upda');

    //管理员角色删除
    Route::post('/power/updel/{id}', 'admin\Power@updel');
    //管理员角色添加
    Route::get('/power/useradd', 'admin\Power@useradd');
    Route::post('/power/usersub', 'admin\Power@usersub');
    //修改管理员角色
    Route::get('/power/adupdate', 'admin\Power@adupdate');
    Route::post('/power/adupda', 'admin\Power@adupda');

    //添加角色
    Route::get('/power/roleadd', 'admin\Power@roleadd');
    Route::post('/power/rolesub', 'admin\Power@rolesub');
    //删除角色
    Route::post('/power/roledel/{id}', 'admin\Power@roledel');
    //修改角色
    Route::get('/power/roleupdate', 'admin\Power@roleupdate');
    Route::post('/power/roleupda', 'admin\Power@roleupda');

    //修改角色权限
    Route::get('/power/rpupde', 'admin\Power@rpupde');
    Route::post('/power/rpup', 'admin\Power@rpup');
    //角色权限删除
    Route::post('/power/rpdel/{id}', 'admin\Power@rpdel');
    //角色权限添加
    Route::get('/power/ropo', 'admin\Power@ropo');
    Route::post('/power/roposub', 'admin\Power@roposub');
});

//后台操作->验证是否登录
Route::group(['prefix' => '/admin', 'middleware' => ['user.login']], function(){
    //后台首页
    Route::get('/index/index','admin\Index@index');
    //管理员角色列表
    Route::get('/power/user', 'admin\Power@user');
    //权限资源列表
    Route::get('/power/index', 'admin\Power@index');
    //角色管理
    Route::get('/power/role', 'admin\Power@role');
    //角色权限
    Route::get('/power/rolpow', 'admin\Power@rolpow');
});

//后台登录
Route::get('/admin/login', 'admin\LoginController@show')->middleware('user.load');
Route::post('/admin/login', 'admin\LoginController@login')->middleware('user.load');
//后台退出
Route::get('/admin/logout', 'admin\Index@logout');


//后台分类
Route::group(['prefix'=>'admin/cates', 'middleware' => ['user.login']],function(){
    Route::get('index','admin\Cates@index');
    Route::get('create','admin\Cates@create');
    Route::post('store','admin\Cates@store');
    Route::post('update','admin\Cates@update');
    Route::get('delete','admin\Cates@delete');
});

//后台评论
Route::group(['prefix'=>'admin/comments', 'middleware' => ['user.login']],function(){
	Route::get('index','admin\Comments@index');
	Route::get('update','admin\Comments@update');
	Route::post('store','admin\Comments@store');
	Route::get('delete','admin\Comments@delete');
	Route::post('create','admin\Cates@create');
});
//后台友情链接路由
Route::group(['prefix'=>'admin/ads', 'middleware' => ['user.login']],function(){
    Route::get('show','admin\AdsController@show');
    Route::get('add','admin\AdsController@add');
    Route::post('add','admin\AdsController@addData');
    Route::get('del','admin\AdsController@del');
    Route::get('edit','admin\AdsController@edit');
    Route::post('edit','admin\AdsController@editData');
});



//后台友情链接路由
Route::group(['prefix'=>'admin/banner', 'middleware' => ['user.login']],function(){
    Route::get('show','admin\BannerController@show');
    Route::get('add','admin\BannerController@add');
    Route::post('add','admin\BannerController@addData');
    Route::get('del','admin\BannerController@del');
    Route::get('edit','admin\BannerController@edit');
    Route::post('edit','admin\BannerController@editData');
});



/********************分割线*****************************/
//个人中心订单路由
Route::get('home/order/list','home\Order@list');

//前台首页
Route::get('home/index', 'home\Index@index');

//前台登录->中间件：登录后不进入登录页
Route::get('home/login', 'home\Login@show')->middleware('home.load');
Route::post('home/login', 'home\Login@login')->middleware('home.load');
//前台注册
Route::post('home/login/register', 'home\Login@register');
//前台修改密码
Route::post('/home/login/resetpwd', 'home\Login@resetpwd');
//前台退出
Route::get('/home/logout', 'home\Index@logout');
//验证码
Route::post('home/yan', 'home\Login@yan');
Route::post('home/yanre', 'home\Login@yanre');
Route::post('home/yanup', 'home\Login@yanup');

//前台个人信息
Route::group(['prefix'=>'home/personal', 'middleware' => ['home.login']], function(){
    //显示个人资料
    Route::get('show', 'home\Personal@show');
    //修改个人资料
    Route::get('update', 'home\Personal@update');
    Route::post('upda', 'home\Personal@upda');
    Route::post('upd', 'home\Personal@upd');
    //修改支付密码
    Route::get('paypwd', 'home\Personal@paypwd');
    Route::post('paypass', 'home\Personal@paypass');
    //修改登录密码
    Route::get('logpwd', 'home\Personal@logpwd');
    Route::post('logpass', 'home\Personal@logpass');
    //收货地址
    Route::get('address', 'home\Personal@address');
    //添加地址
    Route::post('addres', 'home\Personal@addres');
    //修改地址
    Route::post('upres', 'home\Personal@upres');
    //删除地址
    Route::post('delres/{id}', 'home\Personal@delres');
    //默认地址
    Route::get('defa/{id}', 'home\Personal@defa');
    //头像
    Route::get('headimg', 'home\Personal@headimg');
    Route::post('head', 'home\Personal@head');
});


Route::get('home/index', 'home\Index@index');

Route::get('home/user', 'home\Index@index2');//无用路由



//前台商品路由
Route::group(['prefix'=>'goods'], function(){

    Route::get('list/{id}', 'home\Goods@list');

    Route::get('detail/{id}', 'home\Goods@detail');

});

Route::post('goods/addShopCar', 'home\Goods@addShopCar')->middleware('home.login');

Route::group(['prefix'=>'home/shopcart', 'middleware' => ['home.login']], function(){
    
    //查看购物车
    Route::get('show', 'home\shopcart@show');

    //删除购物车
    Route::get('del', 'home\shopcart@del');

    //删除多个购物车
    Route::post('dels', 'home\shopcart@dels');

    //加
    Route::get('jia', 'home\shopcart@jia');

    //减
    Route::get('jian', 'home\shopcart@jian');

    //提交
    Route::get('sub', 'home\shopcart@sub');

    //复选框
    Route::get('checkbox', 'home\shopcart@checkbox');


    //确认购物车 提交到订单路由
    Route::post('data', 'home\shopcart@data');

});

