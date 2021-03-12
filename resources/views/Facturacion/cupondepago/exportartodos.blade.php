
     @for ($i = 0; $i <$final ; $i++)
<div>
    <div style="text-align:center;">
        <h1>COMITE DE AGUA POTABLE RURAL</h1>
        <h1><b>"BULI ORIENTE"</b></h1>
        <h2>Cupón de Pago</h2>
    </div>
    <div style="text-align:right; font-size:100%; ">
         <label>Fecha de emisión: {{$fecha}}</label>
    </div>
    <div style="text-align:center; font-size:150%; ">
         <label>Nombre: {{$lista[$i]['nombre'].', '.$lista[$i]['direccion']}}</label>
    </div>
    <br>
    <div>
          <table style="border: 1px solid black; text-align:center; margin: auto; font-size:150%;" >
                    <tr>
                        <td style="border: 1px solid black;">
                            <label>Lectura Anterior: {{$lista[$i]['lecturaanterior']}}</label>
                        </td>
                        <td style="border: 1px solid black;">
                            <label>Lectura Actual: {{$lista[$i]['lecturaactual']}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label>Total del Mes: {{$lista[$i]['totaldelmes']}}</label>
                        </td>
                        <td style="border: 1px solid black;">
                            <label>M<sup>3</sup>: {{$lista[$i]['m3']}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label>Mes Anterior: 0<!-- {{$lista[$i]['mesanterior']}} --></label>
                        </td>
                        <td style="border: 1px solid black;">
                            <label>Subsidio: {{$lista[$i]['subsidio']}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;">
                            <label>Saldo a favor/ en contra: {{$lista[$i]['multa']}}</label>
                        </td>
                        <td style="border: 1px solid black;">
                            <label>Total: {{$lista[$i]['totalfinal']}}</label>
                        </td>
                    </tr>
                   
                </table>
    </div>
    <br>
    <div style="text-align:center; margin: auto;">
         <span>FECHA DE PAGO: Del 01 al 15 de cada mes.- HORARIO: 09:00-13:00</span>
    </div>
    <br><br>
    <div style="text-align:center; margin: auto; font-size:200%;">
        -------------------------
    </div>
     <br><br>
   
</div>
    @endfor