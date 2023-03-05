<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Validation\Rule;

class SuppliersController extends Controller
{
    private $supplier;
    //

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function index()
    {
        $all_suppliers = Supplier::paginate(10);

        return view('admin.suppliers.index')->with('all_suppliers',$all_suppliers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|max:15',
            'tel_number' => 'required|max:15|unique:suppliers,tel_number,',
            'address'    => 'required|max:30|unique:suppliers,address,'
        ]);

        $this->supplier->name       = $request->name;
        $this->supplier->tel_number = $request->tel_number;
        $this->supplier->address    = $request->address;
        $this->supplier->save();
    
       return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|max:15',
            'tel_number' => 'required|max:15|',[Rule::unique('suppliers', 'tel_number')->whereNull('tel_number')],
            'address'    => 'required|max:30|',[Rule::unique('suppliers', 'address')->whereNull('address')]
        ]);


        $supplier             = $this->supplier->findOrFail($id);
        $supplier->name       = $request->name;
        $supplier->tel_number = $request->tel_number;
        $supplier->address    = $request->address;
        $supplier->save();
    
       return redirect()->back();
    }
}
