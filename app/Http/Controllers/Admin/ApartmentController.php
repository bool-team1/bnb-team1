<?php

//SE CAMBIEREMO MODO DI SALVARE IMGS
// if(!empty($data['image'])) {
//     $img_path =  Storage::put('uploads', $data['image']);
//     $data['main_pic'] = $img_path;
// }

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Facility;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();
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
            $user_id = Auth::id();
            $data = [
                'facilities' => $facilities,
                'user_id' => $user_id,
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
        // dd($request->files['main_pic']);
        $request->validate([

                'user_id' => 'required',
                'title' => 'required|max:30',
                'address' => 'required|max:100|',
                'rooms_n' => 'required|numeric|min:1',
                'bathrooms_n' => 'required|numeric|min:1',
                'square_mt' => 'required|numeric|min:1',
                'longitude' => 'required',
                'latitude' => 'required'
       ]);
        $data = $request->all();
        //generazione dello slug dal titolo
        $slug = Str::of($data['title'])->slug('-');
        $original_slug = $slug;
        //verifico se lo slug esiste già nella tabella ('slug' nome colonna $slug  valore)
        $apartment_exists = Apartment::where('slug', $slug)->first(); //get =  collection di oggetti, first = un oggetto

        $counter = 0;
        while($apartment_exists) {
           $counter++;
           $slug = $original_slug . '-' . $counter;
           $apartment_exists = Apartment::where('slug', $slug)->first();
        };

        //in questo modo lo slug sarà unico
        $data['slug'] = $slug;

        $new_apartment = new Apartment();
        $new_apartment->fill($data);
        $new_apartment->save();
        if (!empty($data['facilities'])) {
            $new_apartment->facilities()->sync($data['facilities']);
        }
        return redirect()->route('admin.home');

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
        $user_id = Auth::id();
        if($apartment) {
            $facilities = Facility::all();
            $data = [
                'apartment' => $apartment,
                'facilities' => $facilities,
                'user_id' => $user_id
            ];

            return view('admin.apartments.edit', $data);
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
                'user_id' => 'required',
                'title' => 'required|max:30',
                'address' => 'required|max:100',
                'rooms_n' => 'required|numeric|min:1',
                'bathrooms_n' => 'required|numeric|min:1',
                'square_mt' => 'required|numeric|min:1',
                'main_pic' => 'image|max:1024',
                'longitude' => 'required',
                'latitude' => 'required'
       ]);
        $data = $request->all();

        $apartment = Apartment::find($id);
        $apartment->update($data);
        if (!empty($data['facilities'])) {
            $apartment->facilities()->sync($data['facilities']);
        } else {
            $apartment->facilities()->sync([]);
        }
        return redirect()->route('admin.home');
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
            return redirect()->route('admin.home');
        } else {
            return abort('404');
        }
    }

}
