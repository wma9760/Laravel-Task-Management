@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-8">

                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <h4 class="text-uppercase mt-0">Create Task</h4>
                        </div>

                        <form action="{{ route('task.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Task Name</label>
                                <input value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror"
                                    type="text" id="name" placeholder="Enter project name" required=""
                                    name="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="assign">Project</label>
                                        <select name="project" id="project" class="form-control @error('project') is-invalid @enderror">
                                            <option selected disabled>Select Project</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}" {{old('project') == $project->id ? 'selected' : ''}} >{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('project')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="priority">Priority</label>
                                        <select name="priority" id="" class="form-control @error('priority') is-invalid @enderror">
                                            <option value="0" {{ old('priority') == '0' ? 'selected' : '' }} selected>Normal</option>
                                            <option value="1"  {{ old('priority') == '1' ? 'selected' : '' }}>High</option>
                                            <option value="2"  {{ old('priority') == '2' ? 'selected' : '' }}>Urgent</option>
                                        </select>
                                        @error('priority')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="Sdate">Start Date</label>
                                        <input type="date" value="{{old('start_date')}}" class="form-control @error('start_date') is-invalid @enderror" id="Sdate" placeholder="" name="start_date">
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="Ddate">Due Date</label>
                                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="Ddate" placeholder="" name="due_date" value="{{old('due_date')}}">
                                        @error('due_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light me-1">Save</button>
                            {{-- < a-bs-dismiss="modal">Cancel</button> --}}
                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->


                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <script src></script>
@endsection
