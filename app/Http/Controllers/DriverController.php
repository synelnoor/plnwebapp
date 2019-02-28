<?php

namespace App\Http\Controllers;

use App\DataTables\DriverDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Repositories\DriverRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class DriverController extends AppBaseController
{
    /** @var  DriverRepository */
    private $driverRepository;

    public function __construct(DriverRepository $driverRepo)
    {
        $this->middleware('auth');
        $this->driverRepository = $driverRepo;
    }

    /**
     * Display a listing of the Driver.
     *
     * @param DriverDataTable $driverDataTable
     * @return Response
     */
    public function index(DriverDataTable $driverDataTable)
    {
        return $driverDataTable->render('drivers.index');
    }

    /**
     * Show the form for creating a new Driver.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('drivers.create');
        return view('drivers.create');
    }

    /**
     * Store a newly created Driver in storage.
     *
     * @param CreateDriverRequest $request
     *
     * @return Response
     */
    public function store(CreateDriverRequest $request)
    {
        $input = $request->all();

        $driver = $this->driverRepository->create($input);

        Flash::success('Driver saved successfully.');

        return redirect(route('drivers.index'));
    }

    /**
     * Display the specified Driver.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $driver = $this->driverRepository->findWithoutFail($id);

        if (empty($driver)) {
            Flash::error('Driver not found');

            return redirect(route('drivers.index'));
        }

        return view('drivers.show')->with('driver', $driver);
    }

    /**
     * Show the form for editing the specified Driver.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $driver = $this->driverRepository->findWithoutFail($id);

        if (empty($driver)) {
            Flash::error('Driver not found');

            return redirect(route('drivers.index'));
        }

        // edited by dandisy
        // return view('drivers.edit')->with('driver', $driver);
        return view('drivers.edit')
            ->with('driver', $driver);        
    }

    /**
     * Update the specified Driver in storage.
     *
     * @param  int              $id
     * @param UpdateDriverRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDriverRequest $request)
    {
        $driver = $this->driverRepository->findWithoutFail($id);

        if (empty($driver)) {
            Flash::error('Driver not found');

            return redirect(route('drivers.index'));
        }

        $driver = $this->driverRepository->update($request->all(), $id);

        Flash::success('Driver updated successfully.');

        return redirect(route('drivers.index'));
    }

    /**
     * Remove the specified Driver from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $driver = $this->driverRepository->findWithoutFail($id);

        if (empty($driver)) {
            Flash::error('Driver not found');

            return redirect(route('drivers.index'));
        }

        $this->driverRepository->delete($id);

        Flash::success('Driver deleted successfully.');

        return redirect(route('drivers.index'));
    }

    /**
     * Store data Driver from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $driver = $this->driverRepository->create($item->toArray());
            });
        });

        Flash::success('Driver saved successfully.');

        return redirect(route('drivers.index'));
    }
}
