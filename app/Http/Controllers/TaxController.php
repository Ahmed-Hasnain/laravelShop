<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function index()
    {
        $result = Tax::all();
        return view('admin.tax',['tax'=>$result]);
    }

   
    public function manage_tax(Request $req, $id = '')
    {
        if ($id>0) 
        {
            $arr['data'] = Tax::find($id);

            $tax['tax_desc'] = $arr['data']->tax_desc ;
            $tax['tax_value'] = $arr['data']->tax_value ;
            $tax['id'] = $arr['data']->id ;
            
        }
        else
        {
            $tax['tax_desc'] = '';
            $tax['tax_value'] = '';
            $tax['id'] = '';
        }
        // echo "<pre>";
        // print_r($category);
        // die();
       
       return view('admin.manage_tax',$tax);
    }

    public function manage_tax_process(Request $req)
    {
        //return $req->post();
        $req->validate([
            'tax_value'=>'required|unique:taxes,tax_value,'.($req->post('id')),
        ]);

        if ($req->post('id')>0) 
        {
            $tax = Tax::find($req->post('id'));
            $msg = 'tax Edited Successfully';
        }
        else
        {
            $tax = new Tax;
            $msg = 'tax Inserted Successfully';
        }

        
        $tax->tax_desc = $req->post('tax_desc');
        $tax->tax_value = $req->post('tax_value');
        // $tax->status = 1;
        $tax->save();
        $req->session()->flash('message',$msg);
        return redirect('admin/tax');

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

        $tax = Tax::find($req->id);
        $tax->delete();
        $req->session()->flash('message','tax Deleted');
        return redirect('admin/tax');
    }

     public function status(Request $req,$status,$id)
    {

        $tax = Tax::find($id);
        // $tax->status = $status;
        $tax->save();
        $req->session()->flash('message','tax Status Updated');
        return redirect('admin/tax');
    }


}
