<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCar;
use Illuminate\Support\Facades\Storage;
use \App\Enums\CarStatus;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::paginate(5);

        return view('admin.index', compact('cars'));
    }

    public function store(StoreCar $request)
    {

        $data = $request->validated();
        $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $data['image'] = $fileName;
        Storage::disk('public')->putFileAs('images', $request->file('image'), $fileName);

        auth()->user()->cars()->create($data);

        return redirect()->route('car.index')->with('success', 'Carro criado com sucesso!');
//        return response()->json($car);
    }

    public function rent(Request $request)
    {
        auth()->user()->rents()->attach($request->car_id, [
            'devolved' => false
        ]);

        Car::find($request->car_id)->update([
            'status' => CarStatus::Occupied->value,
        ]);

        return redirect()->route('car.index')->with('success', 'Carro alugado com sucesso!');
    }
}
