<?php

namespace App\Http\Controllers\HelpControllers;

use App\Interfaces\ResourceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ResourceController extends Controller implements ResourceInterface
{
    /*
     * Var: the classname of the resource.
     *
     * @string
     */
    protected $class = '';

    /*
     * Var: the attributes that can be updated.
     *
     * @array
     */
    protected $updatable = [];

    /*
     * Var: Get entities with their relationships.
     *
     * @array
     */
    protected $relations = [];

    /*
     * Var: the attributes that can be stored.
     *
     * @array
     */
    protected $storable = [];

    /*
     * Var: if the resource can be created if doesnt exist for update.
     *
     * @bool
     */
    protected $updateOrCreate = false;

    /*
     * Var: the fields for update or create method.
     *
     * @array
     */
    protected $updateOrCreateFields = ['user_id'];

    /*
     * Var: the method for retrieving the resource from the user.
     *
     * @string
     */
    protected $userMethod;

    /*
     * Var: if the resource should paginate (0 if pagination not needed).
     *
     * @integer
     */
    protected $pagination = 0;

    /*
     * Var: the order of the displaying resources.
     *
     * @string
     */
    protected $order = 'asc';

    /*
     * Var: the name of the field that will be ordered.
     *
     * @string
     */
    protected $orderBy = 'created_at';

    /*
     * Var: the name of the policies for methods (empty if no policies needed).
     *
     * @array
     */
    protected $policies = [];

    /*
     * Var: the resource model.
     *
     * @bool
     */
    private $model;

    /**
     * Create a new Resource Controller instance.
     *
     * @return void
     * @throws \Exception
     */
    public function __construct()
    {
        if (empty($this->class)) throw new \Exception("The resource controller should have a valid resource's class name.", 500);
        $this->model = new $this->class();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
        $this->authorizeRequest('index', $this->model);
        if (!empty($this->userMethod)) return auth()->user()[$this->userMethod]()->first();
        $resources = $this->model->orderBy($this->orderBy, $this->order)->with($this->relations);
        return $this->pagination > 0 ? $resources->paginate($this->pagination) : $resources->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // TODO: return view with form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $this->authorizeRequest('store', $this->model);
        $request['user_id'] = auth()->user()->id;
        $storable = empty($this->storable) ? $request->all() : $request->only($this->storable);
        if ($this->updateOrCreate) {
            $updateOrCreateArray = [];
            foreach ($this->updateOrCreateFields as $field) {
                $updateOrCreateArray[$field] = $request[$field];
            }
            $resource = $this->model->updateOrCreate($updateOrCreateArray, $storable);
        } else $resource = $this->model->create($storable);
        return response()->json($resource, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     * @throws \Exception
     */
    public function show($id)
    {
        $resource = $this->model->findOrFail($id);
        $this->authorizeRequest('show', $resource);
        return $resource;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // TODO: return view with form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int $id
     * @return Response
     *
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $request['user_id'] = auth()->user()->id;
        if (!$this->model->find($id) && $this->updateOrCreate) return $this->store($request);
        $resource = $this->model->findOrFail($id);
        $this->authorizeRequest('update', $resource);
        $resource->update(empty($this->updatable) ? $request->all() : $request->only($this->updatable));
        return response()->json($resource, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $resource = $this->model->findOrFail($id);
        $this->authorizeRequest('delete', $resource);
        $resource->delete();
        return response()->json(['message' => 'The ' . $this->getClassName() . ' has been deleted successfully.'], 200);
    }

    /**
     * Check if the action is authorized.
     *
     * @param  string $method
     * @param mixed $resource
     * @return void
     *
     * @throws \Exception
     */
    protected function authorizeRequest($method, $resource)
    {
        if (key_exists($method, $this->policies)) $this->authorize($this->policies[$method], $resource);
    }

    /**
     * Get the resource class name.
     *
     * @return string
     *
     * @throws \Exception
     */
    private function getClassName()
    {
        return (new \ReflectionClass($this->model))->getShortName();
    }
}
