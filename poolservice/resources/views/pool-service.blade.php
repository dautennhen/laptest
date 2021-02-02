@extends('layouts.template')

@section('content')

<div class="container register-pool-service">
    <div class="form-box">
        <form role="form" id="frmPoolSubscriber" action="{{route('pool-service-register')}}" method="post" class="f1">
        {{ csrf_field() }}
            <h3>Register the new Pool Service To Our App</h3>
            <p>Fill in the form to get instant access</p>
            </space>
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="12.5" data-number-of-steps="5" style="width: 12.5%;"></div>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-gears"></i></div>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-tasks"></i></div>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                </div>

                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-credit-card-alt"></i></div>
                </div>

                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-wpforms"></i></div>
                </div>
            </div>

            </space>

            <fieldset id="fzipcode">
                <div class="container" style="max-width:500px;max-hight:400px">
                    <div class="row">
                    <label class="control-label" for="fields">Choose your all zip code at here</label>
                        <div class="form-group" id="fields">                            
                            <select id="zipcode" name="zipcode[]" multiple="multiple" required>
                                @foreach($zipcodes as $zipcode)
                                    <option value="{{$zipcode->zipcode}}">{{$zipcode->zipcode}}</option>
                                @endforeach
                            </select>
                            <label for="zipcode" generated="true" class="error"></label>
                        </div>
                    </div>
                </div>
                
                <div class="f1-buttons">
                    <button type="button" class="btn btn-next-zipcode">Next</button>
                </div>
            </fieldset>

            <fieldset id="cbgroup">
                <h4 class="text-center">Choose all of the services that you offer.</h4>
                <div class="form-group">                        
                    <input type="checkbox" name="chk_service_type[]" value="weekly_learning" id="chk-type-weekly">
                    <label for="chk-type-weekly">Weekly leaning</label>
                </div>
                <div class="form-group">                        
                    <input type="checkbox" name="chk_service_type[]" value="pool_spa_repair" id="chk-type-poolspa">
                    <label for="chk-type-poolspa">Pool or spa repair</label>
                </div>
                <div class="form-group" >                        
                    <input type="checkbox" name="chk_service_type[]" value="deep_cleaning" id="chk-type-deepcleaning">
                    <label for="chk-type-deepcleaning" id="lblServiceType">Deep cleaning</label>
                </div>
                <div class="f1-buttons">
                    <button type="button" class="btn btn-previous">Back</button>
                    <button type="button" class="btn btn-next">Next</button>
                </div>
            </fieldset>
            
            <fieldset id="service">
                <h4 class="text-center">Weekly cleaning-<span id="weekly_money"></span></h4>
                <div class="form-group">                        
                    <input type="checkbox" name="chk_weekly_pool[]" value="pool" id="chk-weekly-pool" class="chk-service-weely">
                    <input type="hidden" name="price" id="hdf_price">
                    <label for="chk-weekly-pool">POOL</label>   
                    <div class="row"> 
                        <div class="col-md-4 centered">
                            <p id="error_weekly_pool">
                                <input name="rdo_weekly_pool" type="radio" value="salt" id="rdo-salwater" class="require-one"/> 
                                <label for="rdo-salwater">Salwater</label>
                                <input name="rdo_weekly_pool" type="radio" value="chlorine" id="rdo-chlorine" class="require-one"/> 
                                <label for="rdo-chlorine">chlorine</label>
                            </p>
                        </div>                    
                    </div>                     
                </div>
                
                <div class="form-group" >                        
                    <input type="checkbox" name="chk_weekly_pool[]" value="spa" id="chk-weekly-spa" class="chk-service-weely">
                    <label for="chk-weekly-spa" id=lblSpa>SPA</label>
                </div>
                <div class="form-group"> 
                    <label for="f1-text">Test and adjust chemicals, backwash the filter, empty the skimmer and pump baskets, brush walls and steps, and skim debirs from water surface.</label>
                </div>
                <div class="f1-buttons">
                    <button type="button" class="btn btn-previous">Back</button>
                    <button type="button" class="btn btn-next-weekly">Next</button>
                </div>
            </fieldset>

            <fieldset id="user_information">
                <h4 class="text-center">Your information</h4>
                <div class="form-group">
                    <input type="text" name="email" required placeholder="Email..." class="email form-control" id="email">
                </div>
                <div class="form-group">
                    <input type="password" required name="password" placeholder="Password..." class="password form-control" id="password">
                </div>
                <div class="form-group bottom"></div>
                <div class="form-group">
                    <input type="password" required name="repeat-password" placeholder="Repeat password..." 
                                        class="repeat-password form-control" id="repeat-password">
                </div>
                <div class="form-group">
                    <input type="text" name="company" required placeholder="Company name" class="company form-control" id="company">
                </div>
                <div class="form-group">
                    <input type="text" name="website" placeholder="Website (if any)" class="website form-control" id="website">
                </div>
                <div class="form-group">
                    <input type="text" name="fullname" required placeholder="First and last name" class="fullname form-control" id="fullname">
                </div>
                <div class="form-group">
                    <input type="text" name="street" placeholder="Address" class="street form-control" id="street">
                </div>
                <div class="form-group">
                    <input type="text" name="city" placeholder="City" class="city form-control" id="city">
                </div>
                <div class="row">
                    <div class="col-sm-7 form-group">
                        <select id="select-state" required name="state" class="form-control input-md">
                            <option value="">None</option>
                            <option>Arizona</option>
                            <option>Los Angeles</option>
                            <option>California</option>
                            <option>Carolina</option>
                            <option>New England</option>
                        </select>
                    </div>		
                    <div class="col-sm-5 form-group">
                        <input type="text" name="zip" maxlength="5" placeholder="zipcode" class="f1-state-number form-control" id="f1-zipcode">
                    </div>	
                </div>

                <div class="form-group">
                    <input type="text" name="phone" required placeholder="Telephone" class="f1-telephone form-control" id="f1-telephone">
                </div>

                <div class="f1-buttons">
                    <button type="button" class="btn btn-previous">Back</button>
                    <button type="button" class="btn btn-next-info">Next</button>
                </div>
            </fieldset>

            <fieldset id="card_informtion">
                <div><h4 class="text-center">Enter your credit card information. First 30 days are free. After that, your card will be billed once a month. <span id="billing_money"><span></h4></div>
                </space>
                <div class="row vdivide">
                    <div class="col-sm-6 text-left">
                        <div class="form-group">
                            <input type="text" required name="card_name" placeholder="Name on your card" class="f1-name-card form-control" id="f1-name-card">
                        </div>
                        <div class="form-group" id="error_token">
                            <input type="tel" required name="card_number" id="card_number" placeholder="Credit card number"
                            class="f1-cardnumber form-control" id="f1-cardnumber">
                            <input type='hidden' required id='hdf_stripeToken' name='stripeToken'/>
                        </div>
                        <div class="row">
                            <div class="col-sm-7 form-group">
                                <input type="tel" required name="expiration_date" placeholder="Expirate date" autocomplete="f1-expiration-date" placeholder="•• / ••"
                                class="f1-expiration-date form-control" id="f1-expiration-date">
                            </div>	
                            <div class="col-sm-5 form-group">
                                <input type="text" required name="ccv" placeholder="1234" maxlength="4" class="f1-ccv-number form-control" id="f1-ccv-number">
                            </div>	                        
                        </div>
                    </div>
                    <div class="col-sm-6 text-left left">
                        <div class="form-group">
                            <input type="hidden" name="chk_billing_address" value="false"/>
                            <input type="checkbox" name="chk_billing_address" id="chk_billing_address" value="true">
                            <label for="chk_billing_address">Same as service address</label>   
                        </div>
                        <div class="form-group">
                            <input type="text" required  name="billing_address" placeholder="Street address" 
                            class="f1-billing-street-address form-control" id="f1-billing-street-address">
                        </div>
                        <div class="form-group">
                            <input type="text" required  name="billing_city" placeholder="City" class="f1-billing-city form-control" id="f1-billing-city">
                        </div>
                        <div class="row">
                            <div class="col-sm-7 form-group">
                                <select id="billing_state" required  name="billing_state" class="form-control input-md">
                                    <option value="">None</option>
                                    <option>Arizona</option>
                                    <option>Los Angeles</option>
                                    <option>California</option>
                                    <option>Carolina</option>
                                    <option>New England</option>
                                </select>
                            </div>	
                            <div class="col-sm-5 form-group">
                                <input type="text" name="billing_zipcode" placeholder="Zipcode..." 
                                maxlength="5" class="f1-billing-zipcode form-control" id="f1-billing-zipcode">
                            </div>	                        
                        </div>
                    </div>
                </div>
                <div class="f1-buttons">
                    <button type="button" class="btn btn-previous">Back</button>
                    <button type="button" class="btn btn-next-billing">Next</button>
                </div>
            </fieldset>        

            <fieldset id="final_information">
                <h4 class="text-center">Finalize order</h4>
                <div class="row vdivide">
                    <div class="col-sm-4 text-left">
                        <div class="form-group">
                            <h4 class="text-left">Service information</h4>
                        </div>
                        <div class="form-group">
                            <h4 class="text-center">Account information</h4>
                        </div>
                        <div class="form-group">
                            <h4 class="text-center">Billing information</h4>                    
                        </div>
                    </div>
                    <div class="col-sm-8 text-left left">
                        <div class="form-group">
                            <h4 class="text-center">Weekly cleaning - <span id="sum_price"><span></h4>
                            <h4 class="text-center"><span id="sum_service"><span></h4>
                        </div>
                        <div class="form-group">
                            <h4 class="text-center">Email address:<span id="sum_email"><span></h4>
                            <h4 class="text-center">Password:<span id="sum_password"><span></h4>
                            <h4 class="text-center">First name:<span id="sum_fullname"><span></h4>
                            <h4 class="text-center">Address:<span id="sum_address"><span></h4>
                            <h4 class="text-center">City, ST zipcode: <span id="sum_city_zipcode"><span></h4>
                        </div>
                        <div class="row">
                            <h4 class="text-center">Billing image and information:<span id="sum_billing_info"><span></h4>                       
                            <h4 class="text-center">Billing address: <span id="sum_billing_address"><span></h4>
                        </div>
                    </div>
                </div>
                <div class="f1-buttons">
                    <button type="button" class="btn btn-previous">Back</button>
                    <button type="submit" class="btn btn-submit">Submit</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<div class="modal-wait" id="divModel"></div>

<div class="modal fade" id="notifyModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">        
                <form role="form">
                    {{ csrf_field() }}
                    <div class="row">
                        <label id="get_your_email"></label>  
                    </div>
                    <div class="form-group">
                        <button type="button" id="btnOkGotIt" class="btn btn-success">OK Got It</button>
                    </div>            
                </form>  
            </div>
        </div>
    </div>
</div>

@endsection

@section('lib')
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"rel="stylesheet" type="text/css" />    
        <link href="{{ asset('css/jquery.multiselect.css') }}"rel="stylesheet" type="text/css" />         
        <script src="http://parsleyjs.org/dist/parsley.js"></script>    
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script src="https://checkout.stripe.com/checkout.js"></script>     

        <script src="{{ asset('js/register/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/register/jquery.multiselect.js') }}"></script>
        <script src="{{ asset('js/register/register-pool-service.js') }}"></script>
@endsection

