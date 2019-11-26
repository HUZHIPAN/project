<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function show()
    {
        $arr= DB::table('banner_item')->paginate(5);
        return view('admin.banner.show',['arr'=>$arr]);
    }
    public function add()
    {
        return view('admin.banner.add');
    }
    public function addData(Request $request)
    {
        $this->validate($request, [
            'img_describe' => 'required',
            'img_url' => 'required',
            'img_add' => 'required',
        ], [
            'required' => ':attribute必须填写',
        ], [
            'img_describe' => '描述',
            'img_url' => '地址',
            'img_add' => '图片',
        ]);

        $img_describe = $request->img_describe;
        $img_url = $request->img_url;
        $img_add = $request->img_add->getClientOriginalName();

        $add= DB::table('banner_item')->insert([
            'img_add' => $img_add,
            'img_url' => $img_url,
            'img_describe' => $img_describe
        ]);
        if ($add){
            $request->img_add->storeAs('admin/banner_img', $img_add,'public');
            return redirect('/admin/banner/show');
        }else{
            return redirect('/admin/banner/add');
        }



    }
    public function del(Request $request)
    {
        // 获取id
        $id =$request->id;
        // 查出这条数据
        $arr= DB::table('banner_item')->where('id', '=', $id)->first();
        // 删除这条数据
        $del =DB::table('banner_item')->where('id', '=', $id)->delete();
        // 这条数据的 图片名称
        $img_add = $arr->img_add;
        // 获得图片的绝对路径
        $url = base_path() . '/storage/app/public/admin/banner_img/' . $img_add;
        if ($del){
            if (file_exists($url)){
                unlink($url);
                return redirect('/admin/banner/show');
            }else{
                return redirect('/admin/banner/show');
            }
        }else{
            return redirect('/admin/banner/show');
        }

    }
    public function edit(Request $request)
    {
        $id =$request->id;
        $data= DB::table('banner_item')->where('id', '=', $id)->get();
        $zz =$data[0];
        foreach ($zz as $k=>$v){
            $arr[$k]=$v;
        }
        return view('admin.banner.edit',['arr'=>$arr]);
    }
    public function editData(Request $request)
    {
        $id = $request->id;
        $img_describe = $request->img_describe;
        $img_url = $request->img_url;

        $img_add = $request->img_add;
        $arr= DB::table('banner_item')->where('id', '=', $id)->first();
        $img_addd = $arr->img_add;
        if ($img_add){
            $img_add = $request->img_add->getClientOriginalName();
        }else{
            $img_add = $img_addd ;
        }

        $edit=DB::table('banner_item')
            ->where('id','=',$id)
            ->update([
                'img_describe'=>$img_describe,
                'img_url'=>$img_url,
                'img_add'=>$img_add
            ]);

        $url = base_path() . '/storage/app/public/admin/banner_img/' . $img_addd;

        if ($edit){
            if (file_exists($url)) {
                unlink($url);
            }
            $request->img_add->storeAs('admin/banner_img', $img_add,'public');
            return redirect('/admin/banner/show');
        }else{
            return redirect('/admin/banner/show');
        }
    }
}
