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

                        <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">name</label>
                                <input value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror"
                                    type="text" id="name" placeholder="Enter project name" required=""
                                    name="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                    rows="5">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" id="start_date" value="{{ old('start_date') }}" name="start_date"
                                    class="form-control @error('start_date') is-invalid @enderror"
                                    placeholder="Select start_date">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Due Date</label>
                                <input type="date" id="end_date" value="{{ old('end_date') }}" name="end_date"
                                    class="form-control @error('end_date') is-invalid @enderror"
                                    placeholder="Select end_date">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                           
                            <div class="form-group mb-3">
                                <label for="project_id">Project:</label>
                                <select name="project_id" id="project_id" class="form-control" >
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="priority">Priority:</label>
                                <select name="priority" id="priority" required class="form-control">
                                    <option value="">Select Priority</option>
                                    <option value="0" {{ old('priority') == '0' ? 'selected' : '' }}>Normal</option>
                                    <option value="1" {{ old('priority') == '1' ? 'selected' : '' }}>High</option>
                                    <option value="2" {{ old('priority') == '2' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>
                            
                            <div class="mb-3 text-center d-grid">
                                <button class="btn btn-primary" type="submit"> Create Project </button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->


                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection
