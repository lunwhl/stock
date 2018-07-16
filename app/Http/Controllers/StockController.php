<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\Category;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    protected $rules = [
        'action' => 'required',
        'quantity' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::latest()->get();
        $categories = Category::latest()->get();

        return view('stocks.index', compact('stocks', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('stocks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        Stock::create(request()->all());
        $stocks = Stock::latest()->get();

        $category = Category::find($request->category_id);
        if($request->action == "IN"){
            $category->quantity = $category->quantity + $request->quantity;
        }else{
            $category->quantity = $category->quantity - $request->quantity;
        }
        $category->save();


        return redirect()->back()->with('success', 'Stock ' . $request->action . ' created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $categories = Category::latest()->get();
        return view('stocks.edit', compact('stock','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules);
        
        $stock->update($request->all());

        return redirect()->back()->with('success', 'Stock updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
