<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRfidAPIRequest;
use App\Http\Requests\API\UpdateRfidAPIRequest;
use App\Models\Rfid;
use App\Repositories\RfidRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RfidController
 * @package App\Http\Controllers\API
 */

class RfidAPIController extends AppBaseController
{
    /** @var  RfidRepository */
    private $rfidRepository;

    public function __construct(RfidRepository $rfidRepo)
    {
        $this->middleware('auth:api');
        $this->rfidRepository = $rfidRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/rfids",
     *      summary="Get a listing of the Rfids.",
     *      tags={"Rfid"},
     *      description="Get all Rfids",
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
     *                  @SWG\Items(ref="#/definitions/Rfid")
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
        $this->rfidRepository->pushCriteria(new RequestCriteria($request));
        $this->rfidRepository->pushCriteria(new LimitOffsetCriteria($request));
        $rfids = $this->rfidRepository->all();

        return $this->sendResponse($rfids->toArray(), 'Rfids retrieved successfully');
    }

    /**
     * @param CreateRfidAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/rfids",
     *      summary="Store a newly created Rfid in storage",
     *      tags={"Rfid"},
     *      description="Store Rfid",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Rfid that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Rfid")
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
     *                  ref="#/definitions/Rfid"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRfidAPIRequest $request)
    {
        $input = $request->all();

        $rfids = $this->rfidRepository->create($input);

        return $this->sendResponse($rfids->toArray(), 'Rfid saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/rfids/{id}",
     *      summary="Display the specified Rfid",
     *      tags={"Rfid"},
     *      description="Get Rfid",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Rfid",
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
     *                  ref="#/definitions/Rfid"
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
        /** @var Rfid $rfid */
        $rfid = $this->rfidRepository->findWithoutFail($id);

        if (empty($rfid)) {
            return $this->sendError('Rfid not found');
        }

        return $this->sendResponse($rfid->toArray(), 'Rfid retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRfidAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/rfids/{id}",
     *      summary="Update the specified Rfid in storage",
     *      tags={"Rfid"},
     *      description="Update Rfid",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Rfid",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Rfid that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Rfid")
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
     *                  ref="#/definitions/Rfid"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRfidAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rfid $rfid */
        $rfid = $this->rfidRepository->findWithoutFail($id);

        if (empty($rfid)) {
            return $this->sendError('Rfid not found');
        }

        $rfid = $this->rfidRepository->update($input, $id);

        return $this->sendResponse($rfid->toArray(), 'Rfid updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/rfids/{id}",
     *      summary="Remove the specified Rfid from storage",
     *      tags={"Rfid"},
     *      description="Delete Rfid",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Rfid",
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
        /** @var Rfid $rfid */
        $rfid = $this->rfidRepository->findWithoutFail($id);

        if (empty($rfid)) {
            return $this->sendError('Rfid not found');
        }

        $rfid->delete();

        return $this->sendResponse($id, 'Rfid deleted successfully');
    }
}
