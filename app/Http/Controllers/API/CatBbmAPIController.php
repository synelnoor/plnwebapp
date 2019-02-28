<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCatBbmAPIRequest;
use App\Http\Requests\API\UpdateCatBbmAPIRequest;
use App\Models\CatBbm;
use App\Repositories\CatBbmRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CatBbmController
 * @package App\Http\Controllers\API
 */

class CatBbmAPIController extends AppBaseController
{
    /** @var  CatBbmRepository */
    private $catBbmRepository;

    public function __construct(CatBbmRepository $catBbmRepo)
    {
        $this->middleware('auth:api');
        $this->catBbmRepository = $catBbmRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/catBbms",
     *      summary="Get a listing of the CatBbms.",
     *      tags={"CatBbm"},
     *      description="Get all CatBbms",
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
     *                  @SWG\Items(ref="#/definitions/CatBbm")
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
        $this->catBbmRepository->pushCriteria(new RequestCriteria($request));
        $this->catBbmRepository->pushCriteria(new LimitOffsetCriteria($request));
        $catBbms = $this->catBbmRepository->all();

        return $this->sendResponse($catBbms->toArray(), 'Cat Bbms retrieved successfully');
    }

    /**
     * @param CreateCatBbmAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/catBbms",
     *      summary="Store a newly created CatBbm in storage",
     *      tags={"CatBbm"},
     *      description="Store CatBbm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CatBbm that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CatBbm")
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
     *                  ref="#/definitions/CatBbm"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCatBbmAPIRequest $request)
    {
        $input = $request->all();

        $catBbms = $this->catBbmRepository->create($input);

        return $this->sendResponse($catBbms->toArray(), 'Cat Bbm saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/catBbms/{id}",
     *      summary="Display the specified CatBbm",
     *      tags={"CatBbm"},
     *      description="Get CatBbm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CatBbm",
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
     *                  ref="#/definitions/CatBbm"
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
        /** @var CatBbm $catBbm */
        $catBbm = $this->catBbmRepository->findWithoutFail($id);

        if (empty($catBbm)) {
            return $this->sendError('Cat Bbm not found');
        }

        return $this->sendResponse($catBbm->toArray(), 'Cat Bbm retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCatBbmAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/catBbms/{id}",
     *      summary="Update the specified CatBbm in storage",
     *      tags={"CatBbm"},
     *      description="Update CatBbm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CatBbm",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CatBbm that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CatBbm")
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
     *                  ref="#/definitions/CatBbm"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCatBbmAPIRequest $request)
    {
        $input = $request->all();

        /** @var CatBbm $catBbm */
        $catBbm = $this->catBbmRepository->findWithoutFail($id);

        if (empty($catBbm)) {
            return $this->sendError('Cat Bbm not found');
        }

        $catBbm = $this->catBbmRepository->update($input, $id);

        return $this->sendResponse($catBbm->toArray(), 'CatBbm updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/catBbms/{id}",
     *      summary="Remove the specified CatBbm from storage",
     *      tags={"CatBbm"},
     *      description="Delete CatBbm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CatBbm",
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
        /** @var CatBbm $catBbm */
        $catBbm = $this->catBbmRepository->findWithoutFail($id);

        if (empty($catBbm)) {
            return $this->sendError('Cat Bbm not found');
        }

        $catBbm->delete();

        return $this->sendResponse($id, 'Cat Bbm deleted successfully');
    }
}
