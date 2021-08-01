<?php

namespace App\Http\Controllers;

use App\Models\Reservoir;
use App\Models\Member;
use Illuminate\Http\Request;
use Validator;
use PDF;

class ReservoirController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sort = 'title';
        $defaultReservoir = 0;
        $reservoirs = Reservoir::all();
        $s = '';
        
        if ($request->sort_by) {
            if ('title' == $request->sort_by) {
                $reservoirs = Reservoir::orderBy('title')->paginate(15)->withQueryString();
            } elseif ('title' == $request->sort_by) {
                $reservoirs = Reservoir::orderBy('title')->paginate(15)->withQueryString();
            } elseif ('area' == $request->sort_by) {
                $reservoirs = Reservoir::orderBy('area')->paginate(15)->withQueryString();
                $sort = 'area';
            } elseif ('area' == $request->sort_by) {
                $reservoirs = Reservoir::orderBy('area')->paginate(15)->withQueryString();
                $sort = 'area';
            } 
                else { 
                    $reservoirs = Reservoir::paginate(15)->withQueryString();
            } 
            //FILTRAVIMAS
        }  elseif ($request->reservoir_id) {
            $reservoirs = Reservoir::where('reservoir_id', (int)$request->reservoir_id)->paginate(15)->withQueryString();
            $defaultReservoir = (int)$request->reservoir_id;
        }
        
        elseif ($request->s) {
            $reservoirs = Reservoir::where('title', 'like', '%'.$request->s.'%')->paginate(15)->withQueryString();
            $s = $request->s;
        }
        elseif ($request->do_search) {
            $reservoirs = Reservoir::where('title', 'like', '')->paginate(15)->withQueryString();

        }
        
            else {
            $reservoirs = Reservoir::paginate(15)->withQueryString();
        }

        
        return view('reservoir.index', [
        'reservoirs' => $reservoirs,
        'sort' => $sort,
        'reservoirs' => $reservoirs,
        'defaultReservoir' => $defaultReservoir,
        's' => $s,
    ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservoirs = Reservoir::orderBy('title')->paginate(15)->withQueryString();
        return view('reservoir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
       [
           'reservoir_title' => ['required', 'min:2', 'max:64', 'alpha'],
           'reservoir_area' => ['required', 'numeric', 'gt:0'],
           'reservoir_about' => ['required'],
       ]
);
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

       $reservoir = new Reservoir;

       if ($request->has('reservoir_photo')) {
        $photo = $request->file('reservoir_photo');
        $imageName = 
        $request->reservoir_title. '-' .
        $request->reservoir_area. '-' .
        time(). '.' .
        $photo->getClientOriginalExtension();
        $path = public_path() . '/reservoirs-img/'; // serverio vidinis kelias
        $url = asset('reservoirs-img/'.$imageName); // url narsyklei (isorinis)
        $photo->move($path, $imageName); // is serverio tmp ===> i public folderi
        $reservoir->photo = $url;
    }


        $reservoir = new Reservoir;
        $reservoir->title = $request->reservoir_title;
        $reservoir->area = $request->reservoir_area;
        $reservoir->about = $request->reservoir_about;
        $reservoir->save();
        return redirect()->route('reservoir.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function show(Reservoir $reservoir)
    {
        return view('reservoir.show', ['reservoir' => $reservoir]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservoir $reservoir)
    {
        return view('reservoir.edit', ['reservoir' => $reservoir]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservoir $reservoir)
    {
        if ($request->has('delete_reservoir_photo')) {
            if ($reservoir->photo) {
                $imageName = explode('/', $reservoir->photo);
                $imageName = array_pop($imageName);
                $path = public_path() . '/reservoirs-img/' . $imageName;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $reservoir->photo = null;
        }

       if ($request->has('reservoir_photo')) {

        if ($reservoir->photo) {
            $imageName = explode('/', $reservoir->photo);
            $imageName = array_pop($imageName);
            $path = public_path() . '/reservoirs-img/' . $imageName;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        
        $photo = $request->file('reservoir_photo');
        $imageName = 
        $request->reservoir_title. '-' .
        $request->reservoir_area. '-' .
        time(). '.' .
        $photo->getClientOriginalExtension();
        $path = public_path() . '/reservoirs-img/'; // serverio vidinis kelias
        $url = asset('/reservoirs-img/'.$imageName); // url narsyklei (isorinis)
        $photo->move($path, $imageName); // is serverio tmp ===> i public folderi
        $reservoir->photo = $url;
    }
    

        $validator = Validator::make($request->all(),
       [
           'reservoir_title' => ['required', 'min:2', 'max:64', 'alpha'],
           'reservoir_area' => ['required', 'numeric', 'gt:0'],
           'reservoir_about' => ['required'],
       ]
   );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }
        $reservoir->title = $request->reservoir_title;
        $reservoir->area = $request->reservoir_area;
        $reservoir->about = $request->reservoir_about;
        $reservoir->save();
        return redirect()->route('reservoir.index')->with('success_message', 'Sėkmingai pakeistas.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservoir $reservoir)
    {
        if ($reservoir->reservoirHasMembers->count()) {
             return redirect()->back()->with('info_message', 'Trinti negalima, nes turi nebaigtu darbu');
         }
         
        if ($reservoir->photo) {
            $imageName = explode('/', $reservoir->photo);
            $imageName = array_pop($imageName);
            $path = public_path() . '/reservoirs-img/' . $imageName;
            if (file_exists($path)) {
                unlink($path);
            }
        }


         $reservoir->delete();
         return redirect()->route('reservoir.index')->with('success_message', 'Sekmingai ištrintas.');

    }

    public function pdf(Reservoir $reservoir)
    {
        $pdf = PDF::loadView('reservoir.pdf', ['reservoir' => $reservoir]);
        return $pdf->download($reservoir ->title.'.pdf');
    }

}
