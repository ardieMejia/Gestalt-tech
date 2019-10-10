<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvImportRequest extends FormRequest
{
    //
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'csv_file' => 'required|file'
        ];
    }
}
