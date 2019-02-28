<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLapSuratJalanAPIRequest;
use App\Http\Requests\API\UpdateLapSuratJalanAPIRequest;
use App\Models\LapSuratJalan;
use App\Repositories\LapSuratJalanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LapSuratJalanController
 * @package App\Http\Controllers\API
 */

class LapSuratJalanAPIController extends AppBaseController
{
    /** @var  LapSuratJalanRepository */
    private $lapSuratJalanRepository;

    public function __construct(LapSuratJalanRepository $lapSuratJalanRepo)
    {
        $this->middleware('auth:api');
        $this->lapSuratJalanRepository = $lapSuratJalanRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/lapSuratJalans",
     *      summary="Get a listing of the LapSuratJalans.",
     *      tags={"LapSuratJalan"},
     *      description="Get all LapSuratJalans",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/LapSuratJalan")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->lapSuratJalanRepository->pushCriteria(new RequestCriteria($request));
        $this->lapSuratJalanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $lapSuratJalans = $this->lapSuratJalanRepository->all();

        return $this->sendResponse($lapSuratJalans->toArray(), 'Lap Surat Jalans retrieved successfully');
    }

    /**
     * @param CreateLapSuratJalanAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/lapSuratJalans",
     *      summary="Store a newly created LapSuratJalan in storage",
     *      tags={"LapSuratJalan"},
     *      description="Store LapSuratJalan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LapSuratJalan that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LapSuratJalan")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/LapSuratJalan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLapSuratJalanAPIRequest $request)
    {
        $input = $request->all();

        $lapSuratJalans = $this->lapSuratJalanRepository->create($input);

        return $this->sendResponse($lapSuratJalans->toArray(), 'Lap Surat Jalan saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/lapSuratJalans/{id}",
     *      summary="Display the specified LapSuratJalan",
     *      tags={"LapSuratJalan"},
     *      description="Get LapSuratJalan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LapSuratJalan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/LapSuratJalan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var LapSuratJalan $lapSuratJalan */
        $lapSuratJalan = $this->lapSuratJalanRepository->findWithoutFail($id);

        if (empty($lapSuratJalan)) {
            return $this->sendError('Lap Surat Jalan not found');
        }

        return $this->sendResponse($lapSuratJalan->toArray(), 'Lap Surat Jalan retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLapSuratJalanAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/lapSuratJalans/{id}",
     *      summary="Update the specified LapSuratJalan in storage",
     *      tags={"LapSuratJalan"},
     *      description="Update LapSuratJalan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LapSuratJalan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LapSuratJalan that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LapSuratJalan")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/LapSuratJalan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLapSuratJalanAPIRequest $request)
    {
        $input = $request->all();

        /** @var LapSuratJalan $lapSuratJalan */
        $lapSuratJalan = $this->lapSuratJalanRepository->findWithoutFail($id);

        if (empty($lapSuratJalan)) {
            return $this->sendError('Lap Surat Jalan not found');
        }

        $lapSuratJalan = $this->lapSuratJalanRepository->update($input, $id);

        return $this->sendResponse($lapSuratJalan->toArray(), 'LapSuratJalan updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/lapSuratJalans/{id}",
     *      summary="Remove the specified LapSuratJalan from storage",
     *      tags={"LapSuratJalan"},
     *      description="Delete LapSuratJalan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LapSuratJalan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var LapSuratJalan $lapSuratJalan */
        $lapSuratJalan = $this->lapSuratJalanRepository->findWithoutFail($id);

        if (empty($lapSuratJalan)) {
            return $this->sendError('Lap Surat Jalan not found');
        }

        $lapSuratJalan->delete();

        return $this->sendResponse($id, 'Lap Surat Jalan deleted successfully');
    }
}
