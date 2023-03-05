<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $all_suppliers = Supplier::latest()->get();
        $all_units = Unit::latest()->get();
        $all_categories = Category::latest()->get();
        return view('item.create')
                ->with("all_suppliers", $all_suppliers)
                ->with("all_units", $all_units)
                ->with("all_categories", $all_categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|min:1|max:15',
            'price'       => 'required',
            'description' => 'max:200',
            'unit_id'     => 'required|integer',
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer'
        ]);

        $this->item->name        = $request->name;
        $this->item->price       = $request->price;
        $this->item->unit_id     = $request->unit_id;
        $this->item->category_id = $request->category_id;
        $this->item->supplier_id = $request->supplier_id;
        $this->item->description = $request->description;
        
        if($request->image1){
            $this->item->image1 = $this->saveImage1($request);
        }
        if($request->image2){
            $this->item->image2 = $this->saveImage2($request);
        }

        $this->item->save();

       return redirect()->route('index');

    }

    private function saveImage1($request){
        $image_name1 = time() . "." . $request->image1->extension();
        $request->image1->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name1);
        return $image_name1;
    }

    private function saveImage2($request){
        $image_name2 = time() . ".." . $request->image2->extension();
        $request->image2->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name2);
        return $image_name2;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
        return view('item.show')->with('item',$item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item           = $this->item->findOrFail($id);
        $all_suppliers  = Supplier::latest()->get();
        $all_units      = Unit::latest()->get();
        $all_categories = Category::latest()->get();
        return view('item.edit')
                ->with("item", $item)
                ->with("all_suppliers", $all_suppliers)
                ->with("all_units", $all_units)
                ->with("all_categories", $all_categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|min:1|max:15',
            'price'       => 'required',
            'description' => 'max:200',
            'unit_id'     => 'required|integer',
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer'
        ]);

        $item              = $this->item->findOrFail($id);
        $item->name        = $request->name;
        $item->price       = $request->price;
        $item->unit_id     = $request->unit_id;
        $item->category_id = $request->category_id;
        $item->supplier_id = $request->supplier_id;
        $item->description = $request->description;

        if($request->image1){
            $this->deleteImage1($item->image1);
            $item->image1 = $this->saveImage1($request);
        }
        if($request->image2){
            $this->deleteImage2($item->image2);
            $item->image2 = $this->saveImage2($request);
        }

        $item->save();

       return redirect()->route('index');
    }

    private function deleteImage1($image_name1){
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name1;

        if(Storage::disk('local')->exists($image_path)):
            Storage::disk('local')->delete($image_path);
        endif;
    }

    private function deleteImage2($image_name2){
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name2;

        if(Storage::disk('local')->exists($image_path)):
            Storage::disk('local')->delete($image_path);
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->item->destroy($id);
        return redirect()->back();
    }

}
