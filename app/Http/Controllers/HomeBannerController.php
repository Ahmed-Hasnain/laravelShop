<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use Illuminate\Http\Request;

class HomeBannerController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = HomeBanner::all();
        return view('admin.home_banner',['home_banner'=>$result]);
    }

   
    public function manage_home_banner(Request $req, $id = '')
    {
        if ($id>0) 
        {
            $arr['data'] = HomeBanner::find($id);
           
            $home_banner['heading'] = $arr['data']->heading ;
            $home_banner['btn_txt'] = $arr['data']->btn_txt ;
            $home_banner['btn_link'] = $arr['data']->btn_link ;
            $home_banner['text_1'] = $arr['data']->text_1 ;
            $home_banner['text_2'] = $arr['data']->text_2 ;
            $home_banner['status'] = $arr['data']->status ;
            $home_banner['image'] = $arr['data']->image ;
            $home_banner['id'] = $arr['data']->id ;
            
        }
        else
        {
            $home_banner['heading'] = '';
            $home_banner['btn_txt'] = '';
            $home_banner['btn_link'] = '';
            $home_banner['text_1'] = '';
            $home_banner['text_2'] = '';
            $home_banner['status'] = '';
            $home_banner['image'] = '';
            $home_banner['id'] = '';
        }
       
       
       return view('admin.manage_home_banner',$home_banner);
    }

    public function manage_home_banner_process(Request $req)
    {

        if ($req->post('id')>0) 
        {
            $image_validation = 'mimes:jpeg,jpg,png';
        }
        else
        {
            $image_validation = 'required|mimes:jpeg,jpg,png';
        }

        $req->validate([
            'image'=>$image_validation
        ]);

        if ($req->post('id')>0) 
        {
            $home_banner = HomeBanner::find($req->post('id'));
            $msg = 'home_banner Edited Successfully';
        }
        else
        {
            $home_banner = new HomeBanner;
            $msg = 'home_banner Inserted Successfully';
        }


        if ($req->hasFile('image')) 
        {
            $image = $req->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $home_banner->image = $image_name;

        }

        
        $home_banner->heading = $req->post('heading');
        $home_banner->btn_txt = $req->post('btn_txt');
        $home_banner->btn_link = $req->post('btn_link');
        $home_banner->text_1 = $req->post('text_1');
        $home_banner->text_2 = $req->post('text_2');
        $home_banner->status = 1;
        $home_banner->save();

        $req->session()->flash('message',$msg);
        return redirect('admin/home_banner');

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

        $home_banner = HomeBanner::find($req->id);
        $home_banner->delete();
        $req->session()->flash('message','home_banner Deleted');
        return redirect('admin/home_banner');
    }

     public function status(Request $req,$status,$id)
    {

        $home_banner = HomeBanner::find($id);
        $home_banner->status = $status;
        $home_banner->save();
        $req->session()->flash('message','home_banner Status Updated');
        return redirect('admin/home_banner');
    }
}
