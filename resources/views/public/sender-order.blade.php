@extends('public.nobg-layout')
@section('content')
<div class="container ">

    <div class="row col s12 m6 " >
        <table class="striped">
            <caption>
                Order Details
            </caption>
            <thead>
                <tr>
                    <th data-field="id">Item</th>
                    <th data-field="name">Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Order Number</td>
                    <td><?= session('order_num') ?></td>
                </tr>
                <tr>
                    <td>From</td>
                    <td>{{Session::get('source_location')}}</td>
                </tr>
                <tr>
                    <td>To</td>
                    <td>{{Session::get('destination_location')}}</td>
                </tr>
                {{-- <tr>
                    <td>Size</td>
                    <td>{{Session::get('size')}}</td>
                </tr> --}}
                <tr>
                    <td>Travel Date</td>
                    <td>{{Session::get('travel_date')}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row col s12 m6">
        <form class="" method="post" action="{{route('sender_order')}}">
            <h6>Your Order Details</h6>
            {{ csrf_field() }}
            <div class="input-field col s12">
                <textarea id="order_description" name="order_description" class="materialize-textarea"></textarea>
                <label for="order_description">Desription</label>
            </div>
            <div class="input-field col s6">
                <select id="order_type" name="order_type">
                    <option value="" disabled selected>Choose your Type</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
                <label>Package Type</label>
            </div>
            <div class="input-field col s6">
                <select id="size" name="size">
                    <option value="" disabled selected>Choose your Size</option>
                    <option value="1">Size 1</option>
                    <option value="2">Size 2</option>
                    <option value="3">Size 3</option>
                </select>
                <label>Package Size</label>
            </div>
            <div class="input-field col s12">
                <input id="order_price" name="order_price" type="text" class="validate"/>
                <label>Price</label>
            </div>
            <div class="col s12 file-field input-field">
		      	<div class="btn"><span>File</span><input type="file" name="order_image" id="order_image"/></div>
		      	<div class="file-path-wrapper">
		        	<input class="file-path validate" type="text">
		      	</div>
		    </div>
		    <div class="col s12">
	            <button type="submit" class="btn btn-block waves-effect waves-light">
	                Register the Order
	            </button>
		    </div>
        </form>
    </div>
</div>
@stop
