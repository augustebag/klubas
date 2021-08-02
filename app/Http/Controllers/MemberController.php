<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Reservoir;
use Illuminate\Http\Request;
use Validator;
use PDF;

class MemberController extends Controller
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
        
        $sort = 'name';
        $defaultReservoir = 0;
        $reservoirs = Reservoir::orderBy('title')->get();
        $s = '';
        
        if ($request->sort_by) {
            if ('name' == $request->sort_by) {
                $members = Member::orderBy('name')->paginate(15)->withQueryString();
            } elseif ('name' == $request->sort_by) {
                $members = Member::orderBy('name')->paginate(15)->withQueryString();
            } elseif ('surname' == $request->sort_by) {
                $members = Member::orderBy('surname')->paginate(15)->withQueryString();
                $sort = 'surname';
            } elseif ('surname' == $request->sort_by) {
                $members = Member::orderBy('surname')->paginate(15)->withQueryString();
                $sort = 'surname';
            } 
                else { $members = Member::paginate(15)->withQueryString();
            } 

        }  //FILTRAVIMAS
        elseif ($request->reservoir_id) {
            $members = Member::where('reservoir_id', (int)$request->reservoir_id)->paginate(15)->withQueryString();
            $defaultReservoir = (int)$request->reservoir_id;
        } 
        
        elseif ($request->s) {
            $members = Member::where('name', 'like', '%'.$request->s.'%')->paginate(15)->withQueryString();
            $s = $request->s;
        }
        elseif ($request->do_search) {
            $members = Member::where('name', 'like', '')->paginate(15)->withQueryString();

        }
        else {
            $members = Member::paginate(15)->withQueryString();
        }

        
        return view('member.index', [
        'members' => $members,
        'sort' => $sort,
        'reservoirs' => $reservoirs,
        'defaultReservoir' => $defaultReservoir,
        's' => $s,
    ]);
    
    // return view('member.index', ['members' => $members]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservoirs = Reservoir::orderBy('title')->get();
       return view('member.create', ['reservoirs' => $reservoirs]);

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
           'member_name' => ['required', 'min:3', 'max:64', 'alpha'],
           'member_surname' => ['required', 'min:3', 'max:64', 'alpha'],
           'member_live' => ['required', 'min:3', 'max:64', 'alpha'],
           'member_experience' => ['required', 'min:1', 'numeric'],
           'member_registered' => ['required', 'min:1', 'max:64', 'numeric', 'lte:'.$request->member_experience],
       ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $member = new Member;
        $member->name = $request->member_name;
        $member->surname = $request->member_surname;
        $member->live = $request->member_live;
        $member->experience = $request->member_experience;
        $member->registered = $request->member_registered;
        $member->reservoir_id = $request->reservoir_id;
        $member->save();
        return redirect()->route('member.index')->with('success_message', 'Sekmingai įrašytas.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('member.show', ['member' => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $reservoirs = Reservoir::all();
        return view('member.edit', ['member' => $member, 'reservoirs' => $reservoirs]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $validator = Validator::make($request->all(),
       [
        'member_name' => ['required', 'min:3', 'max:64', 'alpha'],
        'member_surname' => ['required', 'min:3', 'max:64', 'alpha'],
        'member_live' => ['required', 'min:3', 'max:64', 'alpha'],
        'member_experience' => ['required', 'min:1', 'numeric'],
        'member_registered' => ['required', 'min:1', 'max:64', 'numeric', 'lte:'.$request->member_experience],
       ],

       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }
       
       $member = new Member;
       $member->name = $request->member_name;
       $member->surname = $request->member_surname;
       $member->live = $request->member_live;
       $member->experience = $request->member_experience;
       $member->registered = $request->member_registered;
       $member->reservoir_id = $request->reservoir_id;
       $member->save();
       return redirect()->route('member.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
         return redirect()->route('member.index')->with('success_message', 'Sekmingai ištrintas.');


    }

    public function pdf(Member $member)
    {
        $pdf = PDF::loadView('member.pdf', ['member' => $member]);
        return $pdf->download($member ->name.'.pdf');
    }

}