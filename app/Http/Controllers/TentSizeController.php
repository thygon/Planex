<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TentSizes;

class TentSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ts =  TentSizes::all();
        return view('admin.tentsizes',['sizes'=>$ts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.addtentsize');
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
        'size'=>'required',
        'seats'=>'required',
        'price'=>'required'
       ]);
        $ts = new TentSizes();
        $ts->size = $request->size;
        $ts->seats = $request->seats;
        $ts->price = $request->price;
        $ts->save();
        return redirect()->route('tentsizes')->with([
               'status'  => 'success',
               'message'  => 'Tentsize added!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ts = TentSizes::find($id);
        return view('admin.edittentsize',['size'=>$ts]);
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
        $request->validate([]);
        $ts = TentSizes::find($id);
        $ts->size = $request->size;
        $ts->seats = $request->seats;
        $ts->price = $request->price;
        $ts->save();
        return redirect()->route('tentsizes')->with([
               'status'  => 'success',
               'message'  => 'Tentsize updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ts = TentSizes::find($id);
        $ts->delete();
        return redirect()->route('tentsizes')->with([
               'status'  => 'success',
               'message'  => 'Tentsize deleted!'
        ]);
    }
}
