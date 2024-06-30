<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Data_umkm;
use App\Models\User;
use App\Models\history;
use Illuminate\Support\Facades\DB;
use Exception;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $database = app('firebase.database');
            $checkExistDataNTD = $database->getReference('needToDeliver')->getSnapshot()->exists();
            $checkExistDataOP = $database->getReference('onProgress')->getSnapshot()->exists();
            if ($checkExistDataNTD && $checkExistDataOP) {
                $dataNeedToDeliver = $database->getReference('needToDeliver')->getSnapshot()->numChildren();
                $dataOnProgress = $database->getReference('onProgress')->getSnapshot()->numChildren();
                return view(
                    'pages/Admin/dashboard',
                    [
                        'data_umkm' => Data_umkm::all(),
                        'menu' => Menu::all(),
                        'user' => User::all(),
                        'transaction' => history::all(),
                        'dataNTD' => $dataNeedToDeliver,
                        'dataOP' => $dataOnProgress,
                    ]
                );
            } else if ($checkExistDataNTD && !$checkExistDataOP) {
                $dataNeedToDeliver = $database->getReference('needToDeliver')->getSnapshot()->numChildren();
                return view(
                    'pages/Admin/dashboard',
                    [
                        'data_umkm' => Data_umkm::all(),
                        'menu' => Menu::all(),
                        'user' => User::all(),
                        'transaction' => history::all(),
                        'dataNTD' => $dataNeedToDeliver,
                        'dataOP' => null,
                    ]
                );
            } else if (!$checkExistDataNTD && $checkExistDataOP) {
                $dataOnProgress = $database->getReference('onProgress')->getSnapshot()->numChildren();
                return view(
                    'pages/Admin/dashboard',
                    [
                        'data_umkm' => Data_umkm::all(),
                        'menu' => Menu::all(),
                        'user' => User::all(),
                        'transaction' => history::all(),
                        'dataNTD' => null,
                        'dataOP' => $dataOnProgress,
                    ]
                );
            } else {
                return view(
                    'pages/Admin/dashboard',
                    [
                        'data_umkm' => Data_umkm::all(),
                        'menu' => Menu::all(),
                        'user' => User::all(),
                        'transaction' => history::all(),
                        'dataNTD' => null,
                        'dataOP' => null,
                    ]
                );
            }
        } catch (Exception) {
            return redirect()->back()->with('error', 'error occured');
        }
    }

    public function transacation()
    {
        try {
            $database = app('firebase.database');
            $checkExistDataNTD = $database->getReference('needToDeliver')->getSnapshot()->exists();
            $checkExistDataOP = $database->getReference('onProgress')->getSnapshot()->exists();
            $data = history::with(['customer', 'courier'])->get();
            if ($checkExistDataNTD && $checkExistDataOP && $data->isNotEmpty()) {
                $dataNeedToDeliver = $database->getReference('needToDeliver')->orderByChild('timestamp')->getValue();
                $dataOnProgress = $database->getReference('onProgress')->orderByChild('timestamp')->getValue();
                return view('pages.Admin.transaction', [
                    'Title' => 'Transactions',
                    'datas' => $data,
                    'dataNTD' => $dataNeedToDeliver,
                    'dataOP' => $dataOnProgress,
                ]);
            } else if ($checkExistDataNTD && $data->isNotEmpty() && !$checkExistDataOP) {
                $dataNeedToDeliver = $database->getReference('needToDeliver')->orderByChild('timestamp')->getValue();
                return view('pages.Admin.transaction', [
                    'Title' => 'Transactions',
                    'datas' => $data,
                    'dataNTD' => $dataNeedToDeliver,
                    'dataOP' => null,
                ]);
            } else if (!$checkExistDataNTD && $data->isNotEmpty() && $checkExistDataOP) {
                $dataOnProgress = $database->getReference('onProgress')->orderByChild('timestamp')->getValue();
                return view('pages.Admin.transaction', [
                    'Title' => 'Transactions',
                    'datas' => $data,
                    'dataNTD' => null,
                    'dataOP' => $dataOnProgress,
                ]);
            } else if ($data->isEmpty() && $checkExistDataOP && $checkExistDataNTD) {
                $dataNeedToDeliver = $database->getReference('needToDeliver')->orderByChild('timestamp')->getValue();
                $dataOnProgress = $database->getReference('onProgress')->orderByChild('timestamp')->getValue();
                return view('pages.Admin.transaction', [
                    'Title' => 'Transactions',
                    'datas' => null,
                    'dataNTD' => $dataNeedToDeliver,
                    'dataOP' => $dataOnProgress,
                ]);
            } else if ($data->isNotEmpty() && !$checkExistDataOP && !$checkExistDataNTD) {
                return view('pages.Admin.transaction', [
                    'Title' => 'Transactions',
                    'datas' => $data,
                    'dataNTD' => null,
                    'dataOP' => null,
                ]);
            } else if ($data->isEmpty() && !$checkExistDataOP && $checkExistDataNTD) {
                $dataNeedToDeliver = $database->getReference('needToDeliver')->orderByChild('timestamp')->getValue();
                return view('pages.Admin.transaction', [
                    'Title' => 'Transactions',
                    'datas' => null,
                    'dataNTD' => $dataNeedToDeliver,
                    'dataOP' => null,
                ]);
            } else if ($data->isEmpty() && !$checkExistDataNTD && $checkExistDataOP) {
                $dataOnProgress = $database->getReference('onProgress')->orderByChild('timestamp')->getValue();
                return view('pages.Admin.transaction', [
                    'Title' => 'Transactions',
                    'datas' => null,
                    'dataNTD' => null,
                    'dataOP' => $dataOnProgress,
                ]);
            } else {
                return view('pages.Admin.transaction', [
                    'Title' => 'Transactions',
                    'datas' => null,
                    'dataNTD' => null,
                    'dataOP' => null,
                ]);
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function convertXls()
    {
        $data = DB::table('histories')->get();
        return response()->json($data);
    }

    public function spreadsheets()
    {
        return redirect("https://docs.google.com/spreadsheets/d/1_NFV2Ih7UnwU4_dyidhky2tlBaQeW7aSQOMf494hckY/edit?usp=sharing");
    }

    public function getUserDetails(Request $request)
    {
        // Validate the request to ensure user_ids is provided and is an array
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        // Fetch users based on provided user IDs
        $userIds = $request->input('user_ids');
        $users = User::whereIn('id', $userIds)->get(['id', 'name']);

        return response()->json($users);
    }
}
