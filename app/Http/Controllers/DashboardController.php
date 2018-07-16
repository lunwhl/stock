<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Stock;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockInArrays = $this->getStockInQuantity(0);
        $stockOutArrays = $this->getStockOutQuantity(0);
        $year = Carbon::now()->year;
        $stockYears = $this->getStockYears();
        $categoryQuantities = $this->getCategoryQuantity();

        return view('dashboards.dashboard', compact(['stockInArrays', 'stockOutArrays', 'year', 'stockYears', 'categoryQuantities']));
    }

    public function getCategoryQuantity()
    {
        $categoryQuantities = Category::all();

        return $categoryQuantities;
    }

    public function getStockYears()
    {
        return Stock::all()->groupBy(function (Stock $item) {
                            return $item->created_at->format('Y');
                        });
    }

    public function getStockInQuantity($year)
    {
        if($year == 0)
        {
            $year = Carbon::now()->year;
        };

        $stockCategoryCollection = collect();
        $categories = Category::all();
        foreach($categories as $category){
            $results = Stock::where('category_id', $category->id)->where('action', 'IN')->whereYear('created_at', $year)
            ->get()
            ->groupBy(function (Stock $item) {
                return $item->created_at->format('m');
            });
            $stockCategoryCollection->put($category->name, $results);
        }

        $categoryArrays = $this->stockPushArray($stockCategoryCollection);

        return $categoryArrays;
    }

    public function getStockOutQuantity($year)
    {
        if($year == 0)
        {
            $year = Carbon::now()->year;
        };

        $stockCategoryCollection = collect();
        $categories = Category::all();
        foreach($categories as $category){
            $results = Stock::where('category_id', $category->id)->where('action', 'OUT')->whereYear('created_at', $year)
            ->get()
            ->groupBy(function (Stock $item) {
                return $item->created_at->format('m');
            });
            $stockCategoryCollection->put($category->name, $results);
        }

        $categoryArrays = $this->stockPushArray($stockCategoryCollection);

        return $categoryArrays;
    }

    public function stockPushArray($stockCategoryCollection)
    {
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $categoryArrays = [];
        foreach($stockCategoryCollection as $key => $stockCategory){
            foreach($months as $index => $month){
                if(isset($stockCategory[$month])){       
                    $categoryArrays[$key][$index] = $stockCategory[$month]->sum('quantity');
                }else{
                    $categoryArrays[$key][$index] = 0;
                }         
            }
        }

        return $categoryArrays;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stockInArrays = $this->getStockInQuantity($request->year);
        $stockOutArrays = $this->getStockOutQuantity($request->year);
        $year = $request->year;
        $stockYears = $this->getStockYears();
        $categoryQuantities = $this->getCategoryQuantity();

        return view('dashboards.dashboard', compact(['stockInArrays', 'stockOutArrays', 'year', 'stockYears', 'categoryQuantities']));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
