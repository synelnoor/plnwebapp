<?php

namespace App\Http\Controllers;

use App\DataTables\RfidDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRfidRequest;
use App\Http\Requests\UpdateRfidRequest;
use App\Repositories\RfidRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class RfidController extends AppBaseController
{
    /** @var  RfidRepository */
    private $rfidRepository;

    public function __construct(RfidRepository $rfidRepo)
    {
        $this->middleware('auth');
        $this->rfidRepository = $rfidRepo;
    }

    /**
     * Display a listing of the Rfid.
     *
     * @param RfidDataTable $rfidDataTable
     * @return Response
     */
    public function index(RfidDataTable $rfidDataTable)
    {
        return $rfidDataTable->render('rfids.index');
    }

    /**
     * Show the form for creating a new Rfid.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('rfids.create');
        return view('rfids.create');
    }

    /**
     * Store a newly created Rfid in storage.
     *
     * @param CreateRfidRequest $request
     *
     * @return Response
     */
    public function store(CreateRfidRequest $request)
    {
        $input = $request->all();

        $rfid = $this->rfidRepository->create($input);

        Flash::success('Rfid saved successfully.');

        return redirect(route('rfids.index'));
    }

    /**
     * Display the specified Rfid.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rfid = $this->rfidRepository->findWithoutFail($id);

        if (empty($rfid)) {
            Flash::error('Rfid not found');

            return redirect(route('rfids.index'));
        }

        return view('rfids.show')->with('rfid', $rfid);
    }

    /**
     * Show the form for editing the specified Rfid.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $rfid = $this->rfidRepository->findWithoutFail($id);

        if (empty($rfid)) {
            Flash::error('Rfid not found');

            return redirect(route('rfids.index'));
        }

        // edited by dandisy
        // return view('rfids.edit')->with('rfid', $rfid);
        return view('rfids.edit')
            ->with('rfid', $rfid);        
    }

    /**
     * Update the specified Rfid in storage.
     *
     * @param  int              $id
     * @param UpdateRfidRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRfidRequest $request)
    {
        $rfid = $this->rfidRepository->findWithoutFail($id);

        if (empty($rfid)) {
            Flash::error('Rfid not found');

            return redirect(route('rfids.index'));
        }

        $rfid = $this->rfidRepository->update($request->all(), $id);

        Flash::success('Rfid updated successfully.');

        return redirect(route('rfids.index'));
    }

    /**
     * Remove the specified Rfid from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rfid = $this->rfidRepository->findWithoutFail($id);

        if (empty($rfid)) {
            Flash::error('Rfid not found');

            return redirect(route('rfids.index'));
        }

        $this->rfidRepository->delete($id);

        Flash::success('Rfid deleted successfully.');

        return redirect(route('rfids.index'));
    }

    /**
     * Store data Rfid from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $rfid = $this->rfidRepository->create($item->toArray());
            });
        });

        Flash::success('Rfid saved successfully.');

        return redirect(route('rfids.index'));
    }
}
