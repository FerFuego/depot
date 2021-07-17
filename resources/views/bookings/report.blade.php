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
            .divTableCell {
               /*  border-bottom: 1px solid #999999; */
                /* display: table-cell; */
                /* padding: 3px 10px; */
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
    @php 
        $index=1;
        $brand = true;
        $startpos = 1;
        $continue2 = 1;
        $end = date("t", $start);
        setlocale(LC_ALL, 'es_ES');
        $f = \Carbon\Carbon::create(date('Y-m', $start));
    @endphp
    <body>
        <header>
            <h1>Reporte Mensual {{ Str::ucfirst($f->formatLocalized('%B')) }}&nbsp;{{ date('Y', $start) }}</h1>
        </header>

        <main>
            <div class="divTable">
                <div class="table table-bordered table-striped">
                    <div class="divTableRow">
                        @for( $j=0; $j<$end; $j++ )
                            <div class="divTableCell">
                                @if( $startpos > 0 && $continue2 < $end ) 
                                    @php 
                                        $continue2++;
                                        $brand = true;
                                    @endphp
                                    @foreach($bookings as $booking)
                                        @if( $booking->day == date('Y-m', $start) .'-'. $continue2 || $booking->day == date('Y-m', $start) .'-0'. $continue2 )
                                            @if ($brand)
                                                <div>
                                                    @php
                                                        $fecha = \Carbon\Carbon::create(date('Y-m', $start) .'-'. $continue2);
                                                    @endphp
                                                    <h4>
                                                        {{ $fecha->formatLocalized('%d de %B') }}
                                                    </h4> 
                                                </div>
                                                @php $brand = false; @endphp
                                            @endif
                                            @if ($booking->supplier)
                                                <span>
                                                    {{ \Carbon\Carbon::create($booking->start)->format('H:i') ." a ". \Carbon\Carbon::create($booking->end)->format('H:i') . " - ". Str::upper($booking->supplier) . " - " }} {{ $booking->state ?? 'Pendiente'}}
                                                </span>
                                                <br>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </main>
            
        <footer>
            <h1>DepotSoftware</h1>
        </footer>

    </body>
</html>
