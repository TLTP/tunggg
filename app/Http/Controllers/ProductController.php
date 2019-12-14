<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    public function add_product(){
    	$cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
	}
	public function all_product(){
		$all_product =DB::table('tbl_product')->get();
		$manager_product = view('admin.all_product')->with('all_product',$all_product);
		return view('admin_layout')->with('admin.all_product',$manager_product );

	}
	public function save_product( Request $request){
	$data = array();
	$data ['product_name']=$request->product_name;
	$data ['product_price']=$request->product_price;
	$data ['product_desc']=$request->product_desc;
	$data ['product_content']=$request->product_content;
	$data ['category_id']=$request->product_cate;
	$data ['brand_id']=$request->product_brand;
	$data ['product_status']=$request->product_status;
	$get_image=$request->file('product_image');
		if($get_image)
		{
			$new_image=rand(0,99).'.'.$get_image->getClientOriginalExtension();
			$get_image->move('puclic/uploads/product',$new_image);
			$data['product_image']=$new_image;
			DB::table('tbl_product')->insert($data);
    		Session::put('message','Thêm sản phẩm thành công.');
    		return Redirect::to('add-product');
		}

		$data['product_image']='';
		DB::table('tbl_product')->insert($data);
    	Session::put('message','Thêm sản phẩm thành công.');
    	return Redirect::to('add-product');
	}
	 public function unactive_product($brand_product_id)
    {
    	DB::table('tbl_product')->where('brand_id', $brand_product_id)->update(['brand_status'=>1]);
    	Session::put('message','Đã tắt kích hoạt thương hiệu thành công.');
    	return Redirect::to('all-brand-product');
    }
    public function active_product($brand_product_id)
    {
    	DB::table('tbl_product')->where('brand_id', $brand_product_id)->update(['brand_status'=>0]);
    	Session::put('message','Kích hoạt  thương hiệu thành công.');
    	return Redirect::to('all-brand-product');
    }
	   	
	public function edit_product($brand_product_id){
        $edit_product = DB::table('tbl_product')->where('brand_id',$brand_product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request,$brand_product_id){
    	$data =array();
    	$data ['brand_name']=$request->brand_product_name;
		$data ['brand_desc']=$request->brand_product_desc;
		DB::table('tbl_product')->where('brand_id',$brand_product_id)->update($data);
    	Session::put('message','Cập nhật thương hiệu sản phẩm thành công.');

		return Redirect::to('all-brand-product');

    }
    public function delete_product($brand_product_id)
    {
    	DB::table('tbl_product')->where('brand_id',$brand_product_id)->delete();
    	Session::put('message','Xoá thương hiệu sản phẩm thành công.');

		return Redirect::to('all-brand-product');
    }
}