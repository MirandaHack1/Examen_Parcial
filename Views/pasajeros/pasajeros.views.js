//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html

function init(){
    $('#usu_form').on('submit', (e)=>{
      UsuariosGD(e);
    })
}


$().ready(() => {
    UsuariosTabla();
});

var UsuariosTabla = () => {
  var html = "";
  $.post(
    "../../controllers/pasajeros.controllers.php?op=todos",{},(listausuario) => {
      //console.log(JSON.parse(listausuario));
      listausuario = JSON.parse(listausuario);
      $.each(listausuario, (index, usuario) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${usuario.nombre}</td>` +
          `<td>${usuario.ID_rutas}</td>` +
          `<td>${usuario.modelo}</td>` +
          `<td>${usuario.ID_estacion_origen}</td>` +
          
          `<td>${usuario.ID_estacion_destino}</td>` +
          `<td>${usuario.ID_fecha}</td>` +
          
          `<td>` +
          `<button class='btn btn-success' onclick='uno(${usuario.ID_estacion})'>Editar</button>` +
          `<button class='btn btn-danger' onclick='eliminar(${usuario.ID_estacion})'>Eliminar</button>` +
          `</td>` +
          `</tr>`;
      });
      $('#TUsuario').html(html);
    }
  );
};

var cargaRol= () => {
  var htmlRutas = ' <option value="0">Seleccione una Opcion</option>';
  $.post("../../controllers/rutas.controller.php?op=todos", (lista) => {
    lista = JSON.parse(lista);
    $.each(lista, (index, ID_rutas) => {
      htmlRutas += `<option value="${ID_rutas.ID_rutas}">${ID_rutas.ID_estacion_origen}</option>`;
    });
    $("#id_rol").html(htmlRutas);
  });
};

var UsuariosGD = (e) => {
    e.preventDefault();
  var url = "";
  var ID_pasajero= document.getElementById("ID_pasajero").value;
  if ( ID_pasajero === undefined || ID_pasajero === "") {
    url = "../../controllers/pasajeros.controllers.php?op=insertar";
  } else {
    url = "../../controllers/pasajeros.controllers.php?op=actualizar";
  }
  var form_Data = new FormData($("#usu_form")[0]);
  $.ajax({
    url: url,
    type: "POST",
    data: form_Data,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      respuesta = JSON.parse(respuesta);
      console.log(respuesta);
      if (respuesta == "ok") {
        Swal.fire('Categoria de Usuario', 'Se guardo con exito', 'success');
        limpiar();
        tablacliente();
      } else {
        Swal.fire('Categoria de Usuario', 'Ocurrio un error', 'danger');
      }
    },
  });
};

var uno = (ID_pasajero) => {
  $.post('../../controllers/pasajeros.controllers.php?op=uno', {
    id: id
  }, (res) => {
      res= JSON.parse(res);
      $('#ID_pasajero').val(res.ID_pasajero);
      $('#nombre').val(res.nombre);
      $('#ID_rutas').val(res.ID_rutas);
      $('#modelo').val(res.modelo);
      $('#ID_estacion_origen').val(res.ID_estacion_origen);
      $('#ID_estacion_destino').val(res.ID_estacion_destino);
      $('#ID_fecha').val(res.ID_fecha);


  })
  document.getElementById('titulousuario').innerHTML = "Editar Usuarios";
  $('#ModalUsu').modal('show');
};


var eliminar = (ID_pasajero) => {
  Swal.fire({
      title: 'Pasajero',
      text: "Esta seguro que desea eliminar...???",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar!!!'
  }).then((result) => {
      if (result.isConfirmed) {
          $.post('../../controllers/pasajeros.controllers.php?op=eliminar', {
            id: id
          }, (res) => {
              res = JSON.parse(res);
              if (res === 'ok') {
                  Swal.fire('Pasajero', 'Se eliminó con éxito', 'success');
                  limpiar();
                  UsuariosTabla();
              }

          })
      }
  })
};

var limpiar = () => { 
  $('#ID_pasajero').val("");
      $('#nombre').val("");
      $('#ID_rutas').val("");
      $('#modelo').val("");
      $('#ID_estacion_origen').val("");
      $('#ID_estacion_destino').val("");
      $('#ID_fecha').val("");
    $('#ModalUsu').modal('hide');
    document.getElementById('titulousuario').innerHTML = "Nuevo Usuario";
};
init();