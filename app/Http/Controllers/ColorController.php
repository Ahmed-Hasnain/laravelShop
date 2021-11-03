<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
    {
        $result = Color::all();
        return view('admin.color',['color'=>$result]);
    }

   
    public function manage_color(Request $req, $id = '')
    {
        if ($id>0) 
        {
            $arr['data'] = Color::find($id);

            $color['color'] = $arr['data']->color ;
            $color['status'] = $arr['data']->status ;
            $color['id'] = $arr['data']->id ;
            
        }
        else
        {
            $color['color'] = '';
            $color['status'] = '';
            $color['id'] = '';
        }
        // echo "<pre>";
        // print_r($category);
        // die();
       
       return view('admin.manage_color',$color);
    }

    public function manage_color_process(Request $req)
    {
        //return $req->post();
        $req->validate([
            'color'=>'required|unique:colors,color,'.($req->post('id')),
        ]);

        if ($req->post('id')>0) 
        {
            $color = Color::find($req->post('id'));
            $msg = 'Color Edited Successfully';
        }
        else
        {
            $color = new Color;
            $msg = 'Color Inserted Successfully';
        }

        
        $color->color = $req->post('color');
        $color->status = 1;
        $color->save();
        $req->session()->flash('message',$msg);
        return redirect('admin/color');

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

        $color = Color::find($req->id);
        $color->delete();
        $req->session()->flash('message','Color Deleted');
        return redirect('admin/color');
    }

     public function status(Request $req,$status,$id)
    {

        $color = Color::find($id);
        $color->status = $status;
        $color->save();
        $req->session()->flash('message','Color Status Updated');
        return redirect('admin/color');
    }

}
