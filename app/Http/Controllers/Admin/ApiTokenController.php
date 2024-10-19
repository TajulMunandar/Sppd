<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiToken;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApiTokenController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Api Token';
        $data = ApiToken::all();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('api-token.edit', $data->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.api_token.index', compact('title'));
    }

    public function edit(ApiToken $api)
    {

    }
}
