<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Facility;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupero tutti gli appartamenti e li passo alla view
        $apartments = Apartment::with('facilities')->get();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilities = Facility::all();
        $data = [
            'facilities' => $facilities
        ];
        return view('admin.apartments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'address' => 'required|max:100|unique:apartments',
            'rooms_n' => 'required|numeric|min:1',
            'bathrooms_n' => 'required|numeric|min:1',
            'square_mt' => 'required|numeric|min:1',
            'main_pic' => 'image|max:1024'
        ]);

        $data = $request->all();
        $slug = Str::of($data['title'])->slug('-')->__toString();
        $data['slug'] = $slug;
        $new_apartment = new Apartment();
        $new_apartment->fill($data);
        $new_apartment->save();
        if (!empty($data['facilities'])) {
            $new_apartment->facilities()->sync($data['facilities']);
        }
        return redirect()->route('admin.apartments.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::find($id);
        if($apartment) {
            return view('admin.apartments.show', compact('apartment'));
        } else {
            return abort('404');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = Apartment::find($id);
        if($apartment) {
            $facilities = Facility::all();
            $data = [
                'apartment' => $apartment,
                'facilities' => $facilities
            ];

            return view('admin.apartments.edit', compact('apartment'));
        } else {
            return abort('404');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:30',
            'address' => 'required|max:100|unique:apartments,' .$id,
            'rooms_n' => 'required|numeric|min:1',
            'bathrooms_n' => 'required|numeric|min:1',
            'square_mt' => 'required|numeric|min:1',
            'main_pic' => 'image|max:1024'
        ]);
        $data = $request->all();
        //modificare la funzione per lo slug
        $slug = Str::of($data['title'])->slug('-');

        $apartment = Apartment::find($id);
        $apartment->update($data);
        if (!empty($data['facilities'])) {
            $apartment->facilities()->sync($data['facilities']);
        } else {
            $apartment->facilities()->sync([]);
        }
        $apartment->save();

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        if($apartment) {
            $apartment->delete();
            return redirect()->route('admin.apartments.index');
        } else {
            return abort('404');
        }
    }
}
