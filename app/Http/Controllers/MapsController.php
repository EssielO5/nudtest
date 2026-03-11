<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapsController extends Controller
{

    public function show_restaurants_on_maps(){
        return view('client.maps.restaurants');
    }
    public function maps_restaurants(Request $request) {

        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'latitude.required' => 'Vous devez autorisé la requête à détecter votre position'
        ]);

        $coordinates = [
            $request->longitude,
            $request->latitude,
        ];

        $restaurants = Restaurant::query()
            ->addDistance($coordinates)
            ->latest()
            ->get();


        /* $restaurants = Restaurant::select(['id', 'name', 'image'])
            ->when($request->longitude and $request->latitude, function ($query) use ($request) {
                $query->addSelect(DB::raw("ST_Distance_Sphere(
                        POINT('$request->longitude', '$request->latitude'), POINT(longitude, latitude)
                    ) as distance"))
                    ->orderBy('distance');
            })
            ->paginate(10); */

        //dd($restaurants);

        return view('client.maps.restaurants', compact('restaurants'));
    }
}
