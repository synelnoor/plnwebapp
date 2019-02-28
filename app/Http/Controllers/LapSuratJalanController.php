<?php

namespace App\Http\Controllers;

use App\DataTables\LapSuratJalanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLapSuratJalanRequest;
use App\Http\Requests\UpdateLapSuratJalanRequest;
use App\Repositories\LapSuratJalanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class LapSuratJalanController extends AppBaseController
{
    /** @var  LapSuratJalanRepository */
    private $lapSuratJalanRepository;

    public function __construct(LapSuratJalanRepository $lapSuratJalanRepo)
    {
        $this->middleware('auth');
        $this->lapSuratJalanRepository = $lapSuratJalanRepo;
    }

    /**
     * Display a listing of the LapSuratJalan.
     *
     * @param LapSuratJalanDataTable $lapSuratJalanDataTable
     * @return Response
     */
    public function index(LapSuratJalanDataTable $lapSuratJalanDataTable)
    {
        return $lapSuratJalanDataTable->render('lap_surat_jalans.index');
    }

    /**
     * Show the form for creating a new LapSuratJalan.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('lap_surat_jalans.create');
        return view('lap_surat_jalans.create');
    }

    /**
     * Store a newly created LapSuratJalan in storage.
     *
     * @param CreateLapSuratJalanRequest $request
     *
     * @return Response
     */
    public function store(CreateLapSuratJalanRequest $request)
    {
        $input = $request->all();

        $lapSuratJalan = $this->lapSuratJalanRepository->create($input);

        Flash::success('Lap Surat Jalan saved successfully.');

        return redirect(route('lapSuratJalans.index'));
    }

    /**
     * Display the specified LapSuratJalan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lapSuratJalan = $this->lapSuratJalanRepository->findWithoutFail($id);

        if (empty($lapSuratJalan)) {
            Flash::error('Lap Surat Jalan not found');

            return redirect(route('lapSuratJalans.index'));
        }

        return view('lap_surat_jalans.show')->with('lapSuratJalan', $lapSuratJalan);
    }

    /**
     * Show the form for editing the specified LapSuratJalan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $lapSuratJalan = $this->lapSuratJalanRepository->findWithoutFail($id);

        if (empty($lapSuratJalan)) {
            Flash::error('Lap Surat Jalan not found');

            return redirect(route('lapSuratJalans.index'));
        }

        // edited by dandisy
        // return view('lap_surat_jalans.edit')->with('lapSuratJalan', $lapSuratJalan);
        return view('lap_surat_jalans.edit')
            ->with('lapSuratJalan', $lapSuratJalan);        
    }

    /**
     * Update the specified LapSuratJalan in storage.
     *
     * @param  int              $id
     * @param UpdateLapSuratJalanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLapSuratJalanRequest $request)
    {
        $lapSuratJalan = $this->lapSuratJalanRepository->findWithoutFail($id);

        if (empty($lapSuratJalan)) {
            Flash::error('Lap Surat Jalan not found');

            return redirect(route('lapSuratJalans.index'));
        }

        $lapSuratJalan = $this->lapSuratJalanRepository->update($request->all(), $id);

        Flash::success('Lap Surat Jalan updated successfully.');

        return redirect(route('lapSuratJalans.index'));
    }

    /**
     * Remove the specified LapSuratJalan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lapSuratJalan = $this->lapSuratJalanRepository->findWithoutFail($id);

        if (empty($lapSuratJalan)) {
            Flash::error('Lap Surat Jalan not found');

            return redirect(route('lapSuratJalans.index'));
        }

        $this->lapSuratJalanRepository->delete($id);

        Flash::success('Lap Surat Jalan deleted successfully.');

        return redirect(route('lapSuratJalans.index'));
    }

    /**
     * Store data LapSuratJalan from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $lapSuratJalan = $this->lapSuratJalanRepository->create($item->toArray());
            });
        });

        Flash::success('Lap Surat Jalan saved successfully.');

        return redirect(route('lapSuratJalans.index'));
    }
}
