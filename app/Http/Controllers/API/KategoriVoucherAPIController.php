<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKategoriVoucherAPIRequest;
use App\Http\Requests\API\UpdateKategoriVoucherAPIRequest;
use App\Models\KategoriVoucher;
use App\Repositories\KategoriVoucherRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class KategoriVoucherController
 * @package App\Http\Controllers\API
 */

class KategoriVoucherAPIController extends AppBaseController
{
    /** @var  KategoriVoucherRepository */
    private $kategoriVoucherRepository;

    public function __construct(KategoriVoucherRepository $kategoriVoucherRepo)
    {
        $this->middleware('auth:api');
        $this->kategoriVoucherRepository = $kategoriVoucherRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/kategoriVouchers",
     *      summary="Get a listing of the KategoriVouchers.",
     *      tags={"KategoriVoucher"},
     *      description="Get all KategoriVouchers",
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
     *                  @SWG\Items(ref="#/definitions/KategoriVoucher")
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
        $this->kategoriVoucherRepository->pushCriteria(new RequestCriteria($request));
        $this->kategoriVoucherRepository->pushCriteria(new LimitOffsetCriteria($request));
        $kategoriVouchers = $this->kategoriVoucherRepository->all();

        return $this->sendResponse($kategoriVouchers->toArray(), 'Kategori Vouchers retrieved successfully');
    }

    /**
     * @param CreateKategoriVoucherAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/kategoriVouchers",
     *      summary="Store a newly created KategoriVoucher in storage",
     *      tags={"KategoriVoucher"},
     *      description="Store KategoriVoucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="KategoriVoucher that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/KategoriVoucher")
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
     *                  ref="#/definitions/KategoriVoucher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateKategoriVoucherAPIRequest $request)
    {
        $input = $request->all();

        $kategoriVouchers = $this->kategoriVoucherRepository->create($input);

        return $this->sendResponse($kategoriVouchers->toArray(), 'Kategori Voucher saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/kategoriVouchers/{id}",
     *      summary="Display the specified KategoriVoucher",
     *      tags={"KategoriVoucher"},
     *      description="Get KategoriVoucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of KategoriVoucher",
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
     *                  ref="#/definitions/KategoriVoucher"
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
        /** @var KategoriVoucher $kategoriVoucher */
        $kategoriVoucher = $this->kategoriVoucherRepository->findWithoutFail($id);

        if (empty($kategoriVoucher)) {
            return $this->sendError('Kategori Voucher not found');
        }

        return $this->sendResponse($kategoriVoucher->toArray(), 'Kategori Voucher retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateKategoriVoucherAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/kategoriVouchers/{id}",
     *      summary="Update the specified KategoriVoucher in storage",
     *      tags={"KategoriVoucher"},
     *      description="Update KategoriVoucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of KategoriVoucher",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="KategoriVoucher that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/KategoriVoucher")
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
     *                  ref="#/definitions/KategoriVoucher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateKategoriVoucherAPIRequest $request)
    {
        $input = $request->all();

        /** @var KategoriVoucher $kategoriVoucher */
        $kategoriVoucher = $this->kategoriVoucherRepository->findWithoutFail($id);

        if (empty($kategoriVoucher)) {
            return $this->sendError('Kategori Voucher not found');
        }

        $kategoriVoucher = $this->kategoriVoucherRepository->update($input, $id);

        return $this->sendResponse($kategoriVoucher->toArray(), 'KategoriVoucher updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/kategoriVouchers/{id}",
     *      summary="Remove the specified KategoriVoucher from storage",
     *      tags={"KategoriVoucher"},
     *      description="Delete KategoriVoucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of KategoriVoucher",
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
        /** @var KategoriVoucher $kategoriVoucher */
        $kategoriVoucher = $this->kategoriVoucherRepository->findWithoutFail($id);

        if (empty($kategoriVoucher)) {
            return $this->sendError('Kategori Voucher not found');
        }

        $kategoriVoucher->delete();

        return $this->sendResponse($id, 'Kategori Voucher deleted successfully');
    }
}
