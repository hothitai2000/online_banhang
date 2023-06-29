<?php

namespace App\Http\Controllers;
use App\Http\Controllers\WishlistController;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;

// use App\Models\Wishlists;
use App\Models\Cart;
use Session;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex(){
        $slide = Slide::all();
        $new_product = Product::where('new',1)->paginate(4);	
        $sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(8);	
        return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
        
    }
    public function getLoaiSP($type){
        $sp_theoloai = Product::where('id_type',$type)->get();
        $sp_khac = Product::where('id_type','<>',$type)->paginate(3);
        $loai = ProductType::all();
        $l_sanpham = ProductType::where('id',$type)->get();
        return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','l_sanpham'));
    }

    public function getDetail(Request $req){
        $sanpham = Product::where('id', $req->id)->first();
        // $splienquan = Product::where('id','<>',$sanpham->id,'and','id_type','=',$sanpham->id_type,)->paginate(3);
        return view('page.chitiet_sanpham',compact('sanpham'));
    }

    public function getContact(){
        return view('page.lienhe');
    }

    public function getAbout(){
        return view('page.gioithieu');
    }
    // Cart			
    // Không cần đăng nhập vẫn mua hàng được 
    					
    // public function getAddToCart(Request $req, $id){					
    //     $product = Product::find($id);					
    //     $oldCart = Session('cart')?Session::get('cart'):null;					
    //     $cart = new Cart($oldCart);					
    //     $cart->add($product,$id);					
    //     $req->session()->put('cart', $cart);					
    //     return redirect()->back();					
    // }	
    
    // Bắt buộc đăng nhập mới mua hàng
    public function getAddToCart(Request $req, $id)
    {
        if (Session::has('user')) {
            if (Product::find($id)){
                $product = Product::find($id);
                $oldCart = Session('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $cart->add($product, $id);
                $req->session()->put('cart', $cart); //dùng pthuwcs put để lưu ssanr phẩm
                return redirect()->back();
            } else {
                return '<script>alert("Không tìm thấy sản phẩm này.");window.location.assign("/");</script>';
            }
        } else {
            return '<script>alert("Vui lòng đăng nhập để sử dụng chức năng này.");window.location.assign("/login");</script>';
        }
    }
      
    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
        Session::put('cart',$cart);

        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }		
    
    //----------------------------CHECKOUT-----------------------//
    
    public function getCheckout()
    {
      if(Session::has('cart')){
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('page.checkout')->with(['cart' => Session::get('cart'),
                                                        'product_cart'=>$cart->items,
                                                        'totalPrice'=> $cart->totalPrice,
                                                        'totalQty'=>$cart->totalQty]);
      }  else{
        return redirect('page');
      }
    }

	public function postCheckout(Request $req){
		$cart = Session::get('cart');
		$customer = new Customer;
		$customer->name = $req->full_name;
		$customer->gender = $req->gender;
		$customer->email = $req->email;
		$customer->address = $req->address;
		$customer->phone_number = $req->phone;

		if(isset($req->notes)){
			$customer->note = $req->notes;
		} else{
			$customer->note = "Không có ghi chú gì";
		}

		$customer->save();
          
        $bill = new bill();															
        $bill->id_customer = $customer->id;															
        $bill->date_order = date('Y-m-d');															
                                                                
        $bill->payment = $req->payment_method;															
        if (isset($req->notes)) {															
        $bill->note = $req->notes;															
        } else {															
        $bill->note = "Không có ghi chú gì";															
        }															
        $bill->save();	


        // $wishlists = wishlist::where('id_user', Session::get('user')->id)->get();															
        // if (isset($wishlists)) {															
        //   foreach ($wishlists as $element) {															
        //     $element->delete();															
        //   }															
        // }	;
        // return redirect('page')->withSuccess("Thành công");
    
}

}