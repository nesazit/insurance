<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InsuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::all();

        return Inertia::render('Home', [
            'insurances' => $insurances->map(function ($insurance) {
                return [
                    'id' => $insurance->id,
                    'title' => $insurance->title,
                    'description' => $insurance->description,
                    'image' => file_exists(public_path('img/' . $insurance->image)) ? asset('img/' . $insurance->image) : asset('img/default.png'),
                    'icon' => $insurance->icon,
                    'price' => $insurance->price,
                    'status' => $insurance->status,
                    'duration' => $insurance->duration,
                ];
            })
        ]);
    }
}
