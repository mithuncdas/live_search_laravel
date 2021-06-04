<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class LiveSearch extends Controller
{
    public function index(){
        return view('liveSearch');
    }

    //serach fucntion 
    public function action(Request $request){
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');
            if($query != ''){
                $data = User::where('name',$query)->get();
            }
            else{
                $data = User::all();
            }

            $total_row = $data->count();
            if($total_row > 0){
                foreach($data as $row){
                    $output.='
                    <tr>
                        <td>'.$row->name.'</td>
                        <td>'.$row->email.'</td>
                       
                   </tr>
                    ';
                }

            }
            else{
                $output =  '
                <tr>
                    <td align="center" colspan="5"> No Data Found </td>
                </tr>
                ';
            }

            $data = array(
                'table_data' => $output,
            );
            echo json_encode($data);


        }
        else{
            
        }
    }
}
