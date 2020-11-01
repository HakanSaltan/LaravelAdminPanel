<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\UsersExport;
use App\Exports\UsersQueryExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
class ExcelAPI extends Controller
{
    //https://docs.laravel-excel.com/3.1/architecture/objects.html
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Excel::download(new UsersExport, 'users.xlsx');
        return Excel::download(new UsersQueryExport(1), 'users.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     * @param array $row
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,array $row)
    {  
        Excel::import(new UsersImport, 'users.xlsx');
        //Excel::import(new UsersImport, request()->file('your_file'));
        
        return redirect('/')->with('success', 'All good!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gorev)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

}
