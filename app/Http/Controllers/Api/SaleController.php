<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sale::with('product','customer')->where('shop_id', auth('user-api')->user()->shop_id)->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'customer_id' => 'required',
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
            $purchase = Sale::create([
                'shop_id' => $request->user()->shop->id,
                'product_id' => $request->product_id,
                'customer_id' => $request->customer_id,
                'amount' => $request->amount,
                'date' => $request->date,
                'description' => $request->description,
            ]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json(['success' => true, 'message' => 'Something went wrong.',]);
        }

        return response()->json(['success' => true, 'message' => 'New Sale created successfully.',],Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $sale = Sale::where('shop_id', auth('user-api')->user()->shop_id)->find($id);
        if (!$sale){
            return response()->json(['success' => false, 'message' => 'No sale found.']);
        }
        return response()->json(['success' => true, 'sale_info' => $sale,]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'customer_id' => 'required',
            'amount' => 'required|numeric',
            'date' => '',
            'description' => 'max:500',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors(),], 422);
        }
        $sale = Sale::where('shop_id', auth('user-api')->user()->shop_id)->find($id);
        if ($sale){
            $sale->update([
                'product_id' => $request->product_id,
                'customer_id' => $request->customer_id,
                'amount' => $request->amount,
                'date' => $request->date,
                'description' => $request->description,
            ]);
            return response()->json(['success' => true, 'message' => "Sale Updated successfully.",]);
        }
        return response()->json(['success' => false, 'message' => 'No Sale found.',]);
    }

    public function destroy($id)
    {
        $sale = Sale::where('shop_id', auth('user-api')->user()->shop_id)->find($id);
        if ($sale){
            $sale->delete();
            return response()->json(['success' => true, 'message' => 'Sale deleted successfully.',]);
        }
        return response()->json(['success' => false, 'message' => 'No Sale found.',]);
    }
}
