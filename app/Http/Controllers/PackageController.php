<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    /**
     * Menampilkan daftar package.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $packages = Package::all();

        return response()->json([
            'status' => 'success',
            'data' => $packages
        ]);
    }

    /**
     * Menampilkan detail package berdasarkan ID.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $package = Package::find($id);

        if (!$package) {
            return response()->json([
                'status' => 'error',
                'message' => 'Package not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $package
        ]);
    }

    /**
     * Membuat package baru.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data, [
            'transaction_id' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'origin_data.customer_address' => 'required|string',
            'origin_data.customer_phone' => 'required|string|max:20',
            // Validasi Lain
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        try {
            $package = new Package();
            $package->transaction_id = uuid_create(UUID_TYPE_RANDOM);
            $package->customer_name = $data['customer_name'];
            $package->customer_code = $data['customer_code'];
            $package->transaction_amount = $data['transaction_amount'];
            $package->transaction_discount = $data['transaction_discount'];
            $package->transaction_additional_field = $data['transaction_additional_field'];
            $package->transaction_payment_type = $data['transaction_payment_type'];
            $package->transaction_state = $data['transaction_state'];
            $package->transaction_code = $data['transaction_code'];
            $package->transaction_order = $data['transaction_order'];
            $package->location_id = $data['location_id'];
            $package->organization_id = $data['organization_id'];
            $package->created_at = $data['created_at'];
            $package->updated_at = $data['updated_at'];
            $package->transaction_payment_type_name = $data['transaction_payment_type_name'];
            $package->transaction_cash_amount = $data['transaction_cash_amount'];
            $package->transaction_cash_change = $data['transaction_cash_change'];
            $package->customer_attribute = $data['customer_attribute'];
            $package->connote = $data['connote'];
            $package->connote_id = $data['connote_id'];
            $package->origin_data = $data['origin_data'];
            $package->destination_data = $data['destination_data'];
            $package->koli_data = $data['koli_data'];
            $package->custom_field = $data['custom_field'];
            $package->currentLocation = $data['currentLocation'];
            $package->save();

            return response()->json([
                'status' => 'success',
                'data' => $package
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create package: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mengupdate package berdasarkan ID.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data, [
            'customer_name' => 'string|max:255',
            'origin_data.customer_address' => 'string',
            'origin_data.customer_phone' => 'string|max:20',
            // Validasi Lain
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        try {
            $package = Package::findOrFail($id);
            $package->customer_name = $data['customer_name'] ?? $package->customer_name;
            $package->customer_code = $data['customer_code'] ?? $package->customer_code;
            $package->transaction_amount = $data['transaction_amount'] ?? $package->transaction_amount;
            $package->transaction_discount = $data['transaction_discount'] ?? $package->transaction_discount;
            $package->transaction_additional_field = $data['transaction_additional_field'] ?? $package->transaction_additional_field;
            $package->transaction_payment_type = $data['transaction_payment_type'] ?? $package->transaction_payment_type;
            $package->transaction_state = $data['transaction_state'] ?? $package->transaction_state;
            $package->transaction_code = $data['transaction_code'] ?? $package->transaction_code;
            $package->transaction_order = $data['transaction_order'] ?? $package->transaction_order;
            $package->location_id = $data['location_id'] ?? $package->location_id;
            $package->organization_id = $data['organization_id'] ?? $package->organization_id;
            $package->created_at = $data['created_at'] ?? $package->created_at;
            $package->updated_at = $data['updated_at'] ?? $package->updated_at;
            $package->transaction_payment_type_name = $data['transaction_payment_type_name'] ?? $package->transaction_payment_type_name;
            $package->transaction_cash_amount = $data['transaction_cash_amount'] ?? $package->transaction_cash_amount;
            $package->transaction_cash_change = $data['transaction_cash_change'] ?? $package->transaction_cash_change;
            $package->customer_attribute = $data['customer_attribute'] ?? $package->customer_attribute;
            $package->connote = $data['connote'] ?? $package->connote;
            $package->connote_id = $data['connote_id'] ?? $package->connote_id;
            $package->origin_data = $data['origin_data'] ?? $package->origin_data;
            $package->destination_data = $data['destination_data'] ?? $package->destination_data;
            $package->koli_data = isset($data['kola_data']) ? $data['koli_data'] : $package->koli_data;
            $package->custom_field = $data['custom_field'] ?? $package->custom_field;
            $package->currentLocation = $data['currentLocation'] ?? $package->currentLocation;
            $package->save();

            return response()->json([
                'status' => 'success',
                'data' => $package
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update package: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mengupdate sebagian data pada package berdasarkan ID.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function updatePartial(Request $request, $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data, [
//            'customer_name' => 'string|max:255',
//            'origin_data.customer_address' => 'string',
//            'origin_data.customer_phone' => 'string|max:20',
            // Validasi Lain
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        try {
            $package = Package::find($id);

            if (!$package) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Package not found'
                ], 404);
            }


            $package = Package::findOrFail($id);

            foreach ($data as $key => $value) {
                if (str_contains($key, '.')) {
                    // Menggunakan notasi dot untuk akses data dalam objek atau array
                    $keys = explode('.', $key);
                    $packageData = &$package;
                    foreach ($keys as $nestedKey) {
                        if (is_array($packageData)) {
                            $packageData = &$packageData[$nestedKey];
                        } elseif (is_object($packageData)) {
                            $packageData = &$packageData->$nestedKey;
                        } else {
                            // Jika tidak bisa mengakses data, lewati
                            continue 2;
                        }
                    }
                    $packageData = $value;
                } else {
                    // Jika tidak menggunakan notasi dot, langsung akses data dalam objek paket
                    $package->$key = $value;
                }
            }
            $package->save();

            return response()->json([
                'status' => 'success',
                'data' => $package
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update package: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus package berdasarkan ID.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $package = Package::find($id);

            if (!$package) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Package not found'
                ], 404);
            }

            $package->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Package deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete package: ' . $e->getMessage()
            ], 500);
        }
    }
}
