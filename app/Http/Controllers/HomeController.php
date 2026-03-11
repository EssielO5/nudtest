<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantSearchRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function restaurants(RestaurantSearchRequest $request)
    {

        $query = Restaurant::query()->where('is_verified', '=', '1')->orderBy('name', 'ASC');
        if ($search = $request->validated("search")) {
            $query = $query->where("name", "like", "%{$search}%")->orWhere("location", "like", "%{$search}%");
        }

        return view('view_all', [
            'restaurants' => $query->paginate(6),
            'input' => $request->validated()
        ]);
    }
}
