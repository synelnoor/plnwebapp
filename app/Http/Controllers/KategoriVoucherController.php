<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriVoucherDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateKategoriVoucherRequest;
use App\Http\Requests\UpdateKategoriVoucherRequest;
use App\Repositories\KategoriVoucherRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class KategoriVoucherController extends AppBaseController
{
    /** @var  KategoriVoucherRepository */
    private $kategoriVoucherRepository;

    public function __construct(KategoriVoucherRepository $kategoriVoucherRepo)
    {
        $this->middleware('auth');
        $this->kategoriVoucherRepository = $kategoriVoucherRepo;
    }

    /**
     * Display a listing of the KategoriVoucher.
     *
     * @param KategoriVoucherDataTable $kategoriVoucherDataTable
     * @return Response
     */
    public function index(KategoriVoucherDataTable $kategoriVoucherDataTable)
    {
        return $kategoriVoucherDataTable->render('kategori_vouchers.index');
    }

    /**
     * Show the form for creating a new KategoriVoucher.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('kategori_vouchers.create');
        return view('kategori_vouchers.create');
    }

    /**
     * Store a newly created KategoriVoucher in storage.
     *
     * @param CreateKategoriVoucherRequest $request
     *
     * @return Response
     */
    public function store(CreateKategoriVoucherRequest $request)
    {
        $input = $request->all();

        $kategoriVoucher = $this->kategoriVoucherRepository->create($input);

        Flash::success('Kategori Voucher saved successfully.');

        return redirect(route('kategoriVouchers.index'));
    }

    /**
     * Display the specified KategoriVoucher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kategoriVoucher = $this->kategoriVoucherRepository->findWithoutFail($id);

        if (empty($kategoriVoucher)) {
            Flash::error('Kategori Voucher not found');

            return redirect(route('kategoriVouchers.index'));
        }

        return view('kategori_vouchers.show')->with('kategoriVoucher', $kategoriVoucher);
    }

    /**
     * Show the form for editing the specified KategoriVoucher.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $kategoriVoucher = $this->kategoriVoucherRepository->findWithoutFail($id);

        if (empty($kategoriVoucher)) {
            Flash::error('Kategori Voucher not found');

            return redirect(route('kategoriVouchers.index'));
        }

        // edited by dandisy
        // return view('kategori_vouchers.edit')->with('kategoriVoucher', $kategoriVoucher);
        return view('kategori_vouchers.edit')
            ->with('kategoriVoucher', $kategoriVoucher);        
    }

    /**
     * Update the specified KategoriVoucher in storage.
     *
     * @param  int              $id
     * @param UpdateKategoriVoucherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKategoriVoucherRequest $request)
    {
        $kategoriVoucher = $this->kategoriVoucherRepository->findWithoutFail($id);

        if (empty($kategoriVoucher)) {
            Flash::error('Kategori Voucher not found');

            return redirect(route('kategoriVouchers.index'));
        }

        $kategoriVoucher = $this->kategoriVoucherRepository->update($request->all(), $id);

        Flash::success('Kategori Voucher updated successfully.');

        return redirect(route('kategoriVouchers.index'));
    }

    /**
     * Remove the specified KategoriVoucher from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kategoriVoucher = $this->kategoriVoucherRepository->findWithoutFail($id);

        if (empty($kategoriVoucher)) {
            Flash::error('Kategori Voucher not found');

            return redirect(route('kategoriVouchers.index'));
        }

        $this->kategoriVoucherRepository->delete($id);

        Flash::success('Kategori Voucher deleted successfully.');

        return redirect(route('kategoriVouchers.index'));
    }

    /**
     * Store data KategoriVoucher from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $kategoriVoucher = $this->kategoriVoucherRepository->create($item->toArray());
            });
        });

        Flash::success('Kategori Voucher saved successfully.');

        return redirect(route('kategoriVouchers.index'));
    }
}
