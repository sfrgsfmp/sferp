<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="{{ ('/template/inspina/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ ('/template/inspina/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ ('/template/inspina/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <link href="{{ ('/template/inspina/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ ('/template/inspina/css/animate.css') }}" rel="stylesheet">
    <link href="{{ ('/template/inspina/css/style.css') }}" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="{{ ('/template/inspina/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ ('/template/inspina/js/popper.min.js') }}"></script>
    <script src="{{ ('/template/inspina/js/bootstrap.js') }}"></script>
    <script src="{{ ('/template/inspina/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ ('/template/inspina/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- --DATA TABLE-- -->
    <script src="{{ ('/template/inspina/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ ('/template/inspina/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <link href="{{ ('/template/inspina/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> </script> -->
    <!-- <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <!-- <link href="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"> -->
    <!-- //baru -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"> </script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"> </script> -->

   



    <!-- Flot -->
    <script src="{{ ('/template/inspina/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ ('/template/inspina/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ ('/template/inspina/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ ('/template/inspina/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ ('/template/inspina/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <!-- FooTable -->
    <link href="{{ ('/template/inspina/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
    <!-- FooTable -->
    <script src="{{ ('/template/inspina/js/plugins/footable/footable.all.min.js') }}"></script>


    <!-- Peity -->
    <script src="{{ ('/template/inspina/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ ('/template/inspina/js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ ('/template/inspina/js/inspinia.js') }}"></script>
    <script src="{{ ('/template/inspina/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ ('/template/inspina/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- GITTER -->
    <script src="{{ ('/template/inspina/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ ('/template/inspina/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ ('/template/inspina/js/demo/sparkline-demo.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ ('/template/inspina/js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ ('/template/inspina/js/plugins/toastr/toastr.min.js') }}"></script>

    <!-- Tags Input -->
    <script src="{{ ('/template/inspina/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <link href="{{ ('/template/inspina/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Chosen -->
    <!-- <script src="{{ ('/template/inspina/js/plugins/chosen/chosen.jquery.js') }}"></script>
    <link href="{{ ('/template/inspina/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet"> -->

    <!-- Sweet alert -->
    <link href="{{ ('/template/inspina/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <script src="{{ ('/template/inspina/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Data picker -->
    <!-- <script src="{{ ('/template/inspina/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <link href="{{ ('/template/inspina/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet"> -->

    

    <!-- ---Air Date Picker--- -->
    <link rel="stylesheet" href="{{ ('/air-datepicker/dist/css/datepicker.css') }}">
    <script src="{{ ('/air-datepicker/dist/js/datepicker.js') }}"> </script>
    <script src="{{ ('/air-datepicker/dist/js/i18n/datepicker.en.js') }}"> </script>
    <!-- <script src="{{ ('/air-datepicker/dist/js/i18n/datepicker.in.js') }}"> </script> -->

    <!-- Select2 -->
    <script src="{{ ('/template/inspina/js/plugins/select2/select2.full.min.js') }}"></script>
    <link href="{{ ('/template/inspina/css/plugins/select2/select2.min.css') }}" rel="stylesheet">

    <!-- Chosen -->
    <script src="{{ ('/template/inspina/js/plugins/chosen/chosen.jquery.js') }}"></script>
    <link href="{{ ('/template/inspina/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">

    <title> @yield('title','Dashboard')</title>
</head>

<body>

<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"> Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"></a>
                                </li>
                            @endif
                        @else
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">{{ Auth::user()->username }}</span>
                            <span class="block m-t-xs">{{ Auth::user()->email }}
                                <b class="caret"></b>
                            </span>
                            
                        </a>
                        
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            
                            @hasrole(['user', 'manager', 'supervisor'])
                            <li><a class="dropdown-item" href="{{ route('changepassword.index', ['id' => Auth::user()->id]) }}">Change Password</a></li>
                            <li class="dropdown-divider"></li>
                            @endhasrole
                            

                            @hasrole(['admin'])
                            <li><a class="dropdown-item" href="{{ route('admin.users.show', ['id' => Auth::user()->id]) }}">Profile</a></li>
                            <li class="dropdown-divider"></li>
                            @endhasrole

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                        @endguest
                        
                    </div>
                    <div class="logo-element">SF</div>
                </li>
                
                <li>
                    <a><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> </a>
                </li>

                <li>
                    <!-- hanya user role=admin yg bisa akses, selain itu, maka sub menu manage-user tidak akan muncul -->
                    @hasrole(['admin'])
                        <a href="{{ route('admin.users.index') }}"><i class="fa fa-user-circle"></i><span class="nav-label">MANAGE USERS</span></a>
                        
                    @endhasrole
                </li>
                
                <li class="{{ setActive('master.*') }}">
                @hasrole(['admin'])
                    <a href="#"><i class="fa fa-inbox"></i> <span class="nav-label">SETUP</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ setActive('master.*') }}">
                            <a href="#" id="damian">Inventory <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse">
                                
                                <li class="{{ setActive('master.species.*') }}">
                                    <a href="{{ route('master.species.index') }}">Species</a>
                                </li>
                                <li class="{{ setActive('master.specification.*') }}">
                                    <a href="{{ url('master/specification') }}" class="nav-link ">Specification</a>
                                </li>
                                <li class="{{ setActive('master.kbm.*') }}">
                                    <a href="{{ route('master.kbm.index') }}"  class="nav-link ">KBM</a>
                                </li>
                                <li class="{{ setActive('master.kph.*') }}">
                                    <a href="{{ url('master/kph') }}"  class="nav-link ">KPH</a>
                                </li>
								<li class="{{ setActive('master.kphtype.*') }}">
                                    <a href="{{ url('master/kphtype') }}"  class="nav-link ">KPH Type</a>
                                </li>
                                <li class="{{ setActive('master.tpk.*') }}">
                                    <a href="{{ url('master/tpk') }}"  class="nav-link ">TPK</a>
                                </li>
                                <li class="{{ setActive('master.itemgroup.*') }}">
                                    <a href="{{ url('master/itemgroup') }}"  class="nav-link ">Item Group</a>
                                </li>
                                <li class="{{ setActive('master.quality.*') }}">
                                    <a href="{{ url('master/quality') }}"  class="nav-link ">Quality</a>
                                </li>
                                <li class="{{ setActive('master.measurement.*') }}">
                                    <a href="{{ url('master/measurement') }}"  class="nav-link ">Measurement</a>
                                </li>
                                <li class="{{ setActive('master.objective.*') }}">
                                    <a href="{{ url('master/objective') }}"  class="nav-link ">Objective</a>
                                </li>
                                <li class="{{ setActive('master.warehouse.*') }}">
                                    <a href="{{ url('master/warehouse') }}"  class="nav-link ">Warehouse</a>
                                </li>
								<li class="{{ setActive('master.owner.*') }}">
                                    <a href="{{ url('master/owner') }}"  class="nav-link ">Owner</a>
                                </li>
                                <!-- <li class="{{ setActive('master.inventoryitem.index') }}">
                                    <a href="{{ url('master/inventoryitem') }}"  class="nav-link ">Inventory Item</a>
                                </li> -->
                                <!-- <li class="{{ setActive('master.hjd')}}">
                                    <a href="{{ url('master/hjd')}}" class="nav-link">HJD</a>
                                </li> -->

                            </ul>
                        </li>
                        <li class="{{ setActive('master*') }}"><a href="#">Payable <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse">
                                <li class="{{ setActive('master.vendor.*') }}">
                                    <a href="{{ url('master/vendor') }}">Vendor</a>
                                </li>
                        
                                <li class="{{ setActive('master.grader.*') }}">
                                    <a href="{{ url('master/grader') }}">Grader Skill</a>
                                </li>

                            </ul>
                        </li>
                        <li class="{{ setActive('master.bank.*') }}"><a href="#">Bank <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse">
                                <li class="{{ setActive('master.bank.*') }}">
                                    <a href="{{ url('master/bank') }}" >Bank</a>
                                </li>
                                <li class="{{ setActive('master.account.*') }}">
                                    <a href="{{ url('master/bank/account') }}" >Bank Account</a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                @endhasrole
                </li>

                
                @foreach($datas as $dep)
                <li id="menu">
                    <a href="#"><i class="fa fa-bar-chart-o"></i> {{ $dep->id_dept }}<span class="fa arrow"></span></a>

                    <ul class="nav nav-second-level collapse">
                    @foreach($dep->menu as $sub)
                        <li id="submenu" class="{{ setActive(Request::is($sub->link_menu) == $sub->link_menu) }}">
                            <a href="{{ url($sub->link_menu) }}"> {{ $sub->menu_name }}  </a>
                        
                            @foreach($sub->submenu as $sm)
                            <ul class="nav nav-third-level collapse">
                                <li>
                                    <a href="{{ url($sm->link_menu) }}" class="nav-link "> {{ $sm->submenu }} </a>
                                </li>
                            </ul>
                            @endforeach
                        </li>
                    @endforeach
                    </ul>
                </li>
                @endforeach
                

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom gray-bg">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li style="padding: 20px">
                        <span class="m-r-sm text-muted welcome-message">Welcome to SF ERP</span>
                    </li>
                    
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </nav>
        </div>
        
        <!-- section title -->
        <div class="row wrapper border-bottom white-bg page-heading">
            @yield('section_title', 'Dashboard')
        </div>
        <!-- end title -->

        
        @include('partial.alert.alerts')

        <!-- include('sweetalert::alert') -->
        
        <!-- section content -->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                @yield('content')
            </div>
        </div>
        <!-- end content -->

        <div class="footer">
            <div>
                <strong> Copyright © {{date('Y')}} - All rights reserved. </strong>
            </div>
        </div>
    </div>
    

    

</div>

<script>
    
    function submenu()
    {
        // alert('clicked!');
        // var element = document.getElementById("menu");
        // element.classList.add("active");
    }
</script>

<script>
        $(document).ready(function() 
        {
            // setTimeout(function() 
            // {
            //     toastr.options = 
            //     {
            //         closeButton: true,
            //         progressBar: true,
            //         showMethod: 'slideDown',
            //         timeOut: 4000
            //     };
            //     toastr.success('Welcome to SF ERP');

            // }, 1300);


            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [300,50,100],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [70,27,85],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

            $('.tagsinput').tagsinput({
                tagClass: 'label label-primary'
            });

        });


        // ---- untuk data tabel
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                ordering: false,
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                // buttons: [
                //     {extend: 'copy'},
                //     {extend: 'csv'},
                //     {extend: 'excel', title: 'ExampleFile'},
                //     {extend: 'pdf', title: 'ExampleFile'},

                //     {extend: 'print',
                //      customize: function (win){
                //             $(win.document.body).addClass('white-bg');
                //             $(win.document.body).css('font-size', '10px');

                //             $(win.document.body).find('table')
                //                     .addClass('compact')
                //                     .css('font-size', 'inherit');
                //     }
                //     }
                // ]

            });

        });

       
</script>
<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });
    $(document).ready(function() {
        $('#example').DataTable();
        $('#document_receipt').DataTable();
        $('#graderin_receipt').DataTable();
        $('#graderout_receipt').DataTable();
        $('#external_receipt').DataTable();
    } );
</script>

<!-- iCheck -->
<script src="{{ ('/template/inspina/js/plugins/iCheck/icheck.min.js') }}"></script>

    
    
</body>
