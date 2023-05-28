<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try{

            $newUser = $request->validate([
                'name' => ['required', 'min:4']
            ]);

            if($newUser)
            {
                DB::beginTransaction();

                User::create($newUser);

                DB::commit();

                return json_encode([
                    $newUser,
                    "Usuário criado com sucesso!"
                ]);
            }

        } catch (\Throwable $th) {

            DB::rollBack();

            throw new Exception(
                "Não foi possível criar usuário: {$th->getMessage()}",
                500
            );
        }
    }

    public function index()
    {
        try{

            $users = User::all();

            if(sizeof($users))
            {
                return $users;
            }

        } catch (\Throwable $th) {

            DB::rollBack();

            throw new Exception(
                "Não foi possível listar usuário: {$th->getMessage()}",
                500
            );
        }
    }
}
