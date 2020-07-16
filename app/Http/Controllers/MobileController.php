<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    /**
     * @param Request $request
     * @param $case
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $case = $request->act;
        switch ($case) {
            //api data tower
            case "Tower":
                !isset($request->perpage) ? $perpage = 10 : $perpage = $request->perpage;
                $query_tower = Tower::with(['provider', 'tower_providers']);
                if($request->page = false){
                    $Tower = $query_tower->get()->toArray()['data'];
                }else{
                    $Tower = $query_tower->paginate($perpage)->toArray()['data'];
                }
                if (count($Tower) == 0) {
                    return responseJson("Data Tidak Ditemukan", [], false, "empty");
                }
                return responseJson("Data Tower Kabupaten Tabalong", $Tower, true, "success", "data_tower");
                break;

            default:
                return responseJson("act not found", [], false, "act not found");
                break;
        };
    }
}
