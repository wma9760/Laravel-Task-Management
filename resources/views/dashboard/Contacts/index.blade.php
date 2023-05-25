@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-md-4">
                                <div class="mt-3 mt-md-0">
                                    
                                    <a href="{{route('contact.create')}}" type="button" class="btn btn-success waves-effect waves-light"
                                        ><i
                                            class="mdi mdi-plus-circle me-1"></i> Add contact</a>
                                </div>
                            </div><!-- end col-->
                            <div class="col-md-8">
                                <form class="d-flex flex-wrap align-items-center justify-content-sm-end">
                                   
                                    <label for="inputPassword2" class="visually-hidden">Search</label>
                                    <div>
                                        <input type="search" class="form-control my-1 my-md-0" id="inputPassword2"
                                            placeholder="Search..." id="searchInput">
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row -->
        <div class="row" id="contactList">

            @foreach ($contacts as $contact)
                <div class="col-xl-4">
                    <div class="card">
                        <div class="text-center card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="{{route('contact.destroy',$contact->id)}}" class="dropdown-item">Remove</a>
                                   
                                </div>
                            </div>
                            <div>
                                <img src="{{ asset('assets/images/users/' . $contact->image) }}"
                                    class="rounded-circle avatar-xl img-thumbnail mb-2" alt="profile-image">

                                <p class="text-muted font-13 mb-3">
                                    {{ $contact->profile }} </p>

                                <div class="text-start">
                                    <p class="text-muted font-13"><strong>Full Name :</strong> <span
                                            class="ms-2">{{ $contact->name }}o</span></p>

                                    <p class="text-muted font-13"><strong>Mobile :</strong><span
                                            class="ms-2">{{ $contact->phone }}</span></p>

                                    <p class="text-muted font-13"><strong>Email :</strong> <span
                                            class="ms-2">{{ $contact->email }}</span></p>

                                    <p class="text-muted font-13"><strong>Location :</strong> <span
                                            class="ms-2">{{ $contact->location }}</span></p>
                                </div>

                                <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light">Send
                                    Message</button>
                            </div>
                        </div>
                    </div>


                </div>
            @endforeach
            <!-- end col -->

        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var searchTerm = $(this).val();
                $.ajax({
                    url: '/contacts/search',
                    type: 'GET',
                    data: {
                        searchTerm: searchTerm
                    },
                    success: function(data) {
                        $('#contactList').html(data);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
        </script>
       
      
        
        
        
        
        
@endsection
