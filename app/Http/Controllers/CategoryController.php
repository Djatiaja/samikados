<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index(){
        return view("category.category", ['data' => [], 'jumlah_data' => "", "total_harga" => '1212212']);
    }   

    function store(){
        return view("category.create");
    }
}
