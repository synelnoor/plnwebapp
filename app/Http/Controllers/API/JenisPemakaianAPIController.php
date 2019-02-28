<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJenisPemakaianAPIRequest;
use App\Http\Requests\API\UpdateJenisPemakaianAPIRequest;
use App\Models\JenisPemakaian;
use App\Repositories\JenisPemakaianRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class JenisPemakaianController
 * @package App\Http\Controllers\API
 */

class JenisPemakaianAPIController extends AppBaseController
{
    /** @var  JenisPemakaianRepository */
    private $jenisPemakaianRepository;

    public function __construct(JenisPemakaianRepository $jenisPemakaianRepo)
    {
        $this->middleware('auth:api');
        $this->jenisPemakaianRepository = $jenisPemakaianRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/jenisPemakaians",
     *      summary="Get a listing of the JenisPemakaians.",
     *      tags={"JenisPemakaian"},
     *      description="Get all JenisPemakaians",
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
     *                  @SWG\Items(ref="#/definitions/JenisPemakaian")
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
        $this->jenisPemakaianRepository->pushCriteria(new RequestCriteria($request));
        $this->jenisPemakaianRepository->pushCriteria(new LimitOffsetCriteria($request));
        $jenisPemakaians = $this->jenisPemakaianRepository->all();

        return $this->sendResponse($jenisPemakaians->toArray(), 'Jenis Pemakaians retrieved successfully');
    }

    /**
     * @param CreateJenisPemakaianAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/jenisPemakaians",
     *      summary="Store a newly created JenisPemakaian in storage",
     *      tags={"JenisPemakaian"},
     *      description="Store JenisPemakaian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JenisPemakaian that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/JenisPemakaian")
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
     *                  ref="#/definitions/JenisPemakaian"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateJenisPemakaianAPIRequest $request)
    {
        $input = $request->all();

        $jenisPemakaians = $this->jenisPemakaianRepository->create($input);

        return $this->sendResponse($jenisPemakaians->toArray(), 'Jenis Pemakaian saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/jenisPemakaians/{id}",
     *      summary="Display the specified JenisPemakaian",
     *      tags={"JenisPemakaian"},
     *      description="Get JenisPemakaian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of JenisPemakaian",
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
     *                  ref="#/definitions/JenisPemakaian"
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
        /** @var JenisPemakaian $jenisPemakaian */
        $jenisPemakaian = $this->jenisPemakaianRepository->findWithoutFail($id);

        if (empty($jenisPemakaian)) {
            return $this->sendError('Jenis Pemakaian not found');
        }

        return $this->sendResponse($jenisPemakaian->toArray(), 'Jenis Pemakaian retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateJenisPemakaianAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/jenisPemakaians/{id}",
     *      summary="Update the specified JenisPemakaian in storage",
     *      tags={"JenisPemakaian"},
     *      description="Update JenisPemakaian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of JenisPemakaian",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JenisPemakaian that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/JenisPemakaian")
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
     *                  ref="#/definitions/JenisPemakaian"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateJenisPemakaianAPIRequest $request)
    {
        $input = $request->all();

        /** @var JenisPemakaian $jenisPemakaian */
        $jenisPemakaian = $this->jenisPemakaianRepository->findWithoutFail($id);

        if (empty($jenisPemakaian)) {
            return $this->sendError('Jenis Pemakaian not found');
        }

        $jenisPemakaian = $this->jenisPemakaianRepository->update($input, $id);

        return $this->sendResponse($jenisPemakaian->toArray(), 'JenisPemakaian updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/jenisPemakaians/{id}",
     *      summary="Remove the specified JenisPemakaian from storage",
     *      tags={"JenisPemakaian"},
     *      description="Delete JenisPemakaian",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of JenisPemakaian",
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
        /** @var JenisPemakaian $jenisPemakaian */
        $jenisPemakaian = $this->jenisPemakaianRepository->findWithoutFail($id);

        if (empty($jenisPemakaian)) {
            return $this->sendError('Jenis Pemakaian not found');
        }

        $jenisPemakaian->delete();

        return $this->sendResponse($id, 'Jenis Pemakaian deleted successfully');
    }
}
