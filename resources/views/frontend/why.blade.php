@extends('frontend.layouts.main')

@section('main-container')
    <style>
        .choose-us-title {
            color: white;
            transition: color 0.3s ease;
        }

        .choose-us-title:hover {
            color: green;
        }
        .choose-title{
            color: green;
            transition: color 0.3s ease;
        }

        .choose-title:hover {
            color: yellowgreen;
        }
        
    </style>
    <section class="why_section layout_padding" style="background-color: #d4fcd4;">
        <div class="container">
            <div class="heading_container heading_center mb-4 mt-4" data-aos="fade-down" data-aos-duration="1000">
                <h2><span  class="choose-us-title">Why Choose Us</span></h2>
            </div>
            <hr>
            <!-- <div class="table-responsive mt-5" data-aos="fade-up" data-aos-duration="1400">
                    <table class="table table-bordered table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($whySections as $index => $section)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $section->title }}</td>
                                    <td>{{ $section->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> -->
            <div class="row">
                @foreach($whySections as $section)
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="1200">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-img-top text-center p-3">
                                <img src="{{ asset($section->image) }}" class="img-fluid rounded" alt="{{ $section->title }}"
                                    style="max-height: 200px; object-fit: contain;">
                            </div>
                            <div class="card-body">
                                <h5 class="choose-title card-title">{{ $section->title }}</h5>
                                <hr>
                                <p class="card-text">{{ $section->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection