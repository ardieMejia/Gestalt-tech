<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Page;
use App\TransactionData;
use App\MemberData;
use Carbon\Carbon;

class PagesController extends Controller
{
    //


    public function index(){
        return view('index');
    }

    public function uploadFile(Request $request){

        if ($request->input('submit') != null ){

            $file = $request->file('file');

            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // 2MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){

                // Check file size
                if($fileSize <= $maxFileSize){

                    // File upload location
                    $location = 'uploads';

                    // Upload file
                    $file->move($location,$filename);

                    // Import CSV to Database
                    $filepath = public_path($location."/".$filename);

                    // Reading file
                    $file = fopen($filepath,"r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata );

                        // Skip first row (Remove below comment if you want to skip the first row)
                        /*if($i == 0){
                          $i++;
                          continue; 
                          }*/
                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // trying to access existant data
                    if(TransactionData::first()){
                        $previously_uploaded = 'transaction_data.csv';
                    }elseif(MemberData::first()){
                        $previously_uploaded = 'member_data.csv';
                    }else{
                        $previously_uploaded = null;
                    }
                    $ignored_rows = 0;
                    $ignored = [];



                    if ($filename == "member_data.csv" && $previously_uploaded != 'member_data.csv'){

                        foreach($importData_arr as $importData){

                            // member data
                            $insertData = array(
                                "id"=>$importData[0],
                                "member_number"=>$importData[1],
                                "first_name"=>$importData[2],
                                "last_name"=>$importData[3],
                                "dob"=>Carbon::createFromFormat('d/m/Y',$importData[4]),
                                "email"=>$importData[5],
                                "gender"=>$importData[6],
                                "job_title"=>$importData[7]);


                            try {

                                Page::insertMemberData($insertData);

                            } catch (\Illuminate\Database\QueryException $e) {

                                $r = ["id"=>$importData[0],"first_name"=>$importData[2],"last_name"=>$importData[3]];
                                array_push($ignored, $r);
                                $ignored_rows++;

                            }
                        }
                        if($ignored_rows != 0){
                            Session::flash('ignored_rows', $ignored_rows);
                            Session::flash('ignored', $ignored);
                        }


                    }elseif ($filename == "transaction_data.csv" && $previously_uploaded != 'transaction_data.csv'){

                        foreach($importData_arr as $importData){

                            // transaction data
                            $insertData = array(
                                "id"=>$importData[0],
                                "amount"=>$importData[1],
                                "transaction_date"=>$importData[2], // csv uses - as delimiter, so this works
                                "member_number"=>$importData[3]);

                            Page::insertTransactionData($insertData);

                        }
                    }else{
                        return "invalid file name OR attempting to upload into non-empty table";
                    }


                    // Insert to MySQL database


                    Session::flash('message','Import Successful.');
                }else{
                    Session::flash('message','File too large. File must be less than 2MB.');
                }

            }else{
                Session::flash('message','Invalid File Extension.');
            }

        }

        // Redirect to index

        return redirect()->action('PagesController@index');
    }


}
