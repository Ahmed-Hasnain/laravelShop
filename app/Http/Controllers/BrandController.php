<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Brand::all();
        return view('admin.brand',['brand'=>$result]);
    }

   
    public function manage_brand(Request $req, $id = '')
    {
        if ($id>0) 
        {
            $arr['data'] = Brand::find($id);

            
           
            $brand['brand'] = $arr['data']->brand ;
            $brand['status'] = $arr['data']->status ;
            $brand['image'] = $arr['data']->image ;
            $brand['id'] = $arr['data']->id ;
            
        }
        else
        {
            $brand['brand'] = '';
            $brand['status'] = '';
            $brand['image'] = '';
            $brand['id'] = '';
        }
        // echo "<pre>";
        // print_r($category);
        // die();
       
       return view('admin.manage_brand',$brand);
    }

    public function manage_brand_process(Request $req)
    {

        if ($req->post('id')>0) 
        {
            $image_validation = 'mimes:jpeg,jpg,png';
        }
        else
        {
            $image_validation = 'required|mimes:jpeg,jpg,png';
        }


        //return $req->post();
        $req->validate([
            'brand'=>'required|unique:brands,brand,'.($req->post('id')),
            'image'=>$image_validation
        ]);

        if ($req->post('id')>0) 
        {
            $brand = Brand::find($req->post('id'));
            $msg = 'brand Edited Successfully';
        }
        else
        {
            $brand = new Brand;
            $msg = 'brand Inserted Successfully';
        }


        if ($req->hasFile('image')) 
        {
            $image = $req->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $brand->image = $image_name;

        }

        
        $brand->brand = $req->post('brand');
        $brand->status = 1;
        $brand->save();
        // echo "<pre>";
        // print_r($brand->image);
        // die();
        $req->session()->flash('message',$msg);
        return redirect('admin/brand');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req)
    {

        $brand = Brand::find($req->id);
        $brand->delete();
        $req->session()->flash('message','brand Deleted');
        return redirect('admin/brand');
    }

     public function status(Request $req,$status,$id)
    {

        $brand = Brand::find($id);
        $brand->status = $status;
        $brand->save();
        $req->session()->flash('message','brand Status Updated');
        return redirect('admin/brand');
    }
}
