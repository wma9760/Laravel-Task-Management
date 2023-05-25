@extends('layouts.app')
@section('content')
<div class="container-fluid">
                        
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body task-detail">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        
                    </div>
                    

                    <h4>{{$project->name}}</h4>

                    <p class="text-muted">
                           {{$project->description}}</p>

                    

                    <div class="row task-dates mb-0 mt-2">
                        <div class="col-lg-6">
                            <h5 class="font-600 m-b-5">Start Date</h5>
                            <p> {{$project->start_date}}</p>
                        </div>

                        <div class="col-lg-6">
                            <h5 class="font-600 m-b-5">Due Date</h5>
                            <p>{{$project->end_date}}</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    {{-- <div class="task-tags mt-2">
                        <h5>Tags</h5>
                        <input type="text" class="selectize-close-btn selectized" value="Amsterdam,Washington,Sydney" data-role="tagsinput" placeholder="add tags" tabindex="-1" style="display: none;"><div class="selectize-control selectize-close-btn multi plugin-remove_button"><div class="selectize-input items not-full has-options has-items"><div data-value="Amsterdam">"Amsterdam"<a href="javascript:void(0)" class="remove" tabindex="-1" title="Remove">×</a></div><div data-value="Washington">"Washington"<a href="javascript:void(0)" class="remove" tabindex="-1" title="Remove">×</a></div><div data-value="Sydney">"Sydney"<a href="javascript:void(0)" class="remove" tabindex="-1" title="Remove">×</a></div><input type="text" autocomplete="off" tabindex="" style="width: 4px;"></div><div class="selectize-dropdown multi selectize-close-btn plugin-remove_button" style="display: none; width: 651.328px; top: 38px; left: 0px;"><div class="selectize-dropdown-content"></div></div></div>
                    </div> --}}

                    <div class="assign-team mt-3">
                        <h5>Assign to</h5>
                        <div>
                            @foreach ($project->teams as $team) 
                                @foreach ($team->members as $member)
                                    <a href="#"> <img class="rounded-circle avatar-sm" alt="64x64" src="{{asset('assets/images/users/' . $member->user->image) }}"> </a>

                            @endforeach
                            @endforeach
                          </div>
                    </div>

                    

                </div>
            </div>
            
        </div><!-- end col -->

      
    </div>
    <!-- end row -->        
    
</div>
@endsection
