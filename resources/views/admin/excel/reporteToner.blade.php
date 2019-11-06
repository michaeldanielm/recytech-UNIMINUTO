<table>
  <thead>
    <tr>
      <th>Modelo</th>
      <th>Cantidad sugerida</th>
      <th>Cantidad actual</th>
      <th>Ubicación</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($toners as $toner)
      <tr>
        <td>{{$toner->cartucho->modelo}}</td>
        <td>{{$toner->cantidadSugerida}}</td>
        <td>{{$toner->cantidad}}</td>
        <td>{{$toner->ubicacion->planta}} {{$toner->ubicacion->departamento}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
