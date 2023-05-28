<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceOrderController extends Controller
{
    public function store(Request $request)
    {
        try{

            if(User::query()->firstWhere('id', $request->userId)->get())
            {
                $serviceOrder = $request->validate([
                    'vehiclePlate' => ['required', 'max:7'],
                    'entryDateTime' => ['required'],
                    'userId' => ['required'],
                    'price' => ['required']
                ]);

                DB::beginTransaction();

                ServiceOrder::create($serviceOrder);

                DB::commit();

                return json_encode([
                    "Ordem de serviço criada",
                    $serviceOrder
                ]);
            }

        } catch (\Throwable $th) {

            DB::rollBack();

            throw new Exception(
                "Não foi possível criar uma ordem de serviço: {$th->getMessage()}",
                500
            );
        }
    }

    public function index()
    {
        try{

            $serviceOrders = ServiceOrder::with('user')->get();

            if(sizeof($serviceOrders))
            {
                return $serviceOrders;
            }

        } catch (\Throwable $th) {


            throw new Exception(
                "Não foi possível listar as ordens de serviços: {$th->getMessage()}",
                500
            );
        }
    }
}
