<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKilometerAPIRequest;
use App\Http\Requests\API\UpdateKilometerAPIRequest;
use App\Models\Kilometer;
use App\Repositories\KilometerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class KilometerController
 * @package App\Http\Controllers\API
 */

class KilometerAPIController extends AppBaseController
{
    /** @var  KilometerRepository */
    private $kilometerRepository;

    public function __construct(KilometerRepository $kilometerRepo)
    {
        $this->middleware('auth:api');
        $this->kilometerRepository = $kilometerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/kilometers",
     *      summary="Get a listing of the Kilometers.",
     *      tags={"Kilometer"},
     *      description="Get all Kilometers",
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
     *                  @SWG\Items(ref="#/definitions/Kilometer")
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
        $this->kilometerRepository->pushCriteria(new RequestCriteria($request));
        $this->kilometerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $kilometers = $this->kilometerRepository->all();

        return $this->sendResponse($kilometers->toArray(), 'Kilometers retrieved successfully');
    }

    /**
     * @param CreateKilometerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/kilometers",
     *      summary="Store a newly created Kilometer in storage",
     *      tags={"Kilometer"},
     *      description="Store Kilometer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Kilometer that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Kilometer")
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
     *                  ref="#/definitions/Kilometer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateKilometerAPIRequest $request)
    {
        $input = $request->all();

        $kilometers = $this->kilometerRepository->create($input);

        return $this->sendResponse($kilometers->toArray(), 'Kilometer saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/kilometers/{id}",
     *      summary="Display the specified Kilometer",
     *      tags={"Kilometer"},
     *      description="Get Kilometer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Kilometer",
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
     *                  ref="#/definitions/Kilometer"
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
        /** @var Kilometer $kilometer */
        $kilometer = $this->kilometerRepository->findWithoutFail($id);

        if (empty($kilometer)) {
            return $this->sendError('Kilometer not found');
        }

        return $this->sendResponse($kilometer->toArray(), 'Kilometer retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateKilometerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/kilometers/{id}",
     *      summary="Update the specified Kilometer in storage",
     *      tags={"Kilometer"},
     *      description="Update Kilometer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Kilometer",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Kilometer that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Kilometer")
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
     *                  ref="#/definitions/Kilometer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateKilometerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Kilometer $kilometer */
        $kilometer = $this->kilometerRepository->findWithoutFail($id);

        if (empty($kilometer)) {
            return $this->sendError('Kilometer not found');
        }

        $kilometer = $this->kilometerRepository->update($input, $id);

        return $this->sendResponse($kilometer->toArray(), 'Kilometer updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/kilometers/{id}",
     *      summary="Remove the specified Kilometer from storage",
     *      tags={"Kilometer"},
     *      description="Delete Kilometer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Kilometer",
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
        /** @var Kilometer $kilometer */
        $kilometer = $this->kilometerRepository->findWithoutFail($id);

        if (empty($kilometer)) {
            return $this->sendError('Kilometer not found');
        }

        $kilometer->delete();

        return $this->sendResponse($id, 'Kilometer deleted successfully');
    }
}
