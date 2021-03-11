<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Emi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Emi::where('shop_id', auth('user-api')->user()->shop_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'customer_name' => 'required',
            'total_amount' => 'numeric|required',
            'total_installment' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()],422);
        }
        DB::beginTransaction();

        try {
            $emi = Emi::create([
                'shop_id' => $request->user()->shop->id,
                'product_id' => $request->product_id,
                'customer_name' => $request->customer_name,
                'total_amount' => $request->total_amount,
                'total_installment' => $request->total_installment,
            ]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

        return response()->json(['success' => true, 'message' => 'Emi created successfully.',],Response::HTTP_CREATED);
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
