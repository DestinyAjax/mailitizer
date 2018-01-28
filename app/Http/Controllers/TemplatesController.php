<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Template;

class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_id'] = 4;
        $data['templates'] = Template::all();
        return view('admin.templates.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function activateTemplate(Request $request) 
    {
        $data = $request->except('_token');

        if($data['req'] == 'activate')
        {
            try {
                //resetting to default
                //cannot have two template activated at the same time
                $check = \DB::table("templates")->where('status','=',2)->update([
                    'status'=>1
                ]);

                //activating one template
                $activate = Template::find($data['template_id']);
                $activate->status = 2;
                $activate->save();

                return "";

            } catch(Exception $e) {
                return "Error in processing";
            }
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
