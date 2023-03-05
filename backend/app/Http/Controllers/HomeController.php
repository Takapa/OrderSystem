<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';
    private $item;

    public function __construct(Item $item)
    {
        $this->middleware('auth');
        $this->item = $item;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $all_items = Item::paginate(10);

        $category   = new Category;
        $categories = $category->getLists();
        $categoryId = $request->input('categoryId');

        $supplier   = new Supplier;
        $suppliers  = $supplier->getLists();
        $supplierId = $request->input('supplierId');

        $searchWord = $request->input('searchWord');

        return view('home')->with('all_items', $all_items)
                           ->with('categories', $categories)
                           ->with('searchWord', $searchWord)
                           ->with('categoryId', $categoryId)
                           ->with('suppliers', $suppliers)
                           ->with('supplierId', $supplierId);

    }

    public function search(Request $request)
    {
        //入力される値nameの中身を定義する
        $searchWord = $request->input('searchWord'); //商品名の値
        $categoryId = $request->input('categoryId'); //カテゴリの値
        $supplierId = $request->input('supplierId'); //カテゴリの値

        $query = Item::query();
        //商品名が入力された場合、itemsテーブルから一致する商品を$queryに代入
        if (isset($searchWord)) {
            $query->where('name', 'like', '%' . self::escapeLike($searchWord) . '%');
                //   ->orwhere('description', 'like', '%' . self::escapeLike($searchWord) . '%');

        }
        //カテゴリーが選択された場合、categoriesテーブルからcategory_idが一致する商品を$queryに代入
        if (isset($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        //サプライヤが選択された場合、suppliersテーブルからsupplier_idが一致する商品を$queryに代入
        if (isset($supplierId)) {
            $query->where('supplier_id', $supplierId);
        }

        //$queryをcategory_idの昇順に並び替えて$productsに代入
        $items = $query->orderBy('category_id', 'asc')->paginate(10);

        //$queryをcategory_idの昇順に並び替えて$productsに代入
        $items = $query->orderBy('supplier_id', 'asc')->paginate(10);

        //m_categoriesテーブルからgetLists();関数でcategory_nameとidを取得する
        $category = new Category;
        $categories = $category->getLists();
        $supplier   = new Supplier;
        $suppliers  = $supplier->getLists();

        return view('search')->with('items', $items)
                            ->with('categories', $categories)
                            ->with('searchWord', $searchWord)
                            ->with('categoryId', $categoryId)
                            ->with('suppliers', $suppliers)
                            ->with('supplierId', $supplierId);
    }
    
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }
}
