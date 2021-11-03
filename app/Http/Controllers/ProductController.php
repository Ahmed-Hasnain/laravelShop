<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
    {
        $result = Product::all();
        return view('admin.product',['product'=>$result]);
    }

   
    public function manage_product(Request $req, $id = '')
    {
        if ($id>0) 
        {
            $arr['data'] = Product::find($id);

            $product['category_id'] = $arr['data']->category_id ;
            $product['brand_id'] = $arr['data']->brand_id ;
            $product['name'] = $arr['data']->name ;
            $product['model'] = $arr['data']->model ;
            $product['short_desc'] = $arr['data']->short_desc ;
            $product['desc'] = $arr['data']->desc ;
            $product['keywords'] = $arr['data']->keywords ;
            $product['technical_specs'] = $arr['data']->technical_specs ;
            $product['uses'] = $arr['data']->uses ;
            $product['warranty'] = $arr['data']->warranty ;
            $product['lead_time'] = $arr['data']->lead_time ;
            $product['tax_id'] = $arr['data']->tax_id ;
            $product['is_promo'] = $arr['data']->is_promo ;
            $product['is_featured'] = $arr['data']->is_featured ;
            $product['is_discounted'] = $arr['data']->is_discounted ;
            $product['is_trending'] = $arr['data']->is_trending ;
            $product['status'] = $arr['data']->status ;
            $product['slug'] = $arr['data']->slug ;
            $product['image'] = $arr['data']->image ;
            $product['id'] = $arr['data']->id ;
            $product['product_attrArr'] = DB::table('product_attr')->where(['product_id'=>$id])->get() ;

            $product_imagesArr = DB::table('product_images')
            ->where(['product_id'=>$id])
            ->get() ;

            //  echo "<pre>";
            // print_r($product_imagesArr) ;
            // echo "</pre>";
            // die();

            if (!isset($product_imagesArr)) {
                $product['product_imagesArr'][0]['images']='';
                $product['product_imagesArr'][0]['id']='';
            }
            else{
                $product['product_imagesArr']=$product_imagesArr;
            }

           
           
            
        }
        else
        {
            $product['category_id'] = '' ;
            $product['brand_id'] = '';
            $product['name'] = '' ;
            $product['model'] ='';
            $product['short_desc'] =  ''  ;
            $product['desc'] = '' ;
            $product['keywords'] = '' ;
            $product['technical_specs'] =  '' ;
            $product['uses'] = '' ;
            $product['warranty'] = '' ;
            $product['lead_time'] ='' ;
            $product['tax_id'] ='' ;
            $product['is_promo'] ='' ;
            $product['is_featured'] = '' ;
            $product['is_discounted'] ='' ;
            $product['is_trending'] ='' ;
            $product['status'] = '' ;
            $product['slug'] = '' ;
            $product['image'] = '' ;
            $product['id'] = '' ;

            $product['product_attrArr'][0]['id']= '';
            $product['product_attrArr'][0]['sku']= '';
            $product['product_attrArr'][0]['attr_image']= '';
            $product['product_attrArr'][0]['mrp']= '';
            $product['product_attrArr'][0]['price']= '';
            $product['product_attrArr'][0]['qty']= '';
            $product['product_attrArr'][0]['size_id']= '';
            $product['product_attrArr'][0]['color_id']= '';
            $product['product_attrArr'][0]['product_id']= '';
            $product['product_imagesArr'][0]['images']='';
            $product['product_imagesArr'][0]['id']='';
            //  echo "<pre>";
            // print_r($product['product_attr']) ;
            // echo "</pre>";
            // die();

        }

            // echo "<pre>";
            // print_r($product) ;
            // echo "</pre>";
            // die();

            $product['category'] = DB::table('categories')->where(['status'=>1])->get() ;
            $product['brand'] = DB::table('brands')->where(['status'=>1])->get() ;

            $product['color'] = DB::table('colors')->where(['status'=>1])->get() ;

            $product['size'] = DB::table('sizes')->where(['status'=>1])->get() ;

            $product['tax'] = DB::table('taxes')->get() ;

            // echo "<pre>";
            // print_r($product['category']) ;
            // echo "</pre>";
            // die();

       
       return view('admin.manage_product',$product);
    }

    public function manage_product_process(Request $req)
    {
        //return $req->post();
        // echo "<pre>";
        // print_r($req->post());
        // die();

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
            'name'=>'required',
            'image'=>$image_validation,
            'slug'=>'required|unique:products,slug,'.($req->post('id')),
            'attr_image.*'=>'mimes:jpg,jpeg,png',
            'images.*'=>'mimes:jpg,jpeg,png'
        ]);


        $paidArr = $req->post('paid');
        $skuArr = $req->post('sku');
        $mrpArr = $req->post('mrp');
        $priceArr = $req->post('price');
        $qtyArr = $req->post('qty');
        $sizeidArr = $req->post('size');
        $coloridArr = $req->post('color');
        $attrimageArr = $req->post('attr_image');

        foreach($skuArr as $key=>$val){

            $check = DB::table('product_attr')
            ->where('sku','=',$skuArr[$key])
            ->where('id','!=',$paidArr[$key])
            ->get();

            if (isset($check[0])) {
                $req->session()->flash('sku_error',$skuArr[$key] . ' SKU already used.');
                return redirect(request()->headers->get('referer'));
            }
        }



        if ($req->post('id')>0) 
        {
            $product = Product::find($req->post('id'));
            $msg = 'Product Edited Successfully';
        }
        else
        {
            $product = new Product;
            $msg = 'Product Inserted Successfully';
        }

        if ($req->hasFile('image')) 
        {

            if ($req->post('id')>0) {
                $imgArr = DB::table('products')->where(['id'=>$req->post('id')])->get();
                if(Storage::exists('public/media/'.$imgArr[0]->image)){
                Storage::delete('public/media/'.$imgArr[0]->image);
              }
            }
            

            $image = $req->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $product->image = $image_name;
        }
        
        $product->category_id = $req->post('category_id');
        $product->brand_id = $req->post('brand_id');
        $product->name = $req->post('name');
        $product->brand_id = $req->post('brand_id');
        $product->model = $req->post('model');
        $product->short_desc = $req->post('short_desc');
        $product->desc = $req->post('desc');
        $product->technical_specs = $req->post('technical_specs');
        $product->uses = $req->post('uses');
        $product->warranty = $req->post('warranty');
        $product->lead_time = $req->post('lead_time');
        $product->tax_id = $req->post('tax_id');
        $product->is_promo = $req->post('is_promo');
        $product->is_featured = $req->post('is_featured');
        $product->is_discounted = $req->post('is_discounted');
        $product->is_trending = $req->post('is_trending');
        $product->slug = $req->post('slug');
        $product->keywords = $req->post('keywords');
        $product->status = 1;
        $product->save();
        $pid = $product->id;

        //Product Attribute Start
        $productidArr = $pid;
        

        foreach($skuArr as $key=>$val)
    {       
            $productAttrArr = [];
            $productAttrArr['sku']=$skuArr[$key];
            $productAttrArr['mrp']=$mrpArr[$key];
            $productAttrArr['price']=$priceArr[$key];
            $productAttrArr['qty']=$qtyArr[$key];

            if ($sizeidArr[$key]=='') {
                $productAttrArr['size_id']=0;
            }
            else{
                $productAttrArr['size_id']=$sizeidArr[$key];
            }

            if ($coloridArr[$key]=='') {
                $productAttrArr['color_id']=0;
            }
            else{
                $productAttrArr['color_id']=$coloridArr[$key];
            }

            $productAttrArr['product_id']=$productidArr;

            if ($req->hasFile("attr_image.$key")) {

                if ($paidArr[$key] != '') {
                $imgArr = DB::table('product_attr')->where(['id'=>$paidArr[$key]])->get();
                if(Storage::exists('public/media/'.$imgArr[0]->attr_image)){
                    Storage::delete('public/media/'.$imgArr[0]->attr_image);
                }
            }



                $rand = rand('111111111','999999999');
                $attr_image = $req->file("attr_image.$key");
                $ext = $attr_image->extension();
                $image_name = $rand.'.'.$ext;
                $attr_image->storeAs('/public/media',$image_name);
                $productAttrArr['attr_image']=$image_name;
                
            }
            
          

            // echo "<pre>";
            // print_r($productAttrArr);
            // die();
            if ($paidArr[$key] != '') {
                DB::table('product_attr')->where(['id'=>$paidArr[$key]])->update($productAttrArr);
            }
            else{
                DB::table('product_attr')->insert($productAttrArr);
            }
        }
        
        //Product Attribute End

        //Product Images Start

        $piidArr = $req->post('piid');
        

           foreach($piidArr as $key=>$val)
           {

                $productImageArr['product_id']=$productidArr;


                if ($req->hasFile("images.$key")) {

                    if ($piidArr[$key] != '') {
                    $imgArr = DB::table('product_images')->where(['id'=>$piidArr[$key]])->get();
                    if(Storage::exists('public/media/'.$imgArr[0]->images)){
                        Storage::delete('public/media/'.$imgArr[0]->images);
                    }    
                }

                $rand = rand('111111111','999999999');
                $images = $req->file("images.$key");
                $ext = $images->extension();
                $image_name = $rand.'.'.$ext;
                $images->storeAs('/public/media',$image_name);
                $productImageArr['images']=$image_name;
                
                }
               
              

                
                if ($piidArr[$key] != '') {
                    DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($productImageArr);
                }
                else{
                    DB::table('product_images')->insert($productImageArr);
                }
           }

           // echo "<pre>";
           //      print_r($productImageArr['images']);
           //      die();




        //Product Images End




        $req->session()->flash('message',$msg);
        return redirect('admin/product');

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

        $product = Product::find($req->id);
        $product->delete();
        $req->session()->flash('message','Product Deleted');
        return redirect('admin/product');
    }

    public function product_attr_delete(Request $req,$paid,$pid)
    {
        $imgArr = DB::table('product_attr')->where(['id'=>$paid])->get();

        if(Storage::exists('public/media/'.$imgArr[0]->attr_image)){
            Storage::delete('public/media/'.$imgArr[0]->attr_image);
        }

        DB::table('product_attr')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

     public function product_images_delete(Request $req,$piid,$pid)
    {
        $imgArr = DB::table('product_images')->where(['id'=>$piid])->get();
        if(Storage::exists('public/media/'.$imgArr[0]->images)){
            Storage::delete('public/media/'.$imgArr[0]->images);
        }
        
        DB::table('product_images')->where(['id'=>$piid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

     public function status(Request $req,$status,$id)
    {

        $product = Product::find($id);
        $product->status = $status;
        $product->save();
        $req->session()->flash('message','Product Status Updated');
        return redirect('admin/product');
    }

}
