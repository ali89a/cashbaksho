<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Purchase::where('shop_id', auth('user-api')->user()->shop_id)->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => '',
            'description' => 'max:500',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        DB::beginTransaction();

        try {
            $purchase = Purchase::create([
                'shop_id' => $request->user()->shop->id,
                'item_name' => $request->item_name,
                'amount' => $request->amount,
                'date' => $request->date,
                'description' => $request->description,
            ]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

        return response()->json([
            'success' => true,
            'message' => 'New Purchase created successfully.',
        ],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = Purchase::where('shop_id', auth('user-api')->user()->shop_id)->find($id);
        if (!$purchase){
            return response()->json(['success' => false, 'message' => 'No purchase found.']);
        }
        return response()->json(['success' => true, 'purchase_info' => $purchase,]);
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
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => '',
            'description' => 'max:500',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors(),], 422);
        }
        $customer = Purchase::where('shop_id', auth('user-api')->user()->shop_id)->find($id);
        if ($customer){
            $customer->update([
                'item_name' => $request->item_name,
                'amount' => $request->amount,
                'date' => $request->date,
                'description' => $request->description,
            ]);
            return response()->json(['success' => true, 'message' => "Purchase Updated successfully.",]);
        }
        return response()->json(['success' => false, 'message' => 'No Purchase found.',]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::where('shop_id', auth('user-api')->user()->shop_id)->find($id);
        if ($purchase){
            $purchase->delete();
            return response()->json(['success' => true, 'message' => 'Purchase deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'No Purchase found.']);
    }
}
