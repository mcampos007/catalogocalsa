{{-- <div class="card text-white bg-primary mb-3" style="max-width: 33rem; "> --}}
    <h2 class="title">ARQUEO</h2>
    <table class="table-responsive table-hover  table-striped ">
        <thead>
            <tr>
                <th class="col-md-2 text-center">Denominación</th>    
                <th class="col-md-2 text-center">Cantidad</th>    
                <th class="col-md-2 text-center">Importe</th>    
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="col-md-2 text-center">$1000</td>    
                <td class="col-md-2 text-center">{{$caja->efectivo->billete1000}}</td>    
                <td class="col-md-2 text-right">{{$caja->efectivo->billete1000 * 1000}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center">$500</td>    
                <td class="col-md-2 text-center">{{$caja->efectivo->billete500}}</td>    
                <td class="col-md-2 text-right">{{$caja->efectivo->billete500 * 500}}</td>
            </tr>
            <tr>
                <td class="col-md-2 text-center">$200</td>    
                <td class="col-md-2 text-center">{{$caja->efectivo->billete200}}</td>    
                <td class="col-md-2 text-right">{{$caja->efectivo->billete200 * 200}}</td>
            </tr>
            <tr>
                <td class="col-md-2 text-center">$100</td>    
                <td class="col-md-2 text-center">{{$caja->efectivo->billete100}}</td>    
                <td class="col-md-2 text-right">{{$caja->efectivo->billete100 * 100}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center">$50</td>    
                <td class="col-md-2 text-center">{{$caja->efectivo->billete50}}</td>    
                <td class="col-md-2 text-right">{{$caja->efectivo->billete50 * 50}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center">$20</td>    
                <td class="col-md-2 text-center">{{$caja->efectivo->billete20}}</td>    
                <td class="col-md-2 text-right">{{$caja->efectivo->billete20 * 20}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center">$10</td>    
                <td class="col-md-2 text-center">{{$caja->efectivo->billete10}}</td>    
                <td class="col-md-2 text-right">{{$caja->efectivo->billete10 * 10}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center bg-primary " colspan="2">Total</td>    
                <td class="col-md-2 text-right bg-primary ">{{$totbillete}}</td>
            </tr>
        </tbody>
    </table> 
