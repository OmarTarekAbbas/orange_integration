<ul class="nav menu">
    <li class="active"><a href="{{ url('admin') }}"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
    <!-- <li class="parent">
        <a href="#sub-item-1"  data-toggle="collapse">
            <span class="glyphicon glyphicon-list"></span> Messages <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-1">
            <li>
                <a class="" href="{{url('admin/mt/create')}}">
                    <span class="glyphicon glyphicon-share-alt"></span> Send Message
                </a>
            </li>
            <li>
                <a class="" href="{{url('admin/mt')}}">
                    <span class="glyphicon glyphicon-share-alt"></span> List Messages
                </a>
            </li>
        </ul>
    </li> -->
    <!-- <li class="parent">
        <a href="#sub-item-2"  data-toggle="collapse">
            <span class="glyphicon glyphicon-list-alt"></span> Services <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-2">
            @if(Auth::user()->admin == true)
            <li>
                <a class="" href="{{url('admin/services/create')}}">
                    <span class="glyphicon glyphicon-plus-sign"></span> Add Service
                </a>
            </li>
            @endif
            <li>
                <a class="" href="{{url('admin/services')}}">
                    <span class="glyphicon glyphicon-list-alt"></span> List Services
                </a>
            </li>
        </ul>
    </li> -->
    @if(Auth::user()->admin == true)
    <li class="parent">
        <a href="#sub-item-3"  data-toggle="collapse">
            <span class="glyphicon glyphicon-list-alt"></span> Country <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-3">

            <li>
                <a class="" href="{{url('admin/country/create')}}">
                    <span class="glyphicon glyphicon-plus-sign"></span> Add Country
                </a>
            </li>

            <li>
                <a class="" href="{{url('admin/country')}}">
                    <span class="glyphicon glyphicon-list-alt"></span> List Countries
                </a>
            </li>
        </ul>
    </li>
    <li class="parent">
        <a href="#sub-item-4"  data-toggle="collapse">
            <span class="glyphicon glyphicon-list-alt"></span> Operator <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-4">

            <li>
                <a class="" href="{{url('admin/operator/create')}}">
                    <span class="glyphicon glyphicon-plus-sign"></span> Add Operator
                </a>
            </li>

            <li>
                <a class="" href="{{url('admin/operator')}}">
                    <span class="glyphicon glyphicon-list-alt"></span> List Operators
                </a>
            </li>
        </ul>
    </li>

    <li class="parent">
        <a href="#sub-item-5"  data-toggle="collapse">
            <span class="glyphicon glyphicon-list-alt"></span> Orange <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
        </a>
        <ul class="children collapse" id="sub-item-5">
        <li id="orange_subscribes">
                <a class="" href="{{url('admin/orange_subscribes')}}">
                    <span class="glyphicon glyphicon-list-alt"></span> Orange Subscribes
                </a>
            </li>
            <li id="orange_notifie">
                <a class="" href="{{url('admin/orange_notifie')}}">
                    <span class="glyphicon glyphicon-list-alt"></span> Charging
                </a>
            </li>
            <li id="orange_ussd">
                <a class="" href="{{url('admin/orange_ussds')}}">
                    <span class="glyphicon glyphicon-list-alt"></span> Orange Ussds
                </a>
            </li>
            <li id="orange_webs">
                <a class="" href="{{url('admin/orange_webs')}}">
                    <span class="glyphicon glyphicon-list-alt"></span> Orange Webs
                </a>
            </li>

            <li id="orange_subscribes">
                <a class="" href="{{url('admin/orange_provisions')}}">
                    <span class="glyphicon glyphicon-list-alt"></span> Orange Provisions
                </a>
            </li>
            <li id="orange_whitelists">
                <a class="" href="{{url('admin/orange_whitelists')}}">
                    <span class="glyphicon glyphicon-list-alt"></span> Orange Whitelists
                </a>
            </li>
            <li id="orange_whitelists">
                <a class="" href="{{url('admin/orange_statistics')}}">
                    <span class="glyphicon glyphicon-list-alt"></span>Orange Statistics
                </a>
            </li>
           

            <li id="orange_whitelists">
                <a class="" href="{{url('admin/orange_statistics_by_form')}}">
                    <span class="glyphicon glyphicon-list-alt"></span>Orange filter
                </a>
            </li>
            <!-- @if( Auth::user()->id  == 1) -->
            <li id="orange_whitelists">
                <a class="" href="{{url('admin/download_subscribe')}}">
                    <span class="glyphicon glyphicon-list-alt"></span>Download Subscribe
                </a>
            </li>
            <!-- @endif -->
        </ul>
    </li>

    @endif
    <li role="presentation" class="divider"></li>
    <!-- <li><a href="{{ url('service') }}"><span class="glyphicon glyphicon-random"></span> Change service</a></li> -->
    @if(Auth::user()->admin == true)
        <li><a href="{{ url('admin/user/create') }}"><span class="glyphicon glyphicon-user"></span> Add User</a></li>
        <li><a href="{{ url('admin/user') }}"><span class="glyphicon glyphicon-list"></span> Users list</a></li>
    @endif
</ul>
