<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateJabatanAPIRequest;
use App\Http\Requests\API\UpdateJabatanAPIRequest;
use App\Models\Jabatan;
use App\Repositories\JabatanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class JabatanController
 * @package App\Http\Controllers\API
 */

class JabatanAPIController extends AppBaseController
{
    /** @var  JabatanRepository */
    private $jabatanRepository;

    public function __construct(JabatanRepository $jabatanRepo)
    {
        $this->middleware('auth:api');
        $this->jabatanRepository = $jabatanRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/jabatans",
     *      summary="Get a listing of the Jabatans.",
     *      tags={"Jabatan"},
     *      description="Get all Jabatans",
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
     *                  @SWG\Items(ref="#/definitions/Jabatan")
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
        $this->jabatanRepository->pushCriteria(new RequestCriteria($request));
        $this->jabatanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $jabatans = $this->jabatanRepository->all();

        return $this->sendResponse($jabatans->toArray(), 'Jabatans retrieved successfully');
    }

    /**
     * @param CreateJabatanAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/jabatans",
     *      summary="Store a newly created Jabatan in storage",
     *      tags={"Jabatan"},
     *      description="Store Jabatan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Jabatan that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Jabatan")
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
     *                  ref="#/definitions/Jabatan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateJabatanAPIRequest $request)
    {
        $input = $request->all();

        $jabatans = $this->jabatanRepository->create($input);

        return $this->sendResponse($jabatans->toArray(), 'Jabatan saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/jabatans/{id}",
     *      summary="Display the specified Jabatan",
     *      tags={"Jabatan"},
     *      description="Get Jabatan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Jabatan",
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
     *                  ref="#/definitions/Jabatan"
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
        /** @var Jabatan $jabatan */
        $jabatan = $this->jabatanRepository->findWithoutFail($id);

        if (empty($jabatan)) {
            return $this->sendError('Jabatan not found');
        }

        return $this->sendResponse($jabatan->toArray(), 'Jabatan retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateJabatanAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/jabatans/{id}",
     *      summary="Update the specified Jabatan in storage",
     *      tags={"Jabatan"},
     *      description="Update Jabatan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Jabatan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Jabatan that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Jabatan")
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
     *                  ref="#/definitions/Jabatan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateJabatanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Jabatan $jabatan */
        $jabatan = $this->jabatanRepository->findWithoutFail($id);

        if (empty($jabatan)) {
            return $this->sendError('Jabatan not found');
        }

        $jabatan = $this->jabatanRepository->update($input, $id);

        return $this->sendResponse($jabatan->toArray(), 'Jabatan updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/jabatans/{id}",
     *      summary="Remove the specified Jabatan from storage",
     *      tags={"Jabatan"},
     *      description="Delete Jabatan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Jabatan",
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
        /** @var Jabatan $jabatan */
        $jabatan = $this->jabatanRepository->findWithoutFail($id);

        if (empty($jabatan)) {
            return $this->sendError('Jabatan not found');
        }

        $jabatan->delete();

        return $this->sendResponse($id, 'Jabatan deleted successfully');
    }
}
