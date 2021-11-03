<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $result = Size::all();
        return view('admin.size',['size'=>$result]);
    }

   
    public function manage_size(Request $req, $id = '')
    {
        if ($id>0) 
        {
            $arr['data'] = Size::find($id);

            $size['size'] = $arr['data']->size ;
            $size['status'] = $arr['data']->status ;
            $size['id'] = $arr['data']->id ;
            
        }
        else
        {
            $size['size'] = '';
            $size['status'] = '';
            $size['id'] = '';
        }
        // echo "<pre>";
        // print_r($category);
        // die();
       
       return view('admin.manage_size',$size);
    }

    public function manage_size_process(Request $req)
    {
        //return $req->post();
        $req->validate([
            'size'=>'required|unique:sizes,size,'.($req->post('id')),
        ]);

        if ($req->post('id')>0) 
        {
            $size = Size::find($req->post('id'));
            $msg = 'Size Edited Successfully';
        }
        else
        {
            $size = new Size;
            $msg = 'Size Inserted Successfully';
        }

        
        $size->size = $req->post('size');
        $size->status = 1;
        $size->save();
        $req->session()->flash('message',$msg);
        return redirect('admin/size');

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

        $size = Size::find($req->id);
        $size->delete();
        $req->session()->flash('message','Size Deleted');
        return redirect('admin/size');
    }

     public function status(Request $req,$status,$id)
    {

        $size = Size::find($id);
        $size->status = $status;
        $size->save();
        $req->session()->flash('message','size Status Updated');
        return redirect('admin/size');
    }
}
