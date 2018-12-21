<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CalonKetua;
use App\User;
use Auth;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getVoting()
    {
        $vote = DB::table('calon_ketua')
            ->select('calon_ketua.*',DB::raw('COUNT(users.calon_id) as results'))
            ->leftJoin('users','users.calon_id','=','calon_ketua.id')
            ->groupBy('calon_ketua.id')
            ->get();
        
        $votes = DB::table('users')
            ->select(DB::raw('COUNT(users.calon_id) as results'))
            ->join('calon_ketua','calon_ketua.id','=','users.calon_id')
            ->first();
        $persen = 0;
        foreach($vote as $value)
        {
            $value->persen = $value->results / $votes->results * 100;   
        }
        return view('dashboard',compact(['vote']));
    }

    public function getCalon()
    {
        $calon = CalonKetua::all();
        return view('ajax.list_calon',compact('calon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = User::find(Auth::user()->id);
        if(is_null($user->calon_id))
        {
            $user->calon_id = $data['calon_id'];
            $user->save();
            return response()->json(['message' => 'Anda berhasil melakukan voting']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
