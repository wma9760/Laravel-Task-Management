@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">
            
            {{-- <div class="col-sm-8">
                <div class="float-end">
                    <form class="row g-2 align-items-center mb-2 mb-sm-0">
                        <div class="col-auto">
                            <div class="d-flex">
                                <label class="d-flex align-items-center">Phase
                                    <select class="form-select form-select-sm d-inline-block ms-2">
                                        <option>All Projects(6)</option>
                                        <option>Complated</option>
                                        <option>Progress</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex">
                                <label class="d-flex align-items-center">Sort
                                    <select class="form-select form-select-sm d-inline-block ms-2">
                                        <option>Date</option>
                                        <option>Name</option>
                                        <option>End date</option>
                                        <option>Start Date</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- end col--> --}}
        </div>
        <!-- end row -->




        <div class="row">
            @foreach ($projects as $project)
                <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body project-box">
                                <a href="{{route('project.show',$project->id)}}">View Detail</a>

                                <div class="badge bg-purple float-end">{{ $project->status }}</div>
                                <h4 class="mt-0"><a href="#" class="text-dark">{{ $project->name }}</a></h4>
                                <p class="text-muted font-13"> {{ $project->description }}</p>
    
                                {{-- <ul class="list-inline">
                            
                            <li class="list-inline-item">
                                <h4 class="mb-0">875</h4>
                                <p class="text-muted">Comments</p>
                            </li>
                        </ul> --}}
                                @php
                                    $tasks = $project->tasks;
                                    $totalTasks = count($tasks);
                                    if ($totalTasks !== 0) {
                                        $completedTasks = $tasks->where('status', 'complete')->count();
                                        $pendingTasks = $totalTasks - $completedTasks;
                                    
                                        $progress = ($completedTasks / $totalTasks) * 100;
                                        $progress = round($progress, 2);
                                    } else {
                                        $progress = 0;
                                    }
                                @endphp
    
                                <h5>Progress <span class="text-purple float-end">{{ $progress . '%' }}</span></h5>
                                <div class="progress progress-bar-alt-purple progress-sm">
                                    <div class="progress-bar bg-purple progress-animated wow animated animated"
                                        role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{ $progress }}%;">
                                    </div><!-- /.progress-bar .progress-bar-danger -->
                                </div><!-- /.progress .no-rounded -->
    
                            </div>
                        </div>
                </div><!-- end col-->
            @endforeach
        </div>
        <!-- end row -->

    </div>
@endsection
