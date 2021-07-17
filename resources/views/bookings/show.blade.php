<html>
    <head>
        <style>
            @page {
                margin: 0cm 0cm;
                font-family: Helvetica, Arial, sans-serif;
                font-size: small;
            }
            * {
                font-family: Helvetica, Arial, sans-serif;
                font-size: small;
            }
    
            body {
                margin: 2cm 1cm 1cm;
            }
    
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                background-color: #fd7e14;
                color: white;
                text-align: center;
                line-height: 30px;
            }
    
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                background-color: #fd7e14;
                color: white;
                text-align: center;
                line-height: 35px;
            }
            main {
                margin-top: 1rem;
                display: block;
                position: relative;
            }
            .divTable {
                display: table;
                width: 100%;
            }

            .divTableRow {
                display: table-row;
            }
            .divTableCell {
                border-bottom: 1px solid #999999;
                display: table-cell;
                padding: 3px 10px;
            }
            .divTableBody {
                display: table-row-group;
            }
            .table {
                width: 100%;
                margin-top: 1rem;
                color: #212529;
                background-color: transparent;
                border-collapse: collapse;
                display: table;
                border-collapse: separate;
                box-sizing: border-box;
                text-indent: initial;
                border-spacing: 0;
                position: relative;
            }
            tr {
                display: table-row;
                vertical-align: inherit;
                border-color: 0;
            }
            .table-custom td {
                padding: 0.25rem;
            }
            .table td, .table th {
                padding: .75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }
            td {
                display: table-cell;
                vertical-align: inherit;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Turnos {{ $day }}</h1>
        </header>

        <main>

            @php
                $time = \Carbon\Carbon::create("$day 07:00:00");
                $cant = 75;

                function getState($bookings, $time) {
                    $state = '';
                    foreach ($bookings as $booking) {
                        $newT = \Carbon\Carbon::create($time->toDateTimeString())->format('Y-m-d H:i:s');
                        if ($booking->start == $newT) {
                            $state = $booking->state ? $booking->state : 'Pendiente';
                        }
                    }

                    return $state;
                }

                function printTime($bookings, $time) {
                    $enabled = '';
                    foreach ($bookings as $booking) {
                        $newT = \Carbon\Carbon::create($time->toDateTimeString())->format('Y-m-d H:i:s');
                        if ($booking->start == $newT) {
                            $enabled = Str::upper($booking->supplier);
                        }
                    }

                    return $enabled;
                }
            @endphp

            <div class="divTable">
                <div class="table table-bordered table-striped table-custom">
                    @for( $i=0; $i<$cant; $i++ )                                     
                        @if ( $i>0 && $i%5 !== 0 )
                            <div class="divTableRow">
                                <div class="divTableCell">
                                    <span class="badge">
                                        {{ \Carbon\Carbon::create( $time->toDateTimeString() )->format('H:i') }}
                                    </span>
                                    <span class="badge">
                                        {{ printTime($bookings, $time) }} - {{ getState($bookings, $time) }}
                                    </span>
                                </div>
                                @php $time->addMinutes(15) @endphp
                            </div>
                        @endif
                    @endfor
                </div>
            </div>

        </main>
            
        <footer>
            <h1>DepotSoftware</h1>
        </footer>

    </body>
</html>
