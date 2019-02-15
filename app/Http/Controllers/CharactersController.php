<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use App\Character;
use App\Nickname;

class CharactersController extends Controller
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description' => ['required'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('characters.list');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $characters = Character::select("characters.id AS id", "image", "title", "characters.name AS name", "nicknames.name AS nickname", "description", "nicknames.id AS nickname_id")
                              ->join('nicknames','characters.id', '=', 'character_id')
                              ->get();
        return Datatables::of($characters)
            ->addColumn('action', function ($character) {
                return '<a href="/edit-character/'.$character->id.'" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i></a> '.
                '<a href="/delete-character/'.$character->nickname_id.'" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-trash"></i></a> ';
            })
            ->editColumn('name', function ($character){
                return $character->title .' '.$character->name;
            })
            ->removeColumn('id')
            ->removeColumn('nickname_id')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('characters.form');
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
        $this->validator($data)->validate();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/images');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }

        $character = Character::create($data);

        $nicks = explode(",",$request->nicknames);
        foreach($nicks as $nick){
          if(trim($nick) !== "") {
            $nNick = Nickname::create([
              "character_id" => $character->id,
              "name" => $nick
            ]);
          }
        }

        return redirect()->route('home');
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
        $character = Character::find($id);
        return view('characters.edit', [ "id" => $id, "character" => $character ]);
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
        $this->validator($request->all())->validate();
        $character = Character::find($id);
        $character->title = $request->title;
        $character->name = $request->name;
        $character->flat = $request->flat;
        $character->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/images');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
            $character->image = $name;
        }

        $character->save();

        $character->nicknames()->delete();

        $nicks = explode(",",$request->nicknames);
        foreach($nicks as $nick){
          if(trim($nick) !== "") {
            $nNick = Nickname::create([
              "character_id" => $id,
              "name" => $nick
            ]);
          }
        }

        return redirect()->route('home')->withErrors(['success' => "El personaje <strong>".$character->name."</strong> "
                                      ." fue editado correctamente."])->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nickname = Nickname::find($id);
        $nickname->delete();

        $character = Character::find($nickname->character_id);
        if(count($character->nicknames)){
          $character->delete();
        }

        return redirect()->back()->withErrors(['epaycosuccess' => "El personaje <strong>".$character->name."</strong> "
                                      ." fue eliminado correctamente."])->withInput();
    }
}
