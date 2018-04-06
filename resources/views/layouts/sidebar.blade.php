
<div id="mySidenav" class="sidebar">
  <h4><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">Fechar [&times;]</a></h4>
  <br>
  <h3>Débitos ({{$count->counter}})</h3>
  <hr>
  @foreach ($clientes as $cliente)
    <table class="tabled table-doh">
      <thead>
        <tr>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <a href="/cliente/{{$cliente->id}}" class="btn btn-success linkbutton button-panel">{{ $cliente->nome . " " .
              $cliente->sobrenome }}
            </a>
          </td>
          <td>
            <div class="a2">
            @if($cliente->usuario != null)
              <form action="/mail/{{$cliente->id}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$cliente->id}}" />
                <button type="submit" class="btn btn-success linkbutton linkmargin button-panel" title="Enviar">
                  <span class="fa fa-envelope fa-fw" aria-hidden="true"></span>
                </button>
              </form>
            @endif
          </div>
          </td>
        </tbody>
      </table>
    @endforeach
  </div>
  <div class="sidebar-icon btn btn-success">
    <span onclick="openNav()">Débitos ({{$count->counter}})</span>
  </div>
