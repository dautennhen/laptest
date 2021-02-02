@extends('layouts.template')


@section('baner')
<div class="header-top baner">
    <div class="col title">
        <div class="text-center">
            <h1 class="space-title baner-title">THIS IS POOL SERVICE</h1>
            <h4 class="space-title baner-description">YOUR ONE STOP FOR ALL THINGS POOLS</h4>
            <div class="space-title text-center">
                    <button type="button" class="btn btn-primary">CREATE ACCOUNT</button>
                    <space />
                    <button type="button" class="btn btn-default">LEARN MORE</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="panel panel-default panel-service panel-transparent">
    <div class="container">
        <div class="row">
            <div class="col title">
                <div class="text-center">
                    <p class="panel-service-title">WHAT WE DO</p>
                    <p class="panel-service-description">WE SERVICE THE INDUSTRY THAT SERVICES POOLS</p>
                </div>
            </div>
        </div>
        <div class="row row-eq-height">
            <div class="col-xs-12 col-lg-4 col-md-4  col-sm-6 space-our item">
                <div class="col">
                    <div class="panel">
                        <div class="text-center">
                            <figure><img class="img-circle" src="images/weekly-service.png" alt="weekly-service"></figure>
                            <h2 class="space-title"><span class="text-color-deep"><span class="text-color-deep">Weekly</span> <span class="text-color-water">Service</span></span></h2>
                        </div>
                        <div class="text-center">
                            <p class="text">Sign up for weekly service today!</p>
                        </div>
                        <div class="text-center">
                            <p class="text">Whether salt water or chlorine, we can help you find an technician to regularly clean and maintain your pool.</p>                            
                            
                        </div>
                        <div class="text-center">
                                <a href="pool-owner-register" type="button" class="btn btn-default">GET SERVICE</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-4 col-md-4  col-sm-6 space-our item">
                <div class="col">
                    <div class="panel">
                        <div class="text-center">
                            <figure><img class="img-circle" src="images/pool-repair.png" alt="weekly-service"></figure>
                            <h2 class="space-title"><span class="text-color-deep"><span class="text-color-deep">Pool</span> <span class="text-color-water">Repair</span></span></h2>
                        </div>
                        <div class="text-center">
                            <p class="text">Got a broken pool hot tub?</p>
                        </div>
                        <div class="text-center">
                            <p class="text">We can help you find an experienced technician to assess repair needed and advise on how best to proceed.</p>
                        </div>
                        <div class="text-center">
                                <a href="pool-owner-register" type="button" class="btn btn-default">GET SERVICE</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-4 col-md-4  col-sm-6 space-our item">
                <div class="col">
                    <div class="panel">
                        <div class="text-center">
                            <figure><img class="img-circle" src="images/deep-cleaning.png" alt="weekly-service"></figure>
                            <h2 class="space-title"><span class="text-color-deep"><span class="text-color-deep">Deep</span> <span class="text-color-water">Cleaning</span></span></h2>
                        </div>
                        <div class="text-center">
                            <p class="text">Restore your pool' original beauty.</p>
                        </div>
                        <div class="text-center">
                            <p class="text">We offer one time service for those times when all your pool really needs is a good, deepscrub.</p>
                        </div>
                        <div class="text-center">
                                <a href="{{route('pool-owner-register')}}" type="button" class="btn btn-default">GET SERVICE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


            