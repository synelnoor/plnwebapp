<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCabangAPIRequest;
use App\Http\Requests\API\UpdateCabangAPIRequest;
use App\Models\Cabang;
use App\Repositories\CabangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CabangController
 * @package App\Http\Controllers\API
 */

class CabangAPIController extends AppBaseController
{
    /** @var  CabangRepository */
    private $cabangRepository;

    public function __construct(CabangRepository $cabangRepo)
    {
        $this->middleware('auth:api');
        $this->cabangRepository = $cabangRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/cabangs",
     *      summary="Get a listing of the Cabangs.",
     *      tags={"Cabang"},
     *      description="Get all Cabangs",
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
     *                  @SWG\Items(ref="#/definitions/Cabang")
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
        $this->cabangRepository->pushCriteria(new RequestCriteria($request));
        $this->cabangRepository->pushCriteria(new LimitOffsetCriteria($request));
        $cabangs = $this->cabangRepository->all();

        return $this->sendResponse($cabangs->toArray(), 'Cabangs retrieved successfully');
    }

    /**
     * @param CreateCabangAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cabangs",
     *      summary="Store a newly created Cabang in storage",
     *      tags={"Cabang"},
     *      description="Store Cabang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Cabang that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Cabang")
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
     *                  ref="#/definitions/Cabang"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCabangAPIRequest $request)
    {
        $input = $request->all();

        $cabangs = $this->cabangRepository->create($input);

        return $this->sendResponse($cabangs->toArray(), 'Cabang saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/cabangs/{id}",
     *      summary="Display the specified Cabang",
     *      tags={"Cabang"},
     *      description="Get Cabang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cabang",
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
     *                  ref="#/definitions/Cabang"
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
        /** @var Cabang $cabang */
        $cabang = $this->cabangRepository->findWithoutFail($id);

        if (empty($cabang)) {
            return $this->sendError('Cabang not found');
        }

        return $this->sendResponse($cabang->toArray(), 'Cabang retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCabangAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/cabangs/{id}",
     *      summary="Update the specified Cabang in storage",
     *      tags={"Cabang"},
     *      description="Update Cabang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cabang",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Cabang that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Cabang")
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
     *                  ref="#/definitions/Cabang"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCabangAPIRequest $request)
    {
        $input = $request->all();

        /** @var Cabang $cabang */
        $cabang = $this->cabangRepository->findWithoutFail($id);

        if (empty($cabang)) {
            return $this->sendError('Cabang not found');
        }

        $cabang = $this->cabangRepository->update($input, $id);

        return $this->sendResponse($cabang->toArray(), 'Cabang updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/cabangs/{id}",
     *      summary="Remove the specified Cabang from storage",
     *      tags={"Cabang"},
     *      description="Delete Cabang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cabang",
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
        /** @var Cabang $cabang */
        $cabang = $this->cabangRepository->findWithoutFail($id);

        if (empty($cabang)) {
            return $this->sendError('Cabang not found');
        }

        $cabang->delete();

        return $this->sendResponse($id, 'Cabang deleted successfully');
    }
}
