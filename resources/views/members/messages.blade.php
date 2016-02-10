@extends('members.layout')
@section('content')
<div class="white row padding-top-20" style="min-height:550px">
    <div class="col s12 m2 no-padding">
        <div class="col s12 no-margin no-padding padding-top-40"  style="min-height:540px">
            <div class="collection no-margin">
                <a href="#!" class="collection-item red-text text-darken-2">Alan<span class="badge">1</span></a>
                <a href="#!" class="collection-item red-text text-darken-2">Jacob<span class="new badge red darken-2">4</span></a>
                <a href="#!" class="collection-item red-text text-darken-2">Marshell</a>
                <a href="#!" class="collection-item red-text text-darken-2">Randy<span class="badge">14</span></a>
            </div>
        </div>
    </div>
    <div class="col s12 m10 padding-left-10">
        <div class="col s12 no-margin no-padding">
            <div class="row padding-10">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="textarea1" class="materialize-textarea"></textarea>
                            <label  for="textarea1">Your Message Here</label>
                        </div>
                    </div>
                    <div class="margin-left-10">
                        <button type="button" class="red darken-2 text-grey text-lighten-3 btn">Send</button>
                    </div>
                </form>
            </div>
            <div class="row padding-20">
                <ul class="collection with-header">
                    <li class="collection-header"><h4>Previous Conversations</h4></li>
                    <li class="collection-item">
                        <div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </li>
                    <li class="collection-item">
                        <div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </li>
                    <li class="collection-item">
                        <div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop