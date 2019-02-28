<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSuratJalanAPIRequest;
use App\Http\Requests\API\UpdateSuratJalanAPIRequest;
use App\Models\SuratJalan;
use App\Repositories\SuratJalanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SuratJalanController
 * @package App\Http\Controllers\API
 */

class SuratJalanAPIController extends AppBaseController
{
    /** @var  SuratJalanRepository */
    private $suratJalanRepository;

    public function __construct(SuratJalanRepository $suratJalanRepo)
    {
        $this->middleware('auth:api');
        $this->suratJalanRepository = $suratJalanRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/suratJalans",
     *      summary="Get a listing of the SuratJalans.",
     *      tags={"SuratJalan"},
     *      description="Get all SuratJalans",
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
     *                  @SWG\Items(ref="#/definitions/SuratJalan")
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
        $this->suratJalanRepository->pushCriteria(new RequestCriteria($request));
        $this->suratJalanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $suratJalans = $this->suratJalanRepository->all();

        return $this->sendResponse($suratJalans->toArray(), 'Surat Jalans retrieved successfully');
    }

    /**
     * @param CreateSuratJalanAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/suratJalans",
     *      summary="Store a newly created SuratJalan in storage",
     *      tags={"SuratJalan"},
     *      description="Store SuratJalan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SuratJalan that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SuratJalan")
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
     *                  ref="#/definitions/SuratJalan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSuratJalanAPIRequest $request)
    {
        $input = $request->all();

        $suratJalans = $this->suratJalanRepository->create($input);

        return $this->sendResponse($suratJalans->toArray(), 'Surat Jalan saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/suratJalans/{id}",
     *      summary="Display the specified SuratJalan",
     *      tags={"SuratJalan"},
     *      description="Get SuratJalan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratJalan",
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
     *                  ref="#/definitions/SuratJalan"
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
        /** @var SuratJalan $suratJalan */
        $suratJalan = $this->suratJalanRepository->findWithoutFail($id);

        if (empty($suratJalan)) {
            return $this->sendError('Surat Jalan not found');
        }

        return $this->sendResponse($suratJalan->toArray(), 'Surat Jalan retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSuratJalanAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/suratJalans/{id}",
     *      summary="Update the specified SuratJalan in storage",
     *      tags={"SuratJalan"},
     *      description="Update SuratJalan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratJalan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SuratJalan that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SuratJalan")
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
     *                  ref="#/definitions/SuratJalan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSuratJalanAPIRequest $request)
    {
        $input = $request->all();

        /** @var SuratJalan $suratJalan */
        $suratJalan = $this->suratJalanRepository->findWithoutFail($id);

        if (empty($suratJalan)) {
            return $this->sendError('Surat Jalan not found');
        }

        $suratJalan = $this->suratJalanRepository->update($input, $id);

        return $this->sendResponse($suratJalan->toArray(), 'SuratJalan updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/suratJalans/{id}",
     *      summary="Remove the specified SuratJalan from storage",
     *      tags={"SuratJalan"},
     *      description="Delete SuratJalan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SuratJalan",
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
        /** @var SuratJalan $suratJalan */
        $suratJalan = $this->suratJalanRepository->findWithoutFail($id);

        if (empty($suratJalan)) {
            return $this->sendError('Surat Jalan not found');
        }

        $suratJalan->delete();

        return $this->sendResponse($id, 'Surat Jalan deleted successfully');
    }
}
