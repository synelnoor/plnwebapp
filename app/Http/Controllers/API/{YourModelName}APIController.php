<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Create{YourModelName}APIRequest;
use App\Http\Requests\API\Update{YourModelName}APIRequest;
use App\Models\{YourModelName};
use App\Repositories\{YourModelName}Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class {YourModelName}Controller
 * @package App\Http\Controllers\API
 */

class {YourModelName}APIController extends AppBaseController
{
    /** @var  {YourModelName}Repository */
    private ${YourModelName}Repository;

    public function __construct({YourModelName}Repository ${YourModelName}Repo)
    {
        $this->middleware('auth:api');
        $this->{YourModelName}Repository = ${YourModelName}Repo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/{YourModelName}s",
     *      summary="Get a listing of the {YourModelName}s.",
     *      tags={"{YourModelName}"},
     *      description="Get all {YourModelName}s",
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
     *                  @SWG\Items(ref="#/definitions/{YourModelName}")
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
        $this->{YourModelName}Repository->pushCriteria(new RequestCriteria($request));
        $this->{YourModelName}Repository->pushCriteria(new LimitOffsetCriteria($request));
        ${YourModelName}s = $this->{YourModelName}Repository->all();

        return $this->sendResponse(${YourModelName}s->toArray(), '{ Your Model Name}S retrieved successfully');
    }

    /**
     * @param Create{YourModelName}APIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/{YourModelName}s",
     *      summary="Store a newly created {YourModelName} in storage",
     *      tags={"{YourModelName}"},
     *      description="Store {YourModelName}",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="{YourModelName} that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/{YourModelName}")
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
     *                  ref="#/definitions/{YourModelName}"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Create{YourModelName}APIRequest $request)
    {
        $input = $request->all();

        ${YourModelName}s = $this->{YourModelName}Repository->create($input);

        return $this->sendResponse(${YourModelName}s->toArray(), '{ Your Model Name} saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/{YourModelName}s/{id}",
     *      summary="Display the specified {YourModelName}",
     *      tags={"{YourModelName}"},
     *      description="Get {YourModelName}",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of {YourModelName}",
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
     *                  ref="#/definitions/{YourModelName}"
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
        /** @var {YourModelName} ${YourModelName} */
        ${YourModelName} = $this->{YourModelName}Repository->findWithoutFail($id);

        if (empty(${YourModelName})) {
            return $this->sendError('{ Your Model Name} not found');
        }

        return $this->sendResponse(${YourModelName}->toArray(), '{ Your Model Name} retrieved successfully');
    }

    /**
     * @param int $id
     * @param Update{YourModelName}APIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/{YourModelName}s/{id}",
     *      summary="Update the specified {YourModelName} in storage",
     *      tags={"{YourModelName}"},
     *      description="Update {YourModelName}",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of {YourModelName}",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="{YourModelName} that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/{YourModelName}")
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
     *                  ref="#/definitions/{YourModelName}"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Update{YourModelName}APIRequest $request)
    {
        $input = $request->all();

        /** @var {YourModelName} ${YourModelName} */
        ${YourModelName} = $this->{YourModelName}Repository->findWithoutFail($id);

        if (empty(${YourModelName})) {
            return $this->sendError('{ Your Model Name} not found');
        }

        ${YourModelName} = $this->{YourModelName}Repository->update($input, $id);

        return $this->sendResponse(${YourModelName}->toArray(), '{YourModelName} updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/{YourModelName}s/{id}",
     *      summary="Remove the specified {YourModelName} from storage",
     *      tags={"{YourModelName}"},
     *      description="Delete {YourModelName}",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of {YourModelName}",
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
        /** @var {YourModelName} ${YourModelName} */
        ${YourModelName} = $this->{YourModelName}Repository->findWithoutFail($id);

        if (empty(${YourModelName})) {
            return $this->sendError('{ Your Model Name} not found');
        }

        ${YourModelName}->delete();

        return $this->sendResponse($id, '{ Your Model Name} deleted successfully');
    }
}
