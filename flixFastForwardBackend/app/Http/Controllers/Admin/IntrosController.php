<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Intro;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class IntrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $intros = Intro::paginate(15);

        return view('admin.intros.index', compact('intros'));
    }

    /**
     * @param id of intro episode
     * @return start and skip times in object
     */
    public function getStartAndSkipTimes($id){
        $intro = Intro::findOrFail($id);
        $arry=array("start_time"=>$intro->start_time,
            "duration"=>$intro->duration
            );
        return json_encode($arry);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.intros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['user_id' => 'required', 'title' => 'required', 'duration' => 'required','start_time' => 'required']);

        //dd($request->all());

        Intro::create($request->all());

        Session::flash('flash_message', 'Intro added!');

        return redirect('admin/intros');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $intro = Intro::findOrFail($id);

        return view('admin.intros.show', compact('intro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $intro = Intro::findOrFail($id);

        return view('admin.intros.edit', compact('intro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['user_id' => 'required', 'title' => 'required', 'duration' => 'required', ]);

        $intro = Intro::findOrFail($id);
        $intro->update($request->all());

        Session::flash('flash_message', 'Intro updated!');

        return redirect('admin/intros');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        Intro::destroy($id);

        Session::flash('flash_message', 'Intro deleted!');

        return redirect('admin/intros');
    }
}
