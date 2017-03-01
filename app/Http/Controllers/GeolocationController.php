<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Geolocation;

class GeolocationController extends Controller
{
    public function index()
    {
        $geolocations = Geolocation::paginate(6);
        return view('geolocation/geolocations', compact('geolocations'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        Geolocation::create($request->all());
        return redirect('/geolocations')->withFlashMessage('GeoLocation added successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        $geolocation = Geolocation::find($id);
        $geolocation->update($request->all());
        return redirect('/geolocations')->withFlashMessage('GeoLocation updated successfully');
    }

    public function destroy($id)
    {
        Geolocation::find($id)->delete();
        return redirect('/geolocations')->withFlashMessage('GeoLocation deleted successfully');
    }
}
