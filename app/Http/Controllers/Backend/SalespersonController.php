<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SalesPersonFormrequest;
use App\Models\SalesPerson;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;



class SalespersonController extends Controller
{
    public function index()
    {
        
        return view('backend.salesperson.index');
    }
    public function dataTable(Request $request)
    {
        $salesperson = SalesPerson::select('id', 'name', 'fg_color', 'status')
        ->orderBy('id', 'desc');
                
        return Datatables::of($salesperson)
        ->addIndexColumn()
        ->editColumn('status', function($row) {
        return $row->status == 'active' ? 'Yes' : 'No';
})
->make(true);
}
    public function store(SalesPersonFormrequest $request)
    {
        
        $validatedData = $request->validated();
        // Assign the user_id from the currently logged-in user
        $validatedData['user_id'] = Auth::id();
        $validatedData['status'] = $request->has('status') ? 'active' : 'inactive';
        // Create the SalesPerson record
        SalesPerson::create($validatedData);
        return redirect()->to(route('salespeople.index'));
    }
}
