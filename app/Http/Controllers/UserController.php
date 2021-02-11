<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $title = 'Usuário';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title. " listagem";
        $users = User::orderBy('name', 'asc')->paginate(100);

        return view('users.index', ['title' => $title, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title. " formulário";

        return view('users.add', [
            'title' => $title
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
        $model = new User();
        $model->name      = $request->name;
        $model->email     = $request->email;
        $model->password  = Hash::make($request->password);
        $model->level     = !empty($request->level) ? $request->level : 1;
        $model->active    = true;
        $model->save();

        return redirect()->route('usuarios.index');
    }

}
