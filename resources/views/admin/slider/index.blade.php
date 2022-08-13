@extends('admin.admin_master')
@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                
                <a href="{{ route('add.slider') }}"> <button class="btn btn-info mb-2">Add Slider</button> </a>
                  
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header"> All Sliders </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL </th>
                                    <th scope="col" width="15%">Slider Title</th>
                                    <th scope="col" width="25%">Description</th>
                                    <th scope="col" width="15%">Image</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1) 
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <th scope="row"> {{ $i ++ }} </th>
                                        <td> {{ $slider->title }} </td>
                                        <td> {{ $slider->description }} </td>
                                        <td> <img src="{{ asset($slider->image) }}" alt=""
                                                style="height: 40px; width:70px;"> </td>

                                        <td>
                                            <a href="{{ url('slider/edit/' . $slider->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('slider/delete/' . $slider->id) }}" class="btn btn-danger"
                                                onclick="return confirm('sure?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Add slider </div>
                        <div class="card-body">
                            <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group pt-3">
                                    <label for="exampleInputEmail1">slider Name</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    @error('slider_name')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group pt-3">
                                    <label for="exampleInputEmail1">slider Image</label>
                                    <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    @error('slider_image')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Add slider</button>
                            </form>

                        </div>

                    </div>
                </div> --}}
            </div>
        </div>

        <!-- Trash Part -->



        <!-- End Trush -->
    </div>
@endsection
