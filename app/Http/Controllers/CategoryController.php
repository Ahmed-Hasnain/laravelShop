<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    
    public function index()
    {
        $result = category::all();
        return view('admin.category',['categories'=>$result]);
    }

   
    public function manage_category(Request $req, $id = '')
    {
        if ($id>0) 
        {
            $arr['data'] = Category::find($id);

            $category['category_name'] = $arr['data']->category_name ;
            $category['category_slug'] = $arr['data']->category_slug ;
            $category['parent_category_id'] = $arr['data']->parent_category_id ;
            $category['category_image'] = $arr['data']->category_image ;
            $category['id'] = $arr['data']->id ;
            $category['is_home'] = $arr['data']->is_home ;
            $category['is_home_checked'] ='' ;
            if($arr['data']->is_home == 1){
                
                $category['is_home_checked'] ='checked' ;

            }
            $category['category'] = DB::table('categories')->where(['status'=>1])->where('id','!=',$id)->get();
            
        }
        else
        {
             $category['category_name'] = '';
             $category['category_slug'] = '';
             $category['parent_category_id'] = '';
             $category['category_image'] = '';
             $category['id'] = '';
             $category['is_home'] = '';
             $category['category'] = DB::table('categories')->where(['status'=>1])->get() ;
        }

       
        // echo "<pre>";
        // print_r($category);
        // die();
       
       return view('admin.manage_category',$category);
    }

    public function manage_category_process(Request $req)
    {
        //return $req->post();
        $req->validate([
            
            'category_image'=>'mimes:jpg,jpeg,png',
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.($req->post('id')),
        ]);

        if ($req->post('id')>0) 
        {
            $category = Category::find($req->post('id'));
            $msg = 'Category Edited Successfully';
        }
        else
        {
            $category = new Category;
            $msg = 'Category Inserted Successfully';
        }

        if ($req->hasFile('category_image')) 
        {
            $image = $req->file('category_image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $category->category_image = $image_name;
        }

        
        $category->category_name = $req->post('category_name');
        $category->category_slug = $req->post('category_slug');
        $category->parent_category_id = $req->post('parent_category_id');
        $category->is_home = 0;
        if($req->post('is_home')!=null){
            $category->is_home = 1;
        }
        $category->status = 1;
        $category->save();
        $req->session()->flash('message',$msg);
        return redirect('admin/category');

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

        $category = Category::find($req->id);
        $category->delete();
        $req->session()->flash('message','Category Deleted');
        return redirect('admin/category');
    }

    public function status(Request $req,$status,$id)
    {

        $category = Category::find($id);
        $category->status = $status;
        $category->save();
        $req->session()->flash('message','Category Status Updated');
        return redirect('admin/category');

    }
}
