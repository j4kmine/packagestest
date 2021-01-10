<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class PackageController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         /**
         * @OA\Get(
         *      path="/api/packages",
         *      operationId="packages",
         *      tags={"packages"},
         *      summary="packages ",
         *      description="Returns packages",
         *      @OA\Response(
         *          response=200,
         *          description="successful operation",
         *          @OA\JsonContent(),
         *
         *      ),
         *      @OA\Response(response=400, description="Bad request"),
         *      @OA\Response(response=404, description="Resource Not Found"),
         * )
         *
         */
        $transaction_id = $request->transaction_id;
        if($transaction_id != ""){
            $package = Package::where('transaction_id', 'LIKE', '%' . $transaction_id . '%')->paginate(10);
        }else{
            $package = Package::paginate(10);
        }

        return response()->json([$package], 200);
    }

    public function store(Request $request)
    {
        /**
         * @OA\post(
         *      path="/api/packages",
         *      operationId="postpackage",
         *      tags={"packages"},
         *      summary="post existing package",
         *      description="post a record",
         *     @OA\RequestBody(
         *      @OA\JsonContent(
         *         type="object",
         *          @OA\Property(property="transaction_id", type="string",example="d0090c40-539f-479a-8274-899b9970bddc"),
         *          @OA\Property(property="customer_name", type="string",example="PT. AMARA PRIMATIGA"),
         *          @OA\Property(property="customer_code", type="string",example="1678593"),
         *          @OA\Property(property="transaction_amount", type="string",example="70700"),
         *          @OA\Property(property="transaction_discount", type="string",example="0"),
         *          @OA\Property(property="transaction_additional_field", type="string",example="-"),
         *          @OA\Property(property="transaction_payment_type", type="string",example="29"),
         *          @OA\Property(property="transaction_state", type="string",example="PAID"),
         *          @OA\Property(property="transaction_code", type="string",example="CGKFT20200715121"),
         *          @OA\Property(property="transaction_order", type="number",example=121),
         *          @OA\Property(property="location_id", type="string",example="5cecb20b6c49615b174c3e74"),
         *          @OA\Property(property="organization_id", type="number",example=6),
         *          @OA\Property(property="created_at", type="string",example="2020-07-15T11:11:12+0700"),
         *          @OA\Property(property="updated_at", type="string",example="2020-07-15T11:11:22+0700"),
         *          @OA\Property(property="transaction_payment_type_name", type="string",example="Invoice"),
         *          @OA\Property(property="transaction_cash_amount", type="number",example=0),
         *          @OA\Property(property="transaction_cash_change", type="number",example=0),
         *          @OA\Property(property="customer_attribute", type="object",
         *              @OA\Property(property="Nama_Sales", type="string",example="Radit Fitrawikarsa"),
         *              @OA\Property(property="TOP", type="string",example="14 Hari"),
         *              @OA\Property(property="Jenis_Pelanggan", type="string",example="B2B")
         *          ),
         *          @OA\Property(property="connote", type="object",
         *              @OA\Property(property="connote_id", type="string",example="f70670b1-c3ef-4caf-bc4f-eefa702092ed"),
         *              @OA\Property(property="connote_number", type="number",example=1),
         *              @OA\Property(property="connote_service", type="string",example="ECO"),
         *              @OA\Property(property="connote_service_price", type="number",example=70700),
         *              @OA\Property(property="connote_amount", type="number",example=70700),
         *              @OA\Property(property="connote_code", type="string",example="AWB00100209082020"),
         *              @OA\Property(property="connote_booking_code", type="string",example=""),
         *              @OA\Property(property="connote_order", type="number",example=326931),
         *              @OA\Property(property="connote_state", type="string",example="PAID"),
         *              @OA\Property(property="connote_state_id", type="number",example=2),
         *              @OA\Property(property="zone_code_from", type="string",example="CGKFT"),
         *              @OA\Property(property="zone_code_to", type="string",example="SMG"),
         *              @OA\Property(property="surcharge_amount", type="string",example=null),
         *              @OA\Property(property="transaction_id", type="string",example="d0090c40-539f-479a-8274-899b9970bdd"),
         *              @OA\Property(property="actual_weight", type="number",example=20),
         *              @OA\Property(property="volume_weight", type="number",example=0),
         *              @OA\Property(property="chargeable_weight", type="number",example=20),
         *              @OA\Property(property="created_at", type="string",example="2020-07-15T11:11:12+0700"),
         *              @OA\Property(property="updated_at", type="string",example="2020-07-15T11:11:22+0700"),
         *              @OA\Property(property="organization_id", type="number",example=6),
         *              @OA\Property(property="location_id", type="string",example="5cecb20b6c49615b174c3e74"),
         *              @OA\Property(property="connote_total_package", type="string",example="3"),
         *              @OA\Property(property="connote_surcharge_amount", type="string",example="0"),
         *              @OA\Property(property="connote_sla_day", type="string",example="4"),
         *              @OA\Property(property="location_name", type="string",example="Hub Jakarta Selatan"),
         *              @OA\Property(property="location_type", type="string",example="HUB"),
         *              @OA\Property(property="source_tariff_db", type="string",example="tariff_customers"),
         *              @OA\Property(property="id_source_tariff", type="string",example="1576868"),
         *              @OA\Property(property="pod", type="string",example=null),
         *              @OA\Property(property="history", type="object",example=null)
         *
         *          ),
         *          @OA\Property(property="origin_data", type="object",
         *               @OA\Property(property="customer_name", type="string",example="PT. NARA OKA PRAKARSA"),
         *               @OA\Property(property="customer_address", type="string",example="JL. KH. AHMAD DAHLAN NO. 100, SEMARANG TENGAH 12420"),
         *               @OA\Property(property="customer_email", type="string",example="info@naraoka.co.id"),
         *               @OA\Property(property="customer_phone", type="string",example="024-1234567"),
         *               @OA\Property(property="customer_address_detail", type="string",example=null),
         *               @OA\Property(property="customer_zip_code", type="string",example="12420"),
         *               @OA\Property(property="zone_code", type="string",example="CGKFT"),
         *               @OA\Property(property="organization_id", type="number",example=6),
         *               @OA\Property(property="location_id", type="string",example="5cecb20b6c49615b174c3e74")
         *          ),
         *          @OA\Property(property="destination_data", type="object",
         *               @OA\Property(property="customer_name", type="string",example="PT AMARIS HOTEL SIMPANG LIMA"),
         *               @OA\Property(property="customer_address", type="string",example="JL. KH. AHMAD DAHLAN NO. 100, SEMARANG TENGAH 12420"),
         *               @OA\Property(property="customer_email", type="string",example="info@naraoka.co.id"),
         *               @OA\Property(property="customer_phone", type="string",example="024-1234567"),
         *               @OA\Property(property="customer_address_detail", type="string",example="KOTA SEMARANG SEMARANG TENGAH KARANGKIDUL"),
         *               @OA\Property(property="customer_zip_code", type="string",example="12420"),
         *               @OA\Property(property="zone_code", type="string",example="CGKFT"),
         *               @OA\Property(property="organization_id", type="number",example=6),
         *               @OA\Property(property="location_id", type="string",example="5cecb20b6c49615b174c3e74")
         *          ),
         *          @OA\Property(property="custom_field", type="object",
         *              @OA\Property(property="catatan_tambahan", type="string",example="JANGAN DI BANTING \/ DI TINDIH"),
         *          ),
         *           @OA\Property(property="currentLocation", type="object",
         *               @OA\Property(property="name", type="string",example="Hub Jakarta Selatan"),
         *               @OA\Property(property="code", type="string",example="JKTS01"),
         *               @OA\Property(property="type", type="string",example="Agent")
         *          ),
         *          @OA\Property(property="connote_id", type="string",example="f70670b1-c3ef-4caf-bc4f-eefa702092ed"),
         *          @OA\Property(
         *          property="koli_data",
         *          type="array",
         *          @OA\Items(
         *              @OA\Property(property="koli_length", type="number",example=0),
         *              @OA\Property(property="awb_url", type="string",example="https:\/\/tracking.mile.app\/label\/AWB00100209082020.1"),
         *              @OA\Property(property="created_at", type="string",example="2020-07-15 11:11:13"),
         *              @OA\Property(property="koli_chargeable_weight", type="number",example=0),
         *              @OA\Property(property="koli_width", type="number",example=0),
         *              @OA\Property(property="koli_surcharge", type="object",example=null),
         *              @OA\Property(property="koli_height", type="number",example=0),
         *              @OA\Property(property="updated_at", type="string",example="2020-07-15 11:11:13"),
         *              @OA\Property(property="koli_description", type="string",example="V WARP"),
         *              @OA\Property(property="koli_formula_id", type="string",example=""),
         *              @OA\Property(property="connote_id", type="string",example="f70670b1-c3ef-4caf-bc4f-eefa702092ed"),
         *              @OA\Property(property="koli_volume", type="number",example=0),
         *              @OA\Property(property="koli_weight", type="number",example=9),
         *              @OA\Property(property="koli_id", type="string",example="e2cb6d86-0bb9-409b-a1f0-389ed4f2df2d"),
         *              @OA\Property(property="koli_custom_field", type="object",
         *                  @OA\Property(property="awb_sicepat", type="string",example="test"),
         *                  @OA\Property(property="harga_barang", type="number",example=900)
         *              ),
         *              @OA\Property(property="koli_code", type="string",example="AWB00100209082020.3"),
         *          )
         *        ),
         *      )
         *     ),
         *      @OA\Response(
         *          response=204,
         *          description="Successful operation",
         *          @OA\JsonContent()
         *       ),
         *      @OA\Response(
         *          response=401,
         *          description="Unauthenticated",
         *      ),
         *      @OA\Response(
         *          response=403,
         *          description="Forbidden"
         *      ),
         *      @OA\Response(
         *          response=404,
         *          description="Resource Not Found"
         *      )
         * )
         */
        $this->validate($request,[
            'transaction_id' => 'unique:packages|required|size:36',
            'customer_name' => 'required',
            'customer_code' => 'required|size:7',
            'transaction_amount' => 'required',
            'transaction_discount' => 'required',
            'transaction_payment_type' => 'required',
            'transaction_state' => 'required',
            'transaction_code' => 'required|size:16',
            'transaction_order' => 'required|min:3|numeric',
            'location_id' => 'required',
            'organization_id' => 'required|numeric',
            'transaction_payment_type_name' => 'required',
            'transaction_cash_amount' => 'required|numeric',
            'transaction_cash_change' => 'required|numeric',
            'customer_attribute' => 'required',
            'connote' => 'required',
            'connote_id' => 'required|size:36',
            'origin_data' => 'required',
            'destination_data' => 'required',
            'koli_data' => 'required',
            'custom_field' => 'required',
            'currentLocation' => 'required',
        ]);
        $data = Package::create( $request->all() );
        if($data){
            return response()->json(['INSERT SUKSES'], 200);
        } else {
            return response()->json(['INSERT GAGAL'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         /**
         * @OA\Get(
         *      path="/api/packages/{id}",
         *      operationId="getpackage",
         *      tags={"packages"},
         *      summary="get existing package",
         *      description="get a record",
         *      @OA\Parameter(
         *          name="id",
         *          description="Packages id",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *      @OA\Response(
         *          response=204,
         *          description="Successful operation",
         *          @OA\JsonContent()
         *       ),
         *      @OA\Response(
         *          response=401,
         *          description="Unauthenticated",
         *      ),
         *      @OA\Response(
         *          response=403,
         *          description="Forbidden"
         *      ),
         *      @OA\Response(
         *          response=404,
         *          description="Resource Not Found"
         *      )
         * )
         */
        $where = [];
        if ($id != "") {
            $where['_id'] = $id;
        }
        $query = Package::where($where)->get();
        return response()->json([$query], 200);
    }
    public function update(Request $request, $id)  {
               /**
         * @OA\put(
         *      path="/api/packages/{id}",
         *      operationId="putpackage",
         *      tags={"packages"},
         *      summary="put existing package",
         *      description="put a record",
         *      @OA\Parameter(
         *          name="id",
         *          description="Packages id",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *     @OA\RequestBody(
         *      @OA\JsonContent(
         *         type="object",
         *          @OA\Property(property="customer_name", type="string",example="PT. AMARA PRIMATIGA"),
         *          @OA\Property(property="customer_code", type="string",example="1678593"),
         *          @OA\Property(property="transaction_amount", type="string",example="70700"),
         *          @OA\Property(property="transaction_discount", type="string",example="0"),
         *          @OA\Property(property="transaction_additional_field", type="string",example="-"),
         *          @OA\Property(property="transaction_payment_type", type="string",example="29"),
         *          @OA\Property(property="transaction_state", type="string",example="PAID"),
         *          @OA\Property(property="transaction_code", type="string",example="CGKFT20200715121"),
         *          @OA\Property(property="transaction_order", type="number",example=121),
         *          @OA\Property(property="location_id", type="string",example="5cecb20b6c49615b174c3e74"),
         *          @OA\Property(property="organization_id", type="number",example=6),
         *          @OA\Property(property="created_at", type="string",example="2020-07-15T11:11:12+0700"),
         *          @OA\Property(property="updated_at", type="string",example="2020-07-15T11:11:22+0700"),
         *          @OA\Property(property="transaction_payment_type_name", type="string",example="Invoice"),
         *          @OA\Property(property="transaction_cash_amount", type="number",example=0),
         *          @OA\Property(property="transaction_cash_change", type="number",example=0),
         *          @OA\Property(property="customer_attribute", type="object",
         *              @OA\Property(property="Nama_Sales", type="string",example="Radit Fitrawikarsa"),
         *              @OA\Property(property="TOP", type="string",example="14 Hari"),
         *              @OA\Property(property="Jenis_Pelanggan", type="string",example="B2B")
         *          ),
         *          @OA\Property(property="connote", type="object",
         *              @OA\Property(property="connote_id", type="string",example="f70670b1-c3ef-4caf-bc4f-eefa702092ed"),
         *              @OA\Property(property="connote_number", type="number",example=1),
         *              @OA\Property(property="connote_service", type="string",example="ECO"),
         *              @OA\Property(property="connote_service_price", type="number",example=70700),
         *              @OA\Property(property="connote_amount", type="number",example=70700),
         *              @OA\Property(property="connote_code", type="string",example="AWB00100209082020"),
         *              @OA\Property(property="connote_booking_code", type="string",example=""),
         *              @OA\Property(property="connote_order", type="number",example=326931),
         *              @OA\Property(property="connote_state", type="string",example="PAID"),
         *              @OA\Property(property="connote_state_id", type="number",example=2),
         *              @OA\Property(property="zone_code_from", type="string",example="CGKFT"),
         *              @OA\Property(property="zone_code_to", type="string",example="SMG"),
         *              @OA\Property(property="surcharge_amount", type="string",example=null),
         *              @OA\Property(property="transaction_id", type="string",example="d0090c40-539f-479a-8274-899b9970bdd"),
         *              @OA\Property(property="actual_weight", type="number",example=20),
         *              @OA\Property(property="volume_weight", type="number",example=0),
         *              @OA\Property(property="chargeable_weight", type="number",example=20),
         *              @OA\Property(property="created_at", type="string",example="2020-07-15T11:11:12+0700"),
         *              @OA\Property(property="updated_at", type="string",example="2020-07-15T11:11:22+0700"),
         *              @OA\Property(property="organization_id", type="number",example=6),
         *              @OA\Property(property="location_id", type="string",example="5cecb20b6c49615b174c3e74"),
         *              @OA\Property(property="connote_total_package", type="string",example="3"),
         *              @OA\Property(property="connote_surcharge_amount", type="string",example="0"),
         *              @OA\Property(property="connote_sla_day", type="string",example="4"),
         *              @OA\Property(property="location_name", type="string",example="Hub Jakarta Selatan"),
         *              @OA\Property(property="location_type", type="string",example="HUB"),
         *              @OA\Property(property="source_tariff_db", type="string",example="tariff_customers"),
         *              @OA\Property(property="id_source_tariff", type="string",example="1576868"),
         *              @OA\Property(property="pod", type="string",example=null),
         *              @OA\Property(property="history", type="object",example=null)
         *
         *          ),
         *          @OA\Property(property="origin_data", type="object",
         *               @OA\Property(property="customer_name", type="string",example="PT. NARA OKA PRAKARSA"),
         *               @OA\Property(property="customer_address", type="string",example="JL. KH. AHMAD DAHLAN NO. 100, SEMARANG TENGAH 12420"),
         *               @OA\Property(property="customer_email", type="string",example="info@naraoka.co.id"),
         *               @OA\Property(property="customer_phone", type="string",example="024-1234567"),
         *               @OA\Property(property="customer_address_detail", type="string",example=null),
         *               @OA\Property(property="customer_zip_code", type="string",example="12420"),
         *               @OA\Property(property="zone_code", type="string",example="CGKFT"),
         *               @OA\Property(property="organization_id", type="number",example=6),
         *               @OA\Property(property="location_id", type="string",example="5cecb20b6c49615b174c3e74")
         *          ),
         *          @OA\Property(property="destination_data", type="object",
         *               @OA\Property(property="customer_name", type="string",example="PT AMARIS HOTEL SIMPANG LIMA"),
         *               @OA\Property(property="customer_address", type="string",example="JL. KH. AHMAD DAHLAN NO. 100, SEMARANG TENGAH 12420"),
         *               @OA\Property(property="customer_email", type="string",example="info@naraoka.co.id"),
         *               @OA\Property(property="customer_phone", type="string",example="024-1234567"),
         *               @OA\Property(property="customer_address_detail", type="string",example="KOTA SEMARANG SEMARANG TENGAH KARANGKIDUL"),
         *               @OA\Property(property="customer_zip_code", type="string",example="12420"),
         *               @OA\Property(property="zone_code", type="string",example="CGKFT"),
         *               @OA\Property(property="organization_id", type="number",example=6),
         *               @OA\Property(property="location_id", type="string",example="5cecb20b6c49615b174c3e74")
         *          ),
         *          @OA\Property(property="connote_id", type="string",example="f70670b1-c3ef-4caf-bc4f-eefa702092ed"),
         *          @OA\Property(property="custom_field", type="object",
         *              @OA\Property(property="catatan_tambahan", type="string",example="JANGAN DI BANTING \/ DI TINDIH"),
         *          ),
         *           @OA\Property(property="currentLocation", type="object",
         *               @OA\Property(property="name", type="string",example="Hub Jakarta Selatan"),
         *               @OA\Property(property="code", type="string",example="JKTS01"),
         *               @OA\Property(property="type", type="string",example="Agent")
         *          ),
         *          @OA\Property(
         *          property="koli_data",
         *          type="array",
         *          @OA\Items(
         *              @OA\Property(property="koli_length", type="number",example=0),
         *              @OA\Property(property="awb_url", type="string",example="https:\/\/tracking.mile.app\/label\/AWB00100209082020.1"),
         *              @OA\Property(property="created_at", type="string",example="2020-07-15 11:11:13"),
         *              @OA\Property(property="koli_chargeable_weight", type="number",example=0),
         *              @OA\Property(property="koli_width", type="number",example=0),
         *              @OA\Property(property="koli_surcharge", type="object",example=null),
         *              @OA\Property(property="koli_height", type="number",example=0),
         *              @OA\Property(property="updated_at", type="string",example="2020-07-15 11:11:13"),
         *              @OA\Property(property="koli_description", type="string",example="V WARP"),
         *              @OA\Property(property="koli_formula_id", type="string",example=""),
         *              @OA\Property(property="connote_id", type="string",example="f70670b1-c3ef-4caf-bc4f-eefa702092ed"),
         *              @OA\Property(property="koli_volume", type="number",example=0),
         *              @OA\Property(property="koli_weight", type="number",example=9),
         *              @OA\Property(property="koli_id", type="string",example="e2cb6d86-0bb9-409b-a1f0-389ed4f2df2d"),
         *              @OA\Property(property="koli_custom_field", type="object",
         *                  @OA\Property(property="awb_sicepat", type="string",example="test"),
         *                  @OA\Property(property="harga_barang", type="number",example=900)
         *              ),
         *              @OA\Property(property="koli_code", type="string",example="AWB00100209082020.3"),
         *          )
         *        ),
         *      )
         *     ),
         *      @OA\Response(
         *          response=204,
         *          description="Successful operation",
         *          @OA\JsonContent()
         *       ),
         *      @OA\Response(
         *          response=401,
         *          description="Unauthenticated",
         *      ),
         *      @OA\Response(
         *          response=403,
         *          description="Forbidden"
         *      ),
         *      @OA\Response(
         *          response=404,
         *          description="Resource Not Found"
         *      )
         * )
         */
        $package = Package::findOrFail($id);
        $package->update($request->except(['d0090c40-539f-479a-8274-899b9970bddc']));
        if($package){
            return response()->json($package, 200);
        } else {
            return response()->json(['UPDATE GAGAL'], 201);
        }
    }

    public function modif(Request $request, $id)  {
        /**
         * @OA\patch(
         *      path="/api/packages/{id}",
         *      operationId="patchpackage",
         *      tags={"packages"},
         *      summary="patch existing package",
         *      description="patch a record",
         *      @OA\Parameter(
         *          name="id",
         *          description="Packages id",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string"
         *          )
         *      ),
         *     @OA\RequestBody(
         *      @OA\JsonContent(
         *         type="object",
         *         @OA\Property(
         *          property="koli_data",
         *          type="array",
         *          @OA\Items(
         *              @OA\Property(property="koli_length", type="number",example=0),
         *              @OA\Property(property="awb_url", type="string",example="https:\/\/tracking.mile.app\/label\/AWB00100209082020.1"),
         *              @OA\Property(property="created_at", type="string",example="2020-07-15 11:11:13"),
         *              @OA\Property(property="koli_chargeable_weight", type="number",example=0),
         *              @OA\Property(property="koli_width", type="number",example=0),
         *              @OA\Property(property="koli_surcharge", type="object",example=null),
         *              @OA\Property(property="koli_height", type="number",example=0),
         *              @OA\Property(property="updated_at", type="string",example="2020-07-15 11:11:13"),
         *              @OA\Property(property="koli_description", type="string",example="V WARP"),
         *              @OA\Property(property="koli_formula_id", type="string",example=""),
         *              @OA\Property(property="connote_id", type="string",example="f70670b1-c3ef-4caf-bc4f-eefa702092ed"),
         *              @OA\Property(property="koli_volume", type="number",example=0),
         *              @OA\Property(property="koli_weight", type="number",example=9),
         *              @OA\Property(property="koli_id", type="string",example="e2cb6d86-0bb9-409b-a1f0-389ed4f2df2d"),
         *              @OA\Property(property="koli_custom_field", type="object",
         *                  @OA\Property(property="awb_sicepat", type="string",example="test"),
         *                  @OA\Property(property="harga_barang", type="number",example=900)
         *              ),
         *              @OA\Property(property="koli_code", type="string",example="AWB00100209082020.3"),
         *          )
         *        ),
         *      )
         *     ),
         *      @OA\Response(
         *          response=204,
         *          description="Successful operation",
         *          @OA\JsonContent()
         *       ),
         *      @OA\Response(
         *          response=401,
         *          description="Unauthenticated",
         *      ),
         *      @OA\Response(
         *          response=403,
         *          description="Forbidden"
         *      ),
         *      @OA\Response(
         *          response=404,
         *          description="Resource Not Found"
         *      )
         * )
         */
        $this->validate($request,[
            'koli_data' => 'required'
        ]);
        $package = Package::findOrFail($id);
        $package->fill($request->only(['koli_data']));
        if($package->save()){
            return response()->json($package, 200);
        } else {
            return response()->json(['UPDATE GAGAL'], 201);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        /**
     * @OA\Delete(
     *      path="/api/packages/{id}",
     *      operationId="deletepackage",
     *      tags={"packages"},
     *      summary="Delete existing package",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Packages id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
        $data = $package->delete();
        if($data){
            return response()->json(['DELETE SUKSES'], 200);
        } else {
            return response()->json(['DELETE GAGAL'], 201);
        }
    }
}
