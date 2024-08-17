<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\HolidayPlan as HolidayPlan;
use App\Http\Resources\HolidayPlan as HolidayPlanResource;
use Illuminate\Http\Request;
use App\Http\Requests\HolidayPlanRequest;
use App\Models\Usuario;
use PDF;

/**
 * @OA\Info(title="Holiday Plan API", version="0.1")
 */
class HolidayPlanController extends Controller
{
    private function mainReturn($data,$status = 200,$message = 'Success')
    {
        return response()->json([
            'status'    => $status,
            'message'   => $message,
            'data'      => $data
        ], $status);
    }


    /**
    *  @OA\GET(
    *      path="/api/holiday-plan", summary="Get all plans", description="Get all plans",
    *      tags={"Holiday Plan"},
    *      @OA\Response( response=200, description="Success", @OA\MediaType( mediaType="application/json", ) ),
    *  )
    */
    public function index()
    {
        $holidayPlan = HolidayPlan::get();

        return $this->mainReturn(HolidayPlanResource::collection($holidayPlan));
    }

    /**
    *  @OA\POST(
    *      path="/api/holiday-plan", summary="Create plan", description="Create plan",
    *      tags={"Holiday Plan"},
    *      @OA\RequestBody( required=true, @OA\MediaType( mediaType="application/json", @OA\Schema(
    *         @OA\Property( property="title", description="plan title", type="string", ),
    *         @OA\Property( property="description", description="plan description", type="string", ),
    *         @OA\Property( property="date", description="plan date", type="date", ),
    *         @OA\Property( property="participants", description="plan participants", type="string", ),
    *        ),
    *       ),
    *      ),
    *      @OA\Response( response=200, description="Success", @OA\MediaType( mediaType="application/json", ) ),
    *  )
    */
    public function store(HolidayPlanRequest $request)
    {
        $holidayPlan = new HolidayPlan;
        $holidayPlan->title         = $request->input('title');
        $holidayPlan->description   = $request->input('description');
        $holidayPlan->date          = $request->input('date');
        $holidayPlan->participants  = $request->input('participants');

        $holidayPlan->save();
        return $this->mainReturn(new HolidayPlanResource( $holidayPlan ));
    }

    /**
    *  @OA\GET(
    *      path="/api/holiday-plan/{id}", summary="Get specific plan", description="Get specific plan",
    *      tags={"Holiday Plan"},
    *      @OA\Parameter( name="id", description="ID holiday plan", in="path", required=true, @OA\Schema( type="integer" ) ),
    *      @OA\Response( response=200, description="Success", @OA\MediaType( mediaType="application/json", ) ),
    *  )
    */
    public function show($id)
    {
        $holidayPlan = HolidayPlan::find( $id );
        if(!$holidayPlan){
            return $this->mainReturn(null,404,'Holilday plan not found');
        }
        // $this->authorize('view', $holidayPlan);
        return $this->mainReturn(new HolidayPlanResource( $holidayPlan ));
    }

    /**
    *  @OA\PUT(
    *      path="/api/holiday-plan/{id}", summary="Update plan", description="Create plan",
    *      tags={"Holiday Plan"},
    *      @OA\Parameter( name="id", description="ID holiday plan", in="path", required=true, @OA\Schema( type="integer" ) ),
    *      @OA\RequestBody( required=true, @OA\MediaType( mediaType="application/json", @OA\Schema(
    *         @OA\Property( property="title", description="plan title", type="string", ),
    *         @OA\Property( property="description", description="plan description", type="string", ),
    *         @OA\Property( property="date", description="plan date", type="date", ),
    *         @OA\Property( property="participants", description="plan participants", type="string", ),
    *        ),
    *       ),
    *      ),
    *      @OA\Response( response=200, description="Success", @OA\MediaType( mediaType="application/json", ) ),
    *  )
    */
    public function update(HolidayPlanRequest $request, $id)
    {

        $holidayPlan = HolidayPlan::find($id);
        if(!$holidayPlan){
            return $this->mainReturn(null,404,'Holilday plan not found');
        }
        // $this->authorize('update', $holidayPlan);

        $holidayPlan->title         = $request->input('title');
        $holidayPlan->description   = $request->input('description');
        $holidayPlan->date          = $request->input('date');
        $holidayPlan->participants  = $request->input('participants');

        $holidayPlan->save();
        return $this->mainReturn(new HolidayPlanResource( $holidayPlan ));

    }

    /**
    *  @OA\DELETE(
    *      path="/api/holiday-plan/{id}", summary="Delete specific plan", description="Delete specific plan",
    *      tags={"Holiday Plan"},
    *      @OA\Parameter( name="id", description="ID holiday plan", in="path", required=true, @OA\Schema( type="integer" ) ),
    *      @OA\Response( response=200, description="Success", @OA\MediaType( mediaType="application/json", ) ),
    *  )
    */
    public function destroy($id)
    {
        $holidayPlan = HolidayPlan::findOrFail( $id );
        // $this->authorize('delete', $holidayPlan);

        if( $holidayPlan->delete() ){
            return $this->mainReturn(null);
        }
    }

    /**
    *  @OA\GET(
    *      path="/api/holiday-plan/{id}/pdf", summary="Export informations about specific plan", description="Export informations about specific plan",
    *      tags={"Holiday Plan"},
    *      @OA\Parameter( name="id", description="ID holiday plan", in="path", required=true, @OA\Schema( type="integer" ) ),
    *      @OA\Response( response=200, description="Success", @OA\MediaType( mediaType="application/json", ) ),
    *  )
    */
    public function showPDF($id)
    {
        $holidayPlan = HolidayPlan::find( $id );
        if(!$holidayPlan){
            return $this->mainReturn(null,404,'Holilday plan not found');
        }

        // $pdf = PDF::loadView('holidayPlan.template-pdf', ['holidayPlan' => $holidayPlan])->setPaper('a4', 'portrait');
        $pdf = PDF::loadView('holidayPlan.template-pdf', ['holidayPlan' => $holidayPlan]);

        return $pdf->download('template.pdf');
    }
}
