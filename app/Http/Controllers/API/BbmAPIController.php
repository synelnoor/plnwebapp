<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBbmAPIRequest;
use App\Http\Requests\API\UpdateBbmAPIRequest;
use App\Models\Bbm;
use App\Repositories\BbmRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BbmController
 * @package App\Http\Controllers\API
 */

class BbmAPIController extends AppBaseController
{
    /** @var  BbmRepository */
    private $bbmRepository;

    public function __construct(BbmRepository $bbmRepo)
    {
        $this->middleware('auth:api');
        $this->bbmRepository = $bbmRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/bbms",
     *      summary="Get a listing of the Bbms.",
     *      tags={"Bbm"},
     *      description="Get all Bbms",
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
     *                  @SWG\Items(ref="#/definitions/Bbm")
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
        $this->bbmRepository->pushCriteria(new RequestCriteria($request));
        $this->bbmRepository->pushCriteria(new LimitOffsetCriteria($request));
        $bbms = $this->bbmRepository->all();

        return $this->sendResponse($bbms->toArray(), 'Bbms retrieved successfully');
    }

    /**
     * @param CreateBbmAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/bbms",
     *      summary="Store a newly created Bbm in storage",
     *      tags={"Bbm"},
     *      description="Store Bbm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Bbm that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Bbm")
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
     *                  ref="#/definitions/Bbm"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBbmAPIRequest $request)
    {
        $input = $request->all();

        $bbms = $this->bbmRepository->create($input);

        return $this->sendResponse($bbms->toArray(), 'Bbm saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/bbms/{id}",
     *      summary="Display the specified Bbm",
     *      tags={"Bbm"},
     *      description="Get Bbm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Bbm",
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
     *                  ref="#/definitions/Bbm"
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
        /** @var Bbm $bbm */
        $bbm = $this->bbmRepository->findWithoutFail($id);

        if (empty($bbm)) {
            return $this->sendError('Bbm not found');
        }

        return $this->sendResponse($bbm->toArray(), 'Bbm retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBbmAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/bbms/{id}",
     *      summary="Update the specified Bbm in storage",
     *      tags={"Bbm"},
     *      description="Update Bbm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Bbm",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Bbm that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Bbm")
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
     *                  ref="#/definitions/Bbm"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBbmAPIRequest $request)
    {
        $input = $request->all();

        /** @var Bbm $bbm */
        $bbm = $this->bbmRepository->findWithoutFail($id);

        if (empty($bbm)) {
            return $this->sendError('Bbm not found');
        }

        $bbm = $this->bbmRepository->update($input, $id);

        return $this->sendResponse($bbm->toArray(), 'Bbm updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/bbms/{id}",
     *      summary="Remove the specified Bbm from storage",
     *      tags={"Bbm"},
     *      description="Delete Bbm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Bbm",
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
        /** @var Bbm $bbm */
        $bbm = $this->bbmRepository->findWithoutFail($id);

        if (empty($bbm)) {
            return $this->sendError('Bbm not found');
        }

        $bbm->delete();

        return $this->sendResponse($id, 'Bbm deleted successfully');
    }
}
