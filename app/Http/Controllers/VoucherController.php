<?php

namespace App\Http\Controllers;

use App\DataTables\VoucherDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Repositories\VoucherRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class VoucherController extends AppBaseController
{
    /** @var  VoucherRepository */
    private $voucherRepository;

    public function __construct(VoucherRepository $voucherRepo)
    {
        $this->middleware('auth');
        $this->voucherRepository = $voucherRepo;
    }

    /**
     * Display a listing of the Voucher.
     *
     * @param VoucherDataTable $voucherDataTable
     * @return Response
     */
    public function index(VoucherDataTable $voucherDataTable)
    {
        return $voucherDataTable->render('vouchers.index');
    }

    /**
     * Show the form for creating a new Voucher.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('vouchers.create');
        return view('vouchers.create');
    }

    /**
     * Store a newly created Voucher in storage.
     *
     * @param CreateVoucherRequest $request
     *
     * @return Response
     */
    public function store(CreateVoucherRequest $request)
    {
        $input = $request->all();

        $voucher = $this->voucherRepository->create($input);

        Flash::success('Voucher saved successfully.');

        return redirect(route('vouchers.index'));
    }

    /**
     * Display the specified Voucher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $voucher = $this->voucherRepository->findWithoutFail($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        return view('vouchers.show')->with('voucher', $voucher);
    }

    /**
     * Show the form for editing the specified Voucher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $voucher = $this->voucherRepository->findWithoutFail($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        // edited by dandisy
        // return view('vouchers.edit')->with('voucher', $voucher);
        return view('vouchers.edit')
            ->with('voucher', $voucher);        
    }

    /**
     * Update the specified Voucher in storage.
     *
     * @param  int              $id
     * @param UpdateVoucherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVoucherRequest $request)
    {
        $voucher = $this->voucherRepository->findWithoutFail($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        $voucher = $this->voucherRepository->update($request->all(), $id);

        Flash::success('Voucher updated successfully.');

        return redirect(route('vouchers.index'));
    }

    /**
     * Remove the specified Voucher from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $voucher = $this->voucherRepository->findWithoutFail($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        $this->voucherRepository->delete($id);

        Flash::success('Voucher deleted successfully.');

        return redirect(route('vouchers.index'));
    }

    /**
     * Store data Voucher from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $voucher = $this->voucherRepository->create($item->toArray());
            });
        });

        Flash::success('Voucher saved successfully.');

        return redirect(route('vouchers.index'));
    }
}
