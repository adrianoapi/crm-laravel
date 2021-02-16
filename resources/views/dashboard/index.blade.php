@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid" id="content">

    @include('layouts.navigation')

    <div id="main">
        <div class="container-fluid">

            <div class="page-header">
                <div class="pull-left">
                    <h1>Dashboard</h1>
                </div>
                <div class="pull-right">
                    <ul class="minitiles">
                        <li class='grey'>
                            <a href="#"><i class="icon-cogs"></i></a>
                        </li>
                        <li class='lightgrey'>
                            <a href="#"><i class="icon-globe"></i></a>
                        </li>
                    </ul>
                    <ul class="stats">
                        <li class='satgreen'>
                            <i class="icon-money"></i>
                            <div class="details">
                                <span class="big">$324,12</span>
                                <span>Balance</span>
                            </div>
                        </li>
                        <li class='lightred'>
                            <i class="icon-calendar"></i>
                            <div class="details">
                                <span class="big">February 22, 2013</span>
                                <span>Wednesday, 13:56</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </div>

</div>

@endsection
