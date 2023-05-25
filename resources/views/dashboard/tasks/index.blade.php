@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="text-center pt-2">
        <a class="btn btn-primary waves-effect waves-light" href="{{route('task.create')}}">
            <i class="mdi mdi-plus"></i> Add New
        </a>
    </div>
    <div class="row mt-2">

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body taskboard-box">
                    
                    <h4 class="header-title mt-0 mb-3 text-primary">Complete</h4>

                    <ul class="sortable-list list-unstyled taskList ui-sortable" id="upcoming">
                       @foreach ($tasks as $task )
                           @if ($task->status=="complete")
                           <li class="ui-sortable-handle">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <!-- item-->
                                    <a href="{{route('task.destroy',$task->id)}}" class="dropdown-item">Delete</a>
                                    <!-- item-->
                                    <a href="{{route('task.update',$task->id)}}" class="dropdown-item">Edit</a>
                                    <!-- item-->
                                </div>
                            </div>
                            <div class="kanban-box">
                                <div class="checkbox-wrapper float-start">
                                    <div class="form-check form-check-success "> 
                                         <input class="form-check-input" type="checkbox" id="singleCheckbox2" value="option2" aria-label="Single checkbox Two">
                                        <label></label>
                                    </div>
                                </div>

                                <div class="kanban-detail">
                                    @if ($task->priority==2)
                                    <span class="badge bg-danger float-end">Urgent</span>

                                        @elseif($task->priority==1)
                                        <span class="badge bg-warning float-end">High</span>

                                    @endif
                                    <h5 class="mt-0"><a href="task-details.html" class="text-dark">Task:{{$task->name}}</a> </h5>
                                    <p>Project:{{$task->Project->name}}</p>
                                </div>
                            </div>
                        </li>
                           @endif
                       @endforeach

                    </ul>

                    
                </div>
            </div>

        </div><!-- end col -->


        <div class="col-xl-6">
            <div class="card">
                <div class="card-body taskboard-box">
                    
                    <h4 class="header-title mt-0 mb-3 text-warning">In Progress</h4>

                    <ul class="sortable-list list-unstyled taskList ui-sortable" id="inprogress">
                        @foreach ($tasks as $task )
                           @if ($task->status=="pending")
                           <li class="ui-sortable-handle">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="{{route('task.TaskCompleted',$task->id)}}" class="dropdown-item">Completed</a>
                                    <!-- item-->
                                    <a href="{{route('task.destroy',$task->id)}}" class="dropdown-item">Delete</a>
                                    <!-- item-->
                                    <a href="{{route('task.update',$task->id)}}" class="dropdown-item">Edit</a>
                                    <!-- item-->
                                </div>
                            </div>
                            <div class="kanban-box">
                                <div class="checkbox-wrapper float-start">
                                    <div class="form-check form-check-success ">
                                        <input class="form-check-input" type="checkbox" id="singleCheckbox2" value="option2" aria-label="Single checkbox Two">
                                        <label></label>
                                    </div>
                                </div>

                                <div class="kanban-detail">
                                    @if ($task->priority==2)
                                    <span class="badge bg-danger float-end">Urgent</span>

                                        @elseif($task->priority==1)
                                        <span class="badge bg-warning float-end">High</span>

                                    @endif
                                    <h5 class="mt-0"><a href="task-details.html" class="text-dark">Task:{{$task->name}}</a> </h5>
                                    <p>Project:{{$task->project->name}}</p>
                                </div>
                            </div>
                        </li>
                           @endif
                       @endforeach

                    </ul>

                </div>
            </div>
        </div><!-- end col -->


        

    </div><!-- end row -->


</div>

{{-- <!-- Modal -->
<div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Add New</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="mb-3">
                        <label class="form-label" for="name">Task Name</label>
                        <input type="text" class="form-control" id="name" placeholder="">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="assign">Assign to</label>
                                <input type="text" class="form-control" id="assign" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="priority">Priority</label>
                                <input type="text" class="form-control" id="priority" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="Sdate">Start Date</label>
                                <input type="text" class="form-control" id="Sdate" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="Ddate">Due Date</label>
                                <input type="text" class="form-control" id="Ddate" placeholder="">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success waves-effect waves-light me-1">Save</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light"
                        data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> --}}
@endsection
