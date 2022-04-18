<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class productsController extends Controller
{


    public function generateUniqueCode(){
        $characters = '0123456789';
        $code = '';

        while (strlen($code) < 9) {
            $position = rand(0, 10 - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (products::where('productId', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $Request)
    {
        return response()->json(products::all(), 200);
    }


    public function show($productId)
    {
        $product = products::where('productId',$productId)->first();
        return response()->json($product, 200);
    }

    public function categoryFilter($category)
    {
        $products = products::where('category', $category)->get();
        return response()->json($products, 200);
    }

    public function priceFilter(request $request)
    {
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $products = products::whereBetween('price', [$minPrice, $maxPrice])->get();
        return response()->json($products, 200);
    }

    public function searchFilter($name)
    {
        $products = products::where('name', 'like', '%'.$name.'%')->orwhere('description', 'like', '%'.$name.'%')->get();
        return response()->json($products, 200);
    }    

    public function store(Request $Request)
    {   
        $partner = auth()->user();
        $Request->merge(['productId' => $this->generateUniqueCode()]);

        $product = $Request->validate([
            'productId' => 'required|string|unique:products,productId',
            'name' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'name' => 'required|string',
            'image' => 'file|mimes:jpeg,jpg,png,bmp,tiff',
            'texture' => 'required|string',
            'size' => 'required|string',
            'location' => 'required|string',
            'color' => 'required|string',
            'discount' => 'nullable|numeric'
        ]);

        $productItem = $partner->products()->create($product);
        if($Request->has('image')){
            $productImage = $Request->image->store('uploads', 'public'); //create image path
            $image = asset(\Storage::url($productImage));//create image url
            $partner->products()->where('productId', $productItem->productId)->update(['image' => $productImage, 'imageUrl' => $image]);
        }
        return response()->json($partner->products()->where('productId', $productItem->productId )->get(), 200);
    }


    public function updateProduct (request $request, $id ) {

        $product = $request->validate([
            'name' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
            'stock' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'name' => 'nullable|string',
            'image' => 'file|mimes:jpeg,jpg,png,bmp,tiff',
            'texture' => 'nullable|string',
            'size' => 'nullable|string',
            'location' => 'nullable|string',
            'color' => 'nullable|string',
            'discount' => 'nullable|numeric'
        ]);

        $partner = auth()->user();
        $updated = $partner->products()->where('productId', $id)->update($product);
        $updatedProduct = $partner->products()->where('productId', $id)->first();
        $sql= 0;

        if($request->has('image')){
            $productImage = $request->image->store('uploads', 'public');//create image path
            $image = asset(\Storage::url($productImage));//create image url
            $img_delete = Storage::disk('public')->delete($updatedProduct->image);
            $sql = $partner->products()->where('productId', $id)->update(['image' => $productImage, 'imageUrl' => $image]);
        }

        return response()->json([$updated,$sql, $partner->products()->where('productId', $id)->get()], 200);
    }

    public function updateDiscount(request $request){
        $product = $request->validate([
            'dicountOption' => 'required|string',
            'category' => 'nullable|string',
            'comparison' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'date' => 'nullable|string',
            'productId'=>'nullable|numeric',
            'discount' => 'required|numeric',
            ]);

        $partner = auth()->user();
        $discount_flavor = $product['dicountOption'];
        switch ($discount_flavor){
            case "all":      
                $update = $partner->products()->update(['discount' => $product['discount']]);
                return response()->json($update);
                break;
            case "price":
                $update = $partner->products()->where('price',$product['comparison'], $product['amount'])->update(['discount' =>$product['discount']]);
                return response()->json($update);
                break;
            case "category":
                $update = $partner->products()->where('category', $product['category'])->update(['discount' =>$product['discount']]);
                return response()->json($update);
                break;
            case "dateCreated":
                $update = $partner->products()->where('created_at','<', $product['date'])->update(['discount' =>$product['discount']]);
                return response()->json($update);
                break;
            case "productId":
                $update = $partner->products()->where('productId', $product['productId'])->update(['discount' =>$product['discount']]);
                return response()->json($update);
                break;
        }

    }


}
