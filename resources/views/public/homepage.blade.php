@extends("public.layout")
@section("content")
<div class="container padding-bottom-50 margin-top-50">
    <h3 class="white-text light center-align">
        Welcome
    </h3>
    <div class="row center-align padding-top-40 margin-top-20">
        <a href="{{route('how')}}" class="btn blue white-text light">
            How it works
        </a>
    </div>
    <div class="row">
        <form class="col s12" method="post" action="{{route('search')}}">
        	{{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12 m3">
                	@if(Session::has('source_location'))
                    <input autocomplete='off' id="source_location" value="{{Session::get('source_location')}}" name="source_location" type="text" class="white-text validate location margin-none" placeholder="Enter Pickup Location"/>
                    @else
                    <input autocomplete='off' id="source_location" name="source_location" type="text" class="white-text validate location margin-none" placeholder="Enter Pickup Location"/>
					@endif

					@if(Session::has('source_loction_hidden'))
                    <input autocomplete='off' id="source_location_hidden" value="{{Session::get('source_location_hidden')}}"name="source_location_hidden" class="location_id" type="hidden">
                    @else
                    <input autocomplete='off' id="source_location_hidden" name="source_location_hidden" class="location_id" type="hidden">
                    @endif
                    <div id="source_location_collection" class="collection margin-top--15"></div>
                </div>
                <div class="input-field col s12 m3">
                	@if(Session::has('destination_location_hidden'))
                	<input autocomplete='off' id="destination_location_hidden" value="{{Session::get('destination_location_hidden')}}" name="destination_location_hidden" class="location_id" type="hidden">
                    @else
                	<input autocomplete='off' id="destination_location_hidden" name="destination_location_hidden" class="location_id" type="hidden">
					@endif
					@if(Session::has('destination_location'))
                    <input autocomplete='off' id="destination_location" value="{{Session::get('destination_location')}}"  name="destination_location" type="text" class="white-text validate location margin-none" placeholder="Enter Desitnation Location"/>
                    @else
                    <input autocomplete='off' id="destination_location" value="{{Session::get('destination_location')}}"  name="destination_location" type="text" class="white-text validate location margin-none" placeholder="Enter Desitnation Location"/>
                    @endif
                    <div id="destination_location_collection" class="collection margin-top--15"></div>
                </div>
                <div class="input-field col s12 m3">
                    @if(Session::has('travel_date'))
                    <input autocomplete='off' id="travel_date" value="{{Session::get('travel_date')}}" name="travel_date" type="date" class="datepicker white-text" placeholder="Input Date" class="validate"/>
                    @else
                    <input autocomplete='off' id="travel_date" name="travel_date" type="date" class="datepicker white-text" placeholder="Input Date" class="validate"/>
					@endif
                </div>
                {{-- <div class="input-field white-text col s12 m2">
                    <select id='size' name='size'>
                        <option value="">Chose Size</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                    </select>
                </div> --}}
                <div class="col s12 m3">
                    <button type="submit" class="btn margin-top-25  btn-block waves-effect waves-light">Search</button>
                </div>
            </div>
            <div class="row center-align">
            	<div class="switch">
				    <label>
				      Sender
				      @if(Session::has('sender_or_carrier'))
				      	@if(Session::get('sender_or_carrier') == 'sender')
				      	<input autocomplete='off' type="checkbox" name='sender_or_carrier'>
				      	@else
				      	<input autocomplete='off' checked type="checkbox" name='sender_or_carrier'>
						@endif
				      @else
				      <input autocomplete='off' type="checkbox" name='sender_or_carrier'>
					  @endif
				      <span class="lever"></span>
				      Carrier
				    </label>
			  	</div>
            </div>
        </form>
    </div>
</div>
@stop
@section("javascript")
<script>
	var getLoctions = "{{route('getLocations',['input','__city__'])}}";
</script>
<script type="text/javascript" src="{{url('js/features.js')}}"></script>
@stop
