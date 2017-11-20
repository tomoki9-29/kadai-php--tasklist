<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//TasklistsControllerはTasklistモデルを頻繁につかうので先に名前空間を指定しておいたほうが手間が省ける
use App\Tasklist;

class TasklistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if (\Auth::check()) {
          $user = \Auth::user();
          $tasklists = $user->tasklists;
        }
        
        return view('tasklists.index',[
          'tasklists' => $tasklists,
        ]);*/
        
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasklists = $user->tasklists()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasklists' => $tasklists,
            ];
        }
        return view('tasklists.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasklist = new Tasklist;
        
        return view('tasklists.create',[
            'tasklist' => $tasklist,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'status'=>'required|Max:255',
            'content'=>'required|Max:255',
        ]);
        
        /*$tasklist = new Tasklist;
        $tasklist->status = $request->status;
        $tasklist->content = $request->content;
        $tasklist->save();
        
        return redirect('/');*/
        
        $request->user()->tasklists()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
    
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasklist = Tasklist::find($id);
        
        return view('tasklists.show',[
            'tasklist' => $tasklist,
        ]);
        
        /*if (\Auth::check()) {
            $user = \Auth::user();
            $tasklists = $user->tasklists->find($id);
        }
        
        return view('tasklists.show',[
            'tasklist' => $tasklist,
        ]);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$tasklist = Tasklist::find($id);
        
        /*return view('tasklists.edit',[
            'tasklist' => $tasklist,
        ]);*/
        
        if (\Auth::user()->id === $tasklist->user_id) {
            $tasklist = Tasklist::find($id);

            return view('tasklists.edit',[
                'tasklist' => $tasklist,
            ]);
        }

        return redirect()->back();
        
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
      
        $this->validate($request,[
            'status' => 'required|Max:255',
            'content' => 'required|Max:255',
        ]);
        
        /*$tasklist = Tasklist::find($id);
        $tasklist->status = $request->status;
        $tasklist->content = $request->content;
        $tasklist->save();
        
        return redirect('/');*/
        
        $request->user()->tasklists()->edit([
            'content' => $request->content,
            'status' => $request->status,
        ]);
    
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$tasklist = Tasklist::find($id);
        $tasklist->delete();
        
        return redirect('/');*/
        
        $tasklist = Tasklist::find($id);

        if (\Auth::user()->id === $tasklist->user_id) {
            $tasklist->delete();
        }

        return redirect('/');
    }
}
