<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ValidateCreateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    public function rules(Request $request)
    {
        if($request->input('usertype')==='Lecturer'){
            return [
                'email'=>'required|unique:lecturers,email',
                'name'=>'required|min:4',
                'phone'=>'required',
                'Department_id'=>'required|exists:departments,id',
                'usertype'=>'required',
                'password'=>'min:5'
            ];
        }
        if($request->input('usertype')==='Operator'){
            return [
                'email'=>'unique:operators,email',
                'name'=>'required|min:4',
                'phone'=>'required',
                'usertype'=>'required',
                'password'=>'min:5'
            ];
        }

        if(!$request->input('usertype')){
            return[
                'usertype'=>'required'
            ];
        }
        
      
    }
}
