<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVoucherAPIRequest;
use App\Http\Requests\API\UpdateVoucherAPIRequest;
use App\Models\Voucher;
use App\Repositories\VoucherRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class VoucherController
 * @package App\Http\Controllers\API
 */

class VoucherAPIController extends AppBaseController
{
    /** @var  VoucherRepository */
    private $voucherRepository;

    public function __construct(VoucherRepository $voucherRepo)
    {
        $this->middleware('auth:api');
        $this->voucherRepository = $voucherRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/vouchers",
     *      summary="Get a listing of the Vouchers.",
     *      tags={"Voucher"},
     *      description="Get all Vouchers",
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
     *                  @SWG\Items(ref="#/definitions/Voucher")
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
        $this->voucherRepository->pushCriteria(new RequestCriteria($request));
        $this->voucherRepository->pushCriteria(new LimitOffsetCriteria($request));
        $vouchers = $this->voucherRepository->all();

        return $this->sendResponse($vouchers->toArray(), 'Vouchers retrieved successfully');
    }

    /**
     * @param CreateVoucherAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/vouchers",
     *      summary="Store a newly created Voucher in storage",
     *      tags={"Voucher"},
     *      description="Store Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Voucher that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Voucher")
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
     *                  ref="#/definitions/Voucher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVoucherAPIRequest $request)
    {
        $input = $request->all();

        $vouchers = $this->voucherRepository->create($input);

        return $this->sendResponse($vouchers->toArray(), 'Voucher saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/vouchers/{id}",
     *      summary="Display the specified Voucher",
     *      tags={"Voucher"},
     *      description="Get Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher",
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
     *                  ref="#/definitions/Voucher"
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
        /** @var Voucher $voucher */
        $voucher = $this->voucherRepository->findWithoutFail($id);

        if (empty($voucher)) {
            return $this->sendError('Voucher not found');
        }

        return $this->sendResponse($voucher->toArray(), 'Voucher retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVoucherAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/vouchers/{id}",
     *      summary="Update the specified Voucher in storage",
     *      tags={"Voucher"},
     *      description="Update Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Voucher that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Voucher")
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
     *                  ref="#/definitions/Voucher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVoucherAPIRequest $request)
    {
        $input = $request->all();

        /** @var Voucher $voucher */
        $voucher = $this->voucherRepository->findWithoutFail($id);

        if (empty($voucher)) {
            return $this->sendError('Voucher not found');
        }

        $voucher = $this->voucherRepository->update($input, $id);

        return $this->sendResponse($voucher->toArray(), 'Voucher updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/vouchers/{id}",
     *      summary="Remove the specified Voucher from storage",
     *      tags={"Voucher"},
     *      description="Delete Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Voucher",
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
        /** @var Voucher $voucher */
        $voucher = $this->voucherRepository->findWithoutFail($id);

        if (empty($voucher)) {
            return $this->sendError('Voucher not found');
        }

        $voucher->delete();

        return $this->sendResponse($id, 'Voucher deleted successfully');
    }
}
