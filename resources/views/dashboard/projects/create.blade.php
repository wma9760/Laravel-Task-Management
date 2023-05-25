@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">

                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <h4 class="text-uppercase mt-0">Create Project</h4>
                        </div>

                        <form action="{{ route('project.create') }}" method="POST" enctype="multipart/form-data">
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
                            
                            <div class="mb-3">
                                <label class="form-label">Tags</label>
                                <input type="text" class="selectize-close-btn" name="tags"
                                value="{{ old('tags') }}">
                                <small class="form-text text-muted">Note : Type & Press Enter or Tab to add new tag</small>

                                @if ($errors->has('tags'))
                                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                                @endif

                            </div>
                            
                            <div class="mb-3">
                                <label for="files" class="form-label">Project files</label>
                                <input type="file" value="{{ old('files') }}" id="files" name="files[]" multiple
                                    class="form-control @error('files') is-invalid @enderror" placeholder="Select files">
                                @error('files')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="team_name" class="form-label">Team Name</label>
                                <input value="{{ old('team_name') }}" class="form-control @error('team_name') is-invalid @enderror"
                                    type="text" id="team_name" placeholder="Enter project's team name" required=""
                                    name="team_name">
                                @error('team_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="team_members">Team Members:</label>
                                <select name="team_members[]" id="team_members" class="form-control" multiple>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
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
