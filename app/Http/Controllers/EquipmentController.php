<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipmentController extends Controller
{
public function index()
{
    $equipment = \App\Models\Equipment::all();
    return view('equipment.index', compact('equipment'));
}

public function category($category)
{
    $equipment = \App\Models\Equipment::where('category', $category)->get();
    return view('equipment.index', compact('equipment'));
}

}
