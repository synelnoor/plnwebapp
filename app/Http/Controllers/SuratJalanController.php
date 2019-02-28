<?php

namespace App\Http\Controllers;

use App\DataTables\SuratJalanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSuratJalanRequest;
use App\Http\Requests\UpdateSuratJalanRequest;
use App\Repositories\SuratJalanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class SuratJalanController extends AppBaseController
{
    /** @var  SuratJalanRepository */
    private $suratJalanRepository;

    public function __construct(SuratJalanRepository $suratJalanRepo)
    {
        $this->middleware('auth');
        $this->suratJalanRepository = $suratJalanRepo;
    }

    /**
     * Display a listing of the SuratJalan.
     *
     * @param SuratJalanDataTable $suratJalanDataTable
     * @return Response
     */
    public function index(SuratJalanDataTable $suratJalanDataTable)
    {
        return $suratJalanDataTable->render('surat_jalans.index');
    }

    /**
     * Show the form for creating a new SuratJalan.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('surat_jalans.create');
        return view('surat_jalans.create');
    }

    /**
     * Store a newly created SuratJalan in storage.
     *
     * @param CreateSuratJalanRequest $request
     *
     * @return Response
     */
    public function store(CreateSuratJalanRequest $request)
    {
        $input = $request->all();

        $suratJalan = $this->suratJalanRepository->create($input);

        Flash::success('Surat Jalan saved successfully.');

        return redirect(route('suratJalans.index'));
    }

    /**
     * Display the specified SuratJalan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $suratJalan = $this->suratJalanRepository->findWithoutFail($id);

        if (empty($suratJalan)) {
            Flash::error('Surat Jalan not found');

            return redirect(route('suratJalans.index'));
        }

        return view('surat_jalans.show')->with('suratJalan', $suratJalan);
    }

    /**
     * Show the form for editing the specified SuratJalan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $suratJalan = $this->suratJalanRepository->findWithoutFail($id);

        if (empty($suratJalan)) {
            Flash::error('Surat Jalan not found');

            return redirect(route('suratJalans.index'));
        }

        // edited by dandisy
        // return view('surat_jalans.edit')->with('suratJalan', $suratJalan);
        return view('surat_jalans.edit')
            ->with('suratJalan', $suratJalan);        
    }

    /**
     * Update the specified SuratJalan in storage.
     *
     * @param  int              $id
     * @param UpdateSuratJalanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSuratJalanRequest $request)
    {
        $suratJalan = $this->suratJalanRepository->findWithoutFail($id);

        if (empty($suratJalan)) {
            Flash::error('Surat Jalan not found');

            return redirect(route('suratJalans.index'));
        }

        $suratJalan = $this->suratJalanRepository->update($request->all(), $id);

        Flash::success('Surat Jalan updated successfully.');

        return redirect(route('suratJalans.index'));
    }

    /**
     * Remove the specified SuratJalan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $suratJalan = $this->suratJalanRepository->findWithoutFail($id);

        if (empty($suratJalan)) {
            Flash::error('Surat Jalan not found');

            return redirect(route('suratJalans.index'));
        }

        $this->suratJalanRepository->delete($id);

        Flash::success('Surat Jalan deleted successfully.');

        return redirect(route('suratJalans.index'));
    }

    /**
     * Store data SuratJalan from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $suratJalan = $this->suratJalanRepository->create($item->toArray());
            });
        });

        Flash::success('Surat Jalan saved successfully.');

        return redirect(route('suratJalans.index'));
    }
}
