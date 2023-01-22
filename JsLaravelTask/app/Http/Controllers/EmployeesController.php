<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;

class EmployeesController extends Controller
{
    public function index()
    {
        //THis load the index view
        return view('index');
    }

    //Fetch Records
    public function getEmployees(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $rowperpage = $request->get('length');

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $searchValue = $search_arr['value'];


        // Total records
        $totalRecords = Employees::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Employees::select('count(*) as allcount')
            ->where('name', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch records
        $records = Employees::orderBy($columnName, $columnSortOrder)
            ->where('employees.name', 'like', '%' . $searchValue . '%')
            ->select('employees.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $username = $record->username;
            $name = $record->name;
            $email = $record->email;

            $data_arr[] = array(
                "id" => $id,
                "username" => $username,
                "name" => $name,
                "email" => $email
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }
}
