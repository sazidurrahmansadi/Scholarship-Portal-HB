<section class="job-style-two pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <h2>Scholarships You May Be Interested In</h2>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p> --}}
        </div>
        @forelse ($scholarships as $scholarship)
        <div class="row">
            <div class="col-lg-12">
                <div class="job-card-two">
                    <div class="row align-items-center">
                        <div class="col-md-1">
                            <div class="company-logo">
                                <a href="#">
                                    <img src="{{asset('assets/img/company-logo/1.png')}}" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="job-info">
                                <h3>
                                    <a href="{{route('available_scholarships_details',$scholarship->id)}}">{{$scholarship->scholarship_title}}</a>
                                </h3>
                                <ul>
                                    {{-- <li>
                                        <i class='bx bx-briefcase'></i>
                                        Grant + Other benefits
                                    </li> --}}
                                    {{-- <li> --}}
                                    {{-- <i class='bx bx-briefcase'></i> --}}
                                    {{-- $35000-$38000 --}}
                                    {{-- </li> --}}
                                    <li>
                                        <i class='bx bx-location-plus'></i>
                                        Bangladesh
                                    </li>
                                    <li>
                                        <i class='bx bx-stopwatch'></i>
                                        {{ (new DateTime($scholarship->deadline))->format('d-M-Y') }}
                                    </li>
                                </ul>
                                <span>Level</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="theme-btn text-end">
                                <a href="{{route('available_scholarships_details',$scholarship->id)}}" class="default-btn">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
        @empty
        <h3 class="text-center text-danger">Sorry! No scholarships available for this time. 
        @endforelse
    </div>
</section>
